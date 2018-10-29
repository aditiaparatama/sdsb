<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_detailcustomer extends CI_Model {
    protected $table = array('1' => 'reportdetailcustomer','2' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //halaman backend
    public function CariDetailCustomer($where){      
        $this->db->select('rdid, rdperiode, rdcustomerid, rdbrand, rddeposit, rdwinlose, rdwithdraw, rdstatus, rddate');
        $this->db->from($this->table[1]);
        $this->db->where($where);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SaveDetailCustomer($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditDetailCustomer($cust, $brand, $data) {
        $this->db->where('rdcustomerid',$cust);
        $this->db->where('rdbrand',$brand);
        $this->db->update($this->table[1],$data);

        return $data;
    }

    public function ReportDetailCustomer($email,$brand){
        $this->db->select('r.rdperiode, r.rdbrand, r.rddeposit, r.rdwinlose, r.rdwithdraw, c.cemail, c.cdeposit, c.cdepositsbo, c.cdepositmax, c.cdeposithorey, c.cdeposittangkas');
        $this->db->from($this->table[1].' as r');
        $this->db->join($this->table[2].' as c','c.cid = r.rdcustomerid','left');
        $this->db->where('r.rdstatus', 1);
        // if($dari != '1970-01-01'){
        //     $this->db->where('r.rdperiode >=', $dari);
        // }
        // if($sampai != '1970-01-01'){
        //     $this->db->where('r.rdperiode <=', $sampai);
        // }else{
        //     $this->db->where('t.rdperiode <=', '2020-12-13');
        // }
        if($email != ''){
            $this->db->where('cemail', $email);
        }
        if($brand != ''){
            $this->db->where('r.rdbrand', $brand);
        }

        $data = $this->db->get()->result();
        return $data;
    }
}