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
			$this->form_validation->set_rules('tlp', 'Telepon', 'htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('bank', 'Bank', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('nmrek', 'Nama Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('norek', 'Nomor Rekening', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$this->load->model('m_transaksi');
				$this->load->model('m_rekening');
				$this->load->model('m_reportlabarugi');
				$this->load->model('m_detailcustomer');
				$usersbo	 	= $this->input->post('usersbo');
				$usermax	 	= $this->input->post('maxbet');
				$userhorey	 	= $this->input->post('horey4d');
				$usertangkas 	= $this->input->post('tangkasnet');
				$usersdsb	 	= $this->input->post('sdsb');
				$useremail	 	= $this->input->post('email');
		  		
		  		if($usersbo != ''){
		  			$wheresbo 	 	= array('cusersbo' => $usersbo);
		  			$cusersbo 	 	= $this->m_customer->CekCustomer($wheresbo)->num_rows();
		  		}
		  		if($usermax != ''){
			  		$wheremax 	 	= array('cusermax' => $usermax);
			  		$cusermax 	 	= $this->m_customer->CekCustomer($wheremax)->num_rows();
			  	}
		  		if($userhorey != ''){
			  		$wherehorey  	= array('cuserhorey' => $userhorey);
			  		$cuserhorey 	= $this->m_customer->CekCustomer($wherehorey)->num_rows();
			  	}
		  		if($usertangkas != ''){
			  		$wheretangkas 	= array('cusertangkas' => $usertangkas);
			  		$cusertangkas 	= $this->m_customer->CekCustomer($wheretangkas)->num_rows();
			  	}
		  		if($usersdsb != ''){
			  		$wheresdsb 	 	= array('cuser' => $usersdsb);
			  		$cusersdsb 	 	= $this->m_customer->CekCustomer($wheresdsb)->num_rows();
			  	}
		  		if($useremail != ''){
			  		$whereemail 	= array('cemail' => $useremail);
			  		$cuseremail 	= $this->m_customer->CekCustomer($whereemail)->num_rows();
			  	}

		  		if($cusersbo > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, user SBOBET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cusermax > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, user MAXBET sudah terpakai!');
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
		  		if($cuseremail > 0 ){
		            $this->session->set_flashdata('warning', 'Maaf, email sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

					$data['cnama']				= $this->input->post('nama');
					$data['cuser'] 				= $this->input->post('sdsb');
					$data['cusersbo']			= $this->input->post('usersbo');
					$data['cusermax']			= $this->input->post('maxbet');
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
					$data['cdepositmax']		= str_replace(".", "", $this->input->post('dmaxbet'));
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
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dsbobet'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	

					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);

					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = str_replace(".", "", $this->input->post('dsbobet'));
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp+str_replace(".", "", $this->input->post('dsbobet'));
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}

			  		$rdbrand  		= 1;	
			  		$rdcustomer 	= $customer->cid;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $customer->cid;
						$rdreport['rdbrand']		 = 1;
						$rdreport['rddeposit'] 		 = str_replace(".", "", $this->input->post('dsbobet'));
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit+str_replace(".", "", $this->input->post('dsbobet'));
						$rdcust				  	 	 = $customer->cid;	
						$rdbrand				  	 = 1;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
	  	 		}

	  	 		if($this->input->post('dmaxbet') != ''){		
	  	 			$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $customer->cid;
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $customer->cusermax;
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= str_replace(".", "", $this->input->post('dmaxbet'));
					$row['tgrandtotal'] = str_replace(".", "", $this->input->post('dmaxbet'));
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 2;
					$row['tketerangan'] = 'Saldo awal MAXBET customer '.$customer->cusermax;
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dmaxbet'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	 				
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);

					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = str_replace(".", "", $this->input->post('dmaxbet'));
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp+str_replace(".", "", $this->input->post('dmaxbet'));
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}
	 				
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);

					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = str_replace(".", "", $this->input->post('dmaxbet'));
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp+str_replace(".", "", $this->input->post('dmaxbet'));
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}

			  		$rdbrand  		= 2;	
			  		$rdcustomer 	= $customer->cid;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $customer->cid;
						$rdreport['rdbrand']		 = 2;
						$rdreport['rddeposit'] 		 = str_replace(".", "", $this->input->post('dmaxbet'));
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit+str_replace(".", "", $this->input->post('dmaxbet'));
						$rdcust				  	 	 = $customer->cid;	
						$rdbrand				  	 = 2;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
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
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dhorey4d'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);
	 				
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);

					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = str_replace(".", "", $this->input->post('dhorey4d'));
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp+str_replace(".", "", $this->input->post('dhorey4d'));
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}	

			  		$rdbrand  		= 3;	
			  		$rdcustomer 	= $customer->cid;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $customer->cid;
						$rdreport['rdbrand']		 = 3;
						$rdreport['rddeposit'] 		 = str_replace(".", "", $this->input->post('dhorey4d'));
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit+str_replace(".", "", $this->input->post('dhorey4d'));
						$rdcust				  	 	 = $customer->cid;	
						$rdbrand				  	 = 3;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
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
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dtangkas'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	 				
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);

					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = str_replace(".", "", $this->input->post('dtangkas'));
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp+str_replace(".", "", $this->input->post('dtangkas'));
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}	

			  		$rdbrand  		= 4;	
			  		$rdcustomer 	= $customer->cid;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $customer->cid;
						$rdreport['rdbrand']		 = 4;
						$rdreport['rddeposit'] 		 = str_replace(".", "", $this->input->post('dtangkas'));
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit+str_replace(".", "", $this->input->post('dtangkas'));
						$rdcust				  	 	 = $customer->cid;	
						$rdbrand				  	 = 4;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
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
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+str_replace(".", "", $this->input->post('dsdsb'));
	  	 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
	 				$this->m_rekening->UpdateSaldo($idrek, $record);	
	 				
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);
	 				
					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = str_replace(".", "", $this->input->post('dsdsb'));
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp+str_replace(".", "", $this->input->post('dsdsb'));
						
						$periode				  = $periode;
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
						$rdreport['rddeposit'] 		 = str_replace(".", "", $this->input->post('dsdsb'));
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit+str_replace(".", "", $this->input->post('dsdsb'));
						$rdcust				  	 	 = $customer->cid;	
						$rdbrand				  	 = 5;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
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
				$this->load->model('m_reportlabarugi');
				$this->load->model('m_detailcustomer');
				$usersbo	 	= $this->input->post('usersbo');
				$usermax	 	= $this->input->post('maxbet');
				$userhorey	 	= $this->input->post('horey4d');
				$usertangkas 	= $this->input->post('tangkasnet');
				$usersdsb	 	= $this->input->post('sdsb');
				$useremail	 	= $this->input->post('email');

				if($usersbo != ''){
		  			$wheresbo 	 	= array('cusersbo' => $usersbo);
		  			$cusersbo 	 	= $this->m_customer->CekCustomer($wheresbo)->num_rows();
		  		}
		  		if($usermax != ''){
			  		$wheremax 	 	= array('cusermax' => $usermax);
			  		$cusermax 	 	= $this->m_customer->CekCustomer($wheremax)->num_rows();
			  	}
		  		if($userhorey != ''){
			  		$wherehorey  	= array('cuserhorey' => $userhorey);
			  		$cuserhorey 	= $this->m_customer->CekCustomer($wherehorey)->num_rows();
			  	}
		  		if($usertangkas != ''){
			  		$wheretangkas 	= array('cusertangkas' => $usertangkas);
			  		$cusertangkas 	= $this->m_customer->CekCustomer($wheretangkas)->num_rows();
			  	}
		  		if($usersdsb != ''){
			  		$wheresdsb 	 	= array('cuser' => $usersdsb);
			  		$cusersdsb 	 	= $this->m_customer->CekCustomer($wheresdsb)->num_rows();
			  	}
		  		if($useremail != ''){
			  		$whereemail 	= array('cemail' => $useremail);
			  		$cuseremail 	= $this->m_customer->CekCustomer($whereemail)->num_rows();
			  	}

		  		if($cusersbo > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, user SBOBET sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}
		  		if($cusermax > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, user MAXBET sudah terpakai!');
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
		  		if($cuseremail > 1 ){
		            $this->session->set_flashdata('warning', 'Maaf, email sudah terpakai!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

					$id	  						= $this->input->post('idcus');
					$data['cnama']				= $this->input->post('nama');
					$data['cemail']				= $this->input->post('email');
					$data['cuser'] 				= $this->input->post('sdsb');
					$data['cusersbo']			= $this->input->post('usersbo');
					$data['cusermax']			= $this->input->post('maxbet');
					$data['cuserhorey']			= $this->input->post('horey4d');
					$data['cusertangkas']		= $this->input->post('tangkasnet');
					$data['cpass'] 				= md5($this->input->post('pass'));
					$data['ctlp']				= $this->input->post('tlp');
					$data['calamat']			= $this->input->post('alamat');
					$data['cbank']				= $this->input->post('bank');
					$data['cnamarek']			= $this->input->post('nmrek');
					$data['cnorek']				= $this->input->post('norek');
					$data['cdepositsbo']		= str_replace(",", "", $this->input->post('dsbobet'));
					$data['cdepositmax']		= str_replace(",", "", $this->input->post('dmaxbet'));
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

					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);
	 				
					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = $dsbobet;
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp-$this->input->post('olddsbo')+$dsbobet;
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}	

			  		$rdbrand  		= 1;	
			  		$rdcustomer 	= $id;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $id;
						$rdreport['rdbrand']		 = 1;
						$rdreport['rddeposit'] 		 = $dsbobet;
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit-$this->input->post('olddsbo')+$dsbobet;
						$rdcust				  	 	 = $id;	
						$rdbrand				  	 = 1;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
		 		}

		 		if($this->input->post('olddmax') != str_replace(",", "", $this->input->post('dmaxbet'))){	
		 			$dmaxbet = str_replace(",", "", $this->input->post('dmaxbet'));	

			 		$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $this->input->post('idcus');
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $this->input->post('maxbet');
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= $dmaxbet;
					$row['tgrandtotal'] = $dmaxbet;
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 2;
					$row['tketerangan'] = 'Update saldo MAXBET customer '.$this->input->post('maxbet');
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dmaxbet-$this->input->post('olddmax');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
					
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);

					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = $dmaxbet;
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp-$this->input->post('olddmax')+$dmaxbet;
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}	

			  		$rdbrand  		= 2;	
			  		$rdcustomer 	= $id;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $id;
						$rdreport['rdbrand']		 = 2;
						$rdreport['rddeposit'] 		 = $dmaxbet;
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit-$this->input->post('olddmax')+$dmaxbet;
						$rdcust				  	 	 = $id;	
						$rdbrand				  	 = 2;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
		 		}

		 		if($this->input->post('olddhorey') != str_replace(",", "", $this->input->post('dhorey4d'))){	
		 			$dhorey4d = str_replace(",", "", $this->input->post('dhorey4d'));	

			 		$rekening 			= $this->m_rekening->RekeningPenerima();
					$row['tcustomer']	= $this->input->post('idcus');
					$row['tnomor']		= random_string('alnum', 15);
					$row['tdari']		= $this->input->post('horey4d');
					$row['ttujuan']	 	= $rekening->rno;
					$row['tharga']		= $dhorey4d;
					$row['tgrandtotal'] = $dhorey4d;
					$row['tjenis']		= 1;
					$row['tsubjenis']	= 51;
					$row['tsubdeposit']	= 61;
					$row['tbrand']		= 3;
					$row['tketerangan'] = 'Update saldo HOREY4D customer '.$this->input->post('horey4d');
					$row['tstatus']	 	= 1;
					$row['tuser'] 		= $this->session->userdata('id');
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dhorey4d-$this->input->post('olddhorey');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
					
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);
					
					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = $dhorey4d;
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp-$this->input->post('olddhorey')+$dhorey4d;
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}	

			  		$rdbrand  		= 3;	
			  		$rdcustomer 	= $id;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $id;
						$rdreport['rdbrand']		 = 3;
						$rdreport['rddeposit'] 		 = $dhorey4d;
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit-$this->input->post('olddhorey')+$dhorey4d;
						$rdcust				  	 	 = $id;	
						$rdbrand				  	 = 3;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
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
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dtangkas-$this->input->post('olddtangkas');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
					
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);
					
					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = $dtangkas;
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp-$this->input->post('olddtangkas')+$dtangkas;
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}	

			  		$rdbrand  		= 4;	
			  		$rdcustomer 	= $id;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $id;
						$rdreport['rdbrand']		 = 4;
						$rdreport['rddeposit'] 		 = $dtangkas;
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit-$this->input->post('olddtangkas')+$dtangkas;
						$rdcust				  	 	 = $id;	
						$rdbrand				  	 = 4;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
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
					$row['tperiode'] 	= date('Y-m-d');
					$row['tdate'] 		= date('Y-m-d H:i:s');
					
					$idrek 				= $rekening->rno;
					$record['rsaldo'] 	= $rekening->rsaldo+$dsdsb-$this->input->post('olddsdsb');
			 		
		  	 		$this->m_transaksi->SaveTransaksi($row);
					$this->m_rekening->UpdateSaldo($idrek, $record);	
					
					$periode		= date('Y-m-d');
			  		$cperiode  		= array('rperiode' => $periode);		
					$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);

					if($report == NULL){
						$report['rperiode']		 = $periode;
						$report['rjmhdeposit']	 = 1;
						$report['rjmhdepositrp'] = $dsdsb;
						$report['rstatus']		 = 1;
						$report['rdate']		 = date('Y-m-d H:i:s');

		  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
					}else{
						$jmhdeposit		= $report->rjmhdeposit+1;
						$jmhdepositrp	= $report->rjmhdepositrp-$this->input->post('olddsdsb')+$dsdsb;
						
						$periode				  = $periode;
						$report2['rjmhdeposit']	  = $jmhdeposit;
						$report2['rjmhdepositrp'] = $jmhdepositrp;

		  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
					}	

			  		$rdbrand  		= 5;	
			  		$rdcustomer 	= $id;	
			  		$caridetail  	= array('rdbrand' => $rdbrand, 'rdcustomerid' => $rdcustomer );
					$rdreport 		= $this->m_detailcustomer->CariDetailCustomer($caridetail);

					if($rdreport == NULL){
						$rdreport['rdperiode']		 = $periode;
						$rdreport['rdcustomerid']	 = $id;
						$rdreport['rdbrand']		 = 5;
						$rdreport['rddeposit'] 		 = $dsdsb;
						$rdreport['rdstatus']		 = 1;
						$rdreport['rddate']		 	 = date('Y-m-d H:i:s');

		  	 			$this->m_detailcustomer->SaveDetailCustomer($rdreport);	
					}else{
						$tambahdeposit				 = $rdreport->rddeposit-$this->input->post('olddsdsb')+$dsdsb;
						$rdcust				  	 	 = $id;	
						$rdbrand				  	 = 5;
						$rdreport2['rddeposit']	 	 = $tambahdeposit;

		  	 			$this->m_detailcustomer->EditDetailCustomer($rdcust, $rdbrand, $rdreport2);	
					}
		 		}
	       		redirect(base_url().'customer/listcustomer');
		  	}
	    }
 	}

	public function hapuscustomer($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
 		$data['detail'] = $this->m_customer->EditCustomer($id);
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
	  	$this->load->model('m_brand');
		$username	= $this->input->post("user");
		$brand		= 'SDSB ONLINE'; 	
		$where  	= array('bnama' => $brand);		
		$userbrand 	= $this->m_brand->CariBrand($where); 
		$deposit 	= $userbrand->bfield2;

		$where 		= array('cuser' => $username);
		$data['customer'] 	= $this->m_customer->SearchCustomerUsername($where);
		$count 				= $this->m_customer->CariCustomer($where)->num_rows();
		if($count == 0){
			$data['bank'] 		= '';
			$data['rekening'] 	= '';
			$data['norek'] 		= '';
			$data['deposit'] 	= '';
		}else{
			$data['bank'] 		= $data['customer']->cbank;
			$data['rekening'] 	= $data['customer']->cnamarek;
			$data['norek'] 		= $data['customer']->cnorek;
			$data['deposit'] 	= number_format($data['customer']->$deposit);
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
			$data['bank'] 		= '';
			$data['rekening'] 	= '';
			$data['deposit'] 	= '';
		}else{
			$data['bank'] 		= $data['customer']->cbank;
			$data['rekening'] 	= $data['customer']->cnamarek;
			$data['norek'] 		= $data['customer']->cnorek;
			$data['deposit'] 	= number_format($data['customer']->$deposit);
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