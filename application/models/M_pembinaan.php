<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembinaan extends CI_Model {

  //var $table = 'kpc as k, pegawai as p';
    var $column = array('a.tgl_pembinaan', 'a.sisa_hari', 'b.nama_upi', 'c.nama', 'a.pimpinan', 'a.status');
    var $order = array('a.tgl_pembinaan' => 'desc');
    var $column_order = array(null, 'a.tgl_pembinaan', 'a.sisa_hari', 'b.nama_upi', 'c.nama', 'a.pimpinan', 'a.status', null);

    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    public function _get_datatables_query()
    {
     
      $this->db->select('a.*, b.nama_upi, c.nama');
      $this->db->from('pembinaan as a');
      $this->db->join('user as c', 'c.id_user = a.id_user','left');
      $this->db->join('upi as b', 'b.id_upi = a.id_upi','left');

      if($this->session->userdata('sisa_hari') == 'akan_habis')
      {
        $this->db->where('a.sisa_hari >=', '0');
        $this->db->where('a.sisa_hari <=', '60');
        $this->db->where('a.status', 'belum pembinaan');
      }

      if( $this->session->userdata('sisa_hari') == 'habis'){
        $this->db->where('a.tgl_pembinaan <', date("Y-m-d"));
        $this->db->where('a.status', 'belum pembinaan');
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
       
      $this->db->select('a.*, b.nama_upi, c.nama');
      $this->db->from('pembinaan as a');
      $this->db->join('user as c', 'c.id_user = a.id_user','left');
      $this->db->join('upi as b', 'b.id_upi = a.id_upi','left');
      $this->db->where('a.id_pembinaan', $id);
      
       $query = $this->db->get();

        return $query->row();
    }



    public function save($data) //save produk
    {
        $this->db->insert('pembinaan', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('pembinaan', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_pembinaan', $id);
        $this->db->delete('pembinaan');
    }

    public function get_user()
    {
          $this->db->order_by('nama', 'asc');
          $this->db->where('level', 'pembina');
          return $this->db->get('user')->result();
    }
    public function get_upi()
    {
          $this->db->order_by('nama_upi', 'asc');
          return $this->db->get('upi')->result();
    }

}
