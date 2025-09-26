<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head'); ?>
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
						 <li class="active"><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Data Master</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Administrasi Data Master</h5>
				    	<span>Dashboard Administrasi Data Master</span>
			    	</div>
					<?php $this->load->view('layout/_page_stats'); ?>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<div class="row-fluid">
                	<div class="span12">

						<!-- Simple chart -->       
			            <div class="widget">
			            	<div class="navbar">
			                	<div class="navbar-inner">
			                    	<h6>Dashboard Administrasi Data Master</h6>
			                    </div>
			                </div>
			                <div class="well body">
			                	
								<div class="row-fluid">
									<div class="span12">

										<!-- Simple chart -->      
										<div class="widget">
											<div class="navbar">
												<div class="navbar-inner">
													<h6>Stastistik Distribusi Pegawai</h6>
												</div>
											</div>
											<div class="well body">
												<div id="mapdiv" align="center" ></div>
													<script type="text/javascript">
														var dashboard_distribusi_pegawai = new FusionMaps("<?php echo base_url(); ?>map/FCMap_Indonesia.swf", "Map_Id", "100%", "70%", "0", "0");
														dashboard_distribusi_pegawai.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_distribusi_pegawai");	
														dashboard_distribusi_pegawai.render("mapdiv");
													</script>
											</div>
										</div>
										<!-- /simple chart -->
									</div>
								</div>
							
			                </div>
			            </div>
			            <!-- /simple chart -->
					</div>

				</div>

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>