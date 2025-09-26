<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(document).ready(function(){
	$( "#dialog-bup" ).hide();
	
});


function onEdit_bup(id) {
	open_dialog(id, 'Atur Batas Usia Pensiun');
}

/*function onAdd_bup(){
	open_dialog('', 'Tambah Batas Usia Pensiun');
}*/

/*function onDelete_bup(id) {
	if(confirm('Delete data ?')){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_bup/do_delete/",
			data: {id:id}, 
			success: function(data){
				var d = JSON.parse(data);
				if(d.success){		
					window.location.reload();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}
*/

function open_dialog(id, titlex) {

	$( "#id" ).val( id );
	if(id !==""){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_bup/cek_bup/",
			data:{eselon:id},
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_eselon" ).val(dt[1]);
				$( "#bup" ).val( dt[5] );
			}
		});
	}else{
		$( "#nama_eselon" ).val( "" );
		$( "#bup" ).val( "" );
	}
	
	$( "#dialog-bup" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_bup/do_popup_bup/"+id,
					data: $('#form-bup').serialize(), 
					success: function(data){
						var d = JSON.parse(data);
						if(d.success){		
							window.location.reload();
						}else{
							alert(d.msg);	
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
	
	$( "#dialog-bup" ).dialog( "open" );
	
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
						 <li><a href="<?php echo base_url(); ?>master_data" title="">Administrasi Master Data</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>master_bup" title="">Master BUP</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Golongan</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                <!--<button onclick="javascript:onAdd_bup()"  class="btn btn-primary">Tambah</button>-->				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master BUP</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-golongan" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Eselon</th>
                                    <th>Batas Usia Pensiun (th)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_bup as $row){
									$id = $row['id_eselon'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_eselon']; ?></td>
										<td><?php echo $row['bup']; ?></td>
										<td>
											<span id="edit-rbup" onclick="javascript:onEdit_bup('<?php echo $id;?>')" class="fam-application-edit"></span>
											<!--<span id="delete-rbup" onclick="javascript:onDelete_bup('<?php echo $id;?>')" class="fam-application-delete"></span>-->
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
<div id="dialog-bup" title=""> 
	<form id="form-bup" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Eselon</td>
				<td>:</td>
				<td>
					<input type="text" id="nama_eselon" name="nama_eselon" value="" readonly/>
				</td>
			</tr>
			
			<tr>
				<td>Batas Usia Pensiun</td>
				<td>:</td>
				<td>
					<input id="bup" type="text" name="bup" class="input-small is_required" />
				</td>
			</tr>
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>