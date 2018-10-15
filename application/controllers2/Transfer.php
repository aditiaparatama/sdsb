<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_transfer','m_customer'));
	}

	//dashboard
	public function transfer(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_transfer->ListTransfer($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'List Transfer Dana - '.BRAND;
		$data['page']  = 'dashboard/transfer/list';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function tambahtransfer(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_customer->DataCustomer($id);

		$data['title'] = 'Transfer Dana Baru - '.BRAND;
		$data['page']  = 'dashboard/transfer/add';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function tambahtransfer_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('transfer', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('dari', 'Transfer Dari', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tujuan', 'Tujuan Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else {
		  		$id 		= $this->session->userdata('id');
				$customer 	= $this->m_customer->DataCustomer($id);
				$deposit 	= $customer->deposito_customer;
		  		$nominal 	= $this->input->post('transfer');		
		  		if($deposit < $nominal){
	            $this->session->set_flashdata('warning', 'Maaf, Deposit anda tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$jmhdeposit = $deposit-$nominal;

				$data['id_transfer']			= time();
				$data['customer_transfer']		= $this->session->userdata('id');
				$data['dari_transfer']			= $this->input->post('dari');
				$data['tujuan_transfer']		= $this->input->post('tujuan');
				$data['nominal_transfer'] 		= $this->input->post('transfer');
				$data['status_transfer'] 		= 3;
				$data['date_transfer'] 			= date('Y-m-d H:i:s');

				$row['id_customer']  			= $this->session->userdata('id');
				$row['deposito_customer'] 		= $jmhdeposit;

	  	 		$this->m_transfer->SaveTransfer($data);	
	  	 		$this->m_customer->EditCustomerAct($row);	
	       		redirect(base_url().'transfer/transfer');
		  	}
	    }
 	}



	//Halaman Backend
	public function listtransfer(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_transfer->Transfer();

		$data['title'] = 'List Transfer Dana - '.BRAND;
		$data['page']  = 'backend/transfer/list';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addtransfer(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['title'] = 'Transfer Dana Baru - '.BRAND;
		$data['page']  = 'backend/transfer/add';
		$this->load->view('backend/thamplate', $data);	
 	}

	public function searchtransfer() {
		$email 				= $this->input->post("email");
		$data['customer'] 	= $this->m_customer->SearchCustomer('aditiaparatama@gmail.com');

		$data['page']  = 'backend/transfer/search';
		$this->load->view('backend/transfer/search', $data); 
	}

 	public function addtransfer_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('email', 'Email Customer', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nama', 'Nama Customer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('dari', 'Dari', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tujuan', 'Tujuan Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda salah!');
				redirect(base_url().'transfer/addtransfer');
		  	} else { 		
		  		$deposit = $this->input->post('deposit');
		  		$nominal = $this->input->post('nominal');
		  		if($nominal > $deposit){
	            	$this->session->set_flashdata('warning', 'Maaf, deposit user tidak mencukupi!');
					redirect(base_url().'transfer/addtransfer');
		  		}
		  		$jmhdeposit = $deposit-$nominal;

				$data['customer_transfer']  = $this->input->post('id');
				$data['dari_transfer'] 		= $this->input->post('dari');
				$data['tujuan_transfer'] 	= $this->input->post('tujuan');
				$data['nominal_transfer'] 	= $this->input->post('nominal');
				$data['status_transfer'] 	= 1;
				$data['date_transfer'] 		= date('Y-m-d H:i:s');

				$row['id_customer']  		= $this->input->post('id');
				$row['deposito_customer'] 	= $jmhdeposit;

	  	 		$this->m_transfer->SaveTransfer($data);	
	  	 		$this->m_customer->EditCustomerAct($row);	
	       		redirect(base_url().'transfer/listtransfer');
		  	}
	    }
 	}

 	public function updatetransfer($id){
		$data['lists'] = $this->m_transfer->UpdateTransfer($id);
		redirect(base_url('transfer/listtransfer'));
 	}

	public function hapustransfer($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_transfer->HapusTransfer($id);
		redirect(base_url('transfer/listtransfer'));
	}

	public function downloadexceltransfer(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_transfer->Transfer();

		$this->load->view('backend/transfer/downloadexceltransfer', $data);
	}

}