<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class engine_report_master_group_relasi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_report($id = '') 
	{
		$this->db->select('a.*, b.group_name as table_name1, b.ref_table as ref_table1,
		c.group_name as table_name2, c.ref_table as ref_table2');
		$this->db->from('report_table_group_relasi as a');
		$this->db->join('report_table_group as b',"b.id_rtg = a.id_rtg_from","LEFT");
		$this->db->join('report_table_group as c',"c.id_rtg = a.id_rtg_to","LEFT");
				
		if(!empty($id)){
			$this->db->where('id_rtgr', $id);
		}		
		
		$this->db->order_by('id_rtgr', 'DESC');
		$query = $this->db->get();
		
		if(!empty($id)){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
	}
	
	function get_byId($id) 
	{
		$this->db->select('a.*, b.group_name as table_name1, b.ref_table as ref_table1,
		c.group_name as table_name2, c.ref_table as ref_table2');
		$this->db->from('report_table_group_relasi as a');
		$this->db->join('report_table_group as b',"b.id_rtg = a.id_rtg_from","LEFT");
		$this->db->join('report_table_group as c',"c.id_rtg = a.id_rtg_to","LEFT");
				
		$this->db->where('id_rtgr', $id);
		$this->db->order_by('id_rtgr', 'DESC');
		$query = $this->db->get();

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
	
		//check if available
		if(!empty($data['id_rtg_from']) AND !empty($data['id_rtg_to'])){
			$this->db->from('report_table_group_relasi as a');
			$this->db->where('id_rtg_from', $data['id_rtg_from']);
			$this->db->where('id_rtg_to', $data['id_rtg_to']);
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				return FALSE;
			}
		}
		
		$this->db->insert('report_table_group_relasi', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_rtgr', $id);
		$update = $this->db->update('report_table_group_relasi', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_rtgr', $id);
		$delete = $this->db->delete('report_table_group_relasi');
		
		return (isset($delete)) ? true : FALSE;
	}
	
}