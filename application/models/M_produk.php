<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

  //var $table = 'kpc as k, pegawai as p';
    var $column = array('k.nama_produk', 'p.nama_olahan', 'k.ket');
    var $order = array('k.nama_produk' => 'desc');
    var $column_order = array(null, 'k.nama_produk', 'p.nama_olahan', 'k.ket', null);

    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    public function _get_datatables_query()
    {
     
      $this->db->select('k.*, p.nama_olahan');
      $this->db->from('produk as k');
      $this->db->join('olahan as p', 'p.id_olahan = k.id_olahan','left');


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
       
          $this->db->select('k.*, p.nama_olahan');
          $this->db->from('produk as k');
          $this->db->join('olahan as p', 'p.id_olahan = k.id_olahan','left');
          $this->db->where('k.id_produk',$id);
          $query = $this->db->get();

        return $query->row();
    }



    public function save($data) //save produk
    {
        $this->db->insert('produk', $data);
        return $this->db->insert_id();
    }

   public function save2($data) //save olahan
    {
        $this->db->insert('olahan', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('produk', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('produk');
    }

    public function get_jenis()
    {
          $this->db->order_by('nama_olahan', 'asc');
          return $this->db->get('olahan')->result();
    }

    public function get_produk()
    {
          $this->db->order_by('nama_produk', 'asc');
          return $this->db->get('produk')->result();
    }

}
