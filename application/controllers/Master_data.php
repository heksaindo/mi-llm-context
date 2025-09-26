<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_data extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('user_model');
		$this->load->helper('general_helper');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Administrasi Data Master';
		$username = $this->session->userdata('pegawai_id');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this_year = date('Y');
		
		$this->load->model('dashboard_model');
		$this->data['total_pns'] = $this->dashboard_model->data_total_pns();
		$this->data['total_cpns'] = $this->dashboard_model->data_total_cpns();
		
		$total_cuti_tahun_ini = $this->dashboard_model->data_total_cuti_tahun_ini($this_year);
		$total_cuti_tahun_sebelumnya = $this->dashboard_model->data_sisa_cuti_tahun_sebelumnya($username, $this_year);
		$this->data['total_cuti'] = $total_cuti_tahun_ini + $total_cuti_tahun_sebelumnya;
		$this->data['cuti_dipakai'] = $this->dashboard_model->data_cuti_dipakai($username);
		
		$this->load->view('master_data', $this->data);
	}
	
}