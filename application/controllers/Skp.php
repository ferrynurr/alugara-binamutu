<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skp extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_skp','skp');

     }

    public function index()
    {
      $status_skp = $this->input->get('status_skp');
      $judul = '';

      if($status_skp == 'all')
          $judul = 'Semua SKP';
      elseif($status_skp == 'akan_habis')
         $judul = 'SKP Akan Habis';
      elseif($status_skp == 'habis')
         $judul = 'SKP Habis';
/*
      if(!$status_skp){
        $this->session->unset_userdata('status_skp');
        $judul = 'Semua SKP';
      }else{
        if($status_skp == 'habis'){
          $this->session->set_userdata('status_skp', 'habis');
          $judul = 'SKP Habis';
        }elseif ($status_skp == 'akan_habis'){
           $this->session->set_userdata('status_skp', 'akan_habis');
           $judul = 'SKP Akan Habis';
        }
        else{
          $this->session->unset_userdata('status_skp');
          $judul = 'Semua SKP';
        }
      }
  */

      $data = array('header_judul' => $judul,
                    'data_produk'  => $this->skp->get_produk(),
                    'data_upi'     => $this->skp->get_upi(),

              );

     $this->load->view('v_skp', $data);

    }


  public function ajax_list($input)
    	{

    		$list = $this->skp->get_datatables($input);
    		$data = array();
       // $warna = '';
       // $statusnya = '';

    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          $tgl_now   = strtotime(date("Y-m-d"));
          $tgl_akhir = strtotime($field->tgl_akhir);
          $sisa      = $tgl_akhir - $tgl_now;
          $sisa_hari = floor($sisa / (60 * 60 * 24));

          $status ='';
          if($sisa_hari < 0)
            $status = '<span class="label label-danger">KADALUARSA</span>';
          if($sisa_hari > 90)
            $status = '<span class="label label-success">MASIH BERLAKU</span>'; 
          if($sisa_hari >= 0 && $sisa_hari <= 90)
            $status = '<span class="label label-warning">AKAN HABIS</span>';

          $row[] = $no;
    			$row[] = $field->no_skp;
    		  $row[] = $field->nama_upi;
    		  $row[] = $field->nama_produk;
          $row[] = $field->jenis_skp;
          $row[] = date('d F Y', strtotime($field->tgl_keluar) );
          $row[] = date('d F Y', strtotime($field->tgl_akhir) );
          $row[] = $sisa_hari;
          $row[] = $status;
         

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_skp."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_skp."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->skp->count_all($input),
    						"recordsFiltered" => $this->skp->count_filtered($input),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add produk
  {
      $post = $this->input->post();
      $result = array();
      $total_post = count($post['no_skp']);
      foreach($post['no_skp'] AS $key => $val)
      {
              $result[] = array(
                    
                    'id_upi' => $post['id_upi'],
                    'jenis_skp' => $post['jenis_skp'],
                    'tgl_keluar' => $post['tgl_keluar'],
                    'tgl_akhir' => $post['tgl_akhir'],
                    //'peringkat' => $post['peringkat'], 
                    'berlaku'   =>  $this->hitung_skp( $post['tgl_akhir'] ),
                    'no_skp' => $post['no_skp'][$key],  
                    'id_produk' => $post['id_produk'][$key],   

                   
                );

      }

         
               $this->skp->save($result);
               echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
         {
             $this->skp->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->skp->get_by_id($id);
                    echo json_encode($data);
          }

  public function ajax_update()
   {
                       
      $post = $this->input->post();
      $result = array();
      $total_post = count($post['no_skp']);
      foreach($post['no_skp'] AS $key => $val)
      {
              $result[] = array(
                    'id_skp' => $post['id_skp'],
                    'id_upi' => $post['id_upi'],
                    'jenis_skp' => $post['jenis_skp'],
                    'tgl_keluar' => $post['tgl_keluar'],
                    'tgl_akhir' => $post['tgl_akhir'],
                    //'peringkat' => $post['peringkat'], 
                    'berlaku'   =>  $this->hitung_skp( $post['tgl_akhir'] ),
                    'no_skp' => $post['no_skp'][$key],  
                    'id_produk' => $post['id_produk'][$key],   

                   
                );

      }
                
                 $this->skp->update($result);
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
        
        
           $this->db->select('id_skp, datediff(tgl_akhir, current_date()) as selisih');
           $this->db->from('skp');
           $query = $this->db->get();
           if($query->num_rows() > 0)
           {
              foreach ($query->result() as $dt) {

                    $this->db->set('berlaku', $dt->selisih);
                    $this->db->where('id_skp', $dt->id_skp);
                    $this->db->update('skp');

               }
               echo json_encode(array("status" => TRUE));
           }else{
              echo json_encode(array("status" => FALSE));
           }

       }
       */

}
