<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdministrasiPegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('user_model');
		$this->load->model('dashboard_model');
		$this->load->model('pensiun_model');
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
		$this->data['title'] = 'Administrasi Pegawai';
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
		
		$this->load->view('administrasipegawai', $this->data);
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
	
	public function dashboard_pergolongan(){
		$dashboard_pergolongan = $this->dashboard_model->dashboard_pergolongan();
		$golongan = array();
		$golongan2 = array();
		$n=0;
		if(!empty($dashboard_pergolongan['dataset'])){
			foreach($dashboard_pergolongan['dataset'] as $dt){
				foreach($dt as $dtt){
						$golongan[$dtt['golongan']][$dtt['kategori']]= $dtt['total'];
					}
				}
		}
		foreach($golongan as $k=>$v){
			$v['golongan']=$k;
			array_push($golongan2,$v);
		}
		die(json_encode($golongan2));
	}
	
	public function dashboard_jumlah_peg_unit()
	{	
		
		$dashboard_jumlah_peg_unit = $this->dashboard_model->dashboard_jumlah_peg_unit();
		$unit = array();
		$n=0;
		if(!empty($dashboard_jumlah_peg_unit)){
				foreach($dashboard_jumlah_peg_unit as $dt){
					$dt['cl'] = $this->getColor($n);
						array_push($unit,$dt);				
					$n++;
				}
		}
		die(json_encode($unit));
	}
	
	public function dashboard_total_pensiun(){
		//Query
		//$data = $this->db->get('pegawai')->result();
		$data = $this->pensiun_model->get_pensiun_forlist();
		
		$send = array();
		$output_bulan = array(
			'01' => "Jan",
			'02' => "Feb",
			'03' => "Mar",
			'04' => "Apr",
			'05' => "May",
			'06' => "Jun",
			'07' => "Jul",
			'08' => "Agu",
			'09' => "Sep",
			'10' => "Oct",
			'11' => "Nov",
			'12' => "Des"
		);
		$tgl = new DateTime(date('Y-m-d'));
		foreach($data as $d){
			$tgl_lahir = $d['tanggal_lahir'];
			
			$tgl1  = new DateTime($tgl_lahir);
			$usia = $tgl->diff($tgl1);
				//echo "difference " . $usia->y . " years, " . $usia->m." months, ".$usia->d." days ";
				
				//echo $tgl_lahir." - ".$usia;
				//echo "<br>";
			
			$tgl_pensiun  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+56));
				//echo $tgl_pensiun;
				//echo "<br>";
				//Jika eselon I & II = 60th
			if(!empty($row['eselon']) && ($row['eselon'] == 'I.a' || $row['eselon'] == 'I.b' || $row['eselon'] == 'II.a' || $row['eselon'] == 'II.b')){
				$tgl_pensiun  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+60));
			}
			
			// E-warning 7 bulan sebelum pensiun
			$tgl_ewars_mk = mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir)));
			$tgl_ewars_y = date("Y", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
			$tgl_ewars_md = date("d-m", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
			$tgl_ewars = $tgl_ewars_md.'-'.($tgl_ewars_y+55);
			$tgl_e = date("m-Y",strtotime($tgl_ewars));
			$today = date("Y-m-d");
			$today_mk = mktime(0, 0, 0, date("m",strtotime($today)),   date("d",strtotime($today)),   date("Y",strtotime($today)));
			
			// limit pensiun Warning -7 Bulan dari Tanggal Pensiun
			$limit = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($today))-7,   date("d",strtotime($today)),   date("Y",strtotime($today))));
			$limit_mk = mktime(0, 0, 0, date("m",strtotime($today))+7,   date("d",strtotime($today)),   date("Y",strtotime($today)));
				//echo $limit_mk;
				//echo "<br>";
				
			if($d['id'] == 0){
				if($tgl_pensiun >= $limit){
					
					//if(!empty($row['id'])){
					if($tgl_pensiun <= $today){
						$d['tgl_e'] = $tgl_e;
						$d['tgl_ewars'] = $tgl_ewars;
						$d['usia'] = $usia;
						$d['tgl_pensiun'] = $tgl_pensiun;
						if(!empty($d['gelar_belakang'])){
							$d['nama'] = $d['gelar_depan'].' '.ucwords(strtolower($d['nama'])).', '.$d['gelar_belakang'];
						}
						$d['nama'] = trim(ucwords(strtolower($d['nama'])));
						$send[] = $d;
					}
				
				}
				
			}
			$kirim = array();
			$tahun_awal = date("Y");
			$tahun = array(
				date("Y",strtotime("-3 year",strtotime($tahun_awal))),
				date("Y",strtotime("-2 year",strtotime($tahun_awal))),
				date("Y",strtotime("-1 year",strtotime($tahun_awal))),
				$tahun_awal
			);
			foreach($tahun as $t){
				$kirim[$t]['tahun']= $t;
				$i=0;
				foreach($output_bulan as $ko => $vo){
					$bln[$i] =$ko.'-'.$t;
					$kirim[$t][$vo] =0;
					foreach($send as $s){
						if($bln[$i]==$s['tgl_e']){
							$kirim[$t][$ko] = $kirim[$t][$vo]++;
						}
					}
					$i++;
					unset($kirim[$t][$ko]);
				}
			}
		}
		
		$peg = array();
		foreach($kirim as $kk=>$vk){
			array_push($peg,$vk);
		}
		die(json_encode($peg));
	}
	
}