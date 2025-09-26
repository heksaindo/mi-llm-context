<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Urutkepangkatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('urutkepangkatan_model');
		$this->load->helper('general_helper');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	/*
	public function index($page=1)
	{	
		$this->load->helper('url');
		$this->load->library('pagination');
        $this->load->library('paginationlib');
		$search = '';
		extract($_POST); 
		//print_r($_POST);
		if($_POST){
			$search = $_POST;
		}
		$this->data['title'] = 'Urut Kepangkatatan';
		
		//searching
		$this->data['data_organisasi_kerja'] = $this->urutkepangkatan_model->ddl_organisasi();		
		
		//Pagging data
		$pagingConfig   = $this->paginationlib->initPagination("urutkepangkatan/index", $this->urutkepangkatan_model->get_total_urutkepangkatan());
		$this->data["pagination_helper"]   = $this->pagination->create_links();
		$this->data["data_pegawai"] = $this->urutkepangkatan_model->get_urutkepangkatan((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'], $search); 
		
		if($page != ''){
			$this->data['add_no'] = $pagingConfig['per_page'] * ($page - 1);
		}else{
			$this->data['add_no'] = '';
		}
		$this->load->view('duk/duk', $this->data);
	}
	*/
	public function index()
	{	
		$this->data['title'] = 'Daftar Urut Kepangkatan';
		//searching
		$this->data['data_organisasi_kerja'] = $this->urutkepangkatan_model->ddl_organisasi();		
		
		$this->load->view('duk/duk', $this->data);
	}

	function ajax_duk()
    {
		extract($_GET); //print_r($_GET);
		$search = array();
		$search['src_organisasi_kerja'] = '';
		$search['src_satuan_kerja'] = '';
		$search['src_satuan_organisasi'] = '';
		$search['src_unit_organisasi'] = '';
		$search['src_jabatan'] = '';
		$search['src_struktural'] = '';
		$search['src_fungsional'] = '';
		$search['src_fungsional_tertentu'] = '';
		$search['src_fungsional_umum'] = '';
		
		if($_GET){
			//By Organisasi
			$search['src_organisasi_kerja'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_organisasi_kerja);
			$search['src_satuan_kerja'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_satuan_kerja);
			$search['src_satuan_organisasi'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_satuan_organisasi);
			$search['src_unit_organisasi'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_unit_organisasi);
			
			//By Jabatan
			$search['src_jabatan'] = $src_jabatan;
			$search['src_struktural'] = $src_struktural;
			$search['src_fungsional'] = $src_fungsional;
			$search['src_fungsional_tertentu'] = $src_fungsional_tertentu;
			$search['src_fungsional_umum'] = $src_fungsional_umum;
		}
        $result = $this->urutkepangkatan_model->get_urutkepangkatan($search);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;

		if($result){
			foreach($result as $row)
			{
				$pegawai_id = $row['id'];
				
				$dt_masuk = array();
				if($row['tgl_masuk_unit'] != '' || $row['tgl_masuk_unit'] != '0000-00-00'){
					$dt_masuk = datediff($row['tgl_masuk_unit'], date('Y-m-d H:i:s'));
				}else{
					$dt_masuk['years'] = '';
					$dt_masuk['months'] = '';
				}
				$masa_kerja_bulan = '';
				if($row['masa_kerja_bulan'] != ''){	
					$masa_kerja_bulan = $row['masa_kerja_bulan'].' bln';
				}
				
				$masa_kerja_tahun = '';
				if($row['masa_kerja_tahun'] != ''){	
					$masa_kerja_tahun = $row['masa_kerja_tahun'].' thn';
				}
				
				//$printnya = '<li><a onclick="window.open(\''.base_url().'urutkepangkatan/cetak_item/'.$row['nip_baru'].'\', \' \', \'scrollbars=1,height=800, width=700\')" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>';
				
				
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail Pegawai" >'.$row['nama'].'</a><br>'.$row['nip_baru'],
					$row['gol_terakhir'],
					$row['tmt_gol_terakhir'],
					$row['nama_jabatan'],
					$row['tmt_jabatan'],
					$dt_masuk['years'].' thn',
					$dt_masuk['months'].' bln',					
					$row['eselon'],
					$row['tmt_cpns'],
					$masa_kerja_tahun,
					$masa_kerja_bulan
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function get_satuankerja()
	{
		extract($_POST); 
		$msg = '';
		$new_data = $this->urutkepangkatan_model->ddl_satuankerja($src_organisasi_kerja); 
		if($new_data){
			$msg .= '<select id="src_satuan_kerja" name="src_satuan_kerja" onchange="satuankerja_onChange();" class="input-xlarge">
					<option value=""> </option>
					';																								
					foreach($new_data as $row){
						$msg .= "<option value='".$row->id_unit_kerja."'>".$row->nama_unit_kerja."</option>";
					}
			$msg .= '</select>';
			
		}
		echo $msg;
	}
	
	public function get_satuanorganisasi()
	{
		extract($_POST); 
		$msg = '';
		$new_data = $this->urutkepangkatan_model->ddl_satuanorganisasi($src_satuan_kerja); 
		if($new_data){
			$msg .= '<select id="src_satuan_organisasi" name="src_satuan_organisasi" onchange="satuanorganisasi_onChange();" class="input-xlarge">
					<option value=""> </option>
					';																								
					foreach($new_data as $row){
						$msg .= "<option value='".$row->id_unit_kerja."'>".$row->nama_unit_kerja."</option>";
					}
			$msg .= '</select>';
			
		}
		echo $msg;
	}
	
	public function get_unitorganisasi()
	{
		extract($_POST); 
		$msg = '';
		$new_data = $this->urutkepangkatan_model->ddl_unitorganisasi($src_satuan_organisasi); 
		if($new_data){
			$msg .= '<select id="src_unit_organisasi" name="src_unit_organisasi" class="input-xlarge">
					<option value=""> </option>
					';																								
					foreach($new_data as $row){
						$msg .= "<option value='".$row->id_unit_kerja."'>".$row->nama_unit_kerja."</option>";
					}
			$msg .= '</select>';
			
		}
		echo $msg;
	}
	
	public function cetak() 
	{
		extract($_GET); //print_r($_GET);
		$search = array();
		$search['src_organisasi_kerja'] = '';
		$search['src_satuan_kerja'] = '';
		$search['src_satuan_organisasi'] = '';
		$search['src_unit_organisasi'] = '';
		$search['src_jabatan'] = '';
		$search['src_struktural'] = '';
		$search['src_fungsional'] = '';
		$search['src_fungsional_tertentu'] = '';
		$search['src_fungsional_umum'] = '';
		
		if($_GET){
			//By Organisasi
			$search['src_organisasi_kerja'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_organisasi_kerja);
			$search['src_satuan_kerja'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_satuan_kerja);
			$search['src_satuan_organisasi'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_satuan_organisasi);
			$search['src_unit_organisasi'] = get_name('m_unit_kerja','kode_unit_kerja','id_unit_kerja', $src_unit_organisasi);
			
			//By Jabatan
			$search['src_jabatan'] = $src_jabatan;
			$search['src_struktural'] = $src_struktural;
			$search['src_fungsional'] = $src_fungsional;
			$search['src_fungsional_tertentu'] = $src_fungsional_tertentu;
			$search['src_fungsional_umum'] = $src_fungsional_umum;
		}
		
		$this->data['title'] = 'Print Daftar Urut Kepegawaian';
		$this->data['data_pegawai'] = $this->urutkepangkatan_model->get_urutkepangkatan($search);
		
		$this->load->view('duk/print_duk', $this->data);
	}
	
	public function cetak_item($nip_baru) 
	{
		$this->data['title'] = 'Print Daftar Urut Kepegawaian';
		$this->data['data_duk'] = $this->urutkepangkatan_model->get_duk($nip_baru);
		
		$this->load->view('duk/cetak_duk', $this->data);
	}
	
}