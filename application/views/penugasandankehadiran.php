<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head'); ?>
	<script type="text/javascript">
		function isInArray(value, array) {
			return array.indexOf(value) > -1;
		}
		/* Cuti Pegawai*/
		var cuti_data = [];
		$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>penugasandankehadiran/dashboard_cuti_pegawai",
					dataType: 'json',
					success: function(msg){
						cuti_data = msg;
					}
					
		});
		
		AmCharts.ready(function(){
			//** Cuti Pegawai **//
			var dashboard_jumlah_peg_cuti = new AmCharts.AmSerialChart();
			dashboard_jumlah_peg_cuti.type = "serial";
			dashboard_jumlah_peg_cuti.theme = "light";
			dashboard_jumlah_peg_cuti.dataLoader = {
				"url": "<?php echo base_url();?>penugasandankehadiran/dashboard_cuti_pegawai",
				"format": "json"
			};
			dashboard_jumlah_peg_cuti.legend = {
				"autoMargins": false,
				"equalWidths": false,
				"horizontalGap": 1,
				"markerSize": 4,
				"useGraphSettings": false,
				"valueAlign": "left",
				"valueWidth": 0
			};
			dashboard_jumlah_peg_cuti.valueAxes = [{
				"stackType": "regular",
				"axisAlpha": 0.5,
				"gridAlpha": 0
			}];
			var a = new Array();
			for(i=0;i<cuti_data.length;i++){
				var array = $.map(cuti_data[i], function(value, index) {
					return [index];
				});
				
				for(j=0;j<array.length;j++){
					if(!isInArray(array[j],a) && array[j] !='nama'){
						a.push(array[j]);
					}
				}
			}
			for(k=0;k<a.length;k++){
				var graph = new AmCharts.AmGraph();
				graph.balloonText = "[[title]]: <b>[[value]]</b>";
				graph.fillAlphas= 0.8;
				graph.lineAlphas = 1;
				graph.type = "column";
				graph.valueField =  a[k];
				graph.title = a[k];
				dashboard_jumlah_peg_cuti.addGraph(graph);
			}
			dashboard_jumlah_peg_cuti.rotate = true;
			dashboard_jumlah_peg_cuti.categoryField = "nama";
			dashboard_jumlah_peg_cuti.categoryAxis = {
				"gridPosition": "start",
				"axisAlpha": 0,
				"gridAlpha": 0,
				"position": "left"
			};
			//WRITE
			dashboard_jumlah_peg_cuti.write("chartdiv4");
			// END OF CUTI PEGAWAI //
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
						 <li class="active"><a href="<?php echo base_url(); ?>penugasandankehadiran" title="">Penugasan dan Kehadiran</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Penugasan dan Kehadiran</h5>
				    	<span>Dashboard Penugasan dan Kehadiran</span>
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
			                    	<h6>Dashboard Penugasan dan Kehadiran</h6>
			                    </div>
			                </div>
			                
							<div class="row-fluid well body">
			                	
								<div class="span4">
									<div class="widget">
										<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Cuti Pegawai</h6></div></div>
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
															<li><a href="#" title=""><i class="icon-refresh"></i>Reload data</a></li>
															<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>
															<li><a href="#" title=""><i class="icon-cog"></i>Parameters</a></li>
															<li><a href="#" title=""><i class="icon-download-alt"></i>Download statement</a></li>
														</ul>
														<span><!--$6,458--></span>
													</div>
												</li>
											</ul>
											<div id="chartdiv4" align="center" style="width:307px; height:150px;"> FusionCharts. </div>
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