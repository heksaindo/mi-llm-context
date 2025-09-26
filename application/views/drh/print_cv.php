<html>
<head>
<style>
	.text_a {
		font-family: font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 8pt; color: #000000;
		font-size: 10pt;
		color: #000000;
	}
	*
	{
		font-family: Tahoma, Arial;
	}
	table
	{
		border-collapse:collapse;
		font-size: 9pt;
		border:1px solid #000000;
	}
	td
	{
		padding:2px 10px;
	}

	.barcode {
		border:5px solid white;
		background:white;
		width:330px;
		text-align:right;
		
	}
	.ns{
		border-left:2px solid white;
		height:40;
	}
	.nb{
		border-left:2px solid black;
		height:40;
	}
	.ws{
		border-left:5px solid white;
		height:40;
	}
	.wb{
		border-left:5px solid black;
		height:40;
	}
	.no_print{
		color: #D30404 !important;
	}
	@page {
                size: A4;
                margin:1cm;
    }
	@media print {
	   .no_print{
		   color: #000000 !important;
		   text-decoration: none;
	   }
	}
</style>
</head>
<body>

<table align="center" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tbody>
	<tr>
		<td style="font-size: 10pt;" colspan="5" align="right">            
			&nbsp;
		</td>
	</tr>
	<tr>
		<td style="font-size: 10pt;" colspan="5" align="center">
	  		<strong><?php echo HEADER_CV;?></strong><br><br>
		</td>
	</tr>
	<tr>
		<td colspan="5"><b>I. <u>IDENTITAS PRIBADI</u></b></td>
	</tr>
	<tr>
		<td width="18%">Nama</td>
		<td width="2%">:</td>
		<td width="60%"><?php echo @$pegawai->gelar_depan;?> <?php echo @$pegawai->nama;?>, <?php echo @$pegawai->gelar_belakang;?></td>
		<td rowspan="11" valign="top" width="20%">
			<?php
				if($pegawai->foto != ''){ $foto = $pegawai->foto; }else{ $foto = 'no-photo.jpg'; } 
			?>
			<img src="<?php echo APP_URL ;?>/Uploads/foto/<?php echo $foto;?>" alt="" height="140" width="120">
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>NIP/NRP Baru</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->nip_baru;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>NIP/NRP Lama</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->nip_lama;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>No. Kartu Pegawai</td>
		<td>:</td>
		<td colspan="2"><?php echo @$pegawai->no_kartu;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Tempat/Tanggal Lahir</td>
		<td>:</td>
		<td colspan="2"><?php echo @$pegawai->tempat_lahir;?>, <?php if($pegawai->tanggal_lahir) echo toInaDate($pegawai->tanggal_lahir);?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->jenis_kelamin;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>:</td>
		<td colspan="2"><?php if(array_key_exists('agama',$pegawai)) echo $this->utility->getParameter($pegawai->agama,'label');?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Status Perkawinan</td>
		<td>:</td>
		<td colspan="2"><?php if(array_key_exists('status_perkawinan',$pegawai)) echo $this->utility->getParameter($pegawai->status_perkawinan,'label');?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td rowspan="5" valign="baseline">Alamat</td>
		<td rowspan="5" valign="baseline">:</td>
		<td colspan="2"><?php echo @$pegawai->alamat;?> 
			<?php echo get_name('m_cities','city_name','city_id',$pegawai->kabupaten);?> 
			<?php echo get_name('m_provinces','prov_name','prov_id',$pegawai->propinsi);?> 
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">RT. <?php echo @$pegawai->rt;?> , RW. <?php echo @$pegawai->rw;?> </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">Kel./Desa  <?php echo @$pegawai->kelurahan;?> </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">Kec. <?php echo @$pegawai->kecamatan;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"> <?php echo @$pegawai->kodepos;?>  </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>No. Telp</td>
		<td>:</td>
		<td colspan="2"><?php echo @$pegawai->telp;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><b>II. <u>KEPEGAWAIAN</u></b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>TMT CPNS</td>
		<td>:</td>
		<td colspan="2"><?php if(array_key_exists('tmt_cpns',$pegawai) && $pegawai->tmt_cpns) echo toInaDate($pegawai->tmt_cpns);?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>TMT PNS</td>
		<td>:</td>
		<td colspan="2"><?php if(array_key_exists('tmt_cpns',$pegawai) && $pegawai->tmt_pns) echo toInaDate($pegawai->tmt_pns);?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Status Kepegawaian</td>
		<td>:</td>
		<td colspan="2"><?php echo @$pegawai->status_kepegawaian;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Jenis Kepegawaian</td>
		<td>:</td>
		<td colspan="2"><?php echo $this->utility->getTextField('m_jenis_kepegawaian','nama_jenis_kepegawaian','id_jenis_kepegawaian',@$pegawai->jenis_kepegawaian);?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Pendidikan Terakhir</td>
		<td>:</td>
		<td colspan="2"><?php
		$idp = $this->utility->getTextField('pegawai_riwayatpendidikan','strata','id',@$pegawai->pendidikan_diangkat);
		$studi = $this->utility->getTextField('pegawai_riwayatpendidikan','program_studi','id',@$pegawai->pendidikan_diangkat);
		echo $this->utility->getTextField('m_strata_pendidikan','nama_strata','id_strata',@$idp).' - '.@$studi;
		?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Jabatan Saat ini</td>
		<td>:</td>
		<td colspan="2"><?php echo get_name('m_jabatan','nama_jabatan','id_jabatan', $pegawai->id_nama_jabatan);?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>TMT Jabatan saat ini</td>
		<td>:</td>
		<td colspan="2"><?php echo @$pegawai->tmt_jabatan ? toInaDate(@$pegawai->tmt_jabatan) : '';?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Masa Kerja Golongan</td>
		<td>:</td>
		<td colspan="2">
		<?php $mkgt ='';$mkgb='';
			if($pegawai->masa_kerja_tahun) $mkgt = $pegawai->masa_kerja_tahun.' Thn';
			if($pegawai->masa_kerja_bulan) $mkgb = @$pegawai->masa_kerja_bulan.' Bln';
			echo $mkgt.' '.$mkgb;
		?>
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Eselon</td>
		<td>:</td>
		<td colspan="2"><?php echo @$pegawai->eselon;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>III. <u>TEMPAT KERJA SEKARANG</u></b></td>
	</tr>
	<tr>
		<td>Organisasi</td>
		<td>:</td>
		<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$pegawai->organisasi_kerja);?></td>
	</tr>
	<tr>
		<td>Satuan Kerja</td>
		<td>:</td>
		<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$pegawai->satuan_kerja);?></td>
	</tr>
	<tr>
		<td>Satuan Organisasi</td>
		<td>:</td>
		<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$pegawai->satuan_organisasi);?></td>
	</tr>
	<tr>
		<td>Unit Organisasi</td>
		<td>:</td>
		<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$pegawai->unit_organisasi);?></td>
	</tr>
	<tr>
		<td>Unit Kerja</td>
		<td>:</td>
		<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$pegawai->unit_kerja);?></td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	<?php $doc = array('pdf','jpg','png','jpeg','gif'); ?>
	  <td colspan="5"><b>IV. <u>RIWAYAT KEPANGKATAN</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table style="border-collapse:collapse; font-size: 9pt;" border="1" cellpadding="4" width="100%">
				<tbody><tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Pangkat</th>
					<th>Golongan</th>
					<th>TMT</th>
					<th>No &amp; Tgl SK</th>
					<th>Pejabat Penandatangan</th>
				</tr>
				<?php				
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatkepangkatan as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='1'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tgl_sk', 'ASC');
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
					?>
						<tr>
							<td align="center"><?php echo $no; ?></td>
							<td><?php echo $row->kepangkatan;?></td>
							<td align="center"><?php echo $row->golongan;?></td>
							<td><?php echo $row->tmt_kepangkatan ? toInaDate($row->tmt_kepangkatan) : '';?></td>
							<td>
								<?php if(!empty($row->id_dok)): ?> 
									<?php if(in_array($ext,$doc)):?>
										<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->no_sk;?></a>
									<?php else: ?>
										<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->no_sk;?></a>
									<?php endif; ?>
								<?php else: ?>
									<?php echo $row->no_sk;?>
								<?php endif; ?>
							<br><?php echo $row->tgl_sk ? toInaDate($row->tgl_sk) : '';?></td>
							<td><?php echo $row->pejabat_penandatangan;?></td>
						</tr>
					<?php
					$no++;
					}
				}
				?>				
			</tbody></table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>V. <u>RIWAYAT PENDIDIKAN</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table style="border-collapse:collapse; font-size: 9pt;" border="1" cellpadding="4" width="100%">
				<tbody><tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Pendidikan</th>
					<th>Nama Sekolah</th>
					<th>Tahun Ijazah</th>
				</tr>
				<?php				
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatpendidikan as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='2'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tahun_lulus', 'ASC');
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
						$strata = get_name('m_strata_pendidikan','nama_strata','id_strata', $row->strata);
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td><?php echo $row->program_studi ? $row->program_studi : $strata;?></td>
								<td>
								<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->nama_sekolah;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->nama_sekolah;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $row->nama_sekolah;?>
									<?php endif; ?>
								</td>
								<td align="center"><?php echo $row->tahun_lulus;?></td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				 
			</tbody></table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>VI. <u>RIWAYAT JABATAN</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table style="border-collapse:collapse; font-size: 9pt;" border="1" cellpadding="4" width="100%">
				<tbody><tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Jabatan/Eselon</th>
					<th>TMT</th>
					<th>No &amp; Tgl SK</th>
					<th>Satuan Kerja</th>
					<th>Unit Organisasi</th>
					<th>Keterangan</th>
				</tr>
				<?php
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatjabatan as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='3'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tmt_jabatan', 'ASC');
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
						$nama_jabatan = get_name('m_status_jabatan','nama_status_jabatan','id_status_jabatan', $row->id_jabatan);
						$m_jabatan = '';
						if($row->id_jabatan !=3){
							$m_jabatan = get_name('m_jabatan','nama_jabatan','id_jabatan', $row->id_nama_jabatan);
							$m_jabatan = $m_jabatan.' ('. $row->eselon.')';
						}
						$satuan_kerja = get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $row->satuan_kerja);
						$unit_org = get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $row->kode_unit_kerja);
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td>
								<?php if($nama_jabatan) echo $nama_jabatan;?>
								<?php echo '<p>'.$m_jabatan;?>
								</td>
								<td><?php echo $row->tmt_jabatan ? toInaDate($row->tmt_jabatan) : '';?></td>
								<td>
									<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->no_sk;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->no_sk;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $row->no_sk;?>
									<?php endif; ?>
								<br><?php echo $row->tgl_sk ? toInaDate($row->tgl_sk) : '';?></td>
								<td><?php echo $satuan_kerja;?></td>
								<td align="center"><?php echo $unit_org?></td>
								<td><?php echo $row->keterangan;?></td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				
			</tbody></table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>VII. <u>RIWAYAT PELATIHAN JABATAN</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table style="border-collapse:collapse; font-size: 9pt;" border="1" cellpadding="4" width="100%">
				<tbody><tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Nama Pelatihan</th>
					<th>Lembaga Pelaksana</th>
					<th>Tahun</th>
				</tr>
				<?php
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatpelatihanjabatan as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='4'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tahun_sertifikasi', 'ASC');	
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td><?php echo $row->nama_pelatihan;?></td>
								<td><?php echo $row->lembaga_pelaksana;?></td>
								<td align="center">
									<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->tahun_sertifikasi;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->tahun_sertifikasi;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $row->tahun_sertifikasi;?>
									<?php endif; ?>
								</td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				
			</tbody></table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>VIII. <u>RIWAYAT PELATIHAN TEKNIS</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table style="border-collapse:collapse; font-size: 9pt;" border="1" cellpadding="4" width="100%">
				<tbody><tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Nama Pelatihan</th>
					<th>Lembaga Pelaksana</th>
					<th>Negara Pelaksana</th>
					<th>Tahun</th>
				</tr>
				<?php
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatpelatihanteknis as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='5'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tahun_sertifikasi', 'ASC');	
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td><?php echo $row->nama_pelatihan;?></td>
								<td><?php echo $row->lembaga_pelaksana;?></td>
								<td><?php echo $row->negara_pelaksana;?></td>
								<td align="center">
									<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->tahun_sertifikasi;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->tahun_sertifikasi;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $row->tahun_sertifikasi;?>
									<?php endif;?>
								</td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				
			</tbody></table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>IX. <u>RIWAYAT PENGHARGAAN</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table style="border-collapse:collapse; font-size: 9pt;" border="1" cellpadding="4" width="100%">
				<tbody><tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Nama Penghargaan</th>
					<th>No &amp; Tgl SK</th>
					<th>Instansi Pemberi</th>
					<th>Tahun</th>
				</tr>
				<?php
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatpenghargaan as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='6'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tgl_sk', 'ASC');	
				$query = $this->db->get();
				
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
					?>
					
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td><?php echo $row->tanda_jasa;?></td>
								<td>
									<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->no_sk;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->no_sk;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $row->no_sk;?>
									<?php endif; ?>
								</td>
								<td><?php echo $row->instansi_pelaksana;?></td>
								<td align="center"><?php echo $row->tgl_sk;?></td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				
			</tbody></table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>X. <u>RIWAYAT KELUARGA</u></b></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->nama_suami_istri;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Tanggal Lahir</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->tgl_lahir ? toInaDate($pegawai->tgl_lahir) : '';?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Tanggal Kawin</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->tgl_nikah ? toInaDate($pegawai->tgl_nikah) : '';?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->pekerjaan;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>No. Seri Karis</td>
		<td>:</td>
		<td colspan="2"><?php echo $pegawai->no_karis;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table style="border-collapse:collapse; font-size: 9pt;" border="1" cellpadding="4" width="100%">
				<tbody><tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Nama</th>
					<th>Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Status</th>
				</tr>
				<?php
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatkeluarga as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='8'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tanggal_lahir', 'ASC');	
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td>
									<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->nama_anak;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->nama_anak;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $row->nama_anak;?>
									<?php endif; ?>
								</td>
								<td><?php echo $row->tanggal_lahir ? toInaDate($row->tanggal_lahir) : '';?></td>
								<td><?php echo $row->jenis_kelamin;?></td>
								<td><?php echo $row->status;?></td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				
			</tbody></table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>XI. <u>RIWAYAT KINERJA</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table width="100%" border="1" style="border-collapse:collapse; font-size: 9pt;" cellpadding="4">
				<tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Jabatan</th>
					<th>Capaian SKP</th>
					<th>Pejabat Penilai</th>
					<th>Tahun</th>
				</tr>
				<?php
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatkinerja as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='9'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$this->db->order_by('a.tahun', 'ASC');	
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
						$nama_jabatan = get_name('m_jabatan','nama_jabatan','id_jabatan', $row->id_jabatan);
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td><?php echo $nama_jabatan;?></td>
								<td><?php echo $row->capaian_skp;?></td>
								<td><?php echo $row->pejabat_penilai;?></td>
								<td>
									<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $row->tahun;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $row->tahun;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $row->tahun;?>
									<?php endif; ?>
								</td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				
			</table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	  <td colspan="5"><b>XII. <u>RIWAYAT KOMPETENSI</u></b></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table width="100%" border="1" style="border-collapse:collapse; font-size: 9pt;" cellpadding="4">
				<tr style="background-color:#cccccc">
					<th>No.</th>
					<th>Jabatan</th>
					<th>Kompetensi</th>
				</tr>
				<?php
				$this->db->select("a.*,b.id as id_dok,b.filename");
				$this->db->from('pegawai_riwayatkompetensi as a');
				$this->db->join("pegawai_dokumen as b","a.id=b.jenis_id AND b.jenis_dokumen='10'","left");
				$this->db->where('a.pegawai_id', $pegawai->id);	
				$query = $this->db->get();
				$query->result_array();
				if ($query->num_rows() > 0)
				{
					$no = 1;
					foreach($query->result() as $row){
						$ext = pathinfo($row->filename, PATHINFO_EXTENSION);
						$nama_jabatan = get_name('m_jabatan','nama_jabatan','id_jabatan', $row->id_jabatan);
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td>
									<?php if(!empty($row->id_dok)): ?> 
										<?php if(in_array($ext,$doc)):?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'viewer/'.$row->id_dok;?>"><?php echo $nama_jabatan;?></a>
										<?php else: ?>
											<a class="no_print" target="_blank" href="<?php echo base_url().'Uploads/dokumen/'.$row->filename;?>"><?php echo $nama_jabatan;?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php echo $nama_jabatan;?>
									<?php endif; ?>
								</td>
								<td><?php echo $row->kompetensi;?></td>
							</tr>
						<?php
						$no++;
					}
				}
				?>
				
			</table>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
</tbody>
</table>
<br>
</body>
</html>