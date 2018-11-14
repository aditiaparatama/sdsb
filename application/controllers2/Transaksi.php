<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_transaksi','m_deposit'));
	}

	//Halaman Backend
	public function listpemesanan(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_deposit->DepositPemesanan();

		$data['title'] = 'List Pemesanan - '.BRAND;
		$data['page']  = 'backend/transaksi/listpemesanan';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function updatepesanan($id){
		$data['lists'] 	= $this->m_deposit->UpdateDeposit($id);
		$jumlah 		= $this->m_deposit->JumlahDeposit($id);

		$row['id_customer'] 		=  $jumlah->id_customer;	
		$row['deposito_customer']	= $jumlah->deposito_customer+$jumlah->grandtotal_deposit;
	  	
	  	$this->load->model('m_customer');
	  	$this->m_customer->EditCustomerAct($row);	
		redirect(base_url('transaksi/listpembelian'));
 	}

	public function hapuspesanan($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$this->m_deposit->HapusDeposit($id);
		redirect(base_url('transaksi/listpemesanan'));
	}

	public function listpembelian(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_deposit->DepositPembelian();

		$data['title'] = 'List Pembelian - '.BRAND;
		$data['page']  = 'backend/transaksi/listpembelian';
		$this->load->view('backend/thamplate', $data); 
 	}

	public function downloadexcelpembelian(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_deposit->DepositPembelian();

		$this->load->view('backend/transaksi/downloadexcelpembelian', $data);
	}

	public function downloadexcelpemesanan(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_deposit->DepositPemesanan();

		$this->load->view('backend/transaksi/downloadexcelpemesanan', $data);
	}

}