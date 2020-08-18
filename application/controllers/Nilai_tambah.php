<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_tambah extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_nilai_tambah','ntb');

     }

    public function index()
    {
      $data = array('header_judul' => 'Nilai Tambah',
                    'jenis_produk' => $this->ntb->get_produk(),
                    'nama_upi'     => $this->ntb->get_upi(),
                    'upi_selected' => '',
                    'produk_selected' => ''
              );

     $this->load->view('v_nilai_tambah', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->ntb->get_datatables();
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

              $row[] = $no;
    		  $row[] = $field->nama_produk;
    		  $row[] = $field->nama_upi;
    		  $row[] = $field->harga_bahan_baku;
    		  $row[] = $field->randemen_produk;
    		  $row[] = $field->uraian;

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_ntb."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_ntb."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->ntb->count_all(),
    						"recordsFiltered" => $this->ntb->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add 
        {

            $data = array(
                    'id_produk'         => $this->input->post('id_produk'),
                    'id_upi'            => $this->input->post('id_upi'),
                    'harga_bahan_baku'  => $this->input->post('harga_bahan_baku'),
                    'randemen_produk'   => $this->input->post('randemen_produk'),
                    'uraian'            => $this->input->post('uraian'),

                );

                 $this->ntb->save($data);
                  echo json_encode(array("status" => TRUE));
        }


  public function ajax_delete($id)
         {
             $this->ntb->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->ntb->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
                $data = array(
                    'id_produk'         => $this->input->post('id_produk'),
                    'id_upi'            => $this->input->post('id_upi'),
                    'harga_bahan_baku'  => $this->input->post('harga_bahan_baku'),
                    'randemen_produk'   => $this->input->post('randemen_produk'),
                    'uraian'            => $this->input->post('uraian'),

                );
                
                 $this->ntb->update(array('id_ntb' => $this->input->post('id_ntb')), $data);
                 echo json_encode(array("status" => TRUE));

           }

}
