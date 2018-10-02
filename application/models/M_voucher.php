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
        $this->db->where('status_voucher', 1);
        $this->db->where('kode_voucher', $id);

        $data = $this->db->get()->row();
        return $data;
    }


    //backend
    public function Voucher(){
        $this->db->select('id_voucher, kode_voucher, aktif_voucher, nonaktif_voucher, potongan_voucher');
        $this->db->from($this->table[1]);
        $this->db->where('status_voucher', 1);

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
        $this->db->where('status_voucher', 1);
        $this->db->where('id_voucher', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditVoucher($id, $data) {
        $this->db->where('id_voucher',$id);
        $this->db->update('voucher',$data);

        return $data;
    }

    public function HapusVoucher($id){
        $this->db->set('status_voucher', 0);
        $this->db->where('id_voucher',$id);
        $this->db->update($this->table[1]);
    }

}