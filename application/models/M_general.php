<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_general extends CI_Model {
    protected $table = array('1' => 'general','2' => 'transaksi');

    public function __construct(){
      parent::__construct();
    }

    //halaman backend
    public function Harga(){
        $this->db->select('gid, gharga');
        $this->db->from($this->table[1]);
        $this->db->where('gstatus', 1);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SaveHarga($id,$data) {
        $this->db->where('gid',$id);
        $this->db->update('general',$data);
    }

    public function PotonganPembelian(){
        $this->db->select('gid, gdiskon, gqty, gstatus');
        $this->db->from($this->table[1]);
        $this->db->where('gstatus', 2);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailPotongan($id){
        $this->db->select('gid, gdiskon, gqty');
        $this->db->from($this->table[1]);
        $this->db->where('gid', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SavePotongan($data){
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditPotongan($id, $data) {
        $this->db->where('gid',$id);
        $this->db->update('general',$data);

        return $data;
    }

    public function HapusPotongan($id){
        $this->db->set('gstatus', 0);
        $this->db->where('gid',$id);
        $this->db->update($this->table[1]);
    }

    public function PengeluaranBulanan(){
        $this->db->select('gid, gname, gharga, gperiode');
        $this->db->from($this->table[1]);
        $this->db->where('gstatus', 8);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailPengeluaran($id){
        $this->db->select('g.gid, g.gname, g.gdolar, g.grate, g.gharga, g.gketerangan, g.gketerangan2, g.gperiode, g.gdate, t.tnomor');
        $this->db->from($this->table[1].' as g');
        $this->db->join($this->table[2].' as t','t.tdate = g.gdate','left');
        $this->db->where('gid', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SavePengeluaran($data){
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditPengeluaran($id, $data) {
        $this->db->where('gid',$id);
        $this->db->update('general',$data);

        return $data;
    }

    public function HapusPengeluaran($id){
        $this->db->set('gstatus', 0);
        $this->db->where('gid',$id);
        $this->db->update($this->table[1]);
    }

    public function CekPotongan($jumlah){  
        $this->db->select('gdiskon');
        $this->db->from($this->table[1]);
        $this->db->where('gstatus', 2);
        $this->db->where('gqty', $jumlah);

        $data = $this->db->get()->num_rows();
        return $data;    
    }

    public function SearchHarga(){
        $this->db->select('gharga');
        $this->db->from($this->table[1]);
        $this->db->where('gstatus', 1);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SearchPotongan($jumlah){
        $this->db->select('gdiskon, gqty');
        $this->db->from($this->table[1]);
        $this->db->where('gstatus', 2);
        $this->db->where('gqty', $jumlah);

        $data = $this->db->get()->row();
        return $data;
    }
    
    public function ReportBiayaOperasional($dari,$sampai){
        $this->db->select('gname, gdolar, grate, gharga, gketerangan, gketerangan2, gperiode');
        $this->db->from($this->table[1]);
        $this->db->where('gstatus', 8);
        if($dari != '1970-01-01'){
            $this->db->where('gperiode >=', $dari);
        }
        if($sampai != '1970-01-01'){
            $this->db->where('gperiode <=', $sampai);
        }else{
            $this->db->where('gperiode <=', '2020-12-13');
        }

        $data = $this->db->get()->result();
        return $data;
    }
}