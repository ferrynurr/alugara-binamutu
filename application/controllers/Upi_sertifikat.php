<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upi_sertifikat extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_upi_sertifikat','sertif');

     }

    public function index()
    {
      $status_sertif = $this->input->get('status_sertif');
      $judul = '';

      if(!$status_sertif){
        $this->session->unset_userdata('status_sertif');
         $judul = 'Semua Sertifikat UPI';
      }else{
        if($status_sertif == 'habis'){
          $this->session->set_userdata('status_sertif', 'habis');
          $judul = 'Sertifikat UPI Habis';
        }elseif ($status_sertif == 'akan_habis'){
           $this->session->set_userdata('status_sertif', 'akan_habis');
           $judul = 'Sertifikat UPI Akan Habis';
        }
        else{
          $this->session->unset_userdata('status_sertif');
          $judul = 'Semua Sertifikat UPI';
        }
      }
  

      $data = array('header_judul' => $judul,
                    'data_sertif'  => $this->sertif->get_detail_sertifikat(),
                    'data_upi'     => $this->sertif->get_upi(),
                    'upi_selected' => '',
                    'sertif_selected' => ''
              );

     $this->load->view('v_upi_sertifikat', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->sertif->get_datatables();
    		$data = array();
        $warna = '';
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          if($field->berlaku >= '0' && $field->berlaku <= '60'){
            $warna = '<span class="label label-warning">'.$field->berlaku.'</span>';
          }
          if($field->berlaku > '60'){
            $warna = '<span class="label label-success">'.$field->berlaku.'</span>';
          }
          if($field->berlaku < '0'){
            $warna = '<span class="label label-danger">'.$field->berlaku.'</span>';
          }


          $row[] = $no;
    			$row[] = $field->no_sertifikat;
    		  $row[] = $field->nama_sertifikat;
    		  $row[] = $field->nama_upi;
          $row[] = date('d F Y', strtotime($field->tgl_kadaluwarsa) );
          $row[] = $warna;
         

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_sertifikat."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_sertifikat."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->sertif->count_all(),
    						"recordsFiltered" => $this->sertif->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add produk
        {
          
           $hitung = $this->hitung_skp($this->input->post('tgl_kadaluwarsa') );
            $data = array(
                    'no_sertifikat' => $this->input->post('no_sertifikat'),
                    'id_detail' => $this->input->post('id_detail'),
                    'id_upi' => $this->input->post('id_upi'),
                    'tgl_kadaluwarsa' => $this->input->post('tgl_kadaluwarsa'),          
                    'berlaku'   => $hitung
                );



              $insert = $this->sertif->save($data);
               echo json_encode(array("status" => TRUE));
        }

  public function ajax_delete($id)
         {
             $this->sertif->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->sertif->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
               $hitung = $this->hitung_skp($this->input->post('tgl_kadaluwarsa') );
               $data = array(
                    'no_sertifikat' => $this->input->post('no_sertifikat'),
                    'id_detail' => $this->input->post('id_detail'),
                    'id_upi' => $this->input->post('id_upi'),
                    'tgl_kadaluwarsa' => $this->input->post('tgl_kadaluwarsa'),          
                    'berlaku'   => $hitung
                );
                
                 $this->sertif->update(array('id_sertifikat' => $this->input->post('id_sertifikat')), $data);
                 echo json_encode(array("status" => TRUE));

           }

       public function hitung_skp($akhir){
 
          $datenow = new DateTime( date("Y-m-d") );
          $end_date = new DateTime($akhir);
          $interval = $datenow->diff($end_date);
         
          return $interval->format("%r%a");
       }    
       
        /*
       public function update_sisa_skp(){
        
        
           $this->db->select('id_sertifikat, datediff(tgl_kadaluwarsa, current_date()) as selisih');
           $this->db->from('sertifikat');
           $query = $this->db->get();
           if($query->num_rows() > 0)
           {
              foreach ($query->result() as $dt) {

                    $this->db->set('berlaku', $dt->selisih);
                    $this->db->where('id_sertifikat', $dt->id_sertifikat);
                    $this->db->update('sertifikat');

               }
               echo json_encode(array("status" => TRUE));
           }else{
              echo json_encode(array("status" => FALSE));
           }

       }
        */
}
