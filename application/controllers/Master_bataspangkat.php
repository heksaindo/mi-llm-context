<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_bataspangkat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('bataspangkat_model');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$this->sessionuser = $this->session->userdata('user_id');
		$this->previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->previlege;
        $this->data['login_state'] = $this->previlege;
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($this->sessionuser, $this->previlege);
	}
	
	public function index($id = '')
	{	
		$this->data['title'] = 'Master Batas Pangkat';
		$this->load->view('masters/master_bataspangkat', $this->data);
	}
	
	public function ajax_pendidikan(){
		
		$result = $this->bataspangkat_model->get_all(); 
		
        $json["aaData"] = array();		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
        foreach($result as $row)
		{
			$golongan ='-';
			if($row->golongan_max !=''){
				$gol = $this->bataspangkat_model->ddl_gol($row->golongan_max);
				$golongan = $gol->nama_golongan.' - '.$gol->kode_golongan;
			}
            $printnya = "<a href='javascript:void(0);' onclick='javascript:onEdit_bataspangkat(".$row->id_strata.");' class='fam-application-edit'></a> | ";
            $printnya .= "<a href='javascript:void(0);' onclick='javascript:onDelete_bataspangkat(".$row->id_strata.");' class='fam-application-delete'></a>";
            array_push($json["aaData"],array(
					$i,
					$row->nama_strata,
					$row->nama_strata2,
					$golongan,
					$printnya
				));
			$i++;
        }
        header("Content-type: application/json");
        echo json_encode($json);
	}
	
	public function cek_bataspangkat(){
		extract($_POST);
		$val = $this->bataspangkat_model->get_byId($id); 
		echo trim($val['nama_strata']).'|'.trim($val['nama_strata2']).'|'.trim($val['golongan_max']);
	}
	
	
	public function do_save()
	{
		extract($_POST); 

		$status = 'error';
		$do_ = '';
		
		$data = array(
			'golongan_max' => $golongan_max
		);
			
		if(empty($id)){
			$do_ = false;
		}else{
			$do_ = $this->bataspangkat_model->update_data($data, $id);
		}
		if($do_){
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete()
	{
		extract($_POST); 

		$status = 'error';
		$do_ = '';
		$data = array(
			'golongan_max' =>''
		);
		$do_ = $this->bataspangkat_model->update_data($data, $id);
		if($do_){
			$status = 'success';	
		}
		
		echo $status;
	}
	
	
}
