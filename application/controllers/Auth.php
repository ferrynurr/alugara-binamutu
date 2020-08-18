<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() {
			parent::__construct();

			$this->load->model('m_auth', 'login');
			
	}

	public function index()
	{
		if($this->session->userdata('status') == null ) {
	           
	           $this->load->view('v_login');

	        }else{
	        	redirect('dashboard');
	        }
					

	}


 function login() 
 	{
		if($_POST)
			{

		    	 $result = $this->login->validate_user($_POST);
				 if(!empty($result)) {
				 	
					$this->login->set_log($result->username);
                	$this->update_sisa_skp();
					$this->update_sisa_serifikat();
					$this->update_sisa_bina();
					
					$data = array('status'    => 'login',
								  'username' => $result->username,
								  'level'    => $result->level,
								  'nama'     => $result->nama,
								  'email'     => $result->email

					 			);
					$this->session->set_userdata($data);

					
					 redirect('dashboard');
				 } else {

					 $this->session->set_flashdata('pesan',
					 '
					 <center>
					 <span class="label label-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Kombinasi Username & Password tidak sesuai !</span>
					 </center>

					 ');
						redirect('auth');

				 }
			 }else{
			 	redirect('notfound');
			 }

				
	}
	
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
              
           }
            return true;
       }
       
 public function update_sisa_serifikat(){
        
           $this->db->select('id_sertifikat, datediff(tgl_kadaluwarsa, current_date()) as selisih');
           $this->db->from('sertifikat');
           $query = $this->db->get();
           if($query->num_rows() > 0)
           {
              foreach ($query->result() as $dt) {

                    $this->db->set('berlaku', $dt->selisih);
                    $this->db->where('id_sertifikat', $dt->id_sertifikat);
                    $this->db->update('sertifikat');

               }
               
           }
        return true;
       }
       
  public function update_sisa_bina(){
        
        
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
              
           }
           return true;

       }

	function logout()
	{

		$this->session->sess_destroy();
		redirect('dashboard');
	}

}
