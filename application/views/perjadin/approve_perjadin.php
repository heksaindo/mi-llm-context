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
						<li class="active"><a href="<?php echo base_url(); ?>Perjadin" title="">Perjalanan Dinas</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Approve Perjadin</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<div>
				 <table>
					<tr>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>perjadin" class="btn btn-block btn-info">Back</a></td>
					</tr>
				 </table>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Approval Perjadin</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>no</th>
									<th>nip</th>
									<th>nama</th>
                                    <th>tanggal mulai</th>
                                    <th>tanggal akhir</th>
                                    <th>tujuan perjalanan</th>
									<th>tempat tujuan</th>
									<th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$nomor_urut = 1;
								foreach ($data_perjadin as $perjadin){
									$perjadin_id = $perjadin['id'];
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $perjadin['nip'] ?></td>
										<td><?php echo $perjadin['nama'] ?></td>
										<td><?php echo $perjadin['tanggal_mulai'] ?></td>
										<td><?php echo $perjadin['tanggal_akhir'] ?></td>
										<td><?php echo $perjadin['tujuan_perjadin'] ?></td>
										<td><?php echo $perjadin['tempat_tujuan'] ?></td>
										<td><?php echo $perjadin['status'] ?></td>
										<td>
											<?php if ($perjadin['status'] == 'submit') { ?>
											<ul class="table-controls">
												<li><a href="<?php echo base_url().'perjadin/approveperjadin/'.$perjadin_id ?>" class="tip" title="Approve"><i class="fam-accept"></i></a> </li>
												<li><a href="<?php echo base_url().'perjadin/rejectperjadin/'.$perjadin_id ?>" class="tip" title="Cancel"><i class="fam-cancel"></i></a> </li>
											</ul>
											<?php } else if ($perjadin['status'] == 'approved') { ?>
											<ul class="table-controls">
												<li><a onclick="printpage('<?php echo base_url(); ?>perjadin/cetak/<?php print $perjadin_id;?>');" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>
											</ul>
											<?php } ?>
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