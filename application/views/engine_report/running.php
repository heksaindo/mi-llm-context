<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-report" ).hide();
	
	$('#print_engine_report').click( function() {
	
		var addParam = $( "#id_running_report" ).val();
		window.open("<?php echo base_url(); ?>laporan/running_cetak/"+addParam, "", "scrollbars=1,height=700, width=1000"); 
						
	} );
});
		
function onEdit_report(id) {
	open_dialog(id, 'Edit Report');
}
function onAdd_report(id) {
	open_dialog('', 'Tambah Report');
}

function RunningReport(id,title) {
	if(confirm('Running Report: '+title+'?')){
		window.location = '<?php echo base_url(); ?>laporan/runningRpt/'+id;
	}
}
function SettingReport(id,title) {
	window.location = '<?php echo base_url(); ?>laporan/settingRpt/'+id;
}

function onDelete_report(id, title) {
	if(confirm('Delete Report: '+title+'?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>laporan/do_delete_report/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					window.location.reload();
				}else{
					alert( 'Report tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "<?php echo base_url(); ?>laporan/cek_report/"+id,
			//data: $('#form-report').serialize(), 
			success: function(response){	
				var dt = response.data;
				$( "#report_name" ).val( dt.report_name );
				$( "#report_description" ).val( dt.report_description );
			}
		});
	}else{
		$( "#report_name" ).val( "" );
		$( "#report_description" ).val( "" );
	}
	
	$( "#dialog-report" ).dialog({
		  autoOpen: false,
		  height: 200,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>laporan/do_popup_report/"+id,
					data: $('#form-report').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
						}else{
							alert( 'Report tidak dapat disimpan, cek input!' );	
						}						
					}
				});
				
				$( this ).dialog( "close" );	
			  }
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	
	$( "#dialog-report" ).dialog( "open" );
	
}

</script>
</head>
<body>
	<?php $this->load->view('layout/_top');?>
	
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
						 <li><a href="<?php echo base_url(); ?>laporan" title="">List report</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>laporan/runningRpt/<?php echo $info_report['id_report']; ?>" title=""><?php echo $info_report['report_name']; ?></a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<br/>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6><?php echo $info_report['report_name']; ?></h6>
                        </div>
                    </div>
					<div class="navbar">
                    	<!--
						<div class="navbar-inner" id="pencarian_engine_report">							
							<form id="form_pencarian_engine_report" action="" method = "post">							
								<div class="search2">								
																		
								</div>
							</form>
							
							<button id="search_duk" class="btn btn-primary">Search</button> 
							<button id="reset_duk" class="btn btn-primary">Clear</button> 	
								
                        </div>	
						<div style="float:left;">
							<button id="show_pencarian_engine_report" class="btn btn-primary">Show Pencarian</button> 
							<button id="hide_pencarian_engine_report" class="btn btn-primary">Hide Pencarian</button> 
						</div>
						-->	
						<div style="float:right;">
							<button id="print_engine_report" class="btn btn-primary">Cetak</button> 	
							<input type="hidden" value="<?php echo $info_report['id_report']; ?>" id="id_running_report">
						</div>
						<div style="clear:both;"></div>
                    </div>	
					
                    <div class="table-overflow">
                        <table id="list-report-data" class="table table-striped table-bordered table-checks media-table">
                            <thead>
								<?php 
								$all_cols = 0;
								$colspan_sums = 0;
								$header_data_ready = array();
								if(!empty($data_report['data_header_parent'])){
													
													
									$rowspan = '';
									if(!empty($data_report['use_child'])){
										$rowspan = ' rowspan="2"';
									}
									
									echo '<tr>'."\n";
									//PARENT HEADER
									$no_kolom = 1;
									foreach($data_report['data_header_parent'] as $dtheader){
										
										$header_rowspan = $rowspan;
										
										//check child
										$header_colspan = '';
										if(!empty($data_report['data_header_child'][$dtheader['id_rdd']])){
											$total_child = count($data_report['data_header_child'][$dtheader['id_rdd']]);
											$header_colspan = ' colspan="'.$total_child.'" style="text-align:center;"';
											$header_rowspan = '';
											//$all_cols += $total_child;
											
											if($total_child > 0){
												foreach($data_report['data_header_child'][$dtheader['id_rdd']] as $dtC){
													$header_data_ready[$no_kolom] = $dtC;
													$no_kolom++;
												}
											}
											
											
										}else{
											$all_cols++;											
											if($dtheader['output_format'] == 'total' AND $colspan_sums == 0){
												$colspan_sums = $all_cols;
											}											
											
											$header_data_ready[$no_kolom] = $dtheader;
											$no_kolom++;
											
										}
																				
										echo '<th'.$header_rowspan.$header_colspan.'>'.$dtheader['header_name'].'</th>'."\n";
										
									}
									echo '</tr>'."\n";
									
									if(!empty($data_report['data_header_child'])){
										echo '<tr>'."\n";
										foreach($data_report['data_header_child'] as $keyChild => $dtChild){
											if(!empty($dtChild)){
												foreach($dtChild as $dtC){
													echo '<th>'.$dtC['header_name'].'</th>'."\n";
													$all_cols++;											
													if($dtC['output_format'] == 'total' AND $colspan_sums == 0){
														$colspan_sums = $all_cols;
													}
												}
											}
										}
										echo '</tr>'."\n";
									}
								}
								?>
                            </thead>
                            <tbody>
								<?php 
								//echo '<pre>';
								//print_r($header_data_ready);
								$no = 1;				
								if(!empty($data_report['result_report'])){
									foreach ($data_report['result_report'] as $dtRes){
										
									?>
										<tr>
										<?php
										foreach($header_data_ready as $dtHeader){
											
											if(!empty($dtHeader['ref_field'])){
												$dt_value = '&nbsp;';
												if(!empty($dtRes[$dtHeader['ref_field']])){
													$dt_value = $dtRes[$dtHeader['ref_field']];
												}
												echo '<td>'.$dt_value.'</td>';
											}else
											{
												if(!empty($dtHeader['id_rtf'])){
													echo '<td>&nbsp;</td>';
												}else{
													if($dtHeader['output_format'] == 'autonumber'){
														echo '<td>'.$no.'</td>';
													}
												}
											}
											
										}
										
										/*foreach($data_report['all_header_data'] as $dtHeader){
											
											if(!empty($dtHeader['ref_field'])){
												$dt_value = '&nbsp;';
												if(!empty($dtRes[$dtHeader['ref_field']])){
													$dt_value = $dtRes[$dtHeader['ref_field']];
												}
												echo '<td>'.$dt_value.'</td>';
											}else
											{
												if(!empty($dtHeader['id_rtf'])){
													echo '<td>&nbsp;</td>';
												}else{
													if($dtHeader['output_format'] == 'autonumber'){
														echo '<td>'.$no.'</td>';
													}
												}
											}										
										}*/									
										?>
										</tr>
									<?php
										$no++;
									}
								}
								
								/*if($colspan_sums){
										
									$no_summary = 1;
									foreach($data_report['all_header_data'] as $dtHeader){
										if($no_summary == $colspan_sums){
											
										}
										$no_summary++;
									}
								}*/
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
	
	
<!-- /content Popup -->
<div id="dialog-report" title=""> 
	<form id="form-report" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Nama Report</td>
				<td>:</td>
				<td>
					<input id="report_name" type="text" name="report_name" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td>
					<input id="report_description" type="text" name="report_description" class="input-xlarge" />
				</td>
			</tr>
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>