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
        $this->db->select('cid, cnama, cemail, cfoto, cdeposit');
        $this->db->from($this->table[1]);
        $this->db->where('cemail', $email);
        $this->db->where('cpass', $pass);

        $data = $this->db->get()->row();
        return $data;
    }

    public function DataCustomer($id){
        $this->db->select('cid, cnama, cuser, cusersbo, cusermax, cuserhorey, cusertangkas, cdeposit, cfoto, cbank, cnamarek, cnorek, cdate, cdeposit, cdepositsbo, cdepositmax, cdeposithorey, cdeposittangkas');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        $this->db->where('cid', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function DataDepositCustomer($id){
        $this->db->select('cuser, cusersbo, cusermax, cuserhorey, cusertangkas, cdeposit, cdepositsbo, cdepositmax, cdeposithorey, cdeposittangkas');
        $this->db->from($this->table[1]);
        $this->db->where('cid', $id);
        $this->db->where('cstatus', 1);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditDataCustomer($id){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        $this->db->where('cid', $id);

        $data = $this->db->get()->row();
        return $data;
    }
    public function Deposit($id){      
        $this->db->select('cdeposit');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        $this->db->where('cid', $id);

        $data = $this->db->get()->row();
        return $data;
    }
    // function cek_login($where){      
    //     return $this->db->get_where($this->table[1], $where);
    // }

    // function data_login($email,$pass){      
    //     $this->db->select('cid, cnama, cemail, cfoto, cdeposit');
    //     $this->db->from($this->table[1]);
    //     $this->db->where('cemail', $email);
    //     $this->db->where('cpass', $pass);

    //     $data = $this->db->get()->row();
    //     return $data;
    // }

    // public function DataCustomer($id){
    //     $this->db->select('cid, cnama, cuser, cdeposit, cfoto, cbank, cnamarek, cnorek, cdate');
    //     $this->db->from($this->table[1]);
    //     $this->db->where('cstatus', 1);
    //     $this->db->where('cid', $id);

    //     $data = $this->db->get()->row();
    //     return $data;
    // }


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
        $this->db->select('cid,  cnama, cemail, cuser, cusersbo, cusermax, cuserhorey, cusertangkas, cdeposit, cdepositsbo, cdepositmax, cdeposithorey, cdeposittangkas');
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
        $this->db->where('cid', $id);

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
        $this->db->where('cid',$id);
        $this->db->update($this->table[1]);
    }

    public function SearchCustomer($email){
        $this->db->select('cid, cnama, cnorek, cuser, cusersbo, cusermax, cuserhorey, cusertangkas, cdeposit, 
            cdepositsbo, cdepositmax, cdeposithorey, cdeposittangkas');
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
        $this->db->select('cid, cbank, cnamarek, cnorek, cdeposit, cdepositsbo, cdepositmax, cdeposithorey, cdeposittangkas');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        $this->db->where($where);

        $data = $this->db->get()->row();
        return $data;
    }

    public function CariDataCustomer($where){      
        $this->db->select('cid, cnama, cemail, cuser, cusersbo, cusermax, cuserhorey, cusertangkas, cdeposit, cdepositsbo, cdepositmax, cdeposithorey, cdeposittangkas, cbank');
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

    public function ReportCustomer($dari,$sampai,$email){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('cstatus', 1);
        if($dari != '1970-01-01'){
            $this->db->where('cdate >=', $dari);
        }
        if($sampai != '1970-01-01'){
            $this->db->where('cdate <=', $sampai);
        }else{
            $this->db->where('cdate <=', '2020-12-13');
        }
        if($email != ''){
            $this->db->where('cemail', $email);
        }

        $data = $this->db->get()->result();
        return $data;
    }

}