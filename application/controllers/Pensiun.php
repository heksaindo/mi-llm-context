<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pensiun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('pensiun_model');
		$this->load->helper('general_helper');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('email_user');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Pensiun';
		//$this->data['data_pegawai'] = $this->pensiun_model->get_pensiun_forlist();
		$this->data['data_jabatan_ttd'] = $this->pensiun_model->ddl_jabatan_ttd();	
		$this->load->view('pensiun/pensiun', $this->data);
	}
	
	function ajax_pensiun()
    {
		//2. 1957 01 15 1980032000 ==> 56 tahun + 1 bulan ==> 2013 02 01 (tmt tanggal pensiun)
		//ewars 7 bulan sebelum tmt tanggal pensiun
		
        $result = $this->pensiun_model->get_pensiun_forlist();
		$datas = array();
		if($result)
		{
			$no = 1;
			//$tgl = new DateTime(date('Y-m-d'));
			foreach($result as $row)
			{
				//$lahir_th = substr($row['nip_baru'], 0, 4);
				//$lahir_bl = substr($row['nip_baru'], 4, 2);
				//$lahir_tgl = substr($row['nip_baru'], 6, 2);
				//$tgl_lahir = $lahir_th.'-'.$lahir_bl.'-'.$lahir_tgl;
				////echo $tgl_lahir;
				//$selisih = datediff($tgl_lahir, date('Y-m-d'));
				//$usia_th = $selisih['years']; 	
				//$usia_bl = $selisih['months']; 
				//$usia = $usia_th.' th '.$usia_bl.' bln';
				
				//$tgl_lahir = $row['tanggal_lahir'];
				
				//$tgl1  = new DateTime($tgl_lahir);
				//$usia = $tgl->diff($tgl1);
				//echo "difference " . $usia->y . " years, " . $usia->m." months, ".$usia->d." days ";
				
				//echo $tgl_lahir." - ".$usia;
				//echo "<br>";
				
				//Pensiun = 56 th + 1bln
				//$tgl_pensiun  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+$row));
				
				//Jika eselon I & II = 60th
				//if(!empty($row['eselon']) && ($row['eselon'] == 'I.a' || $row['eselon'] == 'I.b' || $row['eselon'] == 'II.a' || $row['eselon'] == 'II.b')){
				//	$tgl_pensiun  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+60));
				//}
				
				
				/*
				//$tgl_pensiun_y = date("Y", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
				//$tgl_pensiun_md = date("d-m", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
				//$tgl_pensiun = $tgl_pensiun_md.'-'.($tgl_pensiun_y+56);
				
				//ewar = -7 dari tgl pensiun
				// 55thn + 13bln = 56bln + 1bln
				// 13 - 7 = 6bln
				// 55 + 6bln --> pensiun - 7bln
				*/
				//$tgl_ewars  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_pensiun))-7,   date("d",strtotime($tgl_pensiun)),   date("Y",strtotime($tgl_pensiun))));
				//$tgl_ewars_mk = mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir)));
				//$tgl_ewars_y = date("Y", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
				//$tgl_ewars_md = date("d-m", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
				//$tgl_ewars = $tgl_ewars_md.'-'.($tgl_ewars_y+55);
				//$tgl_ewars_mk = $tgl_ewars_mk + (55*86400);
				
				//$today = date("Y-m-d");
				//$today_mk = mktime(0, 0, 0, date("m",strtotime($today)),   date("d",strtotime($today)),   date("Y",strtotime($today)));
				
				//limit pensiun
				//$limit = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($today))-7,   date("d",strtotime($today)),   date("Y",strtotime($today))));
				//$limit_mk = mktime(0, 0, 0, date("m",strtotime($today))+7,   date("d",strtotime($today)),   date("Y",strtotime($today)));
				
				//echo $tgl_pensiun .'#'. $limit.'#'.$today.'\n';
				//if(strtotime($tgl_ewars) <= strtotime($today) AND strtotime($tgl_pensiun) > strtotime($limit) ){
				
				if($row['id'] == 0){
					//if($tgl_pensiun >= $limit){
						
						//if(!empty($row['id'])){
					//	if($tgl_pensiun <= $today){
							//$row['tgl_ewars'] = $tgl_ewars;
							//$row['usia'] = $usia;
							//$row['tgl_pensiun'] = $tgl_pensiun;
							if(!empty($row['gelar_belakang'])){
								$row['nama'] = $row['gelar_depan'].' '.ucwords(strtolower($row['nama'])).', '.$row['gelar_belakang'];
							}
							$row['nama'] = trim(ucwords(strtolower($row['nama'])));
							$datas[] = $row;
					//	}
					
					//}
					
				}else{
				
					//$row['tgl_ewars'] = $tgl_ewars;
					//$row['usia'] = $usia;
					//$row['tgl_pensiun'] = $tgl_pensiun;
					if(!empty($row['gelar_belakang'])){
						$row['nama'] = $row['gelar_depan'].' '.ucwords(strtolower($row['nama'])).', '.$row['gelar_belakang'];
					}
					$row['nama'] = trim(ucwords(strtolower($row['nama'])));
					$datas[] = $row;
				}
				
				
			}
		}
		
		$json["aaData"] = array();
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
	
		//print_r($datas);die();
		if($datas){
			foreach($datas as $row)
			{
				$pegawai_id = $row['id_pegawai'];
				$id = $row['id'];
				$before_status = $row['status_pensiun'];
				$status_masalah = $row['status_masalah'];
				
				if($status_masalah == '' || $status_masalah == 'N'){
					switch ($row['status_pensiun'])
					{										
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
							$img1 = '<img src="'.base_url().'img/green.png" />';
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
				
				if($row['tmt_pensiun'] == '0000-00-00'){
					$tmt_pensiun = '';
					$mk_gol = '';
				}else{
					$tgl_pensiun = date('d-m-Y', strtotime($row['tmt_pensiun']));
					$today_m = date("d-m-Y", mktime(0, 0, 0, date("m",strtotime(date("Y-m-d"))),   date("d",strtotime(date("Y-m-d")))+1,   date("Y",strtotime(date("Y-m-d")))));
					if(strtotime($tgl_pensiun)<strtotime($today_m)){
						$tmt_pensiun = '<span style="color:red;">'.$tgl_pensiun.'</span>';
					}else{
						$tmt_pensiun = '<span>'.$tgl_pensiun.'</span>';
					}
					$diff = abs(strtotime($row['tmt_pensiun']) - strtotime($row['tmt_cpns']));
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$mk_gol = $years.'#'.$months;
				}
				
				if($status_masalah == 'Y'){
					$status1 = '<a href="javascript:void(0);" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img1.'</a>';
					$status2 = '<a href="javascript:void(0);" class="tip" title="Proses Entry Data" >'.$img2.'</a>';													
					$status3 = '<a href="javascript:void(0);" class="tip" title="Tanda Tangan Usulan" >'.$img3.'</a>';
					$status4 = '<a href="javascript:void(0);" class="tip" title="Kirim Ke Biro" >'.$img4.'</a>';
					$status5 = '<a href="javascript: change_status(\'Masalah\',\''.$pegawai_id.'\', \''.$id.'\', \''.$row['nip_baru'].'\', \''.$row['nama'] .'\', \''.$before_status.'\', \''.$row['status_masalah'].'\')" class="tip" title="Info Di Biro" >'.$img5.'</a>';					
					$status6 = '<a href="javascript:void(0);" class="tip" title="SK Selesai" >'.$img6.'</a>';
				}else{
					$status1 = '<a href="javascript:void(0);" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img1.'</a>';
					$status2 = '<a href="javascript: change_status(\'Proses Entry Data\',\''.$pegawai_id.'\', \''.$id.'\', \''.$row['nip_baru'].'\', \''.$row['nama'] .'\', \''.$before_status.'\', \''.$row['status_masalah'].'\')" class="tip" title="Proses Entry Data" >'.$img2.'</a>';													
					$status3 = '<a href="javascript: change_status(\'Tanda Tangan Usulan\',\''.$pegawai_id.'\', \''.$id.'\', \''.$row['nip_baru'].'\', \''.$row['nama'] .'\', \''.$before_status.'\', \''.$row['status_masalah'].'\')" class="tip" title="Tanda Tangan Usulan" >'.$img3.'</a>';
					$status4 = '<a href="javascript: change_status(\'Kirim Ke Biro\',\''.$pegawai_id.'\', \''.$id.'\', \''.$row['nip_baru'].'\', \''.$row['nama'] .'\', \''.$before_status.'\', \''.$row['status_masalah'].'\')" class="tip" title="Kirim Ke Biro" >'.$img4.'</a>';
					$status5 = '<a href="javascript: change_status(\'Masalah\',\''.$pegawai_id.'\', \''.$id.'\', \''.$row['nip_baru'].'\', \''.$row['nama'] .'\', \''.$before_status.'\', \''.$row['status_masalah'].'\')" class="tip" title="Info Di Biro" >'.$img5.'</a>';
					$status6 = '<a href="javascript: change_status(\'SK Selesai\',\''.$pegawai_id.'\', \''.$id.'\', \''.$row['nip_baru'].'\', \''.$row['nama'] .'\', \''.$before_status.'\', \''.$row['status_masalah'].'\', \''.$tgl_pensiun.'\', \''.$mk_gol.'\')" class="tip" title="SK Selesai" >'.$img6.'</a>';
				}	
				
				if(!empty($row['status_pensiun'])){
					$printnya = '<li><a onclick="printpage('.base_url().'pensiun/cetak/'.$row['id'].');" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>';
				}else{
					$printnya = '<li><a href="" class="tip" title=""></a> </li>';
				}
				
				if(!empty($id) && $row['status_pensiun'] != 'SK Selesai'){
					$printnya .= '<li><a href="'.base_url().'pensiun/editexisting/'.$pegawai_id.'/'.$id.'" class="tip" title="Edit entry"><i class="fam-application-edit"></i></a> </li>';
				}
				
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail Pegawai" >'.$row['nama'].'</a><br>'.$row['nip_baru'],
					$row['jabatan'],
					$row['bup'],
					date("d-m-Y",strtotime($row['tanggal_lahir'])),
					$tmt_pensiun,
					$status1,
					$status2,
					$status3,
					$status4,
					$status5,
					$status6
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	
	public function list_histori_pensiun()
	{	
		extract($_POST); 
		$this->data['title'] = 'List Histori Pensiun';
		
		$this->load->view('pensiun/pensiun_histori', $this->data);
	}

	function ajax_histori_pensiun()
    {
        $result = $this->pensiun_model->get_pensiun_histori();
		
		$json["aaData"] = array();
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
	
		//print_r($datas);die();
		if($result){
			foreach($result as $row)
			{
				$pegawai_id = $row['id_pegawai'];
				$id = $row['id'];
				$before_status = $row['status_pensiun'];
				$status_masalah = $row['status_masalah'];
				
				$lahir_th = substr($row['nip_baru'], 0, 4);
				$lahir_bl = substr($row['nip_baru'], 4, 2);
				$lahir_tgl = substr($row['nip_baru'], 6, 2);
				$tgl_lahir = $lahir_th.'-'.$lahir_bl.'-'.$lahir_tgl;
				$selisih = datediff($tgl_lahir, date('Y-m-d'));
				$usia_th = $selisih['years']; 	
				$usia_bl = $selisih['months']; 
				$usia = $usia_th.' th '.$usia_bl.' bln';
				$row['usia'] = $usia;
				
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
				$status5 = '<a href="javascript:void(0);" class="tip" title="Masalah" >'.$img5.'</a>';
				$status6 = '<a href="javascript:void(0);" class="tip" title="SK Selesai" >'.$img6.'</a>';
				
				if(!empty($row['status_pensiun'])){
					$printnya = '<li><input type="checkbox" value="'.$row['id'].'" class="call-checkbox tip" title="Pilih untuk Print kumulatif"></li>';
					$printnya .= '<li><a onclick="printpage(\''.base_url().'pensiun/cetak/'.$row['id'].'\');" href="#" class="tip" title="Print Perorangan"><i class="fam-printer"></i></a> </li>';
				}else{
					$printnya = '<li><a href="" class="tip" title=""></a> </li>';
				}
				
				//if(!empty($id) && $row['status_pensiun'] != 'SK Selesai'){
				if(!empty($id)){
					$printnya .= '<li><a href="'.base_url().'laporan/editPensiun/'.$pegawai_id.'/'.$id.'" class="tip" title="Edit entry"><i class="fam-application-edit"></i></a> </li>';
				}
				
				/*if($row['tanggal_berlaku'] == '0000-00-00' OR empty($row['tanggal_berlaku'])){
					$tgl_pensiun = '';
				}else{
					$tgl_exp = explode('-',$row['tanggal_berlaku']);
					$tgl_pensiun = $tgl_exp[2].'-'.$tgl_exp[1].'-'.$tgl_exp[0];
				}*/
				$tgl_pensiun = date("d-m-Y",strtotime($row['tmt_pensiun']));
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail Pegawai" >'.$row['nama'].'</a><br>'.$row['nip_baru'],
					$row['jabatan'],
					$row['usia'],
					$tgl_pensiun,
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
		if(!empty($nip_baru)){

			$data['status_pensiun'] = $newstatus;
			$update = $this->pensiun_model->update_pensiun_by_id($data, $id);
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
			$update = $this->pensiun_model->update_pensiun_by_id($data, $id);
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
		$user_input = $this->session->userdata('user_id');
		
		if ($id != '') {
			$data = array(
					'id_ttd'				=> $ttd,
					'jabatan_ttd'			=> $jabatan_ttd,
					'tanggal_sk'		 	=> date('Y-m-d', strtotime($tanggal_sk)),
					'no_sk'					=> $no_sk,
					'mkg_tahun'				=> $mkg_tahun,
					'mkg_bulan'				=> $mkg_bulan,
					'tembusan'				=> $tembusan,
					'tmt_pensiun'			=> date('Y-m-d', strtotime($tmt_pensiun)),
					'status_pensiun'		=> 'SK Selesai',
					'perihal'				=> $perihal,	
					'updated_date'			=> date('Y-m-d H:i:s'),
					'updated_by'			=> $user_input
			);
			
			$update = $this->pensiun_model->update_pensiun_by_id($data, $id);
			if($update){
				$return = 'success';				
				//Update status pegawai pensiun
				$this->db->where('id', $pegawai_id);
				$this->db->update('pegawai', array('status'=> 'pensiun'));
		
				
			}
		}
		
		echo $return;
	}
	
	public function add_pensiun_pilihan()
	{
		//$this->data['data_dokumen'] = $this->pensiun_model->get_dokumen();
		//$this->data['data_jabatan_ttd'] = $this->pensiun_model->ddl_jabatan_ttd();
		$this->data['data_pegawai'] = False ;
		$this->data['title'] = 'Add Pensiun Pilihan';
		$this->load->view('pensiun/add_pensiun_pilihan', $this->data);
	}
	
	public function add()
	{
		$this->data['data_pegawai'] = False ;
		$this->data['title'] = 'Add Pensiun';
		$this->load->view('pensiun/add_pensiun', $this->data);
	}
	
	public function addexisting($id)
	{
		$this->data['data_pegawai'] = $this->pensiun_model->get_pensiun_forlist($id);
		//$this->data['data_dokumen'] = $this->pensiun_model->get_dokumen($id);
		//$this->data['data_jabatan_ttd'] = $this->pensiun_model->ddl_jabatan_ttd();		
		
		$this->data['title'] = 'Add Pensiun';
		$this->load->view('pensiun/add_pensiun', $this->data);
	}
	
	//==== Riwayat Dokumen ====
	function ajax_rdokumen()
    {
		$action = $this->uri->segment(3);
		
		$id_pegawai = $this->input->post('id_pegawai');
        $result = $this->pensiun_model->get_dokumen($id_pegawai);
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
	
	public function editexisting($id_peg, $id)
	{
		$this->data['data_kp'] = $this->pensiun_model->get_pensiun($id);
		$this->data['data_pegawai'] = $this->pensiun_model->get_pensiun_forlist($id_peg);
		$this->data['data_dokumen'] = $this->pensiun_model->get_dokumen($id_peg);
		$this->data['data_jabatan_ttd'] = $this->pensiun_model->ddl_jabatan_ttd();
		
		$this->data['title'] = 'Edit Pensiun';
		$this->load->view('pensiun/edit_pensiun', $this->data);
	}
	
	public function cetak_multi($id='')
	{
		$this->data['title'] = 'Print Pensiun';
		if(!$id){
			die("Checklist dulu data pegawai!");
		}
		$idx = explode('_', $id);
		if(count($idx) > 1){
			$this->data['pensiun'] = $this->pensiun_model->get_pensiun($idx[0]);
			$this->load->view('pensiun/cetak_kolektif', $this->data);
		}
		if(count($idx) == 1){
			$this->data['pensiun'] = $this->pensiun_model->get_pensiun($id);
			$this->load->view('pensiun/cetak_pensiun', $this->data);
		}
	}
	
	public function cetak_lampiran($id='')
	{
		$this->data['title'] = 'Print Pensiun';
		if(!$id){
			die("Checklist dulu data pegawai!");
		}
		//$idx = explode('_', $id);
		//if(count($idx) > 1){
			$this->data['list_pensiun'] = $this->pensiun_model->get_pensiun_check($id);
			$this->load->view('pensiun/cetak_lampiran', $this->data);
		//}
		
	}
	
	public function cetak($id)
	{
		$this->data['title'] = 'Print Pensiun';
		$this->data['pensiun'] = $this->pensiun_model->get_pensiun($id);
		$this->load->view('pensiun/cetak_pensiun', $this->data);
	}
	
	public function listprocessed()
	{
		$this->data['title'] = 'List Pensiun';
		$this->load->view('pensiun/list_pensiun', $this->data);
	}
	
	public function insert()
	{
		extract($_POST); 
		$return = 'error';
		$user_input = $this->session->userdata('user_id');
		//kepada, jabatan_ttd, nama_ttd, nip_ttd, tembusan
		if ($id_pegawai != '') {
			$data = array(
					//'nip'					=> $nip,
					//'nama'					=> $nama,
					'id_pegawai'			=> $id_pegawai,
					'pangkat'			  	=> $pangkat,
					'golongan'			  	=> $golongan,
					'jabatan'				=> $jabatan,
					'kantor'				=> $kantor,
					'kepada'				=> $kepada,
					//'jabatan_ttd'			=> $jabatan_ttd,
					//'nama_ttd'				=> $nama_ttd,
					//'id_ttd'				=> $ttd,
					//'tembusan'				=> $tembusan,
					'tmt_pensiun'			=> date("Y-m-d",strtotime($tmt_pensiun)),
					'bup'					=> $bup,
					'status_pensiun'		=> 'Proses Entry Data',
					'created_date' 			=> date('Y-m-d H:i:s'),
					'created_by'	 		=> $user_input
				);
				
			$id_pensiun = $this->pensiun_model->insert_pensiun($data, $id_pegawai);
			//if($id_pensiun){
				//echo $id_pensiun;die;
				//Update Pensiun dokumen
				$document = $this->pensiun_model->get_dokumen($id_pegawai);
				foreach($document as $doc){
					
					$data_doc = array(
						'id_pensiun'			=> $id_pensiun,
						'nama_dokumen'			=> $doc->nama_dokumen,
						'filename'				=> $doc->filename,
						'id_tipe_dokumen'		=> $doc->id_tipe_dokumen			
					);
					if(!empty($doc->filename)){
						$this->pensiun_model->insert_pensiun_dokumen($data_doc, $id_pensiun, $doc->id_tipe_dokumen);
					}
				}
				
				$return = 'success';
			//}
		}
		echo $return;
	}
	
	public function update()
	{
		extract($_POST); 
		$return = 'error';
		$id_pensiun = $id;
		if ($nip != '') {
			$data = array(
				//'pangkat'			  	=> $pangkat,
				//'jabatan'				=> $jabatan,
				//'kantor'				=> $kantor,
				'pejabat_penetapan'		=> $pejabat_penetapan,
				'tanggal_sk'		 	=> date('Y-m-d', strtotime($tanggal_sk)),
				'no_sk'					=> $no_sk,
				'masa_kerja_gol'		=> $masakerja,
				'tanggal_berlaku'		=> date('Y-m-d', strtotime($tanggalberlaku)),
				'kepada'				=> $kepada,
				'jabatan_ttd'			=> $jabatan_ttd,
				//'nama_ttd'				=> $nama_ttd,
				'id_ttd'				=> $ttd,
				'tembusan'				=> $tembusan,			
				'perihal'				=> $perihal,
				'tmt_pensiun'			=> $tmt_pensiun,
				'bup'					=> $bup
			);
			
			$do_update = $this->pensiun_model->update_pensiun($data, $id_pensiun);
			if($do_update){
				//Update Pensiun dokumen
				$this->pensiun_model->del_pensiun_dokumen_bypensiun($id_pensiun);
				$document = $this->pensiun_model->get_dokumen($id_pegawai);
				foreach($document as $doc){
					
					$data_doc = array(
						'id_pensiun'			=> $id_pensiun,
						'nama_dokumen'			=> $doc->nama_dokumen,
						'filename'				=> $doc->filename,
						'id_tipe_dokumen'		=> $doc->id_tipe_dokumen			
					);
					if(!empty($doc->filename)){
						$this->pensiun_model->insert_pensiun_dokumen($data_doc, $id_pensiun, $doc->id_tipe_dokumen);
					}
				}
				
				$return = 'success';
			}
		}
		echo $return;
	}
	
	//AUTOCOMPLETE
	function auto_pegawai(){
		extract($_POST); 
		
		$where = "(a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%')";
		$where .= " AND (NOT(a.id IN(SELECT  pensiun.id_pegawai  FROM pensiun  
				WHERE status_pensiun != 'SK Selesai'  )) )";
		$this->db->select("a.id AS id_pegawai,  
							a.nip_baru AS nip_baru,  
							a.gelar_depan, a.nama, a.gelar_belakang,  
							b.kepangkatan AS pangkat,  
							m.nama_jabatan AS jabatan,  
							f.nama_unit_kerja AS kantor,
							b.golongan AS golongan,
							d.masa_kerja_golongan AS masa_kerja,
							e.gapok AS gapok_lama, 
							b.no_sk AS no_sk, 
							b.tgl_sk AS tanggal_sk, 
							b.pejabat_penandatangan AS pejabat_penetapan,
							d.tmt_kgb_terakhir AS tmt_kgb,
							b.tmt_kepangkatan AS tmt_kp", false)
				->from("pegawai a")
				->join('pegawai_kepangkatan b','a.id=b.id_pegawai','LEFT')
				->join('pegawai_jabatan c','a.id=c.id_pegawai','LEFT')
				->join('pegawai_kepegawaian d','a.id=d.id_pegawai','LEFT')
				->join('m_gapok e','e.kdgapok = d.kdgapok','LEFT')
				->join('m_unit_kerja f','c.kode_unit_kerja = f.kode_unit_kerja','LEFT')
				->join('m_jabatan m','m.id_jabatan = c.id_jabatan','LEFT')
				->where('a.status','aktif')
				->where($where);
		$this->db->order_by('a.nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				
				
				echo $nama."|".$row->nip_baru."|".$row->pangkat."|".$row->jabatan."|".$row->kantor.
				"|".$row->golongan."|".$row->masa_kerja."|".$row->gapok_lama."|".$row->no_sk."|".date('d-m-Y', strtotime($row->tanggal_sk)).
				"|".$row->pejabat_penetapan."|".date('d-m-Y', strtotime($row->tmt_kgb))."|".date('d-m-Y', strtotime($row->tmt_kp))."|".$row->id_pegawai."\n";
			}
		}
		
	}
}