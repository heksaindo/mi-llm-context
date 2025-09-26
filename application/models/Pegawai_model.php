<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	
	function get_all() {
		$query = $this->db->get('pegawai');

		return $query->result_array();
	}
	
	function get_pegawai_all() {

		$this->db->select('a.*, c.eselon, k.nama_jabatan, c.tmt_jabatan, d.strata, d.jurusan, d.tahun_lulus, e.nama_strata2,
						b.golongan, b.tmt_kepangkatan,b2.tmt_cpns,b2.tmt_pns, b2.masa_kerja_tahun, b2.masa_kerja_bulan')
				->from('pegawai as a')
				->join('pegawai_kepangkatan as b','a.id = b.id_pegawai', 'left')
				->join('pegawai_kepegawaian as b2','a.id = b2.id_pegawai', 'left')
				->join('pegawai_jabatan as c', 'a.id = c.id_pegawai', 'left')
				->join('pegawai_pendidikan as d', 'a.id = d.id_pegawai', 'left')
				->join('m_strata_pendidikan as e', 'd.strata = e.id_strata','LEFT')
				->join('m_unit_kerja as f','f.kode_unit_kerja = c.kode_unit_kerja','LEFT')	
				->join('m_jabatan as k','k.id_jabatan = c.id_nama_jabatan','LEFT');
				
				
		$this->db->order_by('a.id DESC, b.golongan DESC, e.level ASC, b.tmt_kepangkatan DESC ', false);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			if(!empty($pegawai_id)){
				return $query->row();
			}else{
				return $query->result_array();
			}	
		}else{
			return '';
		}
	}

	function get_pegawai_bynip($data) {
		
		if($data != ''){
			$this->db->where('a.id', $data);
		}
		
		$this->db->select('*')
				->from('pegawai as a')
				->join('pegawai_jabatan as b', 'a.id = b.id_pegawai','LEFT')
				->join('pegawai_kepegawaian as c','a.id = c.id_pegawai','LEFT');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();
		}else{
			return '';
		}
	}
	
	//function get_pegawai_by_id($pegawai_id = '') {
	//
	//			$this->db->select('*')
	//			->from('pegawai as a', false)
	//			->join('pegawai_jabatan as b', 'a.nip_baru = b.nip_baru','LEFT', false)
	//			->join('pegawai_kepegawaian as c','a.nip_baru = c.nip_baru','LEFT', false);
	//			//->join('pegawai_tempatkerja as d','a.nip_baru = d.nip_baru','LEFT', false)
	//			//->join('pegawai_pendidikan as e','a.nip_baru = e.nip_baru','LEFT', false);
	//			
	//	if(!empty($pegawai_id)){
	//		$this->db->where('a.id', $pegawai_id, false);
	//	}
	//	$query = $this->db->get();
	//	
	//	if ($query->num_rows() > 0) {
	//		if(!empty($pegawai_id)){
	//			return $query->row();
	//		}else{
	//			return $query->result_array();
	//		}	
	//	}else{
	//		return '';
	//	}
	//	
	//}

	function get_pegawai_byId($pegawai_id = '') {
		
		$this->db->select('a.*, c.pendidikan_diangkat,c.status_kepegawaian, c.masa_kerja_tahun,
						  c.masa_kerja_bulan,d.jurusan,e.nama_strata,f.label as agama_txt,g.label as perkawinan_txt')
				->from('pegawai as a')
				->join('pegawai_kepegawaian as c','a.id = c.id_pegawai')
				->join('pegawai_riwayatpendidikan as d','c.pendidikan_diangkat = d.id','left')
				->join('m_strata_pendidikan as e','d.strata = e.id_strata','left')
				->join('parameter as f','a.agama = f.id','left')
				->join('parameter as g','a.status_perkawinan = g.id','left');
		if(!empty($pegawai_id)){
			$this->db->where('a.id', $pegawai_id);
		}
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			if(!empty($pegawai_id)){
				return $query->row();
			}else{
				return $query->result_array();
			}	
		}else{
			return '';
		}
	}
	
	function get_pegawai_kepegawaian($pegawai_id = '') {
		if(!empty($pegawai_id)){
			$this->db->where('a.id_pegawai', $pegawai_id);
		}
		$this->db->select("a.*,g.label as lokasi_gaji_txt,h.label as status_gaji_txt,f.nama_unit_kerja as satuan_kerja_txt,c.nama_jenis_kepegawaian,d.jurusan as jurusan_diangkat,e.nama_strata as strata_diangkat");
		$this->db->from('pegawai_kepegawaian as a');
		$this->db->join('pegawai as b','a.id_pegawai=b.id');
		$this->db->join('m_jenis_kepegawaian as c','a.jenis_kepegawaian=c.id_jenis_kepegawaian','left');
		$this->db->join('pegawai_riwayatpendidikan as d','a.pendidikan_diangkat = d.id','left');
		$this->db->join('m_strata_pendidikan as e','d.strata = e.id_strata','left');
		$this->db->join('m_unit_kerja as f','a.satuan_kerja=f.kode_unit_kerja','left');
		$this->db->join('parameter as g','a.lokasi_gaji=g.id','left');
		$this->db->join('parameter as h','a.status_gaji=h.id','left');
		//$this->db->where('b.status !=', 'pensiun');
		$query = $this->db->get();
			
		return $query->row();
	}
	
	function get_tmt_cpns($pegawai_id = '') {
		if(!empty($pegawai_id)){
			$where = array('pegawai_id' => $pegawai_id, 'ppertama' => 'CPNS');
			$this->db->where($where);
		}
		$query = $this->db->get('pegawai_riwayatkepangkatan');
			
		return $query->row();
	}
	function get_tmt_pns($pegawai_id = '') {
		if(!empty($pegawai_id)){
			$where = array('pegawai_id' => $pegawai_id, 'ppertama' => 'PNS', 'is_last' => 'Ya');
			$this->db->where($where);
		}
		$query = $this->db->get('pegawai_riwayatkepangkatan');
			
		return $query->row();
	}
	
	function get_pegawai_tempatkerja($pegawai_id = '') {
		if(!empty($pegawai_id)){
			$this->db->where('id_pegawai', $pegawai_id);
		}
		$query = $this->db->get('pegawai_tempatkerja');
			
		return $query->row();
	}
	
	function get_pegawai_jabatan($pegawai_id = '') {
		if(!empty($pegawai_id)){
			$where =" Where a.id_pegawai ='".$pegawai_id."' ";
		}
		$query = $this->db->query("SELECT a.*,b.nama_jabatan from pegawai_jabatan as a 
						 left join m_jabatan as b ON a.id_nama_jabatan = b.id_jabatan $where");
		return $query->row();
	}
	
	function get_pegawai_cv($pegawai_id='') {

		$this->db->select('*')
				->from('pegawai as a')
				->join('pegawai_kepangkatan as b','a.id = b.id_pegawai', 'left')
				->join('pegawai_kepegawaian as b2','a.id = b2.id_pegawai', 'left')
				->join('pegawai_jabatan as c', 'a.id = c.id_pegawai', 'left')
				->join('pegawai_pendidikan as d', 'a.id = d.id_pegawai', 'left')
				->join('pegawai_suami_istri as e', 'a.id = e.id_pegawai', 'left');
		if(!empty($pegawai_id)){
			$this->db->where('a.id', $pegawai_id);
		}		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			if(!empty($pegawai_id)){
				return $query->row();
			}else{
				return $query->result_array();
			}	
		}else{
			return '';
		}
	}
	
	function get_suami_istri($nip_baru = '') {
		$this->db->select("a.*,b.label as status_menikah_txt");
		if(!empty($nip_baru)){
			$this->db->where('a.id_pegawai', $nip_baru);
		}
		$this->db->from('pegawai_suami_istri as a');
		$this->db->join('parameter as b',"a.status_menikah=b.id AND b.tipe='statusperkawinan'");
		$query = $this->db->get();
			
		return $query->row();
	}
	
	
	function check_pegawai($nip_lama, $nama){
	
		$this->db->where('nip_lama', $nip_lama);
		$query = $this->db->get('pegawai');
		if ($query->num_rows() > 0) {
			$_return = false;
		}else{
			$_return = true;
		}
		return $_return;
	}
	
	function check_nip_lama($nip_lama, $hd_id=''){
		if(!empty($hd_id)){
			$this->db->where('id !=', $hd_id, false);
		}
		$this->db->where('nip_lama', $nip_lama);
		$query = $this->db->get('pegawai');
		if ($query->num_rows() > 0) {
			$_return = false;
		}else{
			$_return = true;
		}
		return $_return;
	}
	
	function check_nip_baru($nip_baru, $hd_id=''){
	
		if(!empty($hd_id)){
			$this->db->where('id !=', $hd_id, false);
		}
		$this->db->where('nip_baru', $nip_baru);
		$query = $this->db->get('pegawai');
		if ($query->num_rows() > 0) {
			$_return = false;
		}else{
			$_return = true;
		}
		return $_return;
	}
	
	public function insert_pegawai($nip_baru, $data)
	{
		$this->db->trans_start();
	
		$this->db->where('nip_baru', $nip_baru);
		$cek = $this->db->get('pegawai');
		
		if ($cek->num_rows() > 0){
			$this->db->where('nip_baru', $nip_baru);
			$this->db->update('pegawai', $data);
			
			$peg = $this->db->get_where('pegawai', array('nip_baru' => $nip_baru));
			$row = $peg->row_array();
			$id = $row['id'];
		}else{
			$this->db->insert('pegawai', $data);
			$id = $this->db->insert_id();
		}
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_pegawai($pegawai_id, $data)
	{
		$this->db->trans_start();

		$this->db->where('id', $pegawai_id);
		$updt = $this->db->update('pegawai', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_foto($pegawai_id,$data)
	{
		$this->db->trans_start();

		$this->db->where('id', $pegawai_id);
		$updt = $this->db->update('pegawai', array('foto'=> $data['file_name']));
		
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function getData($table,$where){
		$this->db->trans_start();
		$this->db->select("*");
		$this->db->from($table);
		if(is_array($where)){
			foreach($where as $k=>$v){
				$this->db->where($k,$v);
			}
		}else{
			$this->db->where($where);
		}
		$get = $this->db->get();
		
		$this->db->trans_complete();
		return $get;
	}
	
	public function cek_kepegawaian($id_pegawai, $data)
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
	
	public function cek_jabatan($id_pegawai, $data)
	{
		$this->db->trans_start();
		
		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_jabatan');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_jabatan', $data);
		}else{
			$updt = $this->db->insert('pegawai_jabatan', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function updateLast($array){
		$this->db->trans_start();
		
		foreach($array['where'] as $wk=>$wv){
			$this->db->where($wk,$wv);
		}
		
		foreach($array['where_not_in'] as $nk=>$nv){
			$this->db->where_not_in($nk,$nv);
		}
		$update = $this->db->update($array['table'],$array['data']);
		
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function getLast($table,$where){
		$this->db->trans_start();
		
		$this->db->select("*");
		$this->db->from($table);
		foreach($where as $key=>$val){
			$this->db->where($key,$val);
		}
		$get = $this->db->get();
		
		$this->db->trans_complete();
		
		return $get;
	}
	
	public function getRiwayatPangkat($where){
		$this->db->trans_start();
		
		$this->db->select("*");
		$this->db->from('pegawai_riwayatkepangkatan');
		foreach($where as $key=>$val){
			$this->db->where($key,$val);
		}
		$this->db->limit(1);
		$this->db->order_by('tmt_kepangkatan','ASC');
		
		$get = $this->db->get();
		
		$this->db->trans_complete();
		
		return $get;
	}
	
	
	public function cek_kepangkatan($id_pegawai, $data)
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
	
	public function cek_pendidikan($id_pegawai, $data)
	{
		$this->db->trans_start();

		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_pendidikan');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_pendidikan', $data);
		}else{
			$updt = $this->db->insert('pegawai_pendidikan', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function cek_anak($id_pegawai, $data)
	{
		$this->db->trans_start();

		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_anak');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_anak', $data);
		}else{
			$updt = $this->db->insert('pegawai_anak', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function cek_tempatkerja($id_pegawai, $data)
	{
		$this->db->trans_start();

		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_tempatkerja');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_tempatkerja', $data);
		}else{
			$updt = $this->db->insert('pegawai_tempatkerja', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function cek_suami_istri($id_pegawai, $data)
	{
		$this->db->trans_start();

		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_suami_istri');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_suami_istri', $data);
		}else{
			$updt = $this->db->insert('pegawai_suami_istri', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function cek_diklat_jabatan($id_pegawai, $data)
	{
		$this->db->trans_start();

		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_diklat_jabatan');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_diklat_jabatan', $data);
		}else{
			$updt = $this->db->insert('pegawai_diklat_jabatan', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function cek_diklat_teknis($id_pegawai, $data)
	{
		$this->db->trans_start();

		$this->db->where('id_pegawai', $id_pegawai);
		$cek = $this->db->get('pegawai_diklat_teknis');
		
		if ($cek->num_rows() > 0){
			$this->db->where('id_pegawai', $id_pegawai);
			$updt = $this->db->update('pegawai_diklat_teknis', $data);
		}else{
			$updt = $this->db->insert('pegawai_diklat_teknis', $data);
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_kepegawaian($id, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_kepegawaian WHERE id_pegawai='$id'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $id);
			$updt = $this->db->update('pegawai_kepegawaian', $data);
		}else{
			$data['id_pegawai']= $id;
			$updt = $this->db->insert('pegawai_kepegawaian', $data);
		}
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_jabatan($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_jabatan WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_jabatan', $data);
		}else{
			$data['id_pegawai']=$nip_baru;
			$updt = $this->db->insert('pegawai_jabatan', $data);
		}
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_kepangkatan($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_kepangkatan WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_kepangkatan', $data);
		}else{
			$data['id_pegawai']= $nip_baru;
			$updt = $this->db->insert('pegawai_kepangkatan', $data);
		}
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_pendidikan($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_pendidikan WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_pendidikan', $data);
		}else{
			$data['id_pegawai']= $nip_baru;
			$updt = $this->db->insert('pegawai_pendidikan', $data);
		}
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_anak($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_anak WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_anak', $data);
		}else{
			$data['id_pegawai']=$nip_baru;
			$updt = $this->db->insert('pegawai_anak', $data);
		}
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_tempatkerja($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_tempatkerja WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_tempatkerja', $data);
		}else{
			$data['id_pegawai'] = $nip_baru;
			$updt = $this->db->insert('pegawai_tempatkerja', $data);
		}
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_suami_istri($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_suami_istri WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_suami_istri', $data);
		}else{
			$data['id_pegawai']=  $nip_baru;
			$updt = $this->db->insert('pegawai_suami_istri', $data);
		}
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_diklat_jabatan($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_diklat_jabatan WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_diklat_jabatan', $data);
		}else{
			$data['id_pegawai']=$nip_baru;
			$updt = $this->db->insert('pegawai_diklat_jabatan', $data);
		}
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_diklat_teknis($nip_baru, $data)
	{
		$query = $this->db->query("SELECT * FROM pegawai_diklat_teknis WHERE id_pegawai='$nip_baru'");
		if($query->num_rows()>0){
			$this->db->where('id_pegawai', $nip_baru);
			$updt = $this->db->update('pegawai_diklat_teknis', $data);
		}else{
			$data['id_pegawai']=$nip_baru;
			$updt = $this->db->update('pegawai_diklat_teknis', $data);
		}
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	
	public function del_pegawai($pegawai_id)
	{
		$this->db->where('id', $pegawai_id);
		$this->db->delete('pegawai');
		
		return (isset($id)) ? $id : FALSE;
	}
	
	//Riwayat Kepangkatan
	function get_riwayatkepangkatan($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('sSearch')){
				$this->db->like('pangkat',$this->input->post('sSearch'));
			}
			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->order_by('tmt_kepangkatan','ASC');
		$query = $this->db->get('pegawai_riwayatkepangkatan');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	
	//function total_riwayatkepangkatan() {
	//
	//	if($this->input->post('sSearch')){
	//		$this->db->like('pangkat',$this->input->post('sSearch'));
	//	}
	//	if($this->input->post('nip_baru')){
	//		$this->db->where('nip_baru',$this->input->post('nip_baru'));
	//	}			
	//	
	//	$query = $this->db->get('pegawai_riwayatkepangkatan');
	//	
	//	if ($query->num_rows() > 0)
	//	{
	//		return $query->num_rows();
	//	}
	//	else
	//	{
	//		return FALSE;
	//	}
	//
	//}
	function edit_riwayatkepangkatan($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatkepangkatan');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatkepangkatan($data)
	{
		$d=array();
		$this->db->trans_start();
		$insert = $this->db->insert('pegawai_riwayatkepangkatan', $data);
		//commit
		$d['id'] = $this->db->insert_id();
		$this->db->trans_complete();
		
		$d['success'] = (isset($insert)) ? TRUE : FALSE;
		return $d;
	}
	public function update_riwayatkepangkatan($data, $id)
	{
		$d=array();
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatkepangkatan', $data);
		
		//commit
		$this->db->trans_complete();
		
		$d['success'] = (isset($update)) ? TRUE : FALSE;
		$d['id'] = $id;
		return $d;
	}
	
	public function delete_riwayatkepangkatan($id)
	{
		$table = 'pegawai_riwayatkepangkatan';
		$data = $this->getData($table,array('id'=>$id));
		
		$this->db->trans_start();
		$this->db->where('id', $id);
		$delete = $this->db->delete($table);
		
		//commit
		$this->db->trans_complete();
		
		if($delete){
			foreach($data->result() as $ro){
				if($ro->is_last=='Ya'){
					$spdata = array(
						'gol_terakhir'=>'',
						'status_kepegawaian'=>'',
						'tmt_gol_terakhir'=>''
					);
					$this->update_kepegawaian($ro->pegawai_id,$spdata);
				}
			}
		}
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Pendidikan
	function get_riwayatpendidikan($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->order_by('tahun_lulus','ASC');
		$query = $this->db->get('pegawai_riwayatpendidikan');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	//function total_riwayatpendidikan() {
	//
	//	if($this->input->post('nip_baru')){
	//		$this->db->where('nip_baru',$this->input->post('nip_baru'));
	//	}			
	//	
	//	$query = $this->db->get('pegawai_riwayatpendidikan');
	//	
	//	if ($query->num_rows() > 0)
	//	{
	//		return $query->num_rows();
	//	}
	//	else
	//	{
	//		return FALSE;
	//	}
	//
	//}
	
	function edit_riwayatpendidikan($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatpendidikan');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatpendidikan($data)
	{
		$d=array();
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatpendidikan', $data);
		$d['id'] = $this->db->insert_id();
		//commit
		$this->db->trans_complete();
		
		$d['success'] = (isset($insert)) ? TRUE : FALSE;
		return $d;
	}
	public function update_riwayatpendidikan($data, $id)
	{
		$d=array();
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatpendidikan', $data);
		
		//commit
		$this->db->trans_complete();
		
		$d['success'] = (isset($update)) ? TRUE : FALSE;
		$d['id'] = $id;
		return $d;
	}
	
	public function delete_riwayatpendidikan($id)
	{
		$user_input = $this->session->userdata('username');
		$table = 'pegawai_riwayatpendidikan';
		$data = $this->getData($table,array('id'=>$id));
		
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete($table);
		
		if($delete){
			foreach($data->result() as $ro){
				if($ro->pendidikan_saat_diangkat=='Ya'){
					$spdata = array(
						'pendidikan_diangkat'=>'',
						'updated_date' => date('Y-m-d H:i:s'),
						'updated_by' => $user_input
					);
					$this->update_kepegawaian($ro->pegawai_id,$spdata);
				}
			}
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Jabatan
	function get_riwayatjabatan($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->select('a.*, b.nama_status_jabatan, c.nama_jabatan, d.nama_unit_kerja')
				->from('pegawai_riwayatjabatan a')
				->join('m_status_jabatan b','a.id_jabatan=b.id_status_jabatan')
				->join('m_jabatan c','a.id_nama_jabatan=c.id_jabatan', 'LEFT')
				->join('m_unit_kerja d','a.kode_unit_kerja=d.kode_unit_kerja', 'LEFT');

		$this->db->order_by('a.tmt_jabatan','ASC');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	//function total_riwayatjabatan() {
	//
	//	if($this->input->post('nip_baru')){
	//		$this->db->where('nip_baru',$this->input->post('nip_baru'));
	//	}			
	//	
	//	$query = $this->db->get('pegawai_riwayatjabatan');
	//	
	//	if ($query->num_rows() > 0)
	//	{
	//		return $query->num_rows();
	//	}
	//	else
	//	{
	//		return FALSE;
	//	}
	//
	//}
	
	function edit_riwayatjabatan($id) {
		if(!empty($id)){
			$this->db->where('a.id', $id);
			$this->db->select('a.*,b.nama_jabatan')
				->from('pegawai_riwayatjabatan a')
				//->join('pegawai as p','a.pegawai_id=p.id','LEFT')
				->join('m_jabatan b','a.id_jabatan=b.id_jabatan', 'LEFT');
			$query = $this->db->get();
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatjabatan($data)
	{
		$d=array();
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatjabatan', $data);
		$d['id'] = $this->db->insert_id();
		//commit
		$this->db->trans_complete();
		$d['success'] = (isset($insert)) ? TRUE : FALSE;
		return $d;
	}
	public function update_riwayatjabatan($data, $id)
	{
		$d=array();
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatjabatan', $data);
		
		//commit
		$this->db->trans_complete();
		
		$d['success'] = (isset($update)) ? TRUE : FALSE;
		$d['id'] = $id;
		return $d;
	}
	
	public function delete_riwayatjabatan($id)
	{
		$user_input = $this->session->userdata('username');
		$table = 'pegawai_riwayatjabatan';
		$data = $this->getData($table,array('id'=>$id));
		
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete($table);
		
		if($delete){
			foreach($data->result() as $ro){
				if($ro->is_last=='Ya'){
					$spdata = array(
						'tanggal_tugas'=>'',
						'tmt_jabatan'=>'',
						'instansi' => '',
						'organisasi_kerja' => '',
						'satuan_kerja' => '',
						'satuan_organisasi' => '',
						'unit_organisasi' => '',
						'unit_kerja' => '',
						'kode_unit_kerja' => '',
						'updated_date' => date('Y-m-d H:i:s'),
						'updated_by' => $user_input
					);
					$this->update_kepegawaian($ro->pegawai_id,$spdata);
				}
			}
		}
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Dokumen
	function get_pegawai_dokumen($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->select('a.*, b.tipe_dokumen as tipe_doc', false)
				->from('pegawai_dokumen a')
				->join('tipe_dokumen b', 'a.tipe_dokumen = b.id');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}

	function edit_pegawai_dokumen($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_dokumen');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_pegawai_dokumen($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_dokumen', $data, false);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	public function update_pegawai_dokumen($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_dokumen', $data, false);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function delete_pegawai_dokumen($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_dokumen');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Diklat Jabatan
	function get_riwayatpelatihanjabatan($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->order_by('tahun_sertifikasi','ASC');
		$query = $this->db->get('pegawai_riwayatpelatihanjabatan');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	function edit_riwayatpelatihanjabatan($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatpelatihanjabatan');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatpelatihanjabatan($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatpelatihanjabatan', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	public function update_riwayatpelatihanjabatan($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatpelatihanjabatan', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function delete_riwayatpelatihanjabatan($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_riwayatpelatihanjabatan');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Diklat Teknis
	function get_riwayatpelatihanteknis($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->order_by('tahun_sertifikasi','ASC');
		$query = $this->db->get('pegawai_riwayatpelatihanteknis');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	function edit_riwayatpelatihanteknis($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatpelatihanteknis');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatpelatihanteknis($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatpelatihanteknis', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	public function update_riwayatpelatihanteknis($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatpelatihanteknis', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function delete_riwayatpelatihanteknis($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_riwayatpelatihanteknis');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Penghargaan
	function get_riwayatpenghargaan($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('a.pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->select('a.*, b.nama_penghargaan')
				->from('pegawai_riwayatpenghargaan a')
				->join('m_penghargaan b', 'a.id_penghargaan=b.id_penghargaan', 'LEFT');
		$this->db->order_by('a.tgl_sk','ASC');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	function edit_riwayatpenghargaan($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatpenghargaan');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatpenghargaan($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatpenghargaan', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	public function update_riwayatpenghargaan($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatpenghargaan', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function delete_riwayatpenghargaan($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_riwayatpenghargaan');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Keluarga
	function get_riwayatkeluarga($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		$this->db->order_by('tanggal_lahir','ASC');
		$query = $this->db->get('pegawai_riwayatkeluarga');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	function edit_riwayatkeluarga($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatkeluarga');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatkeluarga($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatkeluarga', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	public function update_riwayatkeluarga($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatkeluarga', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function delete_riwayatkeluarga($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_riwayatkeluarga');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Kinerja
	function get_riwayatkinerja($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		
		$this->db->select('a.*, b.nama_jabatan')
				->from('pegawai_riwayatkinerja a')
				->join('m_jabatan b','a.id_jabatan=b.id_jabatan', 'LEFT');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	function edit_riwayatkinerja($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatkinerja');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatkinerja($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatkinerja', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	public function update_riwayatkinerja($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatkinerja', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function delete_riwayatkinerja($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_riwayatkinerja');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//Riwayat Kompetisi
	function get_riwayatkompetensi($id = '') {
	
		if(!empty($id)){
			$this->db->where('pegawai_id', $id);
			
		}else{

			if($this->input->post('pegawai_id')){
				$this->db->where('pegawai_id',$this->input->post('pegawai_id'));
			}			
			
		}
		
		$this->db->select('a.*, b.nama_jabatan')
				->from('pegawai_riwayatkompetensi a')
				->join('m_jabatan b','a.id_jabatan=b.id_jabatan', 'LEFT');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	function edit_riwayatkompetensi($id) {
		if(!empty($id)){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai_riwayatkompetensi');
				
			if ($query->num_rows() > 0)	{
				return $query->row();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		
	}
	public function insert_riwayatkompetensi($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_riwayatkompetensi', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	public function update_riwayatkompetensi($data, $id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$update = $this->db->update('pegawai_riwayatkompetensi', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function delete_riwayatkompetensi($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_riwayatkompetensi');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	//====================
	
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
	
	public function insert_cetak_usulan($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_cetak_usulan', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	
	public function insert_messages($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('messages', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	
	public function get_masters($tipe, $id = '')
	{
		if(!empty($id)){
			$this->db->where('id', $id);
		}

		$this->db->where('tipe', $tipe);
		$this->db->where('status','1');
		$this->db->order_by('id','ASC');
		$query = $this->db->get('pegawai_masters');
		
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
	
	function ddl_parameter($tipe,$id=''){
		$this->db->select('*');
		$this->db->where('tipe', $tipe);
		$this->db->where('status','1');
		if(!empty($id)){
			$this->db->where('id', $id);
		}
		$this->db->order_by('id','ASC');
		$query = $this->db->get('parameter');
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
	
	public function ddl_status_pegawai($id = '')
	{
		if(!empty($id)){
			$this->db->where('id', $id);
		}
		// id, nama_status
		$this->db->order_by('id','ASC');
		$query = $this->db->get('m_status_pegawai');
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
	
	public function ddl_provinces($id = '')
	{
		if(!empty($id)){
			$this->db->where('prov_id', $id);
		}
		// prov_id, prov_name
		$this->db->order_by('prov_id','ASC');
		$query = $this->db->get('m_provinces');
		
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
	public function ddl_cities($prov_id='', $id = '')
	{
		if(!empty($prov_id)){
			$this->db->where('prov_id', $prov_id);
		}
		if(!empty($id)){
			$this->db->where('city_id', $id);
		}

		$this->db->order_by('city_id','ASC');
		$query = $this->db->get('m_cities');
		
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
	
	public function ddl_penghargaan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_penghargaan', $id);
		}
		// id_penghargaan, nama_penghargaan
		$this->db->order_by('nama_penghargaan','ASC');
		$query = $this->db->get('m_penghargaan');
		
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
	
	public function ddl_pelatihan_jabatan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_pelatihan', $id);
		}
		// id_pelatihan, nama_pelatihan, level
		$this->db->order_by('nama_pelatihan','ASC');
		$query = $this->db->get('m_pelatihan');
		
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
	public function ddl_lokasi_pelatihan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_lokasi_pelatihan', $id);
		}
		// id_lokasi_pelatihan, nama_lokasi
		$this->db->order_by('id_lokasi_pelatihan','ASC');
		$query = $this->db->get('m_lokasi_pelatihan');
		
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
	public function ddl_lokasi_kerja($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_lokasi_kerja', $id);
		}
		// id_lokasi_kerja, lokasi_kerja
		$this->db->order_by('id_lokasi_kerja','ASC');
		$query = $this->db->get('m_lokasi_kerja');
		
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
	
	public function ddl_hukuman($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_hukuman', $id);
		}
		// id_hukuman, nama_hukuman
		$this->db->order_by('id_hukuman','ASC');
		$query = $this->db->get('m_hukuman');
		
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
	public function ddl_eselon($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_eselon', $id);
		}
		// id_eselon, nama_eselon, level
		$this->db->order_by('id_eselon','ASC');
		$query = $this->db->get('m_eselon');
		
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
	
	public function ddl_golongan($kode = '')
	{
		if(!empty($kode)){
			$this->db->where('kode_golongan', $kode);
		}
		// id_golongan, nama_golongan, level
		$this->db->order_by('id_golongan','ASC');
		$query = $this->db->get('m_golongan');
		
		if ($query->num_rows() > 0) {
			if(!empty($kode)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	public function ddl_organisasi_kerja($kode = '')
	{
		if(!empty($kode)){
			$this->db->like('kode_unit_kerja', $kode);
			$this->db->where('level','2');
		}else{
			$this->db->where('level','1');
		}

		$this->db->order_by('id_unit_kerja','ASC');		
		$query = $this->db->get('m_unit_kerja');
		
		if ($query->num_rows() > 0) {
			return $query->result();
			
		}else{
			return '';
		}
	}
	public function ddl_satuan_kerja($kode = '')
	{
		if(!empty($kode)){
			$this->db->like('kode_unit_kerja', $kode);
			$this->db->where('level','3');
		}else{
			$this->db->where('level','2');
		}

		$this->db->order_by('id_unit_kerja','ASC');
		$query = $this->db->get('m_unit_kerja');
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	public function ddl_satuan_organisasi($kode = '')
	{
		if(!empty($kode)){
			$this->db->like('kode_unit_kerja', $kode);
			$this->db->where('level','4');
		}else{
			$this->db->where('level','3');
		}

		$this->db->order_by('id_unit_kerja','ASC');
		$query = $this->db->get('m_unit_kerja');
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	public function ddl_unit_organisasi($kode = '')
	{
		if(!empty($kode)){
			$this->db->like('kode_unit_kerja', $kode);
			$this->db->where('level','5');
		}else{
			$this->db->where('level','4');
		}

		$this->db->order_by('id_unit_kerja','ASC');
		$query = $this->db->get('m_unit_kerja');
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	
	public function ddl_unit_kerja($kode = '')
	{
		if(!empty($kode)){
			$this->db->like('kode_unit_kerja', $kode);
			$this->db->where('level','6');
		}else{
			$this->db->where('level','5');
		}
		// id, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('id_unit_kerja','ASC');
		$query = $this->db->get('m_unit_kerja');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	
	public function ddl_all_unit_kerja($kode = '')
	{
		if(!empty($kode)){
			$this->db->like('kode_unit_kerja', $kode);
		}
		// id, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('id_unit_kerja','ASC');
		$query = $this->db->get('m_unit_kerja');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	
	public function ddl_strata_pendidikan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_strata', $id);
		}
		//id_strata, nama_strata, level
		$this->db->order_by('level','ASC');
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
	
	//Usulan
	function get_pegawai_usulan() 
	{	
		$query = $this->db->get('pegawai_cetak_usulan');
		
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '';
		}
	}
	
	function get_cetak_usulan_byUser($user_login) 
	{	
		$this->db->where('user_login', $user_login);
		$query = $this->db->get('pegawai_cetak_usulan_temp');
		
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '';
		}
	}
	
	function get_cetak_usulan_byUser2($user_login) 
	{	
		$this->db->where('user_login', $user_login);
		$query = $this->db->get('pegawai_cetak_usulan_temp');
		
		if ($query->num_rows() > 0) {
			return $query;
		}else{		
			return '';
		}
	}
	
	function get_usulan_temp($user_login) {
	
		if(!empty($user_login)){
			$this->db->where('user_login', $user_login);
			
		}else{

			if($this->input->post('sSearch')){
				$this->db->like('nama',$this->input->post('sSearch'));
			}
			if($this->input->post('nip_baru')){
				$this->db->where('nip_baru',$this->input->post('nip_baru'));
			}			
			
		}
		
		$query = $this->db->get('pegawai_cetak_usulan_temp');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}

	}
	
	public function insert_usulan_temp($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_cetak_usulan_temp', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}
	
	public function insert_usulan_pegawai($data)
	{
		$this->db->trans_start();

		$insert = $this->db->insert('pegawai_cetak_usulan', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($insert)) ? TRUE : FALSE;
	}

	public function delete_usulan_temp($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai_cetak_usulan_temp');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	public function ddl_jabatan($id = '', $status='')
	{
		if(!empty($id)){
			$this->db->where('id_jabatan', $id);
		}
		if(!empty($status)){
			$this->db->where('id_status_jabatan', $status);
		}

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
	
	public function ddl_status_jabatan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_status_jabatan', $id);
		}

		$query = $this->db->get('m_status_jabatan');
		
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
	
	public function update_draft_usulan($data, $user_login)
	{
		$this->db->trans_start();

		$this->db->where('user_login', $user_login);
		$updt = $this->db->update('pegawai_cetak_usulan_temp', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
	public function update_nip_baru_riwayat($hd_nip_baru, $data_sub)
	{
		$this->db->trans_start();

		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatjabatan', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatkeluarga', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatkepangkatan', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatkinerja', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatkompetensi', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatpelatihanjabatan', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatpelatihanteknis', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatpendidikan', $data_sub);
		
		$this->db->where('nip_baru', $hd_nip_baru);
		$this->db->update('pegawai_riwayatpenghargaan', $data_sub);
		
		
		//commit
		$this->db->trans_complete();
		
		return TRUE;
	}
	
}