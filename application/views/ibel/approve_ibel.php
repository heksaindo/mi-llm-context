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
						<li><a href="<?php echo base_url(); ?>pendidikan" title="">Pendidikan</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>ibel" title="">Izin Belajar</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Approve Izin Belajar</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<div>
				 <table>
					<tr>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>ibel" class="btn btn-block btn-info">Back</a></td>
					</tr>
				 </table>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Approval ibel</h6>
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
                                    <th>alasan</th>
									<th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$nomor_urut = 1;
								foreach ($data_ibel as $ibel){
									$ibel_id = $ibel['id'];
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $ibel['nip'] ?></td>
										<td><?php echo $ibel['nama'] ?></td>
										<td><?php echo $ibel['tanggal_mulai'] ?></td>
										<td><?php echo $ibel['tanggal_akhir'] ?></td>
										<td><?php echo $ibel['jenis_ibel'] ?></td>
										<td><?php echo $ibel['status'] ?></td>
										<td>
											<?php if ($ibel['status'] == 'submit') { ?>
											<ul class="table-controls">
												<li><a href="<?php echo base_url().'ibel/approveibel/'.$ibel_id ?>" class="tip" title="Approve"><i class="fam-accept"></i></a> </li>
												<li><a href="<?php echo base_url().'ibel/rejectibel/'.$ibel_id ?>" class="tip" title="Cancel"><i class="fam-cancel"></i></a> </li>
											</ul>
											<?php } else if ($ibel['status'] == 'approved') { ?>
											<ul class="table-controls">
												<li><a onclick="printpage('<?php echo base_url(); ?>ibel/cetak/<?php echo $ibel_id;?>');" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>
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