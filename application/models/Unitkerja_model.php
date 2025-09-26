<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Unitkerja_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('a.*, b.prov_name');
		$this->db->from('m_unit_kerja as a');
		$this->db->join('m_provinces b', 'a.prov_id=b.prov_id');
		$this->db->order_by('a.kode_unit_kerja', 'ASC');
		$query = $this->db->get();

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_unit_kerja', $id);
		$query = $this->db->get('m_unit_kerja');

		return $query->row_array();
	}

	function get_kode($parent_unit) 
	{
		if(!empty($parent_unit)){
			$this->db->where('id_unit_kerja', $parent_unit);
			$query = $this->db->get('m_unit_kerja');
			$kd = $query->row_array();
			$kode = $kd['kode_unit_kerja'];
			
			$newquery = $this->db->query("SELECT MAX(kode_unit_kerja) as last_kode FROM m_unit_kerja 
							WHERE kode_unit_kerja LIKE '".$kode."%' AND LENGTH(kode_unit_kerja) = LENGTH('".$kode."')+2");
			$kd_new = $newquery->row_array(); 		
			$last_kode = $kd_new['last_kode'];
			
			if($kode == $last_kode){
				$new_kode = $last_kode.'.1';
			}else{
				$skode = explode('.',$last_kode);  
				$lkode = $skode[count($skode)-1];
				$rkode = $lkode + 1;
				$new_kode = $kode.'.'.$rkode;
			}
		}else{
			$newquery = $this->db->query("SELECT MAX(kode_unit_kerja) as last_kode FROM m_unit_kerja WHERE parent_unit = 0");
			$kd_new = $newquery->row_array(); 		
			$last_kode = $kd_new['last_kode'];
			
			$new_kode = ++$last_kode;
		}
		return $new_kode;
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_unit_kerja', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_unit_kerja', $id);
		$update = $this->db->update('m_unit_kerja', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_unit_kerja', $id);
		$delete = $this->db->delete('m_unit_kerja');
		
		return (isset($delete)) ? true : FALSE;
	}
}