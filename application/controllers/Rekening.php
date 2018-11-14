<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_rekening');
	}
	
	//halaman backend
	public function listrekening(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] = $this->m_rekening->Rekening();

		$data['title'] = 'List Rekening - '.BRAND;
		$data['page']  = 'backend/rekening/list';
		$this->load->view('backend/thamplate', $data); 
	}
	 
	public function addrekening(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		
		$data['title'] = 'Tambah Nomor Rekening - '.BRAND;
		$data['page']  = 'backend/rekening/add';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function addrekening_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nama', 'Nama Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('no', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('saldo', 'Saldo Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'rekening/addrekening');
		  	} else { 		
	  			$this->load->model('m_transaksi');
				$this->load->helper('string');

		  		if($this->input->post('jenis') == 1){
		  			$jenis  		= 1;
					$row['rjenis'] 	= 0;
	  	 			$this->m_rekening->EditRekening(1, $row);
		  		}else if($this->input->post('jenis') == 2){
		  			$jenis  		= 2;
					$row['rjenis'] 	= 0;
	  	 			$this->m_rekening->EditRekening(2, $row);
	  	 		}else{
	  	 			$jenis 			= 0;
	  	 		}

				$data['rbank']  		= $this->input->post('bank');
				$data['rnama'] 			= $this->input->post('nama');
				$data['rno'] 			= $this->input->post('no');
				$data['rsaldo'] 		= str_replace(".", "", $this->input->post('saldo'));
				$data['rjenis'] 		= $jenis;;
				$data['rstatus'] 		= 1;
				$data['rdate'] 			= date('Y-m-d H:i:s');

				$record['tnomor']		= random_string('alnum', 15);
				$record['ttujuan']		= $this->input->post('no');
				$record['tharga']		= str_replace(".", "", $this->input->post('saldo'));
				$record['tgrandtotal']	= str_replace(".", "", $this->input->post('saldo'));
				$record['tbrand']		= 5;
				$record['tjenis']		= 5;
				$record['tsubjenis']	= 51;
				$record['tketerangan']	= 'Saldo awal';
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_rekening->SaveRekening($data);	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
	       		redirect(base_url().'rekening/listrekening');
		  	}
	    }
 	}
 	
 	public function editrekening($no){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
 		$data['detail'] = $this->m_rekening->DetailRekening($no);

 		$data['title'] = 'Edit Nomor Rekening - '.BRAND;
 		$data['page']  = 'backend/rekening/edit';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editrekening_act(){
 	 	if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nama', 'Nama Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('no', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('saldo', 'Saldo Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  			$this->load->model('m_transaksi');
				$this->load->helper('string');

		  		if($this->input->post('jenis') == 1){
		  			$jenis  		= 1;
					$row['rjenis'] 	= 0;
	  	 			$this->m_rekening->EditRekening(1, $row);
		  		}else if($this->input->post('jenis') == 2){
		  			$jenis  		= 2;
					$row['rjenis'] 	= 0;
	  	 			$this->m_rekening->EditRekening(2, $row);
	  	 		}else{
	  	 			$jenis 			= 0;
	  	 		}

				$id	  				= $this->input->post('id');
				$data['rbank']		= $this->input->post('bank');
				$data['rnama']		= $this->input->post('nama');
				$data['rno'] 		= $this->input->post('no');
				$data['rsaldo'] 	= str_replace(",", "", $this->input->post('saldo'));
				$data['rjenis'] 	= $jenis;

				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $this->input->post('oldno');
				$record['ttujuan']		= $this->input->post('no');
				$record['tharga']		= str_replace(",", "", $this->input->post('saldo'));
				$record['tgrandtotal']	= str_replace(",", "", $this->input->post('saldo'));
				$record['tbrand']		= 5;
				$record['tjenis']		= 5;
				$record['tsubjenis']	= 53;
				$record['tketerangan']	= 'Perubahan rekening';
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_rekening->UpdateRekening($id, $data);
	  	 		$this->m_transaksi->SaveTransaksi($record);		
	       		redirect(base_url().'rekening/listrekening');
		  	}
	    }
	}

	public function hapusrekening($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$this->m_rekening->HapusRekening($id);
		redirect(base_url('rekening/listrekening'));
	}

	public function transferrekening(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] 		= $this->m_rekening->Rekening();
		$data['transfer'] 	= $this->m_rekening->RekeningTransfer();
		$data['penerima'] 	= $this->m_rekening->RekeningPenerimaTransfer();

		$data['title'] = 'Transfer Rekening - '.BRAND;
		$data['page']  = 'backend/rekening/transfer';
		$this->load->view('backend/thamplate', $data); 
	}

	public function getsaldo(){
		$id = $this->input->post("id");
		$data['saldo'] = $this->m_rekening->CekSaldo($id);

		$data['page']  = 'backend/rekening/saldo';
		$this->load->view('backend/rekening/saldo', $data); 
	}

	public function addtransfer_act(){
 	 	if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('transfer', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('penerima', 'Rekening Penerima', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  			$this->load->model('m_transaksi');
				$this->load->helper('string');
		  		
		  		$transfer 		= $this->input->post('transfer');
		  		$penerima 		= $this->input->post('penerima');
				$nominal 		= str_replace(".", "", $this->input->post('nominal'));
	  	 		$ceksaldo 		= $this->m_rekening->DetailRekening($transfer);
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($penerima);

	  	 		if($nominal > $ceksaldo->rsaldo){
	            	$this->session->set_flashdata('warning', 'Maaf, nominal transfer lebih besar dari saldo rekening!');
					redirect($_SERVER['HTTP_REFERER']);
	  	 		}
	  	 		$sisasaldo 		= $ceksaldo->rsaldo-$nominal;
	  	 		$tambahsaldo 	= $saldorekening->rsaldo+$nominal;

				$penerima	  		= $penerima;
				$data['rsaldo']		= $tambahsaldo;
				$transfer	  		= $this->input->post('transfer');
				$row['rsaldo']		= $sisasaldo;
				
				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $transfer;
				$record['ttujuan']		= $penerima;
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tbrand']		= 5;
				$record['tjenis']		= 5;
				$record['tsubjenis']	= 51;
				$record['tketerangan']	= 'Terima transfer dari '.$transfer;
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');
				
				$record2['tnomor']		= random_string('alnum', 15);;
				$record2['trekeningdari']= $transfer;
				$record2['tdari']		= $transfer;
				$record2['ttujuan']		= $penerima;
				$record2['tharga']		= $nominal;
				$record2['tgrandtotal']	= $nominal;
				$record2['tbrand']		= 5;
				$record2['tjenis']		= 5;
				$record2['tsubjenis']	= 52;
				$record2['tketerangan']	= 'Transfer antar rekening ke '.$penerima;
				$record2['tstatus']		= 1;
				$record2['tuser'] 		= $this->session->userdata('id');
				$record2['tdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_rekening->UpdateSaldo($transfer, $row);	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
	  	 		$this->m_transaksi->SaveTransaksi($record2);	
	       		redirect(base_url().'rekening/listrekening');
		  	}
	    }
	}

	public function detailrekening($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('departementnsosial'));
		}
		$data['detail'] 		= $this->m_rekening->DetailRekening($id);
		$data['penerimaan'] 	= $this->m_rekening->RiwayatPenerimaanRekening($id);
		$data['pengeluaran'] 	= $this->m_rekening->RiwayatPengeluaranRekening($id);

 		$data['title'] = 'Riwayat Rekening - '.BRAND;
 		$data['page']  = 'backend/rekening/riwayat';
 		$this->load->view('backend/thamplate', $data);
	}

	public function pemasukan(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] 		= $this->m_rekening->Pemasukan();

		$data['title'] = 'Pemasukan Rekening - '.BRAND;
		$data['page']  = 'backend/rekening/pemasukan';
		$this->load->view('backend/thamplate', $data); 
	}

	public function addpemasukan(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['penerima'] 	= $this->m_rekening->RekeningPenerimaTransfer();

		$data['title'] = 'Pemasukan Rekening Baru - '.BRAND;
		$data['page']  = 'backend/rekening/addpemasukan';
		$this->load->view('backend/thamplate', $data); 
	}

	public function addpemasukan_act(){
 	 	if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('keterangan', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('sumber', 'Sumber', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('penerima', 'Rekening Penerima', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  			$this->load->model('m_transaksi');
				$this->load->helper('string');
		  		$penerima 		= $this->input->post('penerima');
				$nominal 		= str_replace(".", "", $this->input->post('nominal'));
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($penerima);
	  	 		$tambahsaldo 	= $saldorekening->rsaldo+$nominal;

				$penerima	  		= $penerima;
				$data['rsaldo']		= $tambahsaldo;
				
				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $this->input->post('sumber');
				$record['ttujuan']		= $penerima;
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 5;
				$record['tsubjenis']	= 51;
				$record['tketerangan']	= $this->input->post('keterangan');
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
	       		redirect(base_url().'rekening/pemasukan');
		  	}
	    }
	}

  	public function editpemasukan($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
	  	$this->load->model('m_rekening');
 		$data['detail']   = $this->m_rekening->DetailPemasukan($id);
		$data['penerima'] 	= $this->m_rekening->RekeningPenerimaTransfer();

 		$data['title'] = 'Edit Pemasukan Bulanan - '.BRAND;
 		$data['page']  = 'backend/rekening/editpemasukan';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpemasukan_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('keterangan', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('sumber', 'Sumber', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('penerima', 'Rekening Penerima', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  			$this->load->model('m_transaksi');
				$this->load->helper('string');
		  		$penerima 		= $this->input->post('penerima');
		  		$oldnominal 	= $this->input->post('oldnominal');
				$nominal 		= str_replace(".", "", $this->input->post('nominal'));
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($penerima);
	  	 		$tambahsaldo 	= $saldorekening->rsaldo-$oldnominal+$nominal;

				$penerima	  		= $penerima;
				$data['rsaldo']		= $tambahsaldo;
				
				$transaksi 				= $this->input->post('nomor');
				$record['tdari']		= $this->input->post('sumber');
				$record['ttujuan']		= $penerima;
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 5;
				$record['tsubjenis']	= 51;
				$record['tketerangan']	= $this->input->post('keterangan');
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);	
	       		redirect(base_url().'rekening/pemasukan');
		  	}
	    }
 	} 	

 	public function hapuspemasukan($nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$this->load->model('m_rekening');
		$this->load->model('m_transaksi');
 		$detail   		  = $this->m_rekening->DetailPemasukan($nomor);
		$calcu		  	  = $detail->rsaldo-$detail->tgrandtotal;
	
		$penerima 		  = $detail->rno;
		$data['rsaldo']   = $calcu;

	  	$this->m_rekening->UpdateSaldo($penerima, $data);	
		$this->m_transaksi->HapusTransaksi($nomor);
		redirect(base_url().'rekening/pemasukan');
 	}





	public function pengeluaran(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['lists'] 		= $this->m_rekening->Pengeluaran();

		$data['title'] = 'Pengeluaran Rekening - '.BRAND;
		$data['page']  = 'backend/rekening/pengeluaran';
		$this->load->view('backend/thamplate', $data); 
	}

	public function addpengeluaran(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$data['penerima'] 	= $this->m_rekening->RekeningPenerimaTransfer();

		$data['title'] = 'Pengeluaran Rekening Baru - '.BRAND;
		$data['page']  = 'backend/rekening/addpengeluaran';
		$this->load->view('backend/thamplate', $data); 
	}

	public function addpengeluaran_act(){
 	 	if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('keterangan', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('sumber', 'Sumber', 'htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('penerima', 'Rekening Penerima', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  			$this->load->model('m_transaksi');
				$this->load->helper('string');
		  		$penerima 		= $this->input->post('penerima');
				$nominal 		= str_replace(".", "", $this->input->post('nominal'));
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($penerima);
	  	 		$tambahsaldo 	= $saldorekening->rsaldo-$nominal;

				$penerima	  		= $penerima;
				$data['rsaldo']		= $tambahsaldo;
				
				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $penerima;
				$record['ttujuan']		= $this->input->post('sumber');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 5;
				$record['tsubjenis']	= 52;
				$record['tketerangan']	= $this->input->post('keterangan');
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->SaveTransaksi($record);	
	       		redirect(base_url().'rekening/pengeluaran');
		  	}
	    }
	}

  	public function editpengeluaran($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
	  	$this->load->model('m_rekening');
 		$data['detail']   	= $this->m_rekening->DetailPengeluaran($id);
		$data['penerima'] 	= $this->m_rekening->RekeningPenerimaTransfer();

 		$data['title'] = 'Edit Pengeluaran Bulanan - '.BRAND;
 		$data['page']  = 'backend/rekening/editpengeluaran';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpengeluaran_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('keterangan', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('sumber', 'Sumber', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nominal', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('penerima', 'Rekening Penerima', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  			$this->load->model('m_transaksi');
				$this->load->helper('string');
		  		$penerima 		= $this->input->post('penerima');
		  		$oldnominal 	= $this->input->post('oldnominal');
				$nominal 		= str_replace(".", "", $this->input->post('nominal'));
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($penerima);
	  	 		$tambahsaldo 	= $saldorekening->rsaldo+$oldnominal-$nominal;

				$penerima	  		= $penerima;
				$data['rsaldo']		= $tambahsaldo;

				$transaksi 				= $this->input->post('nomor');
				$record['tdari']		= $penerima;
				$record['ttujuan']		= $this->input->post('sumber');
				$record['tharga']		= $nominal;
				$record['tgrandtotal']	= $nominal;
				$record['tjenis']		= 5;
				$record['tsubjenis']	= 52;
				$record['tketerangan']	= $this->input->post('keterangan');
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_rekening->UpdateSaldo($penerima, $data);	
	  	 		$this->m_transaksi->UpdateTransaksi($transaksi, $record);	
	       		redirect(base_url().'rekening/pengeluaran');
		  	}
	    }
 	} 	

 	public function hapuspengeluaran($nomor){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('departementnsosial'));
		}
		$this->load->model('m_rekening');
		$this->load->model('m_transaksi');
 		$detail   		  = $this->m_rekening->DetailPengeluaran($nomor);
		$calcu		  	  = $detail->rsaldo+$detail->tgrandtotal;
	
		$penerima 		  = $detail->rno;
		$data['rsaldo']   = $calcu;

	  	$this->m_rekening->UpdateSaldo($penerima, $data);	
		$this->m_transaksi->HapusTransaksi($nomor);
		redirect(base_url().'rekening/pengeluaran');
 	}
}