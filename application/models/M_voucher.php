<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_voucher extends CI_Model {
    protected $table = array('1' => 'voucher');

    public function __construct(){
      parent::__construct();
    }

    //dashboard
    public function SearchVoucher($id){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('vstatus', 1);
        $this->db->where('vkode', $id);

        $data = $this->db->get()->row();
        return $data;
    }


    //halaman backend
    public function Voucher(){
        $this->db->select('vid, vkode, vawal, vakhir, vpotongan');
        $this->db->from($this->table[1]);
        $this->db->where('vstatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SaveVoucher($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function DetailVoucher($id){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('vstatus', 1);
        $this->db->where('vid', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditVoucher($id, $data) {
        $this->db->where('vid',$id);
        $this->db->update('voucher',$data);

        return $data;
    }

    public function HapusVoucher($id){
        $this->db->set('vstatus', 0);
        $this->db->where('vid',$id);
        $this->db->update($this->table[1]);
    }
}