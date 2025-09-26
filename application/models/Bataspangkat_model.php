<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class bataspangkat_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_strata_pendidikan');

		return $query->result();
	}
	
	function get_semua($table) 
	{
		return $this->db->get($table);
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_strata', $id);
		$query = $this->db->get('m_strata_pendidikan');

		return $query->row_array();
	}

	public function ddl_gol($id = '')
	{
		if(!empty($id)){
			$this->db->where('kode_golongan', $id);
		}

		$this->db->order_by('kode_golongan','ASC');
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
	
	public function insert_data($data)
	{
		$this->db->insert('m_strata_pendidikan', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_strata', $id);
		$update = $this->db->update('m_strata_pendidikan', $data);
		
		return (isset($update)) ? true : FALSE;
	}

}