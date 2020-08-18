<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    function __construct() {
        parent::__construct();
        
      //  $this->load->library('encrypt');
    }

    public function validate_user($data) 
    {
        $this->db->where('username', $data['username']);
        $this->db->where('password', md5($data['password']));
      //  $this->db->where('password', $this->encrypt->decode($data['password'], $key ));
        return $this->db->get('user')->row();
    }

    public function set_log($user)
    {
       $realIP = file_get_contents("http://ipecho.net/plain");
       
        $data = array( 'ip_address'  =>$realIP,
                       'user_agent'  =>  $_SERVER['HTTP_USER_AGENT'],
                        'last_login' => date('Y-m-d H:i:s')
                     );

        $this->db->where('username', $user);
        $this->db->update('user', $data);
    }


}
