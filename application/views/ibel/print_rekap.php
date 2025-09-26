<html>
    <head>
    </head>
    <body class="prev">
        <style>
            body.prev{
                font-size: 12px;
                font-family: "Times New Roman", Georgia, Serif;
            }
            .tb_rekap{
                    border-collapse: collapse;
                    width: 297mm;
                    font-size: 11px;
            }
            .tb_rekap, .tb_rekap td, .tb_rekap th {
                    border: 1px solid #444;
            }
            div.on_print{
                   display: block;
                   width: 297mm;
            }
            .tb_rekap th{
                    height: 50px;
                    background: #F4F4F4;
                }
            .tb_rekap td{
                padding: 0px 3px;
            }
            .ol-tahunan li{
                padding: 0px 0px 5px;
            }
            .ui-widget{
                font-size: inherit !important;
            }
            .pagelimiter{
                display: block;
                height: 15px;
            }
            .pagebreak { page-break-before: always; }
            @page {
                size: A4;
                margin:1cm;
            }
            
            @media print {
                @page { margin: 0.5cm; }
                html, body {
                    width: 210mm;
                    height: 297mm;
                    background: white;
                }
                .pagelimiter{
                    display: none;
                }
            }
        </style>
        <div class="on_print">
        <?php $i=1; if(!empty($rekap_detail)) : ?>
                <p style="text-align: center;">
                    <span style="font-weight:bold;letter-spacing: 1.0pt;">DAFTAR PEGAWAI IZIN BELAJAR</span>
                </p>
        <table style="display: block;" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 30%;"><span>Surat Pengantar Nomor</span></td>
                        <td style="width: 1px;">:</td>
                        <td style="width: 69%;"><span><?php echo $rekap_detail[0]['isp'];?></span></td>
                    </tr>
                </tbody>
        </table>
        <?php $table= '<table class="tb_rekap">
                    <tr>
                        <th style="width:30px;">NO</th>
                        <th style="width:200px;">NAMA</th>
                        <th style="width:200px;">NIP</th>
                        <th style="width:70px">PANGKAT/GOL</th>
                        <th style="width:150px;">PENDIDIKAN TERAKHIR</th>
                        <th style="width:100px;">JENIS PENDIDIKAN/JURUSAN YANG DITUJU</th>
                        <th style="width:150px;">INSTANSI PENDIDIKAN YANG DITUJU</th>
                        <th style="width:50px;">TAHUN AKADEMIK</th>
                        <th style="width:50px;">UNIT KERJA</th>
                    </tr>';
                echo $table;
                $per_hal = 30;
        ?>
                    <?php foreach($rekap_detail as $row):
                    if($i % $per_hal == 0 && $i>1){
                        echo "</table><div class='pagelimiter'></div>";
                        echo " <div class='pagebreak'></div>";
                        echo $table;
                    }
                        $pendidikan = $row['pendidikan_jenjang'].' '.$row['pendidikan_tujuan'];
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['nama'];?></td>
                        <td><?php echo $row['nip_baru'];?></td>
                        <td><?php echo $row['pangkat_gol'];?></td>
                        <td><?php echo $row['pendidikan_terakhir'];?></td>
                        <td><?php echo $pendidikan;?></td>
                        <td><?php echo $row['instansi_tujuan'];?></td>
                        <td><?php echo $row['tahun_ajaran'];?></td>
                        <td><?php echo $row['unit'];?></td>
                    </tr>
                    
                    <?php
                    
                    $i++; endforeach;?>
                </table>
            <?php endif; ?>
        </div>
    </body>
</html>