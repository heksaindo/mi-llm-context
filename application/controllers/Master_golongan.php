<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_golongan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('golongan_model');
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
		$this->data['data_golongan'] = $this->golongan_model->get_all();
		$this->load->view('masters/master_golongan', $this->data);
	}
	
	
	public function cek_golongan($id){
		
		$val = $this->golongan_model->get_byId($id); 
		
		echo trim($val['kode_golongan']).'|'.trim($val['nama_golongan']).'|'.trim($val['kdkelgapok']).'|'.trim($val['level']);
	}
	
	
	public function do_popup_golongan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'kode_golongan'	=> $kode_golongan,
			'nama_golongan'	=> $nama_golongan,
			'kdkelgapok'	=> $kdkelgapok,
			'level'	=> $level
		);
			
		if(empty($id)){
			$do_ = $this->golongan_model->insert_data($data);
		}else{
			$do_ = $this->golongan_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_golongan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->golongan_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_golongan.php */
/* Location: ./application/controllers/master_golongan.php */