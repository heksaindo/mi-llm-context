<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class master_users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('user_model');
		$this->load->model('general_model');
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
		
		$this->data['title'] = 'Master Users';
		$this->data['data_users'] = $this->user_model->get_all();
		$this->load->view('masters/master_users', $this->data);
	}
	
	public function save(){
		$ses_user = $this->session->userdata('user_id');
		$f = $this->general_model->get_byId('pegawai','id', $this->input->post('pegawai_id'));
		
		$data = array(
			'pegawai_id' => $this->input->post('pegawai_id'),
			'email_user' => $this->input->post('email_user'),
			'passwordmd5_user' => md5($f->nip_baru),
			'privilege_user' => $this->input->post('privilege_user'),
			'status_user' => $this->input->post('status_user')
			
		);
		
		if($this->input->post('id_user')){
			$data['updated_date']= date("Y-m-d");
			$data['updated_by']= $ses_user;
			$this->general_model->update_data('user', $this->input->post(), 'id_user' ,$this->input->post('id_user'));
		}else{
			$data['created_date']= date("Y-m-d");
			$data['created_by']= $ses_user;
			$this->general_model->insert_data('user', $data);
		}
	}
	
	public function cek_users($id){
		
		$val = $this->user_model->get_byId($id); 
		
		echo trim($val['pegawai_id']).'|'.trim($val['email_user']).'|'.$val['privilege_user'].'|'.$val['status_user'];
	}
	
	
	public function do_popup_users($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$data = array(
			'pegawai_id'	=> $pegawai_id,
			'email_user'	=> $email_user,
			'passwordmd5_user'	=> md5($passwordmd5_user),
			'privilege_user'	=> $privilege_user,
			'status_user' => $status_user
		);
			
		if(empty($id)){
			$do_ = $this->user_model->insert_data($data);
		}else{
			$do_ = $this->user_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_users($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->user_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	//AUTOCOMPLETE
	function auto_pegawai(){
		extract($_POST); 
		$where = "a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%'";
		$this->db->select("a.nip_baru, a.nama")
				->from("pegawai as a")
				->where("a.nip_baru NOT IN (SELECT nip FROM user)")
				->where("a.status", 'aktif')
				->where($where);
		$this->db->order_by('nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				echo $row->nama."(".$row->nip_baru.") |".$row->nip_baru."|".$row->nama."\n";
			}
		}
	}
	
}

/* End of file master_unsurusers.php */
/* Location: ./application/controllers/master_unsurusers.php */