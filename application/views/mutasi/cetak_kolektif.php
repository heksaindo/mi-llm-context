<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 14 (filtered)">
<title>Mutasi</title>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
@font-face
	{font-family:"Arial Narrow";
	panose-1:2 11 6 6 2 2 2 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";}
@page WordSection1
	{size:8.5in 14.0in;
	margin:153.0pt 89.85pt 1.0in 89.85pt;}
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
<br />
<br />
<br />

<?php 
$nama_lengkap = ucwords(strtolower($mutasi['nama']));
if(!empty($mutasi['gelar_belakang'])){
	$nama_lengkap = ucwords(strtolower($mutasi['nama'])).', '.$mutasi['gelar_belakang'];
}
if(!empty($mutasi['gelar_depan'])){
	$nama_lengkap = $mutasi['gelar_depan'].' '.$nama_lengkap;
}
?>

<div class=WordSection1>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=69 valign=top style='width:51.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>Nomor</span></p>
  </td>
  <td width=22 valign=top style='width:16.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>:</span></p>
  </td>
  <td width=324 valign=top style='width:243.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'><?php echo $mutasi['no_surat'];?></span></p>
  </td>
  <td width=175 valign=top style='width:131.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  lang=SV style='font-family:"Arial Narrow","sans-serif"'></span></p>
  </td>
 </tr>
 <tr>
  <td width=69 valign=top style='width:51.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>Lampiran</span></p>
  </td>
  <td width=22 valign=top style='width:16.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>:</span></p>
  </td>
  <td width=324 valign=top style='width:243.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>1 (satu) berkas</span></p>
  </td>
  <td width=175 valign=top style='width:131.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=69 valign=top style='width:51.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>Hal</span></p>
  </td>
  <td width=22 valign=top style='width:16.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
  "Arial Narrow","sans-serif"'>:</span></p>
  </td>
  <td width=499 colspan=2 valign=top style='width:5.2in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>Persetujuan Pindah</span></p>
  <p class=MsoNormal><span lang=IT style='font-family:"Arial Narrow","sans-serif"'>a.n
  : </span><span
  lang=IT style='font-family:"Arial Narrow","sans-serif"'><?php echo $nama_lengkap;?>, dkk</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='text-align:justify'><span lang=IT style='font-family:
"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
"Arial Narrow","sans-serif"'>Yang terhormat,</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>
            Kepala Biro Kepegawaian<br/>
            Sekjen Kemenkes RI</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=IT style='font-family:
"Arial Narrow","sans-serif"'>di - </span><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>Jakarta</span></p>

<p class=MsoNormal style='text-align:justify'><b><u><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>
<br/><br/></span></u></b></p>

<p class=MsoNormal style='text-align:justify;text-indent:.5in'><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>
Sehubungan dengan surat permohonan pindah tugas </span><span lang=SV style='font-family:
"Arial Narrow","sans-serif"'> atas nama : </span><span
lang=IT style='font-family:"Arial Narrow","sans-serif"'><?php echo $nama_lengkap;?>, dkk</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify;text-indent:.5in'><span lang=SV
style='font-family:"Arial Narrow","sans-serif"'>Sebagai bahan pertimbangan kami
lampirkan berkas persyaratan pegawai yang bersangkutan untuk dapat dipergunakan
sebagaimana mestinya sesuai dengan prosedur yang berlaku. </span></p>

<p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-align:justify'><span lang=SV
style='font-family:"Arial Narrow","sans-serif"'>Atas perhatian dan kerjasama
yang baik kami ucapkan terima kasih.</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=FI style='font-family:
"Arial Narrow","sans-serif"'></span></p>

<p class=MsoNormal style='margin-left:153.0pt;text-align:justify'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:153.0pt;text-align:justify'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:232.4pt;text-align:justify'></p>

<p class=MsoNormal style='margin-left:3.5in'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>Sekretaris,</span></p>

<p class=MsoNormal style='margin-left:174.6pt'><span lang=FI style='font-family:
"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='margin-left:153.0pt;text-align:center'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='margin-left:153.0pt;text-align:center'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='margin-left:153.0pt;text-align:center'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:3.5in'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'><?php echo $mutasi["nama_sekretaris"];?></span>
<span lang=FI style='font-family:"Arial Narrow","sans-serif"'>
</span></p>

<p class=MsoNormal style='margin-left:3.5in'><span lang=SV style='font-family:
"Arial Narrow","sans-serif"'>NIP </span><span
lang=SV style='font-family:"Arial Narrow","sans-serif"'><?php echo $mutasi["sekretaris"];?></span></p>

<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>Tembusan
:</span></p>
<?php echo $mutasi["tembusan"];?>


</div>

</body>

</html>
