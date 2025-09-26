<?php
	foreach ($data as $row)
	{
		$no_surat=$row->no_surat;
		$tanggal=$row->tanggal;
		$tembusan=$row->tembusan;
		$jumlah=$row->jumlah;
		$Nipsekretaris=$row->sekretaris;
		$NamaSekretaris=$row->nama;
	}
	$sql="select b.nama from pegawai_mutasi a inner join pegawai b
	on a.nip=b.nip_baru where a.no_surat='".$no_surat."' limit 1";
	$query=$this->db->query($sql);
	foreach ($query->result() as $row)
	{
		$nama=$row->nama;	
	}
	$query->free_result();
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
	<script type="text/javascript">
        window.print();
    </script>
</head>
<body>
   <br />
   <br />
   <br />
    

    <table border="0" cellpadding="7" cellspacing="0" style="page-break-before: always" width="715">
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
                    <font size="3" style="font-size: 11pt">Hal</font></p>
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
                    <?php echo $no_surat?><br />
                </p>
                <p style="margin-bottom: 0cm">
                    -<br />
                </p>
                <p style="margin-bottom: 0cm"><font size="3">Persetujuan Pindah</font></p>
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt"><?php echo $nama;?>, dkk<b> </b></font>
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
                <p>&nbsp;</p>
            </td>
            <td width="281">
                <p style="margin-bottom: 0cm">
                    <font size="3" style="font-size: 11pt">Jakarta, <?php echo $tanggal?></font></p>
                <p style="margin-bottom: 0cm">
                    <br />
                </p>
              <p style="margin-bottom: 0cm">
                    <br />
                </p>
                <p style="margin-bottom: 0cm">&nbsp;</p>
<p>&nbsp;</p>
            </td>
        </tr>
        <tr valign="TOP">
          <td colspan="3"><p>Yang Terhormat,</p>
            <p>Kepala Biro Kepegawaian</p>
            <p>Sekjen Kemenkes RI</p>
          <p>di Jakarta</p></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr valign="TOP">
          <td colspan="5"><blockquote> 
            <p>Sehubungan dengan surat permohonan pindah tugas atas nama 
            <?php echo $nama?>, dkk (<?php echo $jumlah?>
            orang) </blockquote>
            <div align="justify">sebagaimana daftar
          terlampir. Dengan ini kami sampaikan bahwa pada prinsipnya kami tidak keberatan atas permohonan pindah tersebut untuk dapat diproses lebih lanjut. Mohon bantuan saudara kiranya dapat memproses surat keputusan kepindahan yang bersangkutan sesuai dengan kewenangan dan ketentuan yang ada.
</p>
            </div>
            <blockquote>        
              <p>Atas perhatian dan kerjasama Saudara, diucapkan banyak terima kasih. </p>
          </blockquote></td>
        </tr>
        <tr valign="TOP">
          <td colspan="5"><div align="right">Sekretaris</div></td>
        </tr>
        <tr valign="TOP">
          <td colspan="5">&nbsp;</td>
        </tr>
        <tr valign="TOP">
          <td colspan="5">&nbsp;</td>
        </tr>
        <tr valign="TOP">
          <td colspan="5"><div align="right">
            <?php echo $NamaSekretaris;?>
          </div></td>
        </tr>
        <tr valign="TOP">
          <td colspan="5"><div align="right"> NIP:
            <?php echo $Nipsekretaris;?>
          </div></td>
        </tr>
        <tr valign="TOP">
          <td colspan="5"><div align="right"></div></td>
        </tr>
        <tr valign="TOP">
          <td colspan="5">
          <p><strong>Tembusan</strong> :</p>
          <?php echo $tembusan?>
          </td>
        </tr>
    </table>
</body>
</html>