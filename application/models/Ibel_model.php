<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ibel_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	function add_ibel($id_peg,$asal_surat,$tembusan){
		$temp_group = 1;
		$user_input = $this->session->userdata('user_id');
		$this->db->select_max('igroup');
		$query = $this->db->get('ibels');
		$row = $query->row();
		if($row->igroup !=""){
		   $gr = explode("_",$row->igroup);
		   $temp_group = $gr[1] + 1;
		}
		$temp_group = str_pad($temp_group, 4, '0', STR_PAD_LEFT);
		$group = "Ibel_".$temp_group;
		
		$data = array(
				'pegawai_ttd'	=>$id_peg,
				'asal_surat'	=>$asal_surat,
				'tembusan'		=>$tembusan,
				'perihal'		=> "Usul Izin Belajar",
				'igroup'		=>$group,
				'created_date'	=>date('Y-m-d H:i:s'),
				'created_by'	=>$user_input
			);
		$insert = $this->db->insert('ibels', $data);
		return $insert;
	}
	
	function get_ibel($laporan=''){
		$data=array();
		$this->db->select("a.*");
		$this->db->from("ibels as a");
		if($laporan){
			$this->db->where("(a.isp != null OR a.isp !='')");
			//$this->db->where("a.isk !=","");
		}
		$query = $this->db->get();
		foreach($query->result() as $row){
			$row->isPegawai = $this->getDetail(array('igroup'=>$row->igroup),'count','igroup');
			array_push($data,$row);
		}
		return $data;
	}
	
	function getDetail($where,$tipe,$field){
		switch($tipe){
			case "count":
				$this->db->select("count(".$field.") as total");
				break;
			case "field":
				$this->db->select($field);
				break;
		}
		foreach($where as $k=>$v){
			$this->db->where($k,$v);
		}
		$this->db->from("ibels_detail");
		$get = $this->db->get();
		if($get->num_rows()>0){
			$row = $get->row();
			switch($tipe){
				case "count":
					$return= $row->total;
					break;
				case "field":
					$return = $row->$field;
					break;
			}
			return $return;
		}else{
			return false;
		}
	}
	
	function del_ibel($group,$force){
		$query = $this->db->query("Select Count(id) as total from ibels_detail where igroup='".$group."'");
		$row = $query->row();
		if($row->total>0 && !$force){
			die("failed|1|Group Ibel sudah ada list,Yakin mau hapus?");
		}
		
		if($force){
			$query_dt = $this->db->query("Select id from ibels_detail where igroup='".$group."'");
			$idDt = array();
			foreach($query_dt->result() as $ro){
				$idDt[]=$ro->id;
			}
			if(!empty($idDt)){
				//$idDtl = implode("','",$idDt);
				$this->db->where_in("id_detail",$idDt);
				$this->db->delete("ibels_detail_syarat");
			}
			$this->db->where('igroup',$group);
			$this->db->delete("ibels_detail");
		}
		$this->db->where('igroup',$group);
		$del = $this->db->delete('ibels');
		return $del;
	}
	
	function update_ibel($group,$data){
		$this->db->where('igroup',$group);
		$isp = $this->db->update('ibels',$data);
		return $isp;
	}
	
	function update_sk($group,$data){
		$this->db->select("isp");
		$this->db->from("ibels");
		$this->db->where('igroup',$group);
		$query = $this->db->get();
		$row=$query->row();
			if($row->isp !=''){
				$this->db->where('igroup',$group);
				$update = $this->db->update('ibels',$data);
				$isp = array(true);
			}else{
				$isp = array(false,"Surat usulan belum ada!");
			}
		return $isp;
	}
	
	function getIbel($group,$field){
		$this->db->select($field);
		$this->db->from("ibels");
		$this->db->where("igroup",$group);
		$get = $this->db->get();
		if($get->num_rows()>0){
			$ro = $get->row();
			return $ro->$field;
		}else{
			return '';
		}
	}
	
	function cekIbelDetail($grup,$id){
		$this->db->select("a.id");
		$this->db->from("ibels_detail as a");
		$this->db->where("a.igroup",$grup);
		$this->db->where("a.id_pegawai",$id);
		$get = $this->db->get();
		return $get->num_rows();
	}
	
	function getPenunjang(){
		$this->db->select("a.id as id_syarat,a.uraian,a.is_require");
		$this->db->from("m_syarat_ibel as a");
		$this->db->where("a.status","1");
		$get = $this->db->get();
		return $get;
	}
	function getPenunjangEdit($pegawai,$group){
		$query = $this->db->query("Select id from ibels_detail where id_pegawai='".$pegawai."' AND igroup='".$group."'");
		
		$this->db->select("a.id as id_syarat,a.uraian,a.is_require,b.id as id_detail_syarat,b.id_detail,b.nilai");
		$this->db->from("m_syarat_ibel as a");
		$this->db->join("ibels_detail_syarat as b","a.id=b.id_syarat","left");
		if($query->num_rows()>0){
			$this->db->join("ibels_detail as c","b.id_detail=c.id","left");
			$this->db->where("c.id_pegawai",$pegawai);
			$this->db->where("c.igroup",$group);
		}
		$this->db->where("a.status","1");
		$get = $this->db->get();
		return $get;
	}
	
	function calculate_syarat($id_detail){
		$query = $this->db->query("Select id_syarat,nilai from ibels_detail_syarat where id_detail='".$id_detail."'");
		$noValid = array();
		foreach($query->result() as $row){
			$query_m = $this->db->query("Select is_require from m_syarat_ibel where id='".$row->id_syarat."'");
			$m_row = $query_m->row();
			if($m_row->is_require>0 && $row->nilai=='0'){
				$noValid[]='1';
			}
		}
		$this->db->where("id",$id_detail);
		if(!empty($noValid)){
			$this->db->update("ibels_detail",array("status"=>"1"));
		}else{
			$this->db->update("ibels_detail",array("status"=>"2"));
		}
	}
	
	function get_ibel_pegawai($grup){
		$this->db->select("a.*,c.nama,c.nip_baru");
		$this->db->from("ibels_detail as a");
		$this->db->join("ibels_detail_syarat as b","a.id=b.id_syarat","left");
		$this->db->join("pegawai as c","a.id_pegawai=c.id","left");
		$this->db->where("a.igroup",$grup);
		$this->db->group_by("a.id");
		$get = $this->db->get();
		return $get;
	}
	
	function delete_detail($group,$id){
		$this->db->where("igroup",$group);
		$this->db->where("id",$id);
		$del = $this->db->delete("ibels_detail");
		
		if($del){
			$this->db->where("id_detail",$id);
			$this->db->delete("ibels_detail_syarat");
			return true;
		}else{
			return false;
		}
	}
	
	function get_all() {
		$query = $this->db->get('ibel');
		return $query->result_array();
	}
	
	
	function getDataPrintSp($group){
		$this->db->select("a.isp,a.tgl_isp,a.keterangan,c.nip_baru,c.nama,c.gelar_depan,c.gelar_belakang,a.tgl_isp,a.tgl_isk,
						  b.unit as satker,b.pendidikan_terakhir,mj.nama_jabatan as jabatan,pk.gol_terakhir as golongan,pk.tmt_gol_terakhir as tmt_gol,pp.tahun_lulus")
		->from("ibels AS a")
		->join("ibels_detail AS b","a.igroup = b.igroup","LEFT")
		->join("pegawai AS c","b.id_pegawai = c.id","LEFT")
		->join("pegawai_jabatan AS pj","c.id = pj.id_pegawai","LEFT")
		->join("pegawai_kepegawaian AS pk","c.id = pk.id_pegawai","LEFT")
		->join("m_jabatan AS mj","pj.id_jabatan = mj.id_jabatan","LEFT")
		->join("pegawai_pendidikan AS pp","c.id = pp.id_pegawai","LEFT")
		->where("a.igroup",$group);
		$get = $this->db->get();
		return $get->result_array();
	}
	
	function getDataPrintSpHeader($group){
		$this->db->select("a.*,b.nama,b.nip_baru,pk.kepangkatan as jabatanpenandatangan")
		->from("ibels AS a")
		->join("pegawai AS b","a.pegawai_ttd = b.id","LEFT")
		->join("pegawai_kepangkatan AS pk","b.id = pk.id_pegawai","LEFT")
		->where("a.igroup",$group);
		$get = $this->db->get();
		return $get->result_array();
	}
	
	function getDataPrintRekap($group){
		$this->db->select("a.isp,a.tgl_isp,a.keterangan,b.*,c.nip_baru,c.nama")
		->from("ibels AS a")
		->join("ibels_detail AS b","a.igroup = b.igroup","LEFT")
		->join("pegawai AS c","b.id_pegawai = c.id","LEFT")
		->where("a.igroup",$group);
		$get = $this->db->get();
		return $get->result_array();
	}
	
	function getDataPrintSk($group){
		$this->db->select("a.isp,a.tgl_isp,a.keterangan,c.nip_baru,c.nama,c.gelar_depan,c.gelar_belakang,a.tgl_isp,a.tgl_isk,
						  b.unit as satker,b.pendidikan_tujuan,b.pendidikan_jenjang")
		->from("ibels AS a")
		->join("ibels_detail AS b","a.igroup = b.igroup","LEFT")
		->join("pegawai AS c","b.id_pegawai = c.id","LEFT")
		->where("a.igroup",$group);
		$get = $this->db->get();
		return $get->result_array();
	}
	
	function getDataPrintSkHeader($group){
		$this->db->select("a.*,b.nama,b.nip_baru,pk.kepangkatan as jabatanpenandatangan")
		->from("ibels AS a")
		->join("pegawai AS b","a.pegawai_ttd = b.id","LEFT")
		->join("pegawai_kepangkatan AS pk","b.id = pk.id_pegawai","LEFT")
		->where("a.igroup",$group);
		$get = $this->db->get();
		return $get->result_array();
	}
	
	function getGroup($id=''){
		$this->db->select("*")
		->from("ibels");
		if($id){
			$this->db->where("igroup",$id);
		}
		$get = $this->db->get();
		return $get->result();
	}
	
	/*function get_ibel($id) {
		//$this->db->select('id, name, description, price, picture');
		$level=$this->session->userdata('login_state');
		if ($level =='user')
		{
			$this->db->where('nip', $this->session->userdata('nip'));
		}
		else
		{
			$this->db->where('status', 'submit');
		}
		$query = $this->db->get('ibel');

		return $query->result_array();
	}*/
	
	function get_cuti_byid($id){
		$this->db->where('id', $id);
		$query = $this->db->get('vw_cuti');

		return $query->result_array();
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

	public function update_cuti($cuti_id, $data)
	{
		$this->db->where('id', $cuti_id);
		$this->db->update('cuti', $data);
	}
	
}