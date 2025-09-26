<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_unsur_kegiatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('unsur_kegiatan_model');
		
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
		
		$this->data['title'] = 'Master Unsur Kegiatan';
		$this->data['data_unsur_kegiatan'] = $this->unsur_kegiatan_model->get_all();
		$this->load->view('masters/master_unsur_kegiatan', $this->data);
	}
	
	
	public function cek_unsur_kegiatan($id){
		
		$val = $this->unsur_kegiatan_model->get_byId($id); 
		
		echo $val['nama_uk'].'|'.$val['kategori_uk'];
	}
	
	
	public function do_popup_unsur_kegiatan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_uk'		=> $nama_uk,
			'kategori_uk'	=> $kategori_uk
		);
			
		if(empty($id)){
			$do_ = $this->unsur_kegiatan_model->insert_data($data);
		}else{
			$do_ = $this->unsur_kegiatan_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_unsur_kegiatan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->unsur_kegiatan_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_unsur_kegiatan.php */
/* Location: ./application/controllers/master_unsur_kegiatan.php */