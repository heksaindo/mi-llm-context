<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Generate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}

	}

	public function index()
	{	
	}
	
	function generate_tgllahir()
    {
		$this->load->model('Pegawai_model', 'mPegawai');
        $result = $this->mPegawai->get_all();
		$datas = array();
		if($result)
		{
			foreach($result as $row)
			{
				$lahir_th = substr($row['nip_baru'], 0, 4);
				$lahir_bl = substr($row['nip_baru'], 4, 2);
				$lahir_tgl = substr($row['nip_baru'], 6, 2);
				$tgl_lahir = $lahir_th.'-'.$lahir_bl.'-'.$lahir_tgl;
				
				$data_pegawai = array(
					'tanggal_lahir' => $tgl_lahir

				);				
				$do_update = $this->mPegawai->update_pegawai($row['id'], $data_pegawai);
				if($do_update){
					echo "update ".$row['nama']." - ".$tgl_lahir."<br>";
				}
			}
		}	
		echo "<br>DONE<br>";
	}
	
	//pegawai_riwayatjabatan, pegawai_jabatan, pegawai_tempatkerja
	function generate_kode_unit_kerja($table)
    {
		$query = $this->db->get($table);
			
		foreach($query->result() as $row)
		{
			if(!empty($row->organisasi_kerja)){
				$kode_unit_kerja = $row->organisasi_kerja;
			}
			if(!empty($row->satuan_kerja)){
				$kode_unit_kerja = $row->satuan_kerja;
			}
			if(!empty($row->satuan_organisasi)){
				$kode_unit_kerja = $row->satuan_organisasi;
			}
			if(!empty($row->unit_organisasi)){
				$kode_unit_kerja = $row->unit_organisasi;
			}
			if(!empty($row->unit_kerja)){
				$kode_unit_kerja = $row->unit_kerja;
			}
			
			$data_up = array(
				'kode_unit_kerja' => $kode_unit_kerja

			);				
			$this->db->where('id', $row->id);
			$update = $this->db->update($table, $data_up);
			if($update){
				echo "update  - ".$kode_unit_kerja."<br>";
			}
		
		}	
		echo "<br>DONE<br>";
		
	}
	
	//pegawai_riwayatjabatan, pegawai_jabatan, pegawai_tempatkerja
	function generate_id_jabatan($table)
    {
		$query = $this->db->get($table);
			
		foreach($query->result() as $row)
		{

			$data_up = array(
				'kode_unit_kerja' => $kode_unit_kerja

			);				
			$this->db->where('id', $row->id);
			$update = $this->db->update($table, $data_up);
			if($update){
				echo "update  - ".$kode_unit_kerja."<br>";
			}
		
		}	
		echo "<br>DONE<br>";
		
	}
	
	//    m/d/Y to Y-m-d
	function to_date_db($date='') 
	{
		if(!empty($date)){
			$dates = explode('/', $date);
			$tgl = $dates[1];
			$bln = $dates[0];
			$thn = $dates[2];
			
			if($tgl < 10){
				$tgl = '0'.$tgl;
			}
			if($bln < 10){
				$bln = '0'.$bln;
			}
			return $thn.'-'.$bln.'-'.$tgl;
		}else{
			return '';
		}
	}
	
	function date_jabatan()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai_jabatan');
		
		foreach($query->result_array() as $row)
		{
			$tgl_sk = $this->to_date_db($row['tgl_sk']);
			$tmt_jabatan = $this->to_date_db($row['tmt_jabatan']);
			$tgl_masuk_unit = $this->to_date_db($row['tgl_masuk_unit']);
			$tgl_pak = $this->to_date_db($row['tgl_pak']);
			
			$data_up = array(
					'tgl_sk' => $tgl_sk,
					'tmt_jabatan' => $tmt_jabatan,
					'tgl_masuk_unit' => $tgl_masuk_unit,
					'tgl_pak' => $tgl_pak
				);
			
			
			$this->db->where('id', $row['id']);
			$update = $this->db->update('pegawai_jabatan', $data_up);
		
			if($update){
				echo '== '.$tgl_sk.' == '.$tmt_jabatan.' == '.$tgl_masuk_unit.' == '.$tgl_pak.'<br>';
			}
		}		
	}
	
	function date_riwayatjabatan()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai_riwayatjabatan');
		
		foreach($query->result_array() as $row)
		{
			$tgl_sk = $this->to_date_db($row['tgl_sk']);
			$tmt_jabatan = $this->to_date_db($row['tmt_jabatan']);
			$tgl_masuk_unit = $this->to_date_db($row['tgl_masuk_unit']);
			$tgl_pak = $this->to_date_db($row['tgl_pak']);
			
			$data_up = array(
					'tgl_sk' => $tgl_sk,
					'tmt_jabatan' => $tmt_jabatan,
					'tgl_masuk_unit' => $tgl_masuk_unit,
					'tgl_pak' => $tgl_pak
				);
			
			
			$this->db->where('id', $row['id']);
			$update = $this->db->update('pegawai_riwayatjabatan', $data_up);
		
			if($update){
				echo '== '.$tgl_sk.' == '.$tmt_jabatan.' == '.$tgl_masuk_unit.' == '.$tgl_pak.'<br>';
			}
		}		
	}
	
	function date_kepangkatan()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai_kepangkatan');
		
		foreach($query->result_array() as $row)
		{
			$tmt_kepangkatan = $this->to_date_db($row['tmt_kepangkatan']);
			$tgl_sk = $this->to_date_db($row['tgl_sk']);
			
			$data_up = array(
					'tmt_kepangkatan' => $tmt_kepangkatan,
					'tgl_sk' => $tgl_sk
				);
			
			
			$this->db->where('id', $row['id']);
			$update = $this->db->update('pegawai_kepangkatan', $data_up);
		
			if($update){
				echo '== '.$tmt_kepangkatan.' == '.$tgl_sk.'<br>';
			}
		}		
	}
	
	function date_riwayatkepangkatan()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai_riwayatkepangkatan');
		
		foreach($query->result_array() as $row)
		{
			$tmt_kepangkatan = $this->to_date_db($row['tmt_kepangkatan']);
			$tgl_sk = $this->to_date_db($row['tgl_sk']);
			
			$data_up = array(
					'tmt_kepangkatan' => $tmt_kepangkatan,
					'tgl_sk' => $tgl_sk
				);
			
			
			$this->db->where('id', $row['id']);
			$update = $this->db->update('pegawai_riwayatkepangkatan', $data_up);
		
			if($update){
				echo '== '.$tmt_kepangkatan.' == '.$tgl_sk.'<br>';
			}
		}		
	}
	
	function date_kepegawaian()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai_kepegawaian');
		
		foreach($query->result_array() as $row)
		{
			$tmt_cpns = $this->to_date_db($row['tmt_cpns']);
			$tmt_pns = $this->to_date_db($row['tmt_pns']);
			$tmt_gol_terakhir = $this->to_date_db($row['tmt_gol_terakhir']);
			$tmt_kgb_terakhir = $this->to_date_db($row['tmt_kgb_terakhir']);
			
			$data_up = array(
					'tmt_cpns' => $tmt_cpns,
					'tmt_pns' => $tmt_pns,
					'tmt_gol_terakhir' => $tmt_gol_terakhir,
					'tmt_kgb_terakhir' => $tmt_kgb_terakhir,
					);
			
			$this->db->where('id', $row['id']);
			$update = $this->db->update('pegawai_kepegawaian', $data_up);
		
			if($update){
				echo '== '.$tmt_cpns.' = '.$tmt_pns.' = '.$tmt_gol_terakhir.' = '.$tmt_kgb_terakhir.'<br>';
			}
		}		
	}
	
	function date_riwayatpenghargaan()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai_riwayatpenghargaan');
		
		foreach($query->result_array() as $row)
		{
			$tgl_sk = $this->to_date_db($row['tgl_sk']);
			
			$data_up = array(
					'tgl_sk' => $tgl_sk
					);
			
			$this->db->where('id', $row['id']);
			$update = $this->db->update('pegawai_riwayatpenghargaan', $data_up);
		
			if($update){
				echo '== '.$tgl_sk.'<br>';
			}
		}		
	}
	
	function date_tempatkerja()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai_tempatkerja');
		
		foreach($query->result_array() as $row)
		{
			$tanggal_tugas = $this->to_date_db($row['tanggal_tugas']);
			$tmt_jabatan = $this->to_date_db($row['tmt_jabatan']);
			
			$data_up = array(
					'tanggal_tugas' => $tanggal_tugas,
					'tmt_jabatan' => $tmt_jabatan
					);
			
			$this->db->where('id', $row['id']);
			$update = $this->db->update('pegawai_tempatkerja', $data_up);
		
			if($update){
				echo '== '.$tanggal_tugas.' = '.$tmt_jabatan.'<br>';
			}
		}		
	}
	
	function clean_db()
	{
		$this->db->truncate('angkakredit_pertimbangan');
		$this->db->truncate('angkakredit_penetapan');
		$this->db->truncate('angkakredit_detail');
		$this->db->truncate('angkakredit');
		$this->db->truncate('bapeljakat_detail');
		$this->db->truncate('bapeljakat');
		$this->db->truncate('bapeljakat_periode');
		$this->db->truncate('cuti');
		$this->db->truncate('ibel');
		$this->db->truncate('kehadiran');
		$this->db->truncate('kenaikangajipegawai_dokumen');
		$this->db->truncate('kenaikangajipegawai');
		$this->db->truncate('kenaikanpangkat_dokumen');
		$this->db->truncate('lembur');
		$this->db->truncate('messages');
		$this->db->truncate('tubel');
		$this->db->truncate('surat_mutasi');
		$this->db->truncate('sisa_cuti');
		$this->db->truncate('permasalahan');
		$this->db->truncate('perjadin');
		$this->db->truncate('pensiun_dokumen');
		$this->db->truncate('pensiun');
		$this->db->truncate('pegawai_tempatkerja');
		$this->db->truncate('pegawai_suami_istri');
		$this->db->truncate('pegawai_riwayatpenghargaan');
		$this->db->truncate('pegawai_riwayatpendidikan');
		$this->db->truncate('pegawai_riwayatpelatihanteknis');
		$this->db->truncate('pegawai_riwayatpelatihanjabatan');
		$this->db->truncate('pegawai_riwayatkompetensi');
		$this->db->truncate('pegawai_riwayatkinerja');
		$this->db->truncate('pegawai_riwayatkepangkatan');
		$this->db->truncate('pegawai_riwayatkeluarga');
		$this->db->truncate('pegawai_riwayatjabatan');
		$this->db->truncate('pegawai_diklat_teknis');
		$this->db->truncate('pegawai_diklat_jabatan');
		$this->db->truncate('pegawai_pendidikan');
		$this->db->truncate('pegawai_mutasi');
		$this->db->truncate('pegawai_kepegawaian');
		$this->db->truncate('pegawai_kepangkatan');
		$this->db->truncate('pegawai_jabatan');
		$this->db->truncate('pegawai_dokumen');
		$this->db->truncate('pegawai_cetak_usulan_temp');
		$this->db->truncate('pegawai_cetak_usulan');
		$this->db->truncate('pegawai_anak');
		$this->db->truncate('pegawai');
	
		echo 'Data Pegawai sudah dikosongkan!!';
	
	}
	
}















