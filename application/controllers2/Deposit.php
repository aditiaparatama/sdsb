<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_deposit');
		$this->load->library('upload');
	}

	//dashboard
	public function deposit(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	  	$this->load->model('m_customer');
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_deposit->ListDeposit($id);
		$data['deposit'] 	= $this->m_customer->Deposit($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'List Deposit - '.BRAND;
		$data['page']  = 'dashboard/deposit/list';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function tambahdeposit(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	  	$this->load->model('m_customer');
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_customer->DataCustomer($id);

		$data['title'] = 'Tambah Deposit - '.BRAND;
		$data['page']  = 'dashboard/deposit/add';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function tambahdeposit_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('deposit', 'Deposit', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrekening', 'Pemilik Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrrekening', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
		  		if($this->input->post('voucher') != ''){
	  				$this->load->model('m_voucher');
	  				$date 	 = date('Y-m-d');
					$voucher = $this->m_voucher->SearchVoucher($this->input->post('voucher'));
					if($date >= $voucher->nonaktif_voucher){
						$potongan 	= 0;
						$total 		= $this->input->post('deposit');
					}else{
						$nominal 	= $this->input->post('deposit');
						$potongan 	= $voucher->potongan_voucher;
						$calcu		= $potongan/100*$nominal;
						$total 		= $nominal-$calcu;
					}
		  		}else{
					$potongan 	= 0;
					$total 		= $this->input->post('deposit');
		  		}

				$data['customer_deposit']		= $this->session->userdata('id');
				$data['nomor_deposit']			= time();
				$data['voucher_deposit']		= $this->input->post('voucher');
				$data['potongan_deposit'] 		= $potongan;
				$data['grandtotal_deposit'] 	= $total;
				$data['status_deposit'] 		= 3;
				$data['date_deposit'] 			= date('Y-m-d H:i:s');

	  	 		$this->m_deposit->SaveDeposit($data);	
	       		redirect(base_url().'deposit/deposit');
		  	}
	    }
 	}

 	public function konfirmasi($id){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	  	$this->load->model('m_customer');		
		$customer 			= $this->session->userdata('id');
	  	$data['detail'] 	= $this->m_deposit->DetailDeposit($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($customer);

		$data['title'] = 'List Deposit - '.BRAND;
		$data['page']  = 'dashboard/deposit/edit';
		$this->load->view('dashboard/thamplate', $data);
 	}

 	public function konfirmasi_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$data['nomor_deposit']  = $this->input->post('nomor');
			$data['status_deposit'] = 2;

	        if(!empty($_FILES['photo']['name'])) {
	  			$data['link_deposit'] = $this->upload('photo');
	        }
  	 		$this->m_deposit->EditDeposit($data);	
       		redirect(base_url().'deposit/deposit');
	    }
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

		$config['upload_path'] 		= './assets/images/backend/upload/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size'] 		= '262144';
		$config['file_name'] 		= $type;
		$cover_name					= $config['file_name'];
		$this->upload->initialize($config);

		if ($this->upload->do_upload($name)) {
			$data['message'] 		= $this->upload->data();
		} else {
		    $this->session->set_flashdata('warning', 'upload image failed!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		return $config['file_name'];
	}

}