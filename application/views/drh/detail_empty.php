<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	
	<script type="text/javascript"> 	
	$(document).ready(function(){
	
		$( "#dialog-request_user" ).hide();
		$( "#dialog-print_cv" ).hide();
	});
	</script>
</head>
<body>
<?php $this->load->view('layout/_top'); ?>

<!-- Content container -->
<div id="container">
	
	<?php $this->load->view('layout/_sidebar');?>
	
	<!-- Content -->
	<div id="content">

		<!-- Content wrapper -->
		<div class="wrapper">

			<!-- Breadcrumbs line -->
			<div class="crumbs">
				<ul id="breadcrumbs" class="breadcrumb"> 
					<li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
					<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>pegawai" title="">Daftar Riwayat Hidup Pegawai</a></li>
					<li class="active"><a href="#" title="">Detail Data Pegawai</a></li>					 
				</ul>
				<?php $this->load->view('layout/_messages'); ?>
			</div>
			<!-- /breadcrumbs line -->

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h5>Detail Data Pegawai   </h5>  
				</div>
			</div>
			 <!-- /page header -->
				 
			<?php $this->load->view('layout/_actionwrapper'); ?>	  
				 
			
					
			<br />	  
		</div>
		<!-- /content wrapper -->

	</div>
	<!-- /content -->
	
</div>

	
<!-- /content container -->
<?php $this->load->view('layout/_footer'); ?>
</body>
</html>