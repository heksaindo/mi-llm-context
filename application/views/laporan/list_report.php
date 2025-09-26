<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-report" ).hide();
	
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
				$( "#report_header" ).val( dt.report_header );
				$( "#report_footer_left" ).val( dt.report_footer_left );
				$( "#report_footer_center" ).val( dt.report_footer_center );
				$( "#report_footer_right" ).val( dt.report_footer_right );
			}
		});
	}else{
		$( "#report_name" ).val( "" );
		$( "#report_description" ).val( "" );
		$( "#report_header" ).val( "" );
		$( "#report_footer_left" ).val( "" );
		$( "#report_footer_center" ).val( "" );
		$( "#report_footer_right" ).val( "" );
	}
	
	$( "#dialog-report" ).dialog({
		  autoOpen: false,
		  height: 500,
		  width: 700,
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
						 <li class="active"><a href="<?php echo base_url(); ?>engine_report" title="">List Report</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                      
				<br/>
                <?php 
				if($privilege != 'User'){ ?>
				<!--<button onclick="javascript:onAdd_report()"  class="btn btn-primary">Tambah</button>-->				
				<?php } ?>
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Report</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-report-data" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Report</th>
                                    <th>Keterangan</th>
                                    <th>Run Report</th>
                                    <?php if($privilege != 'User'){ ?>
                                    <!--
									<th>Setting Report</th>
                                    <th>Action</th>
									-->
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_report as $row){
									$id = $row['id_report'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['report_name']; ?></td>
										<td><?php echo $row['report_description']; ?></td>
										<td><span onclick="javascript:RunningReport(<?php echo $id;?>, '<?php echo $row['report_name']; ?>')" class="fam-application-lightning"></span></td>
										<?php if($privilege != 'User'){ ?>
                                        <!--
										<td><span onclick="javascript:SettingReport(<?php echo $id;?>, '<?php echo $row['report_name']; ?>')" class="fam-application-form-edit"></span></td>
										<td>
											<span onclick="javascript:onEdit_report(<?php echo $id;?>)" class="fam-application-edit"></span> &nbsp; 
											<span onclick="javascript:onDelete_report(<?php echo $id;?>, '<?php echo $row['report_name']; ?>')" class="fam-application-delete"></span>
										</td>
										-->
                                        <?php } ?>
									</tr>
								<?php
								$no++;
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
			<tr>
				<td>Report Header</td>
				<td>:</td>
				<td>
					<textarea cols="400" rows="8" id="report_header" name="report_header" class="input-xxlarge"></textarea>
				</td>
			</tr>			
			<tr>
				<td>Report Footer Left</td>
				<td>:</td>
				<td>
					<textarea cols="400" rows="8" id="report_footer_left" name="report_footer_left" class="input-xxlarge"></textarea>
				</td>
			</tr>			
			<tr>
				<td>Report Footer Center</td>
				<td>:</td>
				<td>
					<textarea cols="400" rows="8" id="report_footer_center" name="report_footer_center" class="input-xxlarge"></textarea>
				</td>
			</tr>			
			<tr>
				<td>Report Footer Right</td>
				<td>:</td>
				<td>
					<textarea cols="400" rows="8" id="report_footer_right" name="report_footer_right" class="input-xxlarge"></textarea>
				</td>
			</tr>	
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>