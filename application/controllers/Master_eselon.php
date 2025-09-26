<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_eselon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('eselon_model');
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
		
		$this->data['title'] = 'Master Eselon';
		$this->data['data_eselon'] = $this->eselon_model->get_all();
		$this->load->view('masters/master_eselon', $this->data);
	}
	
	
	public function cek_eselon($id){
		
		$val = $this->eselon_model->get_byId($id); 
		
		echo trim($val['nama_eselon']).'|'.trim($val['level']);
	}
	
	
	public function do_popup_eselon($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_eselon'	=> $nama_eselon,
			'level'	=> $level
		);
			
		if(empty($id)){
			$do_ = $this->eselon_model->insert_data($data);
		}else{
			$do_ = $this->eselon_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_eselon($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->eselon_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_eselon.php */
/* Location: ./application/controllers/master_eselon.php */