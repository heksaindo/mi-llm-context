<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model {

	function getData($where=array()) 
	{
		$this->db->select("*");
        $this->db->from('m_calendar');
        foreach($where as $k=>$v){
            $this->db->where($k,$v);
        }
        $query = $this->db->get();
		return $query->result();
	}
    
    function cek_byId($id_e){

        $this->db->select('a.*')
        ->from('m_eselon as a')
        ->where('a.id_eselon',$id_e);
         $cek = $this->db->get();
         return $cek->row();
    }
}