<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_voucher');
	}
	
	//halaman backend
	public function listvoucher(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_voucher->Voucher();

		$data['title'] = 'List Voucher - '.BRAND;
		$data['page']  = 'backend/voucher/list';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addvoucher(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		
		$data['title'] = 'Tambah Voucher - '.BRAND;
		$data['page']  = 'backend/voucher/add';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function addvoucher_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('kode', 'Kode Voucher', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal1', 'Tanggal Aktif', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal2', 'Tanggal Non-Aktif', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('potongan', 'Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$data['vkode']  	= $this->input->post('kode');
				$data['vawal'] 		= date('Y-m-d', strtotime($this->input->post('tanggal1')));
				$data['vakhir'] 	= date('Y-m-d', strtotime($this->input->post('tanggal2')));
				$data['vpotongan'] 	= $this->input->post('potongan');
				$data['vstatus'] 	= 1;
				$data['vdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_voucher->SaveVoucher($data);	
	       		redirect(base_url().'voucher/listvoucher');
		  	}
	    }
 	}

 	public function editvoucher($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
 		$data['detail'] = $this->m_voucher->DetailVoucher($id);

 		$data['title'] = 'Edit Voucher - '.BRAND;
 		$data['page']  = 'backend/voucher/edit';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editvoucher_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('kode', 'Kode Voucher', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal1', 'Tanggal Aktif', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal2', 'Tanggal Non-Aktif', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('potongan', 'Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id	  = $this->input->post('id_voucher');
				$data = array(
					'vkode'		=> $this->input->post('kode'),
					'vawal'		=> date('Y-m-d', strtotime($this->input->post('tanggal1'))),
					'vakhir' 	=> date('Y-m-d', strtotime($this->input->post('tanggal2'))),
					'vpotongan' => $this->input->post('potongan')
				);

	  	 		$this->m_voucher->EditVoucher($id, $data);	
	       		redirect(base_url().'voucher/listvoucher');
		  	}
	    }
 	}

	public function hapusvoucher($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_voucher->HapusVoucher($id);
		redirect(base_url('voucher/listvoucher'));
	}

	public function downloadexcel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_voucher->Voucher();

		$this->load->view('backend/voucher/downloadexcel', $data);
	}

}