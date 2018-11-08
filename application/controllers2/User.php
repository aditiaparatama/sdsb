<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_user');
		$this->load->library('upload');
	}
	
	//Halaman Backend
	public function listuser(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departement-sosial'));
		}
		$data['lists'] = $this->m_user->User();

		$data['title'] = 'List User - '.BRAND;
		$data['page']  = 'backend/user/list';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function adduser(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departement-sosial'));
		}
		
		$data['title'] = 'Tambah User - '.BRAND;
		$data['page']  = 'backend/user/add';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function adduser_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departement-sosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('user', 'Username', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('role', 'Role', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'user/adduser');
		  	} else { 		
				$data['nama_user']  	= $this->input->post('nama');
				$data['username_user'] 	= $this->input->post('user');
				$data['password_user'] 	= md5($this->input->post('pass'));
				$data['email_user'] 	= $this->input->post('email');
				$data['tlp_user'] 		= $this->input->post('tlp');
				$data['alamat_user'] 	= $this->input->post('alamat');
				$data['foto_user'] 		= $this->upload('foto');
				$data['role_user'] 		= $this->input->post('role');
				$data['status_user'] 	= 1;
				$data['date_user'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_user->SaveUser($data);	
	       		redirect(base_url().'user/listuser');
		  	}
	    }
 	}

 	public function edituser($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departement-sosial'));
		}
 		$data['detail'] = $this->m_user->DetailUser($id);

 		$data['title'] = 'Edit User - '.BRAND;
 		$data['page']  = 'backend/user/edit';
 		$this->load->view('backend/thamplate', $data);

 	}

 	public function edituser_act(){
 	 	if($this->session->userdata('status') != "backend"){
			redirect(base_url('departement-sosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('user', 'Username', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('kpass', 'Konfirmasi Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('role', 'Role', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id	  						= $this->input->post('id_user');
				$data['nama_user']			= $this->input->post('nama');
				$data['username_user']		= $this->input->post('user');
				$data['password_user'] 		= md5($this->input->post('pass'));
				$data['email_user'] 		= $this->input->post('email');
				$data['tlp_user'] 			= $this->input->post('tlp');
				$data['alamat_user'] 		= $this->input->post('alamat');
				$data['role_user'] 			= $this->input->post('role');
				$data['status_user'] 		= 1;
				$data['date_user'] 			= date('Y-m-d H:i:s');

		        if(!empty($_FILES['foto']['name'])) {
		  			$data['foto_user'] = $this->upload('foto');
		        }
	  	 		$this->m_user->EditUser($id, $data);	
	       		redirect(base_url().'user/listuser');
		  	}
	    }
	}

	public function hapususer($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departement-sosial'));
		}
		$this->m_user->HapusUser($id);
		redirect(base_url('user/listuser'));
	}

	public function upload($name) {
		$new_name = time();
		switch ($_FILES[$name]['type']) {
			case "image/jpeg" :
				$type = $new_name.'.jpeg';
				break;
			case "image/png" :
				$type = $new_name.'.png';
				break;
			case "image/gif" :
				$type = $new_name.'.gif';
				break;
			default:
				$type = 'not allowed_types';
				break;
		}

		$config['upload_path'] 		= './assets/images/backend/profile/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size'] 		= '262144';
		$config['file_name'] 		= $type;
		$cover_name					= $config['file_name'];
		$this->upload->initialize($config);

		if ($this->upload->do_upload($name)) {
			$data['message'] 		= $this->upload->data();
		} else {
            $this->session->set_flashdata('warning', 'Upload image failed!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		return $config['file_name'];
	}

}