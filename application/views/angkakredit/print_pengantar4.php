<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 12 (filtered)">
<title>DEPARTEMEN KESEHATAN RI</title>
<style>
	table.print td {
		font-family: "Arial","sans-serif";
		font-size: 11pt;
	}
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Arial Narrow";
	panose-1:2 11 6 6 2 2 2 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
@page WordSection1
	{size:8.5in 14.0in;
	margin:113.4pt 85.05pt 42.55pt 85.05pt;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>

</head>

<body lang=EN-US>

<div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:14.0pt;font-family:"Arial","sans-serif"'>KEMENTERIAN KESEHATAN RI</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:14.0pt;font-family:"Arial","sans-serif"'>DIREKTORAT JENDERAL BINA UPAYA KESEHATAN</span></b></p>

<p class=MsoNormal>

<table cellpadding=0  cellspacing=0 align=left>
 <tr>
  <td width=35 height=16></td>
 </tr>
 <tr>
  <td></td>
  <td><img width=590 height=2 src="<?php echo base_url();?>images/print/image001.gif"></td>
 </tr>
</table>

<span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<br clear=ALL>

<table cellpadding="2" style='font-size:11pt;font-family:"Arial","sans-serif"; font-weight:normal'>
	<tr>
		<td>Diterima di Direktorat Jenderal Bina Upaya Kesehatan</td>
		<td>:</td>
		<td></td>
	</tr>
	<tr>
		<td>Diselesaikan oleh</td>
		<td>:</td>
		<td>
			<?php 
				$data_ak->nama_pejabat_penyelenggara = ucwords(strtolower($data_ak->nama_pejabat_penyelenggara));
				if(!empty($data_ak->gelar_depan_pejabat_penyelenggara)){
					$data_ak->nama_pejabat_penyelenggara = $data_ak->gelar_depan_pejabat_penyelenggara.' '.$data_ak->nama_pejabat_penyelenggara;
				}
				if(!empty($data_ak->gelar_belakang_pejabat_penyelenggara)){
					$data_ak->nama_pejabat_penyelenggara = $data_ak->nama_pejabat_penyelenggara.' '.$data_ak->gelar_belakang_pejabat_penyelenggara;
				}
				echo $data_ak->nama_pejabat_penyelenggara; 
			?>
		</td>
	</tr>
	<tr>
		<td>Diperiksa oleh</td>
		<td>:</td>
		<td>
			<?php 
				$data_ak->nama_pejabat_mengetahui = ucwords(strtolower($data_ak->nama_pejabat_mengetahui));
				if(!empty($data_ak->gelar_depan_pejabat_mengetahui)){
					$data_ak->nama_pejabat_mengetahui = $data_ak->gelar_depan_pejabat_mengetahui.' '.$data_ak->nama_pejabat_mengetahui;
				}
				if(!empty($data_ak->gelar_belakang_pejabat_mengetahui)){
					$data_ak->nama_pejabat_mengetahui = $data_ak->nama_pejabat_mengetahui.' '.$data_ak->gelar_belakang_pejabat_mengetahui;
				}
				
				echo $data_ak->nama_pejabat_mengetahui; 
			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Nomor: <?php echo $data_ak->no_pak;?></td>
		<td></td>
		<td>Tanggal : <?php echo toInaDate($data_ak->tanggal_pak);?></td>
	</tr>
	<tr>
		<td>Terlebih Dahulu	:</td>
		<td></td>
		<td></td>
	</tr>
	
</table>
<br/>
<br/>
<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><b><span
style='font-family:"Arial","sans-serif"'>TIM PENILAI JABATAN FUNGSIONAL DOKTER  :</span></b></p>

<?php echo str_replace("\n","<br/>",$data_ak->pejabat_tim_penilai); ?>


<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><b><span
style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><b><span
style='font-family:"Arial","sans-serif"'>Lampiran :</span></b></p>

<table cellpadding="2" style='font-size:11pt;font-family:"Arial","sans-serif"; font-weight:normal'>
	<tr>
		<td>Perihal</td>
		<td>:</td>
		<td colspan="3">Penetapan Angka Kredit Jabatan Fungsional Dokter</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td>Nama</td>
		<td>:</td>
		<td><?php $data_pegawai->nama = ucwords(strtolower($data_pegawai->nama));
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
		<td>&nbsp;</td>
		<td></td>
		<td>NIP</td>
		<td>:</td>
		<td><?php echo $data_pegawai->nip_baru;?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td>Pangkat / Gol. Ruang</td>
		<td>:</td>
		<td><?php echo $data_ak->pangkat;?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td>Unit Kerja</td>
		<td>:</td>
		<td><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);;?></td>
	</tr>
	
</table>


</div>

</body>

</html>
