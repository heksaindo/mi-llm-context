<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'home';
		$this->load->model('user_model');
		$this->load->helper('general_helper');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$username = $this->session->userdata('email_user');
		$previlege = $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}

	public function index()
	{	
		$this->data['title'] = 'Home';
		$username = $this->session->userdata('pegawai_id');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this_year = date('Y');
		
		$this->load->model('dashboard_model');
		$this->data['total_pns'] = $this->dashboard_model->data_total_pns();
		$this->data['total_cpns'] = $this->dashboard_model->data_total_cpns();
		
		$total_cuti_tahun_ini = $this->dashboard_model->data_total_cuti_tahun_ini($this_year);
		$total_cuti_tahun_sebelumnya = $this->dashboard_model->data_sisa_cuti_tahun_sebelumnya($username, $this_year);
		$this->data['total_cuti'] = $total_cuti_tahun_ini + $total_cuti_tahun_sebelumnya;
		$this->data['cuti_dipakai'] = $this->dashboard_model->data_cuti_dipakai($username);
		
		$this->load->view('home', $this->data);
	}
	
	public function setting()
	{
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['title'] = 'Setting';
		$username = $this->session->userdata('pegawai_id');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this->data['username'] = $this->session->userdata('pegawai_id');
		$this->data['nama_user'] = $this->session->userdata('nama');
		
		
		$this->load->view('setting', $this->data);
	}
	
	public function do_edit_setting()
	{
		extract($_POST); 
		$status = 'error';
		$user_input = $this->session->userdata('username');

		$data['nama'] = $nama;
		if(!empty($new_password)){
			$data['password'] = '';
			$data['passwordmd5'] = md5($new_password);
		}
		$do_update = $this->user_model->update_setting($data, $username);
	
		if($do_update){			
			$status = 'success#'.$nama;	
		}
		
		echo $status;
	}
	
	public function upload_foto()
	{
		$status = "";
		$msg = "";
		$fileElementName = 'fileFoto';
		if(!empty($_FILES[$fileElementName]['error']))
		{
			switch($_FILES[$fileElementName]['error'])
			{

				case '1':
					$status = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
					break;
				case '2':
					$status = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
					break;
				case '3':
					$status = 'The uploaded file was only partially uploaded';
					break;
				case '4':
					$status = 'No file was uploaded.';
					break;

				case '6':
					$status = 'Missing a temporary folder';
					break;
				case '7':
					$error = 'Failed to write file to disk';
					break;
				case '8':
					$status = 'File upload stopped by extension';
					break;
				case '999':
				default:
					$status = 'No error code avaiable';
			}
		}elseif(empty($_FILES['fileFoto']['tmp_name']) || $_FILES['fileFoto']['tmp_name'] == 'none')
		{
			$status = 'No file was uploaded..';
		}else 
		{
				$nameFoto =  $_FILES['fileFoto']['name'];
				//$msg .= " File Size: " . @filesize($_FILES['fileFoto']['tmp_name']);
				
				$config['upload_path'] = APP_PATH.'Uploads/foto/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = 1024 * 8;
				$config['file_name'] = $nameFoto;
				$config['encrypt_name'] = False;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload($fileElementName))
				{
					$status = 'error';
					$msg = $this->upload->display_errors('', '');
				}
				else
				{
					$data = $this->upload->data();
					
					
					//echo APP_PATH.'Uploads/foto/' . $nameFoto;
					//If you want to resize 
					$config['new_image'] = APP_URL.'Uploads/foto/thumbs/';
					$config['image_library'] = 'gd2';
					$config['source_image'] = APP_URL.'Uploads/foto/' . $nameFoto;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 140;
					$config['height'] = 160;

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$data = $this->upload->data();
					//$data = array('upload_data' => $this->upload->data());
					
					//print_r($data);die();
					$file_id = false;

					if(!empty($_POST['nip'])){
						$file_id = $this->user_model->update_foto_bynip($_POST['nip'], $data);
					}
					
					
					if($file_id)
					{
						$status = "success";
						$msg = "File successfully uploaded";
					}
					else
					{
						unlink($data['full_path']);
						$status = "error";
						$msg = "Something went wrong when saving the file, please try again.";
					}
				}
				@unlink($_FILES[$file_element_name]);
				

		}		
		echo "{";
		echo				"error: '" . $status . "',\n";
		echo				"file: '" . $nameFoto . "',\n";
		echo				"msg: '" . $msg . "'\n";
		echo "}";
	}
	
}