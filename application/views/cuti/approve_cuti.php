<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head3'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$( "#dialog-approve" ).hide();
			
			
		});
		
        function printpage(url) {
			child = window.open(url, "", "scrollbars=1,height=800, width=700"); //Open the child in a tiny window.
		}
		
		function on_reject_cuti(id_cuti) {
			if(confirm('Reject Cuti ?')){		    
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>cuti/rejectcuti/"+id_cuti,
					data: "id_cuti="+id_cuti, 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
						}else{
							alert( 'Data tidak dapat di reject!' );	
						}						
					}
				});
			}
		}

		function on_approve_cuti(id_cuti){
		
			$( "#dialog-approve" ).dialog({
				  autoOpen: false,
				  height: 250,
				  width: 500,
				  modal: true,
				  title: 'Approval Cuti',
				  buttons: {
					"Simpan": function() {
						var bValid = true;
						var nomor_surat = $( "#nomor_surat" ).val(); 
						
						if(nomor_surat == ''){
							$( "#nomor_surat" ).addClass("invalid");
							bValid = false;
						}		
						
						if ( bValid ) {
							$.ajax({
								type: "POST",
								url: "<?php echo base_url(); ?>cuti/approvecuti/"+id_cuti,
								data: $('#form-approve').serialize(), 
								success: function(msg){	
									if(msg == 'success'){
										window.location.reload();
									}
									return false;
								}
							});
							
							$( this ).dialog( "close" );	
						}
					},
					"Batal": function() {
					  $( this ).dialog( "close" );
					}
				}
				  
			}); 
			
			$( "#dialog-approve" ).dialog( "open" );
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
		               <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>Cuti" title="">Penugasan & Kehadiran</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Approve Cuti</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<div>
				 <table>
					<tr>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>cuti" class="btn btn-block btn-info">Back</a></td>
					</tr>
				 </table>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Approval Cuti</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
									<th>Tgl Pengajuan</th>
									<th>Yang Mengajukan</th>
									<th>Jenis Cuti</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
									<th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$nomor_urut = 1;
								foreach ($data_cuti as $cuti){
									$cuti_id = $cuti['id'];
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $cuti['tgl_pengajuan'] ?></td>
										<td><?php echo $cuti['yang_mengajukan'] ?></td> 
										<td><?php echo $cuti['jenis_cuti'] ?></td> 											
										<td><?php echo $cuti['tgl_mulai'] ?></td>
										<td><?php echo $cuti['tgl_akhir'] ?></td>
										<td><?php echo $cuti['status_cuti'] ?></td>
										<td>
											<?php if ($cuti['status_cuti'] == 'submit') { ?>
											<ul class="table-controls">
												<li><a href="javascript: on_approve_cuti(<?php echo $cuti_id;?>)" class="tip" title="Approve"><i class="fam-accept"></i></a> </li>
												<li><a href="javascript: on_reject_cuti(<?php echo $cuti_id;?>)" class="tip" title="Cancel"><i class="fam-cancel"></i></a> </li>
											</ul>
											<?php } else if ($cuti['status_cuti'] == 'approved') { ?>
											<ul class="table-controls">
												<li><a onclick="printpage('<?php echo base_url(); ?>cuti/cetak/<?php echo $cuti_id;?>');" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>
											</ul>
											<?php } ?>
										</td>
									</tr>
								<?php
								$nomor_urut = $nomor_urut + 1;
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->

		    </div>
		    <!-- /content wrapper -->

			<div id="dialog-approve"> 
				<form id="form-approve" method="post" action="" >
					<div class="control-group">
						<label class="control-label">Nomor Surat</label>
						<div class="controls">
							<input id="nomor_surat" type="text" name="nomor_surat" class="input-xlarge" value="" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Tanggal Surat</label>
						<div class="controls">
							<input id="tanggal_ttd" type="text" name="tanggal_ttd" class="input-medium datepicker" value="" />
						</div>
					</div>
				</form>
			</div>
			
		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>