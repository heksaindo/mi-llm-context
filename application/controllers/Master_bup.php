<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_bup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('bup_model');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('user_id');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		$this->data['title'] = 'Master Batas Usia Pensiun';
		$this->data['data_bup'] = $this->bup_model->get_all();
		$this->load->view('masters/master_bup', $this->data);
	}
    
    public function get_eselon(){
        $val = $this->bup_model->get_eselon();
        $arr=array(array('value'=>'','text'=>'Pilih Eselon'));
        foreach($val->result_array() as $rk){
            $arr[] = array('value'=>$rk['id_eselon'].'#'.$rk['nama_eselon'],'text'=>$rk['nama_eselon']);
        }
        die(json_encode($arr));
    }
    
    public function get_golongan(){
        $val = $this->bup_model->get_golongan();
        $arr=array(array('value'=>'','text'=>'Pilih Golongan'));
        foreach($val->result_array() as $rk){
            $arr[] = array('value'=>$rk['id_golongan'].'#'.$rk['kode_golongan'].'#'.$rk['nama_golongan'],'text'=>$rk['nama_golongan']);
        }
        die(json_encode($arr));
    }
    
    public function cek_bup(){
        $id_e = $this->input->post('eselon');
        $val = $this->bup_model->cek_byId($id_e); 
		echo trim($val->id_eselon).'|'.trim($val->nama_eselon).'|'.trim($val->bup);
    }
    
    public function do_popup_bup(){
        extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'bup'	=> $bup
		);
        
		$do_ = $this->bup_model->proses_bup($data,$id);
		die(json_encode($do_));
    }

}