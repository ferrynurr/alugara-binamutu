<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_skp extends CI_Model {

  //var $table = 'kpc as k, pegawai as p';
    var $column = array('a.no_skp', 'b.nama_upi', 'c.nama_produk', 'a.jenis_skp', 'a.tgl_keluar', 'a.tgl_akhir', 'a.berlaku');
    var $order = array('a.no_skp' => 'desc');
    var $column_order = array(null, 'a.no_skp', 'b.nama_upi', 'c.nama_produk', 'a.jenis_skp', 'a.tgl_keluar', 'a.tgl_akhir', 'a.berlaku',  null);

    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    public function _get_datatables_query($id)
    {
     
      $this->db->select('a.*, b.nama_upi, c.nama_produk');
      $this->db->from('skp as a');
      $this->db->join('upi as b', 'b.id_upi = a.id_upi','left');
      $this->db->join('produk as c', 'c.id_produk = a.id_produk','left');

      if($id == 'akan_habis')
      {
        $this->db->where('a.berlaku >=', '0');
        $this->db->where('a.berlaku <=', '60');
      }

      if($id == 'habis'){
        $this->db->where('a.tgl_akhir <', date("Y-m-d"));
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

    function get_datatables($data_get)
    {
        $this->_get_datatables_query($data_get);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($data_get)
    {
        $this->_get_datatables_query($data_get);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($data_get)
    {
        $this->_get_datatables_query($data_get);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
       
      $this->db->select('a.*, b.nama_upi, c.nama_produk');
      $this->db->from('skp as a');
      $this->db->join('upi as b', 'b.id_upi = a.id_upi','left');
      $this->db->join('produk as c', 'c.id_produk = a.id_produk','left');
      $this->db->where('a.id_skp', $id);
      
       $query = $this->db->get();

        return $query->row();
    }



    public function save($data = array()) //save produk
    {
      $total_array = count($data);
 
      if($total_array != 0)
      {
        $this->db->insert_batch('skp', $data);
        return $this->db->insert_id();
      }
        
    }

    public function update($data = array())
    {
       $total_array = count($data);
 
      if($total_array != 0){
      

       // $this->db->where('id_skp', $id);
        $this->db->update_batch('skp', $data, 'id_skp');

        return true;
      }

    }

    public function delete_by_id($id)
    {
        $this->db->where('id_skp', $id);
        $this->db->delete('skp');
    }

    public function get_produk()
    {
          $this->db->order_by('nama_produk', 'asc');
          return $this->db->get('produk')->result();
    }
    public function get_upi()
    {
          $this->db->order_by('nama_upi', 'asc');
          return $this->db->get('upi')->result();
    }

}
