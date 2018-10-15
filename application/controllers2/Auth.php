<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	//dashboard
	public function logindashboard(){
		$data['title'] = 'Login Dashboard - '.BRAND;
		$this->load->view('dashboard/login', $data);
	}

	public function logindashboard_act() {
	    if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('email', 'Email', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('password', 'password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda salah!');
				redirect(base_url('login'));
		  	} else { 		

		  		$email 	= $this->input->post('email');
		  		$pass 	= md5($this->input->post('password'));
		  		$where 	= array(
				    'email_customer' => $email,
				    'pass_customer'  => $pass
			    );
		  		$this->load->model('m_customer');
				$cek = $this->m_customer->cek_login($where)->num_rows();
				if($cek > 0){
					$data = $this->m_customer->data_login($email,$pass);
					$data_session = array(
						'id' 		=> $data->id_customer,
						'nama' 		=> $data->nama_customer,
						'email' 	=> $data->email_customer,
						'foto' 		=> $data->profile_customer,
						'deposito'  => $data->deposito_customer,
						'status' 	=> "user"
			    	);
				    $this->session->set_userdata($data_session);
					redirect(base_url('dashboard/index'));
				}else{
		            $this->session->set_flashdata('warning', 'Maaf, anda gagal login!');
					redirect(base_url('login'));
				}
			}
		}
	}

	public function logoutdashboard() {
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}



	//backend
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
	          	redirect(base_url().'auth/login');
		  	} else { 		

		  		$user 	= $this->input->post('user');
		  		$pass 	= md5($this->input->post('pass'));
		  		$where 	= array(
				    'username_user' => $user,
				    'password_user' => $pass
			    );
		  		$this->load->model('m_user');
				$cek = $this->m_user->cek_login($where)->num_rows();
				if($cek > 0){
					$data = $this->m_user->data_login($user,$pass);
					$data_session = array(
						'id' 		=> $data->id_user,
						'nama' 		=> $data->nama_user,
						'email' 	=> $data->email_user,
						'foto' 		=> $data->foto_user,
						'role' 		=> $data->role_user,
						'status' 	=> "backend"
			    	);
				    $this->session->set_userdata($data_session);
					redirect(base_url('backend/index'));
				}else{
		            $this->session->set_flashdata('warning', 'Maaf, anda gagal login!');
					redirect(base_url('auth/login'));
				}
			}
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('auth/login'));
	}

}
