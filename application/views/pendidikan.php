<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head'); ?>
	<script type="text/javascript">
		function isInArray(value, array) {
			return array.indexOf(value) > -1;
		}
		  /* Pendidikan */
		var pend_data = [];
		$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>dashboard/dashboard_perpendidikan",
					dataType: 'json', 
					success: function(msg){
						pend_data = msg;
					}
		});
		AmCharts.ready(function(){
			//**Pendidikan Graph Serial Chart**//
			
			var dashboard_jumlah_peg_pendidikan = new AmCharts.AmSerialChart();
			dashboard_jumlah_peg_pendidikan.dataProvider= pend_data;
			dashboard_jumlah_peg_pendidikan.categoryField = "nama";
            dashboard_jumlah_peg_pendidikan.plotAreaBorderAlpha = 0.2;
            dashboard_jumlah_peg_pendidikan.rotate = false;
			dashboard_jumlah_peg_pendidikan.depth3D = 20;
            dashboard_jumlah_peg_pendidikan.angle = 30;
			dashboard_jumlah_peg_pendidikan.graphs = [{
				"balloonText": "[[category]]: <b>[[value]]</b>",
				"fillColorsField": "color",
				"fillAlphas": 1,
				"lineAlpha": 0.1,
				"type": "column",
				"valueField": "total"
			}];
			dashboard_jumlah_peg_pendidikan.categoryAxis = {
				"gridPosition": "start",
				"labelRotation": 0
			};
			// WRITE
			dashboard_jumlah_peg_pendidikan.write("chartdiv3");
			//END of Peg.pendidikan
		});
		
		
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
						 <li class="active"><a href="<?php echo base_url(); ?>pendidikan" title="">Pendidikan & Pelatihan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->
				
			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Pendidikan dan Pelatihan</h5>
				    	<span>Dashboard Pendidikan dan Pelatihan</span>
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
			                    	<h6>Dashboard Pendidikan dan Pelatihan</h6>
			                    </div>
			                </div>
			                <div class="row-fluid well body">
			                	
								<div class="span4">
									<div class="widget">
										<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Per Tingkat Pendidikan</h6></div></div>
										<div class="well body">
											<ul class="stats-details">
												<li>
													<strong>Update Terakhir</strong>
													<span><?php echo $this->local_time_format->fullDate(date('Y-m-d'),'d mmmm yyyy');?></span>
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
											<div id="chartdiv3" align="center" style="width:307px; height:150px;"></div>
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