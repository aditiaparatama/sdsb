<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_transfer extends CI_Model {
    protected $table = array('1' => 'transfer','2' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //dashboards
    public function ListTransfer($id){
        $this->db->select('t.id_transfer, t.dari_transfer, t.tujuan_transfer, t.nominal_transfer, t.status_transfer, c.nama_customer');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.id_customer = t.customer_transfer');
        $this->db->where('t.customer_transfer',$id);
        $this->db->where_in('t.status_transfer', [1,3]);

        $data = $this->db->get()->result();
        return $data;
    }



    //backend
    function CTransfer(){      
        $this->db->select('id_transfer');
        $this->db->from($this->table[1]);
        $this->db->where('status_transfer', 1);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function TransferHome($limit){
        $this->db->select('t.tujuan_transfer, t.nominal_transfer, t.status_transfer, c.nama_customer');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.id_customer = t.customer_transfer','left');
        $this->db->where_in('t.status_transfer', [1,3]);
        $this->db->order_by('t.id_transfer', "desc");
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function Transfer(){
        $this->db->select('t.id_transfer, t.dari_transfer, t.tujuan_transfer, t.nominal_transfer, t.status_transfer, t.date_transfer, c.nama_customer');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.id_customer = t.customer_transfer','left');
        $this->db->where_in('t.status_transfer', [1,3]);

        $data = $this->db->get()->result();
        return $data;
    }

    public function UpdateTransfer($id){
        $this->db->set('status_transfer', 1);
        $this->db->where('id_transfer',$id);
        $this->db->update($this->table[1]);
    }

    public function HapusTransfer($id){
        $this->db->set('status_transfer', 0);
        $this->db->where('id_transfer',$id);
        $this->db->update($this->table[1]);
    }

    public function SaveTransfer($data){
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

}