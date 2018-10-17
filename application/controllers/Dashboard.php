<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_customer','m_transaksi'));
		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	}

	public function index(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$customer 			= $this->session->userdata('id');
	  	$data['customer']	= $this->m_customer->DataCustomer($customer);

		$data['title'] = 'Halaman Dashboard - '.BRAND;
		$data['page']  = 'dashboard/home';
		$this->load->view('dashboard/thamplate', $data);
	}

	public function deposit(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_transaksi->ListDeposit($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'List Deposit - '.BRAND;
		$data['page']  = 'dashboard/deposit/list';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function adddeposit(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['customer'] 	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'Tambah Deposit - '.BRAND;
		$data['page']  = 'dashboard/deposit/add';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function tambahdeposit_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('deposit', 'Deposit', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  				$this->load->model('m_voucher');
		  			$deposit = str_replace(".", "", $this->input->post('deposit'));
			  		if($this->input->post('voucher') != ''){
		  				$date 	 = date('Y-m-d');
						$voucher = $this->m_voucher->SearchVoucher($this->input->post('voucher'));
						if($date >= $voucher->vakhir){
							$potongan 	= 0;
							$total 		= $deposit;
						}else{
							$nominal 	= $deposit;
							$potongan 	= $voucher->vpotongan;
							$calcu		= $potongan/100*$nominal;
							$total 		= $nominal-$calcu;
						}
			  		}else{
						$potongan 	= 0;
						$total 		= $deposit;
			  		}
				$calcucus 	= $customer->cdeposit+$deposit;
				$calcurek 	= $rekening->rsaldo+$total;

				$data['tcustomer']	 = $customer->cid;
				$data['tnomor']		 = random_string('alnum', 15);
				$data['tvoucher']	 = $this->input->post('voucher');
				$data['tdari']	 	 = $customer->cuser;
				$data['ttujuan']	 = $rekening->rno;
				$data['tpotongan']	 = $potongan;
				$data['tharga']		 = $total;
				$data['tgrandtotal'] = $total;
				$data['tjenis']		 = 1;
				$data['tsubjenis']	 = 51;
				$data['tsubdeposit'] = 61;
				$data['tbrand']		 = 5;
				$data['tketerangan'] = 'Deposit customer sdsb '.$customer->cuser;
				$data['tstatus']	 = 1;
				$data['tuser'] 		 = $this->session->userdata('id');
				$data['tdate'] 		 = date('Y-m-d H:i:s');

				$idcus 				= $customer->cid;
				$row['cdeposit'] 	= $calcucus;
		
				$idrek 				= $rekening->rno;
				$record['rsaldo'] 	= $calcurek;
				
	  	 		$this->m_transaksi->SaveTransaksi($data);	
 				$this->m_customer->EditCustomerAct($idcus, $row);
 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	       		redirect(base_url().'transaksi/listdeposit/');



			  		

				$data['customer_deposit']		= $this->session->userdata('id');
				$data['nomor_deposit']			= time();
				$data['voucher_deposit']		= $this->input->post('voucher');
				$data['potongan_deposit'] 		= $potongan;
				$data['grandtotal_deposit'] 	= $total;
				$data['status_deposit'] 		= 1;
				$data['date_deposit'] 			= date('Y-m-d H:i:s');

	  	 		$this->m_deposit->SaveDeposit($data);	
	       		redirect(base_url().'deposit/deposit');
		  	}
	    }
 	}
}