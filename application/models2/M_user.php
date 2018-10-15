<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {
    protected $table = array('1' => 'user');

    public function __construct(){
      parent::__construct();
    }

    function cek_login($where){      
        return $this->db->get_where($this->table[1], $where);
    }

    function data_login($user,$pass){      
        $this->db->select('id_user, nama_user, username_user, email_user, foto_user, role_user');
        $this->db->from($this->table[1]);
        $this->db->where('username_user', $user);
        $this->db->where('password_user', $pass);

        $data = $this->db->get()->row();
        return $data;
    }

    public function User(){
        $this->db->select('id_user, nama_user, username_user, alamat_user, role_user');
        $this->db->from($this->table[1]);
        $this->db->where('status_user', 1);

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
        $this->db->where('status_user', 1);
        $this->db->where('id_user', $id);

        $data = $this->db->get()->row();
        return $data;
    }

    public function EditUser($id, $data) {
        $this->db->where('id_user',$id);
        $this->db->update('user',$data);

        return $data;
    }

    public function HapusUser($id){
        $this->db->set('status_user', 0);
        $this->db->where('id_user',$id);
        $this->db->update($this->table[1]);
    }

}