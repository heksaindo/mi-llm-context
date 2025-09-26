<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_city extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('city_model');
		$this->load->helper('general_helper');
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
		
		$this->data['title'] = 'Master Kabupaten/Kota';
		$this->data['data_city'] = $this->city_model->get_all();
		$this->load->view('masters/master_city', $this->data);
	}
	
	
	public function cek_city($id){
		
		$val = $this->city_model->get_byId($id); 
		
		echo trim($val['city_name']).'|'.trim($val['prov_id']);
	}
	
	
	public function do_popup_city($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'city_name'	=> $city_name,
			'prov_id'		=> $prov_id
		);
			
		if(empty($id)){
			$do_ = $this->city_model->insert_data($data);
		}else{
			$do_ = $this->city_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_city($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->city_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_city.php */
/* Location: ./application/controllers/master_city.php */