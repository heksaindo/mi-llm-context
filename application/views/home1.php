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
		
		<?php 
		$is_notifikasi_active = 0;
					
		$this->load->view('layout/_sidebar'); ?>
		
		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li class="active"><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
		            </ul>
					<?php 
					$this->load->view('layout/_messages'); 
					?>
			    </div>
			    <!-- /breadcrumbs line -->
				
			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Dashboard</h5>
				    	<span>Selamat Datang, <?php echo $this->session->userdata('nama'); ?>!</span>
			    	</div>
					<?php $this->load->view('layout/_page_stats'); ?>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                           
				<!-- Earnings stats widgets -->
		    	<div class="row-fluid">
		    		<div class="span12">
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
				
				<div class="row-fluid">
		    		<div class="span12">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Per Golongan</h6></div></div>
				            <div class="well body">
				            	<ul class="stats-details">
				            		<li>
				            			<strong>Update Terakhir</strong>
				            			<span>10 Mei 2013 on 4:42 pm</span>
				            		</li>
				            		<li>
				            			<div class="number">
					            			<a href="#" title="" data-toggle="dropdown"></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:reloadData_dashboard_pergolongan();" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
											</ul>
											<span><!--$6,458--></span>
										</div>
				            		</li>
				            	</ul>
                                <div id="chartdiv2" align="center"></div>
                                    <script type="text/javascript">
										var dashboard_pergolongan = new FusionCharts("<?php echo base_url(); ?>Charts/StackedColumn3D.swf", "ChartId", "100%", "", "0", "0");
										dashboard_pergolongan.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_pergolongan");		   
										dashboard_pergolongan.render("chartdiv2");
									   
										function reloadData_dashboard_pergolongan(){
											var dashboard_pergolongan = new FusionCharts("<?php echo base_url(); ?>Charts/StackedColumn3D.swf", "ChartId", "100%", "", "0", "0");
											dashboard_pergolongan.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_pergolongan");		   
											dashboard_pergolongan.render("chartdiv2");
										}
                                    </script>
				            </div>
				        </div>
		    		</div>
				</div>

				<div class="row-fluid">
		    		<div class="span12">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Per Tingkat Pendidikan</h6></div></div>
				            <div class="well body">
				            	<ul class="stats-details">
				            		<li>
				            			<strong>Update Terakhir</strong>
				            			<span>10 Mei 2013 on 3:09 pm</span>
				            		</li>
				            		<li>
				            			<div class="number">
					            			<a href="#" title="" data-toggle="dropdown"></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:reloadData_dashboard_perpendidikan();" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
											</ul>
											<span><!--$6,458--></span>
										</div>
				            		</li>
				            	</ul>
                                <div id="chartdiv3" align="center" ></div>
                                    <script type="text/javascript">
										var dashboard_perpendidikan = new FusionCharts("<?php echo base_url(); ?>Charts/Pie2D.swf", "ChartId", "100%", "", "0", "0");
										dashboard_perpendidikan.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_perpendidikan");		   
										dashboard_perpendidikan.render("chartdiv3");
									   									   
										function reloadData_dashboard_perpendidikan(){
											var dashboard_perpendidikan = new FusionCharts("<?php echo base_url(); ?>Charts/Pie2D.swf", "ChartId", "100%", "", "0", "0");
											dashboard_perpendidikan.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_perpendidikan");		   
											dashboard_perpendidikan.render("chartdiv3");
										}
                                    </script>
				            </div>
				        </div>
		    		</div>
		    	</div>
				
		    	<div class="row-fluid">
		    		<div class="span12">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Cuti Pegawai</h6></div></div>
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
												<li><a href="#" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>
												<li><a href="#" title=""><i class="icon-cog"></i>Parameters</a></li>
												<li><a href="#" title=""><i class="icon-download-alt"></i>Download statement</a></li>
											</ul>
											<span><!--$6,458--></span>
										</div>
				            		</li>
				            	</ul>
                                <div id="chartdiv4" align="center" > FusionCharts. </div>
                                    <script type="text/javascript">
										var dashboard_cuti_pegawai = new FusionCharts("<?php echo base_url(); ?>Charts/Area2D.swf", "ChartId", "100%", "", "0", "0");
										dashboard_cuti_pegawai.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_cuti_pegawai");		   
										dashboard_cuti_pegawai.render("chartdiv4");
									   
										function reloadData_dashboard_cuti_pegawai(){
											var dashboard_cuti_pegawai = new FusionCharts("<?php echo base_url(); ?>Charts/Area2D.swf", "ChartId", "100%", "", "0", "0");
											dashboard_cuti_pegawai.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_cuti_pegawai");		   
											dashboard_cuti_pegawai.render("chartdiv4");
										}
                                    </script>
				            </div>
				        </div>
		    		</div>
				</div>

				<div class="row-fluid">
		    		<div class="span12">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Pegawai Per Unit</h6></div></div>
				            <div class="well body">
				            	<ul class="stats-details">
				            		<li>
				            			<strong>Update Terakhir</strong>
				            			<span>10 Mei 2013 on 4:42 pm</span>
				            		</li>
				            		<li>
				            			<div class="number">
					            			<a href="#" title="" data-toggle="dropdown"></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:reloadData_dashboard_jumlah_peg_unit();" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
											</ul>
											<span><!--$6,458--></span>
										</div>
				            		</li>
				            	</ul>
                                <div id="chartdiv5" align="center" ></div>
                                    <script type="text/javascript">
										var dashboard_jumlah_peg_unit = new FusionCharts("<?php echo base_url(); ?>Charts/Column3D.swf", "ChartId", "100%", "", "0", "0");
										dashboard_jumlah_peg_unit.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_jumlah_peg_unit");		   
										dashboard_jumlah_peg_unit.render("chartdiv5");
									   
										function reloadData_dashboard_jumlah_peg_unit(){
											var dashboard_jumlah_peg_unit = new FusionCharts("<?php echo base_url(); ?>Charts/Column3D.swf", "ChartId", "100%", "", "0", "0");
											dashboard_jumlah_peg_unit.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_jumlah_peg_unit");		   
											dashboard_jumlah_peg_unit.render("chartdiv5");
										}
                                    </script>
				            </div>
				        </div>
		    		</div>
				</div>
				
				<div class="row-fluid">
		    		<div class="span12">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Pegawai Pensiun</h6></div></div>
				            <div class="well body">
				            	<ul class="stats-details">
				            		<li>
				            			<strong>Update Terakhir</strong>
				            			<span>10 Mei 2013 on 3:09 pm</span>
				            		</li>
				            		<li>
				            			<div class="number">
					            			<a href="#" title="" data-toggle="dropdown"></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:reloadData_dashboard_jumlah_peg_pensiun();" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
											</ul>
											<span><!--$6,458--></span>
										</div>
				            		</li>
				            	</ul>
                                <div id="chartdiv6" align="center" ></div>
                                    <script type="text/javascript">
                                       var dashboard_jumlah_peg_pensiun = new FusionCharts("<?php echo base_url(); ?>Charts/Line.swf", "ChartId", "100%", "", "0", "0");
                                       dashboard_jumlah_peg_pensiun.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_jumlah_peg_pensiun");		   
                                       dashboard_jumlah_peg_pensiun.render("chartdiv6");
									   
									   function reloadData_dashboard_jumlah_peg_pensiun(){
											var dashboard_jumlah_peg_pensiun = new FusionCharts("<?php echo base_url(); ?>Charts/Line.swf", "ChartId", "100%", "", "0", "0");
											dashboard_jumlah_peg_pensiun.setDataURL("<?php echo base_url(); ?>dashboard/dashboard_jumlah_peg_pensiun");		   
											dashboard_jumlah_peg_pensiun.render("chartdiv6");
										}
										
                                    </script>
				            </div>
				        </div>
		    		</div>
		    	</div>				
		    	<!-- /earnings stats widgets -->


 
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
		    <!-- /content wrapper -->		   
						   
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>
