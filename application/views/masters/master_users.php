<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
	
<script type="text/javascript"> 
$(function() {
	$( "#dialog-users" ).hide();
	
	
	
	
	//$('#get_nip').on('change', function(){
	//var nip = $(this).find(':selected').data('nip');
	//$('#nip').val(nip);
	//});
});
		
function onEdit_users(id_user) {
	open_dialog(id_user, 'Edit Users');
}
function onAdd_users(id_user) {
	open_dialog('', 'Tambah Users');
}

function onDelete_users(id_user) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_users/do_delete_users/"+id_user,
			data: "id="+id_user, 
			success: function(msg){	
				if(msg == 'success'){		
					window.location.reload();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog(id_user, titlex) {

	$( "#id_user" ).val( id_user );
	
	////autocomplete nip
	//$("#nip_txt").autocomplete("<?php echo base_url(); ?>master_users/auto_pegawai", {
	//	width: 400,
	//	minChars:0,
	//	max:100,
	//	selectFirst: false
	//});
	//
	//$("#nip_txt").result(function(event, data, formatted) {
	//	if (data){  
	//		$("#nip_txt").val(data[0]);					
	//		$("#nip").val(data[1]);					
	//		$("#nama").val(data[2]);		
	//	}
	//});	
	
	
	if(id_user > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_users/cek_users/"+id_user,
			//data: $('#form-users').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#pegawai_id" ).val( dt[0] );
				$( "#email_user" ).val( dt[1] );
				$( "#privilege_user" ).val( dt[2] );
				$( "#status_user" ).val( dt[3] );
			}
		});
	}else{
			$( "#pegawai_id" ).val("");
			$( "#email_user" ).val("");
			$( "#passwordmd5_user" ).val("");
			$( "#privilege_user" ).val("");
			$( "#status_user" ).val("");
	}
	
	$( "#dialog-users" ).dialog({
		  autoOpen: false,
		  height: 300,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_users/save",
					data: $('#form-users').serialize(), 
					success: function(){	
						window.location.reload();
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
	
	$( "#dialog-users" ).dialog( "open" );
	
}

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
						 <li><a href="<?php echo base_url(); ?>master_data" title="">Administrasi Master Data</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>master_users" title="">Master Users</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Jabatan</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_users()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Users</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-users" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Email User</th>
                                    <th>Privilege</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_users as $row){
								?>
									<tr>
										<td><?php echo $no; ?></td>										
										<td><?php echo $row['email_user']; ?></td>
										<td><?php echo $row['privilege_user']; ?></td>
										<td><?php echo $row['status_user']; ?></td>
										<td>
											<span id="edit-rusers" onclick="javascript:onEdit_users(<?php echo $row['id_user']; ?>)" class="fam-application-edit"></span>
											<span id="delete-rusers" onclick="javascript:onDelete_users(<?php echo $row['id_user']; ?>)" class="fam-application-delete"></span>
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
<div id="dialog-users" title=""> 
	<form id="form-users">
		<input type="hidden" id="id_user" name="id_user" value="" />
		<table>
			<tr>
				<td>Nama Pegawai</td>
				<td>:</td>
				<td>
					<select name="pegawai_id" class="input-xlarge" id="get_nip">
						<option value="0">- Select Pegawai -</option>
						<?php
							$db_peg = $this->db->get('pegawai');
							foreach($db_peg->result() as $peg){
						?>
						<option value="<?php echo $peg->id?>"><?php echo $peg->nama?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<input type="hidden" name="passwordmd5_user" id="passwordmd5_user" />
			<tr>
				<td>Email User</td>
				<td>:</td>
				<td>
					<input id="email_user" type="text" name="email_user" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Privilege</td>
				<td>:</td>
				<td>
					<select id="privilege_user" name="privilege_user" class="input-large">
						<option value="">-Pilih-</option>
						<option value="Admin">Admin</option>
						<option value="Manager">Manager</option>
						<option value="Operator">Operator</option>
						<option value="User">User</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td>
					<select id="status_user" name="status_user" class="input-large">
						<option value="aktif">Aktif</option>
						<option value="tidak aktif">Tidak Aktif</option>
					</select>
				</td>
			</tr>
			
			
		</table>	
	</form>
	<div>
		Keterangan: <br>Password default sesuai NIP masing-masing user.
	</div>
</div>


	<!-- /content container -->

	
		<?php $this->load->view('layout/_footer'); ?>
</body>
</html>