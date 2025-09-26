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
		
		//echo $periode_kepangkatan_min.'#'.$periode_kepangkatan_max;
		
		//ewars -> max pangkat (4 tahun) -> dari pegawai_kepangkatan
		$date_ewars_min = date('Y-m-d', mktime(0,0,1,date('m', strtotime($periode_kepangkatan_min))-48, date('d', strtotime($periode_kepangkatan_min)), date('Y', strtotime($periode_kepangkatan_min)))); 
		$date_ewars_max = date('Y-m-d', mktime(23,59,59,date('m', strtotime($periode_kepangkatan_min))-43, date('d', strtotime($periode_kepangkatan_max)), date('Y', strtotime($periode_kepangkatan_min)))); 
		
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
		
		//KEPANGKATAN 4 TAHUN
		//PERPERIODE(APRIl/OKTOBER) MAX-4 TAHUN
		$where_data[] = "(b.tmt_kepangkatan >=  '".$date_ewars_min."' AND b.tmt_kepangkatan <=  '".$date_ewars_max."')";
		
		//PEGAWAI NOT IN-SELESAI
		/*
		$where_data[] = "
		(NOT(a.nip_baru IN(
			SELECT DISTINCT(nip_baru) 
			FROM pegawai_riwayatkepangkatan  
			WHERE status_kp != 'SK Selesai' 
			AND tmt_kepangkatan >=  '".$date_ewars_min."' AND tmt_kepangkatan <=  '".$date_ewars_max."'
		)))
		";
		*/
		//$where_data[] = "kp.status_kp != 'SK Selesai'"; 
		
		
		$where_clause2 = '';		
		if(!empty($where_data)){
			$where_clause2 = ' AND '.implode(' AND ', $where_data);
		}
		
		$query = $this->db->query("
			SELECT  a.id AS id,  c.id AS id_pegawai,  a.nip_baru AS nip_baru,  c.nama AS nama,  b.kepangkatan AS pangkat,  
				f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor,  c.kode_unit_kerja AS kode_unit_kerja,  
				status_kp, status_masalah, periode, b.golongan, b.tmt_kepangkatan, 
				p.strata, sp.golongan_max, d.gol_terakhir, 'pilihan' as tipe_kp
			FROM pegawai_riwayatkepangkatan as a
			JOIN pegawai_kepangkatan AS b ON a.nip_baru = b.nip_baru
			LEFT JOIN pegawai_jabatan as c ON a.nip_baru = c.nip_baru
			LEFT JOIN pegawai_kepegawaian AS d ON a.nip_baru = d.nip_baru 
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN m_status_jabatan as f2 ON f2.id_status_jabatan = f.id_status_jabatan
			LEFT JOIN pegawai_pendidikan  AS p ON a.nip_baru = p.nip_baru
			LEFT JOIN m_strata_pendidikan AS sp ON p.strata = sp.id_strata
			WHERE a.status_kp != 'SK Selesai' AND a.is_last = 'Ya'
			".$where_clause1."
			
			UNION ALL
			
			SELECT  '' AS id,  a.id AS id_pegawai,  a.nip_baru AS nip_baru,  a.nama AS nama,  b.kepangkatan AS pangkat,  
				f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor,  c.kode_unit_kerja AS kode_unit_kerja,  
				'' AS status_kp, '' AS status_masalah, '' AS periode, b.golongan, b.tmt_kepangkatan, 
				p.strata, sp.golongan_max, d.gol_terakhir, 'pegawai' as tipe_kp
			FROM pegawai AS a
			JOIN pegawai_kepangkatan AS b ON a.nip_baru = b.nip_baru 
			JOIN pegawai_kepegawaian AS d ON a.nip_baru = d.nip_baru 
			JOIN pegawai_jabatan AS c ON a.nip_baru = c.nip_baru 			
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN m_status_jabatan as f2 ON f2.id_status_jabatan = f.id_status_jabatan
			LEFT JOIN pegawai_pendidikan AS p ON a.nip_baru = p.nip_baru 
			LEFT JOIN m_strata_pendidikan AS sp ON sp.id_strata = p.strata
			WHERE f2.id_status_jabatan = 1 AND a.status = 'aktif'
			AND (NOT(a.nip_baru IN(SELECT  nip_baru  FROM pegawai_riwayatkepangkatan  
						WHERE is_last = 'Ya' AND status_kp != 'SK Selesai'
					))
				)
			".$where_clause2."
			
			ORDER BY tmt_kepangkatan ASC
		");
		
		/*
		LEFT JOIN pegawai_riwayatkepangkatan AS kp ON 
			kp.id = (SELECT DISTINCT(id) 
					FROM pegawai_riwayatkepangkatan  
					WHERE nip_baru = a.nip_baru AND is_last = 'Ya' AND status_kp != 'SK Selesai' 
				)
		*/
		
		/* BU
		SELECT  a.id AS id,  c.id AS id_pegawai,  a.nip_baru AS nip_baru,  c.nama AS nama,  a.kepangkatan AS pangkat,  
				f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor,  c.kode_unit_kerja AS kode_unit_kerja,  
				status_kp, status_masalah, periode, a.golongan, a.tmt_kepangkatan, sp.level
			FROM pegawai_riwayatkepangkatan as a
			LEFT JOIN pegawai_jabatan as c ON a.nip_baru = c.nip_baru
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN pegawai_pendidikan  AS p ON a.nip_baru = p.nip_baru
			LEFT JOIN m_strata_pendidikan AS sp ON p.strata = sp.id_strata
			WHERE a.status_kp != 'SK Selesai' ".$where_clause2." 
			UNION ALL
			SELECT  0 AS id,  a.id AS id_pegawai,  a.nip_baru AS nip_baru,  a.nama AS nama,  b.kepangkatan AS pangkat,  
				f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor,  c.kode_unit_kerja AS kode_unit_kerja,  
				'' AS status_kp, '' as status_masalah, '' as periode, b.golongan, b.tmt_kepangkatan, sp.level
			FROM pegawai AS a
			JOIN pegawai_kepangkatan AS b ON a.nip_baru = b.nip_baru 
			JOIN pegawai_kepegawaian AS d ON a.nip_baru = d.nip_baru 
			JOIN pegawai_jabatan AS c ON a.nip_baru = c.nip_baru 
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN pegawai_pendidikan  AS p ON a.nip_baru = p.nip_baru
			LEFT JOIN m_strata_pendidikan AS sp ON p.strata = sp.id_strata
			WHERE ((((b.tmt_kepangkatan - INTERVAL - (4)YEAR) - INTERVAL 5 MONTH) <= NOW())  
				AND (NOT(a.nip_baru IN(SELECT  nip_baru  FROM pegawai_riwayatkepangkatan  
						WHERE status_kp != 'SK Selesai'
					))
				))
				".$where_clause2."
			ORDER BY level DESC, golongan ASC
		*/
		return $query->result_array();
	}
	
	function get_histori_kenaikanpangkat($id='', $nip_baru='', $bulan='', $tahun='')
	{
		if($bulan == 'undefined'){
			$tahun = date('m');
		}
		if($tahun == 'undefined'){
			$tahun = date('Y');
		}
		
		$this->db->select('a.*, b.id as id_pegawai, b.nama, f.nama_jabatan as jabatan, e.nama_unit_kerja as kantor')
				->from('pegawai_riwayatkepangkatan as a')
				->join('pegawai as b', 'a.nip_baru = b.nip_baru', 'LEFT', false)
				->join('pegawai_jabatan as c', 'a.nip_baru = c.nip_baru', 'LEFT', false)
				->join('m_unit_kerja as e','c.kode_unit_kerja = e.kode_unit_kerja', 'LEFT', false)	
				->join('m_jabatan as f','c.id_jabatan = f.id_jabatan', 'LEFT', false);
				
		$this->db->where('a.status_kp', 'SK Selesai');
		
		if(!empty($id)){
			$this->db->where('a.id', $id);			
		}
		if(!empty($nip_baru)){
			$this->db->where('a.nip_baru', $nip_baru);
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
	
	function get_kp($pegawai_id, $id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('pegawai_riwayatkepangkatan');
		
		return $query->row_array();
	}
	
	
	function get_pegawai($pegawai_id = '') 
	{

				$this->db->select('a.id, a.nama, a.nip_baru, f.nama_jabatan, b.kode_unit_kerja, b.eselon, 
							e.nama_unit_kerja, c.status_kepegawaian, c.gol_terakhir, d.kepangkatan, d.tmt_kepangkatan')
				->from('pegawai as a', false)
				->join('pegawai_jabatan as b', 'a.nip_baru = b.nip_baru', false)
				->join('pegawai_kepegawaian as c','a.nip_baru = c.nip_baru', false)
				->join('pegawai_kepangkatan as d','a.nip_baru = d.nip_baru', false)
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
								LEFT JOIN pegawai_dokumen AS c ON c.tipe_dokumen=a.id_tipe_dokumen AND c.id_pegawai= ".$id_peg." 
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
	
	public function insert_kp_dokumen($data, $id_kp, $id_tipe_dokumen)
	{
		$this->db->trans_start();
		
		$this->db->where('id_kp', $id_kp);
		$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
		$cek = $this->db->get('kenaikanpangkat_dokumen');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_kp', $id_kp);
			$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
			$updt = $this->db->update('kenaikanpangkat_dokumen', $data);
		}else{
			$updt = $this->db->insert('kenaikanpangkat_dokumen', $data);
		}
		
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function del_kp_dokumen_bykp($id_kp)
	{
		$this->db->where('id_kp', $id_kp);
		$this->db->delete('kenaikanpangkat_dokumen');
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
}