<html>
    <head>
    </head>
        <body>
            <style>
                body{
                    font-size: 12px;
                    font-family: "Times New Roman", Georgia, Serif;
                }
                .tb_usulan{
                    border-collapse: collapse;
                    width: 100%;
                    font-size: 11px;
                }
                .tb_usulan, .tb_usulan td, .tb_usulan th {
                    border: 1px solid #444;
                }
                .tb_usulan th{
                    
                }
                .tb_usulan th{
                    height: 50px;
                    background: #F4F4F4;
                }
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
                    margin-top:60px;
                    width: 210mm;
                    height: 210mm;
                    background: white;
                }
            }
        </style>
            <?php $usulan = $usulan_header[0]; ?>
            <p style="text-align: right;"><span style="padding-right:20px;"><?php echo $this->local_time_format->fullDate($usulan['tgl_isp'],'d mmmm yyyy');?></span></p>
            <!--<p style="text-align: center;">&nbsp;</p>
            <p style="text-align: center;">
                <strong><span style="text-decoration: underline; letter-spacing: 1.0pt;">SURAT IZIN CUTI BESAR</span></strong>
            </p>
            <p style="text-align: center;">
                <strong><span>Nomor :</span></strong>
                <strong><span><?php echo $usulan['nomor_surat'];?></span></strong>
            </p>-->
            <p style="text-align: center;">&nbsp;</p>
            
            <table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 25%;"><span>Nomor Surat</span></td>
                        <td style="width: 4px;">:</td>
                        <td style="width: 75%;"><span><?php echo $usulan['isp'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>Lampiran</span></td>
                        <td>:</td>
                        <td><span>Satu bendel</span></td>
                    </tr>
                    <tr>
                        <td><span>Perihal</span></td>
                        <td>:</td>
                        <td><span><?php echo $usulan['perihal'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>Asal Surat</span></td>
                        <td>:</td>
                        <td><span><?php echo $usulan['asal_surat'];?></span></td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: center;">&nbsp;</p>
            <table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <span>
                                Yang Terhormat,<br/>
                                Kepala Biro Kepegawaian<br/>
                                Sekretariat Jenderal Kementrian Kesehatan RI<br/>
                                Jakarta<br/><p style="text-align: center;">&nbsp;</p>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php if(!empty($usulan_detail)) :
                            $orang = ucfirst(strtolower($usulan_detail[0]['nama']));
                            $jum = count($usulan_detail);
                            $jum_bil = " (".$this->utility->angka_to_huruf($jum,3).")";
                            if($jum>1){
                                $dkk = ', dkk';
                            }else{
                                $dkk ='';
                            }
                            echo "Bersama ini kami sampaikan usul izin belajar pegawai an. ".$orang.$dkk.", ".$jum.$jum_bil." orang, untuk diproses lebih lanjut.";
                            endif; ?>
                              
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: center;">&nbsp;</p>
            
            <?php if(!empty($usulan_detail)) : ?>
                <p style="text-align: center;">
                    <span style="letter-spacing: 1.0pt;">DAFTAR PEGAWAI USUL IZIN BELAJAR</span>
                </p>
                <table class="tb_usulan">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NIP</th>
                        <th>PENDIDIKAN TERAKHIR</th>
                        <th>GOL</th>
                        <th>TMT GOL</th>
                        <th>JABATAN</th>
                        <th>SATKER</th>
                    </tr>
                    <?php $i=1; foreach($usulan_detail as $row): ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['nama'];?></td>
                        <td><?php echo $row['nip_baru'];?></td>
                        <td><?php echo $row['pendidikan_terakhir'];?></td>
                        <td><?php echo $row['golongan'];?></td>
                        <td><?php echo $row['tmt_gol'];?></td>
                        <td><?php echo $row['jabatan'];?></td>
                        <td><?php echo $row['satker'];?></td>
                    </tr>
                    <?php $i++; endforeach;?>
                </table>
            <?php endif; ?>
            <p style="text-align: center;">&nbsp;</p>
            <p style="float: right;display: block;text-align: center;padding-right:20px;">
                <span><?php echo $usulan['jabatanpenandatangan'];?></span>
                <br/><br/>
                (<span style="text-decoration: underline;"><b><?php echo $usulan['nama'];?></b></span>)
                <br/>
                <span>NIP. <?php echo $usulan['nip_baru'];?></span>
            </p>
            <br/><br/><br/><br/>
            
        </body>
</html>