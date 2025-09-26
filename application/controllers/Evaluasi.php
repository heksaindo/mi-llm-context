<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Evaluasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'evaluasi';
	}
	
	public function index()
	{	
		$this->data['title'] = 'Evaluasi';
		
		$this->load->view('evaluasi', $this->data);
	}
	
}