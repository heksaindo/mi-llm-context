<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head'); ?>
	<script type="text/javascript">
		function isInArray(value, array) {
			return array.indexOf(value) > -1;
		}
		
		/**
		 *Golongan
		 */
		var gol_data = [];
		$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>administrasipegawai/dashboard_pergolongan",
					dataType: 'json', 
					success: function(msg){
						gol_data = msg;
					}
		});
		/* Pensiun */
		var pensi_data = [];
		$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>administrasipegawai/dashboard_total_pensiun",
					dataType: 'json',
					success: function(msg){
						pensi_data = msg;
					}
		});

		
		AmCharts.ready(function(){
			// **Pegawai Unit PIE CHART		**//									
			var dashboard_jumlah_peg_unit = new AmCharts.AmPieChart();
			// title of the chart
			dashboard_jumlah_peg_unit.dataLoader = {
				"url": "<?php echo base_url(); ?>administrasipegawai/dashboard_jumlah_peg_unit",
				"format": "json"
			};
			dashboard_jumlah_peg_unit.type = 'pie';
			dashboard_jumlah_peg_unit.titleField = "nama";
			dashboard_jumlah_peg_unit.valueField = "total";
			dashboard_jumlah_peg_unit.colorField = "cl";
			dashboard_jumlah_peg_unit.sequencedAnimation = true;
			dashboard_jumlah_peg_unit.startEffect = "elastic";
			dashboard_jumlah_peg_unit.innerRadius = "0";
			dashboard_jumlah_peg_unit.startDuration = 2;
			dashboard_jumlah_peg_unit.labelRadius = 5;
			dashboard_jumlah_peg_unit.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b></span>";
			dashboard_jumlah_peg_unit.depth3D = 10;
			dashboard_jumlah_peg_unit.angle = 30;
			dashboard_jumlah_peg_unit.outlineAlpha = 0.4;
			// WRITE
			dashboard_jumlah_peg_unit.write("chartdiv5");
			//END of Pegawai.unit
			
			//** Golongan Stacked Chart Serial **//
			
			var dashboard_jumlah_peg_golongan = new AmCharts.AmSerialChart();
			dashboard_jumlah_peg_golongan.type = "serial";
			dashboard_jumlah_peg_golongan.theme = "light";
			dashboard_jumlah_peg_golongan.depth3D = 20;
            dashboard_jumlah_peg_golongan.angle = 30;
			dashboard_jumlah_peg_golongan.dataProvider = gol_data;
			dashboard_jumlah_peg_golongan.legend = {
				"autoMargins": false,
				"equalWidths": false,
				"horizontalGap": 1,
				"markerSize": 3,
				"position": "right",
				"useGraphSettings": false,
				"valueAlign": "left",
				"valueWidth": 0
			};
			dashboard_jumlah_peg_golongan.valueAxes = [{
				"stackType": "regular",
				"axisAlpha": 1,
				"gridAlpha": 0.3
			}];
			var a = new Array();
			for(i=0;i<gol_data.length;i++){
				var array = $.map(gol_data[i], function(value, index) {
					return [index];
				});
				
				for(j=0;j<array.length;j++){
					if(!isInArray(array[j],a) && array[j] !='golongan'){
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
				dashboard_jumlah_peg_golongan.addGraph(graph);
			}
			dashboard_jumlah_peg_golongan.categoryField = "golongan";
			dashboard_jumlah_peg_golongan.categoryAxis = {
				"gridPosition": "start",
				"axisAlpha": 1,
				"gridAlpha": 0.3,
				"position": "left"
			};
			
			// WRITE
			dashboard_jumlah_peg_golongan.write("chartdiv2");
			//END of Peg.golongan
			
			//** Pensiun Stacked Chart Serial **//
			
			var dashboard_jumlah_peg_pensiun = new AmCharts.AmSerialChart();
			dashboard_jumlah_peg_pensiun.type = "serial";
			dashboard_jumlah_peg_pensiun.theme = "light";
			dashboard_jumlah_peg_pensiun.depth3D = 20;
            dashboard_jumlah_peg_pensiun.angle = 30;
			dashboard_jumlah_peg_pensiun.dataProvider = pensi_data;
			dashboard_jumlah_peg_pensiun.valueAxes = [{
				"stackType": "regular",
				"axisAlpha": 1,
				"gridAlpha": 0.3
			}];
			
			var a = new Array();
			for(i=0;i<pensi_data.length;i++){
				var array = $.map(pensi_data[i], function(value, index) {
					return [index];
				});
				
				for(j=0;j<array.length;j++){
					if(!isInArray(array[j],a) && array[j] !='tahun'){
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
				graph.fillColorsField = "cl";
				dashboard_jumlah_peg_pensiun.addGraph(graph);
			}
			dashboard_jumlah_peg_pensiun.categoryField = "tahun",
			dashboard_jumlah_peg_pensiun.categoryAxis = {
				"gridPosition": "start",
				"axisAlpha": 1,
				"gridAlpha": 0.3,
				"position": "left"
			};
			//WRITE
			dashboard_jumlah_peg_pensiun.write("chartdiv6");
			// END OF PENSIUN PEGAWAI //
			
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
						 <li class="active"><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Administrasi Pegawai</h5>
				    	<span>Dashboard Administrasi Pegawai</span>
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
			                    	<h6>Dashboard Administrasi Pegawai</h6>
			                    </div>
			                </div>
			                <div class="row-fluid well body">
			                	
								<div class="span4">
									<div class="widget">
										<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Per Golongan</h6></div></div>
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
															<li><a href="javascript:reloadData_dashboard_pergolongan();" title=""><i class="icon-refresh"></i>Reload data</a></li>
															<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
														</ul>
														<span><!--$6,458--></span>
													</div>
												</li>
											</ul>
											<div id="chartdiv2" align="center" style="width:307px; height:150px;">chartdiv2</div>
										</div>
									</div>
								</div>
								<div class="span4">
									<div class="widget">
										<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Pegawai Per Unit</h6></div></div>
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
															<li><a href="javascript:reloadData_dashboard_jumlah_peg_unit();" title=""><i class="icon-refresh"></i>Reload data</a></li>
															<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
														</ul>
														<span><!--$6,458--></span>
													</div>
												</li>
											</ul>
											<div id="chartdiv5" align="center" style="width:307px; height:150px;">chartdiv5</div>
										</div>
									</div>
								</div>

								<div class="span4">
									<div class="widget">
										<div class="navbar"><div class="navbar-inner"><h6>Statistik Jumlah Pegawai Pensiun</h6></div></div>
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
															<li><a href="javascript:reloadData_dashboard_jumlah_peg_pensiun();" title=""><i class="icon-refresh"></i>Reload data</a></li>
															<!--<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>-->
														</ul>
														<span><!--$6,458--></span>
													</div>
												</li>
											</ul>
											<div id="chartdiv6" align="center" style="width:307px; height:150px;">chartdiv6</div>
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