<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lembur extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'penugasandankehadiran';
		$this->load->model('Lembur_model');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Lembur';
		
		//$this->data['data_perjadin'] = $this->Perjadin_model->get_all();
		$this->data['data_lembur'] = $this->Lembur_model->get_lembur($this->session->userdata('login_state'));

		$this->load->view('lembur', $this->data);
	}
	
	public function add()
	{
		$this->data['title'] = 'Add Lembur';
		$this->load->view('add_lembur', $this->data);
	}
	
	public function addlembur()
	{
		if ($this->input->post('tanggal_lembur') != '') {
		$data = array(
				'nip' 				=> $this->session->userdata('nip'),
				'nama'  			=> $this->session->userdata('login_state'),
				'tanggal_lembur'  	=> $this->input->post('tanggal_lembur'),
				'jam_mulai'			=> $this->input->post('jam_mulai'),
				'jam_akhir'			=> $this->input->post('jam_akhir'),
				'alasan' 			=> $this->input->post('alasan'),
				'status'			=> 'submit'
			);
			
		$this->Lembur_model->insert_lembur($data);
		}
		redirect('lembur');
	}
	
	public function approve()
	{
		$this->data['title'] = 'Approve Lembur';
		
		$this->data['data_lembur'] = $this->Lembur_model->get_all();
		
		$this->load->view('approve_lembur', $this->data);
	}
	
	public function approveperjadin($lembur_id)
	{
		$data = array(
				'status'			=> 'approved'
			);
			
		$this->Lembur_model->update_lembur($lembur_id,$data);
		
		redirect('lembur/approve');
	}
	
	public function rejectlembur($lembur_id)
	{
		$data = array(
				'status'			=> 'rejected'
			);
			
		$this->Lembur_model->update_lembur($lembur_id,$data);
		
		redirect('lembur/approve');
	}
	
	public function cetak()
	{
		$this->data['title'] = 'Print Lembur';
		$this->load->view('cetak_lembur', $this->data);
	}
}