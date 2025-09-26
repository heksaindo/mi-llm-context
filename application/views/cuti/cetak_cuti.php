<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 14 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-link:"Balloon Text";
	font-family:"Tahoma","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
@page WordSection1
	{size:612.1pt 936.1pt;
	margin:49.65pt 30.9pt 56.7pt 28.35pt;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>
<script type="text/javascript">
        window.print();
    </script>
</head>

<body lang=EN-US>

<div class=WordSection1>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<br clear=ALL>

<?php
$cuti = $data_cuti[0];

if($cuti['tipe_cuti'] == '1'){
?>
		<p class=MsoNormal align=center style='text-align:center;line-height:150%'><b><u><span
		lang=IN style='font-family:"Arial","sans-serif";letter-spacing:1.0pt'>SURAT
		IZIN CUTI TAHUNAN</span></u></b></p>

		<p class=MsoNormal align=center style='text-align:center'><b><span lang=IN
		style='font-family:"Arial","sans-serif"'>Nomor : </span></b><b><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['nomor_surat'];?></span></b></p>

		<p class=MsoNormal style='text-align:justify'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:.25in'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Diberikan cuti Tahunan Tahun </span><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['tahun'];?></span><span lang=IN
		style='font-family:"Arial","sans-serif"'> kepada Pegawai Negeri Sipil :</span></p>

		<p class=MsoNormal style='margin-left:27.0pt;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span lang=FI style='font-family:"Arial","sans-serif"'>Nama                          :
		</span><span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['nama'];?>.</span></p>

		<p class=MsoNormal><span lang=FI style='font-family:"Arial","sans-serif"'>NIP                              :
		</span><span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['nip'];?></span></p>

		<p class=MsoNormal><span lang=SV style='font-family:"Arial","sans-serif"'>Pangkat
		/ Gol              : </span>
		<span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['pangkat'];?> / <?php echo $cuti['golongan'];?></span></p>

		<p class=MsoNormal><span lang=SV style='font-family:"Arial","sans-serif"'>Jabatan                       :
		</span><span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['jabatan'];?></span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>Satuan Kerja       </span><span style='font-family:"Arial","sans-serif"'>        </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>: </span><span lang=SV
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['unit_kerja'];?></span><span
		style='font-family:"Arial","sans-serif"'>   </span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>Selama</span><span style='font-family:"Arial","sans-serif"'>
		<?php echo $cuti['jumlah'];?></span><span lang=IN style='font-family:"Arial","sans-serif"'> <?php echo $cuti['satuan'];?>
		kerja, terhitung mulai tanggal  </span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['tanggal_mulai'];?> 
		s.d <?php echo $cuti['tanggal_akhir'];?> </span><span lang=IN style='font-family:"Arial","sans-serif"'>dengan
		ketentuan sebagai berikut :</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify;text-indent:
		-.25in'><span lang=IN style='font-family:"Arial","sans-serif"'>a.<span
		style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
		lang=IN style='font-family:"Arial","sans-serif"'>Sebelum menjalankan cuti
		Tahunan wajib menyerahkan pekerjaannya kepada atasan langsungnya;</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>                          </span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify;text-indent:
		-.25in'><span lang=IN style='font-family:"Arial","sans-serif"'>b.<span
		style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
		lang=IN style='font-family:"Arial","sans-serif"'>Setelah selesai menjalankan
		cuti Tahunan wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali
		sebagaimana biasa.</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:.25in'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Demikian surat izin cuti Tahunan ini
		dibuat untuk dapat dipergunakan sebagaimana mestinya.</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span
		style='font-family:"Arial","sans-serif"'>                                       </span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span
		style='font-family:"Arial","sans-serif"'>                           </span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span style='font-family:"Arial","sans-serif"'>                                       </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>Jakarta</span><span
		style='font-family:"Arial","sans-serif"'>, <?php echo $cuti['tanggal_mulai'];?></span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>                                          </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		style='font-family:"Arial","sans-serif"'>                                       <?php echo $cuti['jabatanpenandatangan'];?></span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>   </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><b><span
		style='font-family:"Arial","sans-serif"'>                                       <?php echo $cuti['nama_ttd'];?></span></b></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		style='font-family:"Arial","sans-serif"'>                                       </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>NIP </span><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['nip_ttd'];?></span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Penandatangan
		:</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Untuk Eselon
		IV dan III Sekretaris</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Untuk Eselon
		II DirekturJenderal</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Selain Eselon Kepala Bagian Kepegawaian dan Umum</span></p>

<?php 
}else
if($cuti['tipe_cuti'] == '4'){ //Bersalin
?>


		<p class=MsoNormal align=center style='text-align:center;line-height:150%'><b><u><span
		lang=IN style='font-family:"Arial","sans-serif";letter-spacing:1.0pt'>SURAT
		IZIN CUTI </span></u></b><b><u><span style='font-family:"Arial","sans-serif";
		letter-spacing:1.0pt'>BERSALIN</span></u></b></p>

		<p class=MsoNormal align=center style='text-align:center'><b><span lang=IN
		style='font-family:"Arial","sans-serif"'>Nomor : </span></b><b><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['nomor_surat'];?></span></b></p>

		<p class=MsoNormal><b><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

		<p class=MsoNormal style='text-align:justify'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:.25in'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Diberikan cuti bersalin kepada Pegawai
		Negeri Sipil :</span></p>

		<p class=MsoNormal style='margin-left:27.0pt;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span lang=FI style='font-family:"Arial","sans-serif"'>Nama                          :
		</span><span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['nama'];?></span></p>

		<p class=MsoNormal><span lang=FI style='font-family:"Arial","sans-serif"'>NIP                              :
		</span><span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['nip'];?></span></p>

		<p class=MsoNormal><span lang=SV style='font-family:"Arial","sans-serif"'>Pangkat
		/ Gol              : </span>
		<span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['pangkat'];?> / <?php echo $cuti['golongan'];?></span></p>

		<p class=MsoNormal><span lang=SV style='font-family:"Arial","sans-serif"'>Jabatan                       :
		<?php echo $cuti['jabatan'];?></span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>Satuan Kerja       </span><span style='font-family:"Arial","sans-serif"'>        </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>: </span><span lang=SV
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['unit_kerja'];?></span><span
		style='font-family:"Arial","sans-serif"'>   </span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>selama </span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['jumlah'];?></span><span
		lang=IN style='font-family:"Arial","sans-serif"'> <?php echo $cuti['satuan'];?>, terhitung mulai
		tanggal  </span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['tanggal_mulai'];?> s.d
		<?php echo $cuti['tanggal_akhir'];?>. </span><span lang=IN style='font-family:"Arial","sans-serif"'>dengan
		ketentuan sebagai berikut :</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify;text-indent:
		-.25in'><span lang=IN style='font-family:"Arial","sans-serif"'>a.<span
		style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
		lang=IN style='font-family:"Arial","sans-serif"'>Sebelum menjalankan cuti
		bersalin wajib menyerahkan pekerjaanya kepada atasan langsungnya;</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify;text-indent:
		-.25in'><span lang=IN style='font-family:"Arial","sans-serif"'>b.<span
		style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
		style='font-family:"Arial","sans-serif"'>Segera setelah melahirkan yang
		bersangkutan supaya memberitahukan tanggal persalinan kepada pejabat yang
		berwenang mengeluarkan cuti;</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify;text-indent:
		-.25in'><span lang=IN style='font-family:"Arial","sans-serif"'>c.<span
		style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span><span
		lang=IN style='font-family:"Arial","sans-serif"'>Setelah selesai menjalankan
		cuti bersalin wajib melaporkan diri kepada atasan langsungnya dan bekerja
		kembali sebagaimana biasa.</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:.25in'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Demikian surat izin cuti bersalin ini
		dibuat untuk dapat dipergunakan sebagaimana mestinya.</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span
		style='font-family:"Arial","sans-serif"'>                                       </span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span
		style='font-family:"Arial","sans-serif"'>                           </span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span style='font-family:"Arial","sans-serif"'>                                       </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>Jakarta</span><span
		style='font-family:"Arial","sans-serif"'>, <?php echo $cuti['tanggal_ttd'] ? toInaDate($cuti['tanggal_ttd']) : date('d M Y');?></span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>                                          </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		style='font-family:"Arial","sans-serif"'>                                       <?php echo $cuti['jabatanpenandatangan'];?></span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>   </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><b><span
		style='font-family:"Arial","sans-serif"'>                                       <?php echo $cuti['nama_ttd'];?></span></b></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		style='font-family:"Arial","sans-serif"'>                                       </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>NIP </span><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['nip_ttd'];?></span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Penandatangan
		:</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Untuk Eselon
		IV dan III Sekretaris</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Untuk Eselon
		II Direktur Jenderal</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Selain Eselon Kepala Bagian Kepegawaian dan Umum</span></p>


<?php 
}else
if($cuti['tipe_cuti'] == '3'){ //Cuti Sakit
?>


		<p class=MsoNormal align=center style='text-align:center;line-height:150%'><b><u><span
		lang=IN style='font-family:"Arial","sans-serif";letter-spacing:1.0pt'>SURAT
		IZIN CUTI </span></u></b><b><u><span style='font-family:"Arial","sans-serif";
		letter-spacing:1.0pt'>SAKIT</span></u></b></p>

		<p class=MsoNormal align=center style='text-align:center'><b><span lang=IN
		style='font-family:"Arial","sans-serif"'>Nomor : </span></b><b><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['nomor_surat'];?></span></b></p>

		<p class=MsoNormal><b><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

		<p class=MsoNormal style='text-align:justify'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:.25in'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Diberikan cuti </span><span
		style='font-family:"Arial","sans-serif"'>sakit</span><span lang=IN
		style='font-family:"Arial","sans-serif"'> kepada Pegawai Negeri Sipil :</span></p>

		<p class=MsoNormal style='margin-left:27.0pt;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span lang=FI style='font-family:"Arial","sans-serif"'>Nama                          :
		</span><span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['nama'];?></span></p>

		<p class=MsoNormal><span lang=FI style='font-family:"Arial","sans-serif"'>NIP                              :
		</span><span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['nip'];?></span></p>

		<p class=MsoNormal><span lang=SV style='font-family:"Arial","sans-serif"'>Pangkat
		/ Gol              : </span>
		<span lang=SV style='font-family:"Arial","sans-serif"'><?php echo $cuti['pangkat'];?> / <?php echo $cuti['golongan'];?></span></p>

		<p class=MsoNormal><span lang=SV style='font-family:"Arial","sans-serif"'>Jabatan                       :
		<?php echo $cuti['jabatan'];?></span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>Satuan Kerja       </span><span style='font-family:"Arial","sans-serif"'>        </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>: </span><span lang=SV
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['unit_kerja'];?></span><span
		style='font-family:"Arial","sans-serif"'>   </span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>selama </span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['jumlah'];?> <?php echo $cuti['satuan'];?></span><span
		lang=IN style='font-family:"Arial","sans-serif"'>, terhitung mulai tanggal </span><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['tanggal_mulai'];?> s.d <?php echo $cuti['tanggal_akhir'];?> </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>dengan ketentuan sebagai
		berikut </span><span style='font-family:"Arial","sans-serif"'>cuti sakit tersebut wajib</span><span
		lang=IN style='font-family:"Arial","sans-serif"'> melaporkan diri kepada atasan
		langsungnya dan bekerja kembali sebagaimana biasa.</span></p>

		<p class=MsoNormal style='margin-left:.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:.25in'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Demikian surat izin cuti </span><span
		style='font-family:"Arial","sans-serif"'>sakit</span><span lang=IN
		style='font-family:"Arial","sans-serif"'> ini dibuat untuk dapat dipergunakan
		sebagaimana mestinya.</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span
		style='font-family:"Arial","sans-serif"'>                           </span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span style='font-family:"Arial","sans-serif"'>                                       </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>Jakarta</span><span
		style='font-family:"Arial","sans-serif"'>, <?php echo toInaDate($cuti['tanggal_ttd']);?></span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify'><span lang=IN
		style='font-family:"Arial","sans-serif"'>                                          </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		style='font-family:"Arial","sans-serif"'>                                       <?php echo $cuti['jabatanpenandatangan'];?></span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>   </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><b><span
		style='font-family:"Arial","sans-serif"'>                                       <?php echo $cuti['nama_ttd'];?></span></b></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		style='font-family:"Arial","sans-serif"'>                                       </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>NIP </span><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['nip_ttd'];?></span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:
		9.0pt'><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Penandatangan
		:</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Untuk Eselon
		IV dan III Sekretaris</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Untuk Eselon
		II DirekturJenderal</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Selain Eselon Kepala Bagian Kepegawaian dan Umum</span></p>

		
<?php 
}else{
?>		


		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Nomor
		      :</span><span style='font-family:"Arial","sans-serif"'> <?php echo $cuti['nomor_surat'];?></span><span
		lang=IN style='font-family:"Arial","sans-serif"'>  </span><span
		style='font-family:"Arial","sans-serif"'>                        <span
		style='color:white'>                                                            </span>                        
		<?php echo toInaDate($cuti['tanggal_ttd']);?></span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Lampiran
		  : 1 (satu) berkas</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>Hal</span><span
		lang=IN style='font-family:"Arial","sans-serif"'>             : Permohonan Cuti
		</span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['jenis_cuti'];?></span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>                   
		a.n. </span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['nama'];?></span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Yang
		terhormat</span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Kepala
		Biro Kepegawaian Setjen Kemenkes RI </span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>di</span><span
		lang=IN style='font-family:"Arial","sans-serif"'> Jakarta</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify'><span lang=IN style='font-family:
		"Arial","sans-serif"'>Bersama ini kami sampaikan perihal 
		Permohonan </span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['jenis_cuti'];?> mulai</span><span lang=IN style='font-family:"Arial","sans-serif"'>
		dari </span><span style='font-family:"Arial","sans-serif"'>tanggal <?php echo $cuti['tanggal_mulai'];?>
		s.d <?php echo $cuti['tanggal_akhir'];?></span><span lang=IN style='font-family:"Arial","sans-serif"'> atas :</span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Nama              :
		</span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['nama'];?></span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>NIP                  :
		</span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['nip'];?></span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Pangkat/Gol    :
		</span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['pangkat'];?> / <?php echo $cuti['golongan'];?>.</span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Jabatan           :
		</span><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['jabatan'];?></span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>Unit
		Kerja  </span><span style='font-family:"Arial","sans-serif"'>       </span><span
		lang=IN style='font-family:"Arial","sans-serif"'>: </span><span
		style='font-family:"Arial","sans-serif"'><?php echo $cuti['unit_kerja'];?></span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Pada prinsipnya kami tidak
		berkeberatan atas permohonan cuti tersebut untuk diproses lebih lanjut sesuai
		dengan ketentuan yang berlaku</span><span style='font-family:"Arial","sans-serif"'>dan mohon kiranya</span><span
		lang=IN style='font-family:"Arial","sans-serif"'> dapat diproses dalam waktu
		yang tidak terlalu lama.</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='text-align:justify;text-indent:27.0pt'><span lang=IN
		style='font-family:"Arial","sans-serif"'>Demikian atas perhatian dan kerjasama
		yang baik, kami ucapkan terima kasih.</span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

		<p class=MsoNormal style='margin-left:2.0in;text-align:justify;text-indent:
		.5in'><span lang=IN style='font-family:"Arial","sans-serif"'>                                                </span></p>

		<p class=MsoNormal style='margin-left:207.0pt;text-align:justify;text-indent:
		9.0pt'><span style='font-family:"Arial","sans-serif"'><?php echo $cuti['jabatanpenandatangan'];?></span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>               </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		lang=IN style='font-family:"Arial","sans-serif"'>   </span></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><b><span
		style='font-family:"Arial","sans-serif"'>               <?php echo $cuti['nama_ttd'];?></span></b></p>

		<p class=MsoNormal style='margin-left:171.0pt;text-align:justify'><span
		style='font-family:"Arial","sans-serif"'>               </span><span lang=IN
		style='font-family:"Arial","sans-serif"'>NIP </span><span style='font-family:
		"Arial","sans-serif"'><?php echo $cuti['nip_ttd'];?></span></p>

		<p class=MsoNormal style='margin-left:2.25in;text-align:justify;text-indent:9.0pt'><span lang=IN style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>


<?php 
}
?>	
</div>

</body>

</html>
