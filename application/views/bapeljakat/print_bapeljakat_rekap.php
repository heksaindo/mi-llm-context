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
	
	.print_body_top .top {
		font-size: 14px;
		font-weight: bold;
		margin: 0;
		padding: 9px 14px 9px 0;
		text-align: center;
	}

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

<div class="printable">
	<div class="navbar">
		<div class="print_body_top">
			<center>
			<div class="top">DAFTAR LAMPIRAN USULAN PEJABAT STRUKTURAL ESELON III DAN IV <br/> Periode <?php echo $periode_name;?><br/>
							DI LINGKUNGAN DEPARTEMEN KESEHATAN</div>
			</center>
		</div>
	</div>	
	
	<div class="table-overflow">

		<div class="widget-content">									
			<table width="100%" class="grid_table">
				<thead>
					<tr>
						<th width="10" rowspan="2">No</th>
						<th width="150" rowspan="2">JABATAN YANG AKAN DIISI</th>
						<th width="10" rowspan="2">ES</th>
						<th colspan="4"><div style="text-align:center;">CALON YANG DIUSULKAN</div></th>
						<th width="50" rowspan="2">KETERANGAN</th>
					</tr>
					<tr>
						<th>NAMA/NIP/TTL LAHIR</th>
						<th>GOL<br />TMT</th>
						<th>PENDIDIKAN/<br />DIKLAT</th>
						<th>JABATAN TERAKHIR</th>
					</tr>	
				</thead>	
				<tbody>
					<?php
					if($bapeljakat){
						$no = 1;
						foreach($bapeljakat as $row){
							$tgl_lahir = get_name('pegawai','tanggal_lahir','nip_baru', $row['calon_nip']);
							$tgl_lahir = toInaDate($tgl_lahir);
					
							?>
							<tr>
							<td align="center"><?php echo $no;?></td>
							<td><?php echo $row['nama_jabatan'];?></td>
							<td><?php echo $row['eselon'];?></td>
							<td><?php echo $row['calon_nama'];?><br /><?php echo $row['calon_nip'];?><br /><?php echo $tgl_lahir;?></td>
							<td><?php echo $row['calon_golongan'];?><br /><?php echo date('d-m-Y', strtotime($row['calon_tmt_golongan']));?></td>
							<td><?php echo $row['calon_pendidikan'];?><br /><?php echo $row['calon_diklat'];?></td>
							<td><?php echo $row['calon_riwayatjabatan'];?></td>
							<td><?php echo $row['catatan_hasil'];?></td>
							</tr>
							<?php	
							$no++;
						}
					}
					?>
				</tbody>
			</table>
		</div>

	</div>
</div>
<!-- /media datatable -->


</body>
</html>