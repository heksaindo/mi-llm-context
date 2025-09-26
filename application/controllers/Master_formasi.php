<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_formasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('formasi_model');
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
		
		$this->data['title'] = 'Master Golongan';
		$this->data['data_formasi'] = $this->formasi_model->get_all();
		$this->load->view('masters/master_formasi', $this->data);
	}
	
	
	
	
	public function cek_formasi($id){
		
		$val = $this->formasi_model->get_byId($id); 
		
		echo trim($val['tipe_formasi']).'|'.trim($val['nama_formasi']);
	}
	
	
	public function do_popup_formasi($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'tipe_formasi'	=> $tipe_formasi,
			'nama_formasi'	=> $nama_formasi
		);
			
		if(empty($id)){
			$do_ = $this->formasi_model->insert_data($data);
		}else{
			$do_ = $this->formasi_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_formasi($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->formasi_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}
