<?php
	$kp = $data_kp[0];
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
        <body>
            <style>

            .ol-tahunan li{
                padding: 0px 0px 5px;
            }
            .ui-widget{
                font-size: inherit !important;
            }
            
            @page {
                size: A4;
                margin:1cm;
            }
            @media print {
                html, body {
                    width: 210mm;
                    height: 277mm;
                    background: white;
                }
            }
        </style>
            <p style="text-align: right;"><span style="padding-right:20px;">Jakarta, <?php echo $this->local_time_format->fullDate(date("Y-m-d"),'d mmmm yyyy');?></span></p>
            <p style="text-align: center;">&nbsp;</p>
            <p style="text-align: center;">&nbsp;</p>
            
            <table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 25%;"><span>Nomor</span></td>
                        <td style="width: 4px;">:</td>
                        <td style="width: 75%;"><span><?php echo $kp['no_sk'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>Lampiran</span></td>
                        <td>:</td>
                        <td><span>-</span></td>
                    </tr>
                    <tr>
                        <td><span>Perihal</span></td>
                        <td>:</td>
                        <td><span>Kenaikan Pangkat</span></td>
                    </tr>
                    <tr>
                        <td><span></span></td>
                        <td></td>
                        <td><span><?php echo $kp['nama'];?></span></td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: center;">&nbsp;</p>
            <span style="display: block;float: right;">
                                Yth. Kepada<br/>
								Sdr. <b>KEPALA KANTOR<br/>
								<font size="3" style="font-size: 11pt">PERBENDAHARAAN NEGARA</font><br/>
								<font size="3" style="font-size: 11pt">JAKARTA IV</font></b><br/>
								<font size="3" style="font-size: 11pt">di</font><br/>
								<font size="3" style="font-size: 11pt">JAKARTA </font>
            </span>
			
			<p style="text-align: center;">&nbsp;</p>
			<p style="margin-top:120px;">
				<span style="text-indent: 1.27cm;">
                            Dengan ini diberitahukan bahwa berhubung dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada :
				</span>
			</p>
			<table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
					<tr>
						<td><span>1.</span></td>
						<td><span>N a m a</span></td>
						<td><span>:</span></td>
						<td><span><?php echo $kp['nama'];?></span></td>
					</tr>
					<tr>
						<td><span>2.</span></td>
						<td><span>Nomor Induk Pegawai ( NIP )</span></td>
						<td><span>:</span></td>
						<td><span><?php echo $kp['nip_baru'];?></span></td>
					</tr>
					<tr>
						<td><span>3.</span></td>
						<td><span>Pangkat / Jabatan</span></td>
						<td><span>:</span></td>
						<td><span><?php echo $kp['kantor'];?></span></td>
					</tr>
					<tr>
						<td><span>4.</span></td>
						<td><span>Kantor / Tempat</span></td>
						<td><span>:</span></td>
						<td><span>Direktorat Kesehatan</span></td>
					</tr>
				</tbody>
			</table>
			<p style="margin-left:14px;">atas dasar Surat Keputusan terakhir tentang gaji/pangkat yang ditetapkan :</p>

			<table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td>a.</td>
						<td>Oleh Pejabat</td>
						<td>:</td>
						<td><b>DIREKTUR JENDERAL</b></td>
                    </tr>
					<tr>
                        <td>b.</td>
						<td>Tanggal</td>
						<td>:</td>
						<td><?php echo toInaDate($kp['tgl_sk']);?></td>
                    </tr>
					<tr>
                        <td></td>
						<td>Nomor</td>
						<td>:</td>
						<td><?php echo $kp['no_sk'];?></td>
                    </tr>
					<tr>
                        <td>c.</td>
						<td>Masa kerja golongan pada</td>
						<td>:</td>
						<td><?php echo $kp['masa_kerja_golongan'];?></td>
                    </tr>
					<tr>
                        <td></td>
						<td>tanggal tersebut</td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
                        <td>d.</td>
						<td>Tanggal mulai berlakunya</td>
						<td>:</td>
						<td><?php echo toInaDate($kp['tgl_sk']);?></td>
                    </tr>
					<tr>
                        <td></td>
						<td>pangkat tersebut</td>
						<td></td>
						<td></td>
                    </tr>
                </tbody>
            </table>
			
            <p style="margin-left:14px;">diberikan kenaikan pangkat  :</p>
			
			<table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td>5.</td>
						<td>Pangkat</td>
						<td>:</td>
						<td><b><?php echo $kp['kepangkatan'];?></b></td>
                    </tr>
					<tr>
                        <td></td>
						<td>( PP. No. 15 Tahun 2012 )</td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
                        <td>6.</td>
						<td>Berdasar masa kerja</td>
						<td>:</td>
						<td><?php echo $kp['masa_kerja_golongan'];?></td>
                    </tr>
					<tr>
                        <td>7.</td>
						<td>Dalam golongan</td>
						<td>:</td>
						<td><?php echo $kp['golongan'];?></td>
                    </tr>
					<tr>
                        <td>8.</td>
						<td>Mulai tanggal</td>
						<td>:</td>
						<td><?php echo toInaDate($kp['tgl_sk']);?></td>
                    </tr>
                </tbody>
            </table>
			<p style="text-indent: 30px;text-align: justify;">
				<span>
					Diharapkan agar sesuai dengan pasal 51 ayat 1 Keputusan Presiden Nomor 16 Tahun 1994,
					kepada pegawai tersebut dapat diatur pekerjaan sesuai pangkat baru.
				</span>
			</p>
            <p style="float: right;display: block;text-align: center;padding-right:20px;">
                <span>DIREKTUR JENDERAL</span>
                <br/>
				<span>Departemen Kesehatan,</span>
				<br/><br/><br/>
                (<span style="text-decoration: underline;"><b><?php echo trim($kp['pejabat_penandatangan']);?></b></span>)
            </p>
            <br/><br/><br/><br/><br/><br/>
			<span><b>TEMBUSAN</b> surat ini disampaikan kepada Yth. :</span>
            <table style="display: block;" width="100%">
				<tr>
					<td>1.</td>
					<td>Direktorat Jenderal Anggaran Kementerian Keuangan.</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Direktorat Jenderal Perbendaharaan Kementerian Keuangan.</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>BKN Biro Tata Usaha Kepegawaian di Jakarta.</td>
				</tr>
				<tr>
					<td>4.</td>
					<td>Bagian Perencanaan dan Keuangan.</td>
				</tr>
				<tr>
					<td>5.</td>
					<td>PT. TASPEN di Jakarta.</td>
				</tr>
				<tr>
					<td>6.</td>
					<td>Pembuat Daftar Gaji ( 7 x 1 ).</td>
				</tr>
				<tr>
					<td>7.</td>
					<td>Pegawai yang bersangkutan.</td>
				</tr>
				<tr>
					<td>8.</td>
					<td>A r s i p.</td>
				</tr>
			</table>
			<script>
				window.print();
			</script>
        </body>
</html>