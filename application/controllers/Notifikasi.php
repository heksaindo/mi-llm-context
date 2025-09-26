<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'notifikasi';
		$this->load->model('user_model');
		$this->load->model('notifikasi_model');
		
	}
	
	public function index($notifikasi_tipe = 'perubahan_drh')
	{	
		$this->perubahan_drh();
	}
	
	public function perubahan_drh()
	{
		$this->data['privilege'] =  $this->session->userdata('login_state');
		
		$this->data['title'] = 'Notifikasi - Perubahan DRH';
		
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
		$this->data['notifikasi_tipe'] = 'perubahan_drh';
		$this->data['data_message'] = $this->notifikasi_model->data_message($username, $previlege, 'Perubahan Data Pegawai');
		
		$this->load->view('notifikasi/notifikasi-perubahan_drh', $this->data);
	}
	
	public function permintaan_cuti()
	{
		$this->data['privilege'] =  $this->session->userdata('login_state');
		
		$this->data['title'] = 'Notifikasi - Permintaan Cuti';
		
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
		$this->data['notifikasi_tipe'] = 'permintaan_cuti';
		$this->data['data_message'] = $this->notifikasi_model->data_message($username, $previlege, 'Permintaan Cuti');
		
		$this->load->view('notifikasi/notifikasi-permintaan_cuti', $this->data);
	}
	
	public function permintaan_lembur()
	{
		$this->data['privilege'] =  $this->session->userdata('login_state');
		
		$this->data['title'] = 'Notifikasi - Permintaan Lembur';
		
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
		$this->data['notifikasi_tipe'] = 'permintaan_lembur';
		$this->data['data_message'] = $this->notifikasi_model->data_message($username, $previlege, 'Permintaan Lembur');
		
		$this->load->view('notifikasi/notifikasi-permintaan_lembur', $this->data);
	}
	
	
	public function read_msg()
	{
		extract($_POST); 
		
		$data_return = array(
			'status' => false,
			'data' => array()
		);
					
		if(!empty($id)){
			$data = $this->notifikasi_model->get_data_reply($id);
			$data_return['status'] = true;
			$data_return['data'] = $data;
		}
				
		echo json_encode($data_return);
	}
	
	
}

/* End of file master_jabatan.php */
/* Location: ./application/controllers/master_jabatan.php */