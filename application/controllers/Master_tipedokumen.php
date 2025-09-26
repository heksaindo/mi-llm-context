<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_tipedokumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('tipedokumen_model');
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
		
		$this->data['title'] = 'Master Tipe Dokumen';
		$this->data['data_tipedokumen'] = $this->tipedokumen_model->get_all();
		$this->load->view('masters/master_tipedokumen', $this->data);
	}
	
	
	
	
	public function cek_tipedokumen($id){
		
		$val = $this->tipedokumen_model->get_byId($id); 
		
		echo trim($val['tipe_dokumen']);
	}
	
	
	public function do_popup_tipedokumen($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'tipe_dokumen'	=> $tipe_dokumen
		);
			
		if(empty($id)){
			$do_ = $this->tipedokumen_model->insert_data($data);
		}else{
			$do_ = $this->tipedokumen_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_tipedokumen($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->tipedokumen_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}
