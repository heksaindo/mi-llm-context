<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->brand = 'INFO LAYANAN ADMINISTRASI KEPEGAWAIAN';
		$this->load->model('info_model','infomodel');
    }
    
	function _remap($method)
	{
		if(method_exists($this,$method)){
			call_user_func(array($this, $method));
			return false;
		}else{
			$data['title'] = 'Halaman Tidak Ditemukan - ';
			$data['halaman'] = '404';
			$this->view($data);
		}
	}
	
	public function view($param=array())
	{	
		$this->data['brand'] = $this->brand;
		$this->data['title'] = '';
		$this->data['halaman'] = '';
		$this->data['header'] = '';
		if(array_key_exists('header',$param)){
			$param['title'] = $param['header'].' - ';
		}
		$data = array_merge($this->data,$param);
        $this->load->view('info/index', $data);
    }
	
    public function index()
	{	
		$data['title'] = 'Selamat Datang - ';
		$data['halaman']='index';
		$data['header'] = ucfirst(strtolower($this->brand));
        $this->view($data);
    }
    
	/* Kenaikan Gaji Pegawai*/
    public function kgb(){
		$data['header'] = 'Kenaikan Gaji Pegawai';
		$data['halaman']='kgb';
        $this->view($data);
	}
    
	public function getKgb(){
		$data = array(
			'data'=>array()
		);
		$result = $this->infomodel->getKgb();
		$i=1;
		
		foreach($result->result() as $row){
			$kgb_terakhir ='';
			$kgb_selanjutnya='';
			if($row->tipe=='1'){
				$nama = '<span style="font-weight:bold;color:grey;">'.$row->gelar_depan.' '.$row->nama.' '.$row->gelar_belakang.'</span><br/>'.$row->nip_baru;
			}else{
				$nama = '<span style="font-weight:bold;color:red;">'.$row->gelar_depan.' '.$row->nama.' '.$row->gelar_belakang.'</span><br/>'.$row->nip_baru;
			}
			$tgl_sk = date("d-m-Y",strtotime($row->tanggal_sk));
			if($row->tmt_kgb_terakhir AND $row->tmt_kgb_terakhir !=='0000-00-00'){
				$kgb_terakhir = date("d-m-Y",strtotime($row->tmt_kgb_terakhir));
				$kgb_selanjutnya = date("d-m-Y",strtotime('+2 years',strtotime($row->tmt_kgb_terakhir)));
			}
			$dres = array(
				$i,
				$nama,
				$row->jabatan,
				$row->pangkat,
				$row->golongan,
				$row->masa_kerja,
				$row->no_sk,
				$tgl_sk,
				$kgb_terakhir,
				$kgb_selanjutnya
			);
			$data['data'][] = $dres;
			$i++;
		}
		die(json_encode($data));
	}
	
	/* Kenaikan Pangkat*/
	public function kp(){
		$data['header'] = 'Kenaikan Pangkat Pegawai';
		$data['halaman']='kp';
        $this->view($data);
	}
	
	/* Pensiun Data */
	public function pensiun(){
		$data['header'] = 'Pensiun Pegawai';
		$data['halaman']='pensiun';
        $this->view($data);
	}
	
	public function getPensiun(){
		$data = array(
			'data'=>array()
		);
		$result = $this->infomodel->getPensiun();
		$i=1;
		foreach($result->result() as $row){
			$curr = strtotime($row->tmt_pensiun);
			$dob = strtotime($row->tanggal_lahir);
			$age_years  =date('Y',$curr) - date('Y',$dob);
			$age_months = date('m',$curr) - date('m',$dob);
			$age_days = date('d',$curr) - date('d',$dob);
			
			if ($age_days<0) {
				$days_in_month = date('t',$curr);
				$age_months--;
				$age_days= $days_in_month+$age_days;
			}
			
			if ($age_months<0) {
				$age_years--;
				$age_months = 12+$age_months;
			}
			//$usia = $age_years.' Th '.$age_months.' Bln '.$age_days.' Hari';
			$usia = $age_years.' Tahun';
			$nama = '<span style="font-weight:bold;color:grey;">'.$row->gelar_depan.' '.$row->nama.' '.$row->gelar_belakang.'</span><br/>'.$row->nip;
			$dres = array(
				$i,
				$nama,
				$row->jabatan,
				$usia,
				$row->tmt_pensiun
			);
			$data['data'][] = $dres;
			$i++;
		}
		die(json_encode($data));
	}
	
	public function cuti(){
		$data['header'] = 'Cuti Pegawai';
		$data['halaman']='cuti';
        $this->view($data);
	}
	
	public function ibel(){
		$data['header'] = 'Izin Belajar Pegawai';
		$data['halaman']='ibel';
        $this->view($data);
	}
}