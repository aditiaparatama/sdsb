<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_pesan','m_customer'));
	}

	//halaman backend
	public function listpesan(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_pesan->Pesan();

		$data['title'] = 'List Pesan - '.BRAND;
		$data['page']  = 'backend/pesan/list';
		$this->load->view('backend/thamplate', $data); 
 	}

	public function detail($id){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_pesan->Pesan();
		$data['lists'] = $this->m_pesan->DetailPesan($id);
		$data['pesan'] = $this->m_pesan->DetailPesan1($id);

		$data['title'] = 'List Pesan - '.BRAND;
		$data['page']  = 'backend/pesan/detail';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function balaspesan_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('pesan', 'Pesan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		

				$data['ptitle']	 	= $this->input->post('title');
				$data['ppesan']		= $this->input->post('pesan');
				$data['puser']	 	= $this->input->post('iduser');
				$data['padmin']	 	= 1;
				$data['pstatus']	= 1;
				$data['pterbaca']	= 1;
				$data['pdate']	 	= date('Y-m-d H:i:s');
				
	  	 		$this->m_pesan->SavePesan($data);	
				redirect($_SERVER['HTTP_REFERER']);
		  	}
	    }
 	}

 	public function hapuspesan($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_pesan->HapusPesan($id);
		redirect(base_url('pesan/listpesan'));

 	}
}