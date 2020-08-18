<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembinaan extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_pembinaan','bina');

     }

    public function index()
    {
      $sisa_hari = $this->input->get('sisa_hari');
      $judul = '';

      if(!$sisa_hari){
        $this->session->unset_userdata('sisa_hari');
         $judul = 'Semua Jadwal Pembinaan';
      }else{
        if($sisa_hari == 'habis'){
          $this->session->set_userdata('sisa_hari', 'habis');
          $judul = 'Pembinaan Sudah Terlewat Jadwal';
        }elseif ($sisa_hari == 'akan_habis'){
           $this->session->set_userdata('sisa_hari', 'akan_habis');
           $judul = 'Jadwal Pembinaan Terdekat';
        }
        else{
          $this->session->unset_userdata('sisa_hari');
          $judul = 'Semua Jadwal Pembinaan';
        }
      }
  

      $data = array('header_judul' => $judul,
                    'data_pembina'    => $this->bina->get_user(),
                    'data_upi'     => $this->bina->get_upi(),
                    'upi_selected' => '',
                    'pembina_selected' => ''
              );

     $this->load->view('v_pembinaan', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->bina->get_datatables();
    		$data = array();
        $warna = '';
        $warna_status = '';
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          if($field->sisa_hari >= '0' && $field->sisa_hari <= '60'){
            $warna = '<span class="label label-warning">'.$field->sisa_hari.'</span>';
          }
          if($field->sisa_hari > '60'){
            $warna = '<span class="label label-success">'.$field->sisa_hari.'</span>';
          }
          if($field->sisa_hari < '0'){
            $warna = '<span class="label label-danger">'.$field->sisa_hari.'</span>';
          }

          $cek_status = $this->db->where('id_pembinaan', $field->id_pembinaan)->get('kuisioner');
          if($cek_status->num_rows() > 0){
              $warna_status = '<span class="label label-success">Sudah Pembinaan</span>';
          }else{
            $warna_status = '<span class="label label-danger">Belum Pembinaan</span>';
          }
         


          $row[] = $no;
    			$row[] = date('d F Y', strtotime($field->tgl_pembinaan));
    		  $row[] = $warna;
    		  $row[] = $field->nama_upi;
          $row[] = $field->nama;
          $row[] = $field->pimpinan;
          $row[] = $warna_status;
          
          $row[] = '<a class="btn btn-sm btn-success" href="javascript:void()" title="buat kuisioner" onclick="javascript:location.href='."'".base_url('kuisioner/tambah?id_pembinaan='.$field->id_pembinaan.'&nama_upi='.$field->nama_upi)."'".'">+ Buat/Lihat Kuisioner</a>';

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_pembinaan."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_pembinaan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->bina->count_all(),
    						"recordsFiltered" => $this->bina->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add produk
        {
          
           $hitung = $this->hitung_bina($this->input->post('tgl_pembinaan') );
            $data = array(
                    'tgl_pembinaan' => $this->input->post('tgl_pembinaan'),
                    'sisa_hari'  => $hitung,
                    'id_upi'     => $this->input->post('id_upi'),
                    'id_user'    => $this->input->post('id_user'),          
                    'pimpinan'   => $this->input->post('pimpinan'),
                    //'status'   => $this->input->post('status')
                    
                );

              $insert = $this->bina->save($data);
               echo json_encode(array("status" => TRUE));
        }

  public function ajax_delete($id)
         {
             $this->bina->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->bina->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
              $hitung = $this->hitung_bina($this->input->post('tgl_pembinaan') );
              $data = array(
                    'tgl_pembinaan' => $this->input->post('tgl_pembinaan'),
                    'sisa_hari'  => $hitung,
                    'id_upi'     => $this->input->post('id_upi'),
                    'id_user'    => $this->input->post('id_user'),          
                    'pimpinan'   => $this->input->post('pimpinan'),
                    //'status'   => $this->input->post('status')
                );
                
                 $this->bina->update(array('id_pembinaan' => $this->input->post('id_pembinaan')), $data);
                 echo json_encode(array("status" => TRUE));

           }

       public function hitung_bina($akhir){
 
          $datenow = new DateTime( date("Y-m-d") );
          $end_date = new DateTime($akhir);
          $interval = $datenow->diff($end_date);
         
          return $interval->format("%r%a");
       }    
/*
       public function update_sisa_hari(){
        
        
           $this->db->select('id_pembinaan, datediff(tgl_pembinaan, current_date()) as selisih');
           $this->db->from('pembinaan');
           $query = $this->db->get();
           if($query->num_rows() > 0)
           {
              foreach ($query->result() as $dt) {

                    $this->db->set('sisa_hari', $dt->selisih);
                    $this->db->where('id_pembinaan', $dt->id_pembinaan);
                    $this->db->update('pembinaan');

               }
               echo json_encode(array("status" => TRUE));
           }else{
              echo json_encode(array("status" => FALSE));
           }

       }
*/
}
