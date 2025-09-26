<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_unsurpenilaian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('unsurpenilaian_model');
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
		
		$this->data['title'] = 'Master  Unsur Penilaian';
		$this->data['data_unsurpenilaian'] = $this->unsurpenilaian_model->get_all();
		$this->load->view('masters/master_unsurpenilaian', $this->data);
	}
	
	
	public function cek_unsurpenilaian($id){
		
		$val = $this->unsurpenilaian_model->get_byId($id); 
		
		echo trim($val['nama_unsur']);
	}
	
	
	public function do_popup_unsurpenilaian($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$user_input = $this->session->userdata('username');
		
		if(empty($id)){
			$do_ = $this->unsurpenilaian_model->insert_data($nama_unsur);
		}else{
			$do_ = $this->unsurpenilaian_model->update_data($nama_unsur, $id);
		}
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_unsurpenilaian($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->unsurpenilaian_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}