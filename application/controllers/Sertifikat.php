<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikat extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_sertifikat','sert');

     }

    public function index()
    {
      $data = array('header_judul' => 'Sertifikat'
              );

     $this->load->view('v_sertifikat', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->sert->get_datatables();
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          $row[] = $no;
    		  $row[] = $field->nama_sertifikat;

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_detail."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_detail."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->sert->count_all(),
    						"recordsFiltered" => $this->sert->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()
        {

            $data = array(
                    'nama_sertifikat' => $this->input->post('nama_sertifikat')
                    

                );

                  $insert = $this->sert->save($data);
                  echo json_encode(array("status" => TRUE));
        }

  public function ajax_delete($id)
         {
             $this->sert->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->sert->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
               $data = array(
                    'nama_sertifikat' => $this->input->post('nama_sertifikat')
                );
                
                 $this->sert->update(array('id_detail' => $this->input->post('id_detail')), $data);
                 echo json_encode(array("status" => TRUE));

           }

}
