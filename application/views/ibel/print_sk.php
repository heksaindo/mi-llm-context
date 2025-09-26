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
                .tb_usulan td{
                    padding-left: 10px;
                }
                .tb_usulan th{
                    height: 50px;
                    background: #F4F4F4;
                }
                
            .text-inden p{
                text-indent: 30px;
                text-align: justify;
            }
            .ui-widget{
                font-size: inherit !important;
            }
            .ol-tahunan li{
                padding: 0px 0px 5px;
            }
            @page {
                size: A4 landscape;
                margin:1cm;
            }
            
            .pagelimiter{
                display: block;
                height: 1px;
                border: solid 1px #333;
                width: calc(100% + 1cm);
                margin: 0cm -1cm;
            }
            div.nextpage {
                margin-top:10px;
            }
            @media print {
                html, body {
                    margin-top:60px;
                    width: 210mm;
                    height: 210mm;
                    background: white;
                }
                .pagelimiter{
                    display: none;
                }
                div.nextpage {
                    display: block;
                    padding-top: 60px;
                }
                /*div.nextpage {
                    height: 750px;
                    width: 800px;
                    filter: progid:D/XImageTransform.Microsoft.BasicImage(Rotation=1);
                    -ms-transform: rotate(270deg);
                    -webkit-transform: rotate(270deg);
                    transform: rotate(270deg);
                    top: 1.5in;
                    left: -1in;
                }
                */
            }
            .pagebreak { page-break-before: always; }
            
        </style>

            <?php $usulan = $sk_header[0]; ?>
            <p style="text-align: right;"><span style="padding-right:20px;"><?php echo $this->local_time_format->fullDate($usulan['tgl_isk'],'d mmmm yyyy');?></span></p>

            <p style="text-align: center;">&nbsp;</p>
            
            <table style="display: block;padding-left: 14px;" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 13%;"><span>Nomor</span></td>
                        <td style="width: 1px;">:</td>
                        <td style="width: 86%;"><span><?php echo $usulan['isk'];?></span></td>
                    </tr>
                    <tr>
                        <td><span>Lampiran</span></td>
                        <td>:</td>
                        <td><span>Satu berkas</span></td>
                    </tr>
                    <tr>
                        <td><span>Hal</span></td>
                        <td>:</td>
                        <td><span>Permohonan SK Izin Belajar</span></td>
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
                </tbody>
            </table>
            <table style="display: block;padding-left: 14px;" width="100%">
                <tr>
                    <td class="text-inden">
                        <p>
                            
                            Bersama ini kami teruskan surat <?php echo $usulan['tembusan'];?> <?php echo $usulan['asal_surat'];?>
                            Nomor <?php echo $usulan['isp'];?> Tanggal <?php echo $this->local_time_format->fullDate($usulan['tgl_isp'],'d mmmm yyyy');?>
                            tentang permohonan penerbitan SK Izin Belajar dari
                            <?php echo $usulan['asal_surat'];?> a.n.,
                            <?php if(!empty($sk_detail)) :
                            $orang = ucfirst(strtolower($sk_detail[0]['nama']));
                            $jum = count($sk_detail);
                            $jum_bil = " (".$this->utility->angka_to_huruf($jum,3).")";
                            if($jum>1){
                                $dkk = ', dkk';
                            }else{
                                $dkk ='';
                            }
                            echo $orang.$dkk.", ".$jum.$jum_bil." orang, sebagaimana terlampir.";
                            endif;
                            ?>
                            Dan pada prinsipnya kami tidak keberatan atas permohonan tersebut, dengan catatan bersedia
                            mematuhi ketentuan-ketentuan yang berlaku.
                        </p>
                        <p>
                            Atas perhatian dan bantuan Saudara diucapkan terima kasih.
                        </p>    
                    </td>
                </tr>
            </table>
            <p style="text-align: center;">&nbsp;</p>
            
            <p style="text-align: center;">&nbsp;</p>
            <p style="float: right;display: block;text-align: center;padding-right:20px;">
                <span><?php echo $usulan['jabatanpenandatangan'];?></span>
                <br/><br/>
                (<span style="text-decoration: underline;"><b><?php echo $usulan['nama'];?></b></span>)
                <br/>
                <span>NIP. <?php echo $usulan['nip_baru'];?></span>
            </p>
             <p style="text-align: center;">&nbsp;</p>
             <p style="text-align: center;">&nbsp;</p>
             <p style="text-align: center;">&nbsp;</p>
             <p style="text-align: center;">&nbsp;</p>
             <p style="text-align: center;">&nbsp;</p>
             <table style="display: block;padding-left: 14px;" width="100%">
                <tr>
                    <td>
                        Tembusan:   
                    </td>
                </tr>
                <tr>
                    <td>
                        <ol class="ol-tahunan" style="list-style-type:decimal;margin-left:17px;padding: inherit;">
                            <li>
                                Direktur Jenderal Pelayanan Kesehatan
                            </li>
                            <li>
                                <?php echo $usulan['tembusan'];?> <?php echo $usulan['asal_surat'];?>
                            </li>
                        </ol>
                    </td>
                </tr>
            </table>
            <br/><br/><br/><br/>
                <?php if(!empty($sk_detail)) : ?>
                <div class="pagebreak"></div>
                <div class="pagelimiter"></div>
                <div class="nextpage">
                    <table style="float: right;display: block;margin-right: 20px;" class="tb_lampiran">
                        <tr>
                            <td colspan="2">Lampiran</td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td><span><?php echo $usulan['isk'];?></span></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><span><?php echo $this->local_time_format->fullDate($usulan['tgl_isk'],'d mmmm yyyy');?></span></td>
                      </tr>
                    </table>
                    <p style="width: 100%;display: block;float: left;text-align: center;font-weight: bold;margin-top:20px;">
                        <span style="letter-spacing: 0.5pt;">DAFTAR PESERTA IZIN BELAJAR</span><br/>
                        <span style="letter-spacing: 0.5pt;">PEGAWAI <?php echo strtoupper($usulan['asal_surat']);?></span>
                    </p>
                    <table class="tb_usulan">
                        <tr>
                            <th>NO</th>
                            <th>Nama Pegawai</th>
                            <th style="width: 100px;">Jenjang Studi</th>
                            <th>Program Studi</th>
                        </tr>
                        <?php $i=1; foreach($sk_detail as $row): ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['nama'];?></td>
                            <td style="text-align: center;"><?php echo $row['pendidikan_jenjang'];?></td>
                            <td><?php echo $row['pendidikan_tujuan'];?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                    </table>
                    </div>
                <?php endif; ?>
            
        </body>
</html>