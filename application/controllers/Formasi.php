<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Formasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'formasi';
	}
	
	public function index()
	{	
		$this->data['title'] = 'Formasi';
		
		$this->load->view('formasi', $this->data);
	}
	
}