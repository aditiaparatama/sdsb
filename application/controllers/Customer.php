<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_customer');
		$this->load->library('upload');
		$this->load->helper('string');
	}

	//halaman dashboard
	public function logindashboard(){
		$data['title'] = 'Login Dashboard - '.BRAND;
		$this->load->view('dashboard/login', $data);
	}

	public function logindashboard_act() {
	    if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('email', 'Email', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('password', 'password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda salah!');
				redirect(base_url('login'));
		  	} else { 		

		  		$email 	= $this->input->post('email');
		  		$pass 	= md5($this->input->post('password'));
		  		$where 	= array(
				    'cemail' => $email,
				    'cpass'  => $pass
			    );
				$cek = $this->m_customer->cek_login($where)->num_rows();
				if($cek > 0){
					$data = $this->m_customer->data_login($email,$pass);
					$data_session = array(
						'id' 		=> $data->cid,
						'nama' 		=> $data->cnama,
						'email' 	=> $data->cemail,
						'foto' 		=> $data->cfoto,
						'deposito'  => $data->cdeposit,
						'status' 	=> "user"
			    	);
				    $this->session->set_userdata($data_session);
					redirect(base_url('dashboard'));
				}else{
		            $this->session->set_flashdata('warning', 'Maaf, anda gagal login!');
					redirect(base_url('login'));
				}
			}
		}
	}

	public function logoutdashboard() {
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	
	//halaman backend
 	public function addcustomer(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		
		$data['title'] = 'Tambah Customer Baru - '.BRAND;
		$data['page']  = 'backend/customer/add';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function addcustomer_act(){
  		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrek', 'Nama Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('norek', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$this->load->model('m_transaksi');
				$this->load->model('m_rekening');
				$usersbo	 	= $this->input->post('usersbo');
				$useribc	 	= $this->input->post('ibcbet');
				$userhorey	 	= $this->input->post('horey4d');
				$usertangkas 	= $this->input->post('tangkasnet');
				$usersdsb	 	= $this->input->post('sdsb');
		  		
		  		$wheresbo 	 	= array('cusersbo' => $usersbo);
		  		$cusersbo 	 	= $this->m_customer->CekCustomer($wheresbo)->num_rows();
		  		$whereibc 	 	= array('cuseribc' => $useribc);
		  		$cuseribc 	 	= $this->m_customer->CekCustomer($whereibc)->num_rows();
		  		$wherehorey  	= array('cuserhorey' => $usersbo);
		  		$cuserhorey 	= $this->m_customer->CekCustomer($wherehorey)->num_rows();
		  		$wheretangkas 	= array('cusertangkas' => $usersbo);
		  		$cusertangkas 	= $this->m_customer->CekCustomer($wheretangkas)->num_rows();
		  		$wheresdsb 	 	= array('cuser' => $usersbo);
		  		$cusersdsb 	 	= $this->m_customer->CekCustomer($wheresdsb)->num_rows();
		  		if($cusersbo > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, user SBOBET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cuseribc > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, user IBCBET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cuserhorey > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, user HOREY4D sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cusertangkas > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, user TANGKASNET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cusersdsb > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, user SDSB sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

					$data['cnama']				= $this->input->post('nama');
					$data['cuser'] 				= $this->input->post('sdsb');
					$data['cusersbo']			= $this->input->post('usersbo');
					$data['cuseribc']			= $this->input->post('ibcbet');
					$data['cuserhorey']			= $this->input->post('horey4d');
					$data['cusertangkas']		= $this->input->post('tangkasnet');
					$data['cemail']				= $this->input->post('email');
					$data['cpass'] 				= md5($this->input->post('pass'));
					$data['ctlp']				= $this->input->post('tlp');
					$data['calamat']			= $this->input->post('alamat');
					$data['cbank']				= $this->input->post('bank');
					$data['cnamarek']			= $this->input->post('nmrek');
					$data['cnorek']				= $this->input->post('norek');
					$data['cdeposit']			= str_replace(".", "", $this->input->post('dsdsb'));
					$data['cdepositsbo']		= str_replace(".", "", $this->input->post('dsbobet'));
					$data['cdepositibc']		= str_replace(".", "", $this->input->post('dibcbet'));
					$data['cdeposithorey']		= str_replace(".", "", $this->input->post('dhorey4d'));
					$data['cdeposittangkas']	= str_replace(".", "", $this->input->post('dtangkas'));
					$data['cterbaca']			= 1;
					$data['cstatus']			= 1;
					$data['cdate']				= date('Y-m-d H:i:s');
			        if(!empty($_FILES['photo']['name'])) {
			  			$data['cfoto']			= $this->upload('photo');
			        }
	  	 		$this->m_customer->SaveCustomer($data);	
 				$customer = $this->m_customer->SearchCustomer($this->input->post('email'));

	  	 		if($this->input->post('dsbobet') != ''){		
	  	 			$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $customer->cid;
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $customer->cusersbo;
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= str_replace(".", "", $this->input->post('dsbobet'));
					$row['tgrandtotal'] = str_replace(".", "", $this->input->post('dsbobet'));
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 1;
					$row['tketerangan'] = 'Saldo awal SBOBET customer '.$customer->cusersbo;
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dsbobet'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	  	 		}

	  	 		if($this->input->post('dibcbet') != ''){		
	  	 			$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $customer->cid;
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $customer->cuseribc;
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= str_replace(".", "", $this->input->post('dibcbet'));
					$row['tgrandtotal'] = str_replace(".", "", $this->input->post('dibcbet'));
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 2;
					$row['tketerangan'] = 'Saldo awal IBCBET customer '.$customer->cuseribc;
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dibcbet'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	  	 		}

	  	 		if($this->input->post('dhorey4d') != ''){		
	  	 			$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $customer->cid;
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $customer->cuserhorey;
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= str_replace(".", "", $this->input->post('dhorey4d'));
					$row['tgrandtotal'] = str_replace(".", "", $this->input->post('dhorey4d'));
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 3;
					$row['tketerangan'] = 'Saldo awal HOREY4D customer '.$customer->cuserhorey;
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dhorey4d'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	  	 		}

	  	 		if($this->input->post('dtangkas') != ''){		
	  	 			$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $customer->cid;
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $customer->cusertangkas;
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= str_replace(".", "", $this->input->post('dtangkas'));
					$row['tgrandtotal'] = str_replace(".", "", $this->input->post('dtangkas'));
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 4;
					$row['tketerangan'] = 'Saldo awal TANGKASNET customer '.$customer->cusertangkas;
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dtangkas'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	  	 		}

	  	 		if($this->input->post('dsdsb') != ''){		
	  	 			$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $customer->cid;
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $customer->cuser;
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= str_replace(".", "", $this->input->post('dsdsb'));
					$row['tgrandtotal'] = str_replace(".", "", $this->input->post('dsdsb'));
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 5;
					$row['tketerangan'] = 'Saldo awal SDSB customer '.$customer->cuser;
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dsdsb'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	  	 		}
	       		redirect(base_url().'customer/listcustomer');
		  	}
	    }
 	}

	public function listcustomer(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_customer->Customer();

		$data['title'] = 'List Customer - '.BRAND;
		$data['page']  = 'backend/customer/list';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function editcustomer($id){
 		if($this->session->userdata('status') != "backend"){
 			redirect(base_url('cmskita'));
 		}
 		$data['detail'] = $this->m_customer->EditCustomer($id);

 		$data['title'] = 'Edit Customer - '.BRAND;
 		$data['page']  = 'backend/customer/edit';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editcustomer_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pass', 'Password', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrek', 'Nama Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('norek', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 	
		  		$this->load->model('m_transaksi');
				$this->load->model('m_rekening');
				$usersbo	 	= $this->input->post('usersbo');
				$useribc	 	= $this->input->post('ibcbet');
				$userhorey	 	= $this->input->post('horey4d');
				$usertangkas 	= $this->input->post('tangkasnet');
				$usersdsb	 	= $this->input->post('sdsb');
		  		
		  		$wheresbo 	 	= array('cusersbo' => $usersbo);
		  		$cusersbo 	 	= $this->m_customer->CekCustomer($wheresbo)->num_rows();
		  		$whereibc 	 	= array('cuseribc' => $useribc);
		  		$cuseribc 	 	= $this->m_customer->CekCustomer($whereibc)->num_rows();
		  		$wherehorey  	= array('cuserhorey' => $usersbo);
		  		$cuserhorey 	= $this->m_customer->CekCustomer($wherehorey)->num_rows();
		  		$wheretangkas 	= array('cusertangkas' => $usersbo);
		  		$cusertangkas 	= $this->m_customer->CekCustomer($wheretangkas)->num_rows();
		  		$wheresdsb 	 	= array('cuser' => $usersbo);
		  		$cusersdsb 	 	= $this->m_customer->CekCustomer($wheresdsb)->num_rows();
		  		if($cusersbo > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, user SBOBET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cuseribc > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, user IBCBET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cuserhorey > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, user HOREY4D sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cusertangkas > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, user TANGKASNET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cusersdsb > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, user SDSB sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
					$id	  						= $this->input->post('idcus');
					$data['cnama']				= $this->input->post('nama');
					$data['cemail']				= $this->input->post('email');
					$data['cuser'] 				= $this->input->post('sdsb');
					$data['cusersbo']			= $this->input->post('usersbo');
					$data['cuseribc']			= $this->input->post('ibcbet');
					$data['cuserhorey']			= $this->input->post('horey4d');
					$data['cusertangkas']		= $this->input->post('tangkasnet');
					$data['cpass'] 				= md5($this->input->post('pass'));
					$data['ctlp']				= $this->input->post('tlp');
					$data['calamat']			= $this->input->post('alamat');
					$data['cbank']				= $this->input->post('bank');
					$data['cnamarek']			= $this->input->post('nmrek');
					$data['cnorek']				= $this->input->post('norek');
					$data['cdepositsbo']		= str_replace(",", "", $this->input->post('dsbobet'));
					$data['cdepositibc']		= str_replace(",", "", $this->input->post('dibcbet'));
					$data['cdeposithorey']		= str_replace(",", "", $this->input->post('dhorey4d'));
					$data['cdeposittangkas']	= str_replace(",", "", $this->input->post('dtangkas'));
					$data['cdeposit']			= str_replace(",", "", $this->input->post('dsdsb'));

			        if(!empty($_FILES['photo']['name'])) {
			  			$data['cfoto']			= $this->upload('photo');
			        }
	  	 		$this->m_customer->EditCustomerAct($id, $data);	

		 		if($this->input->post('olddsbo') != str_replace(",", "", $this->input->post('dsbobet'))){	
		 			$dsbobet = str_replace(",", "", $this->input->post('dsbobet'));	
			 		
			 		$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $this->input->post('idcus');
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $this->input->post('usersbo');
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= $dsbobet;
					$row['tgrandtotal'] = $dsbobet;
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 1;
					$row['tketerangan'] = 'Update saldo SBOBET customer '.$this->input->post('usersbo');
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dsbobet-$this->input->post('olddsbo');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
		 		}
		 		if($this->input->post('olddibc') != str_replace(",", "", $this->input->post('dibcbet'))){	
		 			$dibcbet = str_replace(",", "", $this->input->post('dibcbet'));	

			 		$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $this->input->post('idcus');
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $this->input->post('ibcbet');
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= $dibcbet;
					$row['tgrandtotal'] = $dibcbet;
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 2;
					$row['tketerangan'] = 'Update saldo IBCBET customer '.$this->input->post('ibcbet');
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dibcbet-$this->input->post('olddibc');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
		 		}
		 		if($this->input->post('olddhorey') != str_replace(",", "", $this->input->post('dhorey4d'))){	
		 			$dibcbet = str_replace(",", "", $this->input->post('dibcbet'));	

			 		$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $this->input->post('idcus');
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $this->input->post('horey4d');
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= $dibcbet;
					$row['tgrandtotal'] = $dibcbet;
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 3;
					$row['tketerangan'] = 'Update saldo HOREY4D customer '.$this->input->post('horey4d');
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dibcbet-$this->input->post('olddhorey');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
		 		}
		 		if($this->input->post('olddtangkas') != str_replace(",", "", $this->input->post('dtangkas'))){	
		 			$dtangkas = str_replace(",", "", $this->input->post('dtangkas'));	
	
			 		$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $this->input->post('idcus');
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $this->input->post('tangkasnet');
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= $dtangkas;
					$row['tgrandtotal'] = $dtangkas;
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 4;
					$row['tketerangan'] = 'Update saldo TANGKASNET customer '.$this->input->post('tangkasnet');
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dtangkas-$this->input->post('olddtangkas');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
		 		}
		 		if($this->input->post('olddsdsb') != str_replace(",", "", $this->input->post('dsdsb'))){	
		 			$dsdsb = str_replace(",", "", $this->input->post('dsdsb'));	

			 		$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $this->input->post('idcus');
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $this->input->post('sdsb');
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= $dsdsb;
					$row['tgrandtotal'] = $dsdsb;
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 5;
					$row['tketerangan'] = 'Update saldo SDSB customer '.$this->input->post('sdsb');
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dsdsb-$this->input->post('olddsdsb');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
		 		}

	       		redirect(base_url().'customer/listcustomer');
		  	}
	    }
 	}

	public function hapuscustomer($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_customer->HapusCustomer($id);

		redirect(base_url('customer/listcustomer'));
	}


	public function listdeposit(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_customer->Customer();

		$data['title'] = 'List Deposit Customer - '.BRAND;
		$data['page']  = 'backend/customer/deposit';
		$this->load->view('backend/thamplate', $data); 
	}

	public function detail($id){ 		
		if($this->session->userdata('status') != "backend"){
 			redirect(base_url('cmskita'));
 		}
		$this->load->model('m_transaksi');
 		$data['detail'] 	= $this->m_customer->EditCustomer($id);
		$data['deposit'] 	= $this->m_transaksi->RiwayatCustomerDeposit($id);
		$data['withdraw'] 	= $this->m_transaksi->RiwayatCustomerWithdraw($id);

 		$data['title'] = 'Detail Customer - '.BRAND;
 		$data['page']  = 'backend/customer/detail';
 		$this->load->view('backend/thamplate', $data);
	}

	public function downloadexcel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_customer->DetailCustomer();

		$this->load->view('backend/customer/downloadexcel', $data);
	}

	public function caricustomer(){
		$username	= $this->input->post("user");
		$where 		= array('cuser' => $username);
		$data['customer'] 	= $this->m_customer->SearchCustomerUsername($where);
		$count 				= $this->m_customer->CariCustomer($where)->num_rows();
		if($count == 0){
			$data['bank'] 		= '';
			$data['rekening'] 	= '';
			$data['norek'] 		= '';
		}else{
			$data['bank'] 		= $data['customer']->cbank;
			$data['rekening'] 	= $data['customer']->cnamarek;
			$data['norek'] 		= $data['customer']->cnorek;
		}

		$data['page']  = 'backend/customer/search';
		$this->load->view('backend/customer/search', $data); 
	}

	public function caridepositcustomer(){
	  	$this->load->model('m_brand');
		$brand		= $this->input->post("brand");
		$user		= $this->input->post("user");
		$where  	= array('bnama' => $brand);		
		$userbrand 	= $this->m_brand->CariBrand($where);  	
		$deposit 	= $userbrand->bfield2;	

		$where2 = array(
		    $userbrand->bfield1 => $user
	    );

		$data['customer'] 	= $this->m_customer->SearchCustomerUsername($where2);
		$count 				= $this->m_customer->CariCustomer($where2)->num_rows();
		if($count == 0){
			$data['userid']  = '';
			$data['deposit'] = '';
			$data['deposio'] = '';
			$data['sumber']  = '';	
		}else{
			$data['userid']  = $data['customer']->cid;
			$data['deposit'] = 'Rp. '.number_format($data['customer']->$deposit);
			$data['deposio'] = $data['customer']->$deposit;
			$data['sumber']  = 'DEPOSIT '. $userbrand->bnama;	
		}

		$data['page']  = 'backend/customer/searchdeposit';
		$this->load->view('backend/customer/searchdeposit', $data); 
	}

	public function carirekeningcustomer(){
	  	$this->load->model('m_brand');
		$brand		= $this->input->post("brand"); 	
		$user		= $this->input->post("user");
		$where  	= array('bnama' => $brand);		
		$userbrand 	= $this->m_brand->CariBrand($where); 
		$deposit 	= $userbrand->bfield2;	

		$where2 = array(
		    $userbrand->bfield1 => $user
	    );

		$data['customer'] 	= $this->m_customer->SearchCustomerUsername($where2);
		$count 				= $this->m_customer->CariCustomer($where2)->num_rows();
		if($count == 0){
			$data['userid']  	= '';
			$data['deposit'] 	= '';
			$data['deposio'] 	= '';
			$data['sumber']  	= '';
			$data['tujuan']  	= '';	
			$data['rekening']  	= '';	
		}else{
			$data['userid']  	= $data['customer']->cid;
			$data['deposit'] 	= 'Rp. '.number_format($data['customer']->$deposit);
			$data['deposio'] 	= $data['customer']->$deposit;
			$data['sumber']  	= 'DEPOSIT '. $userbrand->bnama;
			$data['tujuan']  	= $data['customer']->cnorek.' ('.$data['customer']->cbank.' - '.$data['customer']->cnamarek.')';
			$data['rekening']  	= $data['customer']->cnorek;
		}

		$data['page']  = 'backend/customer/searchrekening';
		$this->load->view('backend/customer/searchrekening', $data); 
	}

	public function carirekening(){
	  	$this->load->model('m_brand');
		$brand		= $this->input->post("brand"); 	
		$user		= $this->input->post("user");
		$where  	= array('bnama' => $brand);		
		$userbrand 	= $this->m_brand->CariBrand($where); 
		$deposit 	= $userbrand->bfield2;	

		$where2 = array(
		    $userbrand->bfield1 => $user
	    );

		$data['customer'] 	= $this->m_customer->SearchCustomerUsername($where2);
		$count 				= $this->m_customer->CariCustomer($where2)->num_rows();
		if($count == 0){
			$data['bank'] 		= '';
			$data['rekening'] 	= '';
			$data['norek'] 		= '';
		}else{
			$data['bank'] 		= $data['customer']->cbank;
			$data['rekening'] 	= $data['customer']->cnamarek;
			$data['norek'] 		= $data['customer']->cnorek;
		}

		$data['page']  = 'backend/customer/search';
		$this->load->view('backend/customer/search', $data); 
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
		    $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		return $config['file_name'];
	}
}