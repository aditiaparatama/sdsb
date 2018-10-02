<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_transaksi extends CI_Model {
    protected $table = array('1' => 'transaksi','2' => 'customer','3' => 'deposit',);

    public function __construct(){
      parent::__construct();
    }

    //dashboard
    public function ListKupon($id){
        $this->db->select('n.voucher_transaksi, n.customer_transaksi, , n.status_transaksi, n.date_transaksi, c.nama_customer');
        $this->db->from($this->table[1].' as n');
        $this->db->join($this->table[2].' as c','c.id_customer = n.customer_transaksi','left');
        $this->db->where('n.customer_transaksi',$id);
        $this->db->where_in('n.status_transaksi', [1,2,3]);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SaveTransaksi($row) {
        $data = $this->db->insert($this->table[1], $row);
        return $data;
    }



    //backend
    public function CariTransaksi($id) {
        $this->db->select('customer_transaksi');
        $this->db->from($this->table[1]);
        $this->db->where('voucher_transaksi ', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function TransaksiKupon($limit){
        $this->db->select('count(n.voucher_transaksi) as jumlah, c.nama_customer');
        $this->db->from($this->table[1].' as n');
        $this->db->join($this->table[2].' as c','c.id_customer = n.customer_transaksi','left');
        $this->db->where('n.status_transaksi', 1);
        $this->db->order_by('n.id_transaksi', "desc");
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }
    public function TransaksiPerhari($limit){
        $this->db->select('count(n.voucher_transaksi) as jumlah, DATE_FORMAT(n.date_transaksi, "%m/%d/%Y") as date, c.nama_customer');
        $this->db->from($this->table[1].' as n');
        $this->db->join($this->table[2].' as c','c.id_customer = n.customer_transaksi','left');
        $this->db->where('n.status_transaksi', 1);
        $this->db->order_by('date', "desc");
        $this->db->group_by('date'); 
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }


    //report
    public function Pemasukan($dari,$sampai,$email){
        $this->db->select('n.nomor_transaksi, n.grandtotal_transaksi, n.date_transaksi, c.nama_customer');
        $this->db->from($this->table[1].' as n');
        $this->db->join($this->table[2].' as c','c.id_customer = n.customer_transaksi','left');
        $this->db->where('n.status_transaksi', 1);
        if($dari != '1970-01-01'){
            $this->db->where('n.date_transaksi >=', $dari);
        }
        if($sampai != '1970-01-01'){
            $this->db->where('n.date_transaksi <=', $sampai);
        }else{
            $this->db->where('n.date_transaksi <=', '2020-12-13');
        }
        if($email != ''){
            $this->db->where('c.email_customer', $email);
        }
        $this->db->group_by('n.nomor_transaksi'); 

        $data = $this->db->get()->result();
        return $data;
    }
}