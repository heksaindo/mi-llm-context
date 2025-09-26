<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_unitkerja extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('unitkerja_model');
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
		
		$this->data['title'] = 'Master Unit Kerja';
		$this->data['data_unitkerja'] = $this->unitkerja_model->get_all();
		$this->load->view('masters/master_unitkerja', $this->data);
	}
	
	
	public function cek_unitkerja($id){
		
		$val = $this->unitkerja_model->get_byId($id); 
		
		echo trim($val['nama_unit_kerja']).'|'.trim($val['kode_unit_kerja']).'|'.trim($val['level']).'|'.trim($val['parent_unit']).'|'.trim($val['prov_id']);
	}
	
	public function cek_kode()
	{
		extract($_POST); 
		$last_kode = $this->unitkerja_model->get_kode($parent_unit); 
		$new_kode = $last_kode;
		echo $new_kode;
	}
	
	
	public function do_popup_unitkerja($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_unit_kerja'	=> $nama_unit_kerja,
			'level'				=> $level,
			'kode_unit_kerja'	=> $kode_unit_kerja,
			'parent_unit'		=> $parent_unit,
			'prov_id'			=> $prov_id
		);
			
		if(empty($id)){
			$do_ = $this->unitkerja_model->insert_data($data);
		}else{
			$do_ = $this->unitkerja_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_unitkerja($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->unitkerja_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_unitkerja.php */
/* Location: ./application/controllers/master_unitkerja.php */