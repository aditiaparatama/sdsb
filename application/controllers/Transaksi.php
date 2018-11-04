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
	  			$this->load->model('m_detailcustomer');
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
				$record['tjenis']		= 1;
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

		  		$rdbrand  		= $brand;	
		  		$rdcustomer 	= $detacustomer->cid;
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $periode;
					$rdreport['rdcustomerid']	 = $detacustomer->cid;
					$rdreport['rdbrand']		 = $brand;
					$rdreport['rddeposit'] 		 = $nominal;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahdeposit				 = $rdreport->rddeposit+$nominal;
					$rdcust				  	 	 = $detacustomer->cid;	
					$rdbrand				  	 = $brand;
					$rdreport2['rddeposit']	 	 = $tambahdeposit;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
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
	  			$this->load->model('m_detailcustomer');
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
				$record['ttujuan']		= $this->input->post('transfer');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
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

		  		$rdbrand  		= $userbrand->bid;	
		  		$rdcustomer 	= $detacustomer->cid;
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $periode;
					$rdreport['rdcustomerid']	 = $detacustomer->cid;
					$rdreport['rdbrand']		 = $userbrand->bid;
					$rdreport['rddeposit'] 		 = $nominal;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahdeposit				 = $rdreport->rddeposit-$oldnominal+$nominal;
					$rdcust				  	 	 = $detacustomer->cid;	
					$rdbrand				  	 = $userbrand->bid;
					$rdreport2['rddeposit']	 	 = $tambahdeposit;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
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
		$this->load->model('m_customer');
		$this->load->model('m_reportlabarugi');
		$this->load->model('m_detailcustomer');
 		$detail 	= $this->m_transaksi->DetailTransaksiHarianDebit($brand,$nomor);
		$periode	= $detail->tperiode;
  		$cperiode  	= array('rperiode' => $periode);		
		$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);
		$cbrand  	= array('bid' => $brand);		
		$userbrand 	= $this->m_brand->CariBrand($cbrand);
		$deposit 	= $userbrand->bfield2;

		$jmhdeposit		= $report->rjmhdeposit-1;
		$jmhdepositrp	= $report->rjmhdepositrp-$detail->tgrandtotal;
		
		$periode				  = $periode;
		$report2['rjmhdeposit']	  = $jmhdeposit;
		$report2['rjmhdepositrp'] = $jmhdepositrp;

		$penerima 				  = $detail->rno;
		$data['rsaldo'] 		  = $detail->rsaldo-$detail->tgrandtotal;

		$idcustomer 			  = $detail->tcustomer;
		$customer[$deposit] 	  = $detail->$deposit-$detail->tgrandtotal; 

		$rdbrand  				  = $detail->tbrand;	
  		$rdcustomer 			  = $detail->tcustomer;
  		$caridetail  			  = array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		$rdreport 				  = $this->m_detailcustomer->CariDetailCustomer($caridetail);

		$tambahdeposit			  = $rdreport->rddeposit-$detail->tgrandtotal;
		$rdcust				  	  = $detail->tcustomer;	
		$rdbrand				  = $detail->tbrand;
		$rdreport2['rddeposit']	  = $tambahdeposit;

	 	$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
 		$this->m_customer->EditCustomerAct($idcustomer, $customer);
	  	$this->m_rekening->UpdateSaldo($penerima, $data);	
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
	  			$this->load->model('m_detailcustomer');
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
				$record['trekeningdari']= $saldorekening->rno;
				$record['tdari']		= 'DEPOSIT '.$userbrand->bnama;
				$record['ttujuan']		= $this->input->post('norek');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 2;
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

		  		$rdbrand  		= $brand;	
		  		$rdcustomer 	= $detacustomer->cid;
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $periode;
					$rdreport['rdcustomerid']	 = $detacustomer->cid;
					$rdreport['rdbrand']		 = $brand;
					$rdreport['rdwithdraw'] 	 = $nominal;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahwithdraw				 = $rdreport->rdwithdraw+$nominal;
					$rdcust				  	 	 = $detacustomer->cid;	
					$rdbrand				  	 = $brand;
					$rdreport2['rdwithdraw']	 = $tambahwithdraw;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
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
		$data['saldo'] 	 = $userbrand->bfield2;
		$data['brand']	 = $userbrand->bnama;

 		$data['detail'] = $this->m_transaksi->DetailTransaksiHarianKredit($brand,$nomor);
		$data['lists'] 	= $this->m_rekening->Rekening();
  	 	$data['bank'] 	= $this->m_rekening->RekeningTransfer();
		
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
	  			$this->load->model('m_detailcustomer');
		  		$user 	 	= $this->input->post('user');
		  		$nominal 	= str_replace(",", "", $this->input->post('nominal'));
		  		$brand 	 	= $this->input->post('brand');
		  		$oldnominal = $this->input->post('oldnominal');
				$periode	= date('Y-m-d', strtotime($this->input->post('tanggal')));

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
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
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
					$jmhwithdrawrp			   = $report->rjmhwithdrawrp+$nominal-$oldnominal;
					
					$periode				   = $periode;
					$report2['rjmhwithdraw']   = $jmhwithdraw;
					$report2['rjmhwithdrawrp'] = $jmhwithdrawrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

		  		$rdbrand  		= $userbrand->bid;	
		  		$rdcustomer 	= $detacustomer->cid;
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $periode;
					$rdreport['rdcustomerid']	 = $detacustomer->cid;
					$rdreport['rdbrand']		 = $userbrand->bid;
					$rdreport['rdwithdraw'] 	 = $nominal;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahwithdraw				 = $rdreport->rdwithdraw+$nominal-$oldnominal;
					$rdcust				  	 	 = $detacustomer->cid;	
					$rdbrand				  	 = $userbrand->bid;
					$rdreport2['rdwithdraw']	 = $tambahwithdraw;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
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
		$this->load->model('m_customer');
		$this->load->model('m_reportlabarugi');
		$this->load->model('m_detailcustomer');
 		$detail 	= $this->m_transaksi->DetailTransaksiHarianKredit($brand,$nomor);
		$periode	= $detail->tperiode;
  		$cperiode  	= array('rperiode' => $periode);		
		$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);
		$cbrand  	= array('bid' => $brand);		
		$userbrand 	= $this->m_brand->CariBrand($cbrand);
		$deposit 	= $userbrand->bfield2;

		$jmhdeposit		= $report->rjmhwithdraw-1;
		$jmhdepositrp	= $report->rjmhwithdrawrp-$detail->tgrandtotal;
		
		$periode				  = $periode;
		$report2['rjmhwithdraw']  = $jmhdeposit;
		$report2['rjmhwithdrawrp']= $jmhdepositrp;

		$penerima 				  = $detail->rno;
		$data['rsaldo'] 		  = $detail->rsaldo+$detail->tgrandtotal;

		$idcustomer 			  = $detail->tcustomer;
		$customer[$deposit] 	  = $detail->$deposit+$detail->tgrandtotal; 

  		$rdbrand  		= $detail->tbrand;	
  		$rdcustomer 	= $detail->tcustomer;
  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

		if($rdreport == NULL){
			$rdreport['rdperiode']		 = $periode;
			$rdreport['rdcustomerid']	 = $detail->tcustomer;
			$rdreport['rdbrand']		 = $detail->tbrand;
			$rdreport['rdwithdraw'] 	 = 0;
			$rdreport['rdstatus']		 = 1;
			$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	 		$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
		}else{
			$tambahwithdraw				 = $rdreport->rdwithdraw-$detail->tgrandtotal;
			$rdcust				  	 	 = $detail->tcustomer;	
			$rdbrand				  	 = $detail->tbrand;
			$rdreport2['rdwithdraw']	 = $tambahwithdraw;

	 		$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
		}

 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
 		$this->m_customer->EditCustomerAct($idcustomer, $customer);
	  	$this->m_rekening->UpdateSaldo($penerima, $data);	
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
		$data['tanggal'] = date('Y-m-d',strtotime(date('Y-m-d') . "-1 days"));
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
			$this->form_validation->set_rules('win', 'Win/Lose', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
	  			$this->load->model('m_detailcustomer');
		  		$win  	 = $this->input->post('win');
		  		$user 	 = $this->input->post('user');
		  		$brand 	 = $this->input->post('brand');
		  		$sbrand  = $this->input->post('idbrand');
		  		$comm    = str_replace(".", "", $this->input->post('commbonus'));
		  		$referal = str_replace(".", "", $this->input->post('referral'));
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
		  		if($win < 0){
		  			$datawin 	= 0;
		  			$datalose 	= $win;
		  		}else{
		  			$datawin 	= $win;
		  			$datalose 	= 0;
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
  	 			$tambahsaldo 			= $saldorekening->rsaldo-$calcu-$win;

				$record['tcustomer']	= $detacustomer->cid;
				$record['tnomor']		= random_string('alnum', 15);
				$record['trekeningdari']= $saldorekening->rno;
				$record['tdari']		= $dari;
				$record['ttujuan']		= $tujuan;
				$record['twin']			= $datawin;
				$record['tlose']		= $datalose;
				$record['tmembercomm']	= str_replace(".", "", $this->input->post('commbonus'));
				$record['tbonus']		= str_replace(".", "", $this->input->post('referral'));
				$record['tbonus2']		= $win;
				$record['tharga']		= $calcu;
				$record['tgrandtotal']	= $calcu;
				$record['tjenis']		= 6;
				$record['tsubjenis']	= $subjenis;
				$record['tbrand']		= $brand;
				$record['tsubbrand']	= $this->input->post('idbrand');
				$record['tsubdeposit']  = 61;
 				$record['tketerangan']  = $keterangan;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				$idcus 					= $detacustomer->cid;
				$row[$depo] 			= $detacustomer->$depo+$comm+$referal+$win;	

				$rekening 				= $saldorekening->rno;
				$data['rsaldo'] 		= $tambahsaldo;

				if($report == NULL){
					$winlose 		   = $win;
					$commbonus 		   = str_replace(".", "", $this->input->post('commbonus'));
					$referral 		   = str_replace(".", "", $this->input->post('referral'));

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
					$winlose		   = $win;
					$commbonus 		   = str_replace(".", "", $this->input->post('commbonus'));
					$referral 		   = str_replace(".", "", $this->input->post('referral'));

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

				$rdbrand  		= $brand;	
		  		$rdcustomer 	= $detacustomer->cid;
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $periode;
					$rdreport['rdcustomerid']	 = $detacustomer->cid;
					$rdreport['rdbrand']		 = $brand;
					$rdreport['rddeposit']	 	 = $comm+$referal+$win;
					$rdreport['rdwinlose'] 		 = $win;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahdeposit 				 = $rdreport->rddeposit+$comm+$referal+$win;
					$tambahwinlose				 = $rdreport->rdwinlose+$winlose;
					$rdcust				  	 	 = $detacustomer->cid;	
					$rdbrand				  	 = $brand;
					$rdreport2['rddeposit']	 	 = $tambahdeposit;
					$rdreport2['rdwinlose']	 	 = $tambahwinlose;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
				}
	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
  	 			$this->m_rekening->UpdateSaldo($rekening, $data);	
 				$this->m_customer->EditCustomerAct($idcus, $row);
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
		
		if($data['detail']->twin == 0){
			$data['win'] = $data['detail']->tlose;
		}else{
			$data['win'] = $data['detail']->twin;
		}

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
			$this->form_validation->set_rules('win', 'Win/Lose', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_reportlabarugi');
	  			$this->load->model('m_detailcustomer');
		  		$win  	 = $this->input->post('win');
		  		$user 	 = $this->input->post('user');
		  		$brand 	 = $this->input->post('brand');
		  		$sbrand  = $this->input->post('idbrand');
		  		$comm    = str_replace(",", "", $this->input->post('commbonus'));
		  		$referal = str_replace(",", "", $this->input->post('referral'));
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
		  		if($win < 0){
		  			$datawin 	= 0;
		  			$datalose 	= $win;
  	 				$calcuwin 	= $this->input->post('oldbonus2')+$win;
		  		}else{
		  			$datawin 	= $win;
		  			$datalose 	= 0;
  	 				$calcuwin 	= $win-$this->input->post('oldbonus2');
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
				$record['trekeningdari']= $saldorekening->rno;
				$record['tdari']		= $dari;
				$record['ttujuan']		= $tujuan;
				$record['twin']			= $datawin;
				$record['tlose']		= $datalose;
				$record['tmembercomm']	= str_replace(",", "", $this->input->post('commbonus'));
				$record['tbonus']		= str_replace(",", "", $this->input->post('referral'));
				$record['tbonus2']		= $win;
				$record['tharga']		= $calcu;
				$record['tgrandtotal']	= $calcu;
				$record['tjenis']		= 6;
				$record['tsubjenis']	= $subjenis;
				$record['tbrand']		= $brand;
				$record['tsubbrand']	= $this->input->post('idbrand');
				$record['tketerangan']  = $keterangan;
				$record['tperiode']		= date('Y-m-d H:i:s', strtotime($this->input->post('tanggal')));
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				$idcus 					= $detacustomer->cid;
				$row[$depo] 			= $detacustomer->$depo-$this->input->post('oldtotal')+$calcu+$calcuwin;

				$rekening 				= $saldorekening->rno;
				$data['rsaldo'] 		= $tambahsaldo-$calcuwin;

				if($report == NULL){
					$winlose		   = $win;
					$commbonus 		   = str_replace(",", "", $this->input->post('commbonus'));
					$referral 		   = str_replace(",", "", $this->input->post('referral'));

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
					$winlose		    = $win;
					$commbonus 		   	= str_replace(",", "", $this->input->post('commbonus'));
					$referral 		   	= str_replace(",", "", $this->input->post('referral'));

					$oldwinlose			= $this->input->post('oldwin');
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

				if($win != $this->input->post('oldbonus2')){
					$rdbrand  		= $brand;	
			  		$rdcustomer 	= $detacustomer->cid;
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $detacustomer->cid;
						$rdreport['rdbrand']		 = $brand;
						$rdreport['rddeposit']	 	 = $comm+$referal+$win;
						$rdreport['rdwinlose'] 		 = $oldwinlose+$winlose;
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit 				 = $rdreport->rddeposit-$this->input->post('oldtotal')+$calcu+$win-$this->input->post('oldbonus2');
						$tambahwinlose				 = $rdreport->rdwinlose-$oldwinlose+$winlose;
						$rdcust				  	 	 = $detacustomer->cid;	
						$rdbrand				  	 = $brand;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;
						$rdreport2['rdwinlose']	 	 = $tambahwinlose;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}

		  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);
	 				$this->m_rekening->UpdateSaldo($rekening, $data);		
	 				$this->m_customer->EditCustomerAct($idcus, $row);
		       		redirect(base_url().'transaksi/listharianpermainan/'.$brand);
	       		}
		  	}
	    }
	}

 	public function hapustransaksipermainan($brand,$nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_brand');
	  	$this->load->model('m_reportlabarugi');
	  	$this->load->model('m_detailcustomer');
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

		$rdbrand  		= $detail->tbrand;	
  		$rdcustomer 	= $detail->tcustomer;
  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

		$tambahwinlose				 = $rdreport->rdwinlose-$detail->tbonus2;
		$tambahdeposit 				 = $rdreport->rddeposit-$detail->tbonus2-$akumulasireferral;
		$rdcust				  	 	 = $detail->tcustomer;
		$rdbrand				  	 = $detail->tbrand;
		$rdreport2['rddeposit']	 	 = $tambahdeposit;
		$rdreport2['rdwinlose']	 	 = $tambahwinlose;

 		$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	

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
	  			$this->load->model('m_detailcustomer');
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
				$data['tperiode'] 	 = date('Y-m-d');
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

		  		$rdbrand  		= 5;	
		  		$rdcustomer 	= $customer->cid;
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $periode;
					$rdreport['rdcustomerid']	 = $customer->cid;
					$rdreport['rdbrand']		 = 5;
					$rdreport['rddeposit'] 		 = $deposit;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahdeposit				 = $rdreport->rddeposit+$deposit;
					$rdcust				  	 	 = $customer->cid;	
					$rdbrand				  	 = 5;
					$rdreport2['rddeposit']	 	 = $tambahdeposit;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
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
	  	$this->load->model('m_reportlabarugi');
	  	$this->load->model('m_detailcustomer');
	  	$date 	  = date('Y-m-d');
 		$transaksi  = $this->m_transaksi->DetailDeposit($nomor);
		$where 	 	= array('cid' => $transaksi->tcustomer);
 		$customer 	= $this->m_customer->CariDataCustomer($where);
		$rekening 	= $this->m_rekening->RekeningPenerima();
		$cperiode   = array('rperiode' => $date);		
		$report     = $this->m_reportlabarugi->CariLabaRugi($cperiode);

		$calcucus 	= $transaksi->tgrandtotal+$customer->cdeposit;
		$calcurek 	= $rekening->rsaldo+$transaksi->tgrandtotal;

		$idrek 				= $rekening->rno;
		$data['rsaldo'] 	= $calcurek;

		$idcus 				= $customer->cid;
		$row['cdeposit'] 	= $calcucus;

		$idtran 			= $transaksi->tnomor;
		$record['tstatus']	= 1;
		$record['tuser']	= $this->session->userdata('id');

		if($report == NULL){
			$report['rperiode']		 = $date;
			$report['rjmhdeposit']	 = 1;
			$report['rjmhdepositrp'] = $transaksi->tgrandtotal;
			$report['rstatus']		 = 1;
			$report['rdate']		 = date('Y-m-d H:i:s');

	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
		}else{
			$jmhdeposit		= $report->rjmhdeposit+1;
			$jmhdepositrp	= $report->rjmhdepositrp+$transaksi->tgrandtotal;
			
			$periode				  = $date;
			$report2['rjmhdeposit']	  = $jmhdeposit;
			$report2['rjmhdepositrp'] = $jmhdepositrp;

	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
		}

  		$rdbrand  		= 5;	
  		$rdcustomer 	= $customer->cid;
  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

		if($rdreport == NULL){
			$rdreport['rdperiode']		 = $periode;
			$rdreport['rdcustomerid']	 = $customer->cid;
			$rdreport['rdbrand']		 = 5;
			$rdreport['rddeposit'] 		 = $transaksi->tgrandtotal;
			$rdreport['rdstatus']		 = 1;
			$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
		}else{
			$tambahdeposit				 = $rdreport->rddeposit+$transaksi->tgrandtotal;
			$rdcust				  	 	 = $customer->cid;	
			$rdbrand				  	 = 5;
			$rdreport2['rddeposit']	 	 = $tambahdeposit;

	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
		}

 		$this->m_rekening->UpdateSaldo($idrek, $data);	
 		$this->m_customer->EditCustomerAct($idcus, $row);
 		$this->m_transaksi->UpdateTransaksi($idtran, $record);
	    redirect(base_url().'transaksi/listdeposit/');	
	}

 	public function hapusdeposit($nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_customer');
	  	$this->load->model('m_reportlabarugi');
	  	$this->load->model('m_detailcustomer');
 		$detail 	= $this->m_transaksi->DetailDebit($nomor);
		$periode	= $detail->tperiode;
  		$cperiode  	= array('rperiode' => $periode);		
		$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);
  		$rdbrand  	= 5;	
  		$rdcustomer = $detail->cid;
  		$caridetail = array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		$rdreport 	= $this->m_detailcustomer->CariDetailCustomer($caridetail);


		$jmhdeposit		= $report->rjmhdeposit-1;
		$jmhdepositrp	= $report->rjmhdepositrp-$detail->tgrandtotal;
		
		$periode				  = $periode;
		$report2['rjmhdeposit']	  = $jmhdeposit;
		$report2['rjmhdepositrp'] = $jmhdepositrp;

		$idcustomer 			  = $detail->cid;
		$customer['cdeposit'] 	  = $detail->cdeposit-$detail->tgrandtotal; 

		$idrekening 			  = $detail->rid;
		$rekening['rsaldo'] 	  = $detail->rsaldo-$detail->tgrandtotal; 

		$tambahdeposit			  = $rdreport->rddeposit-$detail->tgrandtotal;
		$rdcust				  	  = $detail->cid;	
		$rdbrand				  = 5;
		$rdreport3['rddeposit']	  = $tambahdeposit;

		$this->m_transaksi->HapusDeposit($nomor);
 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
 		$this->m_customer->EditCustomerAct($idcustomer, $customer);
 		$this->m_rekening->UpdateRekening($idrekening, $rekening);	
		$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport3);	
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
	  			$id 		= $this->input->post("userid");
				$cusdepo 	= $this->input->post("deposito");
				$jumlah 	= $this->input->post("jumlah");
				$nomor  	= random_string('alnum', 15);
				$rekening 	= $this->m_rekening->RekeningPenerima();

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
						$total 		= $total-$calculate; 
		 			}else{
		 				$diskon 	= 0;
		 				$harga 		= $this->m_general->SearchHarga();
						$bruto		= $jumlah*$harga->gharga;
		 				$total 		= $jumlah*$harga->gharga;
		 			}
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
						$data['tsubdeposit']= 62;
						$data['tbrand'] 	= 5;
						$data['tketerangan']= 'Pembelian nomor kupon sdsb '.$this->input->post("user") ;
						$data['tstatus']	= 1;
						$data['tperiode']	= date('Y-m-d');
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
						$data['tsubdeposit']= 62;
						$data['tbrand'] 	= 5;
						$data['tketerangan']= 'Pembelian nomor kupon sdsb '.$this->input->post("user") ;
						$data['tstatus']	= 1;
						$data['tperiode']	= date('Y-m-d');
						$data['tuser']		= $this->session->userdata('id');
						$data['tdate'] 		= date('Y-m-d H:i:s');
						$row['ncustomer']	= $id;
						$row['nnomor']		= $voucher;
						$row['nperiode']	= date('Y-m-d H:i:s');
	  	 				$this->m_transaksi->SaveTransaksi($data);
	  	 				$this->m_nomor->SaveNomor($row);	
			  	 	}
				} 
			
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
	  			$this->load->model('m_brand');
	  			$this->load->model('m_customer');
	  			$this->load->model('m_detailcustomer');
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
				$data['tperiode'] 	 = date('Y-m-d');
				$data['tdate'] 		 = date('Y-m-d H:i:s');

				$idcus 				 = $customer->cid;
				$record[$deposit]  	 = $cuscalcu;

				$idcus 				   	= $customer->cid;
				$row[$tujuan->bfield2] 	= $cuskirim;

		  		$rdbrand  		= $userbrand->bid;	
		  		$rdbrand2  		= $tujuan->bid;	
		  		$rdcustomer 	= $customer->cid;	
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		  		$caridetail2  	= array('rdbrand' => $rdbrand2, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);
				$rdreport2 		= $this->m_detailcustomer->CariDetailCustomer($caridetail2);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $date;
					$rdreport['rdcustomerid']	 = $customer->cid;
					$rdreport['rdbrand']		 = $userbrand->bid;
					$rdreport['rddeposit'] 	 	 = $nominal;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahwithdraw				 = $rdreport->rddeposit-$nominal;
					$rdcust				  	 	 = $customer->cid;	
					$rdbrand				  	 = $userbrand->bid;
					$rdreport3['rddeposit']	 	 = $tambahwithdraw;

					$tambahwithdraw2			 = $rdreport2->rddeposit+$nominal;
					$rdcust2				  	 = $customer->cid;	
					$rdbrand2				  	 = $tujuan->bid;
					$rdreport4['rddeposit']	 	 = $tambahwithdraw2;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport3);	
	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust2, $rdbrand2, $rdreport4);	
				}

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
	  			$nominal 		= str_replace(",", "", $this->input->post('nominal'));
	  			$oldnominal 	= $this->input->post("oldnominal");
				$brand			= str_replace('DEPOSIT ', '', $this->input->post("brand"));
				$user	 		= $this->input->post("user");
				$tujuan	 		= $this->input->post("tujuan");
				$oldtujuan  	= $this->input->post("oldtujuan");
		  		$where  		= array('bnama' => $brand);		
		  		$cektujuan  	= array('bnama' => $tujuan);	
		  		$cekoldtujuan 	= array('bnama' => $oldtujuan);		
				$userbrand 		= $this->m_brand->CariBrand($where);
				$tujuan 		= $this->m_brand->CariBrand($cektujuan);
				$oldtujuan 		= $this->m_brand->CariBrand($cekoldtujuan);
				$deposit 		= $userbrand->bfield2;		
				$deposit2 		= $tujuan->bfield2;			
				$deposit3 		= $oldtujuan->bfield2;		

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
		  		if($tujuan != $oldtujuan){
					$idcus 				   		= $customer->cid;
					$old[$oldtujuan->bfield2] 	= $customer->$deposit3-$oldnominal;
			  		$this->m_customer->EditCustomerAct($idcus,$old);
		  		}
		  		if($customer->$deposit2 == 0){
		  			$cuskirim = $customer->$deposit2+$nominal;
		  			$cuscalcu = $customer->$deposit+$oldnominal-$nominal;
			  	}else if($tujuan != $oldtujuan){
			  		$cuskirim = $customer->$deposit2+$nominal;
		  			$cuscalcu = $customer->$deposit+$oldnominal-$nominal;
			  	}else{
			  		$cuskirim = $customer->$deposit2-$oldnominal+$nominal;
		  			$cuscalcu = $customer->$deposit+$oldnominal-$nominal;
			  	}

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
				$record['tperiode'] 	= date('Y-m-d');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				$idcus 				 	= $customer->cid;
				$data[$deposit]  	 	= $cuscalcu;

				$idcus 				   	= $customer->cid;
				$row[$tujuan->bfield2] 	= $cuskirim;

	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);	
			  	$this->m_customer->EditCustomerAct($idcus,$data);
			  	$this->m_customer->EditCustomerAct($idcus,$row);
	       		redirect(base_url().'transaksi/listtransfer');
		  	}
	    }
	}

	public function transferkonfirmasi_act($nomor){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$this->load->model('m_customer');
		$this->load->model('m_brand');
 		$transaksi  = $this->m_transaksi->DetailTransferDana($nomor);
		$nominal 	= $transaksi->tgrandtotal;
  		$where  	= array('bid' => $transaksi->tbrand);		
  		$cektujuan  = array('bnama' => $transaksi->ttujuan);	
		$userbrand 	= $this->m_brand->CariBrand($where);
		$tujuan 	= $this->m_brand->CariBrand($cektujuan);
		$deposit 	= $userbrand->bfield2;		
		$deposit2 	= $tujuan->bfield2;	
		$user 		= $userbrand->bfield1;

		$where2 = array(
		    $userbrand->bfield1 => $transaksi->$user
	    );

  		$customer = $this->m_customer->CariDataCustomer($where2);
  		$count 	  = $this->m_customer->CariCustomer($where2)->num_rows();	
	  	if($count == 0){
            $this->session->set_flashdata('warning', 'Maaf, user tidak ditemukan!');
			redirect($_SERVER['HTTP_REFERER']);
  		}
  		if($customer->$deposit < $transaksi->tgrandtotal){
            $this->session->set_flashdata('warning', 'Maaf, deposit tidak mencukupi!');
			redirect($_SERVER['HTTP_REFERER']);
  		}
  		$cuscalcu = $customer->$deposit-$transaksi->tgrandtotal;
  		$cuskirim = $customer->$deposit2+$transaksi->tgrandtotal;

		$idtran 			= $transaksi->tnomor;
		$record['tstatus']	= 1;
		$record['tuser']	= $this->session->userdata('id');

		$idcus 				= $customer->cid;
		$record2[$deposit]  = $cuscalcu;

		$idcus 				= $customer->cid;
		$row[$deposit2] 	= $cuskirim;

 		$this->m_transaksi->UpdateTransaksi($idtran, $record);
	  	$this->m_customer->EditCustomerAct($idcus,$record2);
	  	$this->m_customer->EditCustomerAct($idcus,$row);
   		redirect(base_url().'transaksi/listtransfer/');
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
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('rekening', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_brand');
	  			$this->load->model('m_reportlabarugi');
	  			$this->load->model('m_detailcustomer');
	  			$date 	    = date('Y-m-d');
	  			$nominal 	= str_replace(".", "", $this->input->post('nominal'));
				$brand		= $this->input->post("brand");
				$user	 	= $this->input->post("user");
		  		$where  	= array('bnama' => $brand);		
				$userbrand 	= $this->m_brand->CariBrand($where);
				$deposit 	= $userbrand->bfield2;		
		  		$cperiode 	= array('rperiode' => $date);		
				$report   	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

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
				$data['trekeningdari'] = $rekening->rno;
				$data['tdari']	 	 = $this->input->post('dari');
				$data['ttujuan']	 = $this->input->post('tujuan');
				$data['tharga']		 = $nominal;
				$data['tgrandtotal'] = $nominal;
				$data['tjenis']		 = 2;
				$data['tsubjenis']	 = 52;
				$data['tbrand']		 = $userbrand->bid;
				$data['tsubdeposit'] = 64;
				$data['tketerangan'] = 'Withdraw dana customer '.$customer->cuser;
				$data['tstatus']	 = 1;
				$data['tuser'] 		 = $this->session->userdata('id');
				$data['tperiode'] 	 = $date;
				$data['tdate'] 		 = date('Y-m-d H:i:s');

				$idrek 				 = $rekening->rno;
				$row['rsaldo'] 		 = $rekcalcu;

				$idcus 				 = $customer->cid;
				$record[$deposit]  	 = $cuscalcu;

				if($report == NULL){
					$report['rperiode']		  = $date;
					$report['rjmhwithdraw']	  = 1;
					$report['rjmhwithdrawrp'] = $nominal;
					$report['rstatus']		  = 1;
					$report['rdate']		  = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhwithdraw		= $report->rjmhwithdraw+1;
					$jmhwithdrawrp		= $report->rjmhwithdrawrp+$nominal;
					
					$periode				   = $date;
					$report2['rjmhwithdraw']   = $jmhwithdraw;
					$report2['rjmhwithdrawrp'] = $jmhwithdrawrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

		  		$rdbrand  		= $userbrand->bid;	
		  		$rdcustomer 	= $customer->cid;	
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $date;
					$rdreport['rdcustomerid']	 = $customer->cid;
					$rdreport['rdbrand']		 = $userbrand->bid;
					$rdreport['rdwithdraw'] 	 = $nominal;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahwithdraw				 = $rdreport->rdwithdraw+$nominal;
					$rdcust				  	 	 = $customer->cid;	
					$rdbrand				  	 = $userbrand->bid;
					$rdreport2['rdwithdraw']	 = $tambahwithdraw;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
				}

	  	 		$this->m_transaksi->SaveTransaksi($data);	
 				$this->m_rekening->UpdateSaldo($idrek,$row);	
			  	$this->m_customer->EditCustomerAct($idcus,$record);
	       		redirect(base_url().'transaksi/listwithdraw/');
		  	}
	    }
	}

	public function editwithdraw($nomor){
		 if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
 		$data['detail'] 	= $this->m_transaksi->DetailWithdrawDana($nomor);
		$data['transfer'] 	= $this->m_rekening->RekeningTransfer();
  		$where  			= array('bid' => $data['detail']->tbrand);		
		$userbrand 			= $this->m_brand->CariBrand($where);
		$username 			= $userbrand->bfield1;
		$deposit 			= $userbrand->bfield2;
		$data['user'] 		= $data['detail']->$username;
		$data['sumber'] 	= 'DEPOSIT '.$userbrand->bnama;
		$data['deposit'] 	= $data['detail']->$deposit+$data['detail']->tgrandtotal;

		
		$data['title'] = 'Edit Withdraw Dana - '.BRAND;
 		$data['page']  = 'backend/transaksi/editwithdraw';
 		$this->load->view('backend/thamplate', $data);
	}

	public function editwithdraw_act(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nominal', 'Pemilik Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
	  			$this->load->model('m_customer');
	  			$this->load->model('m_brand');
	  			$this->load->model('m_reportlabarugi');
	  			$this->load->model('m_detailcustomer');
	  			$date 	    = date('Y-m-d');
	  			$nominal 	= str_replace(",", "", $this->input->post('nominal'));
	  			$oldnominal = $this->input->post("oldnominal");
				$brand		= $this->input->post("brand");
				$user	 	= $this->input->post("user");
		  		$where  	= array('bnama' => $brand);		
				$userbrand 	= $this->m_brand->CariBrand($where);
				$deposit 	= $userbrand->bfield2;		
		  		$cperiode 	= array('rperiode' => $date);		
				$report   	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

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
		  		if($customer->$deposit+$oldnominal < $nominal){
		            $this->session->set_flashdata('warning', 'Maaf, deposit tidak mencukupi!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($rekening->rsaldo < $nominal){
		   		$this->session->set_flashdata('warning', 'Maaf, rekening saldo tidak mencukupi!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

		  		$cuscalcu = $customer->$deposit-$nominal+$oldnominal;
		  		$rekcalcu = $rekening->rsaldo-$nominal+$oldnominal;

				$transaksi	 		 = $this->input->post("nomor");
				$data['tstatus']	 = 1;
				$data['tharga']	 	 = $nominal;
				$data['tgrandtotal'] = $nominal;
				$data['tuser'] 		 = $this->session->userdata('id');
				$data['tperiode'] 	 = $date;

				$idcus 				 = $customer->cid;
				$record[$deposit]  	 = str_replace("-", "", $cuscalcu);

				$idrek 				 = $rekening->rno;
				$row['rsaldo'] 		 = $rekcalcu;

				if($report == NULL){
					$report['rperiode']		  = $date;
					$report['rjmhwithdraw']	  = 1;
					$report['rjmhwithdrawrp'] = $nominal;
					$report['rstatus']		  = 1;
					$report['rdate']		  = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$jmhwithdrawrp		= $report->rjmhwithdraw-1;
					$jmhwithdrawrp		= $report->rjmhwithdrawrp+$nominal-$oldnominal;
					
					$periode				   = $date;
					$report2['rjmhwithdrawrp'] = $jmhwithdrawrp;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

		  		$rdbrand  		= $userbrand->bid;	
		  		$rdcustomer 	= $customer->cid;	
		  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
				$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

				if($rdreport == NULL){
					$rdreport['rdperiode']		 = $date;
					$rdreport['rdcustomerid']	 = $customer->cid;
					$rdreport['rdbrand']		 = $userbrand->bid;
					$rdreport['rdwithdraw'] 	 = $nominal;
					$rdreport['rdstatus']		 = 1;
					$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
				}else{
					$tambahwithdraw				 = $rdreport->rdwithdraw+$nominal-$oldnominal;
					$rdcust				  	 	 = $customer->cid;	
					$rdbrand				  	 = $userbrand->bid;
					$rdreport2['rdwithdraw']	 = $tambahwithdraw;

	  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
				}

	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $data);	
 				$this->m_rekening->UpdateSaldo($idrek,$row);	
			  	$this->m_customer->EditCustomerAct($idcus,$record);
	       		redirect(base_url().'transaksi/listwithdraw');
		  	}
	    }
	}

	public function withdrawkonfirmasi_act($nomor){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$this->load->model('m_customer');
		$this->load->model('m_brand');
		$this->load->model('m_reportlabarugi');
		$this->load->model('m_detailcustomer');
 		$transaksi  = $this->m_transaksi->DetailWithdrawDana($nomor);
	  	$date 	    = date('Y-m-d');
	  	$nominal 	= $transaksi->tgrandtotal;
		$user	 	= $this->input->post("user");
  		$where  	= array('bnama' => $transaksi->bnama);		
		$userbrand 	= $this->m_brand->CariBrand($where);
		$deposit 	= $userbrand->bfield2;		
  		$cperiode 	= array('rperiode' => $date);		
		$report   	= $this->m_reportlabarugi->CariLabaRugi($cperiode);
		$user 		= $userbrand->bfield1;

		$where2 = array(
		    $userbrand->bfield1 => $transaksi->$user
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

		$idtran	 			 = $transaksi->tnomor;
		$data['tstatus']	 = 1;
		$data['tuser'] 		 = $this->session->userdata('id');

		$idrek 				 = $rekening->rno;
		$row['rsaldo'] 		 = $rekcalcu;

		$idcus 				 = $customer->cid;
		$record[$deposit]  	 = $cuscalcu;

		if($report == NULL){
			$report['rperiode']		  = $date;
			$report['rjmhwithdraw']	  = 1;
			$report['rjmhwithdrawrp'] = $nominal;
			$report['rstatus']		  = 1;
			$report['rdate']		  = date('Y-m-d H:i:s');

	 		$this->m_reportlabarugi->SaveLabaRugi($report);	
		}else{
			$jmhwithdraw		= $report->rjmhwithdraw+1;
			$jmhwithdrawrp		= $report->rjmhwithdrawrp+$nominal;
			
			$periode				   = $date;
			$report2['rjmhwithdraw']   = $jmhwithdraw;
			$report2['rjmhwithdrawrp'] = $jmhwithdrawrp;

	 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
		}

  		$rdbrand  		= $userbrand->bid;	
  		$rdcustomer 	= $customer->cid;	
  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

		if($rdreport == NULL){
			$rdreport['rdperiode']		 = $date;
			$rdreport['rdcustomerid']	 = $customer->cid;
			$rdreport['rdbrand']		 = $userbrand->bid;
			$rdreport['rdwithdraw'] 	 = $nominal;
			$rdreport['rdstatus']		 = 1;
			$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
		}else{
			$tambahwithdraw				 = $rdreport->rdwithdraw+$nominal;
			$rdcust				  	 	 = $customer->cid;	
			$rdbrand				  	 = $userbrand->bid;
			$rdreport2['rdwithdraw']	 = $tambahwithdraw;

	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
		}

 		$this->m_transaksi->UpdateTransaksi($idtran, $data);
		$this->m_rekening->UpdateSaldo($idrek,$row);	
	  	$this->m_customer->EditCustomerAct($idcus,$record);
   		redirect(base_url().'transaksi/listwithdraw/');
	}

 	public function hapuswithdraw($nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_customer');
	  	$this->load->model('m_reportlabarugi');
	  	$this->load->model('m_detailcustomer');
 		$detail 	= $this->m_transaksi->DetailWithdrawDana($nomor); 
		$rekening 	= $this->m_rekening->RekeningTransfer();
		$periode	= $detail->tperiode;
  		$cperiode  	= array('rperiode' => $periode);		
		$report 	= $this->m_reportlabarugi->CariLabaRugi($cperiode);

		$jmhwithdraw	= $report->rjmhwithdraw-1;
		$jmhwithdrawrp	= $report->rjmhwithdrawrp-$detail->tgrandtotal;
		
		$periode				  = $periode;
		$report2['rjmhwithdraw']  = $jmhwithdraw;
		$report2['rjmhwithdrawrp'] = $jmhwithdrawrp;

		$idcustomer 			  = $detail->cid;
		$customer['cdeposit'] 	  = $detail->cdeposit+$detail->tgrandtotal; 

		$idrekening 			  = $rekening->rid;
		$rekening1['rsaldo'] 	  = $rekening->rsaldo+$detail->tgrandtotal; 

  		$rdbrand  		= $detail->tbrand;	
  		$rdcustomer 	= $detail->cid;	
  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
		$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

		if($rdreport == NULL){
			$rdreport['rdperiode']		 = $date;
			$rdreport['rdcustomerid']	 = $detail->cid;
			$rdreport['rdbrand']		 = $detail->tbrand;
			$rdreport['rdwithdraw'] 	 = $nominal;
			$rdreport['rdstatus']		 = 1;
			$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

	 		$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
		}else{
			$tambahwithdraw				 = $rdreport->rdwithdraw-$detail->tgrandtotal;
			$rdcust				  	 	 = $detail->cid;	
			$rdbrand				  	 = $detail->tbrand;
			$rdreport2['rdwithdraw']	 = $tambahwithdraw;

	 		$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
		}

		$this->m_transaksi->HapusWithdrawDana($nomor);
 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
 		$this->m_customer->EditCustomerAct($idcustomer, $customer);
 		$this->m_rekening->UpdateRekening($idrekening, $rekening1);	
		$this->m_transaksi->HapusTransaksi($nomor);
	    redirect(base_url().'transaksi/listwithdraw/');
 	}
}