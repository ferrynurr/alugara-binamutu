<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kuisioner_aspek extends CI_Model {

  //var $table = 'kpc as k, pegawai as p';
    var $column = array('a.nama_aspek', 'b.nama_klausul',);
    var $order = array('a.nama_klausul' => 'desc');
    var $column_order = array(null, 'a.nama_aspek', 'b.nama_klausul', null);

    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    public function _get_datatables_query()
    {
     
      $this->db->select('a.*, b.*');
      $this->db->from('kuisioner_aspek as a');
      $this->db->join('kuisioner_klausul as b', 'b.id_klausul = a.id_klausul','left');


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
       
      $this->db->select('a.*, b.*');
      $this->db->from('kuisioner_aspek as a');
      $this->db->join('kuisioner_klausul as b', 'b.id_klausul = a.id_klausul','left');

          $this->db->where('a.id_aspek',$id);
          $query = $this->db->get();

        return $query->row();
    }



    public function save($data) //save produk
    {
        $this->db->insert('kuisioner_aspek', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('kuisioner_aspek', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_aspek', $id);
        $this->db->delete('kuisioner_aspek');
    }

    public function get_klausul()
    {
          $this->db->order_by('nama_klausul', 'asc');
          return $this->db->get('kuisioner_klausul')->result();
    }

}
