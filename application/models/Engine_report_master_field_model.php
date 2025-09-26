<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class engine_report_master_field_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_report($id = '') 
	{
		$this->db->select('a.*, b.group_name');
		$this->db->from('report_table_field as a');
		$this->db->join('report_table_group as b',"b.id_rtg = a.id_rtg","LEFT");
		
		
		if(!empty($id)){
			$this->db->where('a.id_rtf', $id);
		}
		
		$this->db->order_by('a.id_rtf', 'DESC');
		$query = $this->db->get();
		
		if(!empty($id)){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
	}
	
	function get_byId($id) 
	{
		$this->db->select('a.*, b.group_name');
		$this->db->from('report_table_field as a');
		$this->db->join('report_table_group as b',"b.id_rtg = a.id_rtg","LEFT");
		
		$this->db->where('a.id_rtf', $id);
		$this->db->order_by('a.id_rtf', 'DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	
	public function insert_data($data)
	{
		$this->db->insert('report_table_field', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_rtf', $id);
		$update = $this->db->update('report_table_field', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_rtf', $id);
		$delete = $this->db->delete('report_table_field');
		
		return (isset($delete)) ? true : FALSE;
	}
	
}