<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kgp_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('pegawai_riwayat_kgb');

		return $query->result_array();
	}
	
	function get_kgp($kgp_id) {
		$this->db->where('a.id', $kgp_id);
		$this->db->join('pegawai b', 'a.id_pegawai=b.id');
		$query = $this->db->get('pegawai_riwayat_kgb a');

		return $query->row_array();
	}
	function peg_kepegawaian($id_peg) {
		$this->db->where('id', $id_peg);
		$query = $this->db->get('pegawai_riwayat_kgb');

		return $query->row_array();
	}
	
	function getEditKgp($kgp_id){
		$this->db->select('a.*,b.nama,b.nip_baru,b.gelar_depan,b.gelar_belakang,
						  c.nama as nama_ttd,c.nip_baru as nip_ttd,d.kdkelgapok');
		$this->db->from('pegawai_riwayat_kgb AS a');
		$this->db->join('pegawai AS b', 'a.id_pegawai=b.id');
		$this->db->join('pegawai AS c', 'a.id_ttd=c.id');
		$this->db->join('m_golongan AS d', 'a.golongan=d.kode_golongan','LEFT');
		$this->db->where('a.id', $kgp_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function get_kgp_forlist()
	{
		$query = $this->db->query("
						SELECT
						pk.id_pegawai,p.nama,p.gelar_depan,
						p.gelar_belakang,p.nip_baru,
						pj.id_jabatan,mj.nama_jabatan AS jabatan,
						mu.nama_unit_kerja AS kantor,pkp.kepangkatan AS pangkat,
						pk.gol_terakhir AS golongan,
						pk.masa_kerja_tahun,pk.masa_kerja_bulan,
						pk.gapok_terakhir,pkp.no_sk,
						pkp.tgl_sk AS tanggal_sk,pkp.pejabat_penandatangan AS pejabat_penetapan,
						pk.tmt_kgb_terakhir AS tmt_kgb,pkp.tmt_kepangkatan AS tmt_kp
						FROM
						pegawai_kepegawaian AS pk
						INNER JOIN pegawai AS p ON pk.id_pegawai = p.id
						LEFT JOIN pegawai_kepangkatan AS pkp ON pk.id_pegawai = pkp.id_pegawai
						LEFT JOIN pegawai_jabatan AS pj ON pk.id_pegawai = pj.id_pegawai
						LEFT JOIN m_unit_kerja AS mu ON pj.kode_unit_kerja = mu.kode_unit_kerja
						LEFT JOIN m_jabatan AS mj ON pj.id_nama_jabatan = mj.id_jabatan
						WHERE
						p.`status` = 'aktif'
						AND (
							(
								(
									DATE_ADD(
										DATE_FORMAT(
										pk.tmt_kgb_terakhir, '%Y-%m-%d'),
										INTERVAL 2 YEAR
									) <= DATE_ADD(
										DATE_FORMAT(NOW(), '%Y-%m-%d'),
										INTERVAL 3 MONTH
									)
								)
							)
							OR (
								pk.tmt_kgb_terakhir = ''
								OR pk.tmt_kgb_terakhir IS NULL
								OR pk.tmt_kgb_terakhir='0000-00-00'
							)
						)
						");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '';
		}
		
	}
	
	
	function get_kgp_forlist_ol()
	{
		$query = $this->db->query("
						SELECT
						pk.id_pegawai,p.nama,p.gelar_depan,
						p.gelar_belakang,p.nip_baru,
						pj.id_jabatan,mj.nama_jabatan AS jabatan,
						mu.nama_unit_kerja AS kantor,pkp.kepangkatan AS pangkat,
						pk.gol_terakhir AS golongan,pk.masa_kerja_golongan AS masa_kerja,
						pk.masa_kerja_tahun,pk.masa_kerja_bulan,
						pk.gapok_terakhir,pkp.no_sk,
						pkp.tgl_sk AS tanggal_sk,pkp.pejabat_penandatangan AS pejabat_penetapan,
						pk.tmt_kgb_terakhir AS tmt_kgb,pkp.tmt_kepangkatan AS tmt_kp
						FROM
						pegawai_kepegawaian AS pk
						INNER JOIN pegawai AS p ON pk.id_pegawai = p.id
						INNER JOIN pegawai_kepangkatan AS pkp ON pk.id_pegawai = pkp.id_pegawai
						INNER JOIN pegawai_jabatan AS pj ON pk.id_pegawai = pj.id_pegawai
						LEFT JOIN m_unit_kerja AS mu ON pj.kode_unit_kerja = mu.kode_unit_kerja
						LEFT JOIN m_jabatan AS mj ON pj.id_jabatan = mj.id_jabatan
						INNER JOIN pegawai_riwayat_kgb AS rkg ON pk.id_pegawai = rkg.id_pegawai
						WHERE
						p.`status` = 'aktif' AND
						(DATE_ADD(pk.tmt_kgb_terakhir,INTERVAL 2 YEAR) <= DATE_ADD(DATE_FORMAT(NOW(),'%Y-%m-%d'),INTERVAL 3 MONTH))
						");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '';
		}
		
	}
	
	function get_histori_kgp()
	{
		$query = $this->db->query("SELECT  a.*,b.nama,b.nip_baru FROM pegawai_riwayat_kgb AS a JOIN pegawai AS b ON a.id_pegawai = b.id ORDER BY a.id DESC");

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '';
		}
	}
	
	function get_pegawai($pegawai_id = '') {

				$this->db->select('a.id as id_pegawai, a.gelar_depan,a.nama, a.gelar_belakang, a.nip_baru, f.nama_jabatan, b.eselon, f.nama_jabatan as jabatan,
							e.nama_unit_kerja as kantor, c.status_kepegawaian, c.gol_terakhir, d.kepangkatan, d.tmt_kepangkatan,
							c.gapok_terakhir AS gapok_lama, c.masa_kerja_tahun, c.masa_kerja_bulan, c.tmt_gol_terakhir,c.tmt_kgb_terakhir,
							d.no_sk AS no_sk, 
							d.tgl_sk AS tanggal_sk, 
							d.pejabat_penandatangan AS pejabat_penetapan,
							d.tmt_kepangkatan,
							h.daper,h.kdkelgapok
							')
				->from('pegawai as a', false)
				->join('pegawai_jabatan as b', 'a.id = b.id_pegawai', false)
				->join('pegawai_kepegawaian as c','a.id = c.id_pegawai', false)
				->join('pegawai_kepangkatan as d','a.id = d.id_pegawai', false)
				->join('m_unit_kerja as e','b.kode_unit_kerja = e.kode_unit_kerja', 'LEFT', false)
				->join('m_jabatan as f','b.id_jabatan = f.id_jabatan', 'LEFT', false)
				->join('m_golongan as g', 'c.gol_terakhir = g.kode_golongan', 'LEFT')
				->join('m_gapok as h', 'g.kdkelgapok = h.kdkelgapok', 'LEFT');
		if(!empty($pegawai_id)){
			$this->db->where('a.id', $pegawai_id);
		}
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
				
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
								LEFT JOIN pegawai_dokumen AS c ON a.id_tipe_dokumen=c.tipe_dokumen AND c.pegawai_id= ".$id_peg." 
								WHERE a.nama_module='KGB' ");
								
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
	
	public function insert_kgp($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('pegawai_riwayat_kgb', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function update_kgp($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayat_kgb', $data);
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function insert_kgp_dokumen_old($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('pegawai_riwayat_kgb_dokumen', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function insert_kgp_dokumen($data, $kgp_id, $id_tipe_dokumen)
	{
		$this->db->trans_start();
		
		$this->db->where('id_kgp', $kgp_id);
		$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
		$cek = $this->db->get('pegawai_riwayat_kgb_dokumen');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_kgp', $kgp_id);
			$this->db->where('id_tipe_dokumen', $id_tipe_dokumen);
			$updt = $this->db->update('pegawai_riwayat_kgb_dokumen', $data);
		}else{
			$updt = $this->db->insert('pegawai_riwayat_kgb_dokumen', $data);
		}
		
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function del_kgp_dokumen_bykgp($kgp_id)
	{
		$this->db->where('id_kgp', $kgp_id);
		$this->db->delete('pegawai_riwayat_kgb_dokumen');
	}
	
	public function del_kgp($kgp_id)
	{
		$this->db->where('id', $kgp_id);
		$this->db->delete('pegawai_riwayat_kgb');
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
	
	public function cek_kepegawaian($data, $id_pegawai)
	{
		$this->db->trans_start();
		
		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_kepegawaian');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_kepegawaian', $data);
		}else{
			$updt = $this->db->insert('pegawai_kepegawaian', $data);
		}
		
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function cek_kepangkatan($data, $id_pegawai)
	{
		$this->db->trans_start();
		
		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_kepangkatan');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_kepangkatan', $data);
		}else{
			$updt = $this->db->insert('pegawai_kepangkatan', $data);
		}
		
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	function set_gol($id){
		
		return $this->db->from('m_gapok')->where('kdkelgapok', $id)->get();
	}
	
}