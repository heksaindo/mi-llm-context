<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cuti_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all($pegid='',$laporan=false) {
		
		if($pegid){
			$where = "WHERE pegawai_id='".$pegid."'";
		}else{
			if(!$laporan){
				$where = "WHERE status_cuti !='7'";
			}else{
				$where = "WHERE status_cuti ='7'";
			}
			
		}
		$sql="select a.*,b.nama as yang_mengajukan,b.nip_baru, f.nama_tipe_cuti as nama_cuti
		FROM cuti a
		JOIN pegawai as b ON a.pegawai_id=b.id
		LEFT JOIN m_tipe_cuti AS f ON a.jenis_cuti = f.id_tipe_cuti ".$where." ORDER BY a.id DESC
		";
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	
	function get_all_cuti() 
	{
		$this->db->select('*');
		$query = $this->db->get('cuti')->row();

		return $query;
	}
	
	function get_pegawai_ById($Id) 
	{
		$this->db->select('a.*,b.sisa')
		->from('pegawai as a')
		->join('sisa_cuti as b','a.id=b.id_pegawai','left')
		->where('a.id',$Id);
		$query = $this->db->get()->row();

		return $query;
	}
	
	function get_cuti($cuti_id) {
		$level=$this->session->userdata('login_state');
		$sql="select a.*,b.nama,b.nip_baru,c.nama as nama_ttd,c.nip_baru as nip_ttd,c.gelar_depan as gd_ttd,c.gelar_belakang as gb_ttd,
		f.nama_tipe_cuti as jenis_cuti
		FROM cuti a
		JOIN pegawai as b ON a.pegawai_id=b.id
		JOIN pegawai as c ON a.id_ttd=c.id
		LEFT JOIN m_tipe_cuti AS f ON a.jenis_cuti = f.id_tipe_cuti
		WHERE a.id = '$cuti_id'
		ORDER BY a.id DESC";
		$query = $this->db->query($sql);
	
		return $query->result_array();
	}
	
	function getSisa($jenis,$idp,$th,$range=false){
		$this->db->where('jenis_cuti', $jenis);
		$this->db->where('id_pegawai', $idp);
		if($range){
			$this->db->where("(DATE_ADD(tahun,INTERVAL 5 YEAR) < '".$th."')");
		}else{
			$this->db->where('DATE_FORMAT(tahun,"%Y")', $th);
		}
		$query = $this->db->get('sisa_cuti');
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return (object) array('id'=>'','sisa'=>'_');
		}
	}
	
	function setSisa($id='',$data){
		if($id){
			$this->db->where('id', $id);
			$query = $this->db->update('sisa_cuti',$data);
		}else{
			$query = $this->db->insert('sisa_cuti',$data);
		}
		
		return $query;
	}
	
	function getKuota($jenis){
		$this->db->where('id_tipe_cuti', $jenis);
		$query = $this->db->get('m_tipe_cuti');
		if($query->num_rows()>0){
			$row = $query->row();
			return $row->kuota;
		}else{
			return '';
		}
	}
	
	function get_result_cuti($id){
		$this->db->where('id', $id);
		$query = $this->db->get('cuti');
		
		return $query->result();
	}
	
	function get_cuti_byid($id){
		$this->db->where('id', $id);
		$query = $this->db->get('cuti');

		return $query->result_array();
	}
	
	function get_id($id) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('cuti');

		return $query->row_array();
	}
	
	function get_cuti_approve($cuti_id) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('status', $cuti_id);
		$query = $this->db->get('cuti');

		return $query->result_array();
	}

	
	public function insert_cuti($data)
	{
		$this->db->insert('cuti', $data);
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_cuti($id, $data)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('cuti', $data);
		
		return (isset($id)) ? $id : FALSE;
	}
	public function delete_cuti($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('cuti');
		
		return (isset($delete)) ? true : FALSE;
	}
	
	public function ddl_jenis_cuti($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_tipe_cuti', $id);
		}
		$query = $this->db->get('m_tipe_cuti');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	
	public function get_jenis(){
		return $this->db->get('m_tipe_cuti');
	}
	
	public function ddl_jabatan_ttd($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_jabatan', $id);
		}
		$this->db->where('id_status_jabatan', 1);
		$this->db->order_by('id_jabatan','ASC');
		$query = $this->db->get('m_jabatan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	
}