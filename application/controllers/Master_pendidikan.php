<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_pendidikan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('pendidikan_model','pm');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$this->sessionuser = $this->session->userdata('user_id');
		$this->previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->previlege;
        $this->data['login_state'] = $this->previlege;
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($this->sessionuser, $this->previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Master Pendidikan';
		$this->load->view('masters/master_pendidikan', $this->data);
	}
	
	public function ajax_pendidikan(){
		
		$result = $this->pm->get_all(); 
		
        $json["aaData"] = array();		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
        foreach($result as $row)
		{
            $printnya = "<a href='javascript:void(0);' onclick='javascript:onEdit_pendidikan(".$row->id_strata.");' class='fam-application-edit'></a> | ";
            $printnya .= "<a href='javascript:void(0);' onclick='javascript:onDelete_pendidikan(".$row->id_strata.");' class='fam-application-delete'></a>";
            array_push($json["aaData"],array(
					$i,
					$row->nama_strata,
					$row->nama_strata2,
					$row->level,
					$printnya
				));
			$i++;
        }
        header("Content-type: application/json");
        echo json_encode($json);
	}
    
	public function do_cek(){
		extract($_POST); 
		$val = $this->pm->get_byId($id); 
		
		echo trim($val['nama_strata']).'|'.trim($val['nama_strata2']).'|'.trim($val['level']);
	}
	
	public function do_save()
	{
		extract($_POST); 
		$status = 'error';
		 $data = array(
            'nama_strata'=>$nama_strata,
            'nama_strata2'=>$nama_strata2,
            'level'=>$level
        );
        if($id){
            $where=array(
                'id_strata'=>$id
            );
            $data['updated_date'] = date("Y-m-d");
            $data['updated_by']=$this->sessionuser;
            $do_ = $this->pm->updatePendidikan($where,$data);
        }else{
            $data['created_date'] = date("Y-m-d");
            $data['created_by']=$this->sessionuser;
            $do_ = $this->pm->insertPendidikan($data);
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
		$where=array(
            'id_strata'=>$id
        );
		$do_ = $this->pm->setDelete($where);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
}