<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuisioner_aspek extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_kuisioner_aspek','aspek');

     }

    public function index()
    {
      $data = array('header_judul' => 'Kuisioner Aspek',
                    'jenis_klausul' => $this->aspek->get_klausul(),
                    'jenis_selected' => ''
              );

     $this->load->view('v_kuisioner_aspek', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->aspek->get_datatables();
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          $row[] = $no;
    			$row[] = $field->nama_klausul;
    		  $row[] = $field->nama_aspek;
    		 

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_aspek."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_aspek."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->aspek->count_all(),
    						"recordsFiltered" => $this->aspek->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add produk
        {

            $data = array(
                    'nama_aspek' => $this->input->post('nama_aspek'),
                    'id_klausul' => $this->input->post('id_klausul')

                );

                  $insert = $this->aspek->save($data);
                  echo json_encode(array("status" => TRUE));
        }


  public function ajax_delete($id)
         {
             $this->aspek->delete_by_id($id);
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

}
