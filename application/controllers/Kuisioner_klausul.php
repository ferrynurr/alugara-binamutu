<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuisioner_klausul extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_kuisioner_klausul','klausul');

     }

    public function index()
    {
      $data = array('header_judul' => 'Kuisioner Klausul'
              );

     $this->load->view('v_kuisioner_klausul', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->klausul->get_datatables();
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          $row[] = $no;
    			$row[] = $field->nama_klausul;

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_klausul."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_klausul."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->klausul->count_all(),
    						"recordsFiltered" => $this->klausul->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add produk
        {

            $data = array(
                    'nama_klausul' => $this->input->post('nama_klausul')

                );

                  $insert = $this->klausul->save($data);
                  echo json_encode(array("status" => TRUE));
        }


  public function ajax_delete($id)
         {
             $this->klausul->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->klausul->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
              $data = array(
                    'nama_klausul' => $this->input->post('nama_klausul')

                );
                
                 $this->klausul->update(array('id_klausul' => $this->input->post('id_klausul')), $data);
                 echo json_encode(array("status" => TRUE));

           }

}
