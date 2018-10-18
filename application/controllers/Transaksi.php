<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_transaksi','m_rekening','m_brand'));
		$this->load->helper('string');
	}
	
	//halaman backend  	
	public function listhariandebit($id){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
  		$where  	= array('bid' => $id);		
		$userbrand 	= $this->m_brand->CariBrand($where);

		$data['idbrand'] = $userbrand->bid;
		$data['user'] 	 = $userbrand->bfield1;
		$data['brand'] 	 = $userbrand->bnama;
		$data['lists'] 	 = $this->m_transaksi->ListTransaksiHarianDebit($id);

		$data['title'] = 'List Transaksi Harian Deposit '. $data['brand'].' - '.BRAND;
		$data['page']  = 'backend/transaksi/listhariandebit';
		$this->load->view('backend/thamplate', $data); 
	}

	public function addtransaksidebit($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
  		$where  	= array('bid' => $id);		
		$userbrand 	= $this->m_brand->CariBrand($where);

		$data['idbrand'] = $userbrand->bid;
		$data['brand'] 	 = $userbrand->bnama;

		$data['transfer'] 	= $this->m_rekening->RekeningPenerima();
		$data['lists'] 		= $this->m_rekening->Rekening();
		
		$data['title'] = 'Input Transaksi Harian Deposit '. $data['brand'].' - '.BRAND;
		$data['page']  = 'backend/transaksi/addtransaksidebit';
		$this->load->view('backend/thamplate', $data);	
	}

	public function addtransaksidebit_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('user', 'User Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('transfer', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
		  		$user 	 	= $this->input->post('user');
				$nominal 	= str_replace(".", "", $this->input->post('nominal'));
		  		$brand 	 	= $this->input->post('brand');
				$periode	= date('Y-m-d', strtotime($this->input->post('tanggal')));
		  		$cbrand  	= array('bid' => $brand);		
				$userbrand 	= $this->m_brand->CariBrand($cbrand);
		  		$cperiode  	= array('rperiode' => $periode);		
				$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

				$depo  = $userbrand->bfield2;
				$cus   = $userbrand->bfield1;
		  		$where = array($cus => $user);

		  		$count 	 = $this->m_customer->CariCustomer($where)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

		  		$detacustomer 	= $this->m_customer->CariDataCustomer($where);
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
	  	 		$tambahsaldo 	= $saldorekening->rsaldo+$nominal;
	  	 		$tambahsaldocus = $detacustomer->$depo+$nominal;

	  	 		$iduser 		= $detacustomer->cid;
				$row[$depo] 	= $tambahsaldocus;

				$penerima 			= $this->input->post('transfer');
				$data['rsaldo'] 	= $tambahsaldo;

				$record['tcustomer']	= $detacustomer->cid;
				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $detacustomer->$cus;
				$record['ttujuan']		= $this->input->post('transfer');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 4;
				$record['tsubjenis']	= 51;
				$record['tbrand']		= $brand;
				$record['tsubdeposit']	= 61;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tketerangan']	= 'Deposit dana '.$userbrand->bnama.' - '.$detacustomer->$cus;
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				if($report == NULL){
					$report['rperiode']		 = $periode;
					$report['rjmhdeposit']	 = 1;
					$report['rjmhdepositrp'] = $nominal;
					$report['rstatus']		 = 1;
					$report['rdate']		 = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhdeposit		= $report->rjmhdeposit+1;
					$jmhdepositrp	= $report->rjmhdepositrp+$nominal;
					
					$periode				  = $periode;
					$report2['rjmhdeposit']	  = $jmhdeposit;
					$report2['rjmhdepositrp'] = $jmhdepositrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

	  	 		$this->m_customer->EditCustomerAct($iduser, $row);
	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
	       		redirect(base_url().'transaksi/listhariandebit/'.$brand);
		  	}
	    }
	}

	public function edittransaksidebit($brand,$nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$cbrand  	= array('bid' => $brand);		
		$userbrand 	= $this->m_brand->CariBrand($cbrand);
		$data['idbrand'] = $userbrand->bid;
		$data['user'] 	 = $userbrand->bfield1;
		$data['brand'] 	 = $userbrand->bnama;

 		$data['detail'] = $this->m_transaksi->DetailTransaksiHarianDebit($brand,$nomor);
		$data['lists'] 	= $this->m_rekening->Rekening();
		
		$data['title'] = 'Edit Transaksi Harian Deposit '. $data['brand'].' - '.BRAND;
 		$data['page']  = 'backend/transaksi/edittransaksidebit';
 		$this->load->view('backend/thamplate', $data);
	}
 	
	public function edittransaksidebit_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('user', 'User Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('transfer', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
		  		$user 	 	= $this->input->post('user');
		  		$nominal 	= str_replace(",", "", $this->input->post('nominal'));
		  		$brand 	 	= $this->input->post('brand');
		  		$oldnominal = $this->input->post('oldnominal');
				$periode	= date('Y-m-d', strtotime($this->input->post('tanggal')));

				$cbrand  	= array('bid' => $brand);		
				$userbrand 	= $this->m_brand->CariBrand($cbrand);
				$cus 	 	= $userbrand->bfield1;
				$depo 		= $userbrand->bfield2;
				$where 		= array($cus => $user);

		  		$cperiode  	= array('rperiode' => $periode);		
				$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

		  		$count 	 = $this->m_customer->CariCustomer($where)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

		  		$detacustomer 	= $this->m_customer->CariDataCustomer($where);
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
	  	 		$tambahsaldo 	= $saldorekening->rsaldo+$nominal-$oldnominal;
	  	 		$tambahsaldocus = $detacustomer->$depo+$nominal-$oldnominal;

	  	 		$iduser 		= $detacustomer->cid;
				$row[$depo] 	= $tambahsaldocus;

				$penerima 		= $this->input->post('transfer');
				$data['rsaldo'] = $tambahsaldo;

				$transaksi 				= $this->input->post('nomor');
				$record['tcustomer']	= $detacustomer->cid;
				$record['tdari']		= $detacustomer->$cus;
				$record['ttujuan']		= $this->input->post('transfer');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 4;
				$record['tsubjenis']	= 51;
				$record['tbrand']		= $brand;
				$record['tsubdeposit']	= 61;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tketerangan']	= 'Deposit dana '.$userbrand->bnama.' - '.$detacustomer->$cus;
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				if($report == NULL){
					$report['rperiode']		 = $periode;
					$report['rjmhdeposit']	 = 1;
					$report['rjmhdepositrp'] = $nominal;
					$report['rstatus']		 = 1;
					$report['rdate']		 = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhdeposit		= $report->rjmhdeposit;
					$jmhdepositrp	= $report->rjmhdepositrp-$oldnominal+$nominal;
					
					$periode				  = $periode;
					$report2['rjmhdeposit']	  = $jmhdeposit;
					$report2['rjmhdepositrp'] = $jmhdepositrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

	  	 		$this->m_customer->EditCustomerAct($iduser, $row);
	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);	
	       		redirect(base_url().'transaksi/listhariandebit/'.$brand);
		  	}
	    }
	}

 	public function hapustransaksidebit($brand,$nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_reportlabarugi');
 		$detail 	= $this->m_transaksi->DetailTransaksiHarianDebit($brand,$nomor);
		$periode	= $detail->tperiode;
  		$cperiode  	= array('rperiode' => $periode);		
		$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

		$jmhdeposit		= $report->rjmhdeposit-1;
		$jmhdepositrp	= $report->rjmhdepositrp-$detail->tgrandtotal;
		
		$periode				  = $periode;
		$report2['rjmhdeposit']	  = $jmhdeposit;
		$report2['rjmhdepositrp'] = $jmhdepositrp;

 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
		$this->m_transaksi->HapusTransaksi($nomor);
	    redirect(base_url().'transaksi/listhariandebit/'.$brand);
 	}


	public function listhariankredit($id){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$cbrand  		 = array('bid' => $id);		
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$data['idbrand'] = $userbrand->bid;
		$data['user'] 	 = $userbrand->bfield1;
		$data['brand']	 = $userbrand->bnama;

		$data['lists'] = $this->m_transaksi->ListTransaksiHarianKredit($id);

		$data['title'] = 'List Transaksi Harian Withdraw '. $data['brand'].' - '.BRAND;
		$data['page']  = 'backend/transaksi/listhariankredit';
		$this->load->view('backend/thamplate', $data); 
	}

	public function addtransaksikredit($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$cbrand  		 = array('bid' => $id);		
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$data['idbrand'] = $userbrand->bid;
		$data['brand']	 = $userbrand->bnama;

		$data['transfer'] 	= $this->m_rekening->RekeningTransfer();
		$data['lists'] 		= $this->m_rekening->Rekening();
		
		$data['title'] = 'Input Pengeluaran Dana Withdraw '. $data['brand'].' - '.BRAND;
		$data['page']  = 'backend/transaksi/addtransaksikredit';
		$this->load->view('backend/thamplate', $data);	
	}

	public function addtransaksikredit_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('transfer', 'Transfer Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('user', 'User Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
		  		$user 	 	= $this->input->post('user');
		  		$nominal 	= str_replace(".", "", $this->input->post('nominal'));
		  		$brand 	 	= $this->input->post('idbrand');
				$periode 	= date('Y-m-d', strtotime($this->input->post('tanggal')));

				$cbrand  	= array('bid' => $brand);		
				$userbrand 	= $this->m_brand->CariBrand($cbrand);
				$depo  		= $userbrand->bfield2;
				$cus   		= $userbrand->bfield1;
				$where 		= array($cus => $user);

		  		$cperiode  	= array('rperiode' => $periode);		
				$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

		  		$detacustomer 	= $this->m_customer->CariDataCustomer($where);
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
		  		$count 	 		= $this->m_customer->CariCustomer($where)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($saldorekening->rsaldo < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, saldo rekening tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($detacustomer->$depo < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, saldo deposit customer tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

	  	 		$tambahsaldo 	= $saldorekening->rsaldo-$nominal;
	  	 		$tambahsaldocus = $detacustomer->$depo-$nominal;

	  	 		$iduser 		= $detacustomer->cid;
				$row[$depo] 	= $tambahsaldocus;

				$penerima 		= $this->input->post('transfer');
				$data['rsaldo'] = $tambahsaldo;

				$record['tcustomer']	= $detacustomer->cid;
				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $this->input->post('transfer');
				$record['ttujuan']		= $this->input->post('norek');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 4;
				$record['tsubjenis']	= 52;
				$record['tbrand']		= $brand;
				$record['tsubdeposit'] 	= 62;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tketerangan']  = 'Withdraw dana harian '.$this->input->post('brand').' - '.$user;;
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				if($report == NULL){
					$report['rperiode']		  = $periode;
					$report['rjmhwithdraw']	  = 1;
					$report['rjmhwithdrawrp'] = $nominal;
					$report['rstatus']		  = 1;
					$report['rdate']		  = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhwithdraw			   = $report->rjmhwithdraw+1;
					$jmhwithdrawrp			   = $report->rjmhwithdrawrp+$nominal;
					
					$periode				   = $periode;
					$report2['rjmhwithdraw']   = $jmhwithdraw;
					$report2['rjmhwithdrawrp'] = $jmhwithdrawrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

	  	 		$this->m_customer->EditCustomerAct($iduser, $row);
	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
	       		redirect(base_url().'transaksi/listhariankredit/'.$brand);
		  	}
	    }
	}

	public function edittransaksikredit($brand,$nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$cbrand  		 = array('bid' => $brand);		
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$data['idbrand'] = $userbrand->bid;
		$data['user'] 	 = $userbrand->bfield1;
		$data['brand']	 = $userbrand->bnama;

 		$data['detail'] = $this->m_transaksi->DetailTransaksiHarianKredit($brand,$nomor);
		$data['lists'] 	= $this->m_rekening->Rekening();
		
		$data['title'] = 'Edit Pengeluaran Dana Withdraw '. $data['brand'].' - '.BRAND;
 		$data['page']  = 'backend/transaksi/edittransaksikredit';
 		$this->load->view('backend/thamplate', $data);
	}
 	
	public function edittransaksikredit_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('transfer', 'Transfer Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
		  		$user 	 	= $this->input->post('user');
		  		$nominal 	= str_replace(",", "", $this->input->post('nominal'));
		  		$brand 	 	= $this->input->post('brand');
		  		$oldnominal = $this->input->post('oldnominal');
				$periode	= date('Y-m-d', strtotime($this->input->post('tanggal')));

				$cbrand  	= array('bid' => $brand);		
				$userbrand 	= $this->m_brand->CariBrand($cbrand);
				$depo  = $userbrand->bfield2;
				$cus   = $userbrand->bfield1;
				$where = array($cus => $user);

		  		$cperiode  	= array('rperiode' => $periode);		
				$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

		  		$detacustomer 	= $this->m_customer->CariDataCustomer($where);
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
		  		$count 	 		= $this->m_customer->CariCustomer($where)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($saldorekening->rsaldo+$oldnominal < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, saldo rekening tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($detacustomer->$depo+$oldnominal < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, saldo deposit customer tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

	  	 		$tambahsaldo 	= $saldorekening->rsaldo+$oldnominal-$nominal;
	  	 		$tambahsaldocus = $detacustomer->$depo+$oldnominal-$nominal;

	  	 		$iduser 		= $detacustomer->cid;
				$row[$depo] 	= $tambahsaldocus;

				$penerima 			= $this->input->post('transfer');
				$data['rsaldo'] 	= $tambahsaldo;
				
				$transaksi 				= $this->input->post('nomor');
				$record['tcustomer']	= $detacustomer->cid;
				$record['tdari']		= $this->input->post('transfer');
				$record['ttujuan']		= $this->input->post('norek');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 4;
				$record['tsubjenis']	= 52;
				$record['tbrand']		= $brand;
				$record['tsubdeposit'] 	= 62;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tketerangan']  = 'Withdraw dana harian '.$userbrand->bnama.' - '.$user;;
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				if($report == NULL){
					$report['rperiode']		  = $periode;
					$report['rjmhwithdraw']	  = 1;
					$report['rjmhwithdrawrp'] = $nominal;
					$report['rstatus']		  = 1;
					$report['rdate']		  = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhwithdraw			   = $report->rjmhwithdraw;
					$jmhwithdrawrp			   = $report->rjmhwithdrawrp-$nominal;
					
					$periode				   = $periode;
					$report2['rjmhwithdraw']   = $jmhwithdraw;
					$report2['rjmhwithdrawrp'] = $jmhwithdrawrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

	  	 		$this->m_customer->EditCustomerAct($iduser, $row);
	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);	
	       		redirect(base_url().'transaksi/listhariankredit/'.$brand);
		  	}
	    }
	}

 	public function hapustransaksikredit($brand,$nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$this->load->model('m_reportlabarugi');
 		$detail 	= $this->m_transaksi->DetailTransaksiHarianDebit($brand,$nomor);
		$periode	= $detail->tperiode;
  		$cperiode  	= array('rperiode' => $periode);		
		$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

		$jmhdeposit		= $report->rjmhdeposit-1;
		$jmhdepositrp	= $report->rjmhdepositrp-$detail->tgrandtotal;
		
		$periode				  = $periode;
		$report2['rjmhdeposit']	  = $jmhdeposit;
		$report2['rjmhdepositrp'] = $jmhdepositrp;

 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
		$this->m_transaksi->HapusTransaksi($nomor);
	    redirect(base_url().'transaksi/listhariankredit/'.$brand);
 	}

	public function listharianpermainan($id){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$cbrand  		 = array('bid' => $id);		
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$data['idbrand'] = $userbrand->bid;
		$data['user'] 	 = $userbrand->bfield1;
		$data['brand']	 = $userbrand->bnama;

		$data['lists'] = $this->m_transaksi->ListTransaksiHarianPermainan($id);
		$data['title'] = 'List Transaksi Harian permainan '. $data['brand'].' - '.BRAND;
		$data['page']  = 'backend/transaksi/listharianpermainan';
		$this->load->view('backend/thamplate', $data); 
	}

	public function addtransaksipermainan($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$cbrand  		 = array('bid' => $id, 'bstatus' => 1);	
		$cntbrand  		 = array('bstatus' => 1, 'bchild' => $id);	
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$countbrand 	 = $this->m_brand->CBrand($cntbrand)->num_rows();
		$data['idbrand'] = $userbrand->bid;
		$data['brand']	 = $userbrand->bnama;


		if($countbrand > 0){
			$data['lists']   = $this->m_brand->GroupBrand($id);
		}else{
			$data['lists']   = $this->m_brand->SingleBrand($id);
		}

		$data['title']   = 'Input Data Permainan '. $data['brand'].' - '.BRAND;
		$data['page']    = 'backend/transaksi/addtransaksipermainan';
		$this->load->view('backend/thamplate', $data);	
	}

	public function addtransaksipermainan_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('idbrand', 'Brand', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('user', 'Username', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Date', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
		  		$user 	 = $this->input->post('user');
		  		$brand 	 = $this->input->post('brand');
		  		$sbrand  = $this->input->post('idbrand');
		  		$comm 	 = $this->input->post('commbonus');
		  		$referal = $this->input->post('referral');
				$periode = date('Y-m-d', strtotime($this->input->post('tanggal')));

				$cbrand  	= array('bid' => $brand);
				$sbrand  	= array('bid' => $sbrand);
				$userbrand 	= $this->m_brand->CariBrand($cbrand);
				$subbrand 	= $this->m_brand->CariBrand($sbrand);
				$cus   		= $userbrand->bfield1;
				$depo  		= $userbrand->bfield2;
				$labarugi  	= $subbrand->bfield3;
				$where 		= array($cus => $user);
		  		$cperiode  	= array('rperiode' => $periode);		
				$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

  	 			$saldorekening 	= $this->m_rekening->RekeningTransfer();
		  		$detacustomer 	= $this->m_customer->CariDataCustomer($where);
		  		$count 	 		= $this->m_customer->CariCustomer($where)->num_rows();	
  	 			$calcu 			= $comm+$referal;
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($saldorekening->rsaldo < $calcu){
		            $this->session->set_flashdata('warning', 'Maaf, saldo rekening tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($calcu != 0){
		  			$calcu 		= $calcu;
		  			$subjenis 	= 52;
		  			$dari 		= $saldorekening->rno;
		  			$tujuan 	= 'Pengeluaran Bonus';
		  			$keterangan = 'Data pengeluaran bonus '.$subbrand->bnama.' - '.$userbrand->bnama;
		  		}else{
		  			$calcu 		= $calcu;
		  			$subjenis 	= 53;
		  			$dari 		= '';
		  			$tujuan 	= '';
		  			$keterangan = 'Data Permainan Harian '.$userbrand->bnama.' - '.$user;
		  		}
  	 			$tambahsaldo 	= $saldorekening->rsaldo-$calcu;

				$record['tcustomer']	= $detacustomer->cid;
				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $dari;
				$record['ttujuan']		= $tujuan;
				$record['twin']			= $this->input->post('win');
				$record['tlose']		= $this->input->post('lose');
				$record['tmembercomm']	= $this->input->post('commbonus');
				$record['tbonus']		= $this->input->post('referral');
				$record['tharga']		= $calcu;
				$record['tgrandtotal']	= $calcu;
				$record['tjenis']		= 9;
				$record['tsubjenis']	= $subjenis;
				$record['tbrand']		= $brand;
				$record['tsubbrand']	= $this->input->post('idbrand');
				$record['tketerangan']  = $keterangan;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				$rekening 				= $saldorekening->rno;
				$data['rsaldo'] 		= $tambahsaldo;

				if($report == NULL){
					$winlose 		   = $this->input->post('win')-$this->input->post('lose');
					$commbonus 		   = $this->input->post('commbonus');
					$referral 		   = $this->input->post('referral');

					$akumulasiwinlose  = $winlose;
					$akumulasicomm	   = $commbonus;
					$akumulasireferral = $referral;
					$akumulasigros     = $winlose-$commbonus-$referral;
					$akumulasigross	   = $akumulasigros;

					$report['rperiode']	  	 	= $periode;
					$report[$labarugi] 	  	 	= $winlose;
					$report['rtotalwinlose'] 	= $akumulasiwinlose;
					$report['rcommbonus'] 	 	= $akumulasicomm;
					$report['rreferralbonus']	= $akumulasireferral;
					$report['rwinlosegross']	= $akumulasigross;
					$report['rstatus']	  	 	= 1;
					$report['rdate']	  	 	= date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$winlose			= $this->input->post('win')-$this->input->post('lose');
					$commbonus 		   	= $this->input->post('commbonus');
					$referral 		   	= $this->input->post('referral');

					$jmhwinlose		   = $report->$labarugi+$winlose;
					$akumulasiwinlose  = $report->rtotalwinlose+$winlose;
					$akumulasicomm	   = $report->rcommbonus+$commbonus;
					$akumulasireferral = $report->rreferralbonus+$referral;
					$akumulasigros     = $akumulasiwinlose-$akumulasicomm-$akumulasireferral;
					$akumulasigross	   = $akumulasigros;
					
					$periode			  	  	= $periode;
					$report2[$labarugi]	  	  	= $jmhwinlose;
					$report2['rtotalwinlose'] 	= $akumulasiwinlose;
					$report2['rcommbonus'] 	 	= $akumulasicomm;
					$report2['rreferralbonus']	= $akumulasireferral;
					$report2['rwinlosegross']	= $akumulasigross;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}
	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
  	 			$this->m_rekening->UpdateSaldo($rekening, $data);	
	       		redirect(base_url().'transaksi/listharianpermainan/'.$brand);
		  	}
	    }
	}
	 
	public function edittransaksipermainan($brand,$nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}		
		$cbrand  		 = array('bid' => $brand, 'bstatus' => 1);	
		$cntbrand  		 = array('bstatus' => 1, 'bchild' => $brand);	
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$countbrand 	 = $this->m_brand->CBrand($cntbrand)->num_rows();
		$data['idbrand'] = $userbrand->bid;
		$data['user'] 	 = $userbrand->bfield1;
		$data['brand']	 = $userbrand->bnama;

		if($countbrand > 0){
			$data['lists']   = $this->m_brand->GroupBrand($brand);
		}else{
			$data['lists']   = $this->m_brand->SingleBrand($brand);
		}

 		$data['detail'] = $this->m_transaksi->DetailTransaksiHarianPermainan($brand,$nomor);
		
		$data['title'] = 'Edit Data Permainan '. $data['brand'].' - '.BRAND;
 		$data['page']  = 'backend/transaksi/edittransaksipermainan';
 		$this->load->view('backend/thamplate', $data);
	}
 	
	public function edittransaksipermainan_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('idbrand', 'Brand', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('user', 'Username', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Date', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
		  		$user 	 = $this->input->post('user');
		  		$brand 	 = $this->input->post('brand');
		  		$sbrand  = $this->input->post('idbrand');
		  		$comm 	 = $this->input->post('commbonus');
		  		$referal = $this->input->post('referral');
		  		$oldtotal= $this->input->post('oldtotal');
				$periode = date('Y-m-d', strtotime($this->input->post('tanggal')));

				$cbrand  	= array('bid' => $brand);
				$sbrand  	= array('bid' => $sbrand);
				$userbrand 	= $this->m_brand->CariBrand($cbrand);
				$subbrand 	= $this->m_brand->CariBrand($sbrand);
				$cus   		= $userbrand->bfield1;
				$depo  		= $userbrand->bfield2;
				$labarugi  	= $subbrand->bfield3;
				$where 		= array($cus => $user);
		  		$cperiode  	= array('rperiode' => $periode);		
				$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

  	 			$saldorekening 	= $this->m_rekening->RekeningTransfer();
		  		$detacustomer 	= $this->m_customer->CariDataCustomer($where);
		  		$count 	 		= $this->m_customer->CariCustomer($where)->num_rows();	
  	 			$calcu 			= $comm+$referal;
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($saldorekening->rsaldo < $calcu){
		            $this->session->set_flashdata('warning', 'Maaf, saldo rekening tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($calcu != 0){
		  			$calcu 		= $calcu;
		  			$subjenis 	= 52;
		  			$dari 		= $saldorekening->rno;
		  			$tujuan 	= 'Pengeluaran Bonus';
		  			$keterangan = 'Data pengeluaran bonus '.$subbrand->bnama.' - '.$userbrand->bnama;
		  		}else{
		  			$calcu 		= $calcu;
		  			$subjenis 	= 53;
		  			$dari 		= '';
		  			$tujuan 	= '';
		  			$keterangan = 'Data Permainan Harian '.$userbrand->bnama.' - '.$user;
		  		}
  	 			$tambahsaldo 	= $saldorekening->rsaldo+$oldtotal-$calcu;

				$transaksi 				= $this->input->post('nomor');
				$record['tdari']		= $dari;
				$record['ttujuan']		= $tujuan;
				$record['twin']			= $this->input->post('win');
				$record['tlose']		= $this->input->post('lose');
				$record['tmembercomm']	= $this->input->post('commbonus');
				$record['tbonus']		= $this->input->post('referral');
				$record['tharga']		= $calcu;
				$record['tgrandtotal']	= $calcu;
				$record['tjenis']		= 9;
				$record['tsubjenis']	= $subjenis;
				$record['tbrand']		= $brand;
				$record['tsubbrand']	= $this->input->post('idbrand');
				$record['tketerangan']  = $keterangan;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				$rekening 				= $saldorekening->rno;
				$data['rsaldo'] 		= $tambahsaldo;

				if($report == NULL){
					$winlose 		   = $this->input->post('win')-$this->input->post('lose');
					$commbonus 		   = $this->input->post('commbonus');
					$referral 		   = $this->input->post('referral');

					$akumulasiwinlose  = $winlose;
					$akumulasicomm	   = $commbonus;
					$akumulasireferral = $referral;
					$akumulasigros     = $winlose-$commbonus-$referral;
					$akumulasigross	   = $akumulasigros;

					$report['rperiode']	  	 	= $periode;
					$report[$labarugi] 	  	 	= $winlose;
					$report['rtotalwinlose'] 	= $akumulasiwinlose;
					$report['rcommbonus'] 	 	= $akumulasicomm;
					$report['rreferralbonus']	= $akumulasireferral;
					$report['rwinlosegross']	= $akumulasigross;
					$report['rstatus']	  	 	= 1;
					$report['rdate']	  	 	= date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$winlose			= $this->input->post('win')-$this->input->post('lose');
					$commbonus 		   	= $this->input->post('commbonus');
					$referral 		   	= $this->input->post('referral');

					$oldwinlose			= $this->input->post('oldwin')-$this->input->post('oldlose');
					$oldcommbonus 		= $this->input->post('oldcomm');
					$oldreferral 		= $this->input->post('oldreferral');

					$jmhwinlose		    = $report->$labarugi-$oldwinlose+$winlose;
					$akumulasiwinlose   = $report->rtotalwinlose-$oldwinlose+$winlose;
					$akumulasicomm	    = $report->rcommbonus-$oldcommbonus+$commbonus;
					$akumulasireferral  = $report->rreferralbonus-$oldreferral+$referral;
					$akumulasigros      = $akumulasiwinlose-$akumulasicomm-$akumulasireferral;
					$akumulasigross	    = $akumulasigros;
					
					$periode			  	  	= $periode;
					$report2[$labarugi]	  	  	= $jmhwinlose;
					$report2['rtotalwinlose'] 	= $akumulasiwinlose;
					$report2['rcommbonus'] 	 	= $akumulasicomm;
					$report2['rreferralbonus']	= $akumulasireferral;
					$report2['rwinlosegross']	= $akumulasigross;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);
 				$this->m_rekening->UpdateSaldo($rekening, $data);		
	       		redirect(base_url().'transaksi/listharianpermainan/'.$brand);
		  	}
	    }
	}

 	public function hapustransaksipermainan($brand,$nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_reportlabarugi');
	  	$this->load->model('m_brand');
 		$detail 	= $this->m_transaksi->DetailTransaksiHarianPermainan($brand,$nomor);
		$sbrand  	= array('bid' => $detail->tsubbrand);
		$subbrand 	= $this->m_brand->CariBrand($sbrand);
		$labarugi  	= $subbrand->bfield3;

		$periode	= $detail->tperiode;
  		$cperiode  	= array('rperiode' => $periode);		
		$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

		$jmhwinlose		    = $report->$labarugi-$detail->twin-$detail->tlose;
		$akumulasiwinlose   = $report->rtotalwinlose-$detail->twin-$detail->tlose;
		$akumulasicomm	    = $report->rcommbonus-$detail->tmembercomm;
		$akumulasireferral  = $report->rreferralbonus-$detail->tbonus;
		$akumulasigros      = $akumulasiwinlose-$akumulasicomm-$akumulasireferral;
		$akumulasigross	    = $akumulasigros;
		
		$periode			  	  	= $periode;
		$report2[$labarugi]	  	  	= $jmhwinlose;
		$report2['rtotalwinlose'] 	= $akumulasiwinlose;
		$report2['rcommbonus'] 	 	= $akumulasicomm;
		$report2['rreferralbonus']	= $akumulasireferral;
		$report2['rwinlosegross']	= $akumulasigross;

 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);
		$this->m_transaksi->HapusTransaksi($nomor);
	    redirect(base_url().'transaksi/listharianpermainan/'.$brand);
 	}

 	public function detailtransaksi($brand,$user){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_customer');
		$cbrand  		 = array('bid' => $brand, 'bstatus' => 1);	
		$cntbrand  		 = array('bstatus' => 1, 'bchild' => $brand);	
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$countbrand 	 = $this->m_brand->CBrand($cntbrand)->num_rows();
		$data['idbrand'] = $userbrand->bid;
		$data['brand']	 = $userbrand->bnama;
		$data['user'] 	 = $userbrand->bfield1;
		$data['saldo'] 	 = $userbrand->bfield2;
		$where 			 = array($data['user'] => $user);

		$data['customer'] 	= $this->m_customer->CariDataCustomer($where);
		$data['debits'] 	= $this->m_transaksi->ListTransaksiDetailDebit($brand,$where);
		$data['kredits'] 	= $this->m_transaksi->ListTransaksiDetailKredit($brand,$where);
		$data['permainans'] = $this->m_transaksi->ListTransaksiDetailPermainan($brand,$where);

		$data['title'] = 'Detail Transaksi Harian User '. $data['brand'].' - '.BRAND;
		$data['page']  = 'backend/transaksi/detailtransaksiharian';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function listharianbonus($id){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$cbrand  		 = array('bid' => $id);		
		$userbrand 		 = $this->m_brand->CariBrand($cbrand);
		$data['idbrand'] = $userbrand->bid;
		$data['user'] 	 = $userbrand->bfield1;
		$data['brand']	 = $userbrand->bnama;

		$data['lists'] = $this->m_transaksi->ListTransaksiHarianPermainan($id);
		$data['title'] = 'List Transaksi Harian permainan '. $data['brand'].' - '.BRAND;
		$data['page']  = 'backend/transaksi/listharianpermainan';
		$this->load->view('backend/thamplate', $data); 
	}

 	public function listdeposit(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_transaksi->Deposit();

		$data['title'] = 'List Deposit SDSB Online - '.BRAND;
		$data['page']  = 'backend/transaksi/listdeposit';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function adddeposit(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['transfer'] 	= $this->m_rekening->RekeningPenerima();
		$data['lists'] 		= $this->m_rekening->Rekening();
		
		$data['title'] = 'Input Deposit Baru - '.BRAND;
		$data['page']  = 'backend/transaksi/adddeposit';
		$this->load->view('backend/thamplate', $data);	
	}

	public function adddeposit_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('user', 'Username', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('daribank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pemilik', 'Pemilik Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('norek', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('nominal', 'Nominal Deposit', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_voucher');
	  			$this->load->model('m_reportlabarugi');
	  			$date 	  = date('Y-m-d');
		  		$where 	  = array('cuser' => $this->input->post('user'));
		  		$deposit  = str_replace(".", "", $this->input->post('nominal'));
		  		$cperiode = array('rperiode' => $date);		
				$report   = $this->m_reportlabarugi->CariLabaRugi($cperiode);

				$rekening = $this->m_rekening->RekeningPenerima();
		  		$customer = $this->m_customer->CariDataCustomer($where);
		  		$count 	  = $this->m_customer->CariCustomer($where)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

		  		if($this->input->post('voucher') != ''){
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

				if($report == NULL){
					$report['rperiode']		 = $date;
					$report['rjmhdeposit']	 = 1;
					$report['rjmhdepositrp'] = $total;
					$report['rstatus']		 = 1;
					$report['rdate']		 = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhdeposit		= $report->rjmhdeposit+1;
					$jmhdepositrp	= $report->rjmhdepositrp+$total;
					
					$periode				  = $date;
					$report2['rjmhdeposit']	  = $jmhdeposit;
					$report2['rjmhdepositrp'] = $jmhdepositrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}
				
	  	 		$this->m_transaksi->SaveTransaksi($data);	
 				$this->m_customer->EditCustomerAct($idcus, $row);
 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	       		redirect(base_url().'transaksi/listdeposit/');
		  	}
	    }
	}

	public function depositkonfirmasi_act($nomor){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_customer');
 		$transaksi  = $this->m_transaksi->DetailDeposit($nomor);
		$where 	 	= array('cid' => $transaksi->tcustomer);
 		$customer 	= $this->m_customer->CariDataCustomer($where);
		$rekening 	= $this->m_rekening->RekeningPenerima();

		$calcucus 	= $transaksi->tgrandtotal+$customer->cdeposit;
		$calcurek 	= $rekening->rsaldo+$transaksi->tgrandtotal;

		$idrek 				= $rekening->rno;
		$data['rsaldo'] 	= $calcurek;

		$idcus 				= $customer->cid;
		$row['cdeposit'] 	= $calcucus;

		$idtran 			= $transaksi->tnomor;
		$record['tstatus']	= 1;

 		$this->m_rekening->UpdateSaldo($idrek, $data);	
 		$this->m_customer->EditCustomerAct($idcus, $row);
 		$this->m_transaksi->UpdateTransaksi($idtran, $record);
	    redirect(base_url().'transaksi/listdeposit/');	
	}

 	public function hapusdeposit($nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$this->m_transaksi->HapusTransaksi($nomor);
	    redirect(base_url().'transaksi/listdeposit/');
 	}

 	public function listkupon(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_transaksi->Kupon();

		$data['title'] = 'List Nomor Kupon SDSB Online - '.BRAND;
		$data['page']  = 'backend/transaksi/listkupon';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addkupon(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['transfer'] 	= $this->m_rekening->RekeningPenerima();
		$data['lists'] 		= $this->m_rekening->Rekening();
		
		$data['title'] = 'Input Nomor Kupon Baru - '.BRAND;
		$data['page']  = 'backend/transaksi/addkupon';
		$this->load->view('backend/thamplate', $data);	
	}

	public function addkupon_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}		
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  			$this->load->model('m_nomor');
				$this->load->model('m_general');
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
	  			$date 	  	= date('Y-m-d');
	  			$id 		= $this->input->post("userid");
				$cusdepo 	= $this->input->post("deposito");
				$jumlah 	= $this->input->post("jumlah");
				$nomor  	= random_string('alnum', 15);
				$rekening 	= $this->m_rekening->RekeningPenerima();
		  		$cperiode 	= array('rperiode' => $date);		
				$report   	= $this->m_reportlabarugi->CariLabaRugi($cperiode);


		  		if($jumlah == 0 || $jumlah == ''){
					$total = 0;
		  		}else{
					$cek = $this->m_general->CekPotongan($jumlah);
					if($cek > 0){
		 				$harga		= $this->m_general->SearchHarga();
		 				$potongan	= $this->m_general->SearchPotongan($jumlah);
						$total 		= $jumlah*$harga->gharga;
						$calculate 	= $potongan->gdiskon/100*$total;
						$diskon 	= $potongan->gdiskon;
						$bruto 		= $total-$calculate; 
		 			}else{
		 				$diskon 	= 0;
		 				$harga 		= $this->m_general->SearchHarga();
						$bruto		= $jumlah*$harga->gharga;
		 			}
		 			$harga	= $this->m_general->SearchHarga();
		 			$total 	= $jumlah*$harga->gharga;
		  		}

		  		if($cusdepo < $total){
		        	$this->session->set_flashdata('warning', 'Maaf, Jumlah deposit kurang!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
				$updatedeposit		= $cusdepo-$total;
				$calcurek 			= $rekening->rsaldo+$total;
				$idrek 				= $rekening->rno;
				$record['rsaldo'] 	= $calcurek;
				
				for ($x = 1; $x <= $jumlah; $x++){
					$voucher 	= random_string('numeric', 6);
			  		$count 		= $this->m_nomor->CountNomor($voucher);
			  		if($count > 0){
						$voucher1 			= random_string('numeric', 6);
						$data['tcustomer']	= $id;
						$data['tnomor']		= $nomor;
						$data['tkupon']		= $voucher1;
						$data['tpotongan']	= $diskon;
						$data['tharga'] 	= $bruto;
						$data['tgrandtotal']= $total;
						$data['tdari'] 		= $this->input->post("user");
						$data['ttujuan'] 	= $rekening->rno;
						$data['tjenis'] 	= 3;
						// $data['tsubjenis'] 	= 51;
						$data['tsubdeposit']= 62;
						$data['tbrand'] 	= 5;
						$data['tketerangan']= 'Pembelian nomor kupon sdsb '.$this->input->post("user") ;
						$data['tstatus']	= 1;
						$data['tperiode']	= $date;
						$data['tuser']		= $this->session->userdata('id');
						$data['tdate'] 		= date('Y-m-d H:i:s');
						$row['ncustomer']	= $id;
						$row['nnomor']		= $voucher1;
						$row['nperiode']	= date('Y-m-d H:i:s');
	  	 				$this->m_transaksi->SaveTransaksi($data);
	  	 				$this->m_nomor->SaveNomor($row);	
			  		}else{
						$data['tcustomer']	= $id;
						$data['tnomor']		= $nomor;
						$data['tkupon']		= $voucher;
						$data['tpotongan']	= $diskon;
						$data['tharga'] 	= $bruto;
						$data['tgrandtotal']= $total;
						$data['tdari'] 		= $this->input->post("user");
						$data['ttujuan'] 	= $rekening->rno;
						$data['tjenis'] 	= 3;
						// $data['tsubjenis'] 	= 51;
						$data['tsubdeposit']= 62;
						$data['tbrand'] 	= 5;
						$data['tketerangan']= 'Pembelian nomor kupon sdsb '.$this->input->post("user") ;
						$data['tstatus']	= 1;
						$data['tperiode']	= $date;
						$data['tuser']		= $this->session->userdata('id');
						$data['tdate'] 		= date('Y-m-d H:i:s');
						$row['ncustomer']	= $id;
						$row['nnomor']		= $voucher;
						$row['nperiode']	= date('Y-m-d H:i:s');
	  	 				$this->m_transaksi->SaveTransaksi($data);
	  	 				$this->m_nomor->SaveNomor($row);	
			  	 	}
				} 

				if($report == NULL){
					$report['rperiode']		 = $date;
					$report['rjmhdeposit']	 = 1;
					$report['rjmhdepositrp'] = $total;
					$report['rstatus']		 = 1;
					$report['rdate']		 = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhdeposit		= $report->rjmhdeposit+1;
					$jmhdepositrp	= $report->rjmhdepositrp+$total;
					
					$periode				  = $date;
					$report2['rjmhdeposit']	  = $jmhdeposit;
					$report2['rjmhdepositrp'] = $jmhdepositrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}
		
 				// $this->m_rekening->UpdateSaldo($idrek,$record);	
			  	$this->m_customer->UpdateDeposit($id,$updatedeposit);
				redirect(base_url('transaksi/listkupon'));
		  	}
	    }
	}

 	public function hapuskupon($kupon){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$this->m_transaksi->HapusKupon($kupon);
	    redirect(base_url().'transaksi/listkupon/');
 	}

 	public function listtransfer(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_transaksi->TransferDana();

		$data['title'] = 'List Transfer Dana - '.BRAND;
		$data['page']  = 'backend/transaksi/listtransfer';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addtransfer(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['brands'] 		= $this->m_brand->Brand();
		
		$data['title'] = 'Input Transfer Dana Baru - '.BRAND;
		$data['page']  = 'backend/transaksi/addtransfer';
		$this->load->view('backend/thamplate', $data);	
	}

	public function addtransfer_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('user', 'username SDSB', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('deposit', 'deposit', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('dari', 'Sumber Dana', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tujuan', 'Tujuan Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_brand');
	  			$date 	  	= date('Y-m-d');
	  			$nominal 	= str_replace(".", "", $this->input->post('nominal'));
				$brand		= $this->input->post("brand");
				$user	 	= $this->input->post("user");
				$tujuan	 	= $this->input->post("tujuan");
		  		$where  	= array('bnama' => $brand);		
		  		$cektujuan  = array('bnama' => $tujuan);	
				$userbrand 	= $this->m_brand->CariBrand($where);
				$tujuan 	= $this->m_brand->CariBrand($cektujuan);
				$deposit 	= $userbrand->bfield2;		
				$deposit2 	= $tujuan->bfield2;	

				$where2 = array(
				    $userbrand->bfield1 => $user
			    );

		  		$customer = $this->m_customer->CariDataCustomer($where2);
		  		$count 	  = $this->m_customer->CariCustomer($where2)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($customer->$deposit < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, deposit tidak mencukupi!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$cuscalcu = $customer->$deposit-$nominal;
		  		$cuskirim = $customer->$deposit2+$nominal;

				$data['tcustomer']	 = $customer->cid;
				$data['tnomor']		 = random_string('alnum', 15);
				$data['tdari']	 	 = $this->input->post('dari');
				$data['ttujuan']	 = $this->input->post('tujuan');
				$data['tharga']		 = $nominal;
				$data['tgrandtotal'] = $nominal;
				$data['tjenis']		 = 4;
				$data['tbrand']		 = $userbrand->bid;
				$data['tsubdeposit'] = 62;
				$data['tketerangan'] = 'Transfer dana customer ke '.$this->input->post('tujuan').' - '.$customer->cuser;
				$data['tstatus']	 = 1;
				$data['tuser'] 		 = $this->session->userdata('id');
				$data['tdate'] 		 = date('Y-m-d H:i:s');

				$idcus 				 = $customer->cid;
				$record[$deposit]  	 = $cuscalcu;

				$idcus 				   	= $customer->cid;
				$row[$tujuan->bfield2] 	= $cuskirim;

	  	 		$this->m_transaksi->SaveTransaksi($data);	
			  	$this->m_customer->EditCustomerAct($idcus,$record);
			  	$this->m_customer->EditCustomerAct($idcus,$row);
	       		redirect(base_url().'transaksi/listtransfer/');
		  	}
	    }
	}

	public function edittransfer($nomor){
		 if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
 		$data['detail'] = $this->m_transaksi->DetailTransferDana($nomor);
		$data['lists']	= $this->m_rekening->Rekening();
		$data['brands'] = $this->m_brand->Brand();
		
		$data['title'] = 'Edit Transfer Dana - '.BRAND;
 		$data['page']  = 'backend/transaksi/edittransfer';
 		$this->load->view('backend/thamplate', $data);
	}

	public function edittransfer_act(){
				if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('user', 'Username', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('deposit', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Pemilik Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('dari', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tujuan', 'Nominal Deposit', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_brand');
	  			$nominal 	= str_replace(",", "", $this->input->post('nominal'));
	  			$oldnominal = $this->input->post("oldnominal");
				$brand		= $this->input->post("brand");
				$user	 	= $this->input->post("user");
				$tujuan	 	= $this->input->post("tujuan");
		  		$where  	= array('bnama' => $brand);		
		  		$cektujuan  = array('bnama' => $tujuan);		
				$userbrand 	= $this->m_brand->CariBrand($where);
				$tujuan 	= $this->m_brand->CariBrand($cektujuan);
				$deposit 	= $userbrand->bfield2;			
				$deposit2 	= $tujuan->bfield2;	

				$where2 = array(
				    $userbrand->bfield1 => $user
			    );

		  		$customer = $this->m_customer->CariDataCustomer($where2);
		  		$count 	  = $this->m_customer->CariCustomer($where2)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($customer->$deposit < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, deposit tidak mencukupi!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$cuscalcu = $customer->$deposit+$oldnominal-$nominal;
		  		$cuskirim = $customer->$deposit2-$oldnominal+$nominal;

				$transaksi 				= $this->input->post('nomor');
				$record['tdari']	 	= $this->input->post('dari');
				$record['ttujuan']	 	= $this->input->post('tujuan');
				$record['tharga']		= $nominal;
				$record['tgrandtotal'] 	= $nominal;
				$record['tjenis']		= 4;
				$record['tbrand']		= $userbrand->bid;
				$record['tsubdeposit'] 	= 62;
				$record['tketerangan'] 	= 'Transfer dana customer ke '.$this->input->post('tujuan').' - '.$customer->cuser;
				$record['tstatus']	 	= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				$idcus 				 	= $customer->cid;
				$data[$deposit]  	 	= $cuscalcu;
				// var_dump($data[$deposit]);die();

				$idcus 				   	= $customer->cid;
				$row[$tujuan->bfield2] 	= $cuskirim;

	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);	
			  	$this->m_customer->EditCustomerAct($idcus,$data);
			  	$this->m_customer->EditCustomerAct($idcus,$row);
	       		redirect(base_url().'transaksi/listtransfer');
		  	}
	    }
	}

 	public function hapustransfer($nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$this->m_transaksi->HapusTransferDana($nomor);
	    redirect(base_url().'transaksi/listtransfer/');
 	}
	
	public function listwithdraw(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_transaksi->WithdrawDana();

		$data['title'] = 'List Withdraw Dana - '.BRAND;
		$data['page']  = 'backend/transaksi/listwirhdraw';
		$this->load->view('backend/thamplate', $data); 
	}

 	public function addwithdraw(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['transfer'] 	= $this->m_rekening->RekeningTransfer();
		$data['lists'] 		= $this->m_rekening->Rekening();
		$data['brands'] 	= $this->m_brand->Brand();
		
		$data['title'] = 'Input Withdraw Dana Baru - '.BRAND;
		$data['page']  = 'backend/transaksi/addwithdraw';
		$this->load->view('backend/thamplate', $data);	
	}	

	public function addwithdraw_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('brand', 'Brand', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('user', 'user', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('rekening', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_brand');
	  			$nominal 	= $this->input->post("nominal");
				$brand		= $this->input->post("brand");
				$user	 	= $this->input->post("user");
		  		$where  	= array('bnama' => $brand);		
				$userbrand 	= $this->m_brand->CariBrand($where);
				$deposit 	= $userbrand->bfield2;		

				$where2 = array(
				    $userbrand->bfield1 => $user
			    );

				$rekening = $this->m_rekening->RekeningTransfer();
		  		$customer = $this->m_customer->CariDataCustomer($where2);
		  		$count 	  = $this->m_customer->CariCustomer($where2)->num_rows();	
			  	if($count == 0){
		            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($customer->$deposit < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, deposit tidak mencukupi!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($rekening->rsaldo < $nominal){
		   		$this->session->set_flashdata('warning', 'Maaf, rekening saldo tidak mencukupi!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		$cuscalcu = $customer->$deposit-$nominal;
		  		$rekcalcu = $rekening->rsaldo-$nominal;

				$data['tcustomer']	 = $customer->cid;
				$data['tnomor']		 = random_string('alnum', 15);
				$data['tdari']	 	 = $this->input->post('dari');
				$data['ttujuan']	 = $this->input->post('tujuan');
				$data['tharga']		 = $nominal;
				$data['tgrandtotal'] = $nominal;
				$data['tjenis']		 = 7;
				$data['tsubjenis']	 = 52;
				$data['tbrand']		 = $userbrand->bid;
				$data['tsubdeposit'] = 62;
				$data['tketerangan'] = 'Withdraw dana customer '.$customer->cuser;
				$data['tstatus']	 = 1;
				$data['tuser'] 		 = $this->session->userdata('id');
				$data['tdate'] 		 = date('Y-m-d H:i:s');

				$idrek 				 = $rekening->rno;
				$row['rsaldo'] 		 = $rekcalcu;

				$idcus 				 = $customer->cid;
				$record[$deposit]  	 = $cuscalcu;

	  	 		$this->m_transaksi->SaveTransaksi($data);	
 				$this->m_rekening->UpdateSaldo($idrek,$row);	
			  	$this->m_customer->EditCustomerAct($idcus,$record);
	       		redirect(base_url().'transaksi/listwithdraw/');
		  	}
	    }
	}

 	public function hapuswithdraw($nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$this->m_transaksi->HapusWithdrawDana($nomor);
	    redirect(base_url().'transaksi/listtransfer/');
 	}
}