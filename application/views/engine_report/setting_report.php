<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(document).ready(function(){
	$( "#dialog-report" ).hide();
	
	//onChange group/table
	$( "#id_rtg" ).change(function() {
		var id_rtg = $( "#id_rtg" ).val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>engine_report/get_field",
			data: "id_rtg="+id_rtg, 
			success: function(msg){	
				if(msg){
					$( "#id_rtf" ).html(msg);
				}
				return false;
			}
		});
	});	
	
	$( "#id_rtf" ).change(function() {
		var get_rtf = $( "#id_rtf" ).val();
		var exp_rtf = explode('#', get_rtf);
		
		if(exp_rtf[1]){
			$( "#header_name" ).val(exp_rtf[1]);
		}
	});	
	
	load_parent_ID();
	
});
		
function load_parent_ID(id) {
	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>engine_report/get_setting_parent",
		data: "id_report=<?php echo $info_report['id_report']; ?>", 
		success: function(msg){	
			if(msg){
				$( "#parent_id" ).html(msg);
			}
			return false;
		}
	});
}
function onEdit_report(id) {
	open_dialog(id, 'Edit Field');
}
function onAdd_report(id) {
	open_dialog('', 'Tambah Field');
}

function onDelete_report(id, title) {
	if(confirm('Delete Field: '+title+'?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>engine_report/delete_setting/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					window.location.reload();
				}else{
					alert( 'Field tidak dapat dihapus!' );	
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
			url: "<?php echo base_url(); ?>engine_report/cek_setting/"+id,
			//data: $('#form-report').serialize(), 
			success: function(response){	
				var dt = response.data;
				
				$( "#id_rdd" ).val( dt.id_rdd );
				$( "#header_name" ).val( dt.header_name );
				$( "#parent_id" ).val( dt.parent_id );
				$( "#id_rtg" ).val( dt.id_rtg );
				$( "#output_format" ).val( dt.output_format );
				$( "#rdd_order" ).val( dt.rdd_order );
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>engine_report/get_field",
					data: "id_rtg="+dt.id_rtg, 
					success: function(msg){	
						if(msg){
							$( "#id_rtf" ).html(msg);							
							$( "#id_rtf" ).val( dt.id_rtf+'#'+dt.header_name );
						}
						return false;
					}
				});
			}
		});
	}else{
		$( "#id_rdd" ).val( "" );
		$( "#header_name" ).val( "" );
		$( "#parent_id" ).val( "" );
		$( "#id_rtg" ).val( "" );
		$( "#id_rtf" ).val( "" );
		$( "#output_format" ).val( "" );
		$( "#rdd_order" ).val( "" );
	}
	
	$( "#dialog-report" ).dialog({
		  autoOpen: false,
		  height: 350,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>engine_report/do_popup_setting/"+id,
					data: $('#form-report').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
						}else{
							alert( 'Field tidak dapat disimpan, cek input!' );	
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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>engine_report" title="">Engine Report</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>engine_report/setting/<?php echo $info_report['id_report']; ?>" title="">Setting Report: <?php echo $info_report['report_name']; ?></a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                
				<br/>
				<button onclick="javascript:onAdd_report()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Setting Report: <?php echo $info_report['report_name']; ?></h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-report-data" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Header Name</th>
                                    <th>Ref. Table</th>
                                    <th>Ref. Field</th>
                                    <th>Output Format</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_setting as $row){
									$id = $row['id_rdd'];
									
									if(!empty($row['parent_id'])){
										$row['header_name'] = '&nbsp; &nbsp; '.$row['header_name'];
									}
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['header_name']; ?></td>
										<td><?php echo $row['table_name']; ?></td>
										<td><?php echo $row['field_name']; ?></td>
										<td><?php echo $row['output_format']; ?></td>
										<td><?php echo $row['rdd_order']; ?></td>
										<td>
											<span onclick="javascript:onEdit_report(<?php echo $id;?>)" class="fam-application-edit"></span> &nbsp; 
											<span onclick="javascript:onDelete_report(<?php echo $id;?>, '<?php echo $row['header_name']; ?>')" class="fam-application-delete"></span>
										</td>
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
		<input type="hidden" id="id_rdd" name="id_rdd" value="" />
		<input type="hidden" id="id_report" name="id_report" value="<?php echo $info_report['id_report']; ?>" />
		<table>
			<tr>
				<td>Parent</td>
				<td>:</td>
				<td>
					<select id="parent_id" name="parent_id" class="input-xlarge">
						<option value="0">Root</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Group/Table</td>
				<td>:</td>
				<td>
					<select id="id_rtg" name="id_rtg" class="input-xlarge">
						<option value="">Pilih Group/Table</option>
						<?php
						if($data_table_group){
							foreach($data_table_group as $row){
								
								echo '<option value="'.$row['id_rtg'].'" >'.$row['group_name'].' ('.$row['ref_table'].')</option>';
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Data/Field</td>
				<td>:</td>
				<td>
					<select id="id_rtf" name="id_rtf" class="input-xlarge">
						<option value="">Pilih Data/Field</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Header Name</td>
				<td>:</td>
				<td>
					<input id="header_name" type="text" name="header_name" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Output Format</td>
				<td>:</td>
				<td>
					<select id="output_format" name="output_format" class="input-xlarge is_required">
						<option value="text">Text</option>
						<option value="autonumber">Autonumber</option>
						<option value="date">Date</option>
						<option value="currency">Currency</option>
						<option value="total">Total</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td>Order</td>
				<td>:</td>
				<td>
					<input id="rdd_order" type="text" name="rdd_order" class="input-small" />
				</td>
			</tr>
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>