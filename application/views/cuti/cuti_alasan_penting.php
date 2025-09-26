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
            
            <table style="display: block;" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 25%;"><span>Nomor</span></td>
                        <td style="width: 4px;">:</td>
                        <td style="width: 75%;"><?php echo $cuti['nomor_surat'];?></td>
                        <td style="width: 130px;" class="pull-right"><?php echo $this->local_time_format->fullDate($cuti['tgl_mulai'],'d mmmm yyyy');?></td>
                    </tr>
                    <tr>
                        <td><span>Lampiran</span></td>
                        <td>:</td>
                        <td><span>Satu berkas</span></td>
                    </tr>
                    <tr>
                        <td><span>Hal</span></td>
                        <td>:</td>
                        <td><span>Permohonan Cuti Alasan Penting</span></td>
                    </tr>
                    <tr>
                        <td><span></span></td>
                        <td></td>
                        <td><span>A.n. <?php echo $cuti['yang_mengajukan'];?></span></td>
                    </tr>                    
                </tbody>
            </table>
            
            <br/>
            
            <p>Yang terhormat,<br/>
            Kepala Biro Kepegawaian<br/>
            Sekretariat Jenderal Kementerian Kesehatan RI</p>
            <br/>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bersama ini kami teruskan permohonan Cuti Alasan Penting atas:</p>            
            
            <table style="display: block;" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 25%;"><span>Nama</span></td>
                        <td style="width: 4px;">:</td>
                        <td style="width: 75%;"><span><?php echo $cuti['yang_mengajukan'];?></span></td>
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
                        <td><span>Unit Kerja</span></td>
                        <td>:</td>
                        <td><span><?php echo $cuti['unit_kerja'];?></span></td>
                    </tr>
                </tbody>
            </table>
            <br/>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada prinsipnya kami tidak keberatan atas permintaan cuti tersebut untuk diproses lebih lanjut sesui dengan ketentuan yang berlaku.</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atas perhatian dan kerja sama Saudara diucapkan terima kasih.</p>
                        
            <p style="text-align: center;">&nbsp;</p>
            <p style="float: right;display: block;text-align: center;padding-right:20px;">
                <span><?php echo $cuti['jabatanpenandatangan'];?></span>
                <br/><br/>
                (<span style="text-decoration: underline;"><b><?php echo $cuti['nama_ttd'];?></b></span>)
                <br/>
                <span>NIP. <?php echo $cuti['nip_ttd'];?></span>
            </p>           
            <br/>
            <br/><br/><br/><br/>
            <p>
                TEMBUSAN:
            </p> 
            <p>
                <?php echo $cuti['tembusan'];?>                
            </p>
        </body>
</html>