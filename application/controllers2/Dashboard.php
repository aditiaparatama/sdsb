<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_customer','m_nomor','m_deposit'));
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

}