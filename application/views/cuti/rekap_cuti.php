<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head3'); ?>
		<script type="text/javascript">
        function printpage(url,jenis,name)
		{
		//child = window.open(url, "", "scrollbars=1,height=800, width=700"); //Open the child in a tiny window.
		$('#Cutipopup').dialog({
				autoOpen: false,
				modal: false,
				height: 500,
				width: 720,
				title: 'Print '+jenis+' '+name,
				buttons: {				
				"Cetak": function() {
					
					w=window.open("","", "scrollbars=1,height=600, width=800");
					w.document.write('<html><head><title>'+jenis+'_'+name+'</title>');
					w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css"  media="print" />');
					w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css"  media="print" />');
					w.document.write("<style>#cuti_{font-size: inherit !important;font-family: 'Arial','sans-serif';}</style>");
					w.document.write('<body id="cuti_">');
					w.document.write($('#Cutipopup').html());
					w.document.write('</body>');
					w.document.close();
					w.focus();
					w.print();
					w.close();					
					$( this ).dialog( "close" );
				},
				"Close": function() {
					$( this ).dialog( "close" );
				}
			 }
			});
		
		$('#Cutipopup').load(url, function(){
				$('#Cutipopup').dialog('open');
		});
		}
    </script>
</head>
<body>
	<?php $this->load->view('layout/_top'); ?>
	
	<!-- Content container -->
	<div id="container">
		
		<?php $this->load->view('layout/_sidebar'); ?>
		
		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>laporan/cuti" title="">Rekap Cuti</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Rekap Cuti</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Rekap Cuti</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
									<th>Tgl Pengajuan</th>
									<th>Yang Mengajukan</th>
									<th>Jenis Cuti</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
									<th>Jumlah</th>
									<th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$nomor_urut = 1;
								$statuscuti = array(
									'1'=>'',
									'2'=>'',
									'3'=>'',
									'4'=>'',
									'5'=>'',
									'6'=>'',
									'7'=>'Approved'
								);
								foreach ($data_cuti as $cuti){
									$cuti_id = $cuti['id'];
									if($cuti['status_cuti'] == '7'){
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $cuti['tgl_pengajuan']; ?></td>
										<td><?php echo $cuti['yang_mengajukan']; ?></td> 
										<td><?php echo $cuti['nama_cuti']; ?></td> 											
										<td><?php echo date("d-m-Y",strtotime($cuti['tgl_mulai'])); ?></td>
										<td><?php echo date("d-m-Y",strtotime($cuti['tgl_akhir'])); ?></td>
										<td><?php echo $cuti['jumlah']; ?></td>
										<td><?php echo $statuscuti[$cuti['status_cuti']]; ?></td>
										<td>
											<?php if ($cuti['status_cuti'] == '7'){ ?>
											<ul class="table-controls">
												<li><a onclick="printpage('<?php echo base_url(); ?>cuti/cetak/<?php echo $cuti_id;?>','<?php echo $cuti['jenis_cuti'] ?>','<?php echo $cuti['yang_mengajukan'] ?>');" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>
											</ul>
											<?php } ?>
										</td>
									</tr>
								<?php
								$nomor_urut = $nomor_urut + 1; }
								}
								?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
	<div id="Cutipopup"></div>
</body>
</html>