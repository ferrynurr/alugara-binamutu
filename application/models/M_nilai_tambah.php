<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nilai_tambah extends CI_Model {

    var $column = array('a.nama_produk', 'b.nama_upi', 'c.harga_bahan_baku', 'c.randemen_produk', 'c.uraian');
    var $order = array('a.nama_produk' => 'desc');
    var $column_order = array(null, 'a.nama_produk', 'b.nama_upi', 'c.harga_bahan_baku', 'c.randemen_produk', 'c.uraian', null);

    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    public function _get_datatables_query()
    {
     
      $this->db->select('a.nama_produk, b.nama_upi, c.*');
      $this->db->from('nilai_tambah as c');
      $this->db->join('produk as a', 'a.id_produk = c.id_produk','left');
      $this->db->join('upi as b', 'b.id_upi = c.id_upi','left');


        $i = 0;

        foreach ($this->column as $item)
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
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
       
          $this->db->select('a.nama_produk, b.nama_upi, c.*');
          $this->db->from('nilai_tambah as c');
          $this->db->join('produk as a', 'a.id_produk = c.id_produk','left');
          $this->db->join('upi as b', 'b.id_upi = c.id_upi','left');
          $this->db->where('c.id_ntb',$id);
          $query = $this->db->get();

        return $query->row();
    }



    public function save($data) //save 
    {
        $this->db->insert('nilai_tambah', $data);
        return $this->db->insert_id();
    }


    public function update($where, $data)
    {
        $this->db->update('nilai_tambah', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_ntb', $id);
        $this->db->delete('nilai_tambah');
    }

    public function get_upi()
    {
          $this->db->order_by('nama_upi', 'asc');
          return $this->db->get('upi')->result();
    }

    public function get_produk()
    {
          $this->db->order_by('nama_produk', 'asc');
          return $this->db->get('produk')->result();
    }

}
