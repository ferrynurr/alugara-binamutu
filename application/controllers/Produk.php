<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_produk','produk');

     }

    public function index()
    {
      $data = array('header_judul' => 'Produk & Olahan',
                    'jenis_olahan' => $this->produk->get_jenis(),
                    'jenis_selected' => ''
              );

     $this->load->view('v_produk', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->produk->get_datatables();
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          $row[] = $no;
    			$row[] = $field->nama_produk;
    		  $row[] = $field->nama_olahan;
    		  $row[] = $field->ket;

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_produk."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_produk."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->produk->count_all(),
    						"recordsFiltered" => $this->produk->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add produk
        {

            $data = array(
                    'nama_produk' => $this->input->post('nama_produk'),
                    'id_olahan' => $this->input->post('id_olahan'),
                    'ket' => $this->input->post('ket')

                );

                  $insert = $this->produk->save($data);
                  echo json_encode(array("status" => TRUE));
        }

  public function ajax_add2()  //add olahan
        {

            $data = array(
                    'nama_olahan' => $this->input->post('nama_olahan2')
                    

                );

                  $insert = $this->produk->save2($data);
                  echo json_encode(array("status" => TRUE));
        }

  public function ajax_delete($id)
         {
             $this->produk->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->produk->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
               $data = array(
                    'nama_produk' => $this->input->post('nama_produk'),
                    'id_olahan' => $this->input->post('id_olahan'),
                    'ket' => $this->input->post('ket')

                );
                
                 $this->produk->update(array('id_produk' => $this->input->post('id_produk')), $data);
                 echo json_encode(array("status" => TRUE));

           }

}
