<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_provinces extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('provinces_model');
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
		
		$this->data['title'] = 'Master Status Pegawai';
		$this->data['data_provinces'] = $this->provinces_model->get_all();
		$this->load->view('masters/master_provinces', $this->data);
	}
	
	
	public function cek_provinces($id){
		
		$val = $this->provinces_model->get_byId($id); 
		
		echo trim($val['prov_name']);
	}
	
	
	public function do_popup_provinces($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$user_input = $this->session->userdata('username');
		
		if(empty($id)){
			$do_ = $this->provinces_model->insert_data($prov_name);
		}else{
			$do_ = $this->provinces_model->update_data($prov_name, $id);
		}
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_provinces($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->provinces_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}