<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_upi_sertifikat extends CI_Model {

  //var $table = 'kpc as k, pegawai as p';
    var $column = array('a.no_sertifikat', 'b.nama_sertifikat', 'c.nama_upi', 'a.tgl_kadaluwarsa', 'a.berlaku');
    var $order = array('a.no_sertifikat' => 'desc');
    var $column_order = array(null, 'a.no_sertifikat', 'b.nama_sertifikat', 'c.nama_upi', 'a.tgl_kadaluwarsa', 'a.berlaku', null);

    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    public function _get_datatables_query()
    {
     
      $this->db->select('a.*, b.nama_sertifikat, c.nama_upi');
      $this->db->from('sertifikat as a');
      $this->db->join('sertifikat_detail as b', 'b.id_detail = a.id_detail','left');
      $this->db->join('upi as c', 'c.id_upi = a.id_upi','left');

      if($this->session->userdata('status_sertif') == 'akan_habis')
      {
        $this->db->where('a.berlaku >=', '0');
        $this->db->where('a.berlaku <=', '60');
      }

      if( $this->session->userdata('status_sertif') == 'habis'){
        $this->db->where('a.tgl_kadaluwarsa <', date("Y-m-d"));
      }

        $i = 0;

        foreach ($this->column as $item)
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->where($item, $_POST['search']['value']) : $this->db->or_where($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
       
      $this->db->select('a.*, b.nama_sertifikat, c.nama_upi');
      $this->db->from('sertifikat as a');
      $this->db->join('sertifikat_detail as b', 'b.id_detail = a.id_detail','left');
      $this->db->join('upi as c', 'c.id_upi = a.id_upi','left');
      $this->db->where('a.id_sertifikat', $id);
      
       $query = $this->db->get();

        return $query->row();
    }



    public function save($data) //save produk
    {
        $this->db->insert('sertifikat', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('sertifikat', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_sertifikat', $id);
        $this->db->delete('sertifikat');
    }

    public function get_detail_sertifikat()
    {
          $this->db->order_by('nama_sertifikat', 'asc');
          return $this->db->get('sertifikat_detail')->result();
    }
    public function get_upi()
    {
          $this->db->order_by('nama_upi', 'asc');
          return $this->db->get('upi')->result();
    }

}
