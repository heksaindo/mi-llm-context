<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_statusjabatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('statusjabatan_model');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		$this->data['title'] = 'Master Status Jabatan';
		$this->data['data_statusjabatan'] = $this->statusjabatan_model->get_all();
		$this->load->view('masters/master_statusjabatan', $this->data);
	}
	
	
	public function cek_statusjabatan($id){
		
		$val = $this->statusjabatan_model->get_byId($id); 
		
		echo trim($val['nama_status_jabatan']);
	}
	
	
	public function do_popup_statusjabatan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$user_input = $this->session->userdata('username');
		
		if(empty($id)){
			$do_ = $this->statusjabatan_model->insert_data($nama_status_jabatan);
		}else{
			$do_ = $this->statusjabatan_model->update_data($nama_status_jabatan, $id);
		}
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_statusjabatan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->statusjabatan_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}