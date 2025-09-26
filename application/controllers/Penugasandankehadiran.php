<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penugasandankehadiran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'penugasandankehadiran';
		$this->load->model('user_model');
		$this->load->model('dashboard_model');
		$this->load->helper('general_helper');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('user_id');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Penugasan dan Kehadiran';
		$username = $this->session->userdata('username');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this_year = date('Y');
		
		$this->load->model('dashboard_model');
		$this->data['total_pns'] = $this->dashboard_model->data_total_pns();
		$this->data['total_cpns'] = $this->dashboard_model->data_total_cpns();
		
		$total_cuti_tahun_ini = $this->dashboard_model->data_total_cuti_tahun_ini($this_year);
		$total_cuti_tahun_sebelumnya = $this->dashboard_model->data_sisa_cuti_tahun_sebelumnya($username, $this_year);
		$this->data['total_cuti'] = $total_cuti_tahun_ini + $total_cuti_tahun_sebelumnya;
		$this->data['cuti_dipakai'] = $this->dashboard_model->data_cuti_dipakai($username);
		
		$this->load->view('penugasandankehadiran', $this->data);
	}
	
	function getColor($n){
			$color = array(
						   /*green*/'#07DB04',
						   /*red*/'#FF0E0A',
						   /*blue*/'#1006CC',
						   /*blue fb*/'#047BEA',
						   /*yellow*/'#E3F70E',
						   /*dark yellow*/'#BBC417',
						   /*pink*/'#F711EB',
						   /*darkPink*/'#AD08A5',
						   /*orange*/'#FFBA19',
						   /*darkOrange*/'#C18907',
						   /*lightSea*/'#4FFFEA',
						   /*lightGreen*/'#7FFFC5');
			return $color[$n];
	}
	
	public function dashboard_cuti_pegawai()
	{	
		
		
		//header("Content-type: text/xml");
		
		//get dashboard_cuti_pegawai
		$dashboard_cuti_pegawai = $this->dashboard_model->dashboard_cuti_pegawai_detail();
		$data = array();
		$n = 0;
		//<chart palette='3' yAxisMinValue='10' showValues='0' labelDisplay='Rotate' slantLabels='1'>
			if(!empty($dashboard_cuti_pegawai)){
				foreach($dashboard_cuti_pegawai as $dt){
					array_push($data,$dt);
					//echo '<set label="'.$dt['nama'].'" value="'.$dt['total'].'" />';
				}
			}
		$hasil = array();
		foreach($data as $k => $v){
			$hasil[0]['nama'] = 'Approve';
			$hasil[1]['nama'] = 'Submit';
			$hasil[0][$v['nama']] = $v['approve'];
			$hasil[1][$v['nama']] = $v['submit'];
		}

		die(json_encode($hasil));
		
	}
	
}