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
			<div class="top">RAHASIA</div>
			<div class="top">BAHAN PERSIDANGAN USUL PENGISIAN JABATAN <br /> Periode <?php echo $periode_name;?></div>
		</div>
	</div>	
	<div class="table-overflow" style="background-color: #FFF; width:100%;padding-left:14px;">
		<table style="margin:10px; width:98%;" class="print_body_top">
			<tr>
				<td width="150">Unit Kerja Pengusul</td><td width="5">:</td>
				<td ><?php echo $bapeljakat->nama_unit_kerja;?></td>
			</tr>
			<tr>
				<td>Jabatan Yang Akan Diisi</td><td>:</td>
				<td><?php echo $bapeljakat->nama_jabatan; ?></td>
			</tr>
			<tr>
				<td colspan="3">Pejabat Lama</td>
			</tr>
			<tr>
				<td>&nbsp; &nbsp; Nama</td><td>:</td>
				<td><?php echo $bapeljakat->pejabat_lama; ?></td>
			</tr>
			<tr>
				<td>&nbsp; &nbsp; Pangkat/Golongan</td><td>:</td>
				<td><?php echo $bapeljakat->pangkat_lama.' / '.$bapeljakat->golongan_lama; ?></td>
			</tr>
			<tr>
				<td>&nbsp; &nbsp; Keterangan</td><td>:</td>
				<td><?php echo $bapeljakat->keterangan; ?></td>
			</tr>		
		</table>
	</div>
	<div class="table-overflow">

		<div class="widget-content">									
			<table id="list-bapeljakat_detail" class="grid_table">
				<thead>
					<tr class="xcenter">
						<th width="20" rowspan="2">No</th>
						<th class="xcenter" width="150" colspan="4"><div style="text-align:center;">DAFTAR CALON PEJABAT YANG DIUSULKAN</div></th>
						<th class="xcenter" colspan="13"><div style="text-align:center;">NILAI/SKOR SETIAP UNSUR *)</div></th>
						<th rowspan="2">JUMLAH</th>
						<th rowspan="2">PENSIUN<br>TMT</th>
						<th rowspan="2">CATATAN <br>HASIL<br>SIDANG</th>
					</tr>
					<tr class="xcenter">
						<th>NAMA/NIP/TGL.<br>LAHIR/AGAMA</th>
						<th>GOL/TMT</th>
						<th>PENDIDIKAN/<br>DIKLAT</th>
						<th>RIWAYAT JABATAN</th>
						<th class="xcenter">1</th>
						<th class="xcenter">2</th>
						<th class="xcenter">3</th>
						<th class="xcenter">4</th>
						<th class="xcenter">5</th>
						<th class="xcenter">6</th>
						<th class="xcenter">7</th>
						<th class="xcenter">8</th>
						<th class="xcenter">9</th>
						<th class="xcenter">10</th>
						<th class="xcenter">11</th>
						<th class="xcenter">12</th>
						<th class="xcenter">13</th>
						
					</tr>
					<tr>
						<th class="xcenter">A</th>
						<th class="xcenter">B</th>
						<th class="xcenter">C</th>
						<th class="xcenter">D</th>
						<th class="xcenter">E</th>
						<th class="xcenter">F</th>
						<th class="xcenter">G</th>
						<th class="xcenter">H</th>
						<th class="xcenter">I</th>
						<th class="xcenter">J</th>
						<th class="xcenter">K</th>
						<th class="xcenter">L</th>
						<th class="xcenter">M</th>
						<th class="xcenter">N</th>
						<th class="xcenter">O</th>
						<th class="xcenter">P</th>
						<th class="xcenter">Q</th>
						<th class="xcenter">R</th>
						<th class="xcenter">S</th>
						<th class="xcenter">T</th>
						<th class="xcenter">U</th>
					</tr>
				</thead>		
				<tbody>
					
					<?php				
					
					$this->db->select('a.*, b.nip_baru, b.tanggal_lahir, b.agama')
						->from('bapeljakat_detail as a')
						->join('pegawai as b','a.calon_nip = b.nip_baru');
					$this->db->where('a.id_bapeljakat', $bapeljakat->id_bapeljakat);	
					$query = $this->db->get();
					
					if ($query->num_rows() > 0)
					{
						$no = 1;
						foreach($query->result() as $row){
							$tgl_lahir = $row->tanggal_lahir ? toInaDate($row->tanggal_lahir) : '';
							?>
								<tr>
									<td align="center"><?php echo $no;?></td>
									<td><?php echo $row->calon_nama.' / '.$row->calon_nip.' / '.$tgl_lahir.' / '.$row->agama;?></td>
									<td><?php echo $row->calon_golongan.' / '.$row->calon_tmt_golongan;?></td>
									<td><?php echo $row->calon_pendidikan.' / '.$row->calon_diklat;?></td>
									<td><?php echo $row->calon_riwayatjabatan;?></td>
									<td><?php echo $row->nilai_1;?></td>
									<td><?php echo $row->nilai_2;?></td>
									<td><?php echo $row->nilai_3;?></td>
									<td><?php echo $row->nilai_4;?></td>
									<td><?php echo $row->nilai_5;?></td>
									<td><?php echo $row->nilai_6;?></td>
									<td><?php echo $row->nilai_7;?></td>
									<td><?php echo $row->nilai_8;?></td>
									<td><?php echo $row->nilai_9;?></td>
									<td><?php echo $row->nilai_10;?></td>
									<td><?php echo $row->nilai_11;?></td>
									<td><?php echo $row->nilai_12;?></td>
									<td><?php echo $row->nilai_13;?></td>
									<td><?php echo $row->jumlah;?></td>
									<td><?php echo $row->calon_tmt_pensiun;?></td>
									<td><?php echo $row->catatan_hasil;?></td>
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