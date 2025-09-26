<html>
<head>
<style>
	.print_laporan{
		font-family: Tahoma, Arial;
		font-size: 12px;
	}
		
	.print_laporan .title_laporan{
		font-size: 13px;
		font-weight: bold;
		line-height: 16px;
	}
	
	.print_laporan .text_a {
		font-size: 8pt; 
		color: #000000;
		font-size: 10pt;
		color: #000000;
	}
	.print_laporan table.print_body {
		border-collapse:collapse;
		font-size: 12px;
		margin:10px; 
		width:98%;
	}
	.print_laporan table.print_body td {
		padding:0px 10px;
		border:1px solid #000000;
		vertical-align: top;		
		line-height: 20px;
	}
	
	.print_laporan table.sign td{
		vertical-align: top;
		padding:0px 10px;
		line-height:16px;
		font-size:12px;
	}
	
	.print_laporan table.print_body td.no_border {
		border: 0px solid #fff;
	}
	.print_laporan table.print_body td.no_border_top {
		border-top: 0px solid #000000;
	}
	.print_laporan table.print_body td.no_border_bottom {
		border-bottom: 0px solid #000000;
	}
	.print_laporan table.print_body td.no_border_left {
		border-left: 0px solid #000000;
	}
	.print_laporan table.print_body td.no_border_right {
		border-right: 0px solid #000000;
	}
	.print_laporan table.print_body td.font-18 {
		font-size: 18px;
	}
	.print_laporan table.print_body td.font-16 {
		font-size: 16px;
	}
	.print_laporan table.print_body td.font-14 {
		font-size: 13px;
	}
	.print_laporan table.print_body td.font-12 {
		font-size: 12px;
	}
	.print_laporan table.print_body td.font-10 {
		font-size: 10px;
	}
	.print_laporan table.print_body td.bold {
		font-weight: bold;
	}
	.print_laporan table.print_body td.center {
		text-align: center;
	}
	.print_laporan table.print_body td.xunderline {
		text-decoration: underline;
	}

</style>
</head>
<body>
<?php
	//get masakerja
		$masa_kerja_data = dateDifference($data_ak->tmt_pangkat, date('Y-m-d'));
		$masa_kerja_lama_tahun = $masa_kerja_data[0];
		$masa_kerja_lama_bulan = $masa_kerja_data[1];
		
	?>
