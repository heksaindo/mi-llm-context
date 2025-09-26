<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pendidikan_model extends CI_Model {

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
    
    function get_byId($id) 
	{
		$this->db->where('id_strata', $id);
		$query = $this->db->get('m_strata_pendidikan');

		return $query->row_array();
	}
    
    function insertPendidikan($data) 
	{
		$query = $this->db->insert('m_strata_pendidikan',$data);
		return $query;
	}
    
    function updatePendidikan($where,$data) 
	{
        foreach($where as $key=>$val){
            $this->db->where($key,$val);
        }
		$query = $this->db->update('m_strata_pendidikan',$data);
		return $query;
	}
    
    function setDelete($where){
        foreach($where as $key=>$val){
            $this->db->where($key,$val);
        }
		$query = $this->db->delete('m_strata_pendidikan');
		return $query;
    }
}