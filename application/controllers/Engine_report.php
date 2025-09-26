<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Engine_report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'engine_report';
		$this->load->model('engine_report_model');
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
		$this->data['data_report'] = $this->engine_report_model->get_report();
		$this->load->view('engine_report/list_report', $this->data);
	}
		
	public function cek_report($id){
		
		$data_return = array(
			'status' => false,
			'data' => array()
		);
				
		if(!empty($id)){
			$data = $this->engine_report_model->get_byId($id);
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
			'report_name'	=> $report_name,
			'report_description'	=> $report_description,
			'report_header'	=> $report_header,
			'report_footer_left'	=> $report_footer_left,
			'report_footer_center'	=> $report_footer_center,
			'report_footer_right'	=> $report_footer_right
		);
			
		if(empty($id)){
			$do_ = $this->engine_report_model->insert_data($data);
		}else{
			$do_ = $this->engine_report_model->update_data($data, $id);
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
		
		$do_ = $this->engine_report_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function running($id = '')
	{
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		if(!empty($id)){
			$info_report = $this->engine_report_model->get_report($id);
			$this->data['info_report'] = $info_report;
			$this->data['data_report'] = $this->engine_report_model->running_report($info_report);
			$this->data['title'] = $info_report['report_name'];
		}else{
			$this->data['info_report'] = array();
			$this->data['data_report'] = array();
			$this->data['title'] = 'Report Not Found!';
		}
		
		$this->load->view('engine_report/running', $this->data);
	}
	
	public function running_cetak($id = '')
	{
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		if(!empty($id)){
			$info_report = $this->engine_report_model->get_report($id);
			$this->data['info_report'] = $info_report;
			$this->data['data_report'] = $this->engine_report_model->running_report($info_report);
			$this->data['title'] = $info_report['report_name'];
		}else{
			$this->data['info_report'] = array();
			$this->data['data_report'] = array();
			$this->data['title'] = 'Report Not Found!';
		}
		
		$this->load->view('engine_report/cetak_engine_report', $this->data);
	}
	
	public function setting($id = '')
	{
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		$this->load->model('engine_report_master_group_model');
		$this->data['data_table_group'] = $this->engine_report_master_group_model->get_report();
		if(!empty($id)){
			$info_report = $this->engine_report_model->get_report($id);
			$this->data['info_report'] = $info_report;
			$this->data['data_setting'] = $this->engine_report_model->setting_report($info_report);
			$this->data['title'] = $info_report['report_name'];
		}else{
			$this->data['info_report'] = array();
			$this->data['data_setting'] = array();
			$this->data['title'] = 'Report Not Found!';
		}
		
		$this->load->view('engine_report/setting_report', $this->data);
	}
		
	public function cek_setting($id){
		
		$data_return = array(
			'status' => false,
			'data' => array()
		);
				
		if(!empty($id)){
			$data = $this->engine_report_model->get_setting($id);
			$data_return['status'] = true;
			$data_return['data'] = $data;
		}
		
		echo json_encode($data_return);
	}
		
	public function do_popup_setting($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$level_header = 0;
		if(!empty($parent_id)){
			$level_header = 1;
		}
		
		//get last order
		if(empty($rdd_order)){
			$this->db->select('rdd_order');
			$this->db->from('report_data_detail');
			$this->db->where('id_report', $id_report);
			$this->db->where('parent_id', $parent_id);
			$this->db->where('level_header', $level_header);
			
			if(!empty($id)){
				$this->db->where('id_rdd != '.$id);
			}
			
			$this->db->order_by('rdd_order', 'DESC');
			$get_last_order = $this->db->get();
			
			$rdd_order = 0;
			if($get_last_order->num_rows() > 0){
				$dt_last_rdd = $get_last_order->row_array();
				$rdd_order = $dt_last_rdd['rdd_order'] + 1;
			}
			
			
		}
		
		$data = array(
			'id_report'		=> $id_report,
			'header_name'	=> $header_name,
			'id_rtf'		=> $id_rtf,
			'parent_id'		=> $parent_id,
			'level_header'	=> $level_header,
			'output_format'	=> $output_format,
			'rdd_order'		=> $rdd_order
		);
			
		if(empty($id)){
			$do_ = $this->engine_report_model->insert_setting($data);
		}else{
			$do_ = $this->engine_report_model->update_setting($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function delete_setting($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->engine_report_model->delete_setting($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function get_field()
	{
		extract($_POST); 
		
		$data_ret = '<option value="">Pilih Data/Field</option>'."\n";
		if(!empty($id_rtg)){
			$get_field = $this->engine_report_model->get_rtg_field($id_rtg);
			if(!empty($get_field)){
				foreach($get_field as $dtF){
					$data_ret .= '<option value="'.$dtF['id_rtf'].'#'.$dtF['tf_name'].'">'.$dtF['tf_name'].' ('.$dtF['ref_field'].')</option>'."\n";
				}
			}
		}
		
		echo $data_ret;
	}

	public function get_setting_parent()
	{
		extract($_POST); 
		$id_curr = 0;
		if(!empty($id_rdd)){
			$id_curr = $id_rdd;
		}
		
		$data_ret = '<option value="">Root</option>'."\n";
		if(!empty($id_report)){
			$get_setting_parent = $this->engine_report_model->get_setting_parent($id_report, $id_curr);
			if(!empty($get_setting_parent)){
				foreach($get_setting_parent as $dtF){
					$data_ret .= '<option value="'.$dtF['id_rdd'].'">'.$dtF['header_name'].'</option>'."\n";
				}
			}
		}
		
		echo $data_ret;
	}
	
}

/* End of file master_report.php */
/* Location: ./application/controllers/master_report.php */