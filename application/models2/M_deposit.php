<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_deposit extends CI_Model {
    protected $table = array('1' => 'deposit','2' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //dashboards
    function CNomor(){      
        $this->db->select('id_nomor');
        $this->db->from($this->table[1]);

        $data = $this->db->get()->num_rows();
        return $data;
    }
    
    public function ListDeposit($id){
        $this->db->select('d.id_deposit, d.nomor_deposit, d.status_deposit, d.potongan_deposit, d.grandtotal_deposit, d.date_deposit, c.nama_customer');
        $this->db->from($this->table[1].' as d');
        $this->db->join($this->table[2].' as c','c.id_customer = d.customer_deposit');
        $this->db->where('d.customer_deposit',$id);
        $this->db->where_in('d.status_deposit', [1,2,3]);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailDeposit($id){
        $this->db->select('d.id_deposit, d.nomor_deposit, d.status_deposit, d.voucher_deposit, d.grandtotal_deposit, d.link_deposit, d.date_deposit, c.nama_customer, c.bank_customer, c.nmrrekening_customer, c.nmrekening_customer');
        $this->db->from($this->table[1].' as d');
        $this->db->join($this->table[2].' as c','c.id_customer = d.customer_deposit');
        $this->db->where('d.nomor_deposit',$id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SaveDeposit($row) {
        $data = $this->db->insert($this->table[1], $row);
        return $data;
    }

    public function EditDeposit($data){
        $this->db->where('nomor_deposit',$data['nomor_deposit']);
        $this->db->update($this->table[1], $data);
        return $data;
    }



    //backend
    function CDeposit(){      
        $this->db->select('id_deposit');
        $this->db->from($this->table[1]);
        $this->db->where('status_deposit', 1);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function DepositPemesananHome($limit){
        $this->db->select('d.customer_deposit, d.grandtotal_deposit, d.status_deposit, d.link_deposit, c.nama_customer');
        $this->db->from($this->table[1].' as d');
        $this->db->join($this->table[2].' as c','c.id_customer = d.customer_deposit','left');
        $this->db->where_in('d.status_deposit', [1,2,3]);
        $this->db->order_by('d.id_deposit', "desc");
        $this->db->limit($limit);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DepositPemesanan(){
        $this->db->select('d.customer_deposit, d.nomor_deposit, d.voucher_deposit, d.potongan_deposit, d.grandtotal_deposit, d.status_deposit, d.link_deposit, c.nama_customer');
        $this->db->from($this->table[1].' as d');
        $this->db->join($this->table[2].' as c','c.id_customer = d.customer_deposit','left');
        $this->db->where_in('d.status_deposit', [2,3]);

        $data = $this->db->get()->result();
        return $data;
    }

    public function UpdateDeposit($id){
        $this->db->set('status_deposit', 1);
        $this->db->where('nomor_deposit',$id);
        $this->db->update($this->table[1]);
    }

    public function JumlahDeposit($id){
        $this->db->select('d.grandtotal_deposit, c.id_customer, c.deposito_customer');
        $this->db->from($this->table[1].' as d');
        $this->db->join($this->table[2].' as c','c.id_customer = d.customer_deposit','left');
        $this->db->where('d.nomor_deposit', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function HapusDeposit($id){
        $this->db->set('status_deposit', 0);
        $this->db->where('nomor_deposit',$id);
        $this->db->update($this->table[1]);
    }

    public function DepositPembelian(){
        $this->db->select('d.nomor_deposit, d.voucher_deposit, d.potongan_deposit, d.grandtotal_deposit, d.status_deposit, d.link_deposit, c.nama_customer');
        $this->db->from($this->table[1].' as d');
        $this->db->join($this->table[2].' as c','c.id_customer = d.customer_deposit');
        $this->db->where('d.status_deposit', 1);

        $data = $this->db->get()->result();
        return $data;
    }
}