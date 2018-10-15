<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nomor extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_nomor');
		$this->load->helper('string');
	}
	
	//halaman backend
	public function listnomor(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_nomor->Nomor();

		$data['title'] = 'List Nomor Kupon - '.BRAND;
		$data['page']  = 'backend/nomor/list';
		$this->load->view('backend/thamplate', $data);
	}

	public function hapusnomor($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_nomor->HapusNomor($id);

		redirect(base_url('nomor/listnomor'));
	}

	public function downloadexcel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_nomor->nomor();

		$this->load->view('backend/nomor/downloadexcel', $data);
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
				$total 				= $jumlah*$harga->gharga;
				$data['potongan'] 	= $potongan->gdiskon;
				$calculate 			= $potongan->gdiskon/100*$total;
				$data['jumlah'] 	= $total-$calculate; 
 			}else{
 				$harga 				= $this->m_general->SearchHarga();
				$data['potongan'] 	= 0;
				$data['jumlah'] 	= $jumlah*$harga->gharga;
 			}
		}

		$data['page']  = 'backend/nomor/jumlah';
		$this->load->view('backend/nomor/jumlah', $data); 
	}
}