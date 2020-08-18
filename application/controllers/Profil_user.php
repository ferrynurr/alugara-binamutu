<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil_user extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if(empty($this->session->userdata('nippos'))) {
             redirect('login');
         }else{
             $this->load->model('home/m_profil_user','profil');
              $this->load->helper('url');
       }
     }

    public function index()
    {

     $this->load->view('home/v_profil_user');
    }

    public function getUser()
     {
          $data = $this->profil->get_by_id($this->session->userdata('nippos') );
           // $this->session->set_userdata('edit_val','edit');
           echo json_encode($data);
     }


  public function updateUser()
      {
                  $data = array(
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'ttl' => $this->input->post('ttl'),
                    'jkl' => $this->input->post('jkl'),
                    'status_pg' => $this->input->post('status_pg'),
                    'jabatan' => $this->input->post('jabatan'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    );

                  if( $this->profil->updatePegawai(array('nippos' => $this->session->userdata('nippos') ), $data) ){
                    $this->session->set_userdata('namak', $this->input->post('nama') );
                    //  $status_req['status'] = "Sukses";
                  }



                  if($this->input->post('password') != null || $this->input->post('password_conf') != null || $this->input->post('password_lama') != null)
                  {

                      $status_user = $this->profil->val_userlama( $this->input->post('password_lama') );
                      if($status_user->num_rows() > 0)
                       {
                              if($this->input->post('username') ){
                              $data2['username'] = $this->input->post('username');
                             }

                              if($this->input->post('password') ){
                                  $data2['password'] = md5($this->input->post('password'));
                              }


                              if( $this->profil->updateUser(array('nippos' => $this->session->userdata('nippos') ), $data2) )
                              {
                              //  $this->session->unset_userdata('username');
                                $this->session->set_userdata('username', $this->input->post('username') );

                              }
                              //  $status_req['status'] = "Sukses";

                            //  echo "<script type='text/javascript'>alert('$msg2');</script>";


                        }else{
                              //  $status_req['status'] = "Gagal";

                              echo json_encode(array("status" => FALSE));
                        }

                     }
              // echo json_encode($status_req);
                echo json_encode(array("status" => TRUE));

    }

}
