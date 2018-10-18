<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_transaksi extends CI_Model {
    protected $table = array('1' => 'transaksi','2' => 'customer','3' => 'rekening', '4' => 'brand');

    public function __construct(){
      parent::__construct();
    }
    //dashboard
        public function ListDeposit($id){
        $this->db->select('t.tnomor, t.tpotongan, t.tgrandtotal, t.tstatus, t.tperiode, t.tdate, c.cnama, c.cdeposit');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer');
        $this->db->where('t.tcustomer',$id);
        $this->db->where('t.tjenis', 1);
        $this->db->where('t.tbrand', 5);
        $this->db->where_in('t.tstatus', [1,2]);

        $data = $this->db->get()->result();
        return $data;
    }





    //halaman backend
    public function CDeposit(){      
        $this->db->select('tid');
        $this->db->from($this->table[1]);
        $this->db->where('tjenis', 1);
        $this->db->where('tstatus', 1);

        $data = $this->db->get()->num_rows();
        return $data;
    }
    
    public function CTransfer(){      
        $this->db->select('tid');
        $this->db->from($this->table[1]);
        $this->db->where('tjenis', 3);
        $this->db->where('tstatus', 1);

        $data = $this->db->get()->num_rows();
        return $data;
    }
    
    public function CariTransaksi($id) {
        $this->db->select('tcustomer');
        $this->db->from($this->table[1]);
        $this->db->where('tkupon ', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function RiwayatCustomerDeposit($id){
        $this->db->select('t.tnomor, t.tgrandtotal, t.tbrand, t.tketerangan, t.tdate, b.bnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[4].' as b','b.bid = t.tbrand','left');
        $this->db->where('c.cemail',$id);
        $this->db->where('t.tsubdeposit',61);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function RiwayatCustomerWithdraw($id){
        $this->db->select('t.tnomor, t.tgrandtotal, t.tbrand, t.tketerangan, t.tdate, b.bnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[4].' as b','b.bid = t.tbrand','left');
        $this->db->where('c.cemail',$id);
        $this->db->where('t.tsubdeposit',62);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function TransaksiPerhari($limit){
        $this->db->select('count(t.tkupon) as jumlah, DATE_FORMAT(t.tdate, "%m/%d/%Y") as date, c.cnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->where('t.tstatus', 1);
        $this->db->order_by('date', "desc");
        $this->db->group_by('date'); 
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function TransaksiKupon($limit){
        $this->db->select('count(t.tkupon) as jumlah, c.cnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer');
        $this->db->where('t.tstatus', 1);
        $this->db->order_by('t.tid', "desc");
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function TransferHome($limit){
        $this->db->select('t.ttujuan, t.tgrandtotal, t.tstatus, c.cnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->where('t.tjenis', 3);
        $this->db->where_in('t.tstatus', [1,2]);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DepositHome($limit){
        $this->db->select('t.ttujuan, t.tgrandtotal, t.tstatus, c.cnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->where('t.tjenis', 1);
        $this->db->where_in('t.tstatus', [1,2]);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function ListTransaksiDetailDebit($id,$where){
        $this->db->select('t.tnomor, t.tgrandtotal, t.ttujuan, t.tketerangan, t.tperiode, r.rnama, r.rbank');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[3].' as r','r.rno = t.ttujuan','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tjenis', 4);
        $this->db->where('t.tsubjenis', 51);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function ListTransaksiDetailKredit($id,$where){
        $this->db->select('t.tnomor, t.tgrandtotal, t.tdari, t.tketerangan, t.tperiode, r.rnama, r.rbank');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[3].' as r','r.rno = t.tdari','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tjenis', 4);
        $this->db->where('t.tsubjenis', 52);
        $this->db->order_by('t.tid', "desc");
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function ListTransaksiDetailPermainan($id,$where){
        $this->db->select('tnomor, twin, tlose, tbonus, tbonus2, tmembercomm, tperiode');
        $this->db->from($this->table[1].' as t');
        $this->db->where('tbrand', $id);
        $this->db->where('tstatus', 1);
        $this->db->where('tjenis', 9);
        // $this->db->where('tsubjenis', 53);
        $this->db->order_by('tid', "desc");
        $this->db->group_by('tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }


    public function ListTransaksiHarianDebit($id){
        $this->db->select('t.tnomor, t.tgrandtotal, t.ttujuan, t.tketerangan, t.tsubjenis, t.tperiode, c.cusersbo, c.cuseribc, c.cuserhorey, c.cusertangkas, c.cuser, r.rnama, r.rbank');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[3].' as r','r.rno = t.ttujuan','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tjenis', 4);
        $this->db->where('t.tsubjenis', 51);
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function ListTransaksiHarianKredit($id){
        $this->db->select('t.tnomor, t.tgrandtotal, t.tdari, t.tketerangan, t.tsubjenis, t.tperiode, c.cusersbo, c.cuseribc, c.cuserhorey, c.cusertangkas, c.cuser, r.rnama, r.rbank');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[3].' as r','r.rno = t.tdari','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tjenis', 4);
        $this->db->where('t.tsubjenis', 52);
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function ListTransaksiHarianPermainan($id){
        $this->db->select('t.tnomor, t.tbonus, t.tbonus2, t.twin, t.tlose, t.tmembercomm, t.tperiode, c.cusersbo, c.cuseribc, c.cuserhorey, c.cusertangkas, c.cuser');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tjenis', 9);
        $this->db->group_by('t.tnomor'); 
        $this->db->order_by('t.tdate'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailTransaksiHarianDebit($id,$nomor){
        $this->db->select('t.tnomor, t.tgrandtotal, t.ttujuan, t.tketerangan, t.tperiode, c.cusersbo, c.cuseribc, c.cuserhorey, c.cusertangkas, c.cuser, r.rnama, r.rbank');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[3].' as r','r.rno = t.ttujuan','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tnomor', $nomor);
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tsubjenis', 51);

        $data = $this->db->get()->row();
        return $data;
    }

    public function DetailTransaksiHarianKredit($id,$nomor){
        $this->db->select('t.tnomor, t.tgrandtotal, t.tdari, t.ttujuan, t.tketerangan, t.tperiode, c.cusersbo, c.cuseribc, c.cuserhorey, c.cusertangkas, c.cuser, c.cbank, c.cnamarek, c.cnorek, r.rnama, r.rbank, r.rsaldo');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[3].' as r','r.rno = t.tdari','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tnomor', $nomor);
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tsubjenis', 52);

        $data = $this->db->get()->row();
        return $data;
    }

    public function DetailTransaksiHarianPermainan($id,$nomor){
        $this->db->select('t.tnomor, t.tgrandtotal, t.tbonus, t.tbonus2, t.twin, tsubbrand, t.tlose, t.tmembercomm, t.tperiode, t.tperiode, c.cusersbo, c.cuseribc, c.cuserhorey, c.cusertangkas, c.cuser');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->where('t.tbrand', $id);
        $this->db->where('t.tnomor', $nomor);
        $this->db->where('t.tstatus', 1);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SaveTransaksi($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }
    
    public function UpdateTransaksi($id, $data){
        $this->db->where('tnomor',$id);
        $this->db->update('transaksi',$data);

        return $data;
    }

    public function HapusTransaksi($nomor){
        $this->db->set('tstatus', 0);
        $this->db->where('tnomor',$nomor);
        $this->db->update($this->table[1]);
    }

    public function Deposit(){
        $this->db->select('t.tnomor, t.tpotongan, t.tgrandtotal, t.tstatus, t.tdate, c.cuser');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer');
        $this->db->where('t.tjenis', 1);
        $this->db->where_in('t.tstatus', [1,2]);
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailDeposit(){
        $this->db->select('tcustomer, tnomor, tpotongan, tgrandtotal, tstatus, tdate, tcustomer');
        $this->db->from($this->table[1]);
        $this->db->where('tjenis', 1);
        $this->db->where('tstatus', 2);

        $data = $this->db->get()->row();
        return $data;
    }

    public function Kupon(){
        $this->db->select('t.tnomor, t.tkupon, t.tgrandtotal, t.tstatus, t.tdate, c.cuser');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer');
        $this->db->where('t.tjenis', 3);
        $this->db->where_in('t.tstatus', [1,2]);

        $data = $this->db->get()->result();
        return $data;
    }

    public function HapusKupon($kupon){
        $this->db->set('tstatus', 0);
        $this->db->where('tkupon',$kupon);
        $this->db->update($this->table[1]);
    }

    public function TransferDana(){
        $this->db->select('t.tnomor, t.tdari, t.ttujuan,t.tgrandtotal, t.tstatus, t.tdate, c.cuser, r.rnama, r.rbank');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer');
        $this->db->join($this->table[3].' as r','r.rno = t.tdari','left');
        $this->db->where('t.tjenis', 4);
        $this->db->where_in('t.tstatus', [1,2]);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailTransferDana($nomor){
        $this->db->select('t.tnomor, t.tdari, t.ttujuan, t.tgrandtotal, t.tstatus, t.tbrand, t.tdate, c.cuser, c.cid, c.cdeposit, b.bnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[4].' as b','b.bid = t.tbrand','left');
        $this->db->where('t.tnomor', $nomor);
        $this->db->where('t.tjenis', 4);
        // $this->db->where('t.tsubjenis', 52);

        $data = $this->db->get()->row();
        return $data;
    }

    public function HapusTransferDana($nomor){
        $this->db->set('tstatus', 0);
        $this->db->where('tnomor',$nomor);
        $this->db->update($this->table[1]);
    }

    public function WithdrawDana(){
        $this->db->select('t.tnomor, t.tdari, t.ttujuan,t.tgrandtotal, t.tstatus, t.tdate, c.cuser, r.rnama, r.rbank');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer');
        $this->db->join($this->table[3].' as r','r.rno = t.tdari','left');
        $this->db->where('t.tjenis', 7);
        $this->db->where_in('t.tstatus', [1,2]);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailWithdrawDana($nomor){
        $this->db->select('t.tnomor, t.tdari, t.ttujuan, t.tgrandtotal, t.tstatus, t.tbrand, t.tdate, c.cuser, c.cid, c.cdeposit, b.bnama');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->join($this->table[4].' as b','b.bid = t.tbrand','left');
        $this->db->where('t.tnomor', $nomor);
        $this->db->where('t.tjenis', 7);
        // $this->db->where('t.tsubjenis', 52);

        $data = $this->db->get()->row();
        return $data;
    }

    public function HapusWithdrawDana($nomor){
        $this->db->set('tstatus', 0);
        $this->db->where('tnomor',$nomor);
        $this->db->update($this->table[1]);
    }

    public function ReportPermainanHarian($dari,$sampai,$email,$brand){
        $this->db->select('t.tnomor, t.twin, t.tlose, t.tmembercomm, t.tbonus, t.tgrandtotal, t.tperiode, t.tbrand, c.cemail');
        $this->db->from($this->table[1].' as t');
        $this->db->join($this->table[2].' as c','c.cid = t.tcustomer','left');
        $this->db->where('t.tstatus', 1);
        $this->db->where('t.tjenis', 9);
        if($dari != '1970-01-01'){
            $this->db->where('t.tperiode >=', $dari);
        }
        if($sampai != '1970-01-01'){
            $this->db->where('t.tperiode <=', $sampai);
        }else{
            $this->db->where('t.tperiode <=', '2020-12-13');
        }
        if($email != ''){
            $this->db->where('c.cemail', $email);
        }
        if($brand != ''){
            $this->db->where('t.tbrand', $brand);
        }
        $this->db->group_by('t.tnomor'); 

        $data = $this->db->get()->result();
        return $data;
    }
}