<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bapeljakat_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	
	function get_all() {
		$query = $this->db->get('pegawai');

		return $query->result_array();
	}
	
	function get_periode_bapeljakat($id_pb='')
	{
		$this->db->select('*')
				->from('bapeljakat_periode');
				
		if($id_pb){
			$this->db->where('id_pb', $id_pb);
		}
		$query = $this->db->get();
			
		if ($query->num_rows() > 0) {
			if($id_pb){
				return $query->row();
			}else{
				return $query->result_array();
			}
		}else{
			return '';
		}
	}
	
	function get_bapeljakat_byPB($id_pb='')
	{
		$this->db->select('a.*, b.nama_jabatan, c.nama_unit_kerja')
				->from('bapeljakat as a')
				->join('m_jabatan as b','a.jabatan_usulan = b.id_jabatan')
				->join('m_unit_kerja as c','a.unit_kerja_pengusul = c.kode_unit_kerja');
				
		if($id_pb){
			$this->db->where('a.id_pb', $id_pb);
		}
		$query = $this->db->get();
			
		if ($query->num_rows() > 0) {
			return $query->result_array();
			
		}else{
			return '';
		}
	}
	
	function get_bapeljakat($id_bapeljakat='', $id_pb='')
	{
		$this->db->select('a.*, b.nama_jabatan, c.nama_unit_kerja')
				->from('bapeljakat as a')
				->join('m_jabatan as b','a.jabatan_usulan = b.id_jabatan')
				->join('m_unit_kerja as c','a.unit_kerja_pengusul = c.kode_unit_kerja');
				
		if($id_bapeljakat){
			$this->db->where('id_bapeljakat', $id_bapeljakat);
		}
		if($id_pb){
			$this->db->where('a.id_pb', $id_pb);
		}
		$query = $this->db->get();
			
		if ($query->num_rows() > 0) {
			if($id_bapeljakat){
				return $query->row();
			}else{
				return $query->result_array();
			}
		}else{
			return '';
		}
	}
	
	function get_bapeljakat_detail($id_bapeljakat)
	{
		$this->db->select('a.*, b.nip_baru, b.tanggal_lahir, b.agama')
			->from('bapeljakat_detail as a')
			->join('pegawai as b','a.calon_nip = b.nip_baru');
			
		if($id_bapeljakat){
			$this->db->where('a.id_bapeljakat', $id_bapeljakat);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
			
		}else{
			return '';
		}
	
	}
	
	function get_bapeljakat_rekap($id_pb)
	{
		$this->db->select('a.*, b.nama_jabatan, c.nama_unit_kerja, e.eselon, d.calon_nip,
					d.calon_nama, d.calon_golongan, d.calon_tmt_golongan, d.calon_pendidikan, 
					d.calon_diklat, d.calon_riwayatjabatan, d.catatan_hasil')
				->from('bapeljakat as a')
				->join('bapeljakat_detail as d','a.id_bapeljakat = d.id_bapeljakat')
				->join('pegawai_jabatan as e','e.nip_baru = d.calon_nip')
				->join('m_jabatan as b','a.jabatan_usulan = b.id_jabatan')
				->join('m_unit_kerja as c','a.unit_kerja_pengusul = c.kode_unit_kerja');
				
		if($id_pb){
			$this->db->where('a.id_pb', $id_pb);
		}
		$this->db->order_by('b.nama_jabatan', 'ASC');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
			
		}else{
			return '';
		}
	
	}
	
	function get_bapeljakat_detail_byID($id_bapeljakat_detail)
	{
		$this->db->where('id', $id_bapeljakat_detail);
		$query = $this->db->get('bapeljakat_detail');

		if ($query->num_rows() > 0) {
			return $query->row_array();
			
		}else{
			return '';
		}
	
	}
	
	function get_periode($id_pb)
	{
		$this->db->where('id_pb', $id_pb);
		$query = $this->db->get('bapeljakat_periode');

		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return toInaDate($row['periode_awal']).' - '. toInaDate($row['periode_akhir']); 
		}else{
			return '';
		}
	
	}
	
	
	public function ddl_unit_kerja()
	{
		// id, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('kode_unit_kerja','ASC');
		$query = $this->db->get('m_unit_kerja');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	
	public function ddl_jabatan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_jabatan', $id);
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
	
	public function insert_bapeljakat_periode($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('bapeljakat_periode', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function insert_bapeljakat($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('bapeljakat', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	function update_bapeljakat($data, $id)
	{
		$this->db->trans_start();

		$this->db->where('id_bapeljakat', $id);
		$update = $this->db->update('bapeljakat', $data, false);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function insert_bapeljakat_detail($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('bapeljakat_detail', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	function update_bapeljakat_detail($data, $id)
	{
		$this->db->trans_start();

		$this->db->where('id', $id);
		$update = $this->db->update('bapeljakat_detail', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function ddl_unsurklasifikasi($id_unsur = '')
	{
		if(!empty($id_unsur)){
			$this->db->where('id_unsur', $id_unsur);
		}

		$this->db->order_by('skor','DESC');
		$query = $this->db->get('m_unsur_klasifikasi');
		
		if ($query->num_rows() > 0) {
			return $query->result();
			
		}else{
			return '';
		}
	}
	
	public function do_delete_bapeljakat($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id_bapeljakat', $id);
		$delete = $this->db->delete('bapeljakat');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	public function delete_bapeljakat_detail($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('bapeljakat_detail');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	
}