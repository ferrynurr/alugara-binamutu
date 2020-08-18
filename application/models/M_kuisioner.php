<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kuisioner extends CI_Model {

  //var $table = 'kpc as k, pegawai as p';
    var $column = array('a.nama_klausul', 'b.nama_aspek','c.mn', 'c.mj', 'c.sr', 'c.kr', 'c.keterangan');
    var $order = array('a.nama_klausul' => 'desc');
    var $column_order = array(null, 'a.nama_klausul', 'b.nama_aspek', 'c.mn', 'c.mj', 'c.sr', 'c.kr', 'c.keterangan', null);

    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    private function query(){
      $this->db->select('a.nama_klausul, b.nama_aspek, c.*');
      $this->db->from('kuisioner as c');
      $this->db->join('kuisioner_aspek as b', 'b.id_aspek = c.id_aspek','left');
      $this->db->join('kuisioner_klausul as a', 'a.id_klausul = b.id_klausul','left');
    }

    public function _get_datatables_query()
    {
        $this->query();
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

    function get_datatables($id)
    {
        $this->_get_datatables_query();
        $this->db->where('c.id_pembinaan', $id);

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($id)
    {
        $this->_get_datatables_query();
        $this->db->where('c.id_pembinaan', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($id)
    {
        $this->_get_datatables_query();
        $this->db->where('c.id_pembinaan', $id);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
       
     $this->query();
      $this->db->where('c.id_kuisioner',$id);
          $query = $this->db->get();

        return $query->row();
    }



   public function save($data)
    {

        $this->db->insert('kuisioner', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('kuisioner_aspek', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_kuisioner', $id);
        $this->db->delete('kuisioner');
    }

    public function get_datalaporan($id)
    {
      $this->query();
      $this->db->order_by('b.id_klausul', 'asc');
      $this->db->where('c.id_pembinaan', $id);
      $data = $this->db->get();
      return $data;
    }

}
