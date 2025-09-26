<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ibel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'pendidikan';
		$this->load->model('Ibel_model');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('user_id');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $previlege;
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
		
	}
	
	public function index()
	{	
		$this->data['title'] = 'Tugas Belajar';
		
		//$this->data['data_cuti'] = $this->Cuti_model->get_all();
		$this->data['data_ibel'] = array();//$this->Ibel_model->get_ibel($this->session->userdata('nip'));

		$this->load->view('ibel/ibel', $this->data);
	}
	
	public function add()
	{
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Tugas Belajar';
		
		$this->load->view('ibel/add_ibel', $this->data);
	}
	
	function edit($id)
	{
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Cuti';
		$this->data['id']=$id;
		$this->data['status']='edit';
		
		$this->load->view('ibel/add_ibel', $this->data);
	}
	
	public function simpan()
	{
		$nip=preg_replace("/[^\d]/", "", $this->input->post('nip'));
		$UnitKerja=$this->input->post('UnitKerja');
		$id=$this->input->post('id');
		$tanggal_mulai=$this->input->post('tanggal_mulai');
		$tanggal_mulai = date_create($tanggal_mulai);
		$tanggal_mulai=date_format($tanggal_mulai, 'Y-m-d');
		$tanggal_akhir=$this->input->post('tanggal_akhir');
		$tanggal_akhir = date_create($tanggal_akhir);
		$tanggal_akhir=date_format($tanggal_akhir, 'Y-m-d');
		if ($this->input->post('tanggal_mulai') != '') {
			$level=$this->session->userdata('login_state');
		if ($level =='user')
		{
			
		
			$data = array(
					'nip' 				=> $nip,
					'nama'  			=> $this->input->post('nama'),
					'keterangan'  		=> $this->input->post('keterangan'),
					'tanggal_mulai'		=> $tanggal_mulai,
					'tanggal_akhir'		=> $tanggal_akhir,
					'jenis_ibel' 		=> $this->input->post('jenis_ibel'),
					'alamat'			=> $this->input->post('alamat_cuti'),
					'status'			=> 'submit'
				);
		}
		else		
		{
			$data = array(
					'nip' 				=> $nip,
					'nama'  			=> $this->input->post('nama'),
					'keterangan'  		=> $this->input->post('keterangan'),
					'tanggal_mulai'		=> $tanggal_mulai,
					'tanggal_akhir'		=> $tanggal_akhir,
					'jenis_ibel' 		=> $this->input->post('jenis_ibel'),
					'alamat'			=> $this->input->post('alamat_cuti'),
					'status'			=> 'submit'
				);
		
		
		}
		if (!empty($id))
		{
			$this->db->where('id', $id);
			$this->db->update('ibel', $data); 
			//$this->Cuti_model->insert_cuti($data);
		}
		else
		{
			$this->db->insert('ibel', $data); 
		}
		}
		redirect('ibel');
	}
	
	public function approve()
	{
		$this->data['title'] = 'Approve Cuti';
		
		$this->data['data_ibel'] = $this->Ibel_model->get_all();
		
		$this->load->view('ibel/approve_ibel', $this->data);
	}
	
	public function approveibel($id)
	{
		$data = array(
				'status'		=> 'approved'
			);
		$this->db->where('id', $id);
		$this->db->update('ibel', $data); 	
		
		redirect('ibel/approve');
	}
	
	public function rejectibel($id)
	{
		$data = array(
				'status'		=> 'rejected'
			);
			
		$this->db->where('id', $id);
		$this->db->update('ibel', $data); 
		
		redirect('ibel/approve');
	}
	
	public function cetak($id)
	{
		$this->data['title'] = 'Print Cuti';
		$query = $this->db->query("select * from ibel where id=$id");
		$this->data['data']=$query->result_array();
		
		$this->load->view('ibel/cetak', $this->data);
	}
	
	/**
	 *New design
	 **/
	public function add_ibel(){
		$id_peg = $this->input->post("id_pegawai");
		$asal_surat = $this->input->post("asal_surat");
		$tembusan = $this->input->post("tembusan");
		$result = $this->Ibel_model->add_ibel($id_peg,$asal_surat,$tembusan);
		if($result){
			echo 'success';
		}else{
			echo 'failed';
		}
	}
	
	public function ajax_ibel(){
		$result = $this->Ibel_model->get_ibel();
		
		$json["aaData"] = array();
		foreach($result as $row)
		{
			if($row->isp !=""){
				$isp = "<span id=\"ibel_edit-isp\" onclick=\"javascript:addIsp('".$row->igroup."','".$row->isp."','".$row->tgl_isp."')\" class=\"act-btn\">".$row->isp."</span>";
				$isp_bol = 'true';
			}else{
				$isp = "<span id=\"ibel_add-isp\" onclick=\"javascript:addIsp('".$row->igroup."')\" class=\"act-btn fam-help\"></span>";
				$isp_bol = 'false';
			}
			
			if($row->isk !=""){
				$isk = "<span id=\"ibel_edit-isk\" onclick=\"javascript:addIsk('".$row->igroup."','".$row->isk."','".$row->tgl_isk."')\" class=\"act-btn\">".$row->isk."</span>";
				$isk_bol = 'true';
			}else{
				$isk = "<span id=\"ibel_add-isk\" onclick=\"javascript:addIsk('".$row->igroup."')\" class=\"act-btn fam-help\"></span>";
				$isk_bol = 'false';
			}
			if($row->isPegawai>0){
				$icon_fam = 'fam-application-view-list';
				$title = 'Daftar pegawai';
			}else{
				$icon_fam = 'fam-help';
				$title = 'Belum ada pegawai';
			}
			$list = "<span style=\"margin-left:35px;\" id=\"ibel_list-pegawai\" onclick=\"javascript:onList('".$row->igroup."')\" class=\"tip act-btn ".$icon_fam."\" title=\"$title\"></span>";
			$action = "<span id=\"ibel_usulan\" onclick=\"javascript:printUsulan('".$row->igroup."',".$isp_bol.")\" class=\"tip act-btn fam-printer\" title=\"Print Usulan\"></span> | ";
			$action .= "<span id=\"ibel_sk\" onclick=\"javascript:printSk('".$row->igroup."',".$isk_bol.")\" class=\"tip act-btn fam-printer\" title=\"Print SK\"></span> | ";
			$action .= "<span id=\"ibel_delete\" onclick=\"javascript:onDeleteIbel('".$row->igroup."')\" class=\"tip act-btn fam-application-delete\" title=\"Hapus Usulan\"></span>";
			array_push($json["aaData"],array(
				$row->igroup,
				$isp,
				$isk,
				$list,
				$action
				)
			);
		}
		header("Content-type: application/json");
        echo json_encode($json);
	}
	
	public function del_ibel($force=''){
		$group = $this->input->post('group');
		$result = $this->Ibel_model->del_ibel($group,$force);
		if($result){
			echo 'success';
		}else{
			echo 'failed|0|Hapus Data Group Ibel gagal';
		}
	}
	
	public function do_save_sp(){
		$group = $this->input->post('ig');
		$isp = $this->input->post('isp');
		$tanggal_sp = $this->input->post('tanggal_sp');
		$data = array(
			"isp"=>$isp,
			"tgl_isp"=>date("Y-m-d",strtotime($tanggal_sp))
		);
		$result = $this->Ibel_model->update_ibel($group,$data);
		if($result){
			echo 'success';
		}else{
			echo 'failed';
		}
	}
	public function do_save_sk(){
		$group = $this->input->post('ig');
		$isk = $this->input->post('isk');
		$tanggal_sk = $this->input->post('tanggal_sk');
		$data = array(
			"isk"=>$isk,
			"tgl_isk"=>date("Y-m-d",strtotime($tanggal_sk))
		);
		$result = $this->Ibel_model->update_sk($group,$data);
		if($result[0]){
			echo 'success';
		}else{
			echo 'failed|'.$result[1];
		}
	}
	
	public function listpegawai($group){
		$this->data['title'] = 'Daftar Pegawai Tugas Belajar';
		$this->data['group'] = $group;
		$this->data['sp'] = $this->Ibel_model->getIbel($group,'isp');
		$this->load->view('ibel/pegawai', $this->data);
	}
	
	public function mpegawai($group){
		$this->data['group'] = $group;
		
		if($this->uri->segment(4)){
			$dt_id= $this->uri->segment(4);
			$this->data['title'] = 'Edit Daftar Pegawai Tugas Belajar';
			$this->data['id'] = $dt_id;
			$this->load->view('ibel/edit_pegawai', $this->data);
		}else{
			$this->data['title'] = 'Tambah Daftar Pegawai Tugas Belajar';
			$this->load->view('ibel/add_pegawai', $this->data);
		}
	}
	
	function data_print_sp($group){
		$this->data['usulan_detail'] = $this->Ibel_model->getDataPrintSp($group);
		$this->data['usulan_header'] = $this->Ibel_model->getDataPrintSpHeader($group);
		$this->load->view('ibel/print_usulan', $this->data);
	}
	
	function data_print_sk($group){
		$this->data['sk_detail'] = $this->Ibel_model->getDataPrintSk($group);
		$this->data['sk_header'] = $this->Ibel_model->getDataPrintSkHeader($group);
		$this->load->view('ibel/print_sk', $this->data);
	}
	
	function data_print_rekap($group){
		$this->data['rekap_detail'] = $this->Ibel_model->getDataPrintRekap($group);
		$this->load->view('ibel/print_rekap', $this->data);
	}
	
	public function detail_ibel(){
		$id = $this->input->post("id");
		$this->db->select("a.*,b.nama,b.nip_baru,b.gelar_depan, b.gelar_belakang,c.kode_unit_kerja")
		->from("ibels_detail as a")
		->join("pegawai as b","a.id_pegawai=b.id")
		->join('pegawai_jabatan as c', 'b.id = c.id_pegawai', false)
		->where("a.id",$id);
		$get = $this->db->get();
		if($get->num_rows()>0){
			foreach($get->result() as $row){
				
				$pangkat = $row->pangkat_gol;
				
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				
				$th = explode("/",$row->tahun_ajaran);
				
				echo $nama."|".$row->pendidikan_tujuan."|".$row->instansi_tujuan."|".$th[0]."|".$th[1]."|".$row->nip_baru."|".$pangkat."|".$row->id_pegawai.
				"|".$row->kode_unit_kerja."|".$row->unit."|".$row->pendidikan_terakhir."|".$row->pendidikan_jenjang."\n";
			}
		}
	}
	
	public function auto_pegawai(){
		extract($_POST);
		
		$where = "(a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%')";
		$this->db->select('a.id as id_pegawai, a.gelar_depan, a.gelar_depan, a.nama, a.gelar_belakang, a.gelar_belakang, a.nip_baru,
						  b.eselon,b.kode_unit_kerja, e.nama_unit_kerja as kantor,
						  c.program_studi,c.jurusan,c.nama_sekolah,c.tahun_lulus,
						  d.no_sk, d.kepangkatan, d.tgl_sk AS tanggal_sk,
						  d.pejabat_penandatangan AS pejabat_penetapan,
						  d.tmt_kepangkatan,f.gol_terakhir
						  ')
				->from('pegawai as a', false)
				->join('pegawai_jabatan as b', 'a.id = b.id_pegawai', false)
				->join('pegawai_pendidikan as c','a.id = c.id_pegawai', false)
				->join('pegawai_kepangkatan as d','a.id = d.id_pegawai', false)
				->join('m_unit_kerja as e','b.kode_unit_kerja = e.kode_unit_kerja', 'LEFT', false)
				->join('pegawai_kepegawaian as f','a.id = f.id_pegawai', false)
				->where('a.status','aktif')
				->where($where);
		$this->db->order_by('a.nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		
		if($q_part->num_rows()>0){
			foreach($q_part->result() as $row){
				
				$pangkat = $row->kepangkatan.' - '.$row->gol_terakhir;
				
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				
				echo $nama."|".$row->nip_baru."|".$pangkat."|".$row->kode_unit_kerja."|".$row->kantor."|".$row->gol_terakhir.
				"|".$row->program_studi."|".$row->jurusan."|".$row->nama_sekolah."|".$row->tahun_lulus."|".$row->id_pegawai."\n";
			}
		}
	}
	
	public function ajax_penunjang(){
		$idPegawai = $this->input->post('id_pegawai');
		$group = $this->input->post('igroup');
		$tipe = $this->input->post('tipe');
		$json["aaData"] = array();
		
		if($tipe=='edit'){
			$result = $this->Ibel_model->getPenunjangEdit($idPegawai,$group);
			$i=1;
			if($result->num_rows()>0){
				foreach($result->result() as $row){
					if($row->nilai>0){
						$selecYa = "checked";
						$selecNo = "";
					}else{
						$selecYa = "";
						$selecNo = "checked";
					}
					
					$action_ya = '<input '.$selecYa.' id="ya_sy_'.$row->id_syarat.'" type="radio" name="sy_'.$row->id_syarat.'" value="1">';
					$action_tidak = '<input '.$selecNo.' id="td_sy_'.$row->id_syarat.'" type="radio" name="sy_'.$row->id_syarat.'" value="0">';
					array_push($json["aaData"],array(
						$i,
						$row->uraian,
						$action_ya,
						$action_tidak
					));
					$i++;
				}
			}
		}else{
			$result = $this->Ibel_model->getPenunjang();
			$i=1;
			if($result->num_rows()>0){
				foreach($result->result() as $row){
					$selecYa = "";
					$selecNo = "checked";
					
					$action_ya = '<input '.$selecYa.' id="ya_sy_'.$row->id_syarat.'" type="radio" name="sy_'.$row->id_syarat.'" value="1">';
					$action_tidak = '<input '.$selecNo.' id="td_sy_'.$row->id_syarat.'" type="radio" name="sy_'.$row->id_syarat.'" value="0">';
					array_push($json["aaData"],array(
						$i,
						$row->uraian,
						$action_ya,
						$action_tidak
					));
					$i++;
				}
			}
		}
		header("Content-type: application/json");
        echo json_encode($json);
	}
	
	public function insert_list(){
		$user_input = $this->session->userdata('user_id');
		$did = $this->input->post('id');
		$group = $this->input->post('igroup');
		$pegawai = $this->input->post('id_pegawai');
		$pangkat = $this->input->post('pangkat');
		$kantor = $this->input->post('kantor');
		$inst_tujuan = $this->input->post('instansi_dituju');
		$jur_tujuan = $this->input->post('jurusan_dituju');
		$jenjang_tujuan = $this->input->post("pendidikan_jenjang");
		$pend_terakhir = $this->input->post('pendidikan_terkahir');
		$th_ajar = $this->input->post('th_akademik_from').'/'.$this->input->post('th_akademik_to');
		$query = false;
		
		if(!$group){
			
		}
		
		$cek = $this->Ibel_model->cekIbelDetail($group,$pegawai);
		if(!$did && $cek>0){
			die("failed|Data pegawai sudah ada di group ini!");
		}
		
		$data = array(
			'igroup'	=>$group,
			'id_pegawai'=>$pegawai,
			'pangkat_gol'=>$pangkat,
			'unit'=>$kantor,
			'pendidikan_terakhir'=>$pend_terakhir,
			'pendidikan_jenjang'=>$jenjang_tujuan,
			'pendidikan_tujuan'=>$jur_tujuan,
			'instansi_tujuan'=>$inst_tujuan,
			'tahun_ajaran'=>$th_ajar
		);
		
		if(!$did){
			$data['status'] = '0';
			$data['created_date']= date('Y-m-d H:i:s');
			$data['created_by']	=$user_input;
			$query = $this->db->insert('ibels_detail', $data);
			$id = $this->db->insert_id();
			
			if($query){
				$result = $this->Ibel_model->getPenunjang();
				if($result->num_rows()>0){
					$query_sy = false;
					foreach($result->result() as $row){
						$nilai = $this->input->post('sy_'.$row->id_syarat) ? $this->input->post('sy_'.$row->id_syarat) : '0';
						$data_sy = array(
							'id_detail'=>$id,
							'id_syarat'=>$row->id_syarat,
							'nilai'=>$nilai,
							'created_date'=>date('Y-m-d H:i:s'),
							'created_by'=>$user_input
						);
						$query_sy = $this->db->insert('ibels_detail_syarat', $data_sy);
					}
					if($query_sy){
						$this->Ibel_model->calculate_syarat($id);
					}
				}
			}
		}else{
			$data['updated_date']= date('Y-m-d H:i:s');
			$data['updated_by']	=$user_input;
			$this->db->where("id",$did);
			$query = $this->db->update('ibels_detail', $data);
			if($query){
				$this->db->where("id_detail",$did);
				$del_sy = $this->db->delete("ibels_detail_syarat");
				$result = $this->Ibel_model->getPenunjang();
				if($result->num_rows()>0 && $del_sy){
					$query_sy = false;
					foreach($result->result() as $row){
						$nilai = $this->input->post('sy_'.$row->id_syarat) ? $this->input->post('sy_'.$row->id_syarat) : '0';
						$data_sy = array(
							'id_detail'=>$did,
							'id_syarat'=>$row->id_syarat,
							'nilai'=>$nilai,
							'created_date'=>date('Y-m-d H:i:s'),
							'created_by'=>$user_input
						);
						$query_sy = $this->db->insert('ibels_detail_syarat', $data_sy);
					}
					if($query_sy){
						$this->Ibel_model->calculate_syarat($did);
					}
				}
			}
		}
		
		if($query){
			echo 'success';
		}else{
			echo 'failed|Proses data pegawai gagal';
		}
	}
	
	public function del_detail_ibel(){
		$id = $this->input->post('id');
		$group = $this->input->post('group');
		
		$proses = $this->Ibel_model->delete_detail($group,$id);
		if($proses){
			echo 'success';
		}else{
			echo 'failed|Proses data pegawai gagal';
		}
	}
	
	public function ajax_ibel_pegawai($group){
		$result = $this->Ibel_model->get_ibel_pegawai($group);
		
		$json["aaData"] = array();
		$i=1;
		foreach($result->result() as $row)
		{
			if($row->status=='1'){
				$status = 'Tidak Valid';
			}elseif($row->status=='2'){
				$status = 'Valid';
			}else{
				$status ='On Request';
			}
			$action = "<span id=\"ibel_edit\" onclick=\"javascript:onEdit('".$row->igroup."',".$row->id.")\" class=\"tip act-btn fam-application-edit\" title=\"Edit\"></span> | ";
			$action .= "<span id=\"ibel_delete\" onclick=\"javascript:onDelete('".$row->igroup."',".$row->id.")\" class=\"tip act-btn fam-delete\" title=\"Delete\"></span>";

			array_push($json["aaData"],array(
				$i,
				$row->nama,
				$row->nip_baru,
				$row->pangkat_gol,
				$row->pendidikan_terakhir,
				$row->pendidikan_tujuan,
				$row->instansi_tujuan,
				$row->tahun_ajaran,
				$row->unit,
				$status,
				$action
				)
			);
			$i++;
		}
		header("Content-type: application/json");
        echo json_encode($json);
	}
}