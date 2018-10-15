<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_brand');
	}
	
	//halaman backend
	public function listsubbrand(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_brand->SubBrand();

		$data['title'] = 'List Sub Brand - '.BRAND;
		$data['page']  = 'backend/brand/list';
		$this->load->view('backend/thamplate', $data); 
 	}
 	public function addbrand(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['brands'] = $this->m_brand->Brand();

		$data['title'] = 'Tambah Brand Baru - '.BRAND;
		$data['page']  = 'backend/brand/add';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function addbrand_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('brand', 'Brand', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('subbrand', 'SubBrand', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'brand/addbrand');
		  	} else { 		
				$data['bnama']  	= $this->input->post('subbrand');
				$data['bparent'] 	= 0;
				$data['bchild'] 	= $this->input->post('brand');
				$data['buser'] 		= $this->session->userdata('id');
				$data['bstatus'] 	= 1;
				$data['bdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_brand->SaveBrand($data);	
	       		redirect(base_url().'brand/listsubbrand');
		  	}
	    }
 	}

 	public function editbrand($id){
 		if($this->session->userdata('status') != "backend"){
 			redirect(base_url('cmskita'));
 		}
		$data['brands'] = $this->m_brand->Brand();
 		$data['detail'] = $this->m_brand->EditBrand($id);

 		$data['title'] = 'Edit Brand - '.BRAND;
 		$data['page']  = 'backend/brand/edit';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editbrand_act(){
 	 	if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('brand', 'Brand', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('subbrand', 'SubBrand', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id	  				= $this->input->post('id');
				$data['bnama']  	= $this->input->post('subbrand');
				$data['bparent'] 	= 0;
				$data['bchild'] 	= $this->input->post('brand');
				$data['buser'] 		= $this->session->userdata('id');
				$data['bstatus'] 	= 1;
				$data['bdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_brand->EditBrandAct($id, $data);	
	       		redirect(base_url().'brand/listsubbrand');
		  	}
	    }
	}

	public function hapusbrand($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_brand->HapusBrand($id);
		redirect(base_url('brand/listsubbrand'));
	}
}