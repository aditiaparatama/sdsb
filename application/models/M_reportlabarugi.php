<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_reportlabarugi extends CI_Model {
    protected $table = array('1' => 'reportlabarugi');

    public function __construct(){
      parent::__construct();
    }

    //halaman backend
    public function CariLabaRugi($where){      
        $this->db->select('rperiode, rjmhdeposit, rjmhdepositrp, rjmhwithdraw, rjmhwithdrawrp, rwinlose1, rwinlose2, rwinlose3, rwinlose4, rwinlose5, rwinlose6, rwinlose7, rwinlose8, rwinlose9, rwinlose10, rwinlose11, rwinlose12, rwinlose13, rwinlose14, rwinlose15, rtotalwinlose, rcommbonus, rreferralbonus, rwinlosegross, rbiayaoperasional');
        $this->db->from($this->table[1]);
        $this->db->where($where);

        $data = $this->db->get()->row();
        return $data;
    }

    public function SaveLabaRugi($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function EditRugiLaba($id, $data) {
        $this->db->where('rperiode',$id);
        $this->db->update($this->table[1],$data);

        return $data;
    }

    public function HapusBrand($id){
        $this->db->set('rstatus', 0);
        $this->db->where('rid',$id);
        $this->db->update($this->table[1]);
    }

    public function ReportRugiLaba($dari,$sampai){
        $this->db->select('rperiode, rjmhdeposit, rjmhdepositrp, rjmhwithdraw, rjmhwithdrawrp, rwinlose1, rwinlose2, rwinlose3, rwinlose4, rwinlose5, rwinlose6, rwinlose7, rwinlose8, rwinlose9, rwinlose10, rwinlose11, rwinlose12, rwinlose13, rwinlose14, rwinlose15, rtotalwinlose, rcommbonus, rreferralbonus, rwinlosegross, rbiayaoperasional,(rwinlosegross-rbiayaoperasional) as total');
        $this->db->from($this->table[1]);
        $this->db->where('rstatus', 1);
        if($dari != '1970-01-01'){
            $this->db->where('rperiode >=', $dari);
        }
        if($sampai != '1970-01-01'){
            $this->db->where('rperiode <=', $sampai);
        }else{
            $this->db->where('rperiode <=', '2020-12-13');
        }

        $data = $this->db->get()->result();
        return $data;
    }
}