<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pensiun_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('pensiun');

		return $query->result_array();
	}
	
	function get_pensiun($id) {

		$this->db->select('a.*,c.nip_baru as nip_ttd,c.nama as nama_ttd, b.nama,b.nip_baru as nip,b.tempat_lahir, b.tanggal_lahir');
		$this->db->where('a.id', $id);
		$this->db->join('pegawai b','a.id_pegawai=b.id');
		$this->db->join('pegawai c','a.id_ttd=c.id');
		$query = $this->db->get('pensiun a');

		return $query->row_array();
	}

	function get_pensiun_forlist($id=''){
		$where_clause = '';
		$where_clause2 = '';
		if($id){
			$where_clause = ' AND id_pegawai = '.$id;
			$where_clause2 = ' AND a.id = '.$id;
		}else{
			$where_clause2 = " AND a.status = 'aktif'";
		}
		
		/*$query = $this->db->query("SELECT DISTINCT a.ids AS id,a.id_pegawai,b.nip_baru,
			b.tanggal_lahir, b.gelar_depan, b.nama, b.gelar_belakang,
			a.pangkat, a.golongan, a.jabatan,a.kantor,a.status_pensiun,a.status_masalah, '' as eselon,a.tmt_pensiun,
			a.bup,d.tmt_cpns
			FROM pensiun as a
			JOIN pegawai AS b ON a.id_pegawai=b.id
			JOIN pegawai_kepegawaian AS d ON b.id = d.id_pegawai 
			WHERE status_pensiun != 'SK Selesai' ".$where_clause." 
			UNION ALL
			SELECT DISTINCT 0 AS id,a.id AS id_pegawai,a.nip_baru AS nip_baru,a.tanggal_lahir,a.gelar_depan,a.nama,a.gelar_belakang,b.kepangkatan AS pangkat, b.golongan,
			f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor, '' AS status_pensiun, '' AS status_masalah, c.eselon,
			DATE_ADD(DATE_ADD(DATE_FORMAT(a.tanggal_lahir, '%Y-%m-%d'),INTERVAL g.bup YEAR),INTERVAL 1 MONTH) as tmt_pensiun,
			g.bup,d.tmt_cpns
			FROM pegawai AS a
			JOIN pegawai_kepangkatan AS b ON a.id = b.id_pegawai 
			LEFT JOIN pegawai_kepegawaian AS d ON a.id = d.id_pegawai 
			LEFT JOIN pegawai_jabatan AS c ON a.id = c.id_pegawai 
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN m_eselon AS g ON c.eselon = g.nama_eselon
			WHERE (NOT(a.id IN(SELECT pensiun.id_pegawai FROM pensiun WHERE status_pensiun != 'SK Selesai'  )))
			AND (DATE_ADD(DATE_FORMAT(a.tanggal_lahir, '%Y-%m-%d'),INTERVAL g.bup YEAR) <= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d'),INTERVAL 3 MONTH))
			".$where_clause2."
			");*/
		$query = $this->db->query("SELECT DISTINCT a.id AS id,a.id_pegawai,b.nip_baru,
			b.tanggal_lahir, b.gelar_depan, b.nama, b.gelar_belakang,
			a.pangkat, a.golongan, a.jabatan,a.kantor,a.status_pensiun,a.status_masalah, '' as eselon,a.tmt_pensiun,
			a.bup,d.tmt_cpns
			FROM pensiun as a
			JOIN pegawai AS b ON a.id_pegawai=b.id
			JOIN pegawai_kepegawaian AS d ON b.id = d.id_pegawai 
			WHERE status_pensiun != 'SK Selesai' ".$where_clause." 
			UNION ALL
			SELECT DISTINCT 0 AS id,a.id AS id_pegawai,a.nip_baru AS nip_baru,a.tanggal_lahir,a.gelar_depan,a.nama,a.gelar_belakang,b.kepangkatan AS pangkat, b.golongan,
			f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor, '' AS status_pensiun, '' AS status_masalah, c.eselon,
			DATE_ADD(DATE_ADD(DATE_FORMAT(a.tanggal_lahir, '%Y-%m-%d'),INTERVAL 56 YEAR),INTERVAL 1 MONTH) as tmt_pensiun,
			56 as bup,d.tmt_cpns
			FROM pegawai AS a
			LEFT JOIN pegawai_kepangkatan AS b ON a.id = b.id_pegawai 
			LEFT JOIN pegawai_kepegawaian AS d ON a.id = d.id_pegawai 
			LEFT JOIN pegawai_jabatan AS c ON a.id = c.id_pegawai 
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN m_eselon AS g ON c.eselon = g.nama_eselon
			WHERE (NOT(a.id IN(SELECT pensiun.id_pegawai FROM pensiun WHERE status_pensiun != 'SK Selesai'  )))
			AND (DATE_ADD(DATE_FORMAT(a.tanggal_lahir, '%Y-%m-%d'),INTERVAL 56 YEAR) <= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d'),INTERVAL 3 MONTH))
			".$where_clause2."
			");
		return $query->result_array();
	}
	
	function get_pensiun_histori(){
				
		$query = $this->db->query("SELECT a.id,a.id_pegawai,b.nip_baru,b.nama,
			a.pangkat,a.jabatan,a.kantor, a.tanggal_sk, a.tmt_pensiun, 
			a.status_pensiun, status_masalah
			FROM pensiun as a
			JOIN pegawai as b ON a.id_pegawai=b.id
			WHERE a.status_pensiun = 'SK Selesai' 
			");
	
		return $query->result_array();
	}
	
	function get_pensiun_check($id){
		$where_clause = '';
		$id = str_replace('_',',', $id);
		if($id){
			$where_clause = ' AND a.id IN ('.$id.')';
		}
		
		$query = $this->db->query("SELECT a.*,b.nama,b.nip_baru as nip
			FROM pensiun as a
			JOIN pegawai as b ON a.id_pegawai=b.id
			WHERE a.status_pensiun = 'SK Selesai' ".$where_clause."
			");
	
		return $query->result();
	}
	
	function get_dokumen($id_peg=''){
		$addwhere = '';
		if(!empty($id_peg)){
		
			$query = $this->db->query("SELECT a.id, a.id_tipe_dokumen, b.tipe_dokumen, c.nama_dokumen, c.filename, c.id
								FROM persyaratan_dokumen AS a 
								INNER JOIN tipe_dokumen AS b ON a.id_tipe_dokumen=b.id 
								LEFT JOIN pegawai_dokumen AS c ON a.id_tipe_dokumen = c.tipe_dokumen AND c.pegawai_id='".$id_peg."' 
								WHERE a.nama_module='PENSIUN' ");
								
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
	
	public function get_tipe_dokumen($id = '')
	{
		if(!empty($id)){
			$this->db->where('id', $id);
		}

		$this->db->order_by('id','ASC');
		$query = $this->db->get('tipe_dokumen');
		
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
	
	public function insert_pensiun($data, $id_pegawai)
	{
		$this->db->trans_start();
		
		$updt = $this->db->insert('pensiun', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function update_pensiun($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pensiun', $data);
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	
	public function update_pensiun_by_nip($data, $nip)
	{
		$this->db->trans_start();
		
		$this->db->where('nip', $nip);
		$update = $this->db->update('pensiun', $data);
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function update_pensiun_by_id($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pensiun', $data);
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	
	public function del_pensiun($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pensiun');
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
	
	public function insert_pensiun_dokumen($data, $id_pensiun, $id_tipe_dokumen)
	{
		$this->db->trans_start();
		
		$this->db->where('id_pensiun', $id_pensiun);
		$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
		$cek = $this->db->get('pensiun_dokumen');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pensiun', $id_pensiun);
			$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
			$updt = $this->db->update('pensiun_dokumen', $data);
		}else{
			$updt = $this->db->insert('pensiun_dokumen', $data);
		}
		
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function del_pensiun_dokumen_bypensiun($id_pensiun)
	{
		$this->db->where('id_pensiun', $id_pensiun);
		$this->db->delete('pensiun_dokumen');
	}
	
}