<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_prasarat_angkakredit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('prasarat_angkakredit_model');
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
		
		$this->data['title'] = 'Master prasarat_angkakredit';
		$this->data['data_prasarat_angkakredit'] = $this->prasarat_angkakredit_model->get_all();
		$this->load->view('masters/master_prasarat_angkakredit', $this->data);
	}
	
	
	public function cek_prasarat_angkakredit($id){
		
		$val = $this->prasarat_angkakredit_model->get_byId($id); 
		
		echo $val['id_jabatan'].'|'.$val['id_golongan'].'|'.$val['jenjang'].'|'.$val['nilai_ak'];
	}
	
	
	public function do_popup_prasarat_angkakredit($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'id_jabatan'	=> $id_jabatan,
			'id_golongan'	=> $id_golongan,
			'jenjang'	=> $jenjang,
			'nilai_ak'	=> $nilai_ak
		);
			
		if(empty($id)){
			$do_ = $this->prasarat_angkakredit_model->insert_data($data);
		}else{
			$do_ = $this->prasarat_angkakredit_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_prasarat_angkakredit($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->prasarat_angkakredit_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_prasarat_angkakredit.php */
/* Location: ./application/controllers/master_prasarat_angkakredit.php */