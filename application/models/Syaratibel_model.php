<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Syaratibel_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
        $this->db->where("status",'1');
		$query = $this->db->get('m_syarat_ibel');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('m_syarat_ibel');

		return $query->row_array();
	}
    
    public function insert_data($data)
	{
		$insert = $this->db->insert("m_syarat_ibel",$data);
		
		return $insert;
	}

	public function update_data($data, $id)
	{
        $this->db->where("id",$id);
		$update = $this->db->update("m_syarat_ibel",$data);
		
		return $update;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('m_syarat_ibel');
		
		return $delete;
	}
}