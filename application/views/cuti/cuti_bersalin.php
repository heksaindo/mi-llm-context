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
            <?php $cuti = $data_cuti[0]; ?>
            <p style="text-align: right;"><span style="padding-right:20px;">Jakarta, <?php echo $this->local_time_format->fullDate($cuti['tanggal_mulai'],'d mmmm yyyy');?></span></p>
            <p style="text-align: center;">&nbsp;</p>
            <p style="text-align: center;">
                <strong><span style="text-decoration: underline; letter-spacing: 1.0pt;">SURAT IZIN CUTI BERSALIN</span></strong>
            </p>
            <p style="text-align: center;">
                <strong><span>Nomor :</span></strong>
                <strong><span><?php echo $cuti['nomor_surat'];?></span></strong>
            </p>
            <p style="text-align: center;">&nbsp;</p>
            <p>
                <span>
                    1. Diberikan cuti bersalin kepada Pegawai Negeri Sipil :
                </span>
            </p>
            
            <table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 25%;"><span>Nama</span></td>
                        <td style="width: 4px;">:</td>
                        <td style="width: 75%;"><span><?php echo $cuti['nama'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>NIP</span></td>
                        <td>:</td>
                        <td><span><?php echo $cuti['nip'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>Pangkat/golongan ruang</span></td>
                        <td>:</td>
                        <td><span><?php echo $cuti['pangkat'];?> / <?php echo $cuti['golongan'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>Jabatan</span></td>
                        <td>:</td>
                        <td><span><?php echo $cuti['jabatan'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>Satuan organisasi</span></td>
                        <td>:</td>
                        <td><span><?php echo $cuti['unit_kerja'];?></span></td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: center;">&nbsp;</p>
            <table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <span>
                                terhitung mulai tanggal <?php echo $this->local_time_format->fullDate($cuti['tanggal_mulai'],'d mmmm yyyy');?>
                                sampai dengan 2 (dua) bulan setelah persalinan, dengan ketentuan sebagai berikut :
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ol class="ol-tahunan" style="list-style-type: lower-alpha;margin-left:17px;padding: inherit;">
                                <li>
                                    <span>
                                        Sebelum menjalankan cuti bersalin wajib menyerahkan pekerjaannya kepada atasan langsungnya atau pejabat lain yang ditunjuk.
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        Setelah setelah persalinan yang bersangkutan supaya memberitahukan tanggal persalinan kepada pejabat yang berwenang memberikan cuti.
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        Setelah menjalankan cuti bersalin wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali sebagaimana biasa.
                                    </span>
                                </li>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: center;">&nbsp;</p>
            <p>
                <span>
                    2. Demikian surat izin cuti bersalin ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
                </span>
            </p>
            <p style="text-align: center;">&nbsp;</p>
            <p style="float: right;display: block;text-align: center;padding-right:20px;">
                <span><?php echo $cuti['jabatanpenandatangan'];?></span>
                <br/><br/>
                (<span style="text-decoration: underline;"><b><?php echo $cuti['nama_ttd'];?></b></span>)
                <br/>
                <span>NIP. <?php echo $cuti['nip_ttd'];?></span>
            </p>
        </body>
</html>