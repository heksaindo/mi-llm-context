<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
			font-size: 10px;
			width:100%;		
			margin-top: 10px;
		}

		.printable table{	
		  border-collapse: collapse;
		  color: #000;
		  font-family: tahoma, verdana, sans-serif;
		  font-size: 10px;
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
			font-size:12px;
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
			font-size: 11px;
			font-weight:bold;
		}

		.printable table.header td {
			font-size: 10px;
		}

		/*just border*/
		.printable table.table_border{
			border:1px solid #000;
		}

		.printable table.table_border tr td{
			padding:3px 5px;
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
			font-size: 10px;
		}

		.printable table.grid_table tr.odd_row td,
		.printable table tr.odd_row td {
			background-color: transparent;
			border-bottom: 1px solid #aaaaaa;
			font-size: 10px;
		}

		.printable table.grid_table tr.even_row.no_border td,
		.printable table tr.even_row.no_border td {
			border-bottom: 0px solid #aaaaaa;
			font-size: 10px;
		}

		.printable table.grid_table tr.odd_row.no_border td,
		.printable table tr.odd_row.no_border td {
			border-bottom: 0px solid #aaaaaa;
			font-size: 10px;
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
	<?php 
	if (!empty($query)) {
		$data_usulan = $query->row_array(); 
	?>
	
   <div style="height:60px">&nbsp;</div>
    

    <table border="0" cellpadding="7" cellspacing="0" width="715">
        <colgroup>
            <col width="70" />
            <col width="5" />
            <col width="260" />
            <col width="28" />
            <col width="281" />
        </colgroup>
        <tr valign="TOP">
            <td width="70">
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">Nomor</font></p>
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">Lampiran</font></p>
                <p>
                    <font size="3" style="font-size: 11pt">Perihal</font></p>
            </td>
            <td width="5">
                <p align="CENTER" style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">:</font></p>
                <p align="CENTER" style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">:</font></p>
                <p align="CENTER">
                    <font size="3" style="font-size: 11pt">:</font></p>
            </td>
            <td width="260">
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt"><?php echo $data_usulan['no_surat'];?></font><br />
                </p>
                <p style="margin-bottom: 0cm">
                    <br />
                </p>
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">Pengajuan <?php echo $tipe_usulan;?></font></p>
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt"><b>
						<?php 
						echo ucwords(strtolower($data_usulan['nama']));
						if ($query->num_rows() > 1) {
							echo ', dkk.';
						}
						?>
					</b></font>
                </p>
                <p>&nbsp;
                </p>
            </td>
            <td width="28">
                <p style="margin-bottom: 0cm">
                    <br />
                </p>
                <p style="margin-bottom: 0cm">
                    <br />
                </p>
                <p style="margin-bottom: 0cm">
                    <br />
                </p>
                <p>
                    <font size="3" style="font-size: 11pt">Yth.</font></p>
            </td>
            <td width="281">
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">Jakarta, <?php echo strftime("%d %B %Y", strtotime(date('Y-m-d')));?></font></p>
                <p style="margin-bottom: 0cm">
                    <br />
                </p>
                <p style="margin-bottom: 0cm">
                    <br />
                </p>
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">K e p a d a</font></p>
                <p style="margin-bottom: 0cm">
					<font size="3" style="font-size: 11pt"><?php echo $data_usulan["kepada"];?></font>
                </p>
            </td>
        </tr>
    </table>
    <p align="left" style="text-indent: 1.27cm; margin-bottom: 0cm">
        <font size="3" style="font-size: 11pt">Bersama ini kami usulkan <?php echo $tipe_usulan;?> atas :</font>
	</p>
	<br />
    <div>

		<?php
		
			if ($query->num_rows() > 1) {
				$data_pegawai = $query->result_array();
				?>
					<table class="grid_table" width="98%">
						<thead>
							<tr>
								<th>No</th>
								<th>NIP Baru</th>
								<th>Nama</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							if($data_pegawai){
								foreach ($data_pegawai as $pegawai){
									$pegawai_id = $pegawai['id'];
								?>
									<tr>
										<td align="center"><?php echo $no; ?></td>
										<td><?php echo $pegawai['nip_baru'] ?></td>
										<td><?php echo ucwords(strtolower($pegawai['nama'])) ?></td>
										<td align="center"><?php echo $pegawai['status_pegawai'] ?></td>
									</tr>
								<?php
								$no = $no + 1;
								}
							}
							?>
						</tbody>
					</table>
				<?php
			}
			
			if ($query->num_rows() == 1) {
				
				
					$sql = $this->db->select('b.kepangkatan, d.nama_unit_kerja, e.nama_jabatan')
									->from('pegawai as a')
									->join('pegawai_kepangkatan as b', 'a.nip_baru=b.nip_baru', 'left')
									->join('pegawai_jabatan as c', 'a.nip_baru=c.nip_baru', 'left')
									->join('m_unit_kerja as d', 'c.kode_unit_kerja=d.kode_unit_kerja', 'left')
									->join('m_jabatan as e', 'c.id_jabatan=e.id_jabatan', 'left')
									->where('a.nip_baru', $data_usulan['nip_baru']);
					$qpeg = $this->db->get();
					$detail_peg = $qpeg->row();
			
				?>
					<table border="0" cellpadding="7" cellspacing="0" width="612">
						<colgroup>
							<col width="12" />
							<col width="201" />
							<col width="10" />
							<col width="333" />
						</colgroup>
						<tr valign="TOP">
							<td width="12">
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">1.</font></p>
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">2.</font></p>
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">3.</font></p>
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">4.</font></p>
							</td>
							<td width="201">
								<p style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">N a m a</font></p>
								<p style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">Nomor Induk Pegawai ( NIP )</font></p>
								<p style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">Pangkat / Jabatan</font></p>
								<p style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">Unit Kerja</font></p>
							</td>
							<td width="10">
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">:</font></p>
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">:</font></p>
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">:</font></p>
								<p align="CENTER" style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt">:</font></p>
							</td>
							<td width="333">
								<p style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt"><?php echo ucwords(strtolower($data_usulan['nama']));?></font></p>
								<p style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt"><?php echo $data_usulan['nip_baru'];?></font></p>
								<p style="margin-bottom: 0cm"><font size="3" style="font-size: 11pt">
									<?php echo $detail_peg->kepangkatan;?>
									/ <?php   echo $detail_peg->nama_jabatan;?></font>
								</p>
								<p style="margin-bottom: 0cm">
									<font size="3" style="font-size: 11pt"><?php echo $detail_peg->nama_unit_kerja;?></p>
							</td>
						</tr>
					</table>
				<?php
				}
			
			?>
					
              
    </div>
	<br />
    <p align="JUSTIFY" style="text-indent: 1.27cm; margin-bottom: 0cm">
        <font size="3" style="font-size: 11pt">Sebagai bahan pertimbangan kami lampirkan berkas persyaratan pegawai yang bersangkutan untuk dapat dipergunakan sebagaimana mestinya sesuai dengan prosedur yang berlaku. </font></p>
	<br />
	<p style="margin-bottom: 0cm">
        <font size="3" style="font-size: 11pt">Atas perhatian dan kerjasama yang baik kami ucapkan terima kasih.</font></p>
    <dl>
        <dd>
            <table border="0" cellpadding="7" cellspacing="0" width="705">
                <colgroup>
                    <col width="444" />
                    <col width="233" />
                </colgroup>
                <tr valign="TOP">
                    <td width="444">
                        <p align="JUSTIFY" style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p align="JUSTIFY" style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p align="JUSTIFY" style="margin-bottom: 0cm">
                            <font size="3" style="font-size: 11pt"><b>TEMBUSAN</b><br> surat ini disampaikan kepada Yth. :</font></p>
                        <p align="JUSTIFY" style="margin-bottom: 0cm">
                            <font size="3" style="font-size: 11pt"><?php echo $data_usulan['tembusan'];?></font></p>
                    </td>
                    <td width="233">
                        <p align="CENTER" style="margin-bottom: 0cm">
                       
                        <p align="CENTER" style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p align="CENTER" style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p align="CENTER" style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p align="CENTER" style="margin-bottom: 0cm">
                            <br />
                        </p>
                       
                        <p align="CENTER" style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p style="margin-bottom: 0cm">
                            <br />
                        </p>
                        <p>
                            <br />
                        </p>
                    </td>
                </tr>
            </table>
        </dd>
    </dl>
    <p align="JUSTIFY" style="margin-left: 1.27cm; text-indent: 1.27cm; margin-bottom: 0cm">
        <br />
    </p>
<?php
	}else{
		echo 'Pilih Pegawai!';
	}
?>
</div>
</body>
</html>