<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemenang extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_pemenang');
	}

	//Halaman Backend
	public function listpemenang(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_pemenang->Pemenang();

		$data['title'] = 'List Pemenang - '.BRAND;
		$data['page']  = 'backend/pemenang/list';
		$this->load->view('backend/thamplate', $data); 
 	}	

 	public function addpemenang(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		
		$data['title'] = 'Tambah Pemenang - '.BRAND;
		$data['page']  = 'backend/pemenang/add';
		$this->load->view('backend/thamplate', $data);
 	}

 	public function addpemenang_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
	  		$this->load->model('m_nomor');
	  		$this->load->model('m_transaksi');
			$this->load->helper('string');

			//pemenang1
	  		if($this->input->post('pemenang1') == ''){
	  			$pemenang1 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang1);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 1 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang1);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang1;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 1;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
				$row['nomor'] 				= $pemenang1;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang1 	= $this->input->post('pemenang1');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang1);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang1;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 1;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
	  	 		$this->m_pemenang->SavePemenang($data);	
		  	}

			//pemenang2
	  		if($this->input->post('pemenang2') == ''){
	  			$pemenang2 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang2);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 2 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang2);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang2;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 2;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
				$row['nomor'] 				= $pemenang2;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang2 	= $this->input->post('pemenang2');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang2);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang2;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 2;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
	  	 		$this->m_pemenang->SavePemenang($data);	
		  	}

			//pemenang3
	  		if($this->input->post('pemenang3') == ''){
	  			$pemenang3 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang3);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 3 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang3);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang3;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 3;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
				$row['nomor'] 				= $pemenang3;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang3 	= $this->input->post('pemenang3');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang3);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang3;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 3;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
	  	 		$this->m_pemenang->SavePemenang($data);	
		  	}

			//pemenang4
	  		if($this->input->post('pemenang4') == ''){
	  			$pemenang4 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang4);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 4 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang4);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang4;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 4;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
				$row['nomor'] 				= $pemenang4;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang4 	= $this->input->post('pemenang4');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang4);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang4;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 4;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
	  	 		$this->m_pemenang->SavePemenang($data);	
		  	}

			//pemenang5
	  		if($this->input->post('pemenang5') == ''){
	  			$pemenang5 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang5);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 5 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang5);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang5;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 5;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
				$row['nomor'] 				= $pemenang5;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang5 	= $this->input->post('pemenang5');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang5);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang5;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 5;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
	  	 		$this->m_pemenang->SavePemenang($data);	
		  	}

			//pemenang6
	  		if($this->input->post('pemenang6') == ''){
	  			$pemenang6 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang6);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 6 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang6);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang6;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 6;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
				$row['nomor'] 				= $pemenang6;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang6 	= $this->input->post('pemenang6');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang6);

				$data['tanggal_pemenang']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['nomor_pemenang'] 	= $pemenang6;
				$data['customer_pemenang'] 	= $customer->customer_transaksi;
				$data['order_pemenang'] 	= 6;
				$data['status_pemenang'] 	= 1;
				$data['date_pemenang'] 		= date('Y-m-d H:i:s');
	  	 		$this->m_pemenang->SavePemenang($data);	
		  	}

	       	redirect(base_url().'pemenang/listpemenang');
	    }
 	}

 	public function listgroup($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_pemenang->GroupPemenang($id);
		
		$data['title'] = 'List Pemenang Group - '.BRAND;
		$data['page']  = 'backend/pemenang/listgroup';
		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpemenang($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
 		$data['detail1'] = $this->m_pemenang->Detail($id,1);
 		$data['detail2'] = $this->m_pemenang->Detail($id,2);
 		$data['detail3'] = $this->m_pemenang->Detail($id,3);
 		$data['detail4'] = $this->m_pemenang->Detail($id,4);
 		$data['detail5'] = $this->m_pemenang->Detail($id,5);
 		$data['detail6'] = $this->m_pemenang->Detail($id,6);

 		$data['title'] = 'Edit Pemenang - '.BRAND;
 		$data['page']  = 'backend/pemenang/edit';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpemenang_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {	
	  		$this->load->model('m_nomor');
	  		$this->load->model('m_transaksi');
			$this->load->helper('string');

			//pemenang1
	  		if($this->input->post('pemenang1') == ''){
				$id	  		= $this->input->post('id_pemenang1');
	  			$pemenang1 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang1);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 1 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang1);

				$data = array(
					'nomor_pemenang'		=> $pemenang1,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
				$row['nomor'] 				= $pemenang1;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang1');
		  		$pemenang1 	= $this->input->post('pemenang1');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang1);

				$data = array(
					'nomor_pemenang'		=> $pemenang1,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);
		  	}

			//pemenang2
	  		if($this->input->post('pemenang2') == ''){
				$id	  		= $this->input->post('id_pemenang2');
	  			$pemenang2 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang2);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 2 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang2);

				$data = array(
					'nomor_pemenang'		=> $pemenang2,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
				$row['nomor'] 				= $pemenang2;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang2');
		  		$pemenang2 	= $this->input->post('pemenang2');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang2);

				$data = array(
					'nomor_pemenang'		=> $pemenang2,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
		  	}

			//pemenang3
	  		if($this->input->post('pemenang3') == ''){
				$id	  		= $this->input->post('id_pemenang3');
	  			$pemenang3 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang3);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 3 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang3);

				$data = array(
					'nomor_pemenang'		=> $pemenang3,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
				$row['nomor'] 				= $pemenang3;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang3');
		  		$pemenang3 	= $this->input->post('pemenang3');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang3);

				$data = array(
					'nomor_pemenang'		=> $pemenang3,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
		  	}

			//pemenang4
	  		if($this->input->post('pemenang4') == ''){
				$id	  		= $this->input->post('id_pemenang4');
	  			$pemenang4 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang4);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 4 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang4);

				$data = array(
					'nomor_pemenang'		=> $pemenang4,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
				$row['nomor'] 				= $pemenang4;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang4');
		  		$pemenang4 	= $this->input->post('pemenang4');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang4);

				$data = array(
					'nomor_pemenang'		=> $pemenang4,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
		  	}

			//pemenang5
	  		if($this->input->post('pemenang5') == ''){
				$id	  		= $this->input->post('id_pemenang5');
	  			$pemenang5 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang5);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 5 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang5);

				$data = array(
					'nomor_pemenang'		=> $pemenang5,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
				$row['nomor'] 				= $pemenang5;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang5');
		  		$pemenang5 	= $this->input->post('pemenang5');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang5);

				$data = array(
					'nomor_pemenang'		=> $pemenang5,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
		  	}

			//pemenang6
	  		if($this->input->post('pemenang6') == ''){
				$id	  		= $this->input->post('id_pemenang6');
	  			$pemenang6 	= random_string('numeric', 6);
		  		$count 		= $this->m_nomor->CountNomor($pemenang6);
		  		if($count > 0){
	            	$this->session->set_flashdata('warning', 'Maaf, Pemenang 6 gagal mendapat nilai unik!');
		          	redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$customer = $this->m_transaksi->CariTransaksi($pemenang6);

				$data = array(
					'nomor_pemenang'		=> $pemenang6,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
				$row['nomor'] 				= $pemenang6;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang6');
		  		$pemenang6 	= $this->input->post('pemenang6');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang6);

				$data = array(
					'nomor_pemenang'		=> $pemenang6,
					'customer_pemenang' 	=> $customer->customer_transaksi
				);
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
		  	}

		redirect(base_url().'pemenang/listpemenang');
	    }
 	}

 	public function editgrouppemenang($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
 		$data['detail'] = $this->m_pemenang->DetailGroup($id);

 		$data['title'] = 'Edit Group Pemenang - '.BRAND;
 		$data['page']  = 'backend/pemenang/groupedit';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editgrouppemenang_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {	
	  		$this->load->model('m_nomor');
	  		$this->load->model('m_transaksi');
			$id	  		= $this->input->post('id_pemenang');
			$pemenang 	= $this->input->post('pemenang');
		  		$count 	= $this->m_nomor->CountNomor($pemenang);
		  		if($count > 0){
		  			$customer 	= $this->m_transaksi->CariTransaksi($pemenang);
					$data = array(
						'nomor_pemenang'		=> $pemenang,
						'customer_pemenang' 	=> $customer->customer_transaksi
					);
		  	 		$this->m_pemenang->EditGroupPemenang($id, $data);	
		       		redirect(base_url().'pemenang/listpemenang');
		  		}else{
		  			$customer 	= $this->m_transaksi->CariTransaksi($pemenang);
					$data = array(
						'nomor_pemenang'		=> $pemenang,
						'customer_pemenang' 	=> $customer->customer_transaksi
					);
					$row['nomor'] 				= $pemenang;
		  	 		$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 			$this->m_nomor->SaveNomor($row);	
		       		redirect(base_url().'pemenang/listpemenang');
		  		}
	    }
 	}

	public function downloadexcel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_pemenang->ExcelPemenang();

		$this->load->view('backend/pemenang/downloadexcel', $data);
	}

}