<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trigger_update extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
           // $this->load->model('m_skp','skp');

     }

       public function hitung_skp(){
        
         // $query = $this->db->query('select id_skp, datediff(tgl_akhir, current_date()) as selisih from skp');

           $this->db->select('id_skp, datediff(tgl_akhir, current_date()) as selisih');
           $this->db->from('skp');
           $query = $this->db->get();
/*
          foreach ($query->result() as $dt) {

                $this->db->set('berlaku', $dt->selisih);
                $this->db->where('id_skp', $dt->id_skp);
                $this->db->update('skp');

           } */

          echo json_encode($query->result());
       
       }  

       function puser()
       {
          

           $this->load->library('pusher');
          $this->pusher->trigger('my-channel', 'my-event', array('sayang' => 'Hello World'));
       }  

}
