<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Provinces_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_provinces');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('prov_id', $id);
		$query = $this->db->get('m_provinces');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_provinces', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_provinces (`prov_name`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('prov_id', $id);
		//$this->db->update('m_provinces', $data);
		
		//one data
		$update = $this->db->query("update m_provinces SET prov_name = '".$data."' WHERE prov_id = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('prov_id', $id);
		$delete = $this->db->delete('m_provinces');
		
		return (isset($delete)) ? true : FALSE;
	}
}