<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'laporan';
        //Model Engine Report
		$this->load->model('engine_report_model','engine');
        
        //Model Urut Kepangkatan
        $this->load->model('urutkepangkatan_model','urutpangkat');
        //Kenaikan Gaji Berkala
		$this->load->model('kgp_model');
		
		//Izin Belajar
		$this->load->model('Ibel_model');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
        $this->load->helper('general_helper');
		$username = $this->session->userdata('username');
		$this->prev = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $this->prev);
	}
	
	public function index()
	{	
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		$this->data['title'] = 'Report List';
		$this->data['data_report'] = $this->engine->get_report();
		$this->load->view('laporan/list_report', $this->data);
	}
    public function cek_report($id){
		
		$data_return = array(
			'status' => false,
			'data' => array()
		);
				
		if(!empty($id)){
			$data = $this->engine->get_byId($id);
			$data_return['status'] = true;
			$data_return['data'] = $data;
		}
		
		echo json_encode($data_return);
	}
	
	
	public function do_popup_report($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'report_name'	=> $report_name,
			'report_description'	=> $report_description,
			'report_header'	=> $report_header,
			'report_footer_left'	=> $report_footer_left,
			'report_footer_center'	=> $report_footer_center,
			'report_footer_right'	=> $report_footer_right
		);
			
		if(empty($id)){
			$do_ = $this->engine->insert_data($data);
		}else{
			$do_ = $this->engine->update_data($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_report($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->engine->delete_data($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function runningRpt($id = '')
	{
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		if(!empty($id)){
			$info_report = $this->engine->get_report($id);
			$this->data['info_report'] = $info_report;
			$this->data['data_report'] = $this->engine->running_report($info_report);
			$this->data['title'] = $info_report['report_name'];
		}else{
			$this->data['info_report'] = array();
			$this->data['data_report'] = array();
			$this->data['title'] = 'Report Not Found!';
		}
		
		$this->load->view('engine_report/running', $this->data);
	}
	
	public function running_cetak($id = '')
	{
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		
		if(!empty($id)){
			$info_report = $this->engine->get_report($id);
			$this->data['info_report'] = $info_report;
			$this->data['data_report'] = $this->engine->running_report($info_report);
			$this->data['title'] = $info_report['report_name'];
		}else{
			$this->data['info_report'] = array();
			$this->data['data_report'] = array();
			$this->data['title'] = 'Report Not Found!';
		}
		
		$this->load->view('engine_report/cetak_engine_report', $this->data);
	}
	
	public function settingRpt($id = '')
	{
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		$this->load->model('engine_report_master_group_model');
		$this->data['data_table_group'] = $this->engine_report_master_group_model->get_report();
		if(!empty($id)){
			$info_report = $this->engine->get_report($id);
			$this->data['info_report'] = $info_report;
			$this->data['data_setting'] = $this->engine->setting_report($info_report);
			$this->data['title'] = $info_report['report_name'];
		}else{
			$this->data['info_report'] = array();
			$this->data['data_setting'] = array();
			$this->data['title'] = 'Report Not Found!';
		}
		
		$this->load->view('engine_report/setting_report', $this->data);
	}
		
	public function cek_setting($id){
		
		$data_return = array(
			'status' => false,
			'data' => array()
		);
				
		if(!empty($id)){
			$data = $this->engine->get_setting($id);
			$data_return['status'] = true;
			$data_return['data'] = $data;
		}
		
		echo json_encode($data_return);
	}
		
	public function do_popup_setting($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$level_header = 0;
		if(!empty($parent_id)){
			$level_header = 1;
		}
		
		//get last order
		if(empty($rdd_order)){
			$this->db->select('rdd_order');
			$this->db->from('report_data_detail');
			$this->db->where('id_report', $id_report);
			$this->db->where('parent_id', $parent_id);
			$this->db->where('level_header', $level_header);
			
			if(!empty($id)){
				$this->db->where('id_rdd != '.$id);
			}
			
			$this->db->order_by('rdd_order', 'DESC');
			$get_last_order = $this->db->get();
			
			$rdd_order = 0;
			if($get_last_order->num_rows() > 0){
				$dt_last_rdd = $get_last_order->row_array();
				$rdd_order = $dt_last_rdd['rdd_order'] + 1;
			}
			
			
		}
		
		$data = array(
			'id_report'		=> $id_report,
			'header_name'	=> $header_name,
			'id_rtf'		=> $id_rtf,
			'parent_id'		=> $parent_id,
			'level_header'	=> $level_header,
			'output_format'	=> $output_format,
			'rdd_order'		=> $rdd_order
		);
			
		if(empty($id)){
			$do_ = $this->engine->insert_setting($data);
		}else{
			$do_ = $this->engine->update_setting($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function delete_setting($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->engine->delete_setting($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function get_field()
	{
		extract($_POST); 
		
		$data_ret = '<option value="">Pilih Data/Field</option>'."\n";
		if(!empty($id_rtg)){
			$get_field = $this->engine->get_rtg_field($id_rtg);
			if(!empty($get_field)){
				foreach($get_field as $dtF){
					$data_ret .= '<option value="'.$dtF['id_rtf'].'#'.$dtF['tf_name'].'">'.$dtF['tf_name'].' ('.$dtF['ref_field'].')</option>'."\n";
				}
			}
		}
		
		echo $data_ret;
	}

	public function get_setting_parent()
	{
		extract($_POST); 
		$id_curr = 0;
		if(!empty($id_rdd)){
			$id_curr = $id_rdd;
		}
		
		$data_ret = '<option value="">Root</option>'."\n";
		if(!empty($id_report)){
			$get_setting_parent = $this->engine->get_setting_parent($id_report, $id_curr);
			if(!empty($get_setting_parent)){
				foreach($get_setting_parent as $dtF){
					$data_ret .= '<option value="'.$dtF['id_rdd'].'">'.$dtF['header_name'].'</option>'."\n";
				}
			}
		}
		
		echo $data_ret;
	}
    
    
    //Daftar Urut Kepangkatan
    public function duk(){
        $this->data['login_state'] = $this->session->userdata('login_state');
		
		$this->data['title'] = 'Daftar Urut Kepangkatan';
		//searching
		$this->data['data_organisasi_kerja'] = $this->urutpangkat->ddl_organisasi();		
		
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
        $result = $this->urutpangkat->get_urutkepangkatan($search);
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
    public function get_satuankerjaduk()
	{
		extract($_POST); 
		$msg = '';
		$new_data = $this->urutpangkat->ddl_satuankerja($src_organisasi_kerja); 
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
	
	public function get_satuanorganisasiduk()
	{
		extract($_POST); 
		$msg = '';
		$new_data = $this->urutpangkat->ddl_satuanorganisasi($src_satuan_kerja); 
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
	
	public function get_unitorganisasiduk()
	{
		extract($_POST); 
		$msg = '';
		$new_data = $this->urutpangkat->ddl_unitorganisasi($src_satuan_organisasi); 
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
	
	public function cetakDuk() 
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
		$this->data['data_pegawai'] = $this->urutpangkat->get_urutkepangkatan($search);
		
		$this->load->view('duk/print_duk', $this->data);
	}
	
	public function cetak_item($nip_baru) 
	{
		$this->data['title'] = 'Print Daftar Urut Kepegawaian';
		$this->data['data_duk'] = $this->urutkepangkatan_model->get_duk($nip_baru);
		
		$this->load->view('duk/cetak_duk', $this->data);
	}
	
	
	/**
	 * Kenaikan Gaji Pegawai
	 **/
	public function kgp(){
		$this->data['title'] = 'List Histori Kenaikan Gaji Pegawai ';
		$this->load->view('kgp/histori_kgp', $this->data);
	}
	function ajax_histori_kgp()
    {
		
		$user_login = $this->session->userdata('user_id');
        $result = $this->kgp_model->get_histori_kgp();

		$json["aaData"] = array();
		
		$retval = array(
			//"iTotalRecords" => $iTotalRecords,
			//"iTotalDisplayRecords" => $iTotalRecords,
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$pegawai_id = $row['id_pegawai'];
				$printnya ='';
				if($this->prev=='Admin'){
					$printnya .= '<li><a href="'.base_url().'laporan/editKgp/'.$pegawai_id.'/'.$row['id'].'" class="tip" title="Edit entry"><i class="fam-application-edit"></i></a> </li>';
				}
				$printnya .= '<li><a onclick="window.open(\''.base_url().'laporan/cetakKgp/'.$row['id'].'\', \' \', \'scrollbars=1,height=800, width=700\')" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>';
				
	
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail Pegawai" >'.$row['nama'].'</a><br>'.$row['nip_baru'],
					$row['jabatan'],
					$row['pangkat'],
					$row['golongan'],
					$row['masa_kerja'],
					number_format_id($row['gapok_baru']),				
					$row['no_sk'],
					date('d-m-Y', strtotime($row['tanggal_sk'])),
					$row['pejabat_penetapan'],
					'<ul class="table-controls">'.$printnya.'</ul>'
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	public function editKgp($id_peg, $id)
	{
		$this->data['data_kgb'] = $this->kgp_model->getEditKgp($id);
		//$this->data['data_dokumen'] = $this->kgp_model->get_dokumen($id_peg);
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->data['title'] = 'Edit Kenaikan Gaji Pegawai';
		$this->load->view('kgp/edit_kgp', $this->data);
	}
	public function cetakKgp($id)
	{
		$this->data['title'] = 'Print Kenaikan Gaji Pegawai';
		$this->data['kgp'] = $this->kgp_model->getEditKgp($id);
		$this->load->view('kgp/cetak_kgp', $this->data);
	}
	
	/**
	 *Izin Belajar
	 */
	public function ibel(){
		$this->data['title'] = 'Rekap Izin Belajar';
		$this->data['data_group'] = $this->Ibel_model->getGroup();
		$this->load->view('ibel/rekap_ibel', $this->data);
	}
	
	public function ajax_ibel(){
		$result = $this->Ibel_model->get_ibel(1);
		
		$json["aaData"] = array();
		foreach($result as $row)
		{
			
			$action = "<span style=\"margin-left:30px;\" id=\"ibel_print_rekap\" onclick=\"javascript:printRekap('".$row->igroup."')\" class=\"tip act-btn fam-printer\" title=\"Print Rekap\"></span>";
			array_push($json["aaData"],array(
				$row->igroup,
				$row->isp,
				$row->isk,
				$action
				)
			);
		}
		header("Content-type: application/json");
        echo json_encode($json);
	}
	
	/**
	 *Kenaikan Pangkat
	 */
	public function kp(){
		$this->load->model('kp_model');
		$this->data['title'] = 'Rekap Kenaikan Pangkat';
		$this->data['data_pendidikan'] = $this->kp_model->data_pendidikan();
		$this->load->view('kp/histori_kp', $this->data);
	}
	
	public function editKp($pegawai_id, $id)
	{
		$this->load->model('kp_model');
		$this->data['id_kp'] = $id;
		$this->data['data_kp'] = $this->kp_model->get_kp($id);
		$this->data['data_pegawai'] = $this->kp_model->get_pegawai($pegawai_id);
		$this->data['data_dokumen'] = $this->kp_model->get_dokumen($pegawai_id);
		$this->data['data_golongan'] = $this->kp_model->ddl_golongan();
		$this->data['title'] = 'Edit Kenaikan Pangkat';
		$this->load->view('kp/edit_kp', $this->data);
	}
	
	/**
	 *Pensiun
	 **/
	
	public function pensiun(){
		extract($_POST); 
		$this->data['title'] = 'Rekap Pensiun';
		$this->load->view('pensiun/pensiun_histori', $this->data);
	}
	
	public function editPensiun($id_peg, $id)
	{
		$this->load->model('pensiun_model');
		$this->data['data_kp'] = $this->pensiun_model->get_pensiun($id);
		$this->data['data_pegawai'] = $this->pensiun_model->get_pensiun_forlist($id_peg);
		$this->data['data_dokumen'] = $this->pensiun_model->get_dokumen($id_peg);
		$this->data['data_jabatan_ttd'] = $this->pensiun_model->ddl_jabatan_ttd();
		
		$this->data['title'] = 'Edit Pensiun';
		$this->load->view('pensiun/edit_pensiun', $this->data);
	}
	
	/**
	 *Cuti
	 **/
	public function cuti(){
		$this->load->model('Cuti_model');
		$this->data['title'] = 'Rekap Cuti';
		$this->data['data_cuti'] = $this->Cuti_model->get_all('',true);
		//$this->data['data_cuti'] = $this->Cuti_model->get_cuti($this->session->userdata('user_id'));
		$this->load->view('cuti/rekap_cuti', $this->data);
	}
}