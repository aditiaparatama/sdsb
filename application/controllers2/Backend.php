<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_customer','m_nomor','m_deposit','m_transfer','m_transaksi','m_pemenang'));
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departement-sosial'));
		}
	}

	public function index(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departement-sosial'));
		}
	  	$data['customer'] 		= $this->m_customer->CCustomer();
	  	$data['nomor'] 			= $this->m_nomor->CNomor();
	  	$data['deposit'] 		= $this->m_deposit->CDeposit();
	  	$data['dana'] 			= $this->m_transfer->CTransfer();
		$data['transharis'] 	= $this->m_transaksi->TransaksiPerhari(3);
		$data['pemenanglist'] 	= $this->m_pemenang->PemenangHome(5);
		$data['latestkupon'] 	= $this->m_transaksi->TransaksiKupon(5);
		$data['transfers'] 		= $this->m_transfer->TransferHome(5);
		$data['deposits'] 		= $this->m_deposit->DepositPemesananHome(5);

		$data['title'] = 'Halaman Administrator - '.BRAND;
		$data['page']  = 'backend/page/home';
		$this->load->view('backend/thamplate', $data);
	}
}