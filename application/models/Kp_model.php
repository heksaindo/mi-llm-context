<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kp_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	
	function get_all() {
		$query = $this->db->get('pegawai');

		return $query->result_array();
	}
	
	function get_kenaikanpangkat($bulan='', $tahun='')
	{
		
		extract($_GET);		
		
		$date_today = date('Y-m-d');
		$month_today = date('m');
		$periode_year = date('Y');
		
		if(!empty($bulan)){
			if($bulan == 'April'){
				$month_today = '04';
			}
			if($bulan == 'Oktober'){
				$month_today = '10';
			}
		}
		
		//echo $month_today;
		if(!empty($tahun)){
			$periode_year = $tahun;
		}
				
		//periode - april
		$periode_april = array('11','12','01','02','03','04');		
		
		//periode - oktober
		$periode_oktober = array('05','06','07','08','09','10');		
		
		
		if(in_array($month_today, $periode_april)){
			$periode_kepangkatan_min = ($periode_year-1).'-11-01';
			$periode_kepangkatan_max = $periode_year.'-04-30';
			
			if($month_today == '11' OR $month_today == '12'){
				$periode_year += 1;
				$periode_kepangkatan_max = $periode_year.'-04-30';
			}
						
		}else{
			$periode_kepangkatan_min = $periode_year.'-05-01';
			$periode_kepangkatan_max = $periode_year.'-10-30';
		}
		
		$where_data = array();
		//STRUKTURAL - OK
		$where_data[] = 'f2.id_status_jabatan = 1'; 
		
		if(!empty($id_strata)){
			$where_data[] = "sp.id_strata = ".$id_strata; 
		}
		
		
		$where_clause1 = '';		
		if(!empty($where_data)){
			$where_clause1 = ' AND '.implode(' AND ', $where_data);
		}

		
		$query = $this->db->query("
			SELECT a.id AS id,  c.id_pegawai,  pg.nip_baru,  pg.nama,  b.kepangkatan AS pangkat,  
				f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor,  c.kode_unit_kerja AS kode_unit_kerja,  
				status_kp, status_masalah, periode, b.golongan, b.tmt_kepangkatan, 
				p.strata,sp.nama_strata, sp.golongan_max, d.gol_terakhir, 'pilihan' as tipe_kp
			FROM pegawai_riwayatkepangkatan as a
			JOIN pegawai_kepangkatan AS b ON a.pegawai_id = b.id_pegawai
			JOIN pegawai AS pg ON b.id_pegawai=pg.id
			LEFT JOIN pegawai_jabatan as c ON a.pegawai_id = c.id_pegawai
			LEFT JOIN pegawai_kepegawaian AS d ON a.pegawai_id = d.id_pegawai 
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN m_status_jabatan as f2 ON f2.id_status_jabatan = d.jenis_kepegawaian
			LEFT JOIN pegawai_pendidikan  AS p ON a.pegawai_id = p.id_pegawai
			LEFT JOIN m_strata_pendidikan AS sp ON p.strata = sp.id_strata
			WHERE a.status_kp != 'SK Selesai' AND a.is_last = 'Ya'
			".$where_clause1."
			
			UNION ALL
			
			SELECT  '' AS id,  a.id AS id_pegawai,  a.nip_baru AS nip_baru,  a.nama AS nama,  b.kepangkatan AS pangkat,  
				f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor,  c.kode_unit_kerja AS kode_unit_kerja,  
				'' AS status_kp, '' AS status_masalah, '' AS periode, b.golongan, d.tmt_gol_terakhir as tmt_kepangkatan, 
				p.strata,sp.nama_strata, sp.golongan_max, d.gol_terakhir, 'pegawai' as tipe_kp
			FROM pegawai AS a
			LEFT JOIN pegawai_kepangkatan AS b ON a.id = b.id_pegawai 
			LEFT JOIN pegawai_kepegawaian AS d ON a.id = d.id_pegawai 
			LEFT JOIN pegawai_jabatan AS c ON a.id = c.id_pegawai 			
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN m_status_jabatan as f2 ON f2.id_status_jabatan = d.jenis_kepegawaian
			LEFT JOIN pegawai_pendidikan AS p ON a.id = p.id_pegawai 
			LEFT JOIN m_strata_pendidikan AS sp ON sp.id_strata = p.strata
			WHERE f2.id_status_jabatan = 1 AND a.status = 'aktif'
			AND (NOT(a.id IN(SELECT  pegawai_id  FROM pegawai_riwayatkepangkatan  
						WHERE is_last = 'Ya' AND status_kp != 'SK Selesai'
					))
				)
			AND
			(
			sp.golongan_max <> d.gol_terakhir OR d.gol_terakhir='' OR d.gol_terakhir IS NULL OR sp.golongan_max='' OR sp.golongan_max IS NULL
			)
			AND
			(
							(
								(
									DATE_ADD(
										DATE_FORMAT(
										d.tmt_gol_terakhir, '%Y-%m-%d'),
										INTERVAL 4 YEAR
									) <= DATE_ADD(
										DATE_FORMAT(NOW(), '%Y-%m-%d'),
										INTERVAL 3 MONTH
									)
								)
							)
							OR (
								d.tmt_gol_terakhir = ''
								OR d.tmt_gol_terakhir IS NULL
								OR d.tmt_gol_terakhir='0000-00-00'
							)
			)
			
			ORDER BY tmt_kepangkatan ASC
		");
		
		return $query->result_array();
	}
	
	/*
	function get_kenaikanpangkats($bulan='', $tahun='')
	{
		$query = $this->db->query("
						SELECT
						ri.id,ri.status_kp,ri.status_masalah,
						pk.id_pegawai,p.nama,p.gelar_depan,
						p.gelar_belakang,p.nip_baru,
						pj.id_jabatan,mj.nama_jabatan AS jabatan,
						mu.nama_unit_kerja AS kantor,pkp.kepangkatan AS pangkat,
						pk.gol_terakhir,pk.masa_kerja_golongan AS masa_kerja,
						pk.masa_kerja_tahun,pk.masa_kerja_bulan,
						pk.gapok_terakhir,pkp.no_sk,
						pkp.tgl_sk AS tanggal_sk,pkp.pejabat_penandatangan AS pejabat_penetapan,
						pk.tmt_kgb_terakhir AS tmt_kgb,pkp.tmt_kepangkatan,pp.strata, sp.golongan_max
						FROM
						pegawai_kepegawaian AS pk
						INNER JOIN pegawai AS p ON pk.id_pegawai = p.id
						LEFT JOIN pegawai_kepangkatan AS pkp ON pk.id_pegawai = pkp.id_pegawai
						LEFT JOIN pegawai_jabatan AS pj ON pk.id_pegawai = pj.id_pegawai
						LEFT pegawai_kepangkatan AS pegk ON pk.id_pegawai = pegk.id_pegawai
						LEFT JOIN pegawai_riwayatkepangkatan as ri ON pegk.id_pegawai = ri.pegawai_id
						LEFT JOIN m_unit_kerja AS mu ON pj.kode_unit_kerja = mu.kode_unit_kerja
						LEFT JOIN m_jabatan AS mj ON pj.id_jabatan = mj.id_jabatan
						LEFT JOIN pegawai_pendidikan AS pp ON p.id = pp.id_pegawai 
						LEFT JOIN m_strata_pendidikan AS sp ON sp.id_strata = pp.strata
						WHERE
						p.`status` = 'aktif'
						AND (
							(
								(
									DATE_ADD(
										DATE_FORMAT(
										pk.tmt_gol_terakhir, '%Y-%m-%d'),
										INTERVAL 4 YEAR
									) <= DATE_ADD(
										DATE_FORMAT(NOW(), '%Y-%m-%d'),
										INTERVAL 3 MONTH
									)
								)
							)
							OR (
								pk.tmt_gol_terakhir = ''
								OR pk.tmt_gol_terakhir IS NULL
							)
						)
						");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '';
		}
	}*/
	
	function get_histori_kenaikanpangkat($id='', $nip_baru='', $bulan='', $tahun='')
	{
		if($bulan == 'undefined'){
			$tahun = date('m');
		}
		if($tahun == 'undefined'){
			$tahun = date('Y');
		}
		
		$this->db->select('a.*, b.id as id_pegawai, b.nama,b.nip_baru, f.nama_jabatan as jabatan, e.nama_unit_kerja as kantor')
				->from('pegawai_riwayatkepangkatan as a')
				->join('pegawai as b', 'a.pegawai_id = b.id', 'LEFT', false)
				->join('pegawai_jabatan as c', 'a.pegawai_id = c.id_pegawai', 'LEFT', false)
				->join('m_unit_kerja as e','c.kode_unit_kerja = e.kode_unit_kerja', 'LEFT', false)	
				->join('m_jabatan as f','c.id_jabatan = f.id_jabatan', 'LEFT', false);
				
		$this->db->where('a.status_kp', 'SK Selesai');
		
		if(!empty($id)){
			$this->db->where('a.id', $id);			
		}
		if(!empty($nip_baru)){
			$this->db->where('b.nip_baru', $nip_baru);
		}
		if(!empty($bulan)){
			$this->db->where('a.periode', $bulan);
		}
		if(!empty($tahun)){
			//$this->db->where('a.periode_thn', $tahun);
		}
		$this->db->order_by('a.tmt_kepangkatan', 'DESC');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
				
		}else{
			return '';
		}
		
	}
	
	function get_kp($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('pegawai_riwayatkepangkatan');
		
		return $query->row_array();
	}
	
	function get_pegawai_data($id = '') 
	{

		$this->db->select('a.id, a.nama, a.nip_lama, a.nip_baru, b.kode_unit_kerja, b.eselon, c.status_kepegawaian, c.gol_terakhir')
				->from('pegawai as a', false)
				->join('pegawai_jabatan as b', 'a.id = b.id_pegawai', false)
				->join('pegawai_kepegawaian as c','a.id = c.id_pegawai', false);
				
		if(!empty($id)){
			$this->db->where('a.id', $id);
		}
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
				
		}else{
			return '';
		}
		
	}
	
	function get_pegawai($pegawai_id = '') 
	{

		$this->db->select('a.id, a.nama, a.nip_lama, a.nip_baru, f.nama_jabatan, b.kode_unit_kerja, b.eselon, 
						e.nama_unit_kerja, c.status_kepegawaian, c.gol_terakhir, d.kepangkatan, d.tmt_kepangkatan')
			->from('pegawai as a', false)
			->join('pegawai_jabatan as b', 'a.id = b.id_pegawai', false)
			->join('pegawai_kepegawaian as c','a.id = c.id_pegawai', false)
			->join('pegawai_kepangkatan as d','a.id = d.id_pegawai', false)
			->join('m_unit_kerja as e','b.kode_unit_kerja = e.kode_unit_kerja', 'LEFT', false)	
			->join('m_jabatan as f','b.id_jabatan = f.id_jabatan', 'LEFT', false);	
				
		if(!empty($pegawai_id)){
			$this->db->where('a.id', $pegawai_id);
		}
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result_array();
				
		}else{
			return '';
		}
		
	}
	
	function get_dokumen($id_peg=''){
		$addwhere = '';
		if(!empty($id_peg)){
		
			$query = $this->db->query("SELECT a.id, a.id_tipe_dokumen, b.tipe_dokumen, c.nama_dokumen, c.filename, c.id
								FROM persyaratan_dokumen AS a 
								INNER JOIN tipe_dokumen AS b ON a.id_tipe_dokumen=b.id 
								LEFT JOIN pegawai_dokumen AS c ON c.tipe_dokumen=a.id_tipe_dokumen AND c.pegawai_id= ".$id_peg." 
								WHERE a.nama_module='KP' ");
								
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
		
	function get_dokumen2($id_kp=''){
		$addwhere = '';
		if(!empty($id_kp)){
		
			$query = $this->db->query("SELECT a.id, a.id_tipe_dokumen, b.tipe_dokumen, c.nama_dokumen, c.filename, c.id, c.id_kp
								FROM persyaratan_dokumen AS a 
								INNER JOIN tipe_dokumen AS b ON a.id_tipe_dokumen=b.id 
								LEFT JOIN pegawai_riwayat_kp_dokumen AS c ON c.id_tipe_dokumen=a.id_tipe_dokumen AND c.id_kp= ".$id_kp."
								WHERE a.nama_module='KP' ");
								
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	
	public function insert_kp($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('pegawai_riwayatkepangkatan', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	function update_riwayat_kp($data, $id)
	{
		$this->db->trans_start();

		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatkepangkatan', $data, false);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	function update_riwayat_kp_bynip($data, $nip_baru)
	{
		$this->db->trans_start();

		$this->db->where('nip_baru', $nip_baru);
		$update = $this->db->update('pegawai_riwayatkepangkatan', $data, false);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	function update_riwayat_kp_by_pegawai($data, $id)
	{
		$this->db->trans_start();

		$this->db->where('pegawai_id', $id);
		$update = $this->db->update('pegawai_riwayatkepangkatan', $data, false);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	function update_kenaikanpangkat($data, $nip)
	{
		$this->db->trans_start();

		$this->db->where('nip_baru', $nip);
		$update = $this->db->update('pegawai_kepangkatan', $data, false);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function cek_kepegawaian($data, $nip)
	{
		$this->db->trans_start();
		
		$this->db->where('nip_baru', $nip);
		$cek = $this->db->get('pegawai_kepegawaian');
		
		if ($cek->num_rows() > 0){
			$this->db->where('nip_baru', $nip);
			$updt = $this->db->update('pegawai_kepegawaian', $data);
		}else{
			$updt = $this->db->insert('pegawai_kepegawaian', $data);
		}
		
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function ddl_golongan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_golongan', $id);
		}
		// id_golongan, nama_golongan, level
		$this->db->order_by('id_golongan','ASC');
		$query = $this->db->get('m_golongan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	public function ddl_jabatan_ttd($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_jabatan', $id);
		}
		$this->db->where('id_status_jabatan', 1);
		$this->db->order_by('id_jabatan','ASC');
		$query = $this->db->get('m_jabatan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	
	public function cek_kepangkatan($data, $nip_baru)
	{
		$this->db->trans_start();

		$this->db->where('nip_baru', $nip_baru);
		$cek = $this->db->get('pegawai_kepangkatan');
		
		if ($cek->num_rows() > 0){
			$this->db->where('nip_baru', $nip_baru);
			$updt = $this->db->update('pegawai_kepangkatan', $data);
		}else{
			$updt = $this->db->insert('pegawai_kepangkatan', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	
	public function data_pendidikan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_strata', $id);
		}
		// id_strata, nama_strata
		$this->db->order_by('level','DESC');
		$query = $this->db->get('m_strata_pendidikan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	
	
	public function insert_kp_dokumen($data, $id_kp, $id_tipe_dokumen)
	{
		$this->db->trans_start();
		
		$this->db->where('id_kp', $id_kp);
		$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
		$cek = $this->db->get('pegawai_riwayat_kp_dokumen');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_kp', $id_kp);
			$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
			$updt = $this->db->update('pegawai_riwayat_kp_dokumen', $data);
		}else{
			$updt = $this->db->insert('pegawai_riwayat_kp_dokumen', $data);
		}
		
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function del_kp_dokumen_bykp($id_kp)
	{
		$this->db->where('id_kp', $id_kp);
		$this->db->delete('pegawai_riwayat_kp_dokumen');
	}
	
	
}