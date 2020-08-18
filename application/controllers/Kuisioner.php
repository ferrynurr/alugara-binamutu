<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuisioner extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_kuisioner','kuis');
            $this->load->model('m_skp','skp');


     }

    public function index()
    {

      $data = array('header_judul' => 'Kuisioner Pembinaan',
                    'data_upi'     => $this->skp->get_upi(),
                    'upi_selected' => '',
              );

     $this->load->view('v_kuisioner', $data);

    }

    public function tambah()
    {
     
      $data = array( 'header_judul'  => 'Kuisioner Pembinaan',
                     'nama_upi'     =>  $this->input->get('nama_upi'),
                     'id_bina'      =>  $this->input->get('id_pembinaan'),
                     'klausul'      =>  $this->db->order_by('id_klausul', 'asc')->get('kuisioner_klausul'),
              );

       $this->load->view('v_kuisioner_tambah', $data);
    }

  public function get_klausul($id_klausul){
    $this->db->order_by('nama_aspek');
    $this->db->where('id_klausul', $id_klausul);
    $data = $this->db->get('kuisioner_aspek');

    echo json_encode($data->result());
  }

  public function get_aspek($id_aspek){
    $this->db->where('id_aspek', $id_aspek);
    $data = $this->db->get('kuisioner_aspek');

    echo json_encode($data->row());
  }


 
   public function question(){
        $quis = $this->kuis->get_kuis();
        $data = array();
        $no = 0;
        foreach ($quis as $field) {
          $no++;
          $row = array();

          $row[] = $no;
          $row[] = $field->nama_aspek;


          $data[] = $row;
        }

        $output = array(

                "data" => $data,
            );
        //output to json format
        echo json_encode($output);
 }

  public function ajax_list($id)
   {

    		$list = $this->kuis->get_datatables($id);
    		$data = array();

    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();
          $row[] = $no;
    			$row[] = $field->nama_klausul;
    		  $row[] = $field->nama_aspek;
          $row[] = $field->mn;
          $row[] = $field->mj;
          $row[] = $field->sr;
          $row[] = $field->kr;
          $row[] = $field->keterangan;   
          $row[] = date('d F Y', strtotime($field->tgl_tindak_lanjut));   

    			$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_kuisioner."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->kuis->count_all($id),
    						"recordsFiltered" => $this->kuis->count_filtered($id),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    }

  public function ajax_add()  // add produk
  {
      $data = array(
                'id_aspek' => $this->input->post('id_aspek'),
                'keterangan' => $this->input->post('keterangan'),
                'id_pembinaan' => $this->input->post('id_pembinaan'),
                'tgl_tindak_lanjut' => $this->input->post('tgl_tindak_lanjut'),
            );




      if($this->input->post('minor'))
        $data['mn'] = $this->input->post('minor');
      if($this->input->post('major'))
        $data['mj'] = $this->input->post('major');
      if($this->input->post('serius'))
        $data['sr'] = $this->input->post('serius');
      if($this->input->post('kritis'))
        $data['kr'] = $this->input->post('kritis');

        $insert = $this->kuis->save($data);
        echo json_encode(array("status" => TRUE));
  }


  public function ajax_delete($id)
   {
       $this->kuis->delete_by_id($id);
       echo json_encode(array("status" => TRUE));
   }

   public function ajax_view($id)
      {
                $data = $this->aspek->get_by_id($id);
                echo json_encode($data);
      }

    public function ajax_update()
       {
                   
         $data = array(
                'nama_aspek' => $this->input->post('nama_aspek'),
                'id_klausul' => $this->input->post('id_klausul')

          );

             $this->aspek->update(array('id_aspek' => $this->input->post('id_aspek')), $data);
             echo json_encode(array("status" => TRUE));

       }
   public function get_upi($id)
      {
                $this->db->select('e.nama_upi');
                $this->db->from('pembinaan as a');
                $this->db->join('upi as e', 'e.id_upi = a.id_upi','left');
                $this->db->where('a.id_pembinaan', $id);
                $data = $this->db->get()->row();
                echo json_encode($data);
      }

  public function cetak($id)
  {
    $upi = $this->input->get('nama_upi');

    $this->load->library('pdf');
    
    $this->db->where('id_pembinaan', $id);
    $this->db->where('mn', 'X');
    $minor = $this->db->get('kuisioner');

    $this->db->where('id_pembinaan', $id);
    $this->db->where('mj', 'X');
    $major = $this->db->get('kuisioner');

    $this->db->where('id_pembinaan', $id);
    $this->db->where('sr', 'X');
    $serius = $this->db->get('kuisioner');

    $this->db->where('id_pembinaan', $id);
    $this->db->where('kr', 'X');
    $kritis = $this->db->get('kuisioner');

    $mn = $minor->num_rows();
    $mj = $major->num_rows();
    $sr = $serius->num_rows();
    $kr = $kritis->num_rows();

    if($kr >= 1)
    {
      $grade ='D (Gagal)';
    }
    elseif($kr == 0) 
    {
        if($sr >= 5)
        {
            $grade ='D (Gagal)';
        }
        elseif($sr >= 3 && $sr <= 4) {
            $grade = 'C (Cukup)';
        }
        elseif($sr >= 1 && $sr <= 2) {
            $grade = 'B (Baik)';
        }
        elseif($sr == 0) {
            if($mj >= 11)
            {
              $grade = 'C (Cukup)';
            }
            elseif($mj >= 6 && $mj <= 10) {
              $grade = 'B (Baik)';
            }
            elseif($mj >= 0 && $mj <= 5) {
              $grade = 'A (Baik Sekali)';
            }
        }
     
    }

    $data_laporan = $this->kuis->get_datalaporan($id);

    $data  = array('id_pembinaan'  =>  $id, 
                    'nama_upi'     =>  $upi,
                    'data_laporan' =>  $data_laporan,
                    'jum_minor'    =>  $minor->num_rows(),
                    'jum_major'    =>  $major->num_rows(),
                    'jum_serius'   =>  $serius->num_rows(),
                    'jum_kritis'   =>  $kritis->num_rows(),
                    'grade'        =>  $grade,
  );


    $this->pdf->setPaper('A4', 'landscape');
    $this->pdf->filename = "[Hasil Kuisioner] ".base64_decode($upi).".pdf";
    $this->pdf->load_view('pdf/laporan_kuisioner', $data);
  }
 

}
