<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_jabatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('jabatan_model');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->load->helper('general_helper');
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		$this->data['title'] = 'Master jabatan';
		$this->data['data_jabatan'] = $this->jabatan_model->get_all();
		$this->load->view('masters/master_jabatan', $this->data);
	}
	
	
	public function cek_jabatan($id){
		
		$val = $this->jabatan_model->get_byId($id); 
		
		echo trim($val['nama_jabatan']).'|'.trim($val['id_status_jabatan']).'|'.trim($val['use_pak']);
	}
	
	
	public function do_popup_jabatan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_jabatan'	=> $nama_jabatan,
			'id_status_jabatan'	=> $id_status_jabatan,
			'use_pak'	=> $use_pak
		);
			
		if(empty($id)){
			$do_ = $this->jabatan_model->insert_data($data);
		}else{
			$do_ = $this->jabatan_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_jabatan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->jabatan_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_jabatan.php */
/* Location: ./application/controllers/master_jabatan.php */