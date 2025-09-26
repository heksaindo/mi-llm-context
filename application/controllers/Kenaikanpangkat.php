<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KenaikanPangkat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('kp_model');
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
		extract($_POST); 
		$this->data['title'] = 'Kenaikan Pangkat';
		//$this->data['data_pegawai'] = $this->kp_model->get_kenaikanpangkat();
				
		$this->data['data_pendidikan'] = $this->kp_model->data_pendidikan();		
		
		$this->load->view('kp/kp', $this->data);
	}

	function ajax_kp()
    {
		extract($_POST); 
		
        $result = $this->kp_model->get_kenaikanpangkat();
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		
		//get master gol
		$master_gol = array();
		$get_gol_id = array();
		$query = $this->db->query("SELECT * FROM m_golongan ORDER BY level DESC");
		$m_gol = $query->result_array();
		foreach($m_gol as $dt_gol){
			if(!in_array($dt_gol['level'], $master_gol)){
				$master_gol[$dt_gol['id_golongan']] = $dt_gol['level'];
			}
			if(!in_array($dt_gol['id_golongan'], $get_gol_id)){
				$get_gol_id[$dt_gol['kode_golongan']] = $dt_gol['id_golongan'];
			}
		}
		
		
		if($result){
			foreach($result as $row)
			{
				$pegawai_id = $row['id_pegawai'];
				$id = $row['id'];
				$before_status = $row['status_kp'];
				$status_masalah = $row['status_masalah'];
				
				if($status_masalah == '' || $status_masalah == 'N'){
					switch ($row['status_kp'])
					{										
						case 'Dokumen Usulan Masuk' :
							$img1 = '<img src="'.base_url().'img/green.png" />';
							$img2 = '<img src="'.base_url().'img/yellow.png" />';
							$img3 = '<img src="'.base_url().'img/yellow.png" />';
							$img4 = '<img src="'.base_url().'img/yellow.png" />';
							$img5 = '<img src="'.base_url().'img/yellow.png" />';
							$img6 = '<img src="'.base_url().'img/yellow.png" />';
							break;
						case 'Proses Entry Data' :
							$img1 = '<img src="'.base_url().'img/green.png" />';
							$img2 = '<img src="'.base_url().'img/green.png" />';
							$img3 = '<img src="'.base_url().'img/yellow.png" />';
							$img4 = '<img src="'.base_url().'img/yellow.png" />';
							$img5 = '<img src="'.base_url().'img/yellow.png" />';
							$img6 = '<img src="'.base_url().'img/yellow.png" />';
							break;
						case 'Tanda Tangan Usulan' :
							$img1 = '<img src="'.base_url().'img/green.png" />';
							$img2 = '<img src="'.base_url().'img/green.png" />';
							$img3 = '<img src="'.base_url().'img/green.png" />';
							$img4 = '<img src="'.base_url().'img/yellow.png" />';
							$img5 = '<img src="'.base_url().'img/yellow.png" />';
							$img6 = '<img src="'.base_url().'img/yellow.png" />';
							break;
						case 'Kirim Ke Biro' :
							$img1 = '<img src="'.base_url().'img/green.png" />';
							$img2 = '<img src="'.base_url().'img/green.png" />';
							$img3 = '<img src="'.base_url().'img/green.png" />';
							$img4 = '<img src="'.base_url().'img/green.png" />';
							$img5 = '<img src="'.base_url().'img/green.png" />';
							$img6 = '<img src="'.base_url().'img/yellow.png" />';
							break;
						case 'Masalah' :
							$img1 = '<img src="'.base_url().'img/green.png" />';
							$img2 = '<img src="'.base_url().'img/green.png" />';
							$img3 = '<img src="'.base_url().'img/green.png" />';
							$img4 = '<img src="'.base_url().'img/green.png" />';
							$img5 = '<img src="'.base_url().'img/green.png" />';
							$img6 = '<img src="'.base_url().'img/yellow.png" />';
							break;
						case 'SK Selesai' :
							$img1 = '<img src="'.base_url().'img/green.png" />';
							$img2 = '<img src="'.base_url().'img/green.png" />';
							$img3 = '<img src="'.base_url().'img/green.png" />';
							$img4 = '<img src="'.base_url().'img/green.png" />';
							$img5 = '<img src="'.base_url().'img/green.png" />';
							$img6 = '<img src="'.base_url().'img/green.png" />';
							break;
						default :
							$img1 = '<img src="'.base_url().'img/yellow.png" />';
							$img2 = '<img src="'.base_url().'img/yellow.png" />';
							$img3 = '<img src="'.base_url().'img/yellow.png" />';
							$img4 = '<img src="'.base_url().'img/yellow.png" />';
							$img5 = '<img src="'.base_url().'img/yellow.png" />';
							$img6 = '<img src="'.base_url().'img/yellow.png" />';
							break;
					}
				}else{
					if($status_masalah == 'Y'){
						$img1 = '<img src="'.base_url().'img/red.png" />';
						$img2 = '<img src="'.base_url().'img/red.png" />';
						$img3 = '<img src="'.base_url().'img/red.png" />';
						$img4 = '<img src="'.base_url().'img/red.png" />';
						$img5 = '<img src="'.base_url().'img/red.png" />';
						$img6 = '<img src="'.base_url().'img/red.png" />';
					}
				}
				
				if($status_masalah == 'Y'){
					$status1 = '<a href="javascript:void(0);" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img1.'</a>';
					$status2 = '<a href="javascript:void(0);" class="tip" title="Proses Entry Data" >'.$img2.'</a>';													
					$status3 = '<a href="javascript:void(0);" class="tip" title="Tanda Tangan Usulan" >'.$img3.'</a>';
					$status4 = '<a href="javascript:void(0);" class="tip" title="Kirim Ke Biro" >'.$img4.'</a>';
					$status5 = "<a href='#' onclick='change_status(\"Masalah\",\"".$pegawai_id."\",\"".$id."\", \"".$row['nip_baru']."\", \"".$row['nama']."\", \"".$before_status."\", \"".$row['status_masalah']."\")' class='tip' title='Info Di Biro' >".$img5."</a>";													
					$status6 = '<a href="javascript:void(0);" class="tip" title="SK Selesai" >'.$img6.'</a>';
				}else{
					$status1 = "<a href='#' onclick='change_status(\"Dokumen Usulan Masuk\",\"".$pegawai_id."\",\"".$id."\", \"".$row['nip_baru']."\", \"".$row['nama']."\", \"".$before_status."\", \"".$row['status_masalah']."\")' class='tip' data-toggle='tooltip' title='Dokumen Usulan Masuk'>".$img1."</a>";
					$status2 = "<a href='#' onclick='change_status(\"Proses Entry Data\",\"".$pegawai_id."\",\"".$id."\", \"".$row['nip_baru']."\", \"".$row['nama']."\", \"".$before_status."\", \"".$row['status_masalah']."\")' class='tip' title='Proses Entry Data' >".$img2."</a>";													
					$status3 = "<a href='#' onclick='change_status(\"Tanda Tangan Usulan\",\"".$pegawai_id."\",\"".$id."\", \"".$row['nip_baru']."\", \"".$row['nama']."\", \"".$before_status."\", \"".$row['status_masalah']."\")' class='tip' title='Tanda Tangan Usulan' >".$img3."</a>";													
					$status4 = "<a href='#' onclick='change_status(\"Kirim Ke Biro\",\"".$pegawai_id."\",\"".$id."\", \"".$row['nip_baru']."\", \"".$row['nama']."\", \"".$before_status."\", \"".$row['status_masalah']."\")' class='tip' title='Kirim Ke Biro' >".$img4."</a>";													
					$status5 = "<a href='#' onclick='change_status(\"Masalah\",\"".$pegawai_id."\",\"".$id."\", \"".$row['nip_baru']."\", \"".$row['nama']."\", \"".$before_status."\", \"".$row['status_masalah']."\")' class='tip' title='Info Di Biro' >".$img5."</a>";													
					$status6 = "<a href='#' onclick='change_status(\"SK Selesai\",\"".$pegawai_id."\",\"".$id."\", \"".$row['nip_baru']."\", \"".$row['nama']."\", \"".$before_status."\", \"".$row['status_masalah']."\")' class='tip' title='SK Selesai' >".$img6."</a>";													
				}
				
				
				if($row['tmt_kepangkatan'] == '0000-00-00'){
					$tmt_kepangkatan = '';
					$periode = '-';
				}else{
					$tmt_kepangkatan = date('d-m-Y', strtotime($row['tmt_kepangkatan']));
					$thisMonth = date('m',strtotime($tmt_kepangkatan));
					if($thisMonth < '04' || $thisMonth > '10'){
						$periode = 'April';
					}else{
						$periode = 'Oktober';
					}
				}
				
				//check MAX pangkat
				$level = 9999;
				$golongan_max = $row['golongan_max'];
				if(!empty($master_gol[$golongan_max])){
					$level = $master_gol[$golongan_max];
				}
				
				//check curr gol terakhir
				$curr_level = 0;				
				if(!empty($get_gol_id[$row['gol_terakhir']])){
					if(!empty($master_gol[$get_gol_id[$row['gol_terakhir']]])){
						$curr_level = $master_gol[$get_gol_id[$row['gol_terakhir']]];
					}
				}
				
				//if(($curr_level > $level AND $row['tipe_kp'] == 'pegawai') OR $row['tipe_kp'] == 'pilihan'){
					array_push($json["aaData"],array(
						$i,
						'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail Pegawai" >'.$row['nama'].'</a><br>'.$row['nip_baru'],
						$row['jabatan'],
						//$row['kantor'].'#'.$curr_level.'#'.$level.'#'.$row['tipe_kp'], 
						$row['kantor'],
						$row['golongan'],
						$tmt_kepangkatan,
						$periode,
						$status1,
						$status2,
						$status3,
						$status4,
						$status5,
						$status6,
						$row['nama_strata']
					));
					$i++;
				//}
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function list_histori_kp()
	{	
		extract($_POST); 
		$this->data['title'] = 'List Histori Kenaikan Pangkat';
		$this->data['data_pendidikan'] = $this->kp_model->data_pendidikan();	
		
		$this->load->view('kp/histori_kp', $this->data);
	}

	function ajax_histori_kp()
    {
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		
		if($bulan == 'undefined'){
			$bulan = date('m');
		}
		if($tahun == 'undefined'){
			$tahun = date('Y');
		}
		
		if($bulan < '04' || $bulan > '10'){
			$bulan = 'April';
		}else{
			$bulan = 'Oktober';
		}
		
        $result = $this->kp_model->get_histori_kenaikanpangkat('', '', $bulan, $tahun);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;

		//get master gol
		$master_gol = array();
		$get_gol_id = array();
		$query = $this->db->query("SELECT * FROM m_golongan ORDER BY level DESC");
		$m_gol = $query->result_array();
		foreach($m_gol as $dt_gol){
			if(!in_array($dt_gol['level'], $master_gol)){
				$master_gol[$dt_gol['id_golongan']] = $dt_gol['level'];
			}
			if(!in_array($dt_gol['id_golongan'], $get_gol_id)){
				$get_gol_id[$dt_gol['kode_golongan']] = $dt_gol['id_golongan'];
			}
		}
		
		if($result){
			foreach($result as $row)
			{
				$pegawai_id = $row['id_pegawai'];
				$id = $row['id'];
				$before_status = $row['status_kp'];
				$status_masalah = $row['status_masalah'];
				
				$img1 = '<img src="'.base_url().'img/green.png" />';
				$img2 = '<img src="'.base_url().'img/green.png" />';
				$img3 = '<img src="'.base_url().'img/green.png" />';
				$img4 = '<img src="'.base_url().'img/green.png" />';
				$img5 = '<img src="'.base_url().'img/green.png" />';
				$img6 = '<img src="'.base_url().'img/green.png" />';
				
				$status1 = '<a href="javascript:void(0);" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img1.'</a>';
				$status2 = '<a href="javascript:void(0);" class="tip" title="Proses Entry Data" >'.$img2.'</a>';													
				$status3 = '<a href="javascript:void(0);" class="tip" title="Tanda Tangan Usulan" >'.$img3.'</a>';
				$status4 = '<a href="javascript:void(0);" class="tip" title="Kirim Ke Biro" >'.$img4.'</a>';
				$status5 = '<a href="javascript:void(0);" class="tip" title="Info Di Biro" >'.$img5.'</a>';
				$status6 = '<a href="javascript:void(0);" class="tip" title="SK Selesai" >'.$img6.'</a>';
						
				
				if(!empty($row['status_kp'])){
					$printnya = '<li><a onclick="window.open(\''.base_url().'kenaikanpangkat/cetak/'.$row['id'].'\', \' \', \'scrollbars=1,height=800, width=700\')" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>';
				}else{
					$printnya = '<li><a href="" class="tip" title=""></a> </li>';
				}
				
				//if(!empty($id) && $row['status_kp'] != 'SK Selesai'){
				if(!empty($id)){
					$printnya .= '<li><a href="'.base_url().'laporan/editKp/'.$pegawai_id.'/'.$id.'" class="tip" title="Edit entry"><i class="fam-application-edit"></i></a> </li>';
				}
				
				if($row['tmt_kepangkatan'] == '0000-00-00'){
					$tmt_kepangkatan = '';
				}else{
					$tmt_kepangkatan = date('d-m-Y', strtotime($row['tmt_kepangkatan']));
				}
				
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail Pegawai" >'.$row['nama'].'</a><br>'.$row['nip_baru'],
					$row['jabatan'],
					$row['kantor'],
					$row['golongan'],
					$tmt_kepangkatan,
					$row['periode'],
					$status1,
					$status2,
					$status3,
					$status4,
					$status5,
					$status6,
					
					'<ul class="table-controls">'.$printnya.'</ul>'
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function do_change_status()
	{
		extract($_POST); 
		$user_input = $this->session->userdata('user_id');
		
		if(!empty($nip_baru)){

			$data['status_kp'] = $newstatus;
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$update = $this->kp_model->update_riwayat_kp($data, $id);
		}
		if($update){
			echo 'success';
		}else{
			echo 'failed';
		}
		
	}
	public function do_change_masalah()
	{
		extract($_POST); 
		$user_input = $this->session->userdata('username');
		
		if(!empty($nip_baru)){
			if($status_masalah == 'N'){
				$new_masalah = 'Y';
				$masalahnya = $masalahnya;
			}else{
				$new_masalah = 'N';
				$masalahnya = '';
			}
			$data['status_masalah'] = $new_masalah;
			$data['masalahnya'] = $masalahnya;
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$update = $this->kp_model->update_riwayat_kp($data, $id);
		}
		if($update){
			echo 'success';
		}else{
			echo 'failed';
		}
		
	}
	public function do_change_selesai()
	{
		extract($_POST); 
		$return = 'error';
		$user_input = $this->session->userdata('username');
		
		$tmt = explode('-', $tanggal_berlaku); 
		if($tmt[1] < '04' || $tmt[1] > '10'){
			$periode = 'April';
		}else{
			$periode = 'Oktober';
		}		
		$pangkat = '';
		if(!empty($gol_baru)){
			$pangkat = get_name('m_golongan','nama_golongan','kode_golongan', $gol_baru);
		}
		
		if ($id != '') {
			$data = array(
				'nip_baru'				=> $nip_baru,
				'golongan'  			=> $gol_baru,
				'kepangkatan'			=> $pangkat,
				'tmt_kepangkatan'		=> date('Y-m-d', strtotime($tanggal_berlaku)), 
				'pejabat_penandatangan' => $pejabatpenetapan,
				'no_sk'					=> $no_sk,
				'tgl_sk'				=> date('Y-m-d', strtotime($tanggal_sk)),
				'masa_kerja_golongan'	=> $masa_kerja_gol,
				'periode'	 			=> $periode,
				//'golongan_lama'	 		=> $gol_lama,
				'status_kp'				=> 'SK Selesai',
				'is_last'				=> 'Ya',
				'updated_date'			=> date('Y-m-d H:i:s'),
				'updated_by'			=> $user_input
			);
			
			$update = $this->kp_model->update_riwayat_kp($data, $id);
			if($update){
				
				//update is_last
				$this->db->where('id !=', $id);
				$this->db->where('nip_baru', $nip_baru);
				$this->db->update('pegawai_riwayatkepangkatan', array('is_last'=>'Tidak'), false);
				
				//update pegawai_pangkat
				$data2 = array(
					'golongan'				=> $gol_baru,
					'kepangkatan'			=> $pangkat,
					'tmt_kepangkatan'		=> date('Y-m-d', strtotime($tanggal_berlaku)), 
					'pejabat_penandatangan' => $pejabatpenetapan,
					'no_sk'					=> $no_sk,
					'tgl_sk'				=> date('Y-m-d', strtotime($tanggal_sk))
				);
				
				$this->kp_model->cek_kepangkatan($data2, $nip_baru);
					
				//update pegawai_kepegawaian
				$data3 = array(
					'gol_terakhir'			=> $gol_baru,
					'tmt_gol_terakhir'		=> date('Y-m-d', strtotime($tanggal_berlaku))
				);
				
				$this->kp_model->cek_kepegawaian($data3, $nip_baru);	
					
				$return = 'success';
			}
		}
		
		echo $return;
	}
	
	public function add_kp_pilihan()
	{
		$this->data['data_dokumen'] = $this->kp_model->get_dokumen();
		$this->data['data_golongan'] = $this->kp_model->ddl_golongan();
		$this->data['data_pegawai'] = False ;
		$this->data['title'] = 'Add Kenaikan Pangkat Pilihan';
		$this->load->view('kp/add_kp_pilihan', $this->data);
	}
	
	public function addexisting($pegawai_id, $id)
	{
		$this->data['id_kp'] = $id;
		$this->data['data_pegawai'] = $this->kp_model->get_pegawai($pegawai_id);
		$this->data['data_dokumen'] = $this->kp_model->get_dokumen($pegawai_id);
		$this->data['data_golongan'] = $this->kp_model->ddl_golongan();
		$this->data['title'] = 'Add Kenaikan Pangkat';
		$this->load->view('kp/add_kp', $this->data);
	}
	
	public function editexisting($pegawai_id, $id)
	{
		$this->data['id_kp'] = $id;
		$this->data['data_kp'] = $this->kp_model->get_kp($id);
		$this->data['data_pegawai'] = $this->kp_model->get_pegawai($pegawai_id);
		$this->data['data_dokumen'] = $this->kp_model->get_dokumen($pegawai_id);
		$this->data['data_golongan'] = $this->kp_model->ddl_golongan();
		$this->data['title'] = 'Edit Kenaikan Pangkat';
		$this->load->view('kp/edit_kp', $this->data);
	}
	
	public function do_insert()
	{
		extract($_POST); 
		$return = 'error';
		$user_input = $this->session->userdata('user_id');
		 
			
		if ($pegawai_id != '') {
			
			$data_pegawai = $this->kp_model->get_pegawai_data($pegawai_id);
			
			//update status is_last
			$data_up = array(
				'is_last' => 'Tidak'				
			);			
			$this->kp_model->update_riwayat_kp_by_pegawai($data_up, $pegawai_id);
			
			$data = array(
				'pegawai_id'			=> $pegawai_id,
				//'nip_baru'			=> $data_pegawai['nip_baru'],
				//'nama'				=> $data_pegawai['nama'],
				'golongan_lama'		=> $data_pegawai['gol_terakhir'],
				'status_kp'			=> 'Dokumen Usulan Masuk',
				'is_last' 			=> 'Ya',	
				'created_date' 		=> date('Y-m-d H:i:s'),
				'created_by' 		=> $user_input										
			);
			
			$id_kp = $this->kp_model->insert_kp($data);
			if($id_kp){
				$return = 'success';
			}
		}
		echo $return;
	}
	
	public function update_status_kp()
	{
		extract($_POST); 
		$return = 'error';
		$user_input = $this->session->userdata('user_id');

		if(!empty($id_kp)){
			$data = array(
				'status_kp'	   	=> 'Proses Entry Data',
				'updated_date' 	=> date('Y-m-d H:i:s'),
				'updated_by' 	=> $user_input
				
			);
			$this->kp_model->update_riwayat_kp($data, $id_kp);
		
			//Update KP dokumen
			$document = $this->kp_model->get_dokumen($id_pegawai);
			foreach($document as $doc){
				
				$data_doc = array(
					'id_kp'					=> $id_kp,
					'nama_dokumen'			=> $doc->nama_dokumen,
					'filename'				=> $doc->filename,
					'id_tipe_dokumen'		=> $doc->id_tipe_dokumen			
				);
				if(!empty($doc->filename)){
					$this->kp_model->insert_kp_dokumen($data_doc, $id_kp, $doc->id_tipe_dokumen);
				}
			}
			
			$return = 'success';
					
		}
		echo $return;
	}
	
	public function insert_pilihan()
	{
		extract($_POST); 
		$return = 'error';
		$user_input = $this->session->userdata('user_id');

		if ($id_pegawai != '') {
			$data_pegawai = $this->kp_model->get_pegawai_data($id_pegawai);
			//update status is_last
			$data_up = array(
				'is_last' => 'Tidak'				
			);			
			$this->kp_model->update_riwayat_kp_by_pegawai($data_up, $id_pegawai);
			
			$data = array(
				'pegawai_id'			=> $id_pegawai,
				//'nip_baru'			=> $data_pegawai['nip_baru'],
				//'nama'				=> $data_pegawai['nama'],
				'golongan_lama'		=> $data_pegawai['gol_terakhir'],
				'status_kp'			=> 'Dokumen Usulan Masuk',
				'is_last' 			=> 'Ya',	
				'created_date' 		=> date('Y-m-d H:i:s'),
				'created_by' 		=> $user_input,			
				'updated_date' 	=> date('Y-m-d H:i:s'),
				'updated_by' 	=> $user_input
				
			);
			$id_kp = $this->kp_model->insert_kp($data);
			if($id_kp){
				//Update KP dokumen
				$document = $this->kp_model->get_dokumen($id_pegawai);
				foreach($document as $doc){
					
					$data_doc = array(
						'id_kp'					=> $id_kp,
						'nama_dokumen'			=> $doc->nama_dokumen,
						'filename'				=> $doc->filename,
						'id_tipe_dokumen'		=> $doc->id_tipe_dokumen			
					);
					if(!empty($doc->filename)){
						$this->kp_model->insert_kp_dokumen($data_doc, $id_kp, $doc->id_tipe_dokumen);
					}
				}
				
				
				$return = 'success';
			}
			
		}
		echo $return;
	}
	
	public function update()
	{
		extract($_POST); 
		$return = 'error';
		$tmt = explode('-', $tanggal_berlaku); 
		if($tmt[1] < '04' || $tmt[1] > '10'){
			$periode = 'April';
		}else{
			$periode = 'Oktober';
		}
		
		if ($nip != '') {
			$data = array(
				'nip_baru'				=> $nip,
				'golongan'  			=> $gol_baru,
				'kepangkatan'			=> $pangkat,
				'tmt_kepangkatan'		=> date('Y-m-d', strtotime($tanggal_berlaku)), 
				'pejabat_penandatangan' => $pejabatpenetapan,
				'periode'	 			=> $periode,
				'no_sk'					=> $no_sk,
				'tgl_sk'				=> date('Y-m-d', strtotime($tanggal_sk)),
				'masa_kerja_golongan'	=> $masa_kerja_gol,
				'golongan_lama'	 		=> $gol_lama
				
			);
			
			$do_update = $this->kp_model->update_riwayat_kp($data, $id);
			if($do_update){
				$id_kp = $id;
				//Update KP dokumen
				$this->kp_model->del_kp_dokumen_bykp($id_kp);
				$document = $this->kp_model->get_dokumen($id_pegawai);
				foreach($document as $doc){
					
					$data_doc = array(
						'id_kp'					=> $id_kp,
						'nama_dokumen'			=> $doc->nama_dokumen,
						'filename'				=> $doc->filename,
						'id_tipe_dokumen'		=> $doc->id_tipe_dokumen			
					);
					if(!empty($doc->filename)){
						$this->kp_model->insert_kp_dokumen($data_doc, $id_kp, $doc->id_tipe_dokumen);
					}
				}
				//Update pegawai_kepegawaian
				$data_kep = array(
					'golongan' => $gol_baru,
					'kepangkatan' => $pangkat,
					'tmt_kepangkatan'		=> date('Y-m-d', strtotime($tanggal_berlaku)), 
					'pejabat_penandatangan' => $pejabatpenetapan,
					'no_sk'					=> $no_sk,
					'tgl_sk'				=> date('Y-m-d', strtotime($tanggal_sk))
				);
				$this->kp_model->cek_kepangkatan($data_kep, $nip);
				
				//update pegawai_kepegawaian
				$data3 = array(
					'gol_terakhir'			=> $gol_baru,
					'tmt_gol_terakhir'		=> date('Y-m-d', strtotime($tanggal_berlaku))
				);
				
				$this->kp_model->cek_kepegawaian($data3, $nip);
				
				$return = 'success';
			}
		}
		echo $return;
	}
	
	
	
	public function cetak($id)
	{
		$this->data['title'] = 'Print Kenaikan Pangkat';
		$this->data['data_kp'] = $this->kp_model->get_histori_kenaikanpangkat($id);
		$this->load->view('kp/cetak_kp', $this->data);
	}
	
	public function listprocessed()
	{
		$this->data['title'] = 'List Kenaikan Gaji Pegawai';
		$this->load->view('kp/list_kp', $this->data);
	}
	
	//==== Riwayat Dokumen ====
	function ajax_rdokumen()
    {
		$action = $this->uri->segment(3);
		
		$id_pegawai = $this->input->post('id_pegawai');
        $result = $this->kp_model->get_dokumen($id_pegawai);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$filename = str_replace("C:\\fakepath\\","", $row->filename);
				
				$cek_file = '<ul class="table-controls">';
				if(empty($filename)){
					$cek_file .= '<li><i class="fam-cancel"></i></li>';
					$option = '<span id="edit-rdokumen" onclick="javascript:onAddrdokumen('.$row->id_tipe_dokumen.',\''.$row->tipe_dokumen.'\')" class="fam-add"></span>';
				}else{
					$cek_file .= '<li><i class="fam-accept"></i></li>';		
					$option = '<span id="edit-rdokumen" onclick="javascript:onEditrdokumen('.$row->id_tipe_dokumen.',\''.$row->tipe_dokumen.'\',\''.$row->id.'\')" class="fam-application-edit"></span>';
				}			
				$cek_file .= '</ul>';
				
				
				array_push($json["aaData"],array(
					$i,
					$row->tipe_dokumen,
					$cek_file,
					$option
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	

}