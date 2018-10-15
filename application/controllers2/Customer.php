<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_customer');
		$this->load->library('upload');
	}
	
	//dashboard
	public function profile(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id = $this->session->userdata('id');
 		$data['detail'] 	= $this->m_customer->EditCustomer($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

 		$data['title'] = 'Edit Customer - '.BRAND;
 		$data['page']  = 'dashboard/profile/edit';
 		$this->load->view('dashboard/thamplate', $data);
	}

 	public function profile_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrek', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('norek', 'Pemilik Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$data['id_customer']			= $this->session->userdata('id');
				$data['nama_customer']			= $this->input->post('nama');
				$data['email_customer']			= $this->input->post('email');
				$data['pass_customer'] 			= $this->input->post('password');
				$data['tlp_customer'] 			= $this->input->post('tlp');
				$data['alamat_customer'] 		= $this->input->post('alamat');
				$data['bank_customer'] 			= $this->input->post('bank');
				$data['nmrrekening_customer'] 	= $this->input->post('norek');
				$data['nmrekening_customer'] 	= $this->input->post('nmrek');

		        if(!empty($_FILES['photo']['name'])) {
		  			$data['profile_customer']	= $this->upload('photo');
		        }
	  	 		$this->m_customer->EditCustomerAct($data);	
	       		redirect(base_url().'customer/profile');
		  	}
	    }
 	}



	//Halaman Backend
	public function listcustomer(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_customer->Customer();

		$data['title'] = 'List Customer - '.BRAND;
		$data['page']  = 'backend/customer/list';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function editcustomer($id){
 		if($this->session->userdata('status') != "backend"){
 			redirect(base_url('cmskita'));
 		}
 		$data['detail'] = $this->m_customer->EditCustomer($id);

 		$data['title'] = 'Edit Customer - '.BRAND;
 		$data['page']  = 'backend/customer/edit';
 		$this->load->view('backend/thamplate', $data);

 	}

 	public function editcustomer_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('username', 'Username', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrek', 'Nama Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('norek', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('usersbo', 'Username SBOBET', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('ibcbet', 'Username IBCBET', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('horey4d', 'Username Horey', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tangkasnet', 'Username Tangkas', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('dsbobet', 'Deposit SBOBET', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('dibcbet', 'Deposit IBCBET', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('dhorey4d', 'Deposit Horey', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('dtangkas', 'Deposit Tangkas', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
					$id	  								= $this->input->post('id_customer');
					$data['id_customer']				= $this->input->post('id_customer');
					$data['nama_customer']				= $this->input->post('nama');
					$data['email_customer']				= $this->input->post('email');
					$data['username_customer'] 			= $this->input->post('username');
					$data['usersbobet_customer']		= $this->input->post('usersbo');
					$data['useribcbet_customer']		= $this->input->post('ibcbet');
					$data['userhoreybet_customer']		= $this->input->post('horey4d');
					$data['usertangkasbet_customer']	= $this->input->post('tangkasnet');
					$data['pass_customer'] 				= md5($this->input->post('username'));
					$data['tlp_customer']				= $this->input->post('tlp');
					$data['alamat_customer']			= $this->input->post('alamat');
					$data['bank_customer']				= $this->input->post('bank');
					$data['nmrekening_customer']		= $this->input->post('nmrek');
					$data['nmrrekening_customer']		= $this->input->post('norek');
					$data['depositsbobet_customer']		= $this->input->post('dsbobet');
					$data['depositibcbet_customer']		= $this->input->post('dibcbet');
					$data['deposithoreybet_customer']	= $this->input->post('dhorey4d');
					$data['deposittangkasbet_customer']	= $this->input->post('dtangkas');

	  	 		$this->m_customer->EditCustomerAct($id, $data);	
	       		redirect(base_url().'customer/listcustomer');
		  	}
	    }
 	}

	public function hapuscustomer($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_customer->HapusCustomer($id);

		redirect(base_url('customer/listcustomer'));
	}

	public function downloadexcel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_customer->DetailCustomer();

		$this->load->view('backend/customer/downloadexcel', $data);
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

		$config['upload_path'] 		= './assets/images/dashboard/profile/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size'] 		= '262144';
		$config['file_name'] 		= $type;
		$cover_name					= $config['file_name'];
		$this->upload->initialize($config);

		if ($this->upload->do_upload($name)) {
			$data['message'] 		= $this->upload->data();
		} else {
		    $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		return $config['file_name'];
	}

}