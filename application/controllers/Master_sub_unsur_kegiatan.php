<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_sub_unsur_kegiatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('sub_unsur_kegiatan_model');
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
		$this->load->helper('general_helper');
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		$this->data['title'] = 'Master Sub Unsur Kegiatan';
		$this->data['data_sub_unsur_kegiatan'] = $this->sub_unsur_kegiatan_model->get_all();
		$this->load->view('masters/master_sub_unsur_kegiatan', $this->data);
	}
	
	
	public function cek_sub_unsur_kegiatan($id){
		
		$val = $this->sub_unsur_kegiatan_model->get_byId($id); 
		
		echo $val['id_uk'].'|'.$val['sub_unsur'].'|'.$val['butir_kegiatan'].'|'.$val['nilai_uk'].'|'.$val['satuan_hasil'].'|'.
		$val['id_jabatan'].'|'.$val['pelaksana'].'|'.$val['satuan_bagi'];
	}
	
	
	public function do_popup_sub_unsur_kegiatan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$pelaksana = 'Semua Jenjang';
		if(!empty($id_jabatan)){
			$pelaksana = get_name('m_jabatan','nama_jabatan','id_jabatan', $id_jabatan);
		}
		
		$data = array(
			'id_uk'		=> $id_uk,
			'sub_unsur'	=> $sub_unsur,
			'butir_kegiatan'	=> $butir_kegiatan,
			'nilai_uk'		=> $nilai_uk,
			'satuan_hasil'	=> $satuan_hasil,
			'satuan_bagi'	=> $satuan_bagi,
			'id_jabatan'	=> $id_jabatan,
			'pelaksana'		=> $pelaksana
		);
			
		if(empty($id)){
			$do_ = $this->sub_unsur_kegiatan_model->insert_data($data);
		}else{
			$do_ = $this->sub_unsur_kegiatan_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_sub_unsur_kegiatan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->sub_unsur_kegiatan_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_sub_unsur_kegiatan.php */
/* Location: ./application/controllers/master_sub_unsur_kegiatan.php */