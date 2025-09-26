<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cuti extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'penugasandankehadiran';
		$this->load->model('Cuti_model');
		$this -> load -> library( 'form_validation' );
		$this->load->helper('general_helper');
		$this->load->model('kgp_model');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$this->username = $this->session->userdata('user_id');
		$this->previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->previlege;
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($this->username, $this->previlege);
	}
	
	function check_nip_baru()
	{
		extract($_POST); 
			$where = "(a.nip_baru like '".$q."%')";
			$this->db->select("a.*")
					->from("pegawai a")
					->where('a.status','aktif')
					->where($where);
			$this->db->order_by('a.nama', 'ASC');
			$this->db->limit(10);
			$q_part=$this->db->get();
			$count = $this->db->count_all_results();
			if ($count>0){
				
				foreach($q_part->result() as $row){
					$tgl_lahir = '';
					if(!empty($row->tanggal_lahir)){
						$tgl_lahir = date('d-m-Y',strtotime($row->tanggal_lahir));
					}
					echo $row->nip_baru."  (".$row->nama.")|".$row->nip_baru."|".$row->nama."|".$row->gelar_depan."|".$row->gelar_belakang.
						"|".$row->no_kartu."|".trim($row->jenis_kelamin)."|".trim($row->tempat_lahir)."|".$tgl_lahir."|".$row->id."\n";
				}
			}else{
				echo 'error';
			}
	}
	
	function CekUnitKerja()
	{
		extract($_POST); 
			$where = "(a.nama_unit_kerja like '%".$q."%')";
			$this->db->select("a.*")
					->from("m_unit_kerja a")
					->where($where);
			$this->db->order_by('a.nama_unit_kerja', 'ASC');
			$this->db->limit(10);
			$q_part=$this->db->get();
			$count = $this->db->count_all_results();
			if ($count>0){
				
				foreach($q_part->result() as $row){
					//$tgl_lahir = '';
					//if(!empty($row->tanggal_lahir)){
					//	$tgl_lahir = date('d-m-Y',strtotime($row->tanggal_lahir));
					//}
					echo $row->nama_unit_kerja."\n";
				}
			}else{
				echo 'error';
			}
	}
	
	public function index()
	{	
		$this->data['title'] = 'Cuti';
		
		$this->data['data_jabatan_ttd'] = $this->Cuti_model->ddl_jabatan_ttd();
		//$this->data['data_cuti'] = $this->Cuti_model->get_all();

		$this->load->view('cuti/cuti', $this->data);
	}
	
	
	public function ajax_cuti(){
		if($this->previlege != 'User'){
			$cuti = $this->Cuti_model->get_all();
		}else{
			$peg_id = $this->session->userdata('pegawai_id');
			$cuti = $this->Cuti_model->get_all($peg_id);
		}
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		
		foreach($cuti as $row)
		{
			$id = $row['id'];
			$before_status = $row['status_cuti'];
			$arrcuti = array(1,3,4);
			switch ($row['status_cuti'])
			{										
				case '1' :
					$img1 = '<img src="'.base_url().'img/green.png" />';
					$img2 = '<img src="'.base_url().'img/yellow.png" />';
					$img3 = '<img src="'.base_url().'img/yellow.png" />';
					$img4 = '<img src="'.base_url().'img/yellow.png" />';
					$img5 = '<img src="'.base_url().'img/yellow.png" />';
					$img6 = '<img src="'.base_url().'img/yellow.png" />';
					$img7 = '<img src="'.base_url().'img/yellow.png" />';
					break;
				case '2' :
					$img1 = '<img src="'.base_url().'img/green.png" />';
					$img2 = '<img src="'.base_url().'img/green.png" />';
					$img3 = '<img src="'.base_url().'img/yellow.png" />';
					$img4 = '<img src="'.base_url().'img/yellow.png" />';
					$img5 = '<img src="'.base_url().'img/yellow.png" />';
					$img6 = '<img src="'.base_url().'img/yellow.png" />';
					$img7 = '<img src="'.base_url().'img/yellow.png" />';
					break;
				case '3' :
					$img1 = '<img src="'.base_url().'img/green.png" />';
					$img2 = '<img src="'.base_url().'img/green.png" />';
					$img3 = '<img src="'.base_url().'img/green.png" />';
					$img4 = '<img src="'.base_url().'img/yellow.png" />';
					$img5 = '<img src="'.base_url().'img/yellow.png" />';
					$img6 = '<img src="'.base_url().'img/yellow.png" />';
					$img7 = '<img src="'.base_url().'img/yellow.png" />';
					break;
				case '4' :
					$img1 = '<img src="'.base_url().'img/green.png" />';
					$img2 = '<img src="'.base_url().'img/green.png" />';
					$img3 = '<img src="'.base_url().'img/green.png" />';
					$img4 = '<img src="'.base_url().'img/green.png" />';
					$img5 = '<img src="'.base_url().'img/yellow.png" />';
					$img6 = '<img src="'.base_url().'img/yellow.png" />';
					$img7 = '<img src="'.base_url().'img/yellow.png" />';
					break;
				case '5' :
					$img1 = '<img src="'.base_url().'img/green.png" />';
					$img2 = '<img src="'.base_url().'img/green.png" />';
					$img3 = '<img src="'.base_url().'img/green.png" />';
					$img4 = '<img src="'.base_url().'img/green.png" />';
					$img5 = '<img src="'.base_url().'img/green.png" />';
					$img6 = '<img src="'.base_url().'img/yellow.png" />';
					$img7 = '<img src="'.base_url().'img/yellow.png" />';
					break;
				case '6' :
					$img1 = '<img src="'.base_url().'img/green.png" />';
					$img2 = '<img src="'.base_url().'img/green.png" />';
					$img3 = '<img src="'.base_url().'img/green.png" />';
					$img4 = '<img src="'.base_url().'img/green.png" />';
					$img5 = '<img src="'.base_url().'img/green.png" />';
					$img6 = '<img src="'.base_url().'img/green.png" />';
					$img7 = '<img src="'.base_url().'img/yellow.png" />';
					break;
				case '7' :
					$img1 = '<img src="'.base_url().'img/green.png" />';
					$img2 = '<img src="'.base_url().'img/green.png" />';
					$img3 = '<img src="'.base_url().'img/green.png" />';
					$img4 = '<img src="'.base_url().'img/green.png" />';
					$img5 = '<img src="'.base_url().'img/green.png" />';
					$img6 = '<img src="'.base_url().'img/green.png" />';
					$img7 = '<img src="'.base_url().'img/green.png" />';
					break;
				default :
					$img1 = '<img src="'.base_url().'img/yellow.png" />';
					$img2 = '<img src="'.base_url().'img/yellow.png" />';
					$img3 = '<img src="'.base_url().'img/yellow.png" />';
					$img4 = '<img src="'.base_url().'img/yellow.png" />';
					$img5 = '<img src="'.base_url().'img/yellow.png" />';
					$img6 = '<img src="'.base_url().'img/yellow.png" />';
					$img7 = '<img src="'.base_url().'img/yellow.png" />';
				break;
			}
			
			$status1 = "<a href='#' onclick='change_status(\"1\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\")' class='tip' data-toggle='tooltip' title='Dokumen Usulan Masuk'>".$img1."</a>";
			$status2 = "<a href='#' onclick='change_status(\"2\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\")' class='tip' title='Proses Entry Data' >".$img2."</a>";													
			if($this->previlege =='User'){
				$cetakv ='';
				$accv='';
				$ttd='';
				$penomoran='';
			}else{
				$cetakv = "change_status(\"3\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\")";
				$accv = "change_status(\"4\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\")";
				$ttd="change_status(\"5\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\")";
				$penomoran = "change_status(\"6\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\")";
			}
			$status3 = "<a href='#' onclick='".$cetakv."' class='tip' title='Cetak Verbal' >".$img3."</a>";													
			$status4 = "<a href='#' onclick='".$accv."' class='tip' title='Acc Verbal' >".$img4."</a>";													
			$status5 = "<a href='#' onclick='".$ttd."' class='tip' title='Tanda Tangan' >".$img5."</a>";													
			$status6 = "<a href='#' onclick='".$penomoran."' class='tip' title='Penomoran SK' >".$img6."</a>";	
			
			if($this->previlege !='User'){
				if(in_array($row['jenis_cuti'],$arrcuti)){
					$status7 = "<a href='#' onclick='change_status(\"7\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\",\"1\",\"".$row['jenis_cuti']."\")' class='tip' title='SK Selesai' >".$img7."</a>";
				}else{
					$status7 = "<a href='#' onclick='change_status(\"7\",\"".$row['pegawai_id']."\",\"".$id."\", \"".$row['yang_mengajukan']."\", \"".$before_status."\",\"2\",\"".$row['jenis_cuti']."\")' class='tip' title='Kirim Ke Ropeg' >".$img7."</a>";
				}
			}else{
				$status7 = "<a href='#'>".$img7."</a>";
			}
			array_push($json["aaData"],array(
				$i,
				'<a href="'.base_url().'pegawai/detail/'.$row['pegawai_id'].'" class="tip" title="Detail Pegawai" >'.$row['yang_mengajukan'].'</a><br>'.$row['nip_baru'],
				$row['nama_cuti'],
				$row['tgl_pengajuan'],
				$row['tgl_mulai'],
				$row['tgl_akhir'],
				$status1,
				$status2,
				$status3,
				$status4,
				$status5,
				$status6,
				$status7
			));
			$i++;
		}
		header("Content-type: application/json");
        echo json_encode($json);
	}
	
	public function do_change_status(){
		extract($_POST); 
		$user_input = $this->session->userdata('user_id');
		$update = false;
		if(!empty($id)){

			$data['status_cuti'] = $newstatus;
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$update = $this->Cuti_model->update_cuti($id,$data);
		}
		if($update){
			echo 'success';
		}else{
			echo 'failed';
		}
	}
	
	function get_skselesai(){
		extract($_POST);
		$cuti = $this->Cuti_model->get_cuti($id);
		if (!empty($cuti)){
				foreach($cuti as $row){
				$nama_ttd = ucwords(strtolower($row['nama_ttd']));
				if(!empty($row['gd_ttd'])){
					$nama_ttd = $row['gd_ttd'].' '.ucwords(strtolower($row['nama_ttd']));
				}
				
				if(!empty($row['gb_ttd'])){
					$nama_ttd = $nama_ttd.', '.$row['gb_ttd'];
				}
				
				echo $row['nomor_surat']."|".$row['tempat_surat']."|".date('d-m-Y',strtotime($row['tgl_surat']))."|".$row['kepada']."|".$row['kepada_di'].
				"|".$row['nip_ttd']."|".$nama_ttd."|".$row['jabatan_ttd']."|".$row['id_ttd']."|".$row['tembusan']."\n";
				}
		}else{
			echo '';
		}
	}
	
	public function update(){
		extract($_POST);
		$user = $this->session->userdata('user_id');
		$tgl_surat = date("Y-m-d",strtotime($tgl_surat));
		$data = array(
			'nomor_surat' => $no_surat,
			'tgl_surat' => $tgl_surat,
			'tempat_surat' => $tempat_surat,
			'jabatan_ttd' => $jabatan_ttd,
			'id_ttd' => $ttd,
			'kepada' => $kepada,
			'kepada_di' => $kepada_di,
			'status_cuti' => $status_cuti,
			'tembusan' => $tembusan,
			'updated_date' => date("Y-m-d"),
			'updated_by' => $user
		);
		$do_ = $this->Cuti_model->update_cuti($id,$data);
		if($do_){
			if($status_cuti==7){
				$cuti = $this->Cuti_model->get_result_cuti($do_);
				if(!empty($cuti)){
					foreach($cuti as $rowcuti){
					$date1 = strtotime($rowcuti->tgl_mulai);
					$date2 = strtotime($rowcuti->tgl_akhir);
					$diff = $date2 - $date1;
					$kdate = date("Y",$date1);
					$kuota = $this->Cuti_model->getKuota($rowcuti->jenis_cuti);
					$selisih = floor($diff / (60 * 60 * 24));
					if($kuota > 0){
						if($jenis==2){
							$sisa = $this->Cuti_model->getSisa($rowcuti->jenis_cuti,$rowcuti->pegawai_id,date("Y-m-d",$date1),true);
						}else{
							$sisa = $this->Cuti_model->getSisa($rowcuti->jenis_cuti,$rowcuti->pegawai_id,$kdate);
						}
						if($sisa->sisa =='_'){
							$newsisa = $kuota - $selisih;
							$datsisa = array(
								'id_pegawai'=>$rowcuti->pegawai_id,
								'jenis_cuti'=>$rowcuti->jenis_cuti,
								'tahun'=>date("Y-m-d",$date1),
								'sisa'=>$newsisa
							);
							$this->Cuti_model->setSisa('',$datsisa);
						}elseif($sisa !='_'){
							$newsisa = $sisa->sisa - $selisih;
							$datsisa = array(
								'id_pegawai'=>$rowcuti->pegawai_id,
								'jenis_cuti'=>$rowcuti->jenis_cuti,
								'tahun'=>date("Y-m-d",$date1),
								'sisa'=>$newsisa
							);
							$this->Cuti_model->setSisa($sisa->id,$datsisa);
						}
					}
				}
				}
			}
			$status = 'success';	
		}else{
			$status = 'failed';
		}
		
		echo $status;
	}
	
	public function insert($id = ''){
		
		$status = 'error';
		$do_ = '';
		$msg = '';
		$oke = true;
		$pegawai_id = $this->input->post('pegawai_id');
		$date1 = strtotime($this->input->post('tgl_mulai'));
		$date2 = strtotime($this->input->post('tgl_akhir'));
		$diff = $date2 - $date1;
		$user_input = $this->session->userdata('user_id');
		$jenis = $this->input->post('jenis_cuti');
		$kdate = date("Y",$date1);
		$selisih = floor($diff / (60 * 60 * 24));
		if($jenis==2){
			$sisa = $this->Cuti_model->getSisa($jenis,$pegawai_id,date("Y-m-d",$date1),true);
		}else{
			$sisa = $this->Cuti_model->getSisa($jenis,$pegawai_id,$kdate);
		}
		$kuota = $this->Cuti_model->getKuota($jenis);
		if($selisih > 0){
			if($sisa->sisa !='_' && $kuota>0){
				if($jenis==2){
					$oke = false;
					$msg = 'Kuota Cuti Besar 5th Sudah Habis';
				}else{
					if($selisih > $sisa->sisa){
						$oke = false;
						$msg = 'Range Jumlah Cuti Terlalu Banyak / Kuota Cuti Sudah Habis';
					}
				}
			}elseif($sisa->sisa = '_' && $kuota > 0){
				if($kuota < $selisih){
					$oke = false;
					$msg = 'Range Jumlah Cuti Terlalu Banyak';
				}
			}
		}else{
			$oke = false;
			$msg = 'Tanggal akhir harus lebih besar dari tanggal awal';
		}

		$data = array(
			'pegawai_id' => $pegawai_id,
			'tgl_pengajuan' => date("Y-m-d",strtotime($this->input->post('tgl_pengajuan'))),
			'jenis_cuti' => $jenis,
			'tgl_mulai'	=> date("Y-m-d",strtotime($this->input->post('tgl_mulai'))),
			'tgl_akhir'	=> date("Y-m-d",strtotime($this->input->post('tgl_akhir'))),
			'status_cuti' => $this->input->post('status_cuti'),
			'jumlah' => $selisih
		);
		
		if($oke){
			if(empty($id)){
				$data['created_date'] = date("Y-m-d H:i:s");
				$data['created_by']=$user_input;
				$do_ = $this->Cuti_model->insert_cuti($data);
			}else{
				$data['updated_date'] = date("Y-m-d H:i:s");
				$data['updated_by']=$user_input;
				$do_ = $this->Cuti_model->update_cuti($id,$data);
			}
			if($do_){
				$status = 'success';	
			}
		}
		
		echo $status."|".$msg."\n";

	}
	
	public function do_popup_cutitahunan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$date1 = new DateTime(date($this->input->post('tgl_mulai')));
		$date2 = new DateTime(date($this->input->post('tgl_akhir')));
		$selisih = $date1->diff($date2);
		$data = array(
			'pegawai_id' => $pegawai_id,
			'tgl_pengajuan' => $tgl_pengajuan,
			'yang_mengajukan' => $yang_mengajukan,
			'jenis_cuti' => $jenis_cuti,
			'tgl_mulai'	=> $tgl_mulai,
			'tgl_akhir'	=> $tgl_akhir,
			'status_cuti' => $status_cuti,
			'jumlah' => $selisih->d
		);
			
		if(empty($id)){
			$do_ = $this->Cuti_model->insert_cuti($data);
		}else{
			$do_ = $this->Cuti_model->update_cuti($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		
		echo $status;
	}
	public function cek_cutitahunan($id){
		
		$val = $this->cuti_model->get_cuti_byid($id); 
		
		echo trim($val['pegawai_id']).'|'.trim($val['tgl_pengajuan']).'|'.trim($val['yang_mengajukan']).'|'.trim($val['jenis_cuti']).'|'.trim($val['tgl_mulai']).'|'.trim($val['tgl_akhir']);
	}
	
	public function do_popup_cutisakit($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$date1 = new DateTime(date($this->input->post('tgl_mulai')));
		$date2 = new DateTime(date($this->input->post('tgl_akhir')));
		$selisih = $date1->diff($date2);
		
		$data = array(
			'pegawai_id' => $pegawai_id,
			'tgl_pengajuan' => $tgl_pengajuan,
			'yang_mengajukan' => $yang_mengajukan,
			'jenis_cuti' => $jenis_cuti,
			'tgl_mulai'	=> $tgl_mulai,
			'tgl_akhir'	=> $tgl_akhir,
			'status_cuti' => $status_cuti,
			'jumlah' => $selisih->d
		);
			
		if(empty($id)){
			$do_ = $this->Cuti_model->insert_cuti($data);
		}else{
			$do_ = $this->Cuti_model->update_cuti($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	public function cek_cutisakit($id){
		
		$val = $this->cuti_model->get_cuti_byid($id); 
		
		echo trim($val['pegawai_id']).'|'.trim($val['tgl_pengajuan']).'|'.trim($val['yang_mengajukan']).'|'.trim($val['jenis_cuti']).'|'.trim($val['tgl_mulai']).'|'.trim($val['tgl_akhir']);
	}
	
	public function do_popup_cutialasanpenting($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$date1 = new DateTime(date($this->input->post('tgl_mulai')));
		$date2 = new DateTime(date($this->input->post('tgl_akhir')));
		$selisih = $date1->diff($date2);
		
		
		$data = array(
			'pegawai_id' => $pegawai_id,
			'tgl_pengajuan' => $tgl_pengajuan,
			'yang_mengajukan' => $yang_mengajukan,
			'jenis_cuti' => $jenis_cuti,
			'tgl_mulai'	=> $tgl_mulai,
			'tgl_akhir'	=> $tgl_akhir,
			'status_cuti' => $status_cuti,
			'jumlah' => $selisih->d
		);
			
		if(empty($id)){
			$do_ = $this->Cuti_model->insert_cuti($data);
		}else{
			$do_ = $this->Cuti_model->update_cuti($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	public function cek_cutialasanpenting($id){
		
		$val = $this->cuti_model->get_cuti_byid($id); 
		
		echo trim($val['pegawai_id']).'|'.trim($val['tgl_pengajuan']).'|'.trim($val['yang_mengajukan']).'|'.trim($val['jenis_cuti']).'|'.trim($val['tgl_mulai']).'|'.trim($val['tgl_akhir']);
	}
	
	public function do_popup_cutidiluartanggungan($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$date1 = new DateTime(date($this->input->post('tgl_mulai')));
		$date2 = new DateTime(date($this->input->post('tgl_akhir')));
		$selisih = $date1->diff($date2);
		
		
		$data = array(
			'pegawai_id' => $pegawai_id,
			'tgl_pengajuan' => $tgl_pengajuan,
			'yang_mengajukan' => $yang_mengajukan,
			'jenis_cuti' => $jenis_cuti,
			'tgl_mulai'	=> $tgl_mulai,
			'tgl_akhir'	=> $tgl_akhir,
			'status_cuti' => $status_cuti,
			'jumlah' => $selisih->d
		);
			
		if(empty($id)){
			$do_ = $this->Cuti_model->insert_cuti($data);
		}else{
			$do_ = $this->Cuti_model->update_cuti($data, $id);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	public function cek_cutidiluartanggungan($id){
		
		$val = $this->cuti_model->get_cuti_byid($id); 
		
		echo trim($val['pegawai_id']).'|'.trim($val['tgl_pengajuan']).'|'.trim($val['yang_mengajukan']).'|'.trim($val['jenis_cuti']).'|'.trim($val['tgl_mulai']).'|'.trim($val['tgl_akhir']);
	}
	
	public function do_popup_edit($id='')
	{
		extract($_POST); 
		//die();
		$status = 'error';
		$do_ = '';
		$date1 = new DateTime(date($this->input->post('tgl_mulai')));
		$date2 = new DateTime(date($this->input->post('tgl_akhir')));
		$selisih = $date1->diff($date2);
		
		
		$data = array(
			'tgl_mulai'	=> $tgl_mulai,
			'tgl_akhir'	=> $tgl_akhir,
			'jumlah' => $selisih->d
		);
			
		if(empty($id)){
			$do_ = $this->Cuti_model->insert_cuti($data);
		}else{
			$do_ = $this->Cuti_model->update_cuti($id, $data);
		}
		if($do_){
			
			$status = 'success';	
		}
		
		echo $status;
	}
	public function cek_cuti($id = ''){
		$val = $this->Cuti_model->get_id($id); 
		
		echo trim($val['tgl_mulai']).'|'.trim($val['tgl_akhir']).'|'.trim($val['jumlah']);
	}
	
	public function do_delete_cuti($id)
	{
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->Cuti_model->delete_cuti($id);
		
		if($do_){			
			$status = 'success';	
		}
		
		echo $status;
	}
	
	public function add()
	{
		$sql="select id from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Cuti';
		$this->data['get_cuti'] = $this->Cuti_model->get_all_cuti();
		$this->data['data_jenis_cuti'] = $this->Cuti_model->ddl_jenis_cuti();
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->load->view('cuti/add_cuti', $this->data);
	}
	public function add2()
	{
		$sql="select id from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Cuti';
		$this->data['get_cuti'] = $this->Cuti_model->get_all_cuti();
		$this->data['data_jenis_cuti'] = $this->Cuti_model->ddl_jenis_cuti();
		$this->data['jenis_cuti'] = $this->Cuti_model->get_jenis();
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->data['datapeg'] = $this->Cuti_model->get_pegawai_ById($this->session->userdata('pegawai_id'));
		$this->load->view('cuti/add_cuti2', $this->data);
	}
	
	function get_pegawai(){
		extract($_POST);
		
		$this->db->select("a.id,a.nip_baru, a.nama, a.gelar_depan, a.gelar_belakang,c.sisa");
		$this->db->from("pegawai a");
		$this->db->join("pegawai_jabatan b", "a.id=b.id_pegawai",'left');
		$this->db->join("sisa_cuti as c", "a.id=c.id_pegawai",'left');
		$this->db->where('a.status','aktif');
		if($q && $q !=''){
			$this->db->where("(a.id LIKE '".$q."%' OR a.nama LIKE '".$q."%' OR a.nip_baru LIKE '".$q."%')");
		}
		$this->db->order_by('a.nama', 'ASC');
		$q_part=$this->db->get();
		$count = $q_part->num_rows();
			//echo $count;
			if ($count>0){
				foreach($q_part->result() as $row){
					$nama = ucwords(strtolower($row->nama));
					if(!empty($row->gelar_depan)){
						$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama));
					}
					
					if(!empty($row->gelar_belakang)){
						$nama = $nama.', '.$row->gelar_belakang;
					}
					
					echo $row->nama."|".$row->nip_baru."|".$row->id."|".$row->sisa."\n";
				}
			}else{
				echo '';
			}
	}
	
	function edit($id)
	{
		$sql="select id from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Cuti';
		$this->data['data_jenis_cuti'] = $this->Cuti_model->ddl_jenis_cuti();
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->data['id']=$id;
		$this->data['status']='edit';
		$this->load->view('cuti/add_cuti', $this->data);
	}
	
//	public function addcuti()
//	{
//		$this -> form_validation -> set_error_delimiters('<span class="help-block">',  '</span>');
//        $this -> form_validation -> set_rules( 'tanggal_mulai', 'Tanggal mulai', 'trim|required' );
//		$this -> form_validation -> set_rules( 'tanggal_akhir', 'Tanggal akhir', 'trim|required|callback_CekTglAwal' );
//		$this -> form_validation -> set_rules( 'nip', 'Nip', 'trim|required' );
//		$this -> form_validation -> set_rules( 'nama', 'Nama', 'trim|required' );
//		$this -> form_validation -> set_rules( 'UnitKerja', 'Unit Kerja', 'trim|required' );
//		$this -> form_validation -> set_rules( 'alasan', 'Alasan', 'trim|required' );
//		$this -> form_validation -> set_rules( 'jumlah', 'Lama Cuti', 'trim|required' );
//		$this -> form_validation -> set_rules( 'alamat_cuti', 'Alamat', 'trim|required' );
//		$this -> form_validation -> set_rules( 'nomor_cuti', 'Nomor Cuti', 'trim|required' );
//		$this -> form_validation -> set_rules( 'jabatan_ttd', 'Jabatan', 'trim|required' );
//		$this -> form_validation -> set_rules( 'id', 'id', 'trim' );
//		
//		$this -> form_validation -> set_message( 'numeric', '%s hanya boleh angka');
//		$this -> form_validation -> set_message( 'alpha_numeric', '%s hanya boleh alfabet dan numerik');
//		$this -> form_validation -> set_message( 'valid_email', '%s tidak valid');
//		$this -> form_validation -> set_message( 'matches', '%s tidak sama');
//		$this -> form_validation -> set_message( 'required', 'Harus mengisi %s');
//        $this -> form_validation -> set_message( 'min_length', 'Minimum panjang %s %s karakter');
//        $this -> form_validation -> set_message( 'max_length', 'Maksimum panjang %s %s karakter');
//		
//		if ( $this -> form_validation -> run() === FALSE )
//        {
//			$this->add();
//        }
//		else
//		{
//			$nip=preg_replace("/[^\d]/", "", $this->input->post('nip'));
//			$id=$this->input->post('id');
//			$TipeCuti=$this->input->post('tipe_cuti');
//			$tanggal_mulai=$this->input->post('tanggal_mulai');
//			$tanggal_mulai = date_create($tanggal_mulai);
//			$tahun=date_format($tanggal_mulai, 'Y');
//			$tanggal_mulai=date_format($tanggal_mulai, 'Y-m-d');
//			$tanggal_akhir=$this->input->post('tanggal_akhir');
//			$tanggal_akhir = date_create($tanggal_akhir);
//			$tanggal_akhir=date_format($tanggal_akhir, 'Y-m-d');
//			$UnitKerja=$this->input->post('UnitKerja');
//			$lama_cuti=$this->input->post('jumlah');
//			$satuan=$this->input->post('satuan');
//			$nomor_cuti=$this->input->post('nomor_cuti');
//			
//			if ($TipeCuti=="1")
//			{
//				$JumlahMinggu=$this->JumMinggu($tanggal_mulai, $tanggal_akhir);
//				$JumlahSabtu=$this->JumSabtu($tanggal_mulai, $tanggal_akhir);
//				$LiburBersama=$this->CekLiburBersama($tanggal_mulai, $tanggal_akhir);
//				$JumlahCuti=(strtotime($tanggal_akhir)-strtotime($tanggal_mulai))/(60*60*24);
//				$this->db->select('nilai'); #Because I need the value
//				$this->db->where('label', 'CutiTahunan'); #Because I need the variable column    entitled siteoverview
//				$query = $this->db->get('parameter'); #From the settings table
//				$row = $query->row_array(); // get the row
//				$MakCuti=$row['nilai'];
//				//$TotalCuti=$JumlahCuti-$LiburBersama-$JumlahSabtu-$JumlahMinggu;
//				
//				$TotalCuti=$lama_cuti;
//				$SisaCuti=$this->CekSisaCuti($nip, $tahun, $MakCuti);
//				if ($TotalCuti > $MakCuti)
//				{
//					$this->session->set_userdata('ErrorCuti', 'Maksimal ambil cuti '.$MakCuti.'');
//					//print "kelebihan";
//					$this->add();
//					return false;
//				}
//				if ($TotalCuti > $SisaCuti)
//				{
//					print "kelebihan cuti";
//					$this->session->set_userdata('ErrorCuti', 'Sisa cuti anda '.$SisaCuti.'');
//					//$SisaCuti=$this->CekSisaCuti($nip, $tahun, $TotalCuti);
//					$this->add();
//					return false;
//				}
//			} 
//			else if ($TipeCuti=="2")
//			{
//				$JumlahMinggu=$this->JumMinggu($tanggal_mulai, $tanggal_akhir);
//				$JumlahSabtu=$this->JumSabtu($tanggal_mulai, $tanggal_akhir);
//				$LiburBersama=$this->CekLiburBersama($tanggal_mulai, $tanggal_akhir);
//				$JumlahCuti=(strtotime($tanggal_akhir)-strtotime($tanggal_mulai))/(60*60*24);
//				//$TotalCuti=$JumlahCuti-$LiburBersama-$JumlahSabtu-$JumlahMinggu;
//				$TotalCuti=$lama_cuti;
//			}
//			else {
//				//$TotalCuti=(strtotime($tanggal_akhir)-strtotime($tanggal_mulai))/(60*60*24);
//				$TotalCuti=$lama_cuti;
//			}
//			
//			if ($this->input->post('tanggal_mulai') != '') {
//				$level=$this->session->userdata('login_state');
//				if ($level =='user')
//				{					
//				
//					$data = array(
//							'nip' 				=> $nip,
//							'nama'  			=> $this->session->userdata('nama'),
//							'unit_kerja'  		=> $UnitKerja,
//							'tipe_cuti'  		=> $this->input->post('tipe_cuti'),
//							'tanggal_mulai'		=> $tanggal_mulai,
//							'tanggal_akhir'		=> $tanggal_akhir,
//							'jumlah'			=> $TotalCuti,
//							'satuan'			=> $satuan,
//							'nomor_cuti'		=> $nomor_cuti,
//							'alasan' 			=> $this->input->post('alasan'),
//							'alamat_sementara'	=> $this->input->post('alamat_cuti'),
//							'jabatan_ttd'		=> $this->input->post('jabatan_ttd'),
//							'nama_ttd'			=> $this->input->post('nama_ttd'),
//							'nip_ttd'			=> $this->input->post('nip_ttd'),
//							'status_cuti'		=> 'submit',
//							// TODO: tambah tembusan
//							'tembusan'			=> $this->input->post('tembusan')
//						);
//				}
//				else		
//				{
//					$data = array(
//							'nip' 				=> $nip,
//							'nama'  			=> $this->input->post('nama'),
//							'unit_kerja'  		=> $UnitKerja,
//							'tipe_cuti'  		=> $this->input->post('tipe_cuti'),
//							'tanggal_mulai'		=> $tanggal_mulai,
//							'tanggal_akhir'		=> $tanggal_akhir,
//							'jumlah'			=> $TotalCuti,
//							'satuan'			=> $satuan,
//							'nomor_cuti'		=> $nomor_cuti,
//							'alasan' 			=> $this->input->post('alasan'),
//							'alamat_sementara'	=> $this->input->post('alamat_cuti'),
//							'jabatan_ttd'		=> $this->input->post('jabatan_ttd'),
//							'nama_ttd'			=> $this->input->post('nama_ttd'),
//							'nip_ttd'			=> $this->input->post('nip_ttd'),
//							'status_cuti'		=> 'submit',
//							'tembusan'			=> $this->input->post('tembusan')
//						);
//				
//				
//				}
//				if (!empty($id))
//				{
//					$this->db->where('id', $id);
//					$this->db->update('cuti', $data); 
//					
//					$this->Cuti_model->update_cuti($id, $data);
//				}
//				else
//				{
//					$this->Cuti_model->insert_cuti($data);
//				}
//				
//				
//			}
//			redirect('cuti');
//		}
//		
//	}

	function CekSisaCuti ($nip, $tahun, $jumlah)
	{
		$sql="select * from sisa_cuti where nip='$nip' and tahun='$tahun'";
		$query=$this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$sisa=$row->sisa;
			}
		}
		else {
			$sisa=$jumlah;
		}
		return $sisa;
	}
	
	function CekLiburBersama($tglawal, $tglakhir)
	{
		$sql="select * from m_libur where  tanggal between '$tglawal' and '$tglakhir'";
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	
	function JumMinggu($tglawal, $tglakhir)
	{
		$adaysec=24*3600;
		$tgla=strtotime($tglawal);
		$tglb=strtotime($tglakhir);
		$minggu=0;
		for ($i=$tgla; $i < $tglb; $i+=$adaysec)
		{
			if (date("w",$i)=="0")
			{
				$minggu++;
			}
		}
		return $minggu;
	}
	
	function JumSabtu($tglawal, $tglakhir)
	{
		$adaysec=24*3600;
		$tgla=strtotime($tglawal);
		$tglb=strtotime($tglakhir);
		$minggu=0;
		for ($i=$tgla; $i < $tglb; $i+=$adaysec)
		{
			if (date("w",$i)=="6")
			{
				$minggu++;
			}
		}
		return $minggu;
	}
	
	function CekTglAwal()
	{
		$TglAwal=$this->input->post('tanggal_mulai');
		$TglAkhir=$this->input->post('tanggal_akhir');
		$TglAwal = date_create($TglAwal);
		$TglAwal=date_format($TglAwal, 'Y-m-d');
		$TglAkhir = date_create($TglAkhir);
		$TglAkhir=date_format($TglAkhir, 'Y-m-d');
		if ( $TglAwal > $TglAkhir )
        {
            //echo $Tgl;
			//echo '<p>'.$Tgl.'</p>';
			$this->form_validation->set_message('CekTglAwal', '%s > dari tanggal awal');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
	}
	
	public function approve()
	{
		
		$this->data['title'] = 'Approve Cuti';
		//$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->data['data_cuti'] = $this->Cuti_model->get_all();
		
		$this->load->view('cuti/approve_cuti', $this->data);
	}
	
	public function approvecuti($id)
	{
		$data = array(
				'nomor_surat'	=> $this->input->post('nomor_surat'),
				'tgl_ttd'	=> date('Y-m-d', strtotime($this->input->post('tanggal_ttd'))),
				'status_cuti'	=> 'approved'
			);
			
			if(empty($id)){
				$do_ = $this->Cuti_model->insert_cuti($data);
			}else{
				$do_ = $this->Cuti_model->update_cuti($id, $data);
			}
			if($do_){
			
			$status = 'success';	
			}
		
		echo $status;
		
		//$this->db->select('tipe_cuti'); #Because I need the value
		//$this->db->where('id', $cuti_id); #Because I need the variable column    entitled siteoverview
		//$query = $this->db->get('cuti'); #From the settings table
		//$row = $query->row_array(); // get the row
		//$TipeCuti=$row['tipe_cuti'];
		//if ($TipeCuti=="1" or $TipeCuti=="2")
		//{
		//	$sql="select * from sisa_cuti  where nip=(select nip from cuti where id=$cuti_id) and tahun = (select year(tanggal_akhir) from cuti where id=$cuti_id)";
		//	$query=$this->db->query($sql);
		//	if ($query->num_rows() == 1 )
		//	{
		//		$sql="update sisa_cuti set sisa =sisa - (select jumlah from cuti where id=$cuti_id)
		//		where nip=(select nip from cuti where id=$cuti_id) and tahun = (select year(tanggal_mulai) from cuti where id=$cuti_id)";
		//		$this->db->query($sql);
		//	}
		//	else {
		//		$sql="INSERT INTO sisa_cuti (nip,tahun,sisa) select nip, year(tanggal_akhir), 
		//		((select nilai from parameter where label='CutiTahunan') + 
		//		ifnull((select sisa from sisa_cuti where tahun= (select year(tanggal_akhir)-1 from cuti where id=$cuti_id)
		//		and nip =(select nip from cuti where id=$cuti_id)),0)) - jumlah
		//		from cuti where id=$cuti_id";
		//		$this->db->query($sql);
		//		$this->db->query("update sisa_cuti set sisa=0 where nip=(select nip from cuti where id=$cuti_id) and tahun = (select year(tanggal_akhir)-1 from cuti where id=$cuti_id)");
		//	}
		//}
		//echo 'success';
	}
	
	public function rejectcuti($cuti_id)
	{
		$data = array(
				'status_cuti'		=> 'rejected'
			);
			
		$this->Cuti_model->update_cuti($cuti_id,$data);
		
		echo 'success';
	}
	
	function cetak($id)
	{
		$sql="select a.id, a.pegawai_id,a.yang_mengajukan, a.tgl_pengajuan, a.tgl_mulai, a.jenis_cuti, a.tgl_akhir, a.tgl_ttd, a.nomor_surat,a.jumlah,
			d.nama_jabatan AS jabatan, b.kepangkatan AS pangkat, b.golongan AS golongan, g.nip_baru AS nip, h.nama_unit_kerja AS unit_kerja,
			f.nama_tipe_cuti AS jenis_cuti,
			jumlah, a.status_cuti
			FROM cuti a 
			LEFT JOIN pegawai_kepangkatan AS b ON a.pegawai_id = b.id_pegawai 
			LEFT JOIN pegawai_jabatan AS c ON a.pegawai_id = c.id_pegawai
			LEFT JOIN m_unit_kerja AS h ON c.satuan_organisasi = h.kode_unit_kerja
			LEFT JOIN m_jabatan AS d ON c.id_jabatan = d.id_jabatan
			LEFT JOIN m_tipe_cuti AS f ON a.jenis_cuti = f.id_tipe_cuti
			LEFT JOIN pegawai AS g ON a.pegawai_id = g.id
			WHERE a.id=$id";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		
		//echo "<pre>";
		//print_r($result);
		//echo "</pre>";
		$this->data['data_cuti'] = $result;
		$this->data['title'] = 'Print Cuti';
		switch($result[0]['jenis_cuti']){
			case "Cuti Tahunan":
				$this->load->view('cuti/cuti_tahunan', $this->data);
				break;
			case "Cuti Besar":
				$this->load->view('cuti/cuti_besar', $this->data);
				break;
			case "Cuti Sakit":
				$this->load->view('cuti/cuti_sakit', $this->data);
				break;
			case "Cuti Bersalin":
				$this->load->view('cuti/cuti_bersalin', $this->data);
				break;
			case "Cuti Karena Alasan Penting":
				$this->load->view('cuti/cuti_alasan_penting', $this->data);
				break;
			case "Cuti di Luar Tanggungan Negara":
				$this->load->view('cuti/cuti_diluar_tanggungan', $this->data);
				break;
			default:
				$this->load->view('cuti/cuti_permohonan', $this->data);
				break;
		}
		
	}
}