<div class="print_laporan">	
	<div style="text-align:center; font-size:13px; line-height:16px;">
		KEPUTUSAN MENTERI KESEHATAN REPUBLIK INDONESIA<br/>
		NOMOR : <?php echo $data_ak->no_pak;?><br/>
		TENTANG<br/>
		PENETAPAN ANGKA KREDIT JABATAN FUNGSIONAL DOKTER<br/>
		MASA PENILAIAN : <?php echo toInaPeriode($data_ak->periode_awal).' s/d '.toInaPeriode($data_ak->periode_akhir); ?>
	</div>
	
	<table class="print_body" cellpadding="4" border="1" style="margin:10px; width:98%;">
		<tr>
			<td class="font-14 center"><b> I </b></td>
			<td class="font-14 center"><b>N<br/>O</b></td>
			<td class="font-14 center" colspan="7" Style="vertical-align:middle;"><b> K E T E R A N G A N  &nbsp;   P E R O R A N G A N </b></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right" width="2%">1.</td>
			<td colspan="3" width="35%">N  a m a</td>
			<td colspan="4"><?php 
			
			$data_pegawai->nama = ucwords(strtolower($data_pegawai->nama));
			if(!empty($data_pegawai->gelar_depan)){
				$data_pegawai->nama = $data_pegawai->gelar_depan.' '.$data_pegawai->nama;
			}
			if(!empty($data_pegawai->gelar_belakang)){
				$data_pegawai->nama = $data_pegawai->nama.' '.$data_pegawai->gelar_belakang;
			}
			
			echo $data_pegawai->nama;?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">2.</td>
			<td colspan="3">N I P / Karpeg</td>
			<td colspan="4"><?php echo $data_pegawai->nip_baru.' / '.$data_pegawai->no_kartu;?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">3.</td>
			<td colspan="3">Tempat dan Tgl. Lahir</td>
			<td colspan="3"><?php echo ucwords(strtolower($data_pegawai->tempat_lahir)).', '.toInaDate($data_pegawai->tanggal_lahir);?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">4.</td>
			<td colspan="3">Jenis Kelamin</td>
			<td colspan="3"><?php echo $data_pegawai->jenis_kelamin;?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">5.</td>
			<td colspan="3">Pendidikan yang telah diperhitungkan Angka kreditnya</td>
			<td colspan="3"><?php echo $data_ak->pendidikan;?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">6.</td>
			<td colspan="3">Pangkat / Gol.Ruang / TMT</td>
			<td colspan="3"><?php echo $data_ak->pangkat.' '.$data_ak->golongan.' '.date('d-m-Y',strtotime($data_ak->tmt_pangkat));?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">7.</td>
			<td colspan="3">Jabatan Dokter</td>
			<td colspan="3"><?php echo $data_ak->nama_jabatan;?></td>
		</tr>
		<tr>
			<td rowspan="2" class="no_border_top no_border_bottom">&nbsp;</td>
			<td rowspan="2">8.</td>
			<td colspan="3">Masa Kerja Lama</td>
			<td colspan="3">
				<?php if(!empty($data_ak->masa_kerja_lama_tahun)){ echo $data_ak->masa_kerja_lama_tahun.' Tahun &nbsp;'; } ?>
				<?php if(!empty($data_ak->masa_kerja_lama_bulan)){ echo $data_ak->masa_kerja_lama_bulan.' Bulan '; } ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">Masa Kerja Baru</td>
			<td colspan="3">			
				<?php if(!empty($data_ak->masa_kerja_baru_tahun)){ echo $data_ak->masa_kerja_baru_tahun.' Tahun &nbsp;'; } ?>
				<?php if(!empty($data_ak->masa_kerja_baru_bulan)){ echo $data_ak->masa_kerja_baru_bulan.' Bulan '; } ?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">9.</td>
			<td colspan="3">Unit Kerja</td>
			<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);?></td>
		</tr>
	
	<tr>
		<td width="2%"><b>II</b></td>
		<td colspan="4"><b>PENETAPAN ANGKA KREDIT</b></td>
		<td align="center" width="15%"><b>LAMA</b></td>
		<td align="center" width="15%"><b>BARU</b></td>
		<td align="center" width="15%"><b>JUMLAH</b></td>
	</tr>
	<?php
	$no_show = 1;
	if(!empty($data_step4['dt_angkakredit_lama']['no_pak'])){
		$no_pak = '-';
		if(!empty($data_step4['dt_angkakredit_lama']['no_pak'])){
			$no_pak = 'PAK '.$data_step4['dt_angkakredit_lama']['no_pak'];
			
			$no_pak .= ', '.date('d F Y', strtotime($data_step4['dt_angkakredit_lama']['tanggal_pak'])); 
		}
		
		$nilai_penetapan_lama = $data_step4['dt_angkakredit_lama']['nilai_penetapan'];
		$nilai_penetapan_lama = number_format($nilai_penetapan_lama,2,".",",");
		?>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td width="2%"><b><?php echo $no_show; ?></b></td>
			<td colspan="3"><?php echo $no_pak; ?></td>
			<td align="center"><?php echo $nilai_penetapan_lama; ?></td>
			<td align="center">&nbsp;</td>
			<td align="center"><?php echo $nilai_penetapan_lama; ?></td>
		</tr>	
		
		<?php
		$no_show ++;
	}
	
	$all_total_ak_lama = 0;
	$all_total_ak_baru = 0;
	$all_total_jumlah = 0;
	$i = 0;	
	$this->db->select('DISTINCT (kategori_uk)', false)
			->from('m_unsur_kegiatan');								
	$query1 = $this->db->get();
	if ($query1->num_rows() > 0) {
			
		$no_A = 1;	
		foreach($query1->result() as $row){
			?>
			<tr>
				<td class="no_border_top no_border_bottom">&nbsp;</td>
				<td width="2%"><?php echo $no_show; ?></td>
				<td colspan="3"><?php echo $row->kategori_uk; ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>									
			<?php
			
			$this->db->select('*')
				->from('m_unsur_kegiatan')
				->where('kategori_uk', $row->kategori_uk);								
			$query2 = $this->db->get();
			if ($query2->num_rows() > 0) {
				$bb = 'A';
				$no_B = 1;
				foreach($query2->result() as $row2){
					
					$total_ak_baru = 0;	
					$total_ak_baru_text = '';
					if(!empty($data_step4['total_ak_baru'][$no_A])){
						if(!empty($data_step4['total_ak_baru'][$no_A][$row2->id_uk])){
							$total_ak_baru = $data_step4['total_ak_baru'][$no_A][$row2->id_uk];													
						}
						$total_ak_baru_text = number_format($total_ak_baru,2,".",",");
						$all_total_ak_baru += $total_ak_baru;
					}
					
					$total_ak_lama = 0;	
					$total_ak_lama_text = '';
					if(!empty($data_step4['total_ak_lama'][$no_A])){
						if(!empty($data_step4['total_ak_lama'][$no_A][$row2->id_uk])){
							$total_ak_lama = $data_step4['total_ak_lama'][$no_A][$row2->id_uk];													
						}
						$total_ak_lama_text = number_format($total_ak_lama,2,".",",");
						$all_total_ak_lama += $total_ak_lama;
					}
					
					$jumlah = 0;	
					$jumlah_text = '';
					if(!empty($data_step4['jumlah'][$no_A])){
						if(!empty($data_step4['jumlah'][$no_A][$row2->id_uk])){
							$jumlah = $data_step4['jumlah'][$no_A][$row2->id_uk];													
						}
						$jumlah_text = number_format($jumlah,2,".",",");
						$all_total_jumlah += $jumlah;
					}
					?>
					<tr>
						<td class="no_border_top no_border_bottom">&nbsp;</td>
						<td class="no_border_right" width="2%">&nbsp;</td>
						<td width="2%"><?php echo $bb; ?></td>
						<td colspan="2"><?php echo ucwords(strtolower($row2->nama_uk)); ?></td>
						<td align="center"><?php echo $total_ak_lama_text; ?></td>
						<td align="center"><?php echo $total_ak_baru_text; ?></td>
						<td align="center"><?php echo $jumlah_text; ?></td>
					</tr>									
					<?php
					
					$bb++;
					$no_B++;
				}
			}
			
			$no_show ++;
			$no_A++;
		}
	}
	
	
	
	$all_total_ak_lama = number_format($all_total_ak_lama,2,".",",");
	$all_total_ak_baru = number_format($all_total_ak_baru,2,".",",");
	$all_total_jumlah = number_format($all_total_jumlah,2,".",",");
	?>
	
	<tr>
		<td class="no_border_top no_border_bottom">&nbsp;</td>
		<td colspan="4">JUMLAH UNSUR UTAMA DAN UNSUR PENUNJANG</td>
		<td align="center"><?php echo $all_total_ak_lama; ?></td>
		<td align="center"><?php echo $all_total_ak_baru; ?></td>
		<td align="center"><b><?php echo $all_total_jumlah; ?></b></td>
	</tr>
	<tr>
		<td><b>III</b></td>
		<td colspan="7">
			<?php
			if(!empty($data_step4['hasil_penetapan'])){
				echo $data_step4['hasil_penetapan'];
			}									
			?>
		</td>
	</tr>	
	
	</table>
	<table class="sign" cellpadding="4" border="0" style="border:0px; margin:10px; width:98%; vertical-align: top;">
		
		<tr>
			<td colspan="2">&nbsp;</td>
			<td width="110">&nbsp; &nbsp; &nbsp; &nbsp;Ditetapkan di : </td>
			<td colspan="2" width="200" style="padding:0px;">Jakarta</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp;Pada Tanggal : </td>
			<td colspan="2" style="padding:0px;"><?php echo toInaDate($data_ak->tanggal_pak); ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td colspan="3">
			<?php
			if(!empty($data_ak->gelar_depan_pejabat_penetapan)){
				$data_ak->nama_pejabat_penetapan = $data_ak->gelar_depan_pejabat_penetapan.' '.$data_ak->nama_pejabat_penetapan;
			}
			if(!empty($data_ak->gelar_belakang_pejabat_penetapan)){
				$data_ak->nama_pejabat_penetapan = $data_ak->nama_pejabat_penetapan.' '.$data_ak->gelar_belakang_pejabat_penetapan;
			}
			?>
				a.n. MENTERI KESEHATAN R.I<br/>
				&nbsp; &nbsp; &nbsp; &nbsp;Direktur Jenderal Bina Upaya Kesehatan<br/>
				&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; u.b<br/>
				&nbsp; &nbsp; &nbsp; &nbsp;Sekretaris Direktorat Jenderal Bina Upaya Kesehatan<br/><br/><br/>			
				&nbsp; &nbsp; &nbsp; &nbsp;<b><?php echo $data_ak->nama_pejabat_penetapan; ?></b><br/>
				&nbsp; &nbsp; &nbsp; &nbsp;NIP. <?php echo $data_ak->pejabat_penetapan; ?>
			</td>
		</tr>
		<tr>
			<td>Asli disampaikan dengan hormat kepada :</td>
			<td colspan="4">&nbsp;</td>
		</tr>	
		<tr>
			<td>Dokter yang bersangkutan </td>
			<td colspan="4">&nbsp;</td>
		</tr>	
		<tr>
			<td>&nbsp; </td>
			<td colspan="4">&nbsp;</td>
		</tr>	
		<tr>
			<td>Tembusan disampaikan kepada : </td>
			<td colspan="4">&nbsp;</td>
		</tr>	
		
		<?php 
		if(!empty($data_ak->tembusan_penetapan)){
			?>
			<tr>
				<td><?php echo str_replace("\n","<br/>",$data_ak->tembusan_penetapan); ?></td>
				<td colspan="4">&nbsp;</td>
			</tr>			
			<?php
		}
		?>
	</table>
</div>
</body>
</html>