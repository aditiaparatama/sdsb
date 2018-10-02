<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_nomor extends CI_Model {
    protected $table = array('1' => 'nomor','2' => 'customer');

    public function __construct(){
      parent::__construct();
    }


    //backend
    function CNomor(){      
        $this->db->select('id_nomor');
        $this->db->from($this->table[1]);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function Nomor(){
        $this->db->select('n.id_nomor, n.nomor, c.nama_customer');
        $this->db->from($this->table[1].' as n');
        $this->db->join($this->table[2].' as c','c.id_customer = n.customer_nomor');
     
        $data = $this->db->get()->result();
        return $data;
    }

	public function HapusNomor($id){
		$this->db->where('id_nomor', $id);
		$this->db->delete($this->table[1]);
	}

    public function CountNomor($nomor) {
        $this->db->select('nomor');
        $this->db->from($this->table[1]);
        $this->db->where('nomor', $nomor);

        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function SaveNomor($row) {
        $data = $this->db->insert($this->table[1], $row);
        return $data;
    }
}