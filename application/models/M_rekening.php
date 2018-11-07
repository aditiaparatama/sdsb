<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_rekening extends CI_Model {
    protected $table = array('1' => 'rekening','2' => 'transaksi');

    public function __construct(){
      parent::__construct();
    }
    //halaman frontend
    public function CariRekening($bank){
        $this->db->select('rid, rbank, rnama, rno, rjenis, rsaldo');
        $this->db->from($this->table[1]);
        $this->db->where('rstatus', 1);
        $this->db->where('rbank', $bank);

        $data = $this->db->get()->row();
        return $data;
    }



    //halaman backend
    public function Rekening(){
        $this->db->select('rid, rbank, rnama, rno, rjenis, rsaldo');
        $this->db->from($this->table[1]);
        $this->db->where('rstatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SaveRekening($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function DetailRekening($no){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('rstatus', 1);
        $this->db->where('rno', $no);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditRekening($id, $data) {
        $this->db->where('rjenis',$id);
        $this->db->update('rekening',$data);

        return $data;
    }

    public function UpdateRekening($id, $data){
        $this->db->where('rid',$id);
        $this->db->update('rekening',$data);

        return $data;
    }

    public function HapusRekening($id){
        $this->db->set('rstatus', 0);
        $this->db->where('rno',$id);
        $this->db->update($this->table[1]);
    }

    public function CekSaldo($id){
        $this->db->select('rsaldo');
        $this->db->from($this->table[1]);
        $this->db->where('rno', $id);

        $data = $this->db->get()->row();
        return $data;    
    }

    public function RekeningTransfer(){
        $this->db->select('rid, rbank, rnama, rno, rsaldo');
        $this->db->from($this->table[1]);
        $this->db->where('rjenis', 2);

        $data = $this->db->get()->row();
        return $data;
    }

    public function RekeningPenerimaTransfer(){
        $this->db->select('rid, rbank, rnama, rno, rjenis, rsaldo');
        $this->db->from($this->table[1]);
        $this->db->where('rstatus', 1);
        $this->db->where('rjenis !=', 2);

        $data = $this->db->get()->result();
        return $data;
    }

    public function RekeningPenerima(){
        $this->db->select('rid, rbank, rnama, rno, rjenis, rsaldo');
        $this->db->from($this->table[1]);
        $this->db->where('rstatus', 1);
        $this->db->where('rjenis !=', 2);

        $data = $this->db->get()->row();
        return $data;
    }

    public function UpdateSaldo($id, $data){
        $this->db->where('rno',$id);
        $this->db->update('rekening',$data);

        return $data;
    }

    public function RiwayatPenerimaanRekening($id){
        $this->db->select('r.rbank, r.rnama, r.rno, r.rsaldo, t.tnomor, t.tgrandtotal, t.tketerangan, t.tdari, t.tdate');
        $this->db->from($this->table[1].' as r');
        $this->db->join($this->table[2].' as t','t.ttujuan = r.rno','left');
        $this->db->where('t.ttujuan',$id);
        $this->db->where('t.tsubjenis',51);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function RiwayatPengeluaranRekening($id){
        $this->db->select('r.rbank, r.rnama, r.rno, r.rsaldo, t.tnomor, t.tgrandtotal, t.tketerangan, t.ttujuan, t.tdate');
        $this->db->from($this->table[1].' as r');
        $this->db->join($this->table[2].' as t','t.trekeningdari = r.rno','left');
        $this->db->where('t.trekeningdari',$id);
        $this->db->where('t.tsubjenis',52);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }
}
