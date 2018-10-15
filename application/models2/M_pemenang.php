<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pemenang extends CI_Model {
    protected $table = array('1' => 'pemenang','2' => 'customer');

    public function __construct(){
      parent::__construct();
    }


    //backend
    public function PemenangHome($limit) {
        $this->db->select('p.nomor_pemenang, c.nama_customer');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','p.customer_pemenang = c.id_customer','left');
        $this->db->where('p.status_pemenang', 1);
        $this->db->group_by('tanggal_pemenang'); 
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function Pemenang() {
        $this->db->select('p.id_pemenang, p.tanggal_pemenang, p.nomor_pemenang, p.order_pemenang, c.nama_customer');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','p.customer_pemenang = c.id_customer','left');
        $this->db->where('p.status_pemenang', 1);
 		$this->db->group_by('tanggal_pemenang'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function GroupPemenang($id) {
        $this->db->select('p.id_pemenang, p.tanggal_pemenang, p.nomor_pemenang, p.order_pemenang, c.nama_customer');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','p.customer_pemenang = c.id_customer','left');
        $this->db->where('p.status_pemenang', 1);
        $this->db->where('p.tanggal_pemenang', $id);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SavePemenang($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function Detail($id,$order){
        $this->db->select('id_pemenang, tanggal_pemenang, nomor_pemenang');
        $this->db->from($this->table[1]);
        $this->db->where('status_pemenang', 1);
        $this->db->where('tanggal_pemenang', $id);
        $this->db->where('order_pemenang', $order);

        $data = $this->db->get()->row();
        return $data;
    }

    public function DetailGroup($id){
        $this->db->select('id_pemenang, nomor_pemenang');
        $this->db->from($this->table[1]);
        $this->db->where('status_pemenang', 1);
        $this->db->where('id_pemenang', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditGroupPemenang($id, $data) {
        $this->db->where('id_pemenang',$id);
        $this->db->update('pemenang',$data);

        return $data;
    }

    public function ExcelPemenang() {
        $this->db->select('p.id_pemenang, p.tanggal_pemenang, p.nomor_pemenang, p.order_pemenang, c.nama_customer');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','p.customer_pemenang = c.id_customer','left');
        $this->db->where('p.status_pemenang', 1);

        $data = $this->db->get()->result();
        return $data;
    }

}