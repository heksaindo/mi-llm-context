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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>organisasi" title="">Manajemen Organisasi</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->
				
			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Manajemen Organisasi</h5>
				    	<span>Dashboard Manajemen Organisasi</span>
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
			                    	<h6>Dashboard Manajemen Organisasi</h6>
			                    </div>
			                </div>
			                
							<div class="row-fluid well body">
			                	
								<div class="span4">
									<div class="widget">
										<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Per Eselon</h6></div></div>
										<div class="well body">
											<ul class="stats-details">
												<li>
													<strong>Update Terakhir</strong>
													<span>10 Mei 2013 on 2:39 am</span>
												</li>
												<li>
													<div class="number">
														<a href="#" title="" data-toggle="dropdown"></a>
														<ul class="dropdown-menu pull-right">
															<li><a href="javascript:reloadData_dashboard_pereselon();" title="Refresh"><i class="icon-refresh"></i>Reload data</a></li>
															<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
														</ul>
														<span><!--$6,458--></span>
													</div>
												</li>
											</ul>
											<div id="chartdiv1" align="center"></div>
											<script type="text/javascript">
												var dashboard_pereselon = new FusionCharts("<?php echo base_url(); ?>Charts/Doughnut2D.swf", "ChartId", "100%", "", "0", "0");
												dashboard_pereselon.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_pereselon");		   
												dashboard_pereselon.render("chartdiv1");
											   
												function reloadData_dashboard_pereselon(){
													var dashboard_pereselon = new FusionCharts("<?php echo base_url(); ?>Charts/Doughnut2D.swf", "ChartId", "100%", "", "0", "0");
													dashboard_pereselon.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_pereselon");		   
													dashboard_pereselon.render("chartdiv1");
												}
											</script> 
										</div>
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