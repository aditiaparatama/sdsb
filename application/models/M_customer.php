<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_customer extends CI_Model {
    protected $table = array('1' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //halaman backend
    public function CekCustomer($where){      
        return $this->db->get_where($this->table[1], $where);
    }

    public function CCustomer(){      
        $this->db->select('cid');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function Customer(){
        $this->db->select('cnama, cemail, cuser, cusersbo, cuseribc, cuserhorey, cusertangkas, cdeposit, cdepositsbo, cdepositibc, cdeposithorey, cdeposittangkas');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function DetailCustomer(){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SaveCustomer($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditCustomer($id){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        $this->db->where('cemail', $id);

        $data = $this->db->get()->row();
        return $data;
    }
    
    public function EditCustomerAct($id, $data) {
        $this->db->where('cid',$id);
        $this->db->update($this->table[1],$data);

        return $data;
    }

    public function HapusCustomer($id){
        $this->db->set('cstatus', 0);
        $this->db->where('cemail',$id);
        $this->db->update($this->table[1]);
    }

    public function SearchCustomer($email){
        $this->db->select('cid, cnama, cnorek, cuser, cusersbo, cuseribc, cuserhorey, cusertangkas, cdeposit, 
            cdepositsbo, cdepositibc, cdeposithorey, cdeposittangkas');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        $this->db->where('cemail', $email);

        $data = $this->db->get()->row();
        return $data;
    }


    //halaman backend
    public function CariCustomer($where){      
        return $this->db->get_where($this->table[1], $where);
    }

    public function SearchCustomerUsername($where){
        $this->db->select('cid, cbank, cnamarek, cnorek, cdeposit, cdepositsbo, cdepositibc, cdeposithorey, cdeposittangkas');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        $this->db->where($where);

        $data = $this->db->get()->row();
        return $data;
    }

    public function CariDataCustomer($where){      
        $this->db->select('cid, cnama, cemail, cuser, cusersbo, cuseribc, cuserhorey, cusertangkas, cdeposit, cdepositsbo, cdepositibc, cdeposithorey, cdeposittangkas');
        $this->db->from($this->table[1]);
        $this->db->where($where);

        $data = $this->db->get()->row();
        return $data;
    }

    public function UpdateDeposit($id, $jumlah){
        $this->db->set('cdeposit', $jumlah);
        $this->db->where('cid',$id);
        $this->db->update($this->table[1]);
    }
}