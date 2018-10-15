<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_user');
		$this->load->library('upload');
	}
	
	//halaman backend
	public function login(){
		$data['title'] = 'CMS Login - '.BRAND;
		$this->load->view('backend/login', $data);
	}

	public function login_act() {
	    if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('user', 'User', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda salah!');
	          	redirect(base_url().'cmskita');
		  	} else { 		

		  		$user 	= $this->input->post('user');
		  		$pass 	= md5($this->input->post('pass'));
		  		$where 	= array(
				    'uuser' => $user,
				    'upass' => $pass
			    );
		  		$this->load->model('m_user');
				$cek = $this->m_user->cek_login($where)->num_rows();
				if($cek > 0){
					$data = $this->m_user->data_login($user,$pass);
					$data_session = array(
						'id' 		=> $data->uid,
						'nama' 		=> $data->unama,
						'email' 	=> $data->uemail,
						'foto' 		=> $data->ufoto,
						'role' 		=> $data->urole,
						'status' 	=> "backend"
			    	);
				    $this->session->set_userdata($data_session);
					redirect(base_url('backend'));
				}else{
		            $this->session->set_flashdata('warning', 'Maaf, anda gagal login!');
					redirect(base_url('cmskita'));
				}
			}
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('user/login'));
	}


	public function listuser(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_user->User();

		$data['title'] = 'List User Access - '.BRAND;
		$data['page']  = 'backend/user/list';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function adduser(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		
		$data['title'] = 'Tambah User Access - '.BRAND;
		$data['page']  = 'backend/user/add';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function adduser_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
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
				$data['unama']  	= $this->input->post('nama');
				$data['uuser'] 		= $this->input->post('user');
				$data['upass'] 		= md5($this->input->post('pass'));
				$data['uemail'] 	= $this->input->post('email');
				$data['utlp'] 		= $this->input->post('tlp');
				$data['ualamat'] 	= $this->input->post('alamat');
				$data['ufoto'] 		= $this->upload('foto');
				$data['urole'] 		= $this->input->post('role');
				$data['ustatus'] 	= 1;
				$data['udate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_user->SaveUser($data);	
	       		redirect(base_url().'user/listuser');
		  	}
	    }
 	}
 	
 	public function edituser($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
 		$data['detail'] = $this->m_user->DetailUser($id);

 		$data['title'] = 'Edit User Access - '.BRAND;
 		$data['page']  = 'backend/user/edit';
 		$this->load->view('backend/thamplate', $data);

 	}

 	public function edituser_act(){
 	 	if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
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
				$id	  				= $this->input->post('id');
				$data['unama']		= $this->input->post('nama');
				$data['uuser']		= $this->input->post('user');
				$data['upass'] 		= md5($this->input->post('pass'));
				$data['uemail'] 	= $this->input->post('email');
				$data['utlp'] 		= $this->input->post('tlp');
				$data['ualamat'] 	= $this->input->post('alamat');
				$data['urole'] 		= $this->input->post('role');

		        if(!empty($_FILES['foto']['name'])) {
		  			$data['ufoto'] 	= $this->upload('foto');
		        }
	  	 		$this->m_user->EditUser($id, $data);	
	       		redirect(base_url().'user/listuser');
		  	}
	    }
	}

	public function hapususer($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
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