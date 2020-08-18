<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_password extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(empty($this->session->userdata('nippos'))) {
						$this->load->model("home/m_forgot_password", "forgot");

				  	 $this->load->library('encrypt');
					  $this->load->helper('form');
						$this->load->library('form_validation');

		}else{
					 redirect('dashboard1');

			 }

	}

	public function index()
	{
					$this->session->sess_destroy();
					$this->load->view('home/v_forgot_password');


	}

	function valemail(){
 	 $result = $this->forgot->validate_user($this->input->post('fgmail'));
 	  if($result->num_rows() > 0){
 	  $this->session->set_userdata('email_sess', $this->input->post('fgmail'));
 	  echo json_encode(array("status" => TRUE));
 	  }

  }

 function token() {
		$token = $this->forgot->setToken($this->input->post('fgmail'));
 	 	 $this->send_mail($token, $this->input->post('fgmail'));
		 echo json_encode(array("status" => TRUE));

 }

  function sendToken() {
		if($_POST || $_POST['token'] != "")
		{

	  $result = $this->forgot->validate_token($_POST);
	    if($result->num_rows() > 0 ){
		   foreach($result->result() as $data){
			   $this->session->set_userdata('sess_user', $data->username);
		   }
			 $this->session->set_userdata('kode_token', $this->input->post('token') );

		   redirect('home/forgot_password/reset_password');
		 }else{
			//echo "<script type='text/javascript'>alert('Token Salah');</script>";

			if(!$this->forgot->validate_token_false($this->session->userdata('email_sess') )){
			$this->session->set_flashdata('token_salah',
					'
					<center>
					<span class="label label-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>
					Token Salah..Silahkan Request Kembali Token Anda</span>
					</center>

					');
			 redirect('home/forgot_password');
			}
		}
	}else{
		if(!$this->forgot->validate_token_false($this->session->userdata('email_sess') )){
		$this->session->set_flashdata('token_salah',
				'
				<center>
				<span class="label label-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>
				Token Salah..Silahkan Request Kembali Token Anda</span>
				</center>

				');
		 redirect('home/forgot_password');
		}
	}

 }



 function reset_password(){
	 if($this->session->userdata('sess_user') == null && $this->session->userdata('email_sess') == null){
		 redirect('home/forgot_password');
	 }else{
	 $this->load->view('home/v_reset_password');
   }
 }

 function input_reset_password(){
	 $data = array(
					 'password' => md5($this->input->post('p_baru_kon')),
			 );

			 $this->forgot->update(array('token' => $this->session->userdata('kode_token')), $data);
			 echo json_encode(array("status" => TRUE));
 }

function session_null(){
	$this->forgot->validate_token_false($this->session->userdata('email_sess'));
	$this->session->sess_destroy();
	redirect('login');
}

 function send_mail($token, $mailto) {

								$config['protocol'] = "smtp";
								$config['smtp_host'] = "smtp.elasticemail.com";
								$config['smtp_port'] = "2525";
								$config['smtp_user'] = "posindo60000@hotmail.com";
								$config['smtp_pass'] = "f897f8c4-487c-4768-a516-dafd18fd6bdb";
								$config['charset'] = "utf-8";
								$config['mailtype'] = "html";
							    $config['newline'] = "\r\n";

								$this->load->library('email', $config);

								$this->email->from('posindo60000@hotmail.com', 'NO-REPLY RESET PASSWORD I-POSINDO');
								$list = $mailto;

								$this->email->to($list);
								$this->email->subject('REQUEST KODE TOKEN');
								$this->email->message('<h2>KODE TOKEN </h2></br></br>


								<form style=" background-color: green; width: 80%; text-align: center;">
										<b style="color: white;">
										<p>&nbsp;</p>
										<p>&#9989; KODE TOKEN : <h2> ' . $token .'</h2></p>

										<p>&nbsp;</p>
										</b>
								</form>

								<p style="color: black;">Abaikan e-mail ini jika anda anda tidak pernah meminta untuk melakukan permintaan RESET PASSWORD</p>
								<p>&nbsp;</p>
								<form style="background-color: #E6E6E6; color: black;">
									Segala bentuk informasi seperti kode token, username, atau password kamu bersifat rahasia. Jangan menginformasikan data-data tersebut kepada siapa pun, termasuk kepada pihak yang mengatasnamakan PT.POS INDONESIA.
								</form>
								<p>&nbsp;</p>
								<p style="color: black;">
									Copyright &copy; '. date('Y') .' PT.POS INDONESIA | All Rights Reserved
								</p>');

								if(!$this->email->send() ){
								echo $this->email->print_debugger();
							}

			}

}
