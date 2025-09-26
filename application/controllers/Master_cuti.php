<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_cuti extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('mcuti_model');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('email_user');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		$this->data['title'] = 'Master Cuti';
		$this->data['data_cuti'] = $this->mcuti_model->get_all();
		$this->load->view('masters/master_cuti', $this->data);
	}
	
	
	
	
	public function cek_cuti($id){
		
		$val = $this->mcuti_model->get_byId($id); 
		
		echo trim($val['tahun']).'|'.trim($val['libur_bersama']).'|'.trim($val['libur_tahunan']);
	}
	
	
	public function do_popup_cuti($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'tahun'	=> $tahun,
			'libur_bersama'	=> $libur_bersama,
			'libur_tahunan' => $libur_tahunan
		);
			
		if(empty($id)){
			$do_ = $this->mcuti_model->insert_data($data);
		}else{
			$do_ = $this->mcuti_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_cuti($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mcuti_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}
