<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_user','user');

     }

    public function admin()
    {
      $data = array('header_judul' => 'Biodata Admin'
              );

     $this->load->view('v_user', $data);

    }

    public function pembina()
    {
      $data = array('header_judul' => 'Biodata Pembina'
              );

     $this->load->view('v_user', $data);

    }


  public function ajax_list($level)
    	{

    		$list = $this->user->get_datatables($level);
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $user) {
    			$no++;
    			$row = array();

          $row[] = $no;
    			$row[] = $user->nama;
    			$row[] = $user->alamat;
    			$row[] = $user->jkl;
          $row[] = $user->no_telp;
				  $row[] = $user->email;
          $row[] = '<a class="btn btn-sm btn-success" href="javascript:void()" title="Detail" onclick="view_user('."'".$user->id_user."'".')">'.$user->username.' <i class="fa fa-angle-double-down" aria-hidden="true"></i></a>';
    		
    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_user('."'".$user->id_user."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_user('."'".$user->id_user."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->user->count_all($level),
    						"recordsFiltered" => $this->user->count_filtered($level),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()
        {

            $data = array(
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'jkl' => $this->input->post('jkl'),
                    'no_telp' => $this->input->post('no_telp'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    //'password' => $this->encrypt->encode($this->input->post('password'), $key),//
                    'password' =>  md5($this->input->post('password')),
                    'level' => $this->input->post('level'),

                );

                  $insert = $this->user->save($data);
                  echo json_encode(array("status" => TRUE));


        }

  public function ajax_delete($id)
         {
             $this->user->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->user->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
              $data = array(
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'jkl' => $this->input->post('jkl'),
                    'no_telp' => $this->input->post('no_telp'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    //'password' =>  md5($this->input->post('password')),
                    'level' => $this->input->post('level'),

                );
                
                 $this->user->update(array('id_user' => $this->input->post('id_user')), $data);
                 echo json_encode(array("status" => TRUE));

           }

}
