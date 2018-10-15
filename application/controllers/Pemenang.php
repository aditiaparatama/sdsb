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
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_pemenang->Pemenang();

		$data['title'] = 'List Pemenang - '.BRAND;
		$data['page']  = 'backend/pemenang/list';
		$this->load->view('backend/thamplate', $data); 
 	}	

 	public function addpemenang(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		
		$data['title'] = 'Tambah Pemenang - '.BRAND;
		$data['page']  = 'backend/pemenang/add';
		$this->load->view('backend/thamplate', $data);
 	}

 	public function addpemenang_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
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

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang1;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 1;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
				$row['nnomor'] 		= $pemenang1;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang1 	= $this->input->post('pemenang1');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang1);

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang1;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 1;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
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

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang2;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 2;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
				$row['nnomor'] 		= $pemenang2;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang2 	= $this->input->post('pemenang2');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang2);

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang2;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 2;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
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

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang3;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 3;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
				$row['nnomor'] 				= $pemenang3;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang3 	= $this->input->post('pemenang3');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang3);

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang3;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 3;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
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

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang4;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 4;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
				$row['nnomor'] 				= $pemenang4;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang4 	= $this->input->post('pemenang4');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang4);

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang4;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 4;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
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

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang5;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 5;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
				$row['nnomor'] 				= $pemenang5;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang5 	= $this->input->post('pemenang5');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang5);

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang5;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 5;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
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

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang6;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 6;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
				$row['nnomor'] 				= $pemenang6;
	  	 		$this->m_pemenang->SavePemenang($data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
		  		$pemenang6 	= $this->input->post('pemenang6');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang6);

				$data['pperiode']  	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['pnomor'] 	= $pemenang6;
				$data['pcustomer'] 	= $customer->tcustomer;
				$data['porder'] 	= 6;
				$data['pstatus'] 	= 1;
				$data['pdate'] 		= date('Y-m-d H:i:s');
	  	 		$this->m_pemenang->SavePemenang($data);	
		  	}

	       	redirect(base_url().'pemenang/listpemenang');
	    }
 	}

 	public function listgroup($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_pemenang->GroupPemenang($id);
		
		$data['title'] = 'List Pemenang Group - '.BRAND;
		$data['page']  = 'backend/pemenang/listgroup';
		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpemenang($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
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
			redirect(base_url('cmskita'));
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
					'pnomor'		=> $pemenang1,
					'pcustomer' 	=> $customer->tcustomer
				);
				$row['nnomor'] 				= $pemenang1;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang1');
		  		$pemenang1 	= $this->input->post('pemenang1');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang1);

				$data = array(
					'pnomor'		=> $pemenang1,
					'pcustomer' 	=> $customer->tcustomer
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
					'pnomor'		=> $pemenang2,
					'pcustomer' 	=> $customer->tcustomer
				);
				$row['nnomor'] 				= $pemenang2;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang2');
		  		$pemenang2 	= $this->input->post('pemenang2');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang2);

				$data = array(
					'pnomor'		=> $pemenang2,
					'pcustomer' 	=> $customer->tcustomer
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
					'pnomor'		=> $pemenang3,
					'pcustomer' 	=> $customer->tcustomer
				);
				$row['nnomor'] 				= $pemenang3;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang3');
		  		$pemenang3 	= $this->input->post('pemenang3');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang3);

				$data = array(
					'pnomor'		=> $pemenang3,
					'pcustomer' 	=> $customer->tcustomer
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
					'pnomor'		=> $pemenang4,
					'pcustomer' 	=> $customer->tcustomer
				);
				$row['nnomor'] 				= $pemenang4;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang4');
		  		$pemenang4 	= $this->input->post('pemenang4');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang4);

				$data = array(
					'pnomor'		=> $pemenang4,
					'pcustomer' 	=> $customer->tcustomer
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
					'pnomor'		=> $pemenang5,
					'pcustomer' 	=> $customer->tcustomer
				);
				$row['nnomor'] 				= $pemenang5;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang5');
		  		$pemenang5 	= $this->input->post('pemenang5');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang5);

				$data = array(
					'pnomor'		=> $pemenang5,
					'pcustomer' 	=> $customer->tcustomer
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
					'pnomor'		=> $pemenang6,
					'pcustomer' 	=> $customer->tcustomer
				);
				$row['nnomor'] 				= $pemenang6;
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 		$this->m_nomor->SaveNomor($row);	
		  	}else{
				$id	  		= $this->input->post('id_pemenang6');
		  		$pemenang6 	= $this->input->post('pemenang6');
		  		$customer 	= $this->m_transaksi->CariTransaksi($pemenang6);

				$data = array(
					'pnomor'		=> $pemenang6,
					'pcustomer' 	=> $customer->tcustomer
				);
		  	 	$this->m_pemenang->EditGroupPemenang($id, $data);	
		  	}

		redirect(base_url().'pemenang/listpemenang');
	    }
 	}

 	public function editgrouppemenang($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
 		$data['detail'] = $this->m_pemenang->DetailGroup($id);

 		$data['title'] = 'Edit Group Pemenang - '.BRAND;
 		$data['page']  = 'backend/pemenang/groupedit';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editgrouppemenang_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
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
						'pnomor'		=> $pemenang,
						'pcustomer' 	=> $customer->tcustomer
					);
		  	 		$this->m_pemenang->EditGroupPemenang($id, $data);	
		       		redirect(base_url().'pemenang/listpemenang');
		  		}else{
		  			$customer 	= $this->m_transaksi->CariTransaksi($pemenang);
					$data = array(
						'pnomor'		=> $pemenang,
						'pcustomer' 	=> $customer->tcustomer
					);
					$row['nnomor']		= $pemenang;
		  	 		$this->m_pemenang->EditGroupPemenang($id, $data);	
	  	 			$this->m_nomor->SaveNomor($row);	
		       		redirect(base_url().'pemenang/listpemenang');
		  		}
	    }
 	}

	public function downloadexcel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_pemenang->ExcelPemenang();

		$this->load->view('backend/pemenang/downloadexcel', $data);
	}

}