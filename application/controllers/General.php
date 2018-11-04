<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('string');
	}
	
	//halaman backend
	public function backend(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model(array('m_customer','m_nomor','m_transaksi','m_pemenang','m_pemenang'));
		$data['customer'] 		= $this->m_customer->CCustomer();
		$data['nomor'] 			= $this->m_nomor->CNomor();
		$data['deposit'] 		= $this->m_transaksi->CDeposit();
		$data['dana'] 			= $this->m_transaksi->CTransfer();
		$data['transharis'] 	= $this->m_transaksi->TransaksiPerhari(3);
		$data['pemenanglist'] 	= $this->m_pemenang->PemenangHome(5);
		$data['latestkupon'] 	= $this->m_transaksi->TransaksiKupon(5);
		$data['transfers'] 		= $this->m_transaksi->TransferHome(5);
		$data['deposits'] 		= $this->m_transaksi->DepositHome(5);

		$data['title'] = 'Halaman Administrator - '.BRAND;
		$data['page']  = 'backend/page/home';
		$this->load->view('backend/thamplate', $data);
	}

	public function harga(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$data['lists'] = $this->m_general->Harga();

		$data['title'] = 'List Harga Kupon - '.BRAND;
		$data['page']  = 'backend/general/harga';
		$this->load->view('backend/thamplate', $data); 
 	}

	public function periode(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$data['lists'] = $this->m_general->Periode();
		// var_dump($data['lists']);die();

		$data['title'] = 'List Periode Kupon - '.BRAND;
		$data['page']  = 'backend/general/periode';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function periode_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('periode1', 'Periode Awal', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('periode2', 'Periode Akhir', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/periode');
		  	} else { 		
				$id 					= 9;
				$data['gname'] 			= 'Periode Kupon';
				$data['gperiodedari'] 	= date('Y-m-d', strtotime($this->input->post('periode1')));
				$data['gperiodesampai'] = date('Y-m-d', strtotime($this->input->post('periode2')));
				$data['gbrand'] 		= 'SDSB Online';
				$data['gdate'] 			= date('Y-m-d H:i:s');
				
	  			$this->load->model('m_general');
	  	 		$this->m_general->SavePeriode($id, $data);	
	       		redirect(base_url().'general/periode');
		  	}
	    }
 	}

 	public function harga_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('harga', 'Harga Kupon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/harga');
		  	} else { 		
				$id				= $this->input->post('id');
				$data['gharga'] = str_replace(",", "", $this->input->post('harga'));

	  			$this->load->model('m_general');
	  	 		$this->m_general->SaveHarga($id, $data);	
	       		redirect(base_url().'general/harga');
		  	}
	    }
 	}

	public function potonganpembelian(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$data['lists'] = $this->m_general->PotonganPembelian();

		$data['title'] = 'Potongan Pembelian - '.BRAND;
		$data['page']  = 'backend/general/listpotongan';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addpotongan(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		
		$data['title'] = 'Potongan Pembelian Baru - '.BRAND;
		$data['page']  = 'backend/general/addpotongan';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function addpotongan_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('jmhdari', 'Mininal Kupon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('jmhsampai', 'Maksimal Kupon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('potongan', 'Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/addpotongan');
		  	} else { 		
				$data['gname']  	= 'Potongan Pembelian';
				$data['gqtydari']  	= $this->input->post('jmhdari');
				$data['gqtysampai'] = $this->input->post('jmhsampai');
				$data['gdiskon'] 	= $this->input->post('potongan');
				$data['gstatus'] 	= 2;
				$data['gdate'] 		= date('Y-m-d H:i:s');

	  			$this->load->model('m_general');
	  	 		$this->m_general->SavePotongan($data);	
	       		redirect(base_url().'general/potonganpembelian');
		  	}
	    }
 	}

 	public function editpotongan($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
 		$data['detail'] = $this->m_general->DetailPotongan($id);

 		$data['title'] = 'Edit Potongan Pembelian - '.BRAND;
 		$data['page']  = 'backend/general/editpotongan';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpotongan_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('jmhdari', 'Minimal Kupon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('jmhsampai', 'Maksimal Kupon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('potongan', 'Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id	  = $this->input->post('id_potongan');
				$data = array(
					'gname'  	=> 'Potongan Pembelian',
					'gqtydari'	=> $this->input->post('jmhdari'),
					'gqtysampai'=> $this->input->post('jmhsampai'),
					'gdiskon' 	=> $this->input->post('potongan')
				);

	  			$this->load->model('m_general');
	  	 		$this->m_general->EditPotongan($id, $data);	
	       		redirect(base_url().'general/potonganpembelian');
		  	}
	    }
 	}

	public function hapusgeneral($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$this->m_general->HapusPotongan($id);
		redirect(base_url('general/PotonganPembelian'));
	}

	public function pengeluaranbulanan(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$data['lists'] = $this->m_general->PengeluaranBulanan();

		$data['title'] = 'List Pengeluaran Bulanan - '.BRAND;
		$data['page']  = 'backend/general/listbulanan';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addpengeluaran(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_rekening');
		$data['transfer'] 	= $this->m_rekening->RekeningTransfer();
		$data['lists'] 		= $this->m_rekening->Rekening();
		
		$data['title'] = 'Tambah Pengeluaran Bulanan - '.BRAND;
		$data['page']  = 'backend/general/addpengeluaran';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function addpengeluaran_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('transfer', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pengeluaran', 'Pengeluaran', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('harga', 'Harga', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('rate', 'Rate', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Periode', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/addpengeluaran');
		  	} else { 		
	  			$this->load->model('m_general');
	  			$this->load->model('m_rekening');
	  			$this->load->model('m_transaksi');
	  			$this->load->model('m_reportlabarugi');
	  			$harga 			= str_replace(".", "", $this->input->post('harga'));
	  			$rate 			= str_replace(".", "", $this->input->post('rate'));
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
		  		$total		 	= $harga*$rate;
				$periode		= date('Y-m-d', strtotime($this->input->post('tanggal')));
		  		$cperiode  		= array('rperiode' => $periode);		
				$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);
	  	 		$calculate 		= $saldorekening->rsaldo-$total;

		  		if($saldorekening->rsaldo < $total){
		            $this->session->set_flashdata('warning', 'Maaf, saldo rekening tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

				$data['gname']  		= $this->input->post('pengeluaran');
				$data['gdolar'] 		= $harga;
				$data['grate'] 			= $rate;
				$data['gharga'] 		= $total;
				$data['gperiode'] 		= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['gketerangan'] 	= $this->input->post('keterangan');
				$data['gketerangan2'] 	= $this->input->post('keterangan2');
				$data['gstatus'] 		= 8;
				$data['gdate'] 			= date('Y-m-d H:i:s');

				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $this->input->post('transfer');
				$record['ttujuan']		= 'Pengeluaran Bulanan';
				$record['tharga']		= $total;
				$record['tgrandtotal']	= $total;
				$record['tjenis']		= 8;
				$record['trekeningdari']= $saldorekening->rno;
				$record['tsubjenis']	= 52;
				$record['tsubdeposit'] 	= 62;
				$record['tperiode'] 	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$record['tketerangan']  = 'Pengeluaran bulanan '.$this->input->post('pengeluaran');
				$record['tstatus']		= 1;
				$record['tuser'] 		= $this->session->userdata('id');
				$record['tdate'] 		= date('Y-m-d H:i:s');

				$rekening 		= $this->input->post('transfer');
				$row['rsaldo'] 	= $calculate;

				if($report == NULL){
					$report['rperiode']		 	 = $periode;
					$report['rbiayaoperasional'] = $total;
					$report['rstatus']		 	 = 1;
					$report['rdate']		  	 = date('Y-m-d H:i:s');

	  	 			$this->m_reportlabarugi->SaveLabaRugi($report);	
				}else{
					$periode				  	  = $periode;
					$report2['rbiayaoperasional'] = $report->rbiayaoperasional+$total;

	  	 			$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
				}

	  	 		$this->m_general->SavePengeluaran($data);	
	  	 		$this->m_rekening->UpdateSaldo($rekening, $row);
	  	 		$this->m_transaksi->SaveTransaksi($record);		
	       		redirect(base_url().'general/pengeluaranbulanan');
		  	}
	    }
 	}

  	public function editpengeluaran($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_rekening');
	  	$this->load->model('m_general');
		$data['transfer'] = $this->m_rekening->RekeningTransfer();
		$data['lists'] 	  = $this->m_rekening->Rekening();
 		$data['detail']   = $this->m_general->DetailPengeluaran($id);

 		$data['title'] = 'Edit Pengeluaran Bulanan - '.BRAND;
 		$data['page']  = 'backend/general/editpengeluaran';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpengeluaran_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('transfer', 'Rekening Transfer', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('pengeluaran', 'Pengeluaran', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('harga', 'Harga', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('rate', 'Rate', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('tanggal', 'Periode', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	}  		 		
  			$this->load->model('m_general');
  			$this->load->model('m_rekening');
  			$this->load->model('m_transaksi');
  			$this->load->model('m_reportlabarugi');

	  		$harga 			= str_replace(",", "", $this->input->post('harga'));
	  		$rate 			= str_replace(",", "", $this->input->post('rate'));
  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
	  		$total		 	= $harga*$rate;
			$periode		= date('Y-m-d', strtotime($this->input->post('tanggal')));
	  		$cperiode  		= array('rperiode' => $periode);		
			$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);
			$calculate 		= $saldorekening->rsaldo+$this->input->post('total')-$total;

			if($saldorekening->rsaldo < $total){
				$this->session->set_flashdata('warning', 'Maaf, saldo rekening tidak cukup!');
				redirect($_SERVER['HTTP_REFERER']);
			}

			$id 					= $this->input->post('id');
			$data['gname']  		= $this->input->post('pengeluaran');
			$data['gdolar'] 		= $harga;
			$data['grate'] 			= $rate;
			$data['gharga'] 		= $total;
			$data['gperiode'] 		= date('Y-m-d', strtotime($this->input->post('tanggal')));
			$data['gketerangan'] 	= $this->input->post('keterangan');
			$data['gketerangan2'] 	= $this->input->post('keterangan2');

			$transaksi 				= $this->input->post('nomor');
			$record['trekeningdari']= $saldorekening->rno;
			$record['tdari']		= $this->input->post('transfer');
			$record['ttujuan']		= 'Pengeluaran Bulanan';
			$record['tharga']		= $total;
			$record['tgrandtotal']	= $total;
			$record['tjenis']		= 8;
			$record['tsubjenis']	= 52;
			$record['tsubdeposit'] 	= 62;
			$record['tperiode'] 	= date('Y-m-d', strtotime($this->input->post('tanggal')));
			$record['tketerangan']  = 'Pengeluaran Bulanan'.' - Biaya '.$this->input->post('pengeluaran');
			$record['tuser'] 		= $this->session->userdata('id');

			$rekening 		= $this->input->post('transfer');
			$row['rsaldo'] 	= $calculate;
	
			if($report == NULL){
				$report['rperiode']		 	 = $periode;
				$report['rbiayaoperasional'] = $total;
				$report['rstatus']		 	 = 1;
				$report['rdate']		  	 = date('Y-m-d H:i:s');

		 		$this->m_reportlabarugi->SaveLabaRugi($report);	
			}else{
				$periode				  	  = $periode;
				$report2['rbiayaoperasional'] = $report->rbiayaoperasional+$this->input->post('total')-$total;
		 		
		 		$this->m_reportlabarugi->EditRugiLaba($periode, $report2);	
			}

  	 		$this->m_general->EditPengeluaran($id, $data);
	  	 	$this->m_rekening->UpdateSaldo($rekening, $row);	
	  	 	$this->m_transaksi->UpdateTransaksi($transaksi, $record);	
       		redirect(base_url().'general/pengeluaranbulanan');
	    }
 	}

	public function hapuspengeluaran($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$this->m_general->HapusPengeluaran($id);
		redirect(base_url().'general/pengeluaranbulanan');
	}

	public function excelpengeluaranbulanan(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$data['lists'] = $this->m_general->PengeluaranBulanan();

		$this->load->view('backend/general/excelpengeluaran', $data);
	}

	public function reportpermainanharian(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_brand');
		$data['brands']  = $this->m_brand->Brand();

		$data['title'] = 'Report Permainan Harian - '.BRAND;
		$data['page']  = 'backend/report/permainanharian';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportpermainanharian_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$dari 			 = date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		 = date('Y-m-d', strtotime($this->input->post('sampai')));
		$email 			 = $this->input->post('email');
		$brand 	 		 = $this->input->post('brand');

		$data['dari'] 	 = date('Y-m-d', strtotime($this->input->post('dari')));
		$data['sampai']  = date('Y-m-d', strtotime($this->input->post('sampai')));
		$data['filter']	 = $this->input->post('brand');
		$data['filter2'] = $this->input->post('email');
		$data['lists'] 	 = $this->m_transaksi->ReportPermainanHarian($dari,$sampai,$email,$brand);
		if($data['lists'] == NULL){
			$this->load->view('backend/report/ajaxkosong', $data);
		}else{
			$this->load->view('backend/report/ajaxpermainanharian', $data);
		}
	}

	public function reportpermainanharian_excel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$dari 			 = date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		 = date('Y-m-d', strtotime($this->input->post('sampai')));
		$email 			 = $this->input->post('email');
		$brand 	 		 = $this->input->post('brand');

		$data['dari'] 	 = date('Y-m-d', strtotime($this->input->post('dari')));
		$data['sampai']  = date('Y-m-d', strtotime($this->input->post('sampai')));
		$data['lists'] 	 = $this->m_transaksi->ReportPermainanHarian($dari,$sampai,$email,$brand);
		if($data['lists'] == NULL){
			$this->load->view('backend/report/ajaxkosong', $data);
		}else{
			$this->load->view('backend/excel/permainanharian', $data);
		}
	}

	public function reportrekening(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}

		$data['title'] = 'Report Rekening - '.BRAND;
		$data['page']  = 'backend/report/rekening';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportrekening_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$dari 			= date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		= date('Y-m-d', strtotime($this->input->post('sampai')));
		$email 			= $this->input->post('email');
		$data['periode']= $this->input->post('periode');
		$data['lists'] 	= $this->m_transaksi->ReportPermainanHarian($dari,$sampai,$email);

		$this->load->view('backend/report/ajaxpermainanharian', $data);
	}

	public function periodepermainanharian($periode) {
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$data['lists'] = $this->m_transaksi->ReportPeriodePermainanHarian($periode);
		$data['title'] = 'Report Permainan Harian - '.BRAND;
		$data['page']  = 'backend/report/periodepermainanharian';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportbiayaoperasional(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_brand');
		$data['brands']  = $this->m_brand->Brand();

		$data['title'] = 'Report Biaya Operasiona; - '.BRAND;
		$data['page']  = 'backend/report/biaya';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportbiayaoperasional_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$dari 			= date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		= date('Y-m-d', strtotime($this->input->post('sampai')));

		$data['dari'] 	= $dari;
		$data['sampai'] = $sampai;
		$data['lists'] 	= $this->m_general->ReportBiayaOperasional($dari,$sampai);
		if($data['lists'] == NULL){
			$this->load->view('backend/report/ajaxkosong', $data);
		}else{
			$this->load->view('backend/report/ajaxbiaya', $data);
		}
	}

	public function reportbiaya_excel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_general');
		$dari 			 = date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		 = date('Y-m-d', strtotime($this->input->post('sampai')));

		$data['dari'] 	 = date('Y-m-d', strtotime($this->input->post('dari')));
		$data['sampai']  = date('Y-m-d', strtotime($this->input->post('sampai')));
		$data['lists'] 	 = $this->m_general->ReportBiayaOperasional($dari,$sampai);
		if($data['lists'] == NULL){
			$this->load->view('backend/report/ajaxkosong', $data);
		}else{
			$this->load->view('backend/excel/biaya', $data);
		}
	}

	public function reportrugilaba(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}

		$data['title'] = 'Report Rugi/Laba - '.BRAND;
		$data['page']  = 'backend/report/rugilaba';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportrugilaba_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_reportlabarugi');
		$dari 			 = date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		 = date('Y-m-d', strtotime($this->input->post('sampai')));

		$data['dari'] 	 = date('Y-m-d', strtotime($this->input->post('dari')));
		$data['sampai']  = date('Y-m-d', strtotime($this->input->post('sampai')));
		$data['lists'] 	 = $this->m_reportlabarugi->ReportRugiLaba($dari,$sampai);
		$this->load->view('backend/report/ajaxrugilaba', $data);
	}


	public function reportrugilaba_excel(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_reportlabarugi');
		$dari 			 = date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		 = date('Y-m-d', strtotime($this->input->post('sampai')));

		$data['dari'] 	 = $this->input->post('dari');
		$data['sampai']  = $this->input->post('sampai');
		$data['lists'] 	 = $this->m_reportlabarugi->ReportRugiLaba($dari,$sampai);
		if($data['lists'] == NULL){
			$this->load->view('backend/report/ajaxkosong', $data);
		}else{
			$this->load->view('backend/excel/labarugi', $data);
		}
	}

	public function detaildeposit($periode) {
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$data['lists'] = $this->m_transaksi->ReportPeriodeDeposit($periode);
		$data['title'] = 'Report Permainan Harian Deposit - '.BRAND;
		$data['page']  = 'backend/report/detaildeposit';
		$this->load->view('backend/thamplate', $data); 
	}

	public function detailwithdraw($periode) {
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$data['lists'] = $this->m_transaksi->ReportPeriodeWithdraw($periode);
		$data['title'] = 'Report Permainan Harian Withdraw- '.BRAND;
		$data['page']  = 'backend/report/detailwithdraw';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportcustomer(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_brand');
		$data['brands']  = $this->m_brand->Brand();

		$data['title'] = 'Report Customer - '.BRAND;
		$data['page']  = 'backend/report/customer';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportcustomer_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_customer');
		$dari 			 = date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		 = date('Y-m-d', strtotime($this->input->post('sampai')));
		$email 			 = $this->input->post('email');

		$data['dari'] 	 = date('Y-m-d', strtotime($this->input->post('dari')));
		$data['sampai']  = date('Y-m-d', strtotime($this->input->post('sampai')));
		$data['filter2'] = $this->input->post('email');
		$data['lists'] 	 = $this->m_customer->ReportCustomer($dari,$sampai,$email);
		if($data['lists'] == NULL){
			$this->load->view('backend/report/ajaxkosong', $data);
		}else{
			$this->load->view('backend/report/ajaxcustomer', $data);
		}
	}

	public function reportdetailcustomer(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_brand');
		$data['brands']  = $this->m_brand->Brand();

		$data['title'] = 'Report Detail Customer - '.BRAND;
		$data['page']  = 'backend/report/detailcustomer';
		$this->load->view('backend/thamplate', $data); 
	}

	public function reportdetailcustomer_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_detailcustomer');
		// $dari 			 = date('Y-m-d', strtotime($this->input->post('dari')));
		// $sampai 		 = date('Y-m-d', strtotime($this->input->post('sampai')));
		$brand 			 = $this->input->post('brand');
		$email 			 = $this->input->post('email');

		// $data['dari'] 	 = date('Y-m-d', strtotime($this->input->post('dari')));
		// $data['sampai']  = date('Y-m-d', strtotime($this->input->post('sampai')));
		$data['brand'] 	 = $this->input->post('brand');
		$data['filter2'] = $this->input->post('email');
		// $data['lists'] 	 = $this->m_detailcustomer->ReportDetailCustomer($dari,$sampai,$email);
		$data['lists'] 	 = $this->m_detailcustomer->ReportDetailCustomer($email,$brand);

		if($data['lists'] == NULL){
			$this->load->view('backend/report/ajaxkosong', $data);
		}else{
			$this->load->view('backend/report/ajaxdetailcustomer', $data);
		}
	}
}