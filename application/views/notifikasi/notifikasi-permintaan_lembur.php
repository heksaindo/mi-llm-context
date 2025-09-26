<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<meta http-equiv="content-type" content="text/html"  charset="utf-8" />
	<?php $this->load->view('layout/_head3'); ?>
	<script type="text/javascript"> 
		$(function() {
			$( "#dialog-message" ).hide();
			
		});
				
		function onRead_Message(id, title) {
			open_dialog(id, title);
		}
				
		function open_dialog(id, titlex) {

			$( "#id" ).val( id );
			
			if(id > 0){
				$.ajax({
					dataType: "json",
					type: "POST",
					url: "<?php echo base_url(); ?>notifikasi/read_msg/",
					data: {
						id: id
					}, 
					success: function(response){
						var dt = response.data;
						
						$( "#msg_id" ).val( dt.id );
						$( "#msg_nama" ).val( dt.msg_nama );
						$( "#msg_from" ).val( dt.msg_from );
						$( "#msg_subject" ).val( dt.msg_subject );
						$( "#msg_text" ).val( dt.msg_text );
					}
				});
			}else{
				$( "#msg_id" ).val( "" );
				$( "#msg_nama" ).val( "" );
				$( "#msg_from" ).val( "" );
				$( "#msg_subject" ).val( "" );
				$( "#msg_text" ).val( "" );
				alert('Pembacaan Pesan Gagal!');
				return false;
			}
			
			$( "#dialog-message" ).dialog({
				  autoOpen: false,
				  height: 450,
				  width: 500,
				  modal: true,
				  title: titlex,
				  buttons: {
					"Tutup": function() {
					  $( this ).dialog( "close" );
					}
				 },
				  
			}); 
			
			$( "#dialog-message" ).dialog( "open" );
			
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
						<li class="active"><a href="<?php echo base_url().$notifikasi_tipe; ?>" title=""><?php echo $title; ?></a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5><?php echo $title; ?></h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List <?php echo $title; ?></h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Subject</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_message as $row){
									$id = $row['id'];
									
									$getStatus = '<font color="green"><b>Sudah Di Baca<b></font>';
									if($row['is_read'] == 'N'){
										$getStatus = '<font color="red"><b>Belum Di Baca<b></font>';
									}
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['gelar_depan'].' '.ucwords(strtolower($row['msg_nama'])).', '.$row['gelar_belakang']; ?></td>
										<td><?php echo $row['msg_from']; ?></td>
										<td><?php echo $row['msg_subject']; ?></td>
										<td><?php echo $row['msg_date']; ?></td>
										<td><?php echo $getStatus; ?></td>
										<td>
											<span onclick="javascript:onRead_Message(<?php echo $id;?>,'<?php echo $row['msg_subject']; ?>')" class="fam-application-edit" style="cursor:pointer;"></span>
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
	<div id="dialog-message" title=""> 
		<form id="form-message" method="post" action="" >
			<input type="hidden" id="msg_id" name="msg_id" value="" />
			<table>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>
						<input id="msg_nama" type="text" name="msg_nama" class="input-xlarge" />
					</td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td>
						<input id="msg_from" type="text" name="msg_from" class="input-xlarge" />
					</td>
				</tr>
				<tr>
					<td>Subject</td>
					<td>:</td>
					<td>
						<input id="msg_subject" type="text" name="msg_subject" class="input-xlarge" />
					</td>
				</tr>
				<tr>
					<td>Isi Pesan</td>
					<td>:</td>
					<td>
						<textarea id="msg_text" name="msg_text" cols="50" rows="10">
						</textarea>
					</td>
				</tr>				
				
			</table>	
		</form>
	</div>

	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>

</body>
</html>