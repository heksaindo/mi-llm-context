<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_gapok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('gapok_model');
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
		
		$this->data['title'] = 'Master Gaji Pokok';
		$this->data['data_golongan'] = $this->gapok_model->ddl_golongan();
		//$this->data['data_gapok'] = $this->gapok_model->get_all();
		$this->load->view('masters/master_gapok', $this->data);
	}
	
	function ajax_gapok()
    {
        $result = $this->gapok_model->get_all();
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;

		if($result){
			foreach($result as $row)
			{

				$edit_delete = '<span id="edit-rkepangkatan" onclick="javascript:onEdit_gapok(\''.$row['id_gapok'].'\',\'\')" class="fam-application-edit"></span>
					<span id="delete-rkepangkatan" onclick="javascript:onDelete_gapok(\''.$row['id_gapok'].'\',\'\')" class="fam-application-delete"></span>';
				
				array_push($json["aaData"],array(
					$i,
					$row['nama_golongan'],
					$row['kdkelgapok'],
					$row['kdgapok'],
					number_format_id($row['gapok']),
					$row['daper'],
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	
	public function cek_gapok($id){
		
		$val = $this->gapok_model->get_byId($id); 
		
		echo trim($val['nama_golongan']).'|'.trim($val['kdkelgapok']).'|'.trim($val['kdgapok']).'|'.trim($val['gapok']).'|'.trim($val['daper']);
	}
	
	
	public function do_popup_gapok($id = '')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		if(!$daper){
			$daper = '';
		}
		$data = array(
			'kdkelgapok'	=> $kdkelgapok,
			'kdgapok'		=> $kdgapok,
			'gapok'			=> $gapok,
			'daper'			=> $daper
		);
			
		//cek data
		$val = $this->gapok_model->cek_gapok($id); 
		
		if($val == 0){
			$do_ = $this->gapok_model->insert_data($data);
		}else{
			$do_ = $this->gapok_model->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_gapok($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->gapok_model->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	function do_migrasi_gapok()
	{
		$status = 'error';
		$user_input = $this->session->userdata('username');
		$file =  APP_PATH."/Uploads/excel/" ;
		
		//print_r($_POST);die();
		
		$config['upload_path'] = $file;
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '10000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			echo $error['error'];
		}	
		else
		{
			$upload_data = $this->upload->data();
			
			echo "<h3>Your file was successfully uploaded!</h3>" ;
			/*
			echo "<ul>" ;
			foreach($upload_data as $item => $value) {
				echo '<li>',$item,' : ',$value,'</li>';
			}
			echo "</ul>" ;
			*/
			echo "<p>== Data read file excel ==================================== //</p>" ;

			// Load the spreadsheet reader library
			$this->load->library('excel_reader');

			// Set output Encoding.
			$this->excel_reader->setOutputEncoding('CP1251');

			$file =  $file.$upload_data['file_name'] ;

			$this->excel_reader->read($file);

			error_reporting(0);

			// Sheet 1
			$data = $this->excel_reader->sheets[0] ;
				echo '<pre>';
				//print_r($data['cells']);die();
				
			$no=1;
			for($i=2; $i<=528; $i++) {
				$kdkelgapok = $data['cells'][$i][1];
				$kdgapok = $data['cells'][$i][2];
				$gapok = $data['cells'][$i][3];
				
				if($kdgapok < 10){
					$kdgapok = '0'.$kdgapok;
				}
				
				//Cek Pegwai
				$data_gp = array(
						'kdkelgapok'	=> $kdkelgapok,
						'kdgapok'		=> $kdgapok,
						'gapok'			=> $gapok
				);
					
				//cek data
				$val = $this->gapok_model->cek_gapok($kdgapok, $kdkelgapok); 
				
				if($val == 0){
					$this->gapok_model->insert_data($data_gp);
					
					echo $no.'. Golongan: '.$kdkelgapok.' MKG: '.$kdgapok.' GAPOK: '.$gapok.'<br>';		
				}else{
					$this->gapok_model->update_data($data_gp, $kdgapok, $kdkelgapok);
					
					echo $no.'. Golongan: '.$kdkelgapok.' MKG: '.$kdgapok.' GAPOK: '.$gapok.'<br>';		
				}
				
				$no++;
			}			
			
		}
		echo '== Success ==<br>';
		echo '<a href="'.base_url().'master_gapok">Kembali ke Master Gapok</a>';
	}
	
}

/* End of file master_gapok.php */
/* Location: ./application/controllers/master_gapok.php */