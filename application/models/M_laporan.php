<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_upi extends CI_Model {

    var $table = 'upi';
    var $column = array('a.nama_upi', 'a.alamat', 'a.no_telp', 'a.email', 'b.nama_upi_jenis', 'a.peringkat', 'a.skala', 'a.kapasitas_produksi', 'a.realisasi_produksi','a.banyak_coldstorage', 'a.kapasitas_coldstorage', 'a.jumlah_pgl', 'a.jumlah_pgp');
    var $order = array('a.nama_upi' => 'desc');
    var $column_order = array(null, 'a.nama_upi', 'a.alamat', 'a.no_telp', 'a.email', 'b.nama_upi_jenis','a.peringkat', 'a.skala', null);
    public function __construct()
    {
        parent::__construct();
         $this->search = '';

    }


    public function _get_datatables_query()
    {
     
       $this->db->select('a.*, b.nama_upi_jenis');
       $this->db->from('upi as a');
       $this->db->join('upi_jenis as b', 'b.id_upi_jenis = a.id_upi_jenis','left');

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
       
           $this->db->select('a.*, b.nama_upi_jenis');
           $this->db->from('upi as a');
           $this->db->join('upi_jenis as b', 'b.id_upi_jenis = a.id_upi_jenis','left');
          $this->db->where('a.id_upi',$id);
          $query = $this->db->get();

        return $query->row();
    }



    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
  public function save2($data)
    {
        $this->db->insert('upi_jenis', $data);
        return $this->db->insert_id();
    }
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_upi', $id);
        $this->db->delete($this->table);
    }

    public function get_upiJenis()
    {
          $this->db->order_by('nama_upi_jenis', 'asc');
          return $this->db->get('upi_jenis')->result();
    }

   public function data_pdf()
    {
       
           $this->db->select('a.*, b.nama_upi_jenis');
           $this->db->from('upi as a');
           $this->db->join('upi_jenis as b', 'b.id_upi_jenis = a.id_upi_jenis','left');
          //$this->db->where('a.id_upi',$id);
          $query = $this->db->get();

        return $query;
    }

public function get_data_upi($id)
    {
       
           $this->db->select('a.*, b.nama_upi_jenis');
           $this->db->from('upi as a');
           $this->db->join('upi_jenis as b', 'b.id_upi_jenis = a.id_upi_jenis','left');
           if($id != 'all' || $id != null){
                $this->db->where('a.id_upi',$id);
           }
          $query = $this->db->get();

        return $query->result();
    }
}
