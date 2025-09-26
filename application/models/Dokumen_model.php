<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
    
    function getDetail($id=''){
        if(!empty($id)){
			$this->db->where('id', $id);
		}
		$query = $this->db->get('pegawai_dokumen');
			
		return $query->row();
    }
    
}