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
		line-height: 22px;
	}
	
	.print_laporan table.sign td{
		vertical-align: top;
		padding:0px 10px;
		line-height:22px;
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
<div class="print_laporan">	
	<div style="font-size:14px; font-weight:bold;">SEKRETARIAT TIM PENILAI  PUSAT<br/>
		JABATAN FUNGSIONAL DOKTER <br/>
		DIREKTORAT JENDERAL BINA UPAYA KESEHATAN
	</div>
	
	<table class="print_body" cellpadding="4" border="0">
		<tr>
			<td class="font-16 center no_border xunderline" colspan="9">PERTIMBANGAN TIM PENILAI INSTANSI</td>
		</tr>
		<tr>
			<td class="font-14 center no_border" colspan="9" style="line-height:16px; padding-top:0px;vertical-align:top;height:24px;">Masa Penilaian   :  <?php echo toInaPeriode($data_ak->periode_awal);?> s/d <?php echo toInaPeriode($data_ak->periode_akhir);?></td>
		</tr>
		<tr>
			<td class="font-14 center"> I </td>
			<td class="font-14 center" colspan="8"> K E T E R A N G A N  &nbsp;   P E R O R A N G A N </td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right" width="2%">1.</td>
			<td class="no_border_left" colspan="3" width="35%">N  A  M  A</td>
			<td colspan="4">
			<?php 
			
			$data_pegawai->nama = ucwords(strtolower($data_pegawai->nama));
			if(!empty($data_pegawai->gelar_depan)){
				$data_pegawai->nama = $data_pegawai->gelar_depan.' '.$data_pegawai->nama;
			}
			if(!empty($data_pegawai->gelar_belakang)){
				$data_pegawai->nama = $data_pegawai->nama.' '.$data_pegawai->gelar_belakang;
			}
			
			echo $data_pegawai->nama;?>
			</td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">2.</td>
			<td class="no_border_left" colspan="3">N I P / No.Seri Karpeg</td>
			<td colspan="4"><?php echo $data_pegawai->nip_baru.' / '.$data_pegawai->no_kartu;?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">3.</td>
			<td class="no_border_left" colspan="3">Tempat/Tanggal Lahir</td>
			<td colspan="4"><?php echo ucwords(strtolower($data_pegawai->tempat_lahir)).', '.toInaDate($data_pegawai->tanggal_lahir);?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">4.</td>
			<td class="no_border_left" colspan="3">Pangkat / Gol. Ruang ( TMT )</td>
			<td colspan="4"><?php echo $data_ak->pangkat.' '.$data_ak->golongan.' '.date('d-m-Y',strtotime($data_ak->tmt_pangkat));?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">5.</td>
			<td class="no_border_left" colspan="3">Jenis Kelamin</td>
			<td colspan="4"><?php echo $data_pegawai->jenis_kelamin;?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">6.</td>
			<td class="no_border_left" colspan="3">Pendidikan</td>
			<td colspan="4"><?php echo $data_ak->pendidikan;?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">7.</td>
			<td class="no_border_left" colspan="3">Jabatan Fungsional / TMT</td>
			<td colspan="4"><?php echo $data_ak->nama_jabatan.'  '.date('d-m-Y',strtotime($data_ak->tmt_jabatan));?></td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom">&nbsp;</td>
			<td class="no_border_right">8.</td>
			<td class="no_border_left" colspan="3">Unit kerja</td>
			<td colspan="4"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);?></td>
		</tr>
		<tr>
			<td class="font-14 center"> II </td>
			<td class="font-14 center" colspan="8"> P E N I L A I A N  &nbsp;  A N G K A  &nbsp;  K R E D I T </td>
		</tr>
		<tr>
			<td class="no_border_top no_border_bottom" rowspan="2" width="2%">&nbsp;</td>
			<td class="font-14" rowspan="2" colspan="4" align="left" width="37%">UNSUR  YANG  DINILAI</td>
			<td class="font-14 center" colspan="4" align="center" width="60%"> PERTIMBANGAN</td>
		</tr>
		<tr>
			<td class="font-14 center" align="center" width="15%">INSTANSI<br/>PENGUSUL</td>
			<td class="font-14 center" align="center" width="15%">SEKERTARIAT<br/>TIM</td>
			<td class="font-14 center" align="center" width="15%">TIM<br/>PENILAI</td>
			<td class="font-14 center" align="center" width="15%">KET</td>
		</tr>
		<?php
		$all_instansi_pengusul = 0;
		$all_sekretariat_tim = 0;
		
		$i = 0;	
		$this->db->select('DISTINCT (kategori_uk)', false)
				->from('m_unsur_kegiatan');								
		$query1 = $this->db->get();
		if ($query1->num_rows() > 0) {
			$aa = 'A';	
			$no_A = 1;	
			foreach($query1->result() as $row){
				?>
				<tr>
					<td class="no_border_top no_border_bottom">&nbsp;</td>
					<td class="no_border_top no_border_bottom"  width="2%"><?php echo $no_A; ?></td>
					<td class="no_border_left" colspan="3"><?php echo $row->kategori_uk; ?></td>
					<td>&nbsp;</td>
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
						
						$total_detail = 0;	
						$total_detail_text = '';
						if(!empty($data_step3['total_detail'][$no_A])){
							if(!empty($data_step3['total_detail'][$no_A][$row2->id_uk])){
								$total_detail = $data_step3['total_detail'][$no_A][$row2->id_uk];	
								$all_instansi_pengusul += $total_detail;
							}
							$total_detail_text = number_format($total_detail,2,".",",");
						}
						
						$total_pertimbangan = 0;	
						if(!empty($data_step3['total_pertimbangan'][$no_A])){
							if(!empty($data_step3['total_pertimbangan'][$no_A][$row2->id_uk])){
								$total_pertimbangan = $data_step3['total_pertimbangan'][$no_A][$row2->id_uk];
								$all_sekretariat_tim += $total_pertimbangan;
							}
						}
						
						$persetujuan = 'Setuju/Tidak';	
						if(!empty($data_step3['persetujuan'][$no_A])){
							if(!empty($data_step3['persetujuan'][$no_A][$row2->id_uk])){
								$persetujuan = $data_step3['persetujuan'][$no_A][$row2->id_uk];													
							}
						}
						
						$keterangan = '';	
						if(!empty($data_step3['keterangan'][$no_A])){
							if(!empty($data_step3['keterangan'][$no_A][$row2->id_uk])){
								$keterangan = $data_step3['keterangan'][$no_A][$row2->id_uk];													
							}
						}
						?>
						<tr>
							<td class="no_border_top no_border_bottom">&nbsp;</td>
							<td class="no_border_top no_border_bottom" width="2%">&nbsp;</td>
							<td class="no_border" width="2%" style="padding:0 0px 0px 5px;"><?php echo strtolower($bb); ?></td>
							<td class="no_border" colspan="2"><?php echo ucwords(strtolower($row2->nama_uk)); ?></td>
							<td align="center"><?php echo $total_detail_text; ?></td>
							<td align="center"><?php echo $total_pertimbangan; ?></td>
							<td align="center">
								<input type="hidden" class="kategori_uk" name="kategori_uk[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $row->kategori_uk;?>" />
								<input type="hidden" class="id_uk" name="id_uk[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $row2->id_uk;?>" />
								<?php  echo $persetujuan; ?>												
							</td>
							<td align="center"><?php echo $keterangan; ?></td>
						</tr>									
						<?php
						
						$bb++;
						$no_B++;
					}
				}
				
				$no_A++;
			}
		}
		
		$all_instansi_pengusul_text = number_format($all_instansi_pengusul,2,".",",");
		$all_sekretariat_tim_text = number_format($all_sekretariat_tim,2,".",",");
		$nilai_total = ($all_sekretariat_tim+$data_ak->nilai_pak_lama);
		
		$nilai_total_text = number_format($nilai_total,2,".",",");
		
		?>
		
		<tr>
			<td class="font-14 center"> III </td>
			<td class="font-14" colspan="4">JUMLAH KESELURUHAN</td>
			<td align="center"><?php echo $all_instansi_pengusul_text; ?></td>
			<td align="center"><?php echo $all_sekretariat_tim_text; ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>		
		
	</table>
	<table class="sign" cellpadding="4" border="0" style="border:0px; margin:10px; width:98%; vertical-align: top;">
		
		<tr>
			<td colspan="3"  width="50%">Keterangan:</td>
			<td width="10%">&nbsp;</td>
			<td colspan="2" width="40%">Jakarta, <?php echo toInaDate($data_ak->tanggal_pertimbangan); ?></td>
		</tr>
		<tr>
			<td width="5">1.</td>
			<td width="40%">SK PAK/SK JABFUNG LAMA</td>
			<td><?php echo $data_ak->nilai_pak_lama; ?></td>
			<td width="10%">&nbsp;</td>
			<td width="40%">TIM  PENILAI  PUSAT</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>AK MP (BARU)</td>
			<td><?php echo $all_sekretariat_tim_text; ?></td>
			<td>&nbsp;</td>
			<td><?php echo str_replace("\n","<br/>",$data_ak->pejabat_tim_penilai); ?></td>
		</tr>
		<tr>
			<td style="border-top:1px solid #000;">&nbsp;</td>
			<td style="border-top:1px solid #000;">Jumlah Unsur Utama dan Penunjang</td>
			<td style="border-top:1px solid #000;"><?php echo $nilai_total_text; ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Angka Kredit minimal untuk naik jenjang/pangkat</td>
			<td><?php echo $data_ak->nilai_ak; ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	
	
	</table>
</div>
</body>
</html>