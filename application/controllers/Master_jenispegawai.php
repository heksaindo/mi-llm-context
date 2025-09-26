<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_jenispegawai extends CI_Controller{
    public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('jenispegawai_model');
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
		
		$this->data['title'] = 'Master Jenis Kepegawaian';
		$this->data['data_jenispegawai'] = $this->jenispegawai_model->get_all();
		$this->load->view('masters/master_jenispegawai', $this->data);
	}
	
	
	public function cek_jenispegawai($id){
		
		$val = $this->jenispegawai_model->get_byId($id); 
		
		echo trim($val['nama_jenis_kepegawaian']);
	}
	
	
	public function do_popup_jenispegawai($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_jenis_kepegawaian'	=> $nama_jenis_kepegawaian
		);
			
		if(empty($id)){
			$do_ = $this->jenispegawai_model->insert_data($data);
		}else{
			$do_ = $this->jenispegawai_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_jenispegawai($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->jenispegawai_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
}