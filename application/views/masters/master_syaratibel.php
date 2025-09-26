<!DOCTYPE>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-syaratibel" ).hide();
	
});
		
function onEdit_syaratibel(id) {
	open_dialog(id, 'Edit Syarat Izin Belajar');
}
function onAdd_syaratibel(id) {
	open_dialog('', 'Tambah Syarat Izin Belajar');
}

function onDelete_syaratibel(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_syaratibel/do_delete_syaratibel/"+id,
			data: "id="+id, 
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

function open_dialog(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_syaratibel/cek_syaratibel/"+id,
			//data: $('#form-lokasipelatihan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#uraian" ).val( dt[0] );
                $( "#mandatori" ).prop('checked', dt[1]);
			}
		});
	}else{
		$( "#uraian" ).val( "" );
        $( "#mandatori" ).prop('checked', false);
	}
	
	$( "#dialog-syaratibel" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 600,
		  modal: true,
		  title: titlex,
          resizable: false,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_syaratibel/do_popup_syaratibel/"+id,
					data: $('#form-syaratibel').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
						}else{
							alert( 'Data tidak dapat disimpan, cek input!' );	
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
	
	$( "#dialog-syaratibel" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_syaratibel" title="">Syarat Dokumen</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Lokasi Pelatihan</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_syaratibel()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Syarat Dokumen</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-syaratibel" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Uraian</th>
                                    <th width="80">Mandatori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_syaratibel as $row){
                                    if($id = $row['is_require']){
                                        $m = "Ya";
                                    }else{
                                        $m = "Tidak";
                                    }
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['uraian']; ?></td>
                                        <td style="text-align: center;"><?php echo $m; ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_syaratibel(<?php echo $row['id'];?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_syaratibel(<?php echo $row['id'];?>)" class="fam-application-delete"></span>
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
<div id="dialog-syaratibel" title=""> 
	<form id="form-syaratibel" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<div>Uraian Syarat :</div>
		<div><textarea id="uraian" name="uraian" class="input-xlarge is_required" style="width: 100%;height: 70px;"></textarea></div>
        <div>Mandatori :</div>
		<div>Check Jika Ya: <input id="mandatori" type="checkbox" name="mandatori" class="input-small" /></div>
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>