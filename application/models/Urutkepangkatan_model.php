<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Urutkepangkatan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	
	function get_all() {
		$query = $this->db->get('pegawai');

		return $query->result_array();
	}
	
	//function get_urutkepangkatan($offset, $limit, $search='') 
	function get_urutkepangkatan($search='') 
	{
		//print_r($search);
		$this->db->select('a.id, a.nip_lama, a.nip_baru, a.nama, a.tanggal_lahir, b.tgl_masuk_unit, d.golongan AS gol_terakhir, d.tmt_kepangkatan AS tmt_gol_terakhir, 
						k.nama_jabatan, b.tmt_jabatan, g.jurusan, g.tahun_lulus, h.nama_strata2 AS tingkat_ijazah, j.nama_pelatihan, j.tahun_sertifikat,
						c.masa_kerja_tahun, c.masa_kerja_bulan, b.eselon, c.tmt_cpns', false)
				->from('pegawai as a')
				->join('pegawai_jabatan as b','a.id = b.id_pegawai',false)
				->join('pegawai_kepegawaian as c','a.id = c.id_pegawai', false)
				->join('pegawai_kepangkatan as d','a.id = d.id_pegawai', false)	
				->join('pegawai_pendidikan as g','a.id = g.id_pegawai', 'LEFT', false)	
				->join('pegawai_diklat_jabatan as j','a.id = j.id_pegawai', 'LEFT', false)	
				->join('m_unit_kerja as f','b.kode_unit_kerja = f.kode_unit_kerja','LEFT', false)	
				->join('m_strata_pendidikan as h','g.strata = h.id_strata','LEFT', false)
				->join('m_eselon as i','i.nama_eselon = b.eselon','LEFT', false)
				->join('m_jabatan as k','k.id_jabatan = b.id_nama_jabatan','LEFT', false);	
		
		if(!empty($search)){
		
			if(!empty($search['src_unit_organisasi'])){
				$this->db->like('b.kode_unit_kerja', $search['src_unit_organisasi']);
			}
			if(!empty($search['src_satuan_organisasi'])){
				$this->db->like('b.kode_unit_kerja', $search['src_satuan_organisasi']);
			}
			if(!empty($search['src_satuan_kerja'])){
				$this->db->like('b.kode_unit_kerja', $search['src_satuan_kerja']);
			}
			if(!empty($search['src_organisasi_kerja'])){				
				$this->db->like('b.kode_unit_kerja', $search['src_organisasi_kerja']);
			}
			
			if(!empty($search['src_jabatan'])){			
			
				if(!empty($search['src_struktural'])){				
					$this->db->like('k.nama_jabatan', $search['src_struktural']);
				}
				if(!empty($search['src_fungsional'])){				
					
					if(!empty($search['src_fungsional_umum'])){				
						$this->db->like('k.nama_jabatan', $search['src_fungsional_umum']);
					}else{
						$this->db->like('k.nama_jabatan', $search['src_fungsional_tertentu']);
					}				
				}
			}
			
		}
				
		//pangkat(level gol), jabatan, masa kerja, latihan jabatan, pendidikan 
		$this->db->order_by('d.golongan DESC, i.level ASC, f.level ASC, b.tgl_masuk_unit ASC, h.level ASC', false); 
		//$this->db->limit($limit, $offset);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_total_urutkepangkatan() 
	{
		
		$this->db->select('COUNT(id) as total')
				->from('pegawai');
		
		$query = $this->db->get();
		$qs = $query->row();
		
		return $qs->total;
	}
	
	function get_duk($nip_baru='') 
	{
		
		$this->db->select('a.id, a.nip_lama, a.nip_baru, a.nama, a.tanggal_lahir, b.tgl_masuk_unit, d.golongan AS gol_terakhir, 
						d.tmt_kepangkatan AS tmt_gol_terakhir, k.nama_jabatan, f.nama_unit_kerja, b.tmt_jabatan, 
						g.jurusan, g.tahun_lulus, h.nama_strata2 AS tingkat_ijazah, j.nama_pelatihan, j.tahun_sertifikat,
						c.masa_kerja_tahun, c.masa_kerja_bulan, b.eselon, c.tmt_cpns', false)
				->from('pegawai as a')
				->join('pegawai_jabatan as b','a.id = b.id_pegawai',false)
				->join('pegawai_kepegawaian as c','a.id = c.id_pegawai', false)
				->join('pegawai_kepangkatan as d','a.id = d.id_pegawai', false)	
				->join('pegawai_pendidikan as g','a.id = g.id_pegawai', 'LEFT', false)	
				->join('pegawai_diklat_jabatan as j','a.id = j.id_pegawai', 'LEFT', false)	
				->join('m_unit_kerja as f','b.kode_unit_kerja = f.kode_unit_kerja','LEFT', false)	
				->join('m_strata_pendidikan as h','g.strata = h.id_strata','LEFT', false)
				->join('m_eselon as i','i.nama_eselon = b.eselon','LEFT', false)
				->join('m_jabatan as k','k.id_jabatan = b.id_jabatan','LEFT', false);	
		
		if(!empty($nip_baru)){				
			$this->db->like('a.nip_baru', $nip_baru);
		}
				
		//pangkat(level gol), jabatan, masa kerja, latihan jabatan, pendidikan 
		$this->db->order_by('d.golongan DESC, i.level ASC, f.level ASC, b.tgl_masuk_unit ASC, h.level ASC', false); 
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_masters($tipe, $id = '')
	{
		if(!empty($id)){
			$this->db->where('id', $id);
		}

		$this->db->where('tipe', $tipe);
		$this->db->where('status','1');
		$this->db->order_by('id','ASC');
		$query = $this->db->get('pegawai_masters');
		
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
	
	public function ddl_organisasi($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_unit_kerja', $id);
		}
		// id_unit_kerja, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('level','ASC');
		$this->db->where('parent_unit','0');
		$query = $this->db->get('m_unit_kerja');
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
	public function ddl_satuankerja($org_id)
	{
		// id_unit_kerja, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('level','ASC');
		$this->db->where('parent_unit', $org_id);
		$query = $this->db->get('m_unit_kerja');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	public function ddl_satuanorganisasi($satuankerja_id)
	{
		// id_unit_kerja, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('level','ASC');
		$this->db->where('parent_unit', $satuankerja_id);
		$query = $this->db->get('m_unit_kerja');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	public function ddl_unitorganisasi($satuanorg_id)
	{
		// id_unit_kerja, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('level','ASC');
		$this->db->where('parent_unit', $satuanorg_id);
		$query = $this->db->get('m_unit_kerja');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	
}