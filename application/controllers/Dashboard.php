<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
	  	$this->load->model(array('m_customer','m_transaksi','m_brand'));
		$this->load->helper('string');
		$this->load->library('upload');

		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	}

	public function index(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$customer 			= $this->session->userdata('id');
	  	$data['brand']		= $this->m_brand->Brand();
	  	$data['customer']	= $this->m_customer->DataCustomer($customer);

		$data['title'] = 'Halaman Dashboard - '.BRAND;
		$data['page']  = 'dashboard/home';
		$this->load->view('dashboard/thamplate', $data);
	}

	public function deposit(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_transaksi->ListDeposit($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'List Deposit - '.BRAND;
		$data['page']  = 'dashboard/deposit/list';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function adddeposit(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['customer'] 	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'Tambah Deposit - '.BRAND;
		$data['page']  = 'dashboard/deposit/add';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function adddeposit_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('deposit', 'Deposit', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
	  				$this->load->model('m_voucher');
	  				$this->load->model('m_rekening');
					$id			= $this->session->userdata('id');
					$customer 	= $this->m_customer->DataCustomer($id);
		  			$deposit 	= str_replace(".", "", $this->input->post('deposit'));
					$rekening 	= $this->m_rekening->RekeningPenerima();

			  		if($this->input->post('voucher') != ''){
		  				$date 	 = date('Y-m-d');
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
				$data['tketerangan'] = 'Deposit customer SDSB Online '.$customer->cuser;
				$data['tstatus']	 = 2;
				$data['tuser'] 		 = $this->session->userdata('id');
				$data['tperiode']	 = date('Y-m-d');
				$data['tdate'] 		 = date('Y-m-d H:i:s');
				
	  	 		$this->m_transaksi->SaveTransaksi($data);	
	       		redirect(base_url().'dashboard/deposit/');
		  	}
	    }
 	}

	public function withdraw(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_transaksi->ListWithdraw($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'List Withdraw - '.BRAND;
		$data['page']  = 'dashboard/withdraw/list';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function addtransfer(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id 				= $this->session->userdata('id');
		$data['customer'] 	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'Transfer Dana Baru - '.BRAND;
		$data['page']  = 'dashboard/withdraw/add';
		$this->load->view('dashboard/thamplate', $data); 
 	}

 	public function addtransfer_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('dari', 'Dari Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tujuan', 'Tujuan Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('transfer', 'Nominal Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
  				$this->load->model('m_brand');
				$id			= $this->session->userdata('id');
				$customer 	= $this->m_customer->DataCustomer($id);
	  			$transfer 	= str_replace(".", "", $this->input->post('transfer'));

				$dari		= $this->input->post("dari");
				$where  	= array('bnama' => $dari);		
				$userbrand 	= $this->m_brand->CariBrand($where);  
				if($this->input->post('tujuan') == 'Rekening Pribadi'){
					$data['tcustomer']	 = $customer->cid;
					$data['tnomor']		 = random_string('alnum', 15);
					$data['tdari']	 	 = 'Deposit '.$this->input->post('dari');
					$data['ttujuan']	 = $customer->cnorek;
					$data['tharga']		 = $transfer;
					$data['tgrandtotal'] = $transfer;
					$data['tjenis']		 = 2;
					$data['tsubjenis']	 = 52;
					$data['tsubdeposit'] = 62;
					$data['tbrand']		 = $userbrand->bid;
					$data['tketerangan'] = 'Withdraw customer SDSB Online '.$customer->cuser;
					$data['tstatus']	 = 2;
					$data['tuser'] 		 = $this->session->userdata('id');
					$data['tperiode']	 = date('Y-m-d');
					$data['tdate'] 		 = date('Y-m-d H:i:s');
					
		  	 		$this->m_transaksi->SaveTransaksi($data);	
		       		redirect(base_url().'dashboard/withdraw/');
				}else{
					$data['tcustomer']	 = $customer->cid;
					$data['tnomor']		 = random_string('alnum', 15);
					$data['tdari']	 	 = 'Deposit '.$this->input->post('dari');
					$data['ttujuan']	 = $this->input->post('tujuan');
					$data['tharga']		 = $transfer;
					$data['tgrandtotal'] = $transfer;
					$data['tjenis']		 = 4;
					$data['tsubjenis']	 = 0;
					$data['tsubdeposit'] = 62;
					$data['tbrand']		 = $userbrand->bid;
					$data['tketerangan'] = 'Transfer dana customer ke '.$this->input->post('tujuan').' - '.$customer->cuser;
					$data['tstatus']	 = 2;
					$data['tuser'] 		 = $this->session->userdata('id');
					$data['tperiode']	 = date('Y-m-d');
					$data['tdate'] 		 = date('Y-m-d H:i:s');
					
		  	 		$this->m_transaksi->SaveTransaksi($data);	
		       		redirect(base_url().'dashboard/withdraw/');
				}
		  	}
	    }
 	}

 	public function caridepositcustomer(){
		$dari				= $this->input->post("dari"); 	
		$idcus 				= $this->session->userdata('id');
		$data['customer'] 	= $this->m_customer->DataDepositCustomer($idcus);

		if($dari == 'SBOBET'){
			$data['deposit']  	= $data['customer']->cdepositsbo;
		}else if($dari == 'MAXBET'){
			$data['deposit']  	= $data['customer']->cdepositmax;
		}else if($dari == 'HOREY4D'){
			$data['deposit']  	= $data['customer']->cdeposithorey;
		}else if($dari == 'TANGKASNET'){
			$data['deposit']  	= $data['customer']->cdeposittangkas;
		}else if($dari == 'SDSB ONLINE'){
			$data['deposit']  	= $data['customer']->cdeposit;
		}

		$data['page']  = 'dashboard/withdraw/depositcustomer';
		$this->load->view('dashboard/withdraw/depositcustomer', $data); 
	}

	public function profile(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id = $this->session->userdata('id');
 		$data['detail'] 	= $this->m_customer->EditDataCustomer($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

 		$data['title'] = 'Edit Customer - '.BRAND;
 		$data['page']  = 'dashboard/profile/edit';
 		$this->load->view('dashboard/thamplate', $data);
	}

 	public function profile_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrek', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('norek', 'Pemilik Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id					= $this->session->userdata('id');
				$data['cnama']		= $this->input->post('nama');
				$data['cemail']		= $this->input->post('email');
				$data['calamat'] 	= $this->input->post('alamat');
				$data['ctlp'] 		= $this->input->post('tlp');
				$data['cbank'] 		= $this->input->post('bank');
				$data['cnorek'] 	= $this->input->post('norek');
				$data['cnamarek'] 	= $this->input->post('nmrek');

		        if(!empty($_FILES['photo']['name'])) {
		  			$data['cfoto']	= $this->upload('photo');
		        }
	  	 		$this->m_customer->EditCustomerAct($id, $data);	
	       		redirect(base_url().'dashboard/profile');
		  	}
	    }
 	}

	public function updatepassword(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		$id = $this->session->userdata('id');
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

 		$data['title'] = 'Edit Password - '.BRAND;
 		$data['page']  = 'dashboard/profile/editpassword';
 		$this->load->view('dashboard/thamplate', $data);
	}

	public function updatepassword_act(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('kpass', 'Konfirmasi Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id					= $this->session->userdata('id');
				$data['cpass'] 		= md5($this->input->post('pass'));

	  	 		$this->m_customer->EditCustomerAct($id, $data);	
				redirect(base_url('login'));
		  	}
	    }
 	}

	public function list(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	  	$this->load->model('m_customer');
	  	$this->load->model('m_transaksi');
		$id 				= $this->session->userdata('id');
		$data['lists'] 		= $this->m_transaksi->ListKupon($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);

		$data['title'] = 'List Kupon - '.BRAND;
		$data['page']  = 'dashboard/kupon/list';
		$this->load->view('dashboard/thamplate', $data); 
 	}

	public function addnomor(){
 		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
	  	$this->load->model('m_customer');
	  	$this->load->model('m_general');
		$id					= $this->session->userdata('id');
		$data['deposit'] 	= $this->m_customer->Deposit($id);
	  	$data['customer']	= $this->m_customer->DataCustomer($id);
 		$data['harga'] 		= $this->m_general->SearchHarga();

		$data['title'] = 'Beli Nomor Kupon - '.BRAND;
		$data['page']  = 'dashboard/kupon/add';
		$this->load->view('dashboard/thamplate', $data); 
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
				$total 				= $jumlah*$harga->harga_general;
				$data['potongan'] 	= $potongan->diskon_general;
				$calculate 			= $potongan->diskon_general/100*$total;
				$data['jumlah'] 	= $total-$calculate; 
 			}else{
 				$harga 				= $this->m_general->SearchHarga();
				$data['potongan'] 	= 0;
				$data['jumlah'] 	= $jumlah*$harga->harga_general;
 			}
		}

		$data['page']  = 'dashboard/kupon/jumlah';
		$this->load->view('dashboard/kupon/jumlah', $data); 
	}

	public function addnomor_act(){ 		
		if($this->session->userdata('status') != "user"){
			redirect(base_url('login'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
		        $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$this->load->model('m_nomor');
				$this->load->model('m_general');
	  			$this->load->model('m_rekening');
	  			$this->load->model('m_customer');
	  			$this->load->model('m_transaksi');
				$id			= $this->session->userdata('id');
				$customer 	= $this->m_customer->DataCustomer($id);
				$rekening 	= $this->m_rekening->RekeningPenerima();
				$deposit 	= $this->m_customer->Deposit($id);
				$jumlah 	= $this->input->post("jumlah");
				$nomor  	= time();

		  		if($jumlah == 0 || $jumlah == ''){
					$total = 0;
		  		}else{
					$cek = $this->m_general->CekPotongan($jumlah);
					if($cek > 0){
		 				$harga 		= $this->m_general->SearchHarga();
		 				$potongan 	= $this->m_general->SearchPotongan($jumlah);
						$total 		= $jumlah*$harga->gharga;
						$calculate 	= $potongan->gdiskon/100*$total;
						$diskon 	= $potongan->gdiskon;
						$bruto 		= $total-$calculate; 
						$total 		= $total-$calculate; 
		 			}else{
		 				$diskon 	= 0;
		 				$harga 		= $this->m_general->SearchHarga();
						$bruto 		= $jumlah*$harga->gharga;
		 				$total 		= $jumlah*$harga->gharga;
		 			}
		 			// $harga 			= $this->m_general->SearchHarga();
		  		}

		  		if($deposit->cdeposit < $bruto){
		        	$this->session->set_flashdata('warning', 'Maaf, Jumlah deposit kurang!');
					redirect(base_url('dashboard/addnomor'));
		  		}
				$updatedeposit	= $deposit->cdeposit-$total;
				
				for ($x = 1; $x <= $jumlah; $x++){
					$voucher 	= random_string('numeric', 6);
			  		$count 		= $this->m_nomor->CountNomor($voucher);
			  		if($count > 0){
						$voucher1 = random_string('numeric', 6);
						$data['tcustomer']	 = $id;
						$data['tnomor']		 = random_string('alnum', 15);
						$data['tkupon']		 = $voucher1;
						$data['tdari'] 		 = $customer->cuser;
						$data['ttujuan'] 	 = $rekening->rno;
						$data['tharga'] 	 = $bruto;
						$data['tgrandtotal'] = $total;
						$data['tjenis'] 	 = 3;
						$data['tsubdeposit'] = 62;
						$data['tbrand'] 	 = 5;
						$data['tketerangan'] = 'Pembelian nomor kupon sdsb'. $customer->cuser; 
						$data['tstatus'] 	 = 1;
						$data['tperiode'] 	 = date('Y-m-d');
						$data['tdate'] 		 = date('Y-m-d H:i:s');
						$row['ncustomer']	 = $id;
						$row['nnomor'] 		 = $voucher1;
						$row['nperiode'] 	 = date('Y-m-d');
			  	 		$this->m_transaksi->SaveTransaksi($data);
	  	 				$this->m_nomor->SaveNomor($row);	
			  		}else{
						$data['tcustomer']	 = $id;
						$data['tnomor']		 = random_string('alnum', 15);
						$data['tkupon']		 = $voucher;
						$data['tdari'] 		 = $customer->cuser;
						$data['ttujuan'] 	 = $rekening->rno;
						$data['tharga'] 	 = $bruto;
						$data['tgrandtotal'] = $total;
						$data['tjenis'] 	 = 3;
						$data['tsubdeposit'] = 62;
						$data['tbrand'] 	 = 5;
						$data['tketerangan'] = 'Pembelian nomor kupon sdsb'. $customer->cuser; 
						$data['tstatus'] 	 = 1;
						$data['tperiode'] 	 = date('Y-m-d');
						$data['tdate'] 		 = date('Y-m-d H:i:s');
						$row['ncustomer']	 = $id;
						$row['nnomor'] 		 = $voucher;
						$row['nperiode'] 	 = date('Y-m-d');
			  	 		$this->m_transaksi->SaveTransaksi($data);
	  	 				$this->m_nomor->SaveNomor($row);	
			  	 	}
				} 
			  	$this->m_customer->UpdateDeposit($id,$updatedeposit);
				redirect(base_url('dashboard/list'));
		  	}
	    }
	}







	public function upload($name) {
		$new_name = time();
		switch ($_FILES[$name]['type']) {
			case "image/jpeg" :
				$type = $new_name.'.jpeg';
				break;
			case "image/png" :
				$type = $new_name.'.png';
				break;
			case "image/gif" :
				$type = $new_name.'.gif';
				break;
			default:
				$type = 'not allowed_types';
				break;
		}

		$config['upload_path'] 		= './assets/images/dashboard/profile/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size'] 		= '262144';
		$config['file_name'] 		= $type;
		$cover_name					= $config['file_name'];
		$this->upload->initialize($config);

		if ($this->upload->do_upload($name)) {
			$data['message'] 		= $this->upload->data();
		} else {
		    $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal1!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		return $config['file_name'];
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}