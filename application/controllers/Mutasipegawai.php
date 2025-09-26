<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mutasipegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('Pegawai_model');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'mutasipegawai';
		$this->data['data_pegawai'] = $this->Pegawai_model->get_pegawai_by_id();
		$this->load->view('mutasipegawai', $this->data);
	}
	
	public function add()
	{
		$this->data['data_pegawai'] = False ;
		$this->data['title'] = 'Add Mutasi Pegawai';
		$this->load->view('add_mutasipegawai', $this->data);
	}
	
	public function addexisting()
	{
		$this->data['data_pegawai'] = $this->Pegawai_model->get_pegawai_by_id();
		$this->data['title'] = 'Add Mutasi Pegawai';
		$this->load->view('add_mutasipegawai', $this->data);
	}
	
	public function cetak()
	{
		$this->data['title'] = 'Print Mutasi Pegawai';
		$this->load->view('cetak_mutasipegawai', $this->data);
	}
	
	public function listprocessed()
	{
		$this->data['title'] = 'List Mutasi Pegawai';
		$this->load->view('list_mutasipegawai', $this->data);
	}
	
}