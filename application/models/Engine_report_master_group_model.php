<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class engine_report_master_group_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_report($id = '') 
	{
		$this->db->from('report_table_group');
		$this->db->select('*');
		
		if(!empty($id)){
			$this->db->where('id_rtg', $id);
		}
		$query = $this->db->get();
		
		if(!empty($id)){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_rtg', $id);
		$query = $this->db->get('report_table_group');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('report_table_group', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_rtg', $id);
		$update = $this->db->update('report_table_group', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_rtg', $id);
		$delete = $this->db->delete('report_table_group');
		
		return (isset($delete)) ? true : FALSE;
	}
	
}