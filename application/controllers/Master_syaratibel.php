<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_syaratibel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('syaratibel_model');
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
		
		$this->data['title'] = 'Master Syarat Izin Belajar';
		$this->data['data_syaratibel'] = $this->syaratibel_model->get_all();
		$this->load->view('masters/master_syaratibel', $this->data);
	}
    
    public function cek_syaratibel($id){
        $val = $this->syaratibel_model->get_byId($id); 
		if($val['is_require']=='1'){
            $req = (bool) true;
        }else{
            $req = (bool) false;
        }
		echo trim($val['uraian']."|".$req);
    }
    
    public function do_popup_syaratibel($id=''){
        extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$user_input = $this->session->userdata('username');
        if(isset($mandatori) && $mandatori=='on'){
            $man = '1';
        }else{
            $man = '0';
        }
		$data = array('uraian'=>$uraian,'is_require'=>$man);
		if(empty($id)){
			$do_ = $this->syaratibel_model->insert_data($data);
		}else{
			$do_ = $this->syaratibel_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
    }
    
    public function do_delete_syaratibel($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->syaratibel_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
}