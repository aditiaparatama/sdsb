<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_nomor extends CI_Model {
    protected $table = array('1' => 'nomor','2' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //halaman backend
    function CNomor(){      
        $this->db->select('nid');
        $this->db->from($this->table[1]);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function Nomor(){
        $this->db->select('n.nid, n.nnomor, c.cnama');
        $this->db->from($this->table[1].' as n');
        $this->db->join($this->table[2].' as c','c.cid = n.ncustomer');
     
        $data = $this->db->get()->result();
        return $data;
    }

	public function HapusNomor($id){
		$this->db->where('nid', $id);
		$this->db->delete($this->table[1]);
	}

    public function CountNomor($nomor, $periode) {
        $this->db->select('nnomor');
        $this->db->from($this->table[1]);
        $this->db->where('nnomor', $nomor);
        $this->db->where('nperiode', $periode);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function SaveNomor($row) {
        $data = $this->db->insert($this->table[1], $row);
        return $data;
    }
}