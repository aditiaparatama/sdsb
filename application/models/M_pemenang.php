<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pemenang extends CI_Model {
    protected $table = array('1' => 'pemenang','2' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //backend
    public function PemenangHome($limit) {
        $this->db->select('pnomor, pperiode');
        $this->db->from($this->table[1]);
        $this->db->where('pstatus', 1);
        $this->db->group_by('pperiode'); 
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function Pemenang() {
        $this->db->select('p.pid, p.pperiode, p.pnomor, p.porder, c.cnama');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','c.cid = p.pcustomer','left');
        $this->db->where('p.pstatus', 1);
        $this->db->group_by('p.pperiode'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function GroupPemenang($id) {
        $this->db->select('p.pid, p.pperiode, p.pnomor, p.porder, c.cnama');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','c.cid = p.pcustomer','left');
        $this->db->where('p.pstatus', 1);
        $this->db->where('p.pperiode', $id);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SavePemenang($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function Detail($id,$order){
        $this->db->select('pid, pperiode, pnomor');
        $this->db->from($this->table[1]);
        $this->db->where('pstatus', 1);
        $this->db->where('pperiode', $id);
        $this->db->where('porder', $order);

        $data = $this->db->get()->row();
        return $data;
    }

    public function DetailGroup($id){
        $this->db->select('pid, pnomor');
        $this->db->from($this->table[1]);
        $this->db->where('pstatus', 1);
        $this->db->where('pid', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditGroupPemenang($id, $data) {
        $this->db->where('pid',$id);
        $this->db->update('pemenang',$data);

        return $data;
    }

    public function ExcelPemenang() {
        $this->db->select('p.pid, p.pperiode, p.pnomor, p.porder, c.cnama');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','c.cid = p.pcustomer','left');
        $this->db->where('p.pstatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }
}