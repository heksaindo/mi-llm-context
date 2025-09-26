<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_unsurklasifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('unsurklasifikasi_model');
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
		
		$this->data['title'] = 'Master Unsur Klasifikasi';
		$this->data['data_klasifikasi'] = $this->unsurklasifikasi_model->get_all();
		$this->load->view('masters/master_unsurklasifikasi', $this->data);
	}
	
	
	public function cek_klasifikasi($id){
		
		$val = $this->unsurklasifikasi_model->get_byId($id); 
		
		echo trim($val['nama_klasifikasi']).'|'.trim($val['id_unsur']).'|'.$val['skor'].'|'.$val['tolok_ukur'];
	}
	
	
	public function do_popup_klasifikasi($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_klasifikasi'	=> $nama_klasifikasi,
			'id_unsur'	=> $id_unsur,
			'skor'	=> $skor,
			'tolok_ukur' => $tolok_ukur
		);
			
		if(empty($id)){
			$do_ = $this->unsurklasifikasi_model->insert_data($data);
		}else{
			$do_ = $this->unsurklasifikasi_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_klasifikasi($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->unsurklasifikasi_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}

/* End of file master_unsurklasifikasi.php */
/* Location: ./application/controllers/master_unsurklasifikasi.php */