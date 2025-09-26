<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	function data_total_cuti_tahun_ini($this_year) {
		$jumlah = 0;
		
		$this->db->select('libur_tahunan, libur_bersama')
				->from('m_cuti')
				->where('tahun', $this_year);
		$get_total_cuti = $this->db->get();
		
		if($get_total_cuti->num_rows() > 0){
			$data_cuti = $get_total_cuti->row();
			$jumlah = $data_cuti->libur_tahunan + $data_cuti->libur_bersama;
		}
		
		return $jumlah;
	}
	
	function data_sisa_cuti_tahun_sebelumnya($username, $this_year) {
		$jumlah = 0;
		$before_year = $this_year - 1;
		if($username !=909090909){
			$this->db->select('sisa')
					->from('sisa_cuti')
					->where('tahun', $before_year)
					->where('id_pegawai', $username);
			$get_total_cuti = $this->db->get();
			
			if($get_total_cuti->num_rows() > 0){
				$data_cuti = $get_total_cuti->row();
				$jumlah = $data_cuti->sisa;
			}
		}
		return $jumlah;
	}
	
	function data_cuti_dipakai($username) {
		$jumlah = 0;
		
		$this->db->select('SUM(jumlah) as jml', false)
				->from('cuti')
				->where('pegawai_id', $username);
		$get_cuti_dipakai = $this->db->get();
		
		if($get_cuti_dipakai->num_rows() > 0){
			$data_dipakai = $get_cuti_dipakai->row();
			$jumlah = $data_dipakai->jml;
		}
		
		return $jumlah;
	}
	
	
	
	function data_total_pns() {
		$jumlah = 0;
		
		$this->db->select('count(1) as jml')
				->from('pegawai as a')
				->join('pegawai_kepegawaian as b', 'b.id_pegawai=a.id')
				->where('status_kepegawaian', 'PNS');
		$get_total_pns = $this->db->get();
		if($get_total_pns->num_rows() > 0){
			$data_pns = $get_total_pns->row();
			$jumlah = $data_pns->jml;
		}
		
		return $jumlah;
	}
	
	function data_total_cpns() {
		$jumlah = 0;
		
		$this->db->select('count(1) as jml')
				->from('pegawai as a')
				->join('pegawai_kepegawaian as b', 'b.id_pegawai=a.id')
				->where('status_kepegawaian', 'CPNS');
		$get_total_cpns = $this->db->get();
		if($get_total_cpns->num_rows() > 0){
			$data_cpns = $get_total_cpns->row();
			$jumlah = $data_cpns->jml;
		}
		
		return $jumlah;
	}

	function data_pereselon() {
		
		//data m_eselon
		$data_pereselon = array();
		$this->db->from('m_eselon');
		$this->db->order_by('nama_eselon', 'ASC');
		$get_dt_eselon = $this->db->get();
		if($get_dt_eselon->num_rows() > 0){
			foreach($get_dt_eselon->result() as $dt){
				
				if(!empty($dt->nama_eselon) AND $dt->nama_eselon != '-'){
					
					$nama_eselon = strtoupper($dt->nama_eselon);
					
					if(empty($data_pereselon[$nama_eselon])){
						$data_pereselon[$nama_eselon] = array(
							'nama_eselon' => $dt->nama_eselon,
							'total' => 0,
							'issliced' => 0
						);
					}					
				}
			}
		}
		
		$max_total = 0;		
		$max_total_id = 0;		
		
		$this->db->select('eselon, SUM(1) as total');
		$this->db->from('pegawai_jabatan');
		$this->db->join('pegawai','pegawai.id = pegawai_jabatan.id_pegawai');
		$this->db->where('pegawai.status', 'aktif');
		$this->db->group_by('eselon');
		$this->db->order_by('total', 'DESC');
		$get_pegawai_jabatan = $this->db->get();
		if($get_pegawai_jabatan->num_rows() > 0){
			foreach($get_pegawai_jabatan->result() as $dt){
				
				if($dt->total > 0 AND !empty($dt->eselon)){
					
					if($max_total < $dt->total){
						$max_total = $dt->total;
						$max_total_id = $dt->eselon;
					}
					
					$nama_eselon = strtoupper($dt->eselon);
					
					if(!empty($data_pereselon[$nama_eselon])){
						$data_pereselon[$nama_eselon]['total'] += $dt->total;
					}
						
				}
			}
		}
		
		if(!empty($data_pereselon[$max_total_id])){
			$data_pereselon[$max_total_id]['issliced'] = 1;
		}
		
		return $data_pereselon;
		
	}
	
	function dashboard_pergolongan() {
		
		//data m_golongan
		$data_categories = array();
		$data_golongan = array();
		$this->db->from('m_golongan');
		$this->db->order_by('kode_golongan', 'ASC');
		$get_dt_golongan = $this->db->get();
		if($get_dt_golongan->num_rows() > 0){
			foreach($get_dt_golongan->result() as $dt){
				
				if(!empty($dt->kode_golongan) AND $dt->kode_golongan != '-'){				
					//parse $dt->kode_golongan
					$dt->kode_golongan = strtoupper($dt->kode_golongan);
					$parseGol = explode('/', $dt->kode_golongan);
					
					if(empty($data_golongan[$parseGol[0]])){
						$data_golongan[$parseGol[0]] = array();
					}
					
					if(empty($data_golongan[$parseGol[0]][$parseGol[1]])){
						$data_golongan[$parseGol[0]][$parseGol[1]] = array(
							'golongan' => $parseGol[0],
							'kategori' => $parseGol[1],
							'total' => 0
						);
					}
					
					if(!in_array($parseGol[1], $data_categories)){
						$data_categories[] = $parseGol[1];
					}					
				}
				
			}
		}
		
		//data pergolongan
		$data_pergolongan = array(
			'categories' 	=> $data_categories,
			'dataset'		=> $data_golongan
			
		);
		$this->db->select('golongan, SUM(1) as total');
		$this->db->from('pegawai_kepangkatan');
		$this->db->join('pegawai','pegawai.id = pegawai_kepangkatan.id_pegawai');
		$this->db->where('pegawai.status', 'aktif');
		$this->db->group_by('golongan');
		$this->db->order_by('golongan', 'ASC');
		$get_pegawai_kepangkatan = $this->db->get();
		if($get_pegawai_kepangkatan->num_rows() > 0){
			foreach($get_pegawai_kepangkatan->result() as $dt){
				
				if($dt->total > 0 AND !empty($dt->golongan)){
					
					//parse $dt->golongan
					$dt->golongan = strtoupper($dt->golongan);
					$parseGol = explode('/', $dt->golongan);
					
					if(!empty($dt->total)){
						if(!empty($data_pergolongan['dataset'][$parseGol[0]][$parseGol[1]])){
							$data_pergolongan['dataset'][$parseGol[0]][$parseGol[1]]['total'] += $dt->total;
						}
					}
					
				}
			}
		}
		
		return $data_pergolongan;
		
	}	
	
	function dashboard_perpendidikan() {
		
		//data m_strata_pendidikan
		$data_pendidikan = array();
		$this->db->from('m_strata_pendidikan');
		$this->db->order_by('nama_strata2', 'ASC');
		$get_dt_pendidikan = $this->db->get();
		if($get_dt_pendidikan->num_rows() > 0){
			foreach($get_dt_pendidikan->result() as $dt){
				
				if(!empty($dt->nama_strata2) AND $dt->nama_strata2 != '-'){
										
					if(empty($data_pendidikan[$dt->id_strata])){
						$data_pendidikan[$dt->id_strata] = array(
							'nama' => strtoupper($dt->nama_strata2),
							'total' => 0,
						);
					}					
				}
			}
		}
		
		$max_total = 0;		
		$max_total_id = 0;		
		
		$this->db->select('strata, SUM(1) as total');
		$this->db->from('pegawai_pendidikan');
		$this->db->join('pegawai','pegawai.id = pegawai_pendidikan.id_pegawai');
		$this->db->where('pegawai.status', 'aktif');
		$this->db->where('strata > 0');
		$this->db->group_by('strata');
		$this->db->order_by('total', 'DESC');
		$get_pegawai_pendidikan = $this->db->get();
		if($get_pegawai_pendidikan->num_rows() > 0){
			foreach($get_pegawai_pendidikan->result() as $dt){
				
				if($dt->total > 0 AND !empty($dt->strata)){
					
					//parse $dt->strata					
					if(!empty($dt->total)){
					
						if($max_total < $dt->total){
							$max_total = $dt->total;
							$max_total_id = $dt->strata;
						}
					
						if(!empty($data_pendidikan[$dt->strata])){
							$data_pendidikan[$dt->strata]['total'] += $dt->total;
						}
					}
					
				}
			}
		}
		
		
		return $data_pendidikan;
		
	}
	
    //function dashboard_cuti_pegawai(){
    //  
    //  $selisih_hari = 86400;
    //  
    //  $data_cuti = array(
    //      '01' => array('nama' => 'Jan', 'total' => 0),
    //      '02' => array('nama' => 'Feb', 'total' => 0),
    //      '03' => array('nama' => 'Mar', 'total' => 0),
    //      '04' => array('nama' => 'Apr', 'total' => 0),
    //      '05' => array('nama' => 'May', 'total' => 0),
    //      '06' => array('nama' => 'Jun', 'total' => 0),
    //      '07' => array('nama' => 'Jul', 'total' => 0),
    //      '08' => array('nama' => 'Aug', 'total' => 0),
    //      '09' => array('nama' => 'Sep', 'total' => 0),
    //      '10' => array('nama' => 'Oct', 'total' => 0),
    //      '11' => array('nama' => 'Nov', 'total' => 0),
    //      '12' => array('nama' => 'Dec', 'total' => 0)
    //  );
    //  
    //  //mktime -> H,i,s,m,d,Y
    //  $bulan_mktime = array(
    //      '1' => mktime(0,0,0,1,1,date('Y')),
    //      '2' => mktime(0,0,0,2,1,date('Y')),
    //      '3' => mktime(0,0,0,3,1,date('Y')),
    //      '4' => mktime(0,0,0,4,1,date('Y')),
    //      '5' => mktime(0,0,0,5,1,date('Y')),
    //      '6' => mktime(0,0,0,6,1,date('Y')),
    //      '7' => mktime(0,0,0,7,1,date('Y')),
    //      '8' => mktime(0,0,0,8,1,date('Y')),
    //      '9' => mktime(0,0,0,9,1,date('Y')),
    //      '10' => mktime(0,0,0,10,1,date('Y')),
    //      '11' => mktime(0,0,0,11,1,date('Y')),
    //      '12' => mktime(0,0,0,12,1,date('Y')),
    //      '13' => mktime(0,0,0,1,1,(date('Y')+1))
    //  );
    //  
    //  $curr_from = date('Y').'-01-01';
    //  $curr_till = date('Y').'-12-31';
    //  
    //  $this->db->from('cuti');
    //  $this->db->where("(tanggal_mulai >= '".$curr_from."' AND tanggal_mulai <= '".$curr_till."') OR (tanggal_akhir >= '".$curr_from."' AND tanggal_akhir <= '".$curr_till."')");
    //  $this->db->where("status_cuti = 'approved'");
    //  $get_dt_cuti = $this->db->get();
    //  if($get_dt_cuti->num_rows() > 0){
    //      foreach($get_dt_cuti->result() as $dt){
    //          
    //          $tanggal_mulai_mk = strtotime($dt->tanggal_mulai);
    //          $tanggal_akhir_mk = strtotime($dt->tanggal_akhir)+$selisih_hari;
    //          
    //          $akhir = 0;
    //          for($mulai=0; $akhir < 1; $mulai++ ){
    //              $tanggal_cek = $tanggal_mulai_mk + ($mulai*$selisih_hari);
    //              if($tanggal_cek >= $tanggal_akhir_mk){
    //                  //echo date('d-m-Y', $tanggal_cek).' Nok '.$dt->id.' - ';
    //              
    //                  $akhir = 1;
    //              }else{
    //                  //echo date('d-m-Y', $tanggal_cek).' ok '.$dt->id.' - ';
    //              
    //                  if(date('Y') == date('Y', $tanggal_cek)){
    //                      if(!empty($data_cuti[date('m',$tanggal_cek)])){
    //                          $data_cuti[date('m',$tanggal_cek)]['total'] += 1;
    //                      }
    //                  }
    //              }
    //          }           
    //          
    //      }
    //  }
    //  
    //  return $data_cuti;
    //
    //}
	
	function dashboard_cuti_pegawai_detail(){
		
		$data_cuti = array(
			'01' => array('nama' => 'Jan', 'approve' => 0, 'submit' => 0),
			'02' => array('nama' => 'Feb', 'approve' => 0, 'submit' => 0),
			'03' => array('nama' => 'Mar', 'approve' => 0, 'submit' => 0),
			'04' => array('nama' => 'Apr', 'approve' => 0, 'submit' => 0),
			'05' => array('nama' => 'May', 'approve' => 0, 'submit' => 0),
			'06' => array('nama' => 'Jun', 'approve' => 0, 'submit' => 0),
			'07' => array('nama' => 'Jul', 'approve' => 0, 'submit' => 0),
			'08' => array('nama' => 'Aug', 'approve' => 0, 'submit' => 0),
			'09' => array('nama' => 'Sep', 'approve' => 0, 'submit' => 0),
			'10' => array('nama' => 'Oct', 'approve' => 0, 'submit' => 0),
			'11' => array('nama' => 'Nov', 'approve' => 0, 'submit' => 0),
			'12' => array('nama' => 'Dec', 'approve' => 0, 'submit' => 0)
		);
		
		
		$curr_from = date('Y').'-01-01';
		$curr_till = date('Y').'-12-31';
		
		$this->db->from('cuti')
			     ->where("(tgl_mulai >= '$curr_from' AND tgl_mulai <= '$curr_till') OR ( tgl_akhir >= '$curr_from' AND tgl_akhir <= '$curr_till')");
		$get_dt_cuti = $this->db->get();
		
		foreach($get_dt_cuti->result() as $dt){
			$bln = date("m", strtotime($dt->tgl_mulai));
			if($dt->status_cuti == 'approved'){
				$data_cuti[$bln]['approve']++;
			}elseif($dt->status_cuti == 'submit'){
				$data_cuti[$bln]['submit']++;
			}
			
				
		}
		
		return $data_cuti;
	
	}
	
	function dashboard_jumlah_peg_unit() {
		
		//pegawai_tempatkerja
		$all_kode = array();		
		$data_jumlah_peg_unit = array();
		
		$this->db->select('satuan_organisasi, SUM(1) as total');
		$this->db->from('pegawai_tempatkerja');
		$this->db->join('pegawai','pegawai.id = pegawai_tempatkerja.id_pegawai');
		$this->db->where('pegawai.status', 'aktif');
		$this->db->group_by('satuan_organisasi');
		$this->db->order_by('total', 'DESC');
		$get_pegawai_tempatkerja = $this->db->get();
		if($get_pegawai_tempatkerja->num_rows() > 0){
			foreach($get_pegawai_tempatkerja->result() as $dt){
				
				if($dt->total > 0 AND !empty($dt->satuan_organisasi)){
					
					//parse $dt->satuan_organisasi					
					if(!empty($dt->total) AND !empty($dt->satuan_organisasi)){	
						
						if(empty($data_jumlah_peg_unit[$dt->satuan_organisasi])){
						
							$all_kode[] = $dt->satuan_organisasi;
							
							$data_jumlah_peg_unit[$dt->satuan_organisasi] = array(
								'kode' => $dt->satuan_organisasi,
								'nama' => '',
								'total' => 0
							);
						}
						
						$data_jumlah_peg_unit[$dt->satuan_organisasi]['total'] += $dt->total;
					}
					
				}
			}
		}
			

		//data m_unit_kerja
		$data_jumlah_peg_unit_new = array();
		$this->db->from('m_unit_kerja');
		$this->db->where('level', 3);
		$this->db->order_by('kode_unit_kerja', 'ASC');
		$get_dt_unitkerja = $this->db->get();
		if($get_dt_unitkerja->num_rows() > 0){
			foreach($get_dt_unitkerja->result() as $dt){
				
				if(in_array($dt->kode_unit_kerja, $all_kode)){
					
					$nama_singkat = $dt->nama_unit_kerja;
					if(!empty($dt->nama_singkat)){
						$nama_singkat = $dt->nama_singkat;
					}
					
					if(!empty($data_jumlah_peg_unit[$dt->kode_unit_kerja])){
						$data_jumlah_peg_unit[$dt->kode_unit_kerja]['nama'] = $nama_singkat;
						$data_jumlah_peg_unit_new[$dt->kode_unit_kerja] = $data_jumlah_peg_unit[$dt->kode_unit_kerja];
					}	
					
				}
			}
		}			
		return $data_jumlah_peg_unit_new;
		
	}
	
	function dashboard_jumlah_peg_pensiun(){
		
		$selisih_hari = 86400;
		
		$data_pensiun = array(
			'01' => array('nama' => 'Jan', 'total' => 0),
			'02' => array('nama' => 'Feb', 'total' => 0),
			'03' => array('nama' => 'Mar', 'total' => 0),
			'04' => array('nama' => 'Apr', 'total' => 0),
			'05' => array('nama' => 'May', 'total' => 0),
			'06' => array('nama' => 'Jun', 'total' => 0),
			'07' => array('nama' => 'Jul', 'total' => 0),
			'08' => array('nama' => 'Aug', 'total' => 0),
			'09' => array('nama' => 'Sep', 'total' => 0),
			'10' => array('nama' => 'Oct', 'total' => 0),
			'11' => array('nama' => 'Nov', 'total' => 0),
			'12' => array('nama' => 'Dec', 'total' => 0)
		);
		
		//mktime -> H,i,s,m,d,Y
		$bulan_mktime = array(
			'1' => mktime(0,0,0,1,1,date('Y')),
			'2' => mktime(0,0,0,2,1,date('Y')),
			'3' => mktime(0,0,0,3,1,date('Y')),
			'4' => mktime(0,0,0,4,1,date('Y')),
			'5' => mktime(0,0,0,5,1,date('Y')),
			'6' => mktime(0,0,0,6,1,date('Y')),
			'7' => mktime(0,0,0,7,1,date('Y')),
			'8' => mktime(0,0,0,8,1,date('Y')),
			'9' => mktime(0,0,0,9,1,date('Y')),
			'10' => mktime(0,0,0,10,1,date('Y')),
			'11' => mktime(0,0,0,11,1,date('Y')),
			'12' => mktime(0,0,0,12,1,date('Y')),
			'13' => mktime(0,0,0,1,1,(date('Y')+1))
		);
		
		$curr_from = date('Y').'-01-01';
		$curr_till = date('Y').'-12-31';
		
		$this->db->from('pensiun');
		$this->db->where("status_pensiun", "SK Selesai");
		$this->db->where("(tanggal_berlaku >= '.$curr_from.' AND tanggal_berlaku <= '.$curr_till.')");
		$get_dt_cuti = $this->db->get();
		if($get_dt_cuti->num_rows() > 0){
			foreach($get_dt_cuti->result() as $dt){
				
				$tanggal_pensiun = strtotime($dt->tanggal_berlaku);
				if(date('Y') == date('Y', $tanggal_pensiun)){
					if(!empty($data_pensiun[date('m',$tanggal_pensiun)])){
						$data_pensiun[date('m',$tanggal_pensiun)]['total'] =+ 1;
					}
				}
				
			}
		}
		
		return $data_pensiun;
	
	}
	
	function dashboard_distribusi_pegawai(){
		//data m_provinces
		$data_distribusi_pegawai = array();
		$this->db->from('m_provinces');
		$this->db->order_by('prov_id', 'ASC');
		$get_dt_pendidikan = $this->db->get();
		if($get_dt_pendidikan->num_rows() > 0){
			foreach($get_dt_pendidikan->result() as $dt){
				
				if(!empty($dt->map_id)){
										
					if(empty($data_distribusi_pegawai[$dt->prov_id])){
						$data_distribusi_pegawai[$dt->prov_id] = array(
							'nama' => strtoupper($dt->prov_name),
							'map_id' => strtoupper($dt->map_id),
							'map_color' => strtoupper($dt->map_color),
							'total' => 0
						);
					}					
				}
			}
		}	
		
		$this->db->select('b.prov_id, SUM(1) as total');
		$this->db->from('m_unit_kerja as b');
		$this->db->join('pegawai_tempatkerja as a', 'b.id_unit_kerja=a.kode_unit_kerja', 'LEFT');
		//$this->db->where('status', 'aktif');
		$this->db->group_by('b.prov_id');
		//$this->db->order_by('total', 'DESC');
		$get_pegawai = $this->db->get();
		if($get_pegawai->num_rows() > 0){
			foreach($get_pegawai->result() as $dt){
				//echo $dt->prov_id;die();
				if($dt->total > 0 AND !empty($dt->prov_id)){
					
					//parse $dt->propinsi					
					if(!empty($dt->total)){
										
						if(!empty($data_distribusi_pegawai[$dt->prov_id])){
							$data_distribusi_pegawai[$dt->prov_id]['total'] += $dt->total;
						}
						
					}
					
				}
			}
		}
				
		return $data_distribusi_pegawai;
	}
	
}