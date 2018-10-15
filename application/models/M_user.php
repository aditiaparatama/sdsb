<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {
    protected $table = array('1' => 'user');

    public function __construct(){
      parent::__construct();
    }

    //halaman backend
    function cek_login($where){      
        return $this->db->get_where($this->table[1], $where);
    }

    function data_login($user,$pass){      
        $this->db->select('uid, unama, uemail, ufoto, urole');
        $this->db->from($this->table[1]);
        $this->db->where('uuser', $user);
        $this->db->where('upass', $pass);

        $data = $this->db->get()->row();
        return $data;
    }

    public function User(){
        $this->db->select('uid, unama, uuser, uemail, urole');
        $this->db->from($this->table[1]);
        $this->db->where('ustatus', 1);

        $data = $this->db->get()->result();
        return $data;
    }

    public function SaveUser($data) {
        $data = $this->db->insert($this->table[1], $data);
        return $data;
    }

    public function DetailUser($id){
        $this->db->select('*');
        $this->db->from($this->table[1]);
        $this->db->where('ustatus', 1);
        $this->db->where('uuser', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditUser($id, $data) {
        $this->db->where('uid',$id);
        $this->db->update('user',$data);

        return $data;
    }

    public function HapusUser($id){
        $this->db->set('ustatus', 0);
        $this->db->where('uuser',$id);
        $this->db->update($this->table[1]);
    }

}