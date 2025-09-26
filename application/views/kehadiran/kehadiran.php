<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head'); ?>
		<script type="text/javascript">
        function printpage(url)
		{
		child = window.open(url, "", "scrollbars=1,height=800, width=600"); //Open the child in a tiny window.
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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						<li ><a href="<?php echo base_url(); ?>penugasandankehadiran" title="">Penugasan & Kehadiran</a></li>
						<li class="active"><a href="<?php echo base_url(); ?>kehadiran" title="">Kehadiran</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5><?php echo $title?></h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<div>
				 <table>
					<tr>
						<td style="width:150px;">
							<a href="<?php echo base_url(); ?>kehadiran/add" class="btn btn-block btn-info">Add Data</a>
						</td>
					</tr>
				 </table>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6><?php echo $title?></h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Direktoral Jenderal</th>
									<th>Direktorat / Sekretariat</th>
                                    <th>Unit Kerja</th>
                                    <th>Sub Unit</th>
                                    <th>Datang Tepat</th>
									<th>Datang Telat</th>
									<th>Pulang Tepat</th>
									<th>Pulang Telat</th>
									<th>Pulang Tepat Dinas</th>
									<th>Tidak Absen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$nomor_urut = 1;
								foreach ($kehadiran as $row){
									$id = $row->id;
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $row->tanggal ?></td>
										<td><?php echo $row->DIRGEN ?></td> 	
										<td><?php echo $row->SEKDIR ?></td>
										<td><?php echo $row->UNIT ?></td>
										<td><?php echo $row->SUB_UNIT ?></td>
										<td><?php echo $row->datang_tepat ?></td>
										<td><?php echo $row->datang_telat ?></td>
										<td><?php echo $row->pulang_tepat ?></td>
										<td><?php echo $row->pulang_telat ?></td>
										<td><?php echo $row->pulang_telat_dinas ?></td>
										<td><?php echo $row->tidak_absen ?></td>
										<td>
											<ul class="table-controls">
												<li><a href="<?php echo base_url(); ?>kehadiran/edit/<?php echo $id;?>" class="tip" title="Edit entry"><i class="fam-pencil"></i></a> </li>
												<li><a href="<?php echo base_url(); ?>kehadiran/delete/<?php echo $id;?>" class="tip" onClick="return confirm('Are you sure you want to delete?')" title="Remove entry"><i class="fam-cross"></i></a> </li>
											</ul>
										</td>
									</tr>
								<?php
								$nomor_urut = $nomor_urut + 1;
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
</body>
</html>