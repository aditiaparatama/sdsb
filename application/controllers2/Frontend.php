<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	function __construct(){
		parent::__construct();
 		$this->load->library('session');
 		$this->load->helper(array('form', 'url'));
	}

	public function index() {
		$data['title'] = BRAND;
		$data['page']  = 'frontend/index';
		$this->load->view('thamplate', $data); 
	}

}