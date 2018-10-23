<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_brand extends CI_Model {
    protected $table = array('1' => 'brand');

    public function __construct(){
      parent::__construct();
    }

    //halaman backend
    public function CBrand($where){      
        return $this->db->get_where($this->table[1], $where);
    }
    public function Brand(){
        $this->db->select('bid, bnama, burl, bfoto');
        $this->db->from($this->table[1]);
        $this->db->where('bstatus', 1);
        $this->db->where('bparent', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SingleBrand($id){
        $this->db->select('bid, bnama');
        $this->db->from($this->table[1]);
        $this->db->where('bstatus', 1);
        $this->db->where('bparent', 1);
        $this->db->where('bid', $id);

        $data = $this->db->get()->result();
        return $data;
    }

    public function GroupBrand($id){
        $this->db->select('bid, bnama');
        $this->db->from($this->table[1]);
        $this->db->where('bstatus', 1);
        $this->db->where('bchild', $id);

        $data = $this->db->get()->result();
        return $data;
    }

    public function CariBrand($where){      
        $this->db->select('bid, bnama, bfield1, bfield2, bfield3');
        $this->db->from($this->table[1]);
        $this->db->where($where);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SubBrand(){
        $this->db->select('bid, bnama, bchild');
        $this->db->from($this->table[1]);
        $this->db->where('bstatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }    

    public function SaveBrand($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditBrand($id){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('bstatus', 1);
        $this->db->where('bid', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditBrandAct($id, $data) {
        $this->db->where('bid',$id);
        $this->db->update($this->table[1],$data);

        return $data;
    }

    public function HapusBrand($id){
        $this->db->set('bstatus', 0);
        $this->db->where('bid',$id);
        $this->db->update($this->table[1]);
    }
}