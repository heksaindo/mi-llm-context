<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Engine_report_master_field extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'engine_report';
		$this->load->model('engine_report_master_group_model');
		$this->load->model('engine_report_master_field_model');
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
		$this->data['data_rtf'] = $this->engine_report_master_field_model->get_report();
		$this->data['data_table_group'] = $this->engine_report_master_group_model->get_report();
		$this->load->view('engine_report/master_field', $this->data);
	}
		
	public function cek_report($id){
		
		$data_return = array(
			'status' => false,
			'data' => array()
		);
				
		if(!empty($id)){
			$data = $this->engine_report_master_field_model->get_byId($id);
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
		
		$ref_field = $ref_field2;
		
		$data = array(
			'tf_name'		=> $tf_name,
			'id_rtg'		=> $id_rtg,
			'ref_field'		=> $ref_field,
			'tf_tipe'		=> $tf_tipe,
			'option_value'	=> $option_value,
			'tf_additional_sql_select'	=> $tf_additional_sql_select,
			'tf_additional_sql_join'	=> $tf_additional_sql_join,
			'tf_additional_sql_where'	=> $tf_additional_sql_where,
			'tf_additional_sql_order_group'	=> $tf_additional_sql_order_group,
			'require_sql'	=> $require_sql,
			'keterangan'	=> $keterangan
		);
			
		if(empty($id)){
			$do_ = $this->engine_report_master_field_model->insert_data($data);
		}else{
			$do_ = $this->engine_report_master_field_model->update_data($data, $id);
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
		
		$do_ = $this->engine_report_master_field_model->delete_data($id);
		
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
			$get_group = $this->engine_report_master_group_model->get_byId($id_rtg);
			
			if(!empty($get_group['ref_table'])){
				$get_field = $this->db->field_data($get_group['ref_table']);
				
				if(!empty($get_field)){
					foreach($get_field as $dtF){
					
						$info_field = '';
						if(!empty($dtF->type)){
							$info_field .= $dtF->type;
						}
						
						if(!empty($dtF->max_length)){
							$info_field .= ' '.$dtF->max_length;
						}
						if(!empty($info_field)){
							$info_field = ' ('.$info_field.')';
						}
						
						
						$info_primary_key = '';
						if(!empty($dtF->primary_key)){
							$info_primary_key = '*';
						}
						
						$data_ret .= '<option value="'.$dtF->name.'">'.$dtF->name.$info_primary_key.$info_field.'</option>'."\n";
					}
				}
			}
			
			
		}
		
		echo $data_ret;
	}

}

/* End of file master_report.php */
/* Location: ./application/controllers/master_report.php */