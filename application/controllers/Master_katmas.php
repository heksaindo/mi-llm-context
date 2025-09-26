<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_katmas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('katmas_model');
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
		
		$this->data['title'] = 'Master Katmas';
		$this->data['data_katmas'] = $this->katmas_model->get_all();
		$this->load->view('masters/master_katmas', $this->data);
	}
	
	
	public function cek_katmas($id){
		
		$val = $this->katmas_model->get_byId($id); 
		
		echo trim($val['kategori']);
	}
	
	
	public function do_popup_katmas($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'kategori'	=> $kategori
		);
			
		if(empty($id)){
			$do_ = $this->katmas_model->insert_data($data);
		}else{
			$do_ = $this->katmas_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_katmas($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->katmas_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

