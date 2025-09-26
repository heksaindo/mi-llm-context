<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Engine_report_master_group_relasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'engine_report';
		$this->load->model('engine_report_master_group_relasi_model');
		$this->load->model('engine_report_master_group_model');
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
		
		$this->data['title'] = 'Report List';
		$this->data['data_relas_rtg'] = $this->engine_report_master_group_relasi_model->get_report();
		$this->data['data_table_group'] = $this->engine_report_master_group_model->get_report();
		$this->load->view('engine_report/master_group_relasi', $this->data);
	}
		
	public function cek_report($id){
		
		$data_return = array(
			'status' => false,
			'data' => array()
		);
				
		if(!empty($id)){
			$data = $this->engine_report_master_group_relasi_model->get_byId($id);
			$data_return['status'] = true;
			$data_return['data'] = $data;
		}
		
		echo json_encode($data_return);
	}
	
	
	public function do_popup_report($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'id_rtg_from'	=> $id_rtg_from,
			'id_rtg_to'		=> $id_rtg_to,
			'relasi_rtg'	=> $relasi_rtg
		);
			
		if(empty($id)){
			$do_ = $this->engine_report_master_group_relasi_model->insert_data($data);
		}else{
			$do_ = $this->engine_report_master_group_relasi_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_report($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->engine_report_master_group_relasi_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}

}

/* End of file master_report.php */
/* Location: ./application/controllers/master_report.php */