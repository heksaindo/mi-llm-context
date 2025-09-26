<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model {

	public function __construct()
	{
		
	}

	function get_all($table) 
	{
		$query = $this->db->get($table);

		return $query->result_array();
	}
	
	function get_db($table){
		return $this->db->get($table);
	}
	
	public function insert_data($table, $data)
	{
		return $this->db->insert($table,$data);
	}

	public function update_data($table, $data, $id_field, $id)
	{
		return $this->db->where($id_field, $id)	
						->update($table,$data);
	}
	
	public function delete_data($table, $id_field, $id)
	{
		return $this->db->where($id_field, $id)
					    ->delete($table);
	}
	
	function get_byId($table,$id_field, $id) 
	{

		return $this->db->where($id_field, $id)->get($table)->row();
	}
	
	
}