<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Angkakredit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		
		if($this->session->userdata('login_state') == 'User') {
			redirect('logout');
		}
		
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('angkakredit_model');
		$this->load->model('Pegawai_model', 'mPegawai');
		$this->load->helper('general_helper');
		$this->load->helper('registration_helper');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index($id_ak='', $id_pegawai='')
	{	
		$this->data['title'] = 'Pengajuan Angka Kredit';
		
		$this->data['data_golongan'] = $this->mPegawai->ddl_golongan();
		$this->data['data_unit_kerja'] = $this->mPegawai->ddl_all_unit_kerja();	
		$this->data['data_strata'] = $this->mPegawai->ddl_strata_pendidikan();
		$this->data['data_jabatan'] = $this->angkakredit_model->ddl_jabatan();		
		$this->data['data_rencana_jabatan'] = $this->angkakredit_model->rencana_jabatan();		
		
		$this->load->view('angkakredit/step1', $this->data);
	}
	
	public function do_add_wizard1()
	{
		extract($_POST); 
		
		//echo '<pre>';
		//print_r($_POST);
		//die();
		$last_date = date("d",strtotime("+1 month -1 second",strtotime(date("Y-m-1"))));
		
		$periode_awal = '01-'.$periode_awal_bln.'-'.$periode_awal_thn; 
		$periode_akhir = $last_date.'-'.$periode_akhir_bln.'-'.$periode_akhir_thn; 
		
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');
		$id_pegawai = $hd_id;
		
		$data_pegawai = array(
			//'nip_lama' => $nip_lama,
			'nip_baru' => $nip_baru, 
			'no_kartu' => strtoupper($no_kartu),
			'nama' => $nama,
			'gelar_depan' => $gelar_depan,
			'gelar_belakang' => $gelar_belakang,
			'jenis_kelamin' => $jenis_kelamin,
			'tempat_lahir' => strtoupper($tempat_lahir),
			'tanggal_lahir' => date('Y-m-d',strtotime($tanggal_lahir)),				
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $user_input,
			'updated_date' => date('Y-m-d H:i:s'),
			'updated_by' => $user_input

		);
		if(empty($hd_id)){	
			$do_insert = $this->mPegawai->insert_pegawai($nip_baru, $data_pegawai);
			$id_pegawai = $do_insert;
			$do = 'insert';
		}	

		if(!empty($id_pegawai)){
			
			$data_pegawai_sub = array(
				'id' => $id_pegawai,
				'nama' => strtoupper($nama),
				'nip_baru' => $nip_baru
			);				
			$data_pegawai_kepegawaian = array(
				'id' => $id_pegawai,
				'nama' => strtoupper($nama),
				'nip_baru' => $nip_baru,
				'status_kepegawaian' => 'P N S',
				'jenis_kepegawaian' => 'DOKTER',
				'gol_terakhir' => $golongan,
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $user_input
			);
			$data_pegawai_jabatan = array(
				'id' => $id_pegawai,
				'nama' => strtoupper($nama),
				'nip_baru' => $nip_baru,
				'id_jabatan' => $jabatan,
				'tmt_jabatan' => date('Y-m-d',strtotime($tmt_jabatan)),
				'unit_kerja' => $last_unit_kerja,
				'kode_unit_kerja' => $last_unit_kerja
			);
			$data_pegawai_kepangkatan = array(
				'id' => $id_pegawai,
				'nama' => strtoupper($nama),
				'nip_baru' => $nip_baru,
				'golongan' => $golongan,
				'kepangkatan' => $pangkat,
				'tmt_kepangkatan' => date('Y-m-d',strtotime($tmt_pangkat))
			);
			$data_pegawai_pendidikan = array(
				'id' => $id_pegawai,
				'nama' => strtoupper($nama),
				'nip_baru' => $nip_baru,
				'strata' => $strata,
				'program_studi' => $program_studi,
				'kategori' => 'Kesehatan',
				'jenis_tenaga' => 'Medis'
			);
			
			
			$this->mPegawai->cek_kepegawaian($id_pegawai, $data_pegawai_kepegawaian);
			$this->mPegawai->cek_jabatan($id_pegawai, $data_pegawai_jabatan);
			$this->mPegawai->cek_kepangkatan($id_pegawai, $data_pegawai_kepangkatan);
			$this->mPegawai->cek_pendidikan($id_pegawai, $data_pegawai_pendidikan);
			$this->mPegawai->cek_tempatkerja($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_suami_istri($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_anak($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_diklat_jabatan($id_pegawai, $data_pegawai_sub);
			$this->mPegawai->cek_diklat_teknis($id_pegawai, $data_pegawai_sub);
			
			$status = 'success';
			
		}
				
		//insert ke table angkakredit 
		$data_pegawai = array(
			'id_pegawai' => $id_pegawai,
			'pangkat' => $pangkat, 
			'golongan' => $golongan,
			'tmt_pangkat' => date('Y-m-d',strtotime($tmt_pangkat)),
			'pendidikan' => $program_studi,
			'id_jabatan' => $jabatan,
			'id_golongan' => $id_golongan,
			'id_prasyarat' => $rencana_id_ak,
			'rencana_id_jabatan' => $rencana_id_jabatan,
			'rencana_id_golongan' => $rencana_id_golongan,
			'tmt_jabatan' => date('Y-m-d',strtotime($tmt_jabatan)),
			'unit_Kerja' => $last_unit_kerja,
			'periode_awal' => date('Y-m-d',strtotime($periode_awal)),			
			'periode_akhir' => date('Y-m-d',strtotime($periode_akhir)),			
			'status_ak' => '1',
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $user_input
		);
		$do_insert_ak = $this->angkakredit_model->insert_angkakredit($data_pegawai);
		if($do_insert_ak){
			$id_ak = $do_insert_ak;
			$status = 'success';
		}
		
		echo $status."#".$id_ak."#".$id_pegawai;
	}	
	
	public function step2($id_ak, $id_pegawai, $id_jabatan_selected='')
	{	
		$this->data['title'] = 'Pengajuan Angka Kredit';
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);	
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		
		if(empty($id_jabatan_selected)){
			$id_jabatan_selected = $this->data['data_ak']->id_jabatan;
		}
		$this->data['id_jabatan_selected'] = $id_jabatan_selected;
		$this->data['data_step2'] = $this->angkakredit_model->data_step2($id_ak, $id_jabatan_selected);
		
		$this->load->view('angkakredit/step2', $this->data);
	}
	
	public function vstep2($id_ak, $id_pegawai, $id_jabatan_selected='')
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengajuan Angka Kredit';
		
		if(empty($id_jabatan_selected)){
			$id_jabatan_selected = $this->data['data_ak']->id_jabatan;
		}
		$this->data['id_jabatan_selected'] = $id_jabatan_selected;
		$this->data['data_step2'] = $this->angkakredit_model->data_step2($id_ak);
		$this->load->view('angkakredit/vstep2', $this->data);
	}
	
	public function print_step2($id_ak, $id_pegawai, $id_jabatan_selected='')
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengajuan Angka Kredit';
		
		if(empty($id_jabatan_selected)){
			$id_jabatan_selected = $this->data['data_ak']->id_jabatan;
		}
	
		$this->data['data_step2'] = $this->angkakredit_model->data_step2($id_ak);
		$this->load->view('angkakredit/print_step2', $this->data);
	}
	
	public function do_reset_wizard2(){
		extract($_POST); 
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');
		
		if(!empty($user_input) AND !empty($id_angkakredit)){
			
			//delete if available 
			$this->db->where('id_angkakredit', $id_angkakredit);
			$this->db->delete('angkakredit_detail');
			
			//delete if available 
			$this->db->where('id_angkakredit', $id_angkakredit);
			$this->db->delete('angkakredit_pertimbangan');
			
			//delete if available 
			$this->db->where('id_angkakredit', $id_angkakredit);
			$this->db->delete('angkakredit_penetapan');			
			
			$status = 'success';
		}
		
		echo $status."#".$id_angkakredit."#".$hd_id;
	}
	
	public function do_add_wizard2()
	{
		extract($_POST); 
		//echo $_POST['ak_nilai'][1][2][2];
		
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');
		
		if(empty($hd_id) AND empty($id_angkakredit)){
			die("error");
		}
		
		//get current detail
		$id_ak_detail = array();
		$id_ak_detail_all = array();
		$this->db->where('id_jabatan_selected', $hd_jabatan);
		$this->db->where('id_angkakredit', $id_angkakredit);
		$get_detail = $this->db->get('angkakredit_detail');
		if($get_detail->num_rows() > 0){
			
			//UPDATE
			foreach($get_detail->result() as $dt){
				if(empty($id_ak_detail[$dt->id_angkakredit.'_'.$dt->id_uk.'_'.$dt->id_sub_uk])){
					$id_ak_detail[$dt->id_angkakredit.'_'.$dt->id_uk.'_'.$dt->id_sub_uk] = $dt->id_ak_detail;
				}
				$id_ak_detail_all[] = $dt->id_ak_detail;
			}
			
		}
			
		$all_angkakredit_detail = array();
		$all_angkakredit_pertimbangan = array();
		if(!empty($hd_id) AND !empty($id_angkakredit) AND !empty($nilai_uk)){	
		
			if(!empty($nilai_uk)){
				
				//nilai _uk A
				foreach($nilai_uk as $key_A => $dt_uk_A){
					
					//nilai_uk B
					foreach($dt_uk_A as $key_B => $dt_uk_B){
						
						//get id_uk 
						if(!empty($id_uk[$key_A][$key_B])){
							
							
							//DATA DETAIL NILAI - angkakredit_detail
							//nilai_uk C
							foreach($dt_uk_B as $key_C => $nilai_uk){
								
								//get id_sub_uk
								if(!empty($id_sub_uk[$key_A][$key_B][$key_C])){
									
									//get ak_nilai
									$nilai_AK = 0;
									if(!empty($ak_nilai[$key_A][$key_B][$key_C])){
										$nilai_AK = $ak_nilai[$key_A][$key_B][$key_C];
									}
									
									//get nilai_total
									$nilai_total = 0;
									if(!empty($total_nilai_C[$key_A][$key_B][$key_C])){
										$nilai_total = $total_nilai_C[$key_A][$key_B][$key_C];
									}
									
									//get kategori_uk
									$get_kategori_uk = '';
									if(!empty($kategori_uk[$key_A])){
										$get_kategori_uk = $kategori_uk[$key_A];
									}
									
									//get satuan_bagi
									$get_satuan_bagi = 0;
									if(!empty($satuan_bagi[$key_A][$key_B][$key_C])){
										$get_satuan_bagi = $satuan_bagi[$key_A][$key_B][$key_C];
									}
									
									//get pengali_persen
									$get_pengali_persen = 0;
									if(!empty($pengali_persen[$key_A][$key_B][$key_C])){
										$get_pengali_persen = $pengali_persen[$key_A][$key_B][$key_C];
									}
									
									if(!empty($id_ak_detail[$id_angkakredit.'_'.$id_uk[$key_A][$key_B].'_'.$id_sub_uk[$key_A][$key_B][$key_C]])){
										
										$update_detail = array(
											'nilai_ak'			=> $nilai_AK,
											'nilai_uk'			=> $nilai_uk,
											'nilai_total' 		=> $nilai_total,
											'satuan_bagi' 		=> $get_satuan_bagi,
											'pengali_persen' 	=> $get_pengali_persen
										);
										
										$this->db->where('id_ak_detail', $id_ak_detail[$id_angkakredit.'_'.$id_uk[$key_A][$key_B].'_'.$id_sub_uk[$key_A][$key_B][$key_C]]);
										$this->db->update('angkakredit_detail', $update_detail);
										$all_update_detail[] = $id_ak_detail[$id_angkakredit.'_'.$id_uk[$key_A][$key_B].'_'.$id_sub_uk[$key_A][$key_B][$key_C]];
										
										//echo 'Update Detail - '.$id_ak_detail[$id_angkakredit.'_'.$id_uk[$key_A][$key_B].'_'.$id_sub_uk[$key_A][$key_B][$key_C]].'<br/>';
										
									}else{
										
										//insert
										$insert_detail = array(
											'id_angkakredit'	=> $id_angkakredit,
											'id_jabatan_selected'  	=> $hd_jabatan,
											'kategori_uk'		=> $get_kategori_uk,
											'id_uk' 			=> $id_uk[$key_A][$key_B],
											'id_sub_uk' 		=> $id_sub_uk[$key_A][$key_B][$key_C],
											'nilai_ak'			=> $nilai_AK,
											'nilai_uk'			=> $nilai_uk,
											'nilai_total' 		=> $nilai_total,
											'satuan_bagi' 		=> $get_satuan_bagi,
											'pengali_persen' 	=> $get_pengali_persen
										);
										$this->db->insert('angkakredit_detail', $insert_detail);
										$all_update_detail[] = $this->db->insert_id();
										//echo 'Insert Detail - '.$this->db->insert_id().'<br/>';
									}
									
								}
							
							}
							
							
						}
						
					}
					
				}
				
				//delete other id detail - not used
				if(!empty($id_ak_detail_all) AND !empty($all_update_detail)){
					foreach($id_ak_detail_all as $id_p){
						$all_deleted_id = array();
						if(!in_array($id_p, $all_update_detail)){
							$all_deleted_id[] = $id_p;
							//echo 'Delete Detail - '.$id_p.'<br/>';
						}
						
						if(!empty($all_deleted_id)){
							$where_delete_id = implode("','",$all_deleted_id);
							$this->db->where("id_ak_detail IN ('".$where_delete_id."')");
							$this->db->delete('angkakredit_detail');
						}
						
					}
				}
				
			}
				
			
			$get_tanggal_penilaian = strtotime($tanggal_penilaian);
			$tanggal_penilaian = date('Y-m-d', $get_tanggal_penilaian);
		
		
			//UPDATE angka kredit - PAK
			$update_data_angkakredit = array(
				'status_ak' 			=> 'Proses',
				'nilai_penetapan' 		=> 0,
				'tanggal_penilaian'		=> $tanggal_penilaian,
				'pejabat_mengetahui'	=> $pejabat_mengetahui,
				'pejabat_penyelenggara'	=> $pejabat_penyelenggara
			);
			
			$this->db->where("id_angkakredit", $id_angkakredit);
			$this->db->update('angkakredit',$update_data_angkakredit);
			
			$status = 'success';
			
				
			
		}
		
		echo $status."#".$id_angkakredit."#".$hd_id;
	}
	
	public function do_next_wizard2()
	{
		extract($_POST); 
		//echo $_POST['ak_nilai'][1][2][2];
		
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');
		
		if(empty($hd_id) AND empty($id_angkakredit)){
			die("error");
		}
			
		//get current detail
		$nilai_detail_all = array();
		$this->db->select('id_uk, kategori_uk', false);
		$this->db->where('id_angkakredit', $id_angkakredit);
		$get_detail = $this->db->get('angkakredit_detail');
		if($get_detail->num_rows() > 0){

			foreach($get_detail->result() as $dt){
			
				$this->db->select('sum(nilai_total) as total_nilai_ak', false);
				$this->db->where('id_uk', $dt->id_uk);
				$get_subdetail = $this->db->get('angkakredit_detail');
				if($get_subdetail->num_rows() > 0){
					$rows = $get_subdetail->row();
					
					//cek update
					$this->db->where('id_angkakredit', $id_angkakredit);
					$this->db->where('id_uk', $dt->id_uk);
					$get_ap = $this->db->get('angkakredit_pertimbangan');
					
					if($get_ap->num_rows() > 0){
						$rows_ap = $get_ap->row();
						
						if($rows->total_nilai_ak > 0){
							$data_update_pertimbangan = array(
								'total_detail' 			=> $rows->total_nilai_ak,
							);
							$this->db->where('id_pertimbangan', $rows_ap->id_pertimbangan);
							$this->db->update('angkakredit_pertimbangan', $data_update_pertimbangan);
						}
					}else{
					
						if($rows->total_nilai_ak > 0){
							$data_input_pertimbangan = array(
								'id_angkakredit' 		=> $id_angkakredit,
								'kategori_uk'			=> $dt->kategori_uk,
								'id_uk' 				=> $dt->id_uk,
								'total_detail' 			=> $rows->total_nilai_ak,
								'total_pertimbangan'	=> $rows->total_nilai_ak,
								'persetujuan'			=> 'Tidak',
								'keterangan' 			=> ''
							);
							$this->db->insert('angkakredit_pertimbangan', $data_input_pertimbangan);
						}
					}
				}
			}
			$status = 'success';
		}
		
		echo $status."#".$id_angkakredit."#".$hd_id;
	}
	
	public function step3($id_ak, $id_pegawai)
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengajuan Angka Kredit Step 3';
		$this->data['data_step3'] = $this->angkakredit_model->data_step3($id_ak);
		$this->load->view('angkakredit/step3', $this->data);
	}
	
	public function vstep3($id_ak, $id_pegawai)
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengajuan Angka Kredit Step 3';
		$this->data['data_step3'] = $this->angkakredit_model->data_step3($id_ak);
		$this->load->view('angkakredit/vstep3', $this->data);
	}
	
	public function print_step3($id_ak, $id_pegawai)
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengajuan Angka Kredit Step 3';
		$this->data['data_step3'] = $this->angkakredit_model->data_step3($id_ak);
		$this->load->view('angkakredit/print_step3', $this->data);
	}
	
	public function do_add_wizard3()
	{
		extract($_POST); 
		//echo $_POST['ak_nilai'][1][2][2];
		
		$status = 'error';
		$user_input = $this->session->userdata('username');
		
		if(empty($hd_id) AND empty($id_angkakredit)){
			die("error");
		}
		
		//get ak lama
		$id_angkakredit_lama = 0;
		$no_pak_lama = '';
		$this->db->where('id_angkakredit < '.$id_angkakredit.' AND id_pegawai = '.$hd_id);
		$get_angkakredit_lama = $this->db->get('angkakredit');
		if($get_angkakredit_lama->num_rows() > 0){
			$dt_angkakredit_lama = $get_angkakredit_lama->row();
			$id_angkakredit_lama = $dt_angkakredit_lama->id_angkakredit;
			$no_pak_lama = $dt_angkakredit_lama->no_pak;
		}
		
		//get current pertimbangan
		$id_pertimbangan = array();
		$id_pertimbangan_all = array();
		$this->db->where('id_angkakredit', $id_angkakredit);
		$get_pertimbangan = $this->db->get('angkakredit_pertimbangan');
		if($get_pertimbangan->num_rows() > 0){
			
			//UPDATE
			foreach($get_pertimbangan->result() as $dt){
				if(empty($id_pertimbangan[$dt->id_angkakredit.'_'.$dt->id_uk])){
					$id_pertimbangan[$dt->id_angkakredit.'_'.$dt->id_uk] = $dt->id_pertimbangan;
				}
				$id_pertimbangan_all[] = $dt->id_pertimbangan;
			}
			
		}
		
		//get current penetapan
		$id_penetapan = array();
		$id_penetapan_all = array();
		$this->db->where('id_angkakredit', $id_angkakredit);
		$get_penetapan = $this->db->get('angkakredit_penetapan');
		if($get_penetapan->num_rows() > 0){
			
			//UPDATE
			foreach($get_penetapan->result() as $dt){
				if(empty($id_penetapan[$dt->id_angkakredit.'_'.$dt->id_uk])){
					$id_penetapan[$dt->id_angkakredit.'_'.$dt->id_uk] = $dt->id_penetapan;
				}
				
				$id_penetapan_all[] = $dt->id_penetapan;
			}
			
		}
		
		//get current penetapan lama
		$data_penetapan_lama = array();
		if(!empty($id_angkakredit_lama)){
			$this->db->where('id_angkakredit', $id_angkakredit_lama);
			$get_penetapan_lama = $this->db->get('angkakredit_penetapan');
			if($get_penetapan_lama->num_rows() > 0){
				
				//UPDATE
				foreach($get_penetapan_lama->result() as $dt_lama){
					if(empty($data_penetapan_lama[$dt_lama->id_uk])){
						$data_penetapan_lama[$dt_lama->id_uk] = $dt_lama;
					}
				}
				
			}
		}
		
		$all_angkakredit_pertimbangan = array();
		$all_angkakredit_penetapan = array();
		$all_update_pertimbangan = array();
		if(!empty($hd_id) AND !empty($id_angkakredit) AND !empty($total_pertimbangan) AND !empty($id_pertimbangan)){	
			
			//get ak lama
			
			
			if(!empty($total_pertimbangan)){
				
				//nilai _uk A
				foreach($total_pertimbangan as $key_A => $dt_uk_A){
					
					//nilai_uk B
					foreach($dt_uk_A as $key_B => $dt_uk_B){
						
						//get id_uk 
						if(!empty($id_uk[$key_A][$key_B])){
							//get kategori_uk
							$get_kategori_uk = '';
							if(!empty($kategori_uk[$key_A][$key_B])){
								$get_kategori_uk = $kategori_uk[$key_A][$key_B];
							}
														
							//DATA PERTIMBANGAN - angkakredit_pertimbangan
							$get_persetujuan = 'Tidak';
							if(!empty($persetujuan[$key_A][$key_B])){
								$get_persetujuan = $persetujuan[$key_A][$key_B];
							}
							
							$get_keterangan = '';
							if(!empty($keterangan[$key_A][$key_B])){
								$get_keterangan = $keterangan[$key_A][$key_B];
							}
							
							if(!empty($id_pertimbangan[$id_angkakredit.'_'.$id_uk[$key_A][$key_B]])){
								$update_pertimbangan = array(
									'total_pertimbangan'	=> $dt_uk_B,
									'persetujuan'			=> $get_persetujuan,
									'keterangan' 			=> $get_keterangan
								);
								//$all_angkakredit_pertimbangan[] = $update_pertimbangan;
								$this->db->where('id_pertimbangan', $id_pertimbangan[$id_angkakredit.'_'.$id_uk[$key_A][$key_B]]);
								$this->db->update('angkakredit_pertimbangan', $update_pertimbangan);
								$all_update_pertimbangan[] = $id_pertimbangan[$id_angkakredit.'_'.$id_uk[$key_A][$key_B]];
								
							}else{
								//insert
								$insert_pertimbangan = array(
									'id_angkakredit' 		=> $id_angkakredit,
									'kategori_uk'			=> $get_kategori_uk,
									'id_uk' 				=> $id_uk[$key_A][$key_B],
									'total_detail'			=> 0,
									'total_pertimbangan'	=> $dt_uk_B,
									'persetujuan'			=> $get_persetujuan,
									'keterangan' 			=> $get_keterangan
								);
								$this->db->insert('angkakredit_pertimbangan', $insert_pertimbangan);
								$all_update_pertimbangan[] = $this->db->insert_id();
								
							}
							
							$total_ak_lama = 0;
							$akumulasi_jumlah = 0;
							
							if(!empty($data_penetapan_lama[$key_B])){
								$dt_ak_lama = $data_penetapan_lama[$key_B];
								
								if(!empty($dt_ak_lama->total_ak_baru)){
									$total_ak_lama = $dt_ak_lama->total_ak_baru;
								}
								
								if(!empty($dt_ak_lama->jumlah)){
									$akumulasi_jumlah = $dt_ak_lama->jumlah;
								}
								
							}
							
							$akumulasi_jumlah += $dt_uk_B;
							
							$insert_penetapan = array(
								'id_angkakredit' 		=> $id_angkakredit,
								'kategori_uk'			=> $get_kategori_uk,
								'id_uk' 				=> $id_uk[$key_A][$key_B],
								'total_ak_baru'			=> $dt_uk_B,
								'total_ak_lama'			=> $total_ak_lama,
								'jumlah'				=> $akumulasi_jumlah
							);
							$all_angkakredit_penetapan[] = $insert_penetapan;
							
						}
						
					}
					
				}
				
				//delete other id pertimbangan - not used
				if(!empty($id_pertimbangan_all) AND !empty($all_update_pertimbangan)){
					foreach($id_pertimbangan_all as $id_p){
						$all_deleted_id = array();
						if(!in_array($id_p, $all_update_pertimbangan)){
							$all_deleted_id[] = $id_p;
						}
						
						if(!empty($all_deleted_id)){
							$where_delete_id = implode("','",$all_deleted_id);
							$this->db->where("id_pertimbangan IN ('".$where_delete_id."')");
							$this->db->delete('angkakredit_pertimbangan');
						}
						
					}
				}
				
			}
			
			$total_nilai_penetapan = 0;
			if(!empty($all_angkakredit_penetapan)){
				if(empty($id_penetapan)){
					
					//insert all new
					$this->db->insert_batch('angkakredit_penetapan', $all_angkakredit_penetapan);
					
				}else{
					
					$all_update_penetapan = array();
					foreach($all_angkakredit_penetapan as $dt_penetapan){
						
						$dt_penetapan = (object)$dt_penetapan;
						if(!empty($id_penetapan[$dt_penetapan->id_angkakredit.'_'.$dt_penetapan->id_uk])){
							
							//update
							$update_old_penetapan = array(
								'id_angkakredit' 		=> $dt_penetapan->id_angkakredit,
								'kategori_uk'			=> $dt_penetapan->kategori_uk,
								'id_uk' 				=> $dt_penetapan->id_uk,
								'total_ak_baru'			=> $dt_penetapan->total_ak_baru,
								'total_ak_lama'			=> $dt_penetapan->total_ak_lama,
								'jumlah'				=> $dt_penetapan->jumlah
							);
							$this->db->where('id_penetapan', $id_penetapan[$dt_penetapan->id_angkakredit.'_'.$dt_penetapan->id_uk]);
							$this->db->update('angkakredit_penetapan', $update_old_penetapan);
							
							$all_update_penetapan[] = $id_penetapan[$dt_penetapan->id_angkakredit.'_'.$dt_penetapan->id_uk];
							$total_nilai_penetapan += $dt_penetapan->jumlah;
							
						}else{
							
							//insert
							$insert_new_penetapan = array(
								'id_angkakredit' 		=> $dt_penetapan->id_angkakredit,
								'kategori_uk'			=> $dt_penetapan->kategori_uk,
								'id_uk' 				=> $dt_penetapan->id_uk,
								'total_ak_baru'			=> $dt_penetapan->total_ak_baru,
								'total_ak_lama'			=> $dt_penetapan->total_ak_lama,
								'jumlah'				=> $dt_penetapan->jumlah
							);
							
							$this->db->insert('angkakredit_penetapan', $insert_new_penetapan);
							
							$all_update_penetapan[] = $this->db->insert_id();
							$total_nilai_penetapan += $dt_penetapan->jumlah;
							
						}
						
					
					}
					
					//delete other id penetapan - not used
					if(!empty($id_penetapan_all) AND !empty($all_update_penetapan)){
						foreach($id_penetapan_all as $id_p){
							$all_deleted_id = array();
							if(!in_array($id_p, $all_update_penetapan)){
								$all_deleted_id[] = $id_p;
							}
							
							if(!empty($all_deleted_id)){
								$where_delete_id = implode("','",$all_deleted_id);
								$this->db->where("id_penetapan IN ('".$where_delete_id."')");
								$this->db->delete('angkakredit_penetapan');
							}
							
						}
					}
					
				}
			
			}
			
			
			
			$get_tanggal_pertimbangan = strtotime($tanggal_pertimbangan);
			$tanggal_pertimbangan = date('Y-m-d', $get_tanggal_pertimbangan);
		
		
			//UPDATE angka kredit - PAK
			$update_data_angkakredit = array(
				'id_angkakredit_lama' 	=> $id_angkakredit_lama,
				'status_ak' 			=> 'Proses',
				'nilai_penetapan' 		=> $total_nilai_penetapan,
				'nilai_pak_lama' 		=> $nilai_pak_lama,
				'tanggal_pertimbangan'	=> $tanggal_pertimbangan,
				'pejabat_tim_penilai'	=> $pejabat_tim_penilai
			);
			
			$this->db->where("id_angkakredit", $id_angkakredit);
			$this->db->update('angkakredit',$update_data_angkakredit);
			
			$status = 'success';				
			
		}
		
		echo $status."#".$id_angkakredit."#".$hd_id;
	}
	
	public function step4($id_ak, $id_pegawai)
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengajuan Angka Kredit Step 3';
		$this->data['data_step4'] = $this->angkakredit_model->data_step4($id_ak);
		
		$this->load->view('angkakredit/step4', $this->data);
	}
	
	public function vstep4($id_ak, $id_pegawai)
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengajuan Angka Kredit Step 3';
		$this->data['data_step4'] = $this->angkakredit_model->data_step4($id_ak);
		$this->load->view('angkakredit/vstep4', $this->data);
	}
	
	public function print_step4($id_ak, $id_pegawai)
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Penetapan Angka Kredit Step 4';
		$this->data['data_step4'] = $this->angkakredit_model->data_step4($id_ak);
		$this->load->view('angkakredit/print_step4', $this->data);
	}
	
	public function print_pengantar4($id_ak, $id_pegawai)
	{	
		$this->data['hd_id'] = $id_pegawai;
		$this->data['id_angkakredit'] = $id_ak;
		$this->data['data_ak'] = $this->angkakredit_model->get_angkakredit($id_ak);
		$this->data['data_pegawai'] = $this->mPegawai->get_pegawai_byId($id_pegawai);
		$this->data['title'] = 'Pengantar Angka Kredit';
		$this->data['data_step4'] = $this->angkakredit_model->data_step4($id_ak);
		$this->load->view('angkakredit/print_pengantar4', $this->data);
	}
	
	public function do_add_wizard4()
	{
	
		extract($_POST); 
		//echo $_POST['ak_nilai'][1][2][2];
		
		$status = 'error';
		$user_input = $this->session->userdata('username');
		
		if(empty($hd_id) AND empty($id_angkakredit) AND empty($no_pak) AND empty($tanggal_pak)){
			die($status);
		}
		
		//UPDATE NILAI PENETAPAN
		$nilai_penetapan = 0;
		if(!empty($id_penetapan)){
			foreach($id_penetapan as $key_A => $dt_A){
				if(!empty($dt_A)){
					foreach($dt_A as $key_B => $dt_B){
						
						$get_total_ak_lama = 0;
						if(!empty($total_ak_lama[$key_A][$key_B])){
							$get_total_ak_lama = $total_ak_lama[$key_A][$key_B];
						}
						
						$get_total_ak_baru = 0;
						if(!empty($total_ak_baru[$key_A][$key_B])){
							$get_total_ak_baru = $total_ak_baru[$key_A][$key_B];
						}
						
						$get_jumlah = $get_total_ak_lama + $get_total_ak_baru;
						
						$nilai_penetapan += $get_jumlah;
						
						$update_data_penetapan = array(
							'total_ak_lama'	=> $get_total_ak_lama,
							'jumlah'		=> $get_jumlah
						);
						
						$this->db->where("id_penetapan", $dt_B);
						$this->db->update('angkakredit_penetapan', $update_data_penetapan);
		
					}
				}
			}
		}
		
		$get_tanggal_pak = strtotime($tanggal_pak);
		$tanggal_pak = date('Y-m-d', $get_tanggal_pak);
		//UPDATE angka kredit - PAK
		$update_data_angkakredit = array(
			'nilai_penetapan' 		=> $nilai_penetapan,
			'no_pak' 				=> $no_pak,
			'tanggal_pak' 			=> $tanggal_pak,
			'pejabat_penetapan' 	=> $pejabat_penetapan,
			'tembusan_penetapan' 	=> $tembusan_penetapan,
			'masa_kerja_lama_tahun' 	=> $masa_kerja_lama_tahun,
			'masa_kerja_lama_bulan' 	=> $masa_kerja_lama_bulan,
			'masa_kerja_baru_tahun' 	=> $masa_kerja_baru_tahun,
			'masa_kerja_baru_bulan' 	=> $masa_kerja_baru_bulan,
			'status_ak' 			=> 'Selesai'
		);
		
		$this->db->where("id_angkakredit", $id_angkakredit);
		$this->db->update('angkakredit',$update_data_angkakredit);
		
		$status = 'success';
		
		echo $status."#".$id_angkakredit."#".$hd_id;
	}
	
	function check_nip_baru()
	{
		extract($_POST); 
			$where = "(a.nip_baru like '".$q."%' OR a.nama like '%".$q."%')";
			$this->db->select("a.*, b.golongan, b.kepangkatan, b.tmt_kepangkatan, c.id_jabatan, c.kode_unit_kerja, c.tmt_jabatan, d.strata, d.program_studi", false)
					->from("pegawai a")
					->join("pegawai_kepangkatan b", 'a.id=b.id_pegawai', 'LEFT', false)
					->join("pegawai_jabatan c", 'a.id=c.id_pegawai', 'LEFT', false)
					->join("pegawai_pendidikan d", 'a.id=d.id_pegawai', 'LEFT', false)
					->where('a.status','aktif')
					->where($where);
			$this->db->order_by('a.nama', 'ASC');
			//$this->db->limit(100);
			$q_part=$this->db->get();
			$count = $this->db->count_all_results();
			if ($count>0){
				
				foreach($q_part->result() as $row){
					$tgl_lahir = '';
					$tmt_kepangkatan = '';
					$tmt_jabatan = '';
					$id_golongan = '';
					$nama_unit_kerja = '';
					$nama_strata = '';
					if(!empty($row->tanggal_lahir)){
						$tgl_lahir = date('d-m-Y',strtotime($row->tanggal_lahir));
					}
					if(!empty($row->tmt_kepangkatan)){
						$tmt_kepangkatan = date('d-m-Y',strtotime($row->tmt_kepangkatan));
					}
					if(!empty($row->tmt_jabatan)){
						$tmt_jabatan = date('d-m-Y',strtotime($row->tmt_jabatan));
					}
					if(!empty($row->golongan)){
						$id_golongan = get_name('m_golongan','id_golongan','kode_golongan', $row->golongan);
					}
					if(!empty($row->kode_unit_kerja)){
						$nama_unit_kerja = get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $row->kode_unit_kerja);
					}
					if(!empty($row->strata)){
						$nama_strata = get_name('m_strata_pendidikan','nama_strata','id_strata', $row->strata);
					}
					
					echo $row->nip_baru."  (".$row->nama.")|".$row->nip_baru."|".$row->nama."|".$row->gelar_depan."|".$row->gelar_belakang.
						"|".$row->no_kartu."|".trim($row->jenis_kelamin)."|".trim($row->tempat_lahir)."|".$tgl_lahir."|".$row->id.
						"|".$row->golongan."|".trim($row->kepangkatan)."|".$tmt_kepangkatan."|".$id_golongan.
						"|".$row->id_jabatan."|".$tmt_jabatan."|".trim($row->kode_unit_kerja)."|".$nama_unit_kerja.
						"|".$row->strata."|".$nama_strata."|".trim($row->program_studi).
						"\n";
				}
			}else{
				echo 'error';
			}
	}
	
	function auto_unit_kerja()
	{
		extract($_POST); 
		$where = "nama_unit_kerja like '%".$q."%'";
		$this->db->select("*", false)
				->from("m_unit_kerja", false)
				->where($where);
		$this->db->order_by('id_unit_kerja', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			
			foreach($q_part->result() as $row){
				
				echo $row->nama_unit_kerja."  (".$row->kode_unit_kerja.")|".$row->id_unit_kerja."|".$row->nama_unit_kerja."|".$row->kode_unit_kerja."\n";
			}
		}else{
			echo 'error';
		}
	}
	
	public function histori()
	{	
		$this->data['title'] = 'Histori Angka Kredit';
		//$this->data['data_pegawai'] = $this->angkakredit_model->get_angkakredit_forlist();
		$this->load->view('angkakredit/angkakredit_histori', $this->data);
	}
	
	public function ajax_ak_histori(){
						
		$result = $this->angkakredit_model->get_all();
					
		$json["aaData"] = array();
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		if($result){
			foreach($result as $row)
			{
				$id_angkakredit = $row['id_angkakredit'];
				$id_pegawai = $row['id_pegawai'];
				$tmt_jabatan = '';
				$tmt_pangkat = '';
				if(!empty($row['tmt_jabatan'])){
					$tmt_jabatan = date('d-m-Y',strtotime($row['tmt_jabatan']));
				}
				if(!empty($row['tmt_pangkat'])){
					$tmt_pangkat = date('d-m-Y',strtotime($row['tmt_pangkat']));
				}
				
				$status = '<div style="text-align:center; color:green;">Selesai</div>';
				$viewData = ' href="'.base_url().'angkakredit/vstep2/'.$id_angkakredit.'/'.$id_pegawai.'" class="tip" title="Detail / View PAK" ';
				if($row['status_ak'] == 'Proses'){
					$status = '<div style="text-align:center; color:blue;">Proses</div>';
					$viewData = 'href="javascript:void(0);"';
				}
				
				array_push($json["aaData"],array(
					$i,
					'<a'.$viewData.'>'.$row['nama'].'</a><br>'.
						'NIP: '.$row['nip_baru'],
					$status,
					$row['pangkat'].' '.$row['golongan'].'<br>('.$tmt_pangkat.')',
					$row['nama_jabatan'].'<br>('.$tmt_jabatan.')',
					$row['rencana_nama_jabatan'],
					$row['rencana_nama_golongan'].' '.$row['rencana_kode_golongan'],
					$row['no_pak'].' ('.$row['tanggal_pak'].')',
					'<center>
					<a style="cursor:pointer;" href="'.base_url().'angkakredit/step2/'.$id_angkakredit.'/'.$id_pegawai.'" class="fam-application-edit"></a> &nbsp; 
					<a style="cursor:pointer;" onclick="javascript:onDelete_AK(\''.$id_angkakredit.'\', \'Data No '.$i.'\')" class="fam-application-delete"></a>
					</center>'
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
	}
	
	public function do_delete_angkakredit(){
		extract($_POST); 
		$status = 'error';
		
		$do_ = $this->angkakredit_model->do_delete_angkakredit($id);
		
		if($do_){			
		
			$status = 'success';	
		}
		
		echo $status;
	}
	
	function change_jabatan_unsur()
	{
		extract($_POST); 
		$data = "";
		$new_jab = $this->mPegawai->ddl_jabatan('',$status_id); 
			$data = '<select id="nama_jabatan3" name="nama_jabatan3" class="input-xlarge">
					<option value=""> </option>
					';			
					if($new_jab){
						foreach($new_jab as $row){							
							$data .= "<option value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
						}
					}
			$data .= '</select>';
			
		echo $data;
	}
	
	
	public function do_popup_unitkerja()
	{
		extract($_POST); 
		$this->load->model('unitkerja_model');
		//die();
		$status = 'error';
		$do_ = '';
		
		$data = array(
			'nama_unit_kerja'	=> $nama_unit_kerja,
			'level'				=> $level,
			'kode_unit_kerja'	=> $kode_unit_kerja,
			'parent_unit'		=> $parent_unit,
			'prov_id'			=> $prov_id
		);
			
		$do_ = $this->unitkerja_model->insert_data($data);
		$last_id = $this->db->insert_id();
		if($do_){
			
			$status = 'success#'.$nama_unit_kerja.'#'.$kode_unit_kerja;	
		}
		
		echo $status;
	}
	
}