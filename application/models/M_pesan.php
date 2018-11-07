<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pesan extends CI_Model {
    protected $table = array('1' => 'pesan', '2' => 'customer');

    public function __construct(){
      parent::__construct();
    }

    //dashboard
    public function ListPesan($id){
        $this->db->select('pid, ptitle, pdate');
        $this->db->from($this->table[1]);
        $this->db->where('puser',$id);
        $this->db->where('pstatus', 1);
        $this->db->where('padmin', 0);
        $this->db->group_by('ptitle'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function SavePesan($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }
    
    public function DetailPesan($id){
        $this->db->select('p.pid, p.ptitle, p.ppesan, p.padmin, p.pdate, c.cid, c.cuser');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','c.cid = p.puser','left');
        $this->db->where('p.puser',$id);
        $this->db->where('p.pstatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }
    
    public function DetailPesan1($id){
        $this->db->select('p.pid, p.ptitle, p.ppesan, p.padmin, p.pdate, c.cid, c.cuser');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','c.cid = p.puser','left');
        $this->db->where('p.puser',$id);
        $this->db->where('p.pstatus', 1);

        $data = $this->db->get()->row();
        return $data;
    }



    //backend
    public function Pesan(){
        $this->db->select('p.pid, p.ptitle, p.ppesan, p.pdate, c.cuser');
        $this->db->from($this->table[1].' as p');
        $this->db->join($this->table[2].' as c','c.cid = p.puser','left');
        $this->db->where('p.pstatus', 1);
        $this->db->where('p.padmin', 0);
        $this->db->group_by('p.ptitle'); 

        $data = $this->db->get()->result();
        return $data;
    }

    public function HapusPesan($id){
        $this->db->set('pstatus', 0);
        $this->db->where('ptitle',$id);
        $this->db->update($this->table[1]);
    }
}