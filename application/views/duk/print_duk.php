
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
	<script type="text/javascript">
        //window.print();
    </script>
	<style type="text/css">
		.bold{ font-weight:bold; }
		.colorBlack{ color:#000000;}
		.colorWhite{ color:#FFFFFF;}
		.colorRed{ color:#ff0000;}
		.colorGreen{ color:#194a19;}
		.ml10{ margin-left:10px;}
		.mr10{ margin-right:10px;}
		.mt10{ margin-top:10px;}
		.mb10{ margin-bottom:10px;}
		.ml15{ margin-left:15px;}
		.mr15{ margin-right:15px;}
		.mt15{ margin-top:15px;}
		.mb15{ margin-bottom:15px;}
		.pl10{ padding-left:10px;}
		.pr10{ padding-right:10px;}
		.pt10{ padding-top:10px;}
		.pb10{ padding-bottom:10px;}
		.pl15{ padding-left:15px;}
		.pr15{ padding-right:15px;}
		.pt15{ padding-top:15px;}
		.pb15{ padding-bottom:15px;}
		.uppercase{
			text-transform: uppercase;
		}
		.lowercase{
			text-transform: lowercase;
		}
		.capitalize{
			text-transform: capitalize;
		}

		/*general report style*/
		.printable{
			color: #000;
			font-family: tahoma, verdana, sans-serif;
			font-size: 11px;
			width:100%;
		}

		.printable table{	
		  border-collapse: collapse;
		  color: #000;
		  font-family: tahoma, verdana, sans-serif;
		  font-size: 11px;
		}

		.printable table tr td { 
		  padding:2px 5px;
		}

		.printable h2, .printable table h2{
			font-size:18px;
			font-weight:bold;
			margin: -5px 0 0;
			color:#000;
		}

		.printable h3, .printable table h3{
			font-size:14px;
			font-weight:bold;
			margin: -5px 0 0;
			color:#000;
		}

		/*Header Table*/
		.printable table.header {
		  font-family: tahoma, verdana, sans-serif;
		  border-bottom: 1px solid #000;
		}
		.printable table.header td.border-top {
		  border-top: 1px solid #000;
		}

		.printable table.header td.title {
			margin: 0;
			font-size: 14px;
			font-weight:bold;
		}

		.printable table.header td {
			font-size: 11px;
		}

		/*just border*/
		.printable table.table_border{
			border:1px solid #000;
		}

		.printable table.table_border tr td{
			padding:3px 5px;
			border-bottom:1px solid #000;
		}

		/*table skin with odd even bg*/
		.printable table.grid_table { 
		  font-size: 11px;
		}

		.printable table.grid_table { 
		  border: 1px solid #000;
		}

		.printable table.grid_table tr th,
		.printable table.grid_table tr td { 
		  border: 1px solid #000;
		  padding:2px 5px;
		}

		.printable table.grid_table tr td.textgray,
		.printable table.grid_table tr th.textgray{
			color:#444; 
		}

		.printable table.grid_table tr.emptyhead{
			height:2px;
			font-size:1px;
		}

		.printable table.grid_table tr.table_header, 
		.printable table.grid_table tr.table_header td,
		.printable table.grid_table tr.table_header th{ 
			background-color:#e8e8e8;
			font-weight:bold;
			border:1px solid #000;
			border-left:0px solid #000;
			vertical-align: middle;
		}

		.printable table.grid_table tr.table_header th.td_first,
		.printable table.grid_table tr.table_header td.td_first{
			border:1px solid #000;
		}

		.printable table.grid_table tr.even_row td,
		.printable table tr.even_row td {
			background-color: #F6F6F6;
			border-bottom: 1px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.odd_row td,
		.printable table tr.odd_row td {
			background-color: transparent;
			border-bottom: 1px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.even_row.no_border td,
		.printable table tr.even_row.no_border td {
			border-bottom: 0px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.odd_row.no_border td,
		.printable table tr.odd_row.no_border td {
			border-bottom: 0px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.with_border td,
		.printable table tr.with_border td {
			border: 1px solid #FFF;
			border-bottom: 1px solid #000;
		}
		
		.printable table.grid_table tr.clear_border td,
		.printable table tr.clear_border td {
			border: 1px solid #FFF;
		}

		.printable table.grid_table tr.clear_border2 td,
		.printable table tr.clear_border2 td {
			border: 1px solid #FFF;
			border-bottom:0px solid #000;
		}

		.printable table tr th.left, .printable table tr td.left{text-align:left;}
		.printable table tr th.right, .printable table tr td.right{text-align:right;}
		.valign_top{vertical-align:top;}
		.valign_mid{vertical-align:mid;}
		.valign_btm{vertical-align:bottom;}
		.table_bg_line{background: url(../images/bg_table_report.png) repeat-x;}
		.title_header{font-size:14px; font-weight:bold;}

		.box_memo { 
		  border: 1px solid #000;
		  padding:2px 5px;
		  width:150px;
		  height: 20px;
		}
		.box_memo2 { 
		  border: 1px solid #000;
		  padding:2px 5px;
		  width:300px;
		  height: 20px;
		}
		
		.printable table.grid_table tr.bold td {
			border-top: 1px solid #000;
		}
	</style>
</head>
<body>

    <!-- Media datatable -->
	<div class="printable">

		<div class="table-overflow">
			<table id="list-duk" class="grid_table">
				<thead>
					<!--<tr class="clear_border">
						<td colspan="20" align="left">
							<table>
								<tr align="left">
									<td><img src="<?php echo base_url() ?>img/cetak/logoatas.gif" /></td>
									<td>
										<SPAN ID="Frame1" DIR="LTR" STYLE="float: left; width: 13.02cm; height: 2.36cm; border: none; padding: 0cm; background: #ffffff">
										<P STYLE="margin-bottom: 0cm">
											<P ALIGN=CENTER STYLE="margin-bottom: 0cm"><FONT SIZE=4 STYLE="font-size: 15pt"><B>DEPARTEMEN KESEHATAN REPUBLIK INDONESIA</B></FONT></P>
											<P ALIGN=CENTER STYLE="margin-bottom: 0cm">Jl. H.R. Rasuna Said Blok X 5 Kav. 4-9 Blok A</P>
											<P ALIGN=CENTER STYLE="margin-bottom: 0cm">JAKARTA</P>
										</SPAN><BR>
										</P>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class="with_border">
						<td colspan="20">&nbsp;</td>
					</tr>-->
					<tr class="clear_border" >
						<td colspan="20" align="center">
							<h3>DAFTAR URUT KEPANGKATAN</h3>
						</td>
					</tr>
					<tr class="clear_border" >
						<td colspan="20" align="center">
							<h3>DI LINGKUNGAN SEKRETARIAT DIREKTORAT JENDERAL</h3>
						</td>
					</tr>
					<tr class="clear_border" >
						<td colspan="20" align="center">
							<h3>KEMENTERIAN KESEHATAN REPUBLIK INDONESIA</h3>
						</td>
					</tr>
					<tr class="clear_border" >
						<td colspan="20" align="center" class="uppercase">
							<h3>KEADAAN <?php echo strftime( "%B %Y", time());?></h3>
						</td>
					</tr>
					<tr class="clear_border2">
						<td colspan="20" class="uppercase" align="right">TANGGAL CETAK : <?php echo strftime( "%d %B %Y %H:%M:%S", time());?></td>
					</tr>
					<tr class="table_header">
						<th class="td_first" rowspan="2">No</th>
						<th rowspan="2">Nama / NIP</th>
						<th colspan="2">Pangkat</th>
						<th colspan="2">Jabatan</th>
						<th colspan="2">Masa Kerja Jabatan</th>
						<th rowspan="2">Eselon</th>
						<th rowspan="2">Tmt Cpns</th>
						<th colspan="2">Masa Kerja</th>
						<th colspan="2">Usia</th>
						<th colspan="2">Latihan Jabatan Struktural</th>
						<th colspan="3">Pendidikan</th>
					</tr>
					<tr class="table_header">
						<th>Gol</th>
						<th>Tmt</th>
						<th>Nama</th>
						<th>Tmt</th>
						<th>Thn</th>
						<th>Bln</th>
						<th>Thn</th>
						<th>Bln</th>
						<th>Thn</th>
						<th>Bln</th>
						<th>Nama</th>
						<th>Thn</th>
						<th>Nama</th>
						<th>Lulus</th>
						<th>Tingkat Ijazah</th>
						
					</tr>                                
				</thead>
				<tbody>
					<?php 
					
					$nomor_urut = 1;
					foreach ($data_pegawai as $pegawai){
						$pegawai_id = $pegawai['nip_baru'];
						
						$dt_lahir = array();
						if($pegawai['tanggal_lahir'] != '0000-00-00'){
							$dt_lahir = datediff($pegawai['tanggal_lahir'], date('Y-m-d H:i:s'));
							//print_r($dt_lahir);die();
						}else{
							$dt_lahir['years'] = '';
							$dt_lahir['months'] = '';
						}
						
						$dt_masuk = array();
						if($pegawai['tgl_masuk_unit'] != '' || $pegawai['tgl_masuk_unit'] != '0000-00-00'){
							$dt_masuk = datediff($pegawai['tgl_masuk_unit'], date('Y-m-d H:i:s'));
						}else{
							$dt_masuk['years'] = '';
							$dt_masuk['months'] = '';
						}
					?>
						<tr class="odd_row">
							<td class="td_first"><?php echo $nomor_urut; ?></td>
							<td><?php echo $pegawai['nama']; ?><br><?php echo $pegawai['nip_baru']; ?></td>
							<td><?php echo $pegawai['gol_terakhir']; ?></td>
							<td><?php echo $pegawai['tmt_gol_terakhir']; ?></td>
							<td><?php echo $pegawai['nama_jabatan']; ?></td>
							<td><?php echo $pegawai['tmt_jabatan']; ?></td>
							<td align="center"><?php echo $dt_masuk['years']; ?></td>
							<td align="center"><?php echo $dt_masuk['months']; ?></td>											
							<td><?php echo $pegawai['eselon']; ?></td>
							<td><?php echo $pegawai['tmt_cpns']; ?></td>
							<td align="center"><?php echo $pegawai['masa_kerja_tahun']; ?></td>
							<td align="center"><?php echo $pegawai['masa_kerja_bulan']; ?></td>
							<td align="center"><?php echo $dt_lahir['years']; ?></td>	
							<td align="center"><?php echo $dt_lahir['months']; ?></td>	
							<td><?php echo $pegawai['nama_pelatihan']; ?></td>	
							<td align="center"><?php echo $pegawai['tahun_sertifikat']; ?></td>	
							<td><?php echo $pegawai['jurusan']; ?></td>	
							<td><?php echo $pegawai['tahun_lulus']; ?></td>	
							<td align="center"><?php echo $pegawai['tingkat_ijazah']; ?></td>	
						</tr>
					<?php
					$nomor_urut = $nomor_urut + 1;
					}
					?>
				</tbody>
			</table>
			
		</div>
	</div>
	<!-- /media datatable -->
<script type="text/javascript">
        window.print();
    </script>
</body>
</html>