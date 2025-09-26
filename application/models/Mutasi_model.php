<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mutasi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('pegawai_mutasi');

		return $query->result_array();
	}
	
	function get_mutasi($id) {

		$this->db->select('a.*, c.*, b.tempat_lahir, b.tanggal_lahir, b.gelar_depan, b.gelar_belakang, concat(d.gelar_depan," ", d.nama," ", d.gelar_belakang) as nama_sekretaris', false);
		$this->db->from('pegawai_mutasi a');
		$this->db->join('pegawai b','a.nip=b.nip_baru');
		$this->db->join('surat_mutasi c','a.no_surat=c.no_surat','LEFT');
		$this->db->join('pegawai d','c.sekretaris=d.nip_baru','LEFT');
		$this->db->where('c.id', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
	
	function get_mutasi_check($id){
		$where_clause = '';
		$id = str_replace('_',',', $id);
		if($id){
			//$where_clause = ' AND id IN ('.$id.')';
			$this->db->where('c.id IN ('.$id.')');
		}
		
		$this->db->select('a.*, c.*, b.tempat_lahir, b.tanggal_lahir, b.gelar_depan, b.gelar_belakang, concat(d.gelar_depan," ", d.nama," ", d.gelar_belakang) as nama_sekretaris', false);
		$this->db->from('pegawai_mutasi a');
		$this->db->join('pegawai b','a.nip=b.nip_baru');
		$this->db->join('surat_mutasi c','a.no_surat=c.no_surat','LEFT');
		$this->db->join('pegawai d','c.sekretaris=d.nip_baru','LEFT');
		
		$query = $this->db->get();
		
	
		return $query->result();
	}
	
}