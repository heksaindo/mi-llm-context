<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<style type="text/css">
		.widget{
			margin-bottom: 11px !important;
			margin-left: -19px;
			margin-right: -19px;
		}
	</style>
    <script type="text/javascript" src="<?php echo base_url().'js/jquery.nova.js';?>"></script>
</head>
<body>
	<!-- Content container -->
	<div id="container">
			
		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
						<li class="active"><a href="<?php echo base_url().'viewer/'.$id;?>" title="">Dokumen Viewer</a></li>
		            </ul>
					
			    </div>
			    <!-- /breadcrumbs line -->

			     <!-- /page header -->
				 <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<!-- Media datatable -->
                <div class="widget">
					<?php if($file->ext=='pdf') : ?>
						<a href="<?php echo base_url().'Uploads/dokumen/'.$file->filename;?>" id="<?php echo $file->ext;?>_img" alt="" class="img-download"></a>
						<script type="text/javascript">
						$(document).ready(function () {
							var heigh = $(document).height()-77;
							$('.widget').height(heigh);
							var fr = $('a.img-download').novaViewer({
								height: '100%',
								width: '100%',
								url: "<?php echo base_url().'viewer/doc';?>",
								download: true
							});
						});
						$( window ).resize(function () {
							var heigh = $(document).height()-77;
							$('.widget').height(heigh);
						});
						</script>
					<?php else: ?>
					<a href="<?php echo base_url().'Uploads/dokumen/'.$file->filename;?>" id="<?php echo $file->ext;?>_img" alt="" class="img-download">Download</a>
					<?php endif; ?>
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