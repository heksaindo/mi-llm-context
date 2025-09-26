<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migrasi_pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form') ;
		$this->load->model('Pegawai_model', 'mPegawai');
		$this->load->helper('general_helper');
	}
	
	function index() {	
		$this->load->view('upload_excel', array('error' => ' ' ));
		
	}

	function do_upload()
	{
		$status = 'error';
		$user_input = $this->session->userdata('username');
		$file =  APP_PATH."/Uploads/excel/" ;

		//Truncate table pegawai
		$this->db->truncate('pegawai_tempatkerja');
		$this->db->truncate('pegawai_suami_istri');
		$this->db->truncate('pegawai_riwayatpenghargaan');
		$this->db->truncate('pegawai_riwayatpendidikan');
		$this->db->truncate('pegawai_riwayatpelatihanteknis');
		$this->db->truncate('pegawai_riwayatpelatihanjabatan');
		$this->db->truncate('pegawai_riwayatkompetensi');
		$this->db->truncate('pegawai_riwayatkinerja');
		$this->db->truncate('pegawai_riwayatkepangkatan');
		$this->db->truncate('pegawai_riwayatkeluarga');
		$this->db->truncate('pegawai_riwayatjabatan');
		$this->db->truncate('pegawai_diklat_teknis');
		$this->db->truncate('pegawai_diklat_jabatan');
		$this->db->truncate('pegawai_pendidikan');
		$this->db->truncate('pegawai_mutasi');
		$this->db->truncate('pegawai_kepegawaian');
		$this->db->truncate('pegawai_kepangkatan');
		$this->db->truncate('pegawai_jabatan');
		$this->db->truncate('pegawai_dokumen');
		$this->db->truncate('pegawai_cetak_usulan_temp');
		$this->db->truncate('pegawai_cetak_usulan');
		$this->db->truncate('pegawai_anak');
		$this->db->truncate('pegawai');
		$this->db->truncate('user');
		
		$config['upload_path'] = $file;
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '10000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			echo $error['error'];
		}	
		else
		{
			$upload_data = $this->upload->data();
			
			echo "<h3>Your file was successfully uploaded!</h3>" ;
			/*
			echo "<ul>" ;
			foreach($upload_data as $item => $value) {
				echo '<li>',$item,' : ',$value,'</li>';
			}
			echo "</ul>" ;
			*/
			echo "<p>== Data read file excel ==================================== //</p>" ;

			// Load the spreadsheet reader library
			$this->load->library('excel_reader');

			// Set output Encoding.
			$this->excel_reader->setOutputEncoding('CP1251');

			$file =  $file.$upload_data['file_name'] ;

			$this->excel_reader->read($file);

			error_reporting(0);

			// Sheet 1
			$data = $this->excel_reader->sheets[0] ;
				//echo '<pre>';
				//print_r($data['cells']);die();
				
			$no=1;
			for ($i = 2; $i <= $data['numRows']; $i++) {
				$nip_baru = $data['cells'][$i][3];
				//Cek Pegwai
				$this->db->where('nip_baru', $nip_baru);
				$query = $this->db->get('pegawai');
				if ($query->num_rows() > 0) {
					echo $no.' -- '.$status.' -- '.$nip_baru.' -- Sudah ada di database';
				}else{
				
					$lahir_th = substr($nip_baru, 0, 4);
					$lahir_bl = substr($nip_baru, 4, 2);
					$lahir_tgl = substr($nip_baru, 6, 2);
					$tgl_lahir = $lahir_th.'-'.$lahir_bl.'-'.$lahir_tgl;
					
					
					$data_pegawai = array(
						'nip_lama' => $data['cells'][$i][2],
						'nip_baru' => trim($nip_baru), 
						'no_kartu' => strtoupper($data['cells'][$i][4]),
						'nama' => strtoupper($data['cells'][$i][5]),
						'gelar_depan' => $data['cells'][$i][6] ? $data['cells'][$i][6] : '',
						'gelar_belakang' => $data['cells'][$i][7] ? $data['cells'][$i][7] : '',
						'jenis_kelamin' => $data['cells'][$i][8],
						'tempat_lahir' => strtoupper($data['cells'][$i][9]),
						'tanggal_lahir' => $tgl_lahir,
						'agama' => $data['cells'][$i][10] ? $data['cells'][$i][10] : '',
						'status_perkawinan' => $data['cells'][$i][11],
						'alamat' => $data['cells'][$i][12] ? strtoupper($data['cells'][$i][12]) : '',
						'rt' => $data['cells'][$i][13] ? $data['cells'][$i][13] : '',
						'rw' => $data['cells'][$i][14] ? $data['cells'][$i][14] : '',
						'kelurahan' => $data['cells'][$i][15] ? strtoupper($data['cells'][$i][15]) : '',
						'kecamatan' => $data['cells'][$i][16] ? $data['cells'][$i][16] : '',
						'kabupaten' => $data['cells'][$i][17] ? $data['cells'][$i][17] : '',
						'propinsi' => $data['cells'][$i][18] ? $data['cells'][$i][18] : '',
						'kodepos' => $data['cells'][$i][19] ? $data['cells'][$i][19] : '',
						'telp' => $data['cells'][$i][20] ? $data['cells'][$i][20] : '',
						//'status_kpe' => $status_kpe,
						//'foto' => $foto,
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => 'admin',
						'updated_date' => date('Y-m-d H:i:s'),
						'updated_by' => 'admin'

					);
						
					$do_insert = $this->mPegawai->insert_pegawai($nip_baru, $data_pegawai);
						
					if($do_insert){
						$id_pegawai = $do_insert;
						
						$data_pegawai_sub = array(
							'id' => $id_pegawai,
							'nama' => strtoupper($data['cells'][$i][5]),
							'nip_lama' => $data['cells'][$i][2],
							'nip_baru' => trim($nip_baru)
						);
						$this->mPegawai->cek_kepegawaian($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_jabatan($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_kepangkatan($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_pendidikan($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_tempatkerja($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_suami_istri($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_anak($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_diklat_jabatan($id_pegawai, $data_pegawai_sub);
						$this->mPegawai->cek_diklat_teknis($id_pegawai, $data_pegawai_sub);
						
						$privilege = $data['cells'][$i][21];
						if(empty($privilege)){
							$privilege = 'User';
						}
						$this->load->model('user_model');
						//Insert User
						$data_user = array(
							'username' => trim($data['cells'][$i][3]),
							'nip' => trim($data['cells'][$i][3]),
							'nama' => $data['cells'][$i][5],
							'passwordmd5' => md5(trim($data['cells'][$i][3])),
							'privilege' => $privilege,
							'status_user' => 'aktif',
						);
						$this->user_model->insert_data($data_user);
						
						$status = 'success';
						echo $no.' -- '.$status.' -- '.$nip_baru.' -- '. strtoupper($data['cells'][$i][5]);
					}
				}
				echo "<br />";
				$no++;
			}			
			
		}
	}
	
}















