<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bup_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->query("
        SELECT `a`.* FROM m_eselon as a");
		return $query->result_array();
	}
    
    
    function cek_byId($id_e){

        $this->db->select('a.*')
        ->from('m_eselon as a')
        ->where('a.id_eselon',$id_e);
         $cek = $this->db->get();
         return $cek->row();
    }
    
    function proses_bup($data,$id){
		$this->db->where('id_eselon',$id);
        $q = $this->db->update('m_eselon',$data);
         if($q){
            $result = array(
                'success'=>true,
                'msg'=>''
            );
         }else{
            $result = array(
                'success'=>false,
				'msg'=>'Gagal proses data'
            );
         }
         return $result;
    }
}