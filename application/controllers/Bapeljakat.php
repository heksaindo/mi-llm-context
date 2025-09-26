<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bapeljakat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		if($this->session->userdata('login_state') == 'User') {
			redirect('logout');
		}
		$this->data['menumode'] = 'organisasi';
		$this->load->model('bapeljakat_model');
		$this->load->helper('general_helper');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Baperjakat';		
		$this->load->view('bapeljakat/periode_bapeljakat', $this->data);
	}
	
	//==== bapeljakat  ====
	function ajax_bapeljakat()
    {
		$action = $this->uri->segment(3);
		//$user_login = $this->session->userdata('username');
        $result = $this->bapeljakat_model->get_periode_bapeljakat();

		$json["aaData"] = array();
		
		$retval = array(
			//"iTotalRecords" => $iTotalRecords,
			//"iTotalDisplayRecords" => $iTotalRecords,
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$detail = '<a href="'.base_url().'bapeljakat/bapeljakat_list/'.$row['id_pb'].'" class="tip" title="Detail">Detail</a> ';
				$detail .= '&nbsp; | &nbsp;';
				$detail .= '<a href="'.base_url().'bapeljakat/bapeljakat_rekap/'.$row['id_pb'].'" class="tip" title="Detail">Rekap</a>';
					
				array_push($json["aaData"],array(
					$i,
					toInaDate($row['periode_awal']),
					toInaDate($row['periode_akhir']),
					$detail
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	//==== LIst bapeljakat  ====
	public function bapeljakat_list($id_pb='')
	{	
		$this->data['title'] = 'LIST Baperjakat';		
		$this->data['id_pb'] = $id_pb;		
		$this->data['periode_name'] = $this->bapeljakat_model->get_periode($id_pb);		
		$this->load->view('bapeljakat/bapeljakat', $this->data);
	}

	function ajax_list_bapeljakat()
    {
		$action = $this->uri->segment(3);
		$id_pb = $this->input->post('id_pb');
		//$user_login = $this->session->userdata('username');
        $result = $this->bapeljakat_model->get_bapeljakat_byPB($id_pb);

		$json["aaData"] = array();
		
		$retval = array(
			//"iTotalRecords" => $iTotalRecords,
			//"iTotalDisplayRecords" => $iTotalRecords,
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$editnya = '<li><a href="'.base_url().'bapeljakat/bapeljakat_detail/'.$row['id_bapeljakat'].'/'.$id_pb.'" class="tip" title="Edit entry"><i class="fam-application-edit"></i></a> </li>';
				$deletenya = '<li><a onclick="javascript:onDeleteBapeljakat('.$row['id_bapeljakat'].')" class="tip" title="Edit entry"><i class="fam-application-delete"></i></a> </li>';
					
				array_push($json["aaData"],array(
					$i,
					$row['nama_unit_kerja'],
					$row['nama_jabatan'],
					$row['pejabat_lama'],
					$row['pejabat_nip'],
					$row['pangkat_lama'],
					$row['golongan_lama'],
					'<ul class="table-controls">'.$editnya.$deletenya.'</ul>'
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function bapeljakat_add($id_pb)
	{	
		
		$this->data['title'] = 'Add Baperjakat';
		$this->data['id_pb'] = $id_pb;		
		$this->data['periode_name'] = $this->bapeljakat_model->get_periode($id_pb);	
		$this->data['data_unit_kerja'] = $this->bapeljakat_model->ddl_unit_kerja();	
		$this->data['data_jabatan'] = $this->bapeljakat_model->ddl_jabatan();
		$this->load->view('bapeljakat/bapeljakat_add', $this->data);
	}
	
	public function bapeljakat_periode_add()
	{	
		
		$this->data['title'] = 'Add Periode Baperjakat';		
		$this->data['data_unit_kerja'] = $this->bapeljakat_model->ddl_unit_kerja();	
		$this->data['data_jabatan'] = $this->bapeljakat_model->ddl_jabatan();
		$this->load->view('bapeljakat/bapeljakat_periode_add', $this->data);
	}
	
	//AUTOCOMPLETE
	function auto_pegawai(){
		extract($_POST); 
		$where = "a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%'";
		$this->db->select("a.nip_baru, a.gelar_depan, a.nama, a.gelar_belakang, b.golongan, b.kepangkatan")
				->from("pegawai as a")
				->join('pegawai_kepangkatan as b', 'a.nip_baru=b.nip_baru')
				->where($where);
		$this->db->order_by('nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				$status_kepeg = get_name('pegawai_kepegawaian','status_kepegawaian','nip_baru', $row->nip_baru);
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				echo $row->nama."(".$row->nip_baru.") |".$row->nip_baru."|".$nama."|".$row->golongan."|".$row->kepangkatan."\n";
			}
		}
	}
		
	function auto_pegawai_bapeljakat(){
		extract($_POST); 
		$where = "a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%'";
		$this->db->select("a.nip_baru, a.gelar_depan, a.nama, a.gelar_belakang, b.golongan, b.tmt_kepangkatan, c.program_studi, d.id_jabatan")
				->from("pegawai as a")
				->join('pegawai_kepangkatan as b', 'a.nip_baru=b.nip_baru')
				->join('pegawai_pendidikan as c', 'a.nip_baru=c.nip_baru')
				->join('pegawai_jabatan as d', 'a.nip_baru=d.nip_baru')
				->where($where);
		$this->db->order_by('nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				$nama_jabatan = get_name('m_jabatan','nama_jabatan','id_jabatan', $row->id_jabatan);
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				echo $row->nama."(".$row->nip_baru.") |".$nama."|".$row->nip_baru."|".$row->golongan."|".$row->tmt_kepangkatan."|".
					$row->program_studi."| |".$nama_jabatan."\n";
			}
		}
	}
	
	public function bapeljakat_detail($id, $id_pb)
	{	
		$this->data['title'] = 'Baperjakat Detail';	
		$this->data['id_pb'] = $id_pb;		
		$this->data['periode_name'] = $this->bapeljakat_model->get_periode($id_pb);	
		$this->data['bapeljakat'] =	$this->bapeljakat_model->get_bapeljakat($id, $id_pb);
		$this->load->view('bapeljakat/bapeljakat_detail', $this->data);
	}
	
	//====Detail bapeljakat  ====
	function ajax_bapeljakat_detail()
    {
		$action = $this->uri->segment(3);
		$id_bapeljakat = $this->input->post('id_bapeljakat');
		
        $result = $this->bapeljakat_model->get_bapeljakat_detail($id_bapeljakat);

		$json["aaData"] = array();
		
		$retval = array(
			//"iTotalRecords" => $iTotalRecords,
			//"iTotalDisplayRecords" => $iTotalRecords,
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$edit_delete = '<span id="edit-dBapeljakat" onclick="javascript:onEditBapeljakat_detail('.$row->id.')" class="fam-application-edit"></span>
					<span id="delete-dBapeljakat" onclick="javascript:onDeleteBapeljakat_detail('.$row->id.')" class="fam-application-delete"></span>';
				
				$tgl_lahir = $row->tanggal_lahir ? toInaDate($row->tanggal_lahir) : '';
				
				$nilai_1 = "<span class='tip' title='Pangkat'>&nbsp;".$row->nilai_1."</span>";
				$nilai_2 = "<span class='tip' title='Ijazah'>&nbsp;".$row->nilai_2."</span>";
				$nilai_3 = "<span class='tip' title='Diklat Pimpinan'>&nbsp;".$row->nilai_3."</span>";
				$nilai_4 = "<span class='tip' title='DUK'>&nbsp;".$row->nilai_4."</span>";
				$nilai_5 = "<span class='tip' title='Riwayat Jabatan'>&nbsp;".$row->nilai_5."</span>";
				$nilai_6 = "<span class='tip' title='Diklat Teknis/Fungsional'>&nbsp;".$row->nilai_6."</span>";
				$nilai_7 = "<span class='tip' title='Usia'>&nbsp;".$row->nilai_7."</span>";
				$nilai_8 = "<span class='tip' title='Kesehatan'>&nbsp;".$row->nilai_8."</span>";
				$nilai_9 = "<span class='tip' title='Hukum/Disiplin'>&nbsp;".$row->nilai_9."</span>";
				$nilai_10 = "<span class='tip' title='Penghargaan/Lama Pengabdian'>&nbsp;".$row->nilai_10."</span>";
				$nilai_11 = "<span class='tip' title='Kursus'>&nbsp;".$row->nilai_11."</span>";
				$nilai_12 = "<span class='tip' title='Kemampuan Bahasa Inggris'>&nbsp;".$row->nilai_12."</span>";
				$nilai_13 = "<span class='tip' title='Kursus yang berhubungan dengan jabatan'>&nbsp;".$row->nilai_13."</span>";
				
				$jumlah = $row->nilai_1 + $row->nilai_2 + $row->nilai_3 + $row->nilai_4 + $row->nilai_5 + $row->nilai_6 + $row->nilai_7 +
							$row->nilai_8 + $row->nilai_9 + $row->nilai_10 + $row->nilai_11 + $row->nilai_13;
				
				array_push($json["aaData"],array(
					$i,
					$row->calon_nama.' / '.$row->calon_nip.' / '.$tgl_lahir.' / '.$row->agama,
					$row->calon_golongan.' / '.$row->calon_tmt_golongan,
					$row->calon_pendidikan.' / '.$row->calon_diklat,
					$row->calon_riwayatjabatan,
					$nilai_1,
					$nilai_2,
					$nilai_3,
					$nilai_4,
					$nilai_5,
					$nilai_6,
					$nilai_7,
					$nilai_8,
					$nilai_9,
					$nilai_10,
					$nilai_11,
					$nilai_12,
					$nilai_13,
					$jumlah,
					$row->calon_tmt_pensiun,
					$row->catatan_hasil,
					$edit_delete
					
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function cek_nilai($id){
		
		$val = $this->bapeljakat_model->get_bapeljakat_detail_byID($id); 
		
		echo trim($val['calon_nama']).'|'.trim($val['calon_nip']).'|'.$val['nilai_1'].'|'.$val['nilai_2'].'|'.$val['nilai_3'].'|'.$val['nilai_4'].
		'|'.$val['nilai_5'].'|'.$val['nilai_6'].'|'.$val['nilai_7'].'|'.$val['nilai_8'].'|'.$val['nilai_9'].'|'.$val['nilai_10'].'|'.$val['nilai_11'].
		'|'.$val['nilai_12'].'|'.$val['nilai_13'].'|'.$val['catatan_hasil'];
	}
	
	function do_change_nilai($id_detail)
	{
		extract($_POST); 
		$user_input = $this->session->userdata('username');
		
		$data = array(
			'nilai_1' => $nilai_1,
			'nilai_2' => $nilai_2,
			'nilai_3' => $nilai_3,
			'nilai_4' => $nilai_4,
			'nilai_5' => $nilai_5,
			'nilai_6' => $nilai_6,
			'nilai_7' => $nilai_7,
			'nilai_8' => $nilai_8,
			'nilai_9' => $nilai_9,
			'nilai_10' => $nilai_10,
			'nilai_11' => $nilai_11,
			'nilai_12' => $nilai_12,
			'nilai_13' => $nilai_13,
			'catatan_hasil' => $catatan_hasil,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input
		);
		$update = $this->bapeljakat_model->update_bapeljakat_detail($data, $id_detail);
	
		if($update){				
			echo 'success';
		}else{
			echo 'error';
		}	
		
	}
	
	public function add_periode_bapeljakat()
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');

		$data = array(
			'periode_awal' => date('Y-m-d',strtotime($periode_awal)),
			'periode_akhir' => date('Y-m-d',strtotime($periode_akhir)),
			'status_pb' => '1',
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input
		);
		$id_pb = $this->bapeljakat_model->insert_bapeljakat_periode($data);
	
		if($id_pb){
			
			$status = 'success#'.$id_pb;	
		}
		
		echo $status;
	}
	
	public function add_bapeljakat()
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');

		$data = array(
			'id_pb' => $id_pb,
			'unit_kerja_pengusul' => $unit_kerja_pengusul,
			'jabatan_usulan' => $jabatan_usulan,
			'pejabat_lama' => $pejabat_lama,
			'pejabat_nip' => $pejabat_nip,
			'golongan_lama' => $golongan_lama,
			'pangkat_lama' => $pangkat_lama,
			'keterangan' => $keterangan,
			'status_bapeljakat' => '0',
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $user_input
		);
		$id_bapeljakat = $this->bapeljakat_model->insert_bapeljakat($data);
	
		if($id_bapeljakat){
			
			$status = 'success#'.$id_bapeljakat.'#'.$id_pb;	
		}
		
		echo $status;
	}
	
	public function add_bapeljakat_detail()
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');

		$data = array(
			'id_bapeljakat' => $id_bapeljakat,
			'calon_nama' => $calon_nama,
			'calon_nip' => $calon_nip,
			'calon_golongan' => $calon_golongan,
			'calon_tmt_golongan' => $calon_tmt_golongan,
			'calon_pendidikan' => $calon_pendidikan,
			'calon_diklat' => $calon_diklat,
			'calon_riwayatjabatan' => $calon_riwayatjabatan,
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $user_input
		);
		$id_bapeljakat_detail = $this->bapeljakat_model->insert_bapeljakat_detail($data);
	
		if($id_bapeljakat_detail){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_bapeljakat($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->bapeljakat_model->delete_bapeljakat($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function do_delete_bapeljakat_detail()
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->bapeljakat_model->delete_bapeljakat_detail($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	function do_print($id_pb) 
	{	
		$this->data['periode_name'] = $this->bapeljakat_model->get_periode($id_pb);		
		$this->data['bapeljakat'] = $this->bapeljakat_model->get_bapeljakat($id_pb); 
				
		$this->load->view('bapeljakat/print_bapeljakat', $this->data);

	}
	
	function do_print_rekap($id_pb) 
	{	
		$this->data['periode_name'] = $this->bapeljakat_model->get_periode($id_pb);		
		$this->data['bapeljakat'] = $this->bapeljakat_model->get_bapeljakat_rekap($id_pb);  
				
		$this->load->view('bapeljakat/print_bapeljakat_rekap', $this->data);

	}
	
	//==== Rekap bapeljakat  ====
	public function bapeljakat_rekap($id_pb, $id_bapeljakat='')
	{	
		$this->data['title'] = 'Rekap Usulan Baperjakat';		
		$this->data['id_bapeljakat'] = $id_bapeljakat;		
		$this->data['id_pb'] = $id_pb;		
		$this->data['periode_name'] = $this->bapeljakat_model->get_periode($id_pb);		
		$this->load->view('bapeljakat/bapeljakat_rekap', $this->data);
	}

	function ajax_rekap_bapeljakat()
    {
		$action = $this->uri->segment(3);
		$id_pb = $this->input->post('id_pb');
		//$user_login = $this->session->userdata('username');
        $result = $this->bapeljakat_model->get_bapeljakat_rekap($id_pb);

		$json["aaData"] = array();
		
		$retval = array(
			//"iTotalRecords" => $iTotalRecords,
			//"iTotalDisplayRecords" => $iTotalRecords,
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$tgl_lahir = get_name('pegawai','tanggal_lahir','nip_baru', $row['calon_nip']);
				$tgl_lahir = toInaDate($tgl_lahir);
				array_push($json["aaData"],array(
					$i,
					$row['nama_jabatan'],
					$row['eselon'],
					$row['calon_nama'].'<br />'.$row['calon_nip'].'<br />'.$tgl_lahir,
					$row['calon_golongan'].'<br />'.date('d-m-Y', strtotime($row['calon_tmt_golongan'])),
					$row['calon_pendidikan'].'<br />'.$row['calon_diklat'],
					$row['calon_riwayatjabatan'],
					$row['catatan_hasil']
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
}