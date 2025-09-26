<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_hukuman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('hukuman_model');
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
		
		$this->data['title'] = 'Master Hukuman';
		$this->data['data_hukuman'] = $this->hukuman_model->get_all();
		$this->load->view('masters/master_hukuman', $this->data);
	}
	
	
	public function cek_hukuman($id){
		
		$val = $this->hukuman_model->get_byId($id); 
		
		echo trim($val['nama_hukuman']);
	}
	
	
	public function do_popup_hukuman($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		if(empty($id)){
			$do_ = $this->hukuman_model->insert_data($nama_hukuman);
		}else{
			$do_ = $this->hukuman_model->update_data($nama_hukuman, $id);
		}
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_hukuman($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->hukuman_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}