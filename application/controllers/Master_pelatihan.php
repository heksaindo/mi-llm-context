<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_pelatihan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('pelatihan_model');
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
		
		$this->data['title'] = 'Master pelatihan';
		$this->data['data_pelatihan'] = $this->pelatihan_model->get_all();
		$this->load->view('masters/master_pelatihan', $this->data);
	}
	
	
	public function cek_pelatihan($id){
		
		$val = $this->pelatihan_model->get_byId($id); 
		
		echo trim($val['nama_pelatihan']).'|'.trim($val['level']);
	}
	
	
	public function do_popup_pelatihan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_pelatihan'	=> $nama_pelatihan,
			'level'	=> $level
		);
			
		if(empty($id)){
			$do_ = $this->pelatihan_model->insert_data($data);
		}else{
			$do_ = $this->pelatihan_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_pelatihan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->pelatihan_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_pelatihan.php */
/* Location: ./application/controllers/master_pelatihan.php */