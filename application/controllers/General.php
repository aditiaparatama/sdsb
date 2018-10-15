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

 	public function harga_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('harga', 'Harga Kupon', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/harga');
		  	} else { 		
				$id				= $this->input->post('id');
				$data['gharga'] = $this->input->post('harga');

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
			$this->form_validation->set_rules('jumlah', 'Jumlah Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('potongan', 'Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/addpotongan');
		  	} else { 		
				$data['gqty']  		= $this->input->post('jumlah');
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
			$this->form_validation->set_rules('jumlah', 'Jumlah Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('potongan', 'Potongan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id	  = $this->input->post('id_potongan');
				$data = array(
					'gqty'		=> $this->input->post('jumlah'),
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
			$this->form_validation->set_rules('harga', 'Harga', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('rate', 'Rate', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('tanggal', 'Periode', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/addpengeluaran');
		  	} else { 		
	  			$this->load->model('m_general');
	  			$this->load->model('m_rekening');
	  			$this->load->model('m_transaksi');
	  			$this->load->model('m_reportlabarugi');
	  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
		  		$total		 	= $this->input->post('harga')*$this->input->post('rate');
				$periode		= date('Y-m-d', strtotime($this->input->post('tanggal')));
		  		$cperiode  		= array('rperiode' => $periode);		
				$report 		= $this->m_reportlabarugi->CariLabaRugi($cperiode);
	  	 		$calculate 		= $saldorekening->rsaldo-$total;

		  		if($saldorekening->rsaldo < $total){
		            $this->session->set_flashdata('warning', 'Maaf, saldo rekening tidak cukup!');
					redirect($_SERVER['HTTP_REFERER']);
		  		}

				$data['gname']  		= $this->input->post('pengeluaran');
				$data['gdolar'] 		= $this->input->post('harga');
				$data['grate'] 			= $this->input->post('rate');
				$data['gharga'] 		= $total;
				$data['gperiode'] 		= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['gketerangan'] 	= $this->input->post('keterangan');
				$data['gketerangan2'] 	= $this->input->post('Keterangan2');
				$data['gstatus'] 		= 4;
				$data['gdate'] 			= date('Y-m-d H:i:s');

				$record['tnomor']		= random_string('alnum', 15);
				$record['tdari']		= $this->input->post('transfer');
				$record['ttujuan']		= 'Pengeluaran Bulanan';
				$record['tharga']		= $total;
				$record['tgrandtotal']	= $total;
				$record['tjenis']		= 8;
				$record['tsubjenis']	= 52;
				$record['tsubdeposit'] 	= 62;
				$record['tperiode'] 	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$record['tketerangan']  = 'Pengeluaran Bulanan'.' - Biaya '.$this->input->post('pengeluaran');
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
			$this->form_validation->set_rules('harga', 'Harga', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('rate', 'Rate', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('tanggal', 'Periode', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	}  		 		
  			$this->load->model('m_general');
  			$this->load->model('m_rekening');
  			$this->load->model('m_transaksi');
  			$this->load->model('m_reportlabarugi');

  	 		$saldorekening 	= $this->m_rekening->DetailRekening($this->input->post('transfer'));
	  		$total		 	= $this->input->post('harga')*$this->input->post('rate');
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
			$data['gdolar'] 		= $this->input->post('harga');
			$data['grate'] 			= $this->input->post('rate');
			$data['gharga'] 		= $total;
			$data['gperiode'] 		= date('Y-m-d', strtotime($this->input->post('tanggal')));
			$data['gketerangan'] 	= $this->input->post('keterangan');
			$data['gketerangan2'] 	= $this->input->post('Keterangan2');
			$data['gstatus'] 		= 4;
			$data['gdate'] 			= date('Y-m-d H:i:s');

			$transaksi 				= $this->input->post('nomor');
			$record['tnomor']		= random_string('alnum', 15);
			$record['tdari']		= $this->input->post('transfer');
			$record['ttujuan']		= 'Pengeluaran Bulanan';
			$record['tharga']		= $total;
			$record['tgrandtotal']	= $total;
			$record['tjenis']		= 8;
			$record['tsubjenis']	= 52;
			$record['tsubdeposit'] 	= 62;
			$record['tperiode'] 	= date('Y-m-d', strtotime($this->input->post('tanggal')));
			$record['tketerangan']  = 'Pengeluaran Bulanan'.' - Biaya '.$this->input->post('pengeluaran');
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
				$report2['rbiayaoperasional'] = $report->rbiayaoperasional-$this->input->post('total')+$total;
		 		
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
		$data['lists'] 	 = $this->m_transaksi->ReportPermainanHarian($dari,$sampai,$email,$brand);

		$this->load->view('backend/report/ajaxpermainanharian', $data);
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
		$data['lists'] 	= $this->m_general->ReportBiayaOperasional($dari,$sampai);

		$this->load->view('backend/report/ajaxbiaya', $data);
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
		$data['lists'] 	 = $this->m_reportlabarugi->ReportRugiLaba($dari,$sampai);

		$this->load->view('backend/report/ajaxrugilaba', $data);
	}
}