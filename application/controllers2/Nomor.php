<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nomor extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_nomor');
		$this->load->helper('string');
	}

	//dashboard
	public function list(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	  	$this->load->model('m_customer');
	  	$this->load->model('m_transaksi');
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_transaksi->ListKupon($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'List Kupon - '.BRAND;
		$data['page']  = 'dashboard/kupon/list';
		$this->load->view('dashboard/thamplate', $data); 
 	}

	public function addnomor(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	  	$this->load->model('m_customer');
	  	$this->load->model('m_general');
		$id					= $this->session->userdata('id');
		$data['deposit'] 	= $this->m_customer->Deposit($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);
 		$data['harga'] 		= $this->m_general->SearchHarga();

		$data['title'] = 'Beli Nomor Kupon - '.BRAND;
		$data['page']  = 'dashboard/kupon/add';
		$this->load->view('dashboard/thamplate', $data); 
 	}

	public function jumlah() {
		$this->load->model('m_general');
		$jumlah = $this->input->post("jumlah");

		if($jumlah == 0 || $jumlah == ''){
			$data['potongan'] 	= 0;
			$data['jumlah'] 	= 0;
 		}else{
			$cek = $this->m_general->CekPotongan($jumlah);
			if($cek > 0){
 				$harga 				= $this->m_general->SearchHarga();
 				$potongan 			= $this->m_general->SearchPotongan($jumlah);
				$total 				= $jumlah*$harga->harga_general;
				$data['potongan'] 	= $potongan->diskon_general;
				$calculate 			= $potongan->diskon_general/100*$total;
				$data['jumlah'] 	= $total-$calculate; 
 			}else{
 				$harga 				= $this->m_general->SearchHarga();
				$data['potongan'] 	= 0;
				$data['jumlah'] 	= $jumlah*$harga->harga_general;
 			}
		}

		$data['page']  = 'dashboard/kupon/jumlah';
		$this->load->view('dashboard/kupon/jumlah', $data); 
	}

	public function addnomor_act(){ 		
		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$this->load->model('m_general');
	  			$this->load->model('m_transaksi');
	  			$this->load->model('m_customer');
				$id			= $this->session->userdata('id');
				$deposit 	= $this->m_customer->Deposit($id);
				$jumlah 	= $this->input->post("jumlah");
				$nomor  	= time();

		  		if($jumlah == 0 || $jumlah == ''){
					$total = 0;
		  		}else{
					$cek = $this->m_general->CekPotongan($jumlah);
					if($cek > 0){
		 				$harga 				= $this->m_general->SearchHarga();
		 				$potongan 			= $this->m_general->SearchPotongan($jumlah);
						$total 				= $jumlah*$harga->harga_general;
						$calculate 			= $potongan->diskon_general/100*$total;
						$bruto 				= $total-$calculate; 
		 			}else{
		 				$harga 				= $this->m_general->SearchHarga();
						$bruto 				= $jumlah*$harga->harga_general;
		 			}
		 			$harga 				= $this->m_general->SearchHarga();
		 			$total = $jumlah*$harga->harga_general;
		  		}

		  		if($deposit->deposito_customer < $bruto){
		        	$this->session->set_flashdata('warning', 'Maaf, Jumlah deposit kurang!');
					redirect(base_url('nomor/addnomor'));
		  		}
				$updatedeposit	= $deposit->deposito_customer-$total;
				
				for ($x = 1; $x <= $jumlah; $x++){
					$voucher 	= random_string('numeric', 6);
			  		$count 		= $this->m_nomor->CountNomor($voucher);
			  		if($count > 0){
						$voucher1 = random_string('numeric', 6);
						$data['customer_transaksi']		= $id;
						$data['nomor_transaksi']		= $nomor;
						$data['voucher_transaksi']		= $voucher1;
						$data['grandtotal_transaksi'] 	= $total;
						$data['status_transaksi'] 		= 1;
						$data['date_transaksi'] 		= date('Y-m-d H:i:s');
						$row['customer_nomor']			= $id;
						$row['nomor'] 					= $voucher;
			  	 		$this->m_transaksi->SaveTransaksi($data);
	  	 				$this->m_nomor->SaveNomor($row);	
			  		}else{
						$data['customer_transaksi']		= $id;
						$data['nomor_transaksi']		= $nomor;
						$data['voucher_transaksi']		= $voucher;
						$data['grandtotal_transaksi'] 	= $total;
						$data['status_transaksi'] 		= 1;
						$data['date_transaksi'] 		= date('Y-m-d H:i:s');
						$row['customer_nomor']			= $id;
						$row['nomor'] 					= $voucher;
			  	 		$this->m_transaksi->SaveTransaksi($data);
	  	 				$this->m_nomor->SaveNomor($row);	
			  	 	}
				} 
			  	$this->m_customer->UpdateDeposit($id,$updatedeposit);
				redirect(base_url('nomor/list'));
		  	}
	    }
	}

	

	//Halaman Backend
	public function listnomor(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_nomor->Nomor();

		$data['title'] = 'List Nomor Kupon - '.BRAND;
		$data['page']  = 'backend/nomor/list';
		$this->load->view('backend/thamplate', $data);
	}

	public function hapusnomor($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$this->m_nomor->HapusNomor($id);

		redirect(base_url('nomor/listnomor'));
	}

	public function downloadexcel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_nomor->nomor();

		$this->load->view('backend/nomor/downloadexcel', $data);
	}

}