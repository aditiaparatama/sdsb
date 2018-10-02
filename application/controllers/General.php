<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	  	$this->load->model('m_general');
	}
	
	//Halaman Backend
	public function harga(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
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
				$id							= $this->input->post('id');
				$data['harga_general'] 		= $this->input->post('harga');

	  	 		$this->m_general->SaveHarga($id, $data);	
	       		redirect(base_url().'general/harga');
		  	}
	    }
 	}

	public function potonganpembelian(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
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
				$data['qty_general']  		= $this->input->post('jumlah');
				$data['diskon_general'] 	= $this->input->post('potongan');
				$data['status_general'] 	= 2;
				$data['date_general'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_general->SavePotongan($data);	
	       		redirect(base_url().'general/potonganpembelian');
		  	}
	    }
 	}

 	public function editpotongan($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
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
					'qty_general'		=> $this->input->post('jumlah'),
					'diskon_general' 	=> $this->input->post('potongan')
				);

	  	 		$this->m_general->EditPotongan($id, $data);	
	       		redirect(base_url().'general/potonganpembelian');
		  	}
	    }
 	}

	public function hapusgeneral($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_general->HapusPotongan($id);
		redirect(base_url('general/PotonganPembelian'));
	}

	public function pengeluaranbulanan(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_general->PengeluaranBulanan();

		$data['title'] = 'List Pengeluaran Bulanan - '.BRAND;
		$data['page']  = 'backend/general/listbulanan';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addpengeluaran(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		
		$data['title'] = 'Tambah Pengeluaran Bulanan - '.BRAND;
		$data['page']  = 'backend/general/addpengeluaran';
		$this->load->view('backend/thamplate', $data);		
 	}

 	public function addpengeluaran_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('biaya', 'Biaya', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('tanggal', 'Periode', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
            	$this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect(base_url().'general/addpengeluaran');
		  	} else { 		
				$data['name_general']  		= $this->input->post('keterangan');
				$data['harga_general'] 		= $this->input->post('biaya');
				$data['periode_general'] 	= date('Y-m-d', strtotime($this->input->post('tanggal')));
				$data['status_general'] 	= 4;
				$data['date_general'] 		= date('Y-m-d H:i:s');

	  	 		$this->m_general->SavePengeluaran($data);	
	       		redirect(base_url().'general/pengeluaranbulanan');
		  	}
	    }
 	}

  	public function editpengeluaran($id){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
 		$data['detail'] = $this->m_general->DetailPengeluaran($id);

 		$data['title'] = 'Edit Pengeluaran Bulanan - '.BRAND;
 		$data['page']  = 'backend/general/editpengeluaran';
 		$this->load->view('backend/thamplate', $data);
 	}

 	public function editpengeluaran_act(){
 		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			$this->form_validation->set_rules('biaya', 'Biaya', 'required|htmlspecialchars|strip_image_tags|encode_php_tags|numeric');
			$this->form_validation->set_rules('tanggal', 'Periode', 'required|htmlspecialchars|strip_image_tags|encode_php_tags');
			if($this->form_validation->run() == false){
	            $this->session->set_flashdata('warning', 'Maaf, validasi anda gagal!');
				redirect($_SERVER['HTTP_REFERER']);
		  	} else { 		
				$id	  = $this->input->post('id_general');
				$data = array(
					'name_general'		=> $this->input->post('keterangan'),
					'harga_general'		=> $this->input->post('biaya'),
					'periode_general' 	=> date('Y-m-d', strtotime($this->input->post('tanggal')))
				);

	  	 		$this->m_general->EditPengeluaran($id, $data);	
	       		redirect(base_url().'general/pengeluaranbulanan');
		  	}
	    }
 	}

	public function hapuspengeluaran($id){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$this->m_general->HapusPengeluaran($id);
		redirect(base_url().'general/pengeluaranbulanan');
	}

	public function excelpengeluaranbulanan(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$data['lists'] = $this->m_general->PengeluaranBulanan();

		$this->load->view('backend/general/excelpengeluaran', $data);
	}



	//report
	public function penerimaan(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}

		$data['title'] = 'Penerimaan Dana - '.BRAND;
		$data['page']  = 'backend/report/penerimaan';
		$this->load->view('backend/thamplate', $data); 
 	}

	public function penerimaan_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$dari 			= date('Y-m-d', strtotime($this->input->post('dari')));
		$sampai 		= date('Y-m-d', strtotime($this->input->post('sampai')));
		$email 			= $this->input->post('email');
		$data['periode']= $this->input->post('periode');
		$data['lists'] 	= $this->m_transaksi->Pemasukan($dari,$sampai,$email);

		$this->load->view('backend/report/ajaxpenerimaan', $data);
	}

	public function reportpengeluaran(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}

		$data['title'] = 'Report Pengeluaran - '.BRAND;
		$data['page']  = 'backend/report/pengeluaran';
		$this->load->view('backend/thamplate', $data); 
 	}

	public function addreportpengeluaran_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
		$bulan 				= date('m', strtotime($this->input->post('periode')));
		$tahun 				= date('Y', strtotime($this->input->post('periode')));
		$data['periode']	= $this->input->post('periode');
		$data['lists']		= $this->m_general->ReportPengeluaranBulanan($bulan,$tahun);

		$this->load->view('backend/report/excelpengeluaran', $data);
	}

	public function report(){
		if($this->session->userdata('status') != "backend"){
			redirect(base_url('cmskita'));
		}

		$data['title'] = 'Report - '.BRAND;
		$data['page']  = 'backend/report/report';
		$this->load->view('backend/thamplate', $data); 
 	}

 	public function addreport_act(){
		if($this->session->userdata('status') != "backend"){
		   redirect(base_url('cmskita'));
		}
	  	$this->load->model('m_transaksi');
		$bulan 					= date('m', strtotime($this->input->post('periode')));
		$tahun 					= date('Y', strtotime($this->input->post('periode')));
		$data['periode']		= $this->input->post('periode');
		$data['pemasukan'] 		= $this->m_transaksi->ReportPemasukanBulanan($bulan,$tahun);
		$data['pengeluaran']	= $this->m_general->ReportPengeluaranBulanan($bulan,$tahun);

		$this->load->view('backend/report/excelreport', $data);
 	}
}