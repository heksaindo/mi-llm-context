<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('Pegawai_model', 'mPegawai');
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
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		$this->data['title'] = 'Pegawai';		
		//$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_all();

		$this->load->view('drh/pegawai', $this->data);
	}

	function ajax_pegawai()
    {
        $result = $this->mPegawai->get_pegawai_all();
		$datas = array();
		if($result)
		{
			foreach($result as $row)
			{
				//Initialisasi data
				
				$row['masa_kerja_tahun'] = $row['masa_kerja_tahun'].' thn';
				$row['masa_kerja_bulan'] = $row['masa_kerja_bulan'].' bln';
				$datas[] = $row;
			}	
		}		
			
		$json["aaData"] = array();
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		if($datas){
			foreach($datas as $row)
			{
				$pegawai_id = $row['id'];
				$tmt_jabatan = '';
				$tmt_kepangkatan = '';
				$mkt='';
				$mkb='';
				if(!empty($row['tmt_jabatan'])){
					$tmt_jabatan = date('d-m-Y',strtotime($row['tmt_jabatan']));
				}
				if(!empty($row['tmt_kepangkatan'])){
					$tmt_kepangkatan = date('d-m-Y',strtotime($row['tmt_kepangkatan']));
				}
				if(!empty($row['tmt_cpns'])){
					$mkt = $this->utility->dateDifference(date("Y-m-d"),date("Y-m-d",strtotime($row['tmt_cpns'])),'%y').' Thn';
					$mkb = $this->utility->dateDifference(date("Y-m-d"),date("Y-m-d",strtotime($row['tmt_cpns'])),'%m').' Bln';
				}
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail / Edit Pegawai" >'.$row['gelar_depan']." ".$row['nama']." ".$row['gelar_belakang'].'</a><br>'.
						'NIP Lama : '.$row['nip_lama'].'<br>NIP Baru : '.$row['nip_baru'],
					$row['eselon'],
					$row['golongan'],
					$tmt_kepangkatan,
					$row['nama_jabatan'],
					$tmt_jabatan,
					$mkt,
					$mkb,
					$row['jurusan'],
					$row['tahun_lulus'],
					$row['nama_strata2']
				));
				$i++;
			}
		}
		
        //header("Content-type: application/json");
        echo json_encode($json);
		//echo "<pre>";
		//print_r($json);
		//echo "</pre>";
    }
	
	function detail($pegawai_id='',$cpns = 'CPNS') 
	{	
		//Privilege
		$this->data['login_state'] = $this->session->userdata('login_state');
		$user_request = $this->session->userdata('pegawai_id');
		$this->data['user_request'] = $this->session->userdata('pegawai_id');
		$this->data['data_user'] = $this->mPegawai->get_pegawai_bynip($user_request);
		
		$this->data['title'] = 'Detail Pegawai';
		
		if(!empty($pegawai_id)){
			$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($pegawai_id);
			$this->data['hd_id'] = $pegawai_id;
			$this->data['hd_nip_baru'] = $this->data['data_pegawai']->nip_baru;
			$this->data['id_peg'] = $this->data['data_pegawai']->id;
			
			$id = $this->data['data_pegawai']->id;

			$this->data['data_kepegawaian'] = $this->mPegawai->get_pegawai_kepegawaian($pegawai_id);
			$this->data['data_tempatkerja'] = $this->mPegawai->get_pegawai_tempatkerja($pegawai_id);
			$this->data['data_jabatan'] = $this->mPegawai->get_pegawai_jabatan($pegawai_id);
			$this->data['tmt_kerja'] = $this->mPegawai->get_tmt_cpns($pegawai_id);
			$this->data['tmt_pns'] = $this->mPegawai->get_tmt_pns($pegawai_id);
			$this->data['data_sutri'] = $this->mPegawai->get_suami_istri($id);	
			
			$this->load->view('drh/detail_pegawai', $this->data);
		}else{
			$this->load->view('drh/detail_empty', $this->data);
		}
				
	}
	
	public function add($pegawai_id='')
	{		
		unset($_POST['DataTables_Table_0_length']);
		//Dropdown master 		
		
		$this->data['data_prov'] = $this->mPegawai->ddl_provinces();
		$this->data['data_city'] = $this->mPegawai->ddl_cities();
		$this->data['title'] = 'Tambah Pegawai';	
		
		$this->load->view('drh/add_pegawai', $this->data);
	}
	
	public function edit($pegawai_id)
	{		
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($pegawai_id);
		$this->data['hd_id'] = $pegawai_id;
		$this->data['hd_nip_baru'] = $this->data['data_pegawai']->nip_baru;
		$this->data['id_peg'] = $this->data['data_pegawai']->id;
		$nip = $this->data['data_pegawai']->nip_baru;
		$id = $this->data['data_pegawai']->id;

		$this->data['data_kepegawaian'] = $this->mPegawai->get_pegawai_kepegawaian($pegawai_id);
		$this->data['data_tempatkerja'] = $this->mPegawai->get_pegawai_tempatkerja($pegawai_id);
		$this->data['tmt_kerja'] = $this->mPegawai->get_tmt_cpns($pegawai_id);
		$this->data['tmt_pns'] = $this->mPegawai->get_tmt_pns($pegawai_id);
		$this->data['data_sutri'] = $this->mPegawai->get_suami_istri($id);	
		$this->data['data_detail_jabatan'] = $this->mPegawai->get_pegawai_jabatan($pegawai_id);
		//Dropdown master
		$this->data['data_statusperkawinan'] = $this->mPegawai->ddl_parameter('statusperkawinan');
		$this->data['data_agama'] = $this->mPegawai->ddl_parameter('agama');
		$this->data['data_status_gaji'] = $this->mPegawai->ddl_parameter('status_gaji');
		$this->data['data_lokasi_gaji'] = $this->mPegawai->ddl_parameter('lokasi_gaji');
		$this->data['data_golongan'] = $this->mPegawai->ddl_golongan();
		$this->data['db_jkp'] = $this->db->get('m_jenis_kepegawaian');
		$this->data['data_prov'] = $this->mPegawai->ddl_provinces();
		$this->data['data_city'] = $this->mPegawai->ddl_cities();
		$this->data['data_organisasi_kerja'] = $this->mPegawai->ddl_organisasi_kerja();		
		$this->data['data_satuan_kerja'] = $this->mPegawai->ddl_satuan_kerja();
		$this->data['data_satuan_organisasi'] = $this->mPegawai->ddl_satuan_organisasi();
		$this->data['data_unit_organisasi'] = $this->mPegawai->ddl_unit_organisasi();
		$this->data['data_unit_kerja'] = $this->mPegawai->ddl_unit_kerja();	
		$this->data['data_strata'] = $this->mPegawai->ddl_strata_pendidikan();
		$this->data['data_pelatihan'] = $this->mPegawai->ddl_pelatihan_jabatan();
		$this->data['data_eselon'] = $this->mPegawai->ddl_eselon();			
		$this->data['data_tipe_dokumen'] = $this->mPegawai->get_tipe_dokumen();		
		$this->data['data_status_jabatan'] = $this->mPegawai->ddl_status_jabatan();			
		$this->data['data_jabatan'] = $this->mPegawai->ddl_jabatan();		
		$this->data['data_penghargaan'] = $this->mPegawai->ddl_penghargaan();		
		
		$this->data['data_jenis_kepegawaian'] = $this->mPegawai->get_masters('jenis_kepegawaian');
		$this->data['data_kategori_dik'] = $this->mPegawai->get_masters('kategori_pendidikan');	
		$this->data['data_kategori_diklat'] = $this->mPegawai->get_masters('kategori_diklat');	
		$this->data['title'] = 'Edit Pegawai';		
		
		$this->load->view('drh/edit_pegawai', $this->data);
	}
	
	public function do_add_wizard1()
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		
		$data_pegawai = array(
			'nip_lama' => $nip_lama,
			'nip_baru' => $nip_baru, 
			'no_kartu' => strtoupper($no_kartu),
			'nama' => strtoupper($nama),
			'gelar_depan' => $gelar_depan,
			'gelar_belakang' => $gelar_belakang,
			'jenis_kelamin' => $jenis_kelamin,
			'tempat_lahir' => strtoupper($tempat_lahir),
			'tanggal_lahir' => date('Y-m-d',strtotime($tanggal_lahir)),
			'agama' => $agama,
			'status_perkawinan' => $status_perkawinan,
			'alamat' => strtoupper($alamat),
			'rt' => $rt,
			'rw' => $rw,
			'kelurahan' => strtoupper($kelurahan),
			'kecamatan' => strtoupper($kecamatan),
			'kabupaten' => strtoupper($kabupaten),
			'propinsi' => strtoupper($s_propinsi),
			'kodepos' => $kodepos,
			'telp' => $telp,
			'status_kpe' => $status_kpe,
			//'foto' => $foto,
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $user_input,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input

		);
			
		$do_insert = $this->mPegawai->insert_pegawai($nip_baru, $data_pegawai);
			
		if($do_insert){
			$id_pegawai = $do_insert;
			
			$data_pegawai_sub = array(
				'id_pegawai' => $id_pegawai
			);
			$this->mPegawai->cek_kepegawaian($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_jabatan($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_kepangkatan($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_pendidikan($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_tempatkerja($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_suami_istri($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_anak($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_diklat_jabatan($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_diklat_teknis($id_pegawai, $data_pegawai_sub);
			
			$status = 'success';
			$do = 'insert';
		}
		
		$lbl_nip_lama = strtoupper($nip_lama);
		$lbl_nip_baru = strtoupper($nip_baru);
		$lbl_nama = strtoupper($nama);
		
		echo $status."#".$do."#".$lbl_nip_lama."#".$lbl_nip_baru."#".$lbl_nama."#".$id_pegawai;
	}
	
	public function do_edit_wizard1($id)
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		
		$data_pegawai = array(
			'nip_lama' => strtoupper($nip_lama),
			'nip_baru' => strtoupper($nip_baru), 
			'no_kartu' => strtoupper($no_kartu),
			'nama' => strtoupper($nama),
			'gelar_depan' => $gelar_depan,
			'gelar_belakang' => $gelar_belakang,
			'jenis_kelamin' => $jenis_kelamin,
			'tempat_lahir' => strtoupper($tempat_lahir),
			'tanggal_lahir' => date('Y-m-d',strtotime($tanggal_lahir)),
			'agama' => $agama,
			'status_perkawinan' => $status_perkawinan,
			'alamat' => strtoupper($alamat),
			'rt' => $rt,
			'rw' => $rw,
			'kelurahan' => strtoupper($kelurahan),
			'kecamatan' => strtoupper($kecamatan),
			'kabupaten' => strtoupper($kabupaten),
			'propinsi' => strtoupper($s_propinsi),
			'kodepos' => $kodepos,
			'telp' => $telp,
			'status_kpe' => $status_kpe,
			//'foto' => $foto,
			//'created_date' => date('Y-m-d H:i:s'),
			//'created_by' => $user_input,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input

		);
		
		$do_update = $this->mPegawai->update_pegawai($id, $data_pegawai);
			
		if($do_update){
			
			$data_pegawai_sub = array(
				'id_pegawai' => $id/*,
				'nama' => strtoupper($nama),
				'nip_lama' => $nip_lama,
				'nip_baru' => $nip_baru*/
			);
			$this->mPegawai->cek_kepegawaian($id, $data_pegawai_sub);
			$this->mPegawai->cek_jabatan($id, $data_pegawai_sub);
			$this->mPegawai->cek_kepangkatan($id, $data_pegawai_sub);
			$this->mPegawai->cek_pendidikan($id, $data_pegawai_sub);
			$this->mPegawai->cek_tempatkerja($id, $data_pegawai_sub);
			$this->mPegawai->cek_suami_istri($id, $data_pegawai_sub);
			$this->mPegawai->cek_anak($id, $data_pegawai_sub);
			$this->mPegawai->cek_diklat_jabatan($id, $data_pegawai_sub);
			$this->mPegawai->cek_diklat_teknis($id, $data_pegawai_sub);
			
			if($nip_baru_before != $nip_baru)
			{
				$data_sub = array(
					'nip_baru' => $nip_baru
				);
				
				$this->mPegawai->update_nip_baru_riwayat($nip_baru_before, $data_sub);
				
			}
			
			$status = 'success';
			$do = 'update';
		}
		
		$lbl_nip_lama = strtoupper($nip_lama);
		$lbl_nip_baru = strtoupper($nip_baru);
		$lbl_nama = strtoupper($nama);
		
		echo $status."#".$do."#".$lbl_nip_lama."#".$lbl_nip_baru."#".$lbl_nama;
	}
	
	public function do_edit_wizard2($id)
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		
		$masa_kerja_keseluruhan = '';
		if(!empty($mkk_tahun)){
			$masa_kerja_keseluruhan = $mkk_tahun.' Thn '.$mkk_bulan.' Bln';
		}
		$masa_kerja_tambahan = '';
		if(!empty($mkt_tahun)){
			$masa_kerja_tambahan = $mkt_tahun.' Thn '.$mkt_bulan.' Bln';
		}
		$masa_kerja_golongan = '';
		if(!empty($masa_kerja_tahun)){
			$masa_kerja_golongan = $masa_kerja_tahun.' Thn '.$masa_kerja_bulan.' Bln';
		}
		
		$data_pegawai = array(
			'jenis_kepegawaian' => $jenis_kepegawaian,
			//'masa_kerja_keseluruhan' => $masa_kerja_keseluruhan,
			//'mkk_tahun' => $mkk_tahun,
			//'mkk_bulan' => $mkk_bulan,
			//'masa_kerja_tambahan' => $masa_kerja_tambahan,
			'mkt_tahun' => $mkt_tahun,
			'mkt_bulan' => $mkt_bulan,
			//'masa_kerja_golongan' => $masa_kerja_golongan,
			'masa_kerja_tahun' => $masa_kerja_tahun,
			'masa_kerja_bulan' => $masa_kerja_bulan,
			'status_gaji' => $status_gaji,
			'lokasi_gaji' => $lokasi_gaji,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input

		);
		
		$do_update = $this->mPegawai->update_kepegawaian($id, $data_pegawai);
			
		if($do_update){
			$status = 'success';
			$do = 'update';
		}
		
		$lbl_nip_lama = strtoupper($hd_nip_lama2);
		$lbl_nip_baru = strtoupper($hd_nip_baru2);
		$lbl_nama = strtoupper($hd_nama2);
		
		echo $status."#".$do."#".$lbl_nip_lama."#".$lbl_nip_baru."#".$lbl_nama;
	}
	
	public function do_edit_wizard3($id)
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do = '';
		$kode_unit_kerja = '';
		$user_input = $this->session->userdata('user_id');

		if(!empty($organisasi_kerja)){
			$kode_unit_kerja = $organisasi_kerja;
		}
		if(!empty($satuan_kerja)){
			$kode_unit_kerja = $satuan_kerja;
		}
		if(!empty($satuan_organisasi)){
			$kode_unit_kerja = $satuan_organisasi;
		}
		if(!empty($unit_organisasi)){
			$kode_unit_kerja = $unit_organisasi;
		}
		if(!empty($unit_kerja)){
			$kode_unit_kerja = $unit_kerja;
		}
		
		$data_pegawai = array(
			'tanggal_tugas' => date('Y-m-d',strtotime($tanggal_tugas)),
			'tmt_jabatan' => date('Y-m-d',strtotime($tmt_jabatan)),
			'instansi' => $instansi,
			'organisasi_kerja' => $organisasi_kerja,
			'satuan_kerja' => $satuan_kerja,
			'satuan_organisasi' => $satuan_organisasi,
			'unit_organisasi' => $unit_organisasi,
			'unit_kerja' => $unit_kerja,
			'kode_unit_kerja' => $kode_unit_kerja,
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $user_input,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input

		);
		
		$do_update = $this->mPegawai->update_tempatkerja($id, $data_pegawai);
			
		if($do_update){
			$status = 'success';
			$do = 'update';
		}
		
		$lbl_nip_lama = strtoupper($hd_nip_lama3);
		$lbl_nip_baru = strtoupper($hd_nip_baru3);
		$lbl_nama = strtoupper($hd_nama3);
		
		echo $status."#".$do."#".$lbl_nip_lama."#".$lbl_nip_baru."#".$lbl_nama;
	}
	
	public function do_edit_wizard11($id)
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		
		$data_pegawai = array(
			'status_menikah' => $status_menikah,
			'no_karis' => $no_karis,
			'nama_suami_istri' => $nama_suami_istri,
			'tgl_lahir' => date('Y-m-d',strtotime($tgl_lahir)),
			'tgl_nikah' => date('Y-m-d',strtotime($tgl_nikah)),
			'pekerjaan' => $pekerjaan,
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $user_input,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input

		);
		
		$do_update = $this->mPegawai->update_suami_istri($id, $data_pegawai);
			
		if($do_update){
			$status = 'success';
			$do = 'update';
		}
		
		$lbl_nip_lama = strtoupper($hd_nip_lama11);
		$lbl_nip_baru = strtoupper($hd_nip_baru11);
		$lbl_nama = strtoupper($hd_nama11);
		
		echo $status."#".$do."#".$lbl_nip_lama."#".$lbl_nip_baru."#".$lbl_nama;
	}
	
	function change_prov()
	{
		extract($_POST); 
		$data = "";
		if($prov_id){
			$new_city = $this->mPegawai->ddl_cities($prov_id); 

			$data = '<select id="'.$kab.'" name="'.$kab.'" class="input-medium">
					<option value=""> </option>
					';		
					if($new_city){
						foreach($new_city as $row){
							$selected = '';	
							//if($data_pegawai->kabupaten == $row->city_id){
							//	$selected =  'selected = "selected"'; 
							//}
							$data .= "<option value='".$row->city_id."' ".$selected.">".strtoupper($row->city_name)."</option>";
						}
					}
			$data .= '</select>';
		}
		echo $data;
	}
	
	function change_organisasi_kerja()
	{
		extract($_POST); 
		$data = "";
		if($organisasi_kerja3){
			$new_array = $this->mPegawai->ddl_organisasi_kerja($organisasi_kerja3); 
			
			$data = '<select id="satuan_kerja3" name="satuan_kerja3" class="input-xlarge" onchange="change_satuan_kerja3()">
					<option value=""> </option>
					';		
					if($new_array){
						foreach($new_array as $row){
							$data .= "<option value='".$row->kode_unit_kerja."'>".$row->nama_unit_kerja."</option>";
						}
					}
			$data .= '</select>';
		}
		echo $data;
	}
	function change_satuan_kerja()
	{
		extract($_POST); 
		$data = "";
		if($satuan_kerja3){
			$new_array = $this->mPegawai->ddl_satuan_kerja($satuan_kerja3); 
			
			$data = '<select id="satuan_organisasi3" name="satuan_organisasi3" class="input-xlarge" onchange="change_satuan_organisasi3()">
					<option value=""> </option>
					';		
					if($new_array){
						foreach($new_array as $row){
							$data .= "<option value='".$row->kode_unit_kerja."'>".$row->nama_unit_kerja."</option>";
						}
					}
			$data .= '</select>';
		}
		echo $data;
	}
	function change_satuan_organisasi()
	{
		extract($_POST); 
		$data = "";
		if($satuan_organisasi3){
			$new_array = $this->mPegawai->ddl_satuan_organisasi($satuan_organisasi3); 
			
			$data = '<select id="unit_organisasi3" name="unit_organisasi3" class="input-xlarge" onchange="change_unit_organisasi3()">
					<option value=""> </option>
					';		
					if($new_array){
						foreach($new_array as $row){
							$data .= "<option value='".$row->kode_unit_kerja."'>".$row->nama_unit_kerja."</option>";
						}
					}
			$data .= '</select>';
		}
		echo $data;
	}
	function change_unit_organisasi()
	{
		extract($_POST); 
		$data = "";
		if($unit_organisasi3){
			$new_array = $this->mPegawai->ddl_unit_organisasi($unit_organisasi3); 
			
			$data = '<select id="unit_kerja3" name="unit_kerja3" class="input-xlarge">
					<option value=""> </option>
					';		
					if($new_array){
						foreach($new_array as $row){
							$data .= "<option value='".$row->kode_unit_kerja."'>".$row->nama_unit_kerja."</option>";
						}
					}
			$data .= '</select>';
		}
		echo $data;
	}
	
	function change_golongan()
	{
		extract($_POST); 
		$data = "";
		$golongan = $this->mPegawai->ddl_golongan($golongan1); 
		if($golongan){
			$data = $golongan->nama_golongan;			
		}else{
			$data = '';
		}
		echo $data;
	}
	
	function change_jabatan()
	{
		extract($_POST); 
		$data = "";
		$new_jab = $this->mPegawai->ddl_jabatan('',$status_id); 
			$data = '<select id="nama_jabatan3" name="nama_jabatan3" class="input-xlarge">
					<option value=""> </option>
					';			
					if($new_jab){
						foreach($new_jab as $row){							
							$data .= "<option value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
						}
					}
			$data .= '</select>';
			
		echo $data;
	}
	
	function check_nip_lama()
	{
		extract($_POST); 
		$check_nip = $this->mPegawai->check_nip_lama($nip_lama, $hd_id); 
		if($check_nip){
			echo "valid";			
		}else{
			echo 'not valid';
		}
	}
	
	function check_nip_baru()
	{
		extract($_POST); 
		$check_nip = $this->mPegawai->check_nip_baru($nip_baru, $hd_id); 
		if($check_nip){
			echo "valid";			
		}else{
			echo 'not valid';
		}
	}
	
	//==== Riwayat Kepangkatan ====
	function ajax_rkepangkatan()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatkepangkatan($id_peg);
		//echo "<pre>";
		//print_r($result);
		//echo "</pre>";
        //$iTotalRecords = $this->mPegawai->total_riwayatkepangkatan();
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
				$edit_delete = '';
				$tmt_kepangkatan = '';
				$tgl_sk = '';
				
				if(!empty($row->tmt_kepangkatan)){
					$tmt_kepangkatan = date('d-m-Y',strtotime($row->tmt_kepangkatan));
				}
				if(!empty($row->tgl_sk)){
					$tgl_sk = date('d-m-Y',strtotime($row->tgl_sk));
				}
				
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rkepangkatan" onclick="javascript:onUpload('.$row->id.',1)" class="act-btn fam-building-add"></span>
					<span id="edit-rkepangkatan" onclick="javascript:onEditRkepangkatan('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rkepangkatan" onclick="javascript:onDeleteRkepangkatan('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->kepangkatan,
					$row->golongan,
					$tmt_kepangkatan,
					$row->no_sk.'<br>'.$tgl_sk,
					$row->pejabat_penandatangan,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rkepangkatan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		$islast = @$is_last1 ? $is_last1 : 'Tidak';
		
		$data = array(
			'pegawai_id' => $id_peg,
			'ppertama' => $pangkatpertama, 
			'kepangkatan' => $pangkat1, 
			'golongan' => $golongan1,
			'tmt_kepangkatan' => date('Y-m-d',strtotime($tmt1)),
			'no_sk' => $no_sk1,
			'tgl_sk' => date('Y-m-d',strtotime($tanggal_sk1)),
			'pejabat_penandatangan' => $pejabat1,
			'is_last' => $islast

		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatkepangkatan($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatkepangkatan($data, $id);
		}
		if($do_['success']){
		
			if($islast == 'Ya'){
				$data_last=array(
					'table'=>'pegawai_riwayatkepangkatan',
					'data'=>array(
						'is_last'=>'Tidak'
					),
					'where'=>array(
						'pegawai_id' => $id_peg
					),
					'where_not_in'=>array(
						'id'=>$do_['id']
					)
				);
				$update_last = $this->mPegawai->updateLast($data_last);
				$update_data = array(
					'kepangkatan' => $pangkat1, 
					'golongan' => $golongan1,
					'tmt_kepangkatan' => date('Y-m-d',strtotime($tmt1)),
					'no_sk' => $no_sk1,
					'tgl_sk' => date('Y-m-d',strtotime($tanggal_sk1)),
					'pejabat_penandatangan' => $pejabat1

				);
				$this->mPegawai->update_kepangkatan($id_peg, $update_data);				
			}
			
			$wcpns = array(
				'ppertama'=>'CPNS',
				//'nip_baru'=>$nip_baru1,
				'pegawai_id' => $id_peg
			);
			$getCpns = $this->mPegawai->getRiwayatPangkat($wcpns);
			foreach($getCpns->result() as $row){
				$cpdata = array(
					'tmt_cpns'=>$row->tmt_kepangkatan,
				);
				$this->mPegawai->update_kepegawaian($id_peg,$cpdata);
			}
			$wpns = array(
				'ppertama'=>'PNS',
				//'nip_baru'=>$nip_baru1,
				'pegawai_id' => $id_peg
			);
			$getpns = $this->mPegawai->getRiwayatPangkat($wpns);
			foreach($getpns->result() as $row){
				$pdata = array(
					'tmt_pns'=>$row->tmt_kepangkatan
				);
				$this->mPegawai->update_kepegawaian($id_peg,$pdata);
			}
			
			
			$lastpegawai = array(
				'is_last'=>'YA',
				//'nip_baru'=>$nip_baru1,
				'pegawai_id' => $id_peg
			);
			$rlast = $this->mPegawai->getLast('pegawai_riwayatkepangkatan',$lastpegawai);
			foreach($rlast->result() as $row){
				$rldata = array(
					'status_kepegawaian'=>$row->ppertama,
					'gol_terakhir'=>$row->golongan,
					'tmt_gol_terakhir'=>$row->tmt_kepangkatan
				);
				$this->mPegawai->update_kepegawaian($id_peg,$rldata);
			}
			$mkg = array(
				'is_last' => 'Ya',
				//'nip_baru' => $nip_baru1,
				'ppertama' => 'PNS'
			);
			$cpns = array(
				'pegawai_id' => $id_peg
			);
			$tmtcpns = $this->mPegawai->get_tmt_cpns($id_peg);
			if(array_key_exists('tmt_kepangkatan',$tmtcpns)){
			$tmtpns = $this->mPegawai->getRiwayatPangkat($mkg);
			foreach($tmtpns->result() as $row){
				$result = datediff($row->tmt_kepangkatan, $tmtcpns->tmt_kepangkatan);
				$data = array(
					'masa_kerja_tahun'=> $result['years'],
					'masa_kerja_bulan'=> $result['months'],
					//'masa_kerja_golongan' => $result['years'].' '.'Thn'.' '.$result['months'].' '.'bln'
				);
				$this->mPegawai->update_kepegawaian($id_peg, $data);
			}
			}
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rkepangkatan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatkepangkatan($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rkepangkatan($id){
		
		$val = $this->mPegawai->edit_riwayatkepangkatan($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->kepangkatan).'|'.trim($val->golongan).'|'.date('d-m-Y', strtotime($val->tmt_kepangkatan)).'|'.trim($val->no_sk).'|'.date('d-m-Y', strtotime($val->tgl_sk)).'|'.trim($val->pejabat_penandatangan).'|'.trim($val->is_last).'|'.trim($val->ppertama);
	}
	
	//==== Riwayat Pendidikan ====
	function ajax_rpendidikan()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatpendidikan($id_peg);
        //$iTotalRecords = $this->mPegawai->total_riwayatpendidikan();
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
				$edit_delete = '';
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rpendidikan" onclick="javascript:onUpload('.$row->id.',2)" class="act-btn fam-building-add"></span>
					<span id="edit-rpendidikan" onclick="javascript:onEditRpendidikan('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rpendidikan" onclick="javascript:onDeleteRpendidikan('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					get_name('m_strata_pendidikan','nama_strata','id_strata', $row->strata),
					$row->kategori,
					$row->jenis_tenaga,
					$row->program_studi,
					$row->jurusan,
					$row->nama_sekolah,
					$row->tahun_lulus,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rpendidikan($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		$islast = @$is_last2 ? $is_last2 : 'Tidak';
		
		$data = array(
			'pegawai_id' => $id_peg,
			'strata' => $strata2, 
			'kategori' => $kategori2,
			'jenis_tenaga' => $jenis_tenaga2,
			'program_studi' => $program_studi2,
			'jurusan' => $jurusan2,
			'nama_sekolah' => $nama_sekolah2,
			'tahun_lulus' => $tahun_lulus2,
			'pendidikan_saat_diangkat' => $pendidikan_saat_diangkat2,
			'is_last' => $islast
		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatpendidikan($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatpendidikan($data, $id);
		}
		if($do_['success']){
		
			if($islast == 'Ya'){
				$data_last=array(
					'table'=>'pegawai_riwayatpendidikan',
					'data'=>array(
						'is_last'=>'Tidak'
					),
					'where'=>array(
						//'nip_baru' => $nip_baru2,
						'pegawai_id' => $id_peg
					),
					'where_not_in'=>array(
						'id'=>$do_['id']
					)
				);
				
				$this->mPegawai->updateLast($data_last);
				$update_data = array(
					'strata' => $strata2, 
					'kategori' => $kategori2,
					'jenis_tenaga' => $jenis_tenaga2,
					'program_studi' => $program_studi2,
					'jurusan' => $jurusan2,
					'nama_sekolah' => $nama_sekolah2,
					'tahun_lulus' => $tahun_lulus2,
					'pendidikan_saat_diangkat' => $pendidikan_saat_diangkat2
				);
				$this->mPegawai->update_pendidikan($id_peg, $update_data);				
			}
			
			if($pendidikan_saat_diangkat2=='Ya'){
				$data_diangkat=array(
					'table'=>'pegawai_riwayatpendidikan',
					'data'=>array(
						'pendidikan_saat_diangkat'=>'Tidak'
					),
					'where'=>array(
						//'nip_baru' => $nip_baru2,
						'pegawai_id' => $id_peg
					),
					'where_not_in'=>array(
						'id'=>$do_['id']
					)
				);
				
				$this->mPegawai->updateLast($data_diangkat);
				$update_peg = array(
					'pendidikan_diangkat' => $do_['id'], 
					'updated_date' => date('Y-m-d H:i:s'),
					'updated_by' => $user_input
				);
				$this->mPegawai->update_kepegawaian($id_peg, $update_peg);
			}
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rpendidikan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatpendidikan($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rpendidikan($id){
		
		$val = $this->mPegawai->edit_riwayatpendidikan($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->strata).'|'.trim($val->kategori).'|'.trim($val->jenis_tenaga).'|'.trim($val->program_studi).'|'.
			trim($val->jurusan).'|'.trim($val->nama_sekolah).'|'.trim($val->tahun_lulus).'|'.trim($val->pendidikan_saat_diangkat).'|'.trim($val->is_last);
	}
	
	//==== Riwayat Jabatan ====
	function ajax_rjabatan()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatjabatan($id_peg);
        //$iTotalRecords = $this->mPegawai->total_riwayatjabatan();
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
				$edit_delete = '';
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rjabatan" onclick="javascript:onUpload('.$row->id.',3)" class="act-btn fam-building-add"></span>
					<span id="edit-rjabatan" onclick="javascript:onEditrjabatan('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rjabatan" onclick="javascript:onDeleterjabatan('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->nama_status_jabatan."<br>".$row->nama_jabatan,
					$row->eselon,
					date('d/m/Y', strtotime($row->tmt_jabatan)),
					$row->no_sk,
					date('d/m/Y', strtotime($row->tgl_sk)),
					$row->nama_unit_kerja,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rjabatan($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$kode_unit_kerja = '';
		$user_input = $this->session->userdata('user_id');
		$islast = @$is_last3 ? $is_last3 : 'Tidak';
		if(!empty($organisasi_kerja3)){
			$kode_unit_kerja = $organisasi_kerja3;
		}
		if(!empty($satuan_kerja3)){
			$kode_unit_kerja = $satuan_kerja3;
		}
		if(!empty($satuan_organisasi3)){
			$kode_unit_kerja = $satuan_organisasi3;
		}
		if(!empty($unit_organisasi3)){
			$kode_unit_kerja = $unit_organisasi3;
		}
		if(!empty($unit_kerja3)){
			$kode_unit_kerja = $unit_kerja3;
		}
		
		
		$data = array(
			//'nip_baru' => $nip_baru3,
			'pegawai_id' => $id_peg,
			'id_jabatan' => $jabatan3,
			'id_nama_jabatan' => $nama_jabatan3,
			'eselon' => $eselon3,
			'no_sk' => $no_sk3,
			'tgl_sk' => date('Y-m-d',strtotime($tgl_sk3)),
			'tmt_jabatan' => date('Y-m-d',strtotime($tmt_jabatan3)),
			'tgl_masuk_unit' => date('Y-m-d',strtotime($tgl_masuk_unit3)),
			'instansi_bekerja' => $instansi_bekerja3,
			'organisasi_kerja' => $organisasi_kerja3,
			'satuan_kerja' => $satuan_kerja3,
			'satuan_organisasi' => $satuan_organisasi3,
			'unit_organisasi' => $unit_organisasi3,
			'unit_kerja' => $unit_kerja3,
			'kode_unit_kerja' => $kode_unit_kerja,
			'unit_kerja_penempatan' => $unit_kerja_penempatan3,
			'propinsi' => $s_propinsi3,
			'kabupaten' => $kabupaten3,
			//'id_formasi_jabatan' => $nama_jabatan_formasi3,
			'kelas_jabatan' => $kelas_jabatan3,
			'keterangan' => $keterangan3,
			'is_last' => $islast
		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatjabatan($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatjabatan($data, $id);
		}
		
		if($do_['success']){
			
			if($islast == 'Ya'){
				$data_lastjabatan=array(
					'table'=>'pegawai_riwayatjabatan',
					'data'=>array(
						'is_last'=>'Tidak'
					),
					'where'=>array(
						//'nip_baru' => $nip_baru3,
						'pegawai_id' => $id_peg
					),
					'where_not_in'=>array(
						'id'=>$do_['id']
					)
				);
				
				$this->mPegawai->updateLast($data_lastjabatan);
				$update_data = array(
					'id_jabatan' => $jabatan3,
					'id_nama_jabatan' => $nama_jabatan3,
					'eselon' => $eselon3,
					'no_sk' => $no_sk3,
					'tgl_sk' => date('Y-m-d',strtotime($tgl_sk3)),
					'tmt_jabatan' => date('Y-m-d',strtotime($tmt_jabatan3)),
					'tgl_masuk_unit' => date('Y-m-d',strtotime($tgl_masuk_unit3)),
					'instansi_bekerja' => $instansi_bekerja3,
					'organisasi_kerja' => $organisasi_kerja3,
					'satuan_kerja' => $satuan_kerja3,
					'satuan_organisasi' => $satuan_organisasi3,
					'unit_organisasi' => $unit_organisasi3,
					'unit_kerja' => $unit_kerja3,
					'kode_unit_kerja' => $kode_unit_kerja,
					'unit_kerja_penempatan' => $unit_kerja_penempatan3,
					'propinsi' => $propinsi3,
					'kabupaten' => $kabupaten3,
					'kelas_jabatan' => $kelas_jabatan3
				);
				$this->mPegawai->update_jabatan($id_peg, $update_data);
				
				$update_tempatk = array(
					'tanggal_tugas' => date('Y-m-d',strtotime($tgl_masuk_unit3)),
					'tmt_jabatan' => date('Y-m-d',strtotime($tmt_jabatan3)),
					'instansi' => $instansi_bekerja3,
					'organisasi_kerja' => $organisasi_kerja3,
					'satuan_kerja' => $satuan_kerja3,
					'satuan_organisasi' => $satuan_organisasi3,
					'unit_organisasi' => $unit_organisasi3,
					'unit_kerja' => $unit_kerja3,
					'kode_unit_kerja' => $kode_unit_kerja
				);
				
				$this->mPegawai->update_tempatkerja($id_peg,$update_tempatk);
				
				$update_kepeg = array(
					'satuan_kerja' => $satuan_kerja3
				);
				$this->mPegawai->update_kepegawaian($id_peg,$update_kepeg);
			}
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rjabatan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatjabatan($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rjabatan($id){
		
		$val = $this->mPegawai->edit_riwayatjabatan($id); 
		
		echo trim($val->id_nama_jabatan).'|'.trim($val->id_jabatan).'|'.trim($val->nama_jabatan).'|'.trim($val->eselon).'|'.trim($val->no_sk).'|'.
			date('d-m-Y',strtotime($val->tgl_sk)).'|'.date('d-m-Y',strtotime($val->tmt_jabatan)).'|'.date('d-m-Y',strtotime($val->tgl_masuk_unit)).'|'.trim($val->instansi_bekerja).'|'.
			trim($val->organisasi_kerja).'|'.trim($val->satuan_kerja).'|'.trim($val->satuan_organisasi).'|'.trim($val->unit_organisasi).'|'.
			trim($val->unit_kerja).'|'.trim($val->unit_kerja_penempatan).'|'.trim($val->propinsi).'|'.trim($val->kabupaten).'|'.
			/*trim($val->nama_formasi).'|'.*/trim($val->kelas_jabatan).'|'.trim($val->keterangan).'|'.trim($val->is_last);
	}
	
	
	//==== Riwayat Dokumen ====
	function ajax_rdokumen()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_pegawai_dokumen($id_peg);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		$doc = array('pdf','jpg','png','jpeg','gif');
		if($result){
			foreach($result as $row)
			{
				$filename = str_replace("C:\\fakepath\\","", $row->filename);
						
				$edit_delete = '<a href="'. base_url().'Uploads/dokumen/'.$filename.'" download="'.$filename.'" class="tip" title="Download"><i class="act-btn fam-page-save"></i></a>&nbsp;';
				
				if($action == 'edit'){
					$edit_delete .= '<span id="edit-rdokumen" onclick="javascript:onEditrdokumen('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rdokumen" onclick="javascript:onDeleterdokumen(\''.$row->id.'\', \''.$row->nama_dokumen.'\', \''.$row->filename.'\')" class="act-btn fam-application-delete"></span>';
				}
				if($action == 'detail'){
					$login_state = $this->session->userdata('login_state');
					
					if($login_state == 'User'){
						$edit_delete = '<a href="'. base_url().'Uploads/dokumen/'.$filename.'" class="tip" download="'.$filename.'" title="Download"><i class="act-btn fam-page-save"></i></a>&nbsp;';
					}else{
						$edit_delete = '';
					}
				}
				
				$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
				if(in_array($ext,$doc)){
					$file ='<a class="no_print" target="_blank" href="'.base_url().'viewer/'.$row->id.'">'.$row->filename.'</a>';
				}else{
					$file = '<a class="no_print" target="_blank" href="'.base_url().'Uploads/dokumen/'.$row->filename.'">'.$row->filename.'</a>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->nama_dokumen,
					date('d-m-Y',strtotime($row->created_date)),
					$row->tipe_doc,
					$file,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rdokumen($idx='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$msg = '';
		$do_ = '';
		$lastid = $idx;
		$user_input = $this->session->userdata('user_id');
		$fileElementName = 'filename4';
		$upload_path = APP_PATH.'Uploads/dokumen/';
		$status = 'success';
		$uploaded = false;
		if(!empty($_FILES)){
			$filename  = pathinfo($_FILES[$fileElementName]['name'], PATHINFO_FILENAME);
			$name_doc =  $id.'_'.$filename;
			if($tipe){
				$name_doc =  $id.'_'.$tipe.'_'.$filename;
			}
			
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx';
			$config['max_size']  = 5024 * 8;
			$config['encrypt_name'] = false;
			$config['overwrite'] = false;
			
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload($fileElementName,$name_doc))
			{
				$status = 'error';
				$msg = $this->upload->display_errors('', '');
				$uploaded = false;
			}
			else
			{
				$data_upload = $this->upload->data();
				$uploaded = true;
				$name_doc = $data_upload['file_name'];
			}
		}
		
		
		
		
			
			if(empty($idx)){
				$data = array(
					'nip_baru' => $nip_baru4,
					'pegawai_id' => $id_pegawai,
					'nama_dokumen' => $nama_dokumen4, 
					'tipe_dokumen' => $tipe_dokumen4
				);
				if(!empty($jenis)){
					$data['jenis_dokumen'] = $jenis;
					$data['jenis_id'] = $jenis_id;
				}
				$data['created_date'] = date('Y-m-d H:i:s');
				$data['created_by'] = $user_input;
				$data['updated_date'] = date('Y-m-d H:i:s');
				$data['updated_by'] = $user_input;
				$lastid = $this->mPegawai->insert_pegawai_dokumen($data);
				
				if($uploaded){
					$data2['filename'] = $name_doc;
					$data2['letak_dokumen'] = $upload_path;
					$data2['filename'] = str_replace("C:\fakepath\"",'', $data2['filename']);
					$data2['filename'] = str_replace(" ","_", $data2['filename']);
					$do_ = $this->mPegawai->update_pegawai_dokumen($data2, $lastid);
				}
	
			}else{
				$lastid = $idx;
				if($uploaded){
					$data3['filename'] = $name_doc;
					$data3['letak_dokumen'] = $upload_path;
					$data3['filename'] = str_replace("C:\fakepath\"",'', $data3['filename']);
					$data3['filename'] = str_replace(" ","_", $data3['filename']);
				}
				//$data3['nama_dokumen'] = $nama_dokumen4;
				$data3['updated_date'] = date('Y-m-d H:i:s');
				$data3['updated_by'] = $user_input;
				$do_ = $this->mPegawai->update_pegawai_dokumen($data3, $lastid);
				
			}
		
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status.'#'.$lastid;
	}
	
	public function do_delete_rdokumen($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_pegawai_dokumen($id);
		
		if($do_){			
			@unlink(APP_PATH.'Uploads/dokumen/'.$filex);
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rdokumen($id)
	{
		
		$val = $this->mPegawai->edit_pegawai_dokumen($id); 
		
		echo trim($val->nip_baru).'|'.$val->tipe_dokumen.'|'.trim($val->nama_dokumen).'|'.trim($val->filename);
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
					$file_id = $this->mPegawai->update_foto($_POST['id'], $data);
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
	
	//==== Riwayat Diklat Jabatan ====
	function ajax_rdiklatjabatan()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatpelatihanjabatan($id_peg);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$edit_delete = '';
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rdiklatjabatan" onclick="javascript:onUpload('.$row->id.',4)" class="act-btn fam-building-add"></span>
					<span id="edit-rdiklatjabatan" onclick="javascript:onEditrdiklatjabatan('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rdiklatjabatan" onclick="javascript:onDeleterdiklatjabatan('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->jenis_pelatihan,
					get_name('m_pelatihan','nama_pelatihan','id_pelatihan', $row->nama_pelatihan),
					$row->lembaga_pelaksana,
					$row->tahun_sertifikasi,
					$row->jml_jam_kursus,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rdiklatjabatan($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		$islast = @$is_last5 ? $is_last5 : 'Tidak';
		
		$data = array(
			//'nip_baru' => $nip_baru5,
			'pegawai_id' => $id_peg,
			'jenis_pelatihan' => $jenis_pelatihan5,
			'nama_pelatihan' => $nama_pelatihan5,
			'lembaga_pelaksana' => $lembaga_pelaksana5,
			'tahun_sertifikasi' => $tahun_sertifikasi5,
			'jml_jam_kursus' => $jml_jam_kursus5,
			'is_last' => $islast
		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatpelatihanjabatan($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatpelatihanjabatan($data, $id);
		}
		if($do_){
			
			if($islast == 'Ya'){
				$update_data = array(
					'jenis_pelatihan' => $jenis_pelatihan5,
					'nama_pelatihan' => $nama_pelatihan5,
					'lembaga_pelaksana' => $lembaga_pelaksana5,
					'tahun_sertifikat' => $tahun_sertifikasi5,
					'jml_jam_kursus' => $jml_jam_kursus5,
				);
				$this->mPegawai->update_diklat_jabatan($id_peg, $update_data);				
			}
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rdiklatjabatan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatpelatihanjabatan($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rdiklatjabatan($id){
		
		$val = $this->mPegawai->edit_riwayatpelatihanjabatan($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->jenis_pelatihan).'|'.trim($val->nama_pelatihan).'|'.trim($val->lembaga_pelaksana).'|'.
			trim($val->tahun_sertifikasi).'|'.trim($val->jml_jam_kursus).'|'.trim($val->is_last);
	}
	
	//==== Riwayat Diklat Teknis ====
	function ajax_rdiklatteknis()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatpelatihanteknis($id_peg);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$edit_delete = '';
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rdiklatteknis" onclick="javascript:onUpload('.$row->id.',5)" class="act-btn fam-building-add"></span>
					<span id="edit-rdiklatteknis" onclick="javascript:onEditrdiklatteknis('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rdiklatteknis" onclick="javascript:onDeleterdiklatteknis('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->kategori,
					$row->nama_pelatihan,
					$row->lembaga_pelaksana,
					$row->negara_pelaksana,
					$row->jenis_pelatihan,
					$row->tahun_sertifikasi,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rdiklatteknis($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');
		$islast = @$is_last6 ? $is_last6 : 'Tidak';
		
		$data = array(
			//'nip_baru' => $nip_baru6,
			'pegawai_id' => $id_peg,
			'kategori' => $kategori6,
			'nama_pelatihan' => $nama_pelatihan6,
			'lembaga_pelaksana' => $lembaga_pelaksana6,
			'negara_pelaksana' => $negara_pelaksana6,
			'jenis_pelatihan' => $jenis_pelatihan6,
			'tahun_sertifikasi' => $tahun_sertifikasi6,
			'jml_jam_kursus' => $jml_jam_kursus6,
			'is_last' => $islast
		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatpelatihanteknis($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatpelatihanteknis($data, $id);
		}
		if($do_){
			
			if($islast == 'Ya'){
				$update_data = array(
					'kategori' => $kategori6,
					'nama_pelatihan' => $nama_pelatihan6,
					'lembaga_pelaksana' => $lembaga_pelaksana6,
					'negara_pelaksana' => $negara_pelaksana6,
					'jenis_pelatihan' => $jenis_pelatihan6,
					'tahun_sertifikasi' => $tahun_sertifikasi6,
					'jml_jam_kursus' => $jml_jam_kursus6
				);
				$this->mPegawai->update_diklat_teknis($id_peg, $update_data);				
			}
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rdiklatteknis($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatpelatihanteknis($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rdiklatteknis($id){
		
		$val = $this->mPegawai->edit_riwayatpelatihanteknis($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->kategori).'|'.trim($val->nama_pelatihan).'|'.trim($val->lembaga_pelaksana).'|'.trim($val->negara_pelaksana).'|'.trim($val->jenis_pelatihan).'|'.
			trim($val->tahun_sertifikasi).'|'.trim($val->jml_jam_kursus).'|'.trim($val->is_last);
	}
	
	//==== Riwayat Penghargaan ====
	function ajax_rpenghargaan()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatpenghargaan($id_peg);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$edit_delete = '';
				$tgl_sk = '';
				
				if(!empty($row->tgl_sk)){
					$tgl_sk = date('d-m-Y',strtotime($row->tgl_sk));
				}
				
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rpenghargaan" onclick="javascript:onUpload('.$row->id.',6)" class="act-btn fam-building-add"></span>
					<span id="edit-rpenghargaan" onclick="javascript:onEditrpenghargaan('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rpenghargaan" onclick="javascript:onDeleterpenghargaan('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->instansi_pelaksana,
					$row->nama_penghargaan,
					$row->tanda_jasa,
					$row->no_sk,
					$tgl_sk,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rpenghargaan($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');

		$data = array(
			//'nip_baru' => $nip_baru7,
			'pegawai_id' => $id_peg,
			'instansi_pelaksana' => $instansi_pelaksana7,
			'id_penghargaan' => $nama_penghargaan7,
			'tanda_jasa' => $tanda_jasa7,
			'no_sk' => $no_sk7,
			'tgl_sk' => date('Y-m-d',strtotime($tgl_sk7)),
			'is_last' => @$is_last7 ? $is_last7 : 'Tidak'
		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatpenghargaan($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatpenghargaan($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rpenghargaan($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatpenghargaan($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rpenghargaan($id){
		
		$val = $this->mPegawai->edit_riwayatpenghargaan($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->instansi_pelaksana).'|'.trim($val->id_penghargaan).'|'.trim($val->tanda_jasa).'|'.
			trim($val->no_sk).'|'.date('d-m-Y',strtotime($val->tgl_sk)).'|'.trim($val->is_last);
	}
	
	//==== Riwayat Keluarga ====
	function ajax_rkeluarga()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatkeluarga($id_peg);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$edit_delete = '';
				$tanggal_lahir = '';
				
				if(!empty($row->tanggal_lahir)){
					$tanggal_lahir = date('d-m-Y',strtotime($row->tanggal_lahir));
				}
				
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rkeluarga" onclick="javascript:onUpload('.$row->id.',8)" class="act-btn fam-building-add"></span>
					<span id="edit-rkeluarga" onclick="javascript:onEditrkeluarga('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rkeluarga" onclick="javascript:onDeleterkeluarga('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->nama_anak,
					$tanggal_lahir,
					$row->jenis_kelamin,
					$row->status,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rkeluarga($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');

		$data = array(
			'pegawai_id' => $id_peg,
			'nama_anak' => $nama_anak8,
			'tanggal_lahir' => date('Y-m-d',strtotime($tanggal_lahir8)),
			'jenis_kelamin' => $jenis_kelamin8,
			'status' => $status8
		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatkeluarga($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatkeluarga($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rkeluarga($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatkeluarga($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rkeluarga($id){
		
		$val = $this->mPegawai->edit_riwayatkeluarga($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->nama_anak).'|'.date('d-m-Y',strtotime($val->tanggal_lahir)).'|'.trim($val->jenis_kelamin).'|'.
			trim($val->status);
	}
	
	//==== Riwayat Kinerja ====
	function ajax_rkinerja()
    {
		$action = $this->uri->segment(3);
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatkinerja($id_peg);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$edit_delete = '';
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rkinerja" onclick="javascript:onUpload('.$row->id.',9)" class="act-btn fam-building-add"></span>
					<span id="edit-rkinerja" onclick="javascript:onEditrkinerja('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rkinerja" onclick="javascript:onDeleterkinerja('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->nama_jabatan,
					$row->capaian_skp,
					$row->pejabat_penilai,
					$row->tahun,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rkinerja($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$tahun = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');

		$data = array(
			'pegawai_id' => $id_peg,
			'jabatan' => $jabatan9,
			'capaian_skp' => $capaian_skp9,
			'pejabat_penilai' => $pejabat_penilai9,
			'tahun' => $tahun9
		);
		if(empty($id)){
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatkinerja($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatkinerja($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rkinerja($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatkinerja($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function cek_edit_rkinerja($id){
		
		$val = $this->mPegawai->edit_riwayatkinerja($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->id_jabatan).'|'.trim($val->capaian_skp).'|'.trim($val->pejabat_penilai).'|'.
			trim($val->tahun);
	}
	
	//==== Riwayat Kompetensi ====
	function ajax_rkompetensi()
    {
		$action = $this->uri->segment(3); 
		$id_peg = $this->input->post('id_peg');
        $result = $this->mPegawai->get_riwayatkompetensi($id_peg);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$edit_delete = '';
				if($action == 'edit'){
					$edit_delete .= '<span title="Upload Dokumen" id="upload-rkompetensi" onclick="javascript:onUpload('.$row->id.',10)" class="act-btn fam-building-add"></span>
					<span id="edit-rkompetensi" onclick="javascript:onEditrkompetensi('.$row->id.')" class="act-btn fam-application-edit"></span>
					<span id="delete-rkompetensi" onclick="javascript:onDeleterkompetensi('.$row->id.')" class="act-btn fam-application-delete"></span>';
				}
				array_push($json["aaData"],array(
					$i,
					$row->nama_jabatan,
					$row->kompetensi,
					$edit_delete
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_popup_rkompetensi($id='')
	{
		extract($_POST); 
		//print_r($_POST);die();
		$tahun = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');

		$data = array(
			'pegawai_id' => $id_peg,
			'id_jabatan' => $jabatan10,
			'kompetensi' => $kompetensi10
		);
		if(empty($id)){
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatkompetensi($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatkompetensi($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_rkompetensi($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_riwayatkompetensi($id);
		
		if($do_){			
			$status = 'success';	
		}
					
		echo $status;
	}
	
	public function cek_edit_rkompetensi($id){
		
		$val = $this->mPegawai->edit_riwayatkompetensi($id); 
		
		echo trim($val->nip_baru).'|'.trim($val->id_jabatan).'|'.trim($val->kompetensi);
	}
	
	function data_print_cv($pegawai_id, $nip_baru) 
	{	
		//$this->load->helper(array('dompdf', 'file'));
		 
		$data['pegawai'] = $this->mPegawai->get_pegawai_cv($pegawai_id);
				//echo "<pre>";
				//print_r($data['pegawai']);
				//echo "</pre>";
		$this->load->view('drh/print_cv', $data);
		
		/*
		$html = $this->load->view('drh/print_cv', $data, true);
		//Update DB
		$datadb['cv'] = 'CV_'.$nip.'.pdf';
		$this->mPegawai->update_pegawai($pegawai_id, $datadb);
			
		//Download File
		//pdf_create($html, 'CV_'.$nip, true);
		
		//save to upload file 
		$data = pdf_create($html, 'CV_'.$nip, false);
		write_file('name', $data);
		
		echo 'success';
		*/
	}
	
	//==== Usulan  ====
	function ajax_usulan()
    {
		$action = $this->uri->segment(3);
		$user_login = $this->session->userdata('user_id');
        $result = $this->mPegawai->get_usulan_temp($user_login);

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
				array_push($json["aaData"],array(
					$i,
					$row->nip_baru,
					$row->nama,
					$row->status_pegawai,
					'<span id="delete-usulan_temp" onclick="javascript:onDeleteTemp('.$row->id.')" class="fam-application-delete"></span>'
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	//AUTOCOMPLETE
	function auto_pegawai(){
		extract($_POST); 
		$where = "nama like '%".$q."%' OR nip_baru like '%".$q."%'";
		$this->db->select("nip_baru, nama, gelar_depan, gelar_belakang")->from("pegawai")->where($where);
		$this->db->order_by('nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				$status_kepeg = get_name('pegawai_kepegawaian','status_kepegawaian','nip_baru', $row->nip_baru);
				echo $row->nama."(".$row->nip_baru.") |".$row->nip_baru."|".$nama."|".$status_kepeg."\n";
			}
		}
	}
	
	public function add_usulan()
	{
		extract($_POST); 
		//print_r($_POST);die();
		$tahun = 'error';
		$do = '';
		$user_input = $this->session->userdata('user_id');

		$data = array(
			'id_pegawai' => $id_peg,
			'status_pegawai' => $status_us,
			'updated_date' => date('Y-m-d H:i:s'),
			'user_login' => $user_input
		);
		$do_ = $this->mPegawai->insert_usulan_temp($data);
	
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_usulan_temp($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->mPegawai->delete_usulan_temp($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function list_usulan()
	{
		$this->data['title'] = 'List Histori Usulan ';
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_usulan();
		$this->load->view('drh/histori_usulan', $this->data);
	}
	
	public function cetak_usulan()
	{
		
		$this->data['title'] = 'Cetak Usulan ';
		$this->load->view('drh/cetak_usulan', $this->data);
	}
	
	public function cek_cetak_usulan()
	{
		extract($_POST); 
		$status = 'error';
		$do_insert = '';
		$user_login = $this->session->userdata('user_id');
		$cek_peg = $this->mPegawai->get_cetak_usulan_byUser($user_login);
		
		if(is_array($cek_peg)){
			
			foreach($cek_peg as $nip_cek){
				$kode_usulan = date('ymdHi');
				$data = array(
					'nip_baru' => $nip_cek['nip_baru'],
					'nama' => $nip_cek['nama'],
					'status_pegawai' => $nip_cek['status_pegawai'],
					'tipe_usulan' => $tipe_usulan,
					'kode_usulan' => $kode_usulan,
					'created_date' => date('Y-m-d H:i:s'),
					'created_by' => $user_login,
					'updated_date' => date('Y-m-d H:i:s'),
					'updated_by' => $user_login,
					
				);
				$do_insert = $this->mPegawai->insert_cetak_usulan($data);
				
			}
		}
		if($do_insert){			
			$status = 'success';	
			//Delete
			$this->db->where('user_login', $user_login);
			$delete = $this->db->delete('pegawai_cetak_usulan_temp');
			
		}
		
		echo $status;
	}

	public function cek_cetak_usulan_old()
	{
		extract($_POST); 
		$status = 'error';
		$do_insert = '';
		$user_input = $this->session->userdata('user_id');
		$cek_peg = explode(';', $idColl);
		
		if(is_array($cek_peg)){
			
			foreach($cek_peg as $nip_cek){
				$kode_usulan = date('ymdHi');
				$data = array(
					'nip_baru' => $nip_cek,
					'tipe_usulan' => $tipe_usulan,
					'kode_usulan' => $kode_usulan,
					'created_date' => date('Y-m-d H:i:s'),
					'created_by' => $user_input,
					'updated_date' => date('Y-m-d H:i:s'),
					'updated_by' => $user_input,
					
				);
				if(!empty($nip_cek)){
					$do_insert = $this->mPegawai->insert_cetak_usulan($data);
				}
			}
		}
		if($do_insert){			
			$status = 'success';	
		}
		
		echo $status;
	}

	public function view_cetak_usulan($tipe_usulan)
	{
		$user_login = $this->session->userdata('user_id');
		$this->data['title'] = 'Cetak Usulan ';
		$this->data['tipe_usulan'] = $tipe_usulan;
		$this->data['query'] = $this->mPegawai->get_cetak_usulan_byUser2($user_login);
		$this->load->view('drh/view_cetak_usulan', $this->data);
	}
	
	public function input_draft_surat()
	{
		$this->load->model('kgp_model');
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		
		$user_login = $this->session->userdata('user_id');
		$this->data['title'] = 'Draft Surat';
		$this->data['query'] = $this->mPegawai->get_cetak_usulan_byUser2($user_login);
		$this->load->view('drh/draft_surat', $this->data);
	}
	
	public function insert_draft()
	{
		$user_login = $this->session->userdata('user_id');
		extract($_POST); 
		$return = 'error';
		if ($user_login != '') {
			$data = array(
				'no_surat'				=> $no_surat,
				'kepada'				=> $kepada,
				'jabatan_ttd'			=> $jabatan_ttd,
				'nama_ttd'				=> $nama_ttd,
				'nip_ttd'				=> $nip_ttd,
				'tembusan'				=> $tembusan
			);
			
			$upt = $this->mPegawai->update_draft_usulan($data, $user_login);
			if($upt){
				$return = 'success';
			}
		}
		echo $return;
	}
	
	
	public function do_request_user()
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do_ = '';
		$user_input = $this->session->userdata('user_id');

		$data = array(
			'msg_from' => $msg_from,
			'msg_to' => 'admin',
			'msg_tipe' => 'Perubahan Data Pegawai',
			'msg_subject' => $msg_subject,
			'msg_text' => $msg_text,
			'msg_date' => date('Y-m-d H:i:s')
		);
		$do_ = $this->mPegawai->insert_messages($data);
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	
	public function rekap()
	{		
		$this->data['title'] = 'Report / Rekap Data';
		$this->load->view('drh/rekap_pegawai', $this->data);
	}
	
	public function do_rekap_report()
	{		
		$result = $this->mPegawai->get_pegawai_all();
		$datas = array();
		if($result)
		{
			foreach($result as $row)
			{
				//Initialisasi data
				
				$row['masa_kerja_tahun'] = $row['masa_kerja_tahun'].' thn';
				$row['masa_kerja_bulan'] = $row['masa_kerja_bulan'].' bln';
				$datas[] = $row;
			}	
		}		
			
		$json["aaData"] = array();
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		if($datas){
			foreach($datas as $row)
			{
				$pegawai_id = $row['id'];
				$tmt_jabatan = '';
				$tmt_kepangkatan = '';
				if(!empty($row['tmt_jabatan'])){
					$tmt_jabatan = date('d-m-Y',strtotime($row['tmt_jabatan']));
				}
				if(!empty($row['tmt_kepangkatan'])){
					$tmt_kepangkatan = date('d-m-Y',strtotime($row['tmt_kepangkatan']));
				}
				
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail / Edit Pegawai" >'.$row['nama'].'</a><br>'.
						'NIP Lama : '.$row['nip_lama'].'<br>NIP Baru : '.$row['nip_baru'],
					$row['eselon'],
					$row['golongan'],
					$tmt_kepangkatan,
					$row['nama_jabatan'],
					$tmt_jabatan,
					$row['masa_kerja_tahun'],
					$row['masa_kerja_bulan'],
					$row['jurusan'],
					$row['tahun_lulus'],
					$row['nama_strata2']
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
	}
	
	function change_src_kriteria()
	{
		extract($_POST); 
		$data = "";
		
		switch ($src_kriteria) {
			case 'nama' :
				$data = '<input type="text" name="kriteria" class="input-xlarge" />';
				break;
			case 'status' :
				$data = '<select id="kriteria" name="kriteria" class="input-medium">
							<option value=""> </option>
							<option value="C P N S">C P N S  </option>
							<option value="P N S">P N S </option>
							<option value="BERHENTI/KELUAR">BERHENTI/KELUAR  </option>
						</select>';
				break;
			case 'jabatan' :
				$query = $this->mPegawai->ddl_jabatan(); 
				$data = '<select id="kriteria" name="kriteria" class="input-xlarge">
						<option value=""> </option>
						';			
						if($query){
							foreach($query as $row){							
								$data .= "<option value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
							}
						}
				$data .= '</select>';
				break;
			case 'umur' :
				$data = '<select id="kriteria" name="kriteria" class="input-medium">
							<option value=""> </option>
							<option value="dibawah_d3">Dibawah D3</option>
							<option value="s1">S1</option>
							<option value="diatas_s1">Diatas S1</option>
						</select>';
				break;
			case 'unit_kerja' :
				$query = $this->mPegawai->ddl_all_unit_kerja(); 
				$data = '<select id="kriteria" name="kriteria" class="input-xlarge">
						<option value=""> </option>
						';			
						if($query){
							foreach($query as $row){							
								$data .= "<option value='".$row->kode_unit_kerja."'>".$row->nama_unit_kerja."</option>";
							}
						}
				$data .= '</select>';
				break;
			case 'jenis_kelamin' :
				$data = '<select id="kriteria" name="kriteria" class="input-medium">
							<option value=""> </option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>';
				break;
			case 'pendidikan' :
				$query = $this->mPegawai->ddl_strata_pendidikan(); 
				$data = '<select id="kriteria" name="kriteria" class="input-xlarge">
						<option value=""> </option>
						';			
						if($query){
							foreach($query as $row){							
								$data .= "<option value='".$row->id_strata."'>".$row->nama_strata."</option>";
							}
						}
				$data .= '</select>';
				break;
			case 'pangkat' :
				$query = $this->mPegawai->ddl_golongan(); 
				$data = '<select id="kriteria" name="kriteria" class="input-xlarge">
						<option value=""> </option>
						';			
						if($query){
							foreach($query as $row){							
								$data .= "<option value='".$row->kode_golongan."'>".$row->nama_golongan."</option>";
							}
						}
				$data .= '</select>';
				break;		
		}
		
		echo $data;
	}
	
	function deletedata($pegawai_id) {
		$this->mPegawai->del_pegawai($pegawai_id);
		
		redirect('drh/pegawai');
	}
	
	function detail_download($pegawai_id) {		
		$this->load->helper('download');
		$data = file_get_contents(base_url().'/images/ijazah.jpg'); // Read the file's contents
		$name = $pegawai_id.'.jpg';

		force_download($name, $data); 
	}
	
	
}