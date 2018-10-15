<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_customer extends CI_Model {
    protected $table = array('1' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //dashboard
    function cek_login($where){      
        return $this->db->get_where($this->table[1], $where);
    }

    function data_login($email,$pass){      
        $this->db->select('id_customer, nama_customer, email_customer, profile_customer, deposito_customer');
        $this->db->from($this->table[1]);
        $this->db->where('email_customer', $email);
        $this->db->where('pass_customer', $pass);

        $data = $this->db->get()->row();
        return $data;
    }

    function Deposit($id){      
        $this->db->select('deposito_customer');
        $this->db->from($this->table[1]);
        $this->db->where('status_customer', 1);
        $this->db->where('id_customer', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function DataCustomer($id){
        $this->db->select('id_customer, nama_customer, deposito_customer, profile_customer, bank_customer, nmrrekening_customer, nmrekening_customer, date_customer');
        $this->db->from($this->table[1]);
        $this->db->where('status_customer', 1);
        $this->db->where('id_customer', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function UpdateDeposit($id, $jumlah){
        $this->db->set('deposito_customer', $jumlah);
        $this->db->where('id_customer',$id);
        $this->db->update($this->table[1]);

    }



    //backend
    function CCustomer(){      
        $this->db->select('id_customer');
        $this->db->from($this->table[1]);
        $this->db->where('status_customer', 1);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function Customer(){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('status_customer', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailCustomer(){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('status_customer', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function EditCustomer($id){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('status_customer', 1);
        $this->db->where('id_customer', $id);

        $data = $this->db->get()->row();
        return $data;
    }
    
    public function EditCustomerAct($id, $data) {
        $this->db->where('id_customer',$id);
        $this->db->update($this->table[1],$data);

        return $data;
    }

    public function HapusCustomer($id){
        $this->db->set('status_customer', 0);
        $this->db->where('id_customer',$id);
        $this->db->update($this->table[1]);
    }

    public  function SearchCustomer($email){
        $this->db->select('id_customer, nama_customer, deposito_customer');
        $this->db->from($this->table[1]);
        $this->db->where('status_customer', 1);
        $this->db->where('email_customer', $email);

        $data = $this->db->get()->row();
        return $data;
    }
}