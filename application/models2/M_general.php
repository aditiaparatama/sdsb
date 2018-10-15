<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_general extends CI_Model {
    protected $table = array('1' => 'general');

    public function __construct(){
      parent::__construct();
    }

    //dashboard
    function CekPotongan($jumlah){  
        $this->db->select('diskon_general');
        $this->db->from($this->table[1]);
        $this->db->where('status_general', 2);
        $this->db->where('qty_general', $jumlah);

        $data = $this->db->get()->num_rows();
        return $data;    
    }

    public function SearchPotongan($jumlah){
        $this->db->select('diskon_general, qty_general');
        $this->db->from($this->table[1]);
        $this->db->where('status_general', 2);
        $this->db->where('qty_general', $jumlah);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SearchHarga(){
        $this->db->select('harga_general');
        $this->db->from($this->table[1]);
        $this->db->where('status_general', 1);

        $data = $this->db->get()->row();
        return $data;
    }


    //backend
    public function Harga(){
        $this->db->select('id_general, harga_general');
        $this->db->from($this->table[1]);
        $this->db->where('status_general', 1);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SaveHarga($id,$data) {
        $this->db->where('id_general',$id);
        $this->db->update('general',$data);
    }

    public function PotonganPembelian(){
        $this->db->select('id_general, diskon_general, qty_general, status_general');
        $this->db->from($this->table[1]);
        $this->db->where('status_general', 2);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailPotongan($id){
        $this->db->select('id_general, diskon_general, qty_general');
        $this->db->from($this->table[1]);
        $this->db->where('id_general', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SavePotongan($data){
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditPotongan($id, $data) {
        $this->db->where('id_general',$id);
        $this->db->update('general',$data);

        return $data;
    }

    public function HapusPotongan($id){
        $this->db->set('status_general', 0);
        $this->db->where('id_general',$id);
        $this->db->update($this->table[1]);
    }






    public function PengeluaranBulanan(){
        $this->db->select('id_general, name_general, harga_general, periode_general');
        $this->db->from($this->table[1]);
        $this->db->where('status_general', 4);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailPengeluaran($id){
        $this->db->select('id_general, name_general, harga_general, periode_general');
        $this->db->from($this->table[1]);
        $this->db->where('id_general', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SavePengeluaran($data){
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditPengeluaran($id, $data) {
        $this->db->where('id_general',$id);
        $this->db->update('general',$data);

        return $data;
    }

    public function HapusPengeluaran($id){
        $this->db->set('status_general', 0);
        $this->db->where('id_general',$id);
        $this->db->update($this->table[1]);
    }


    //report  
    public function ReportPengeluaranBulanan($bulan,$tahun){
        $this->db->select('id_general, name_general, harga_general, periode_general');
        $this->db->from($this->table[1]);
        $this->db->where('status_general', 4);
        $this->db->where('MONTH(periode_general)', $bulan);
        $this->db->where('YEAR(periode_general)', $tahun);

        $data = $this->db->get()->result();
        return $data;
    }
}