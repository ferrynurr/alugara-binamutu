<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    function __construct() {
        parent::__construct();
        
      //  $this->load->library('encrypt');
    }

    function graph_report(){
        $query = $this->db->query("SELECT peringkat, COUNT(peringkat) AS nilai from upi GROUP BY peringkat");
         
        return $query;
        
    }

    public function count_akhabis() 
    {
        $this->db->where('berlaku >', '0');
        $this->db->where('berlaku <=', '90');
        return $this->db->get('skp')->num_rows();
    }

    public function count_habis() 
    {
       
       $this->db->where('tgl_akhir <', date("Y-m-d"));
        return $this->db->get('skp')->num_rows();
    }


}
