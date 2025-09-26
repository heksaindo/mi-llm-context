<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	
	
<script type="text/javascript"> 
 $(function() {
	
		$( "#simpan-setting" ).click(function(){
			var err = 0;
			var new_password = $( "#new_password" ).val(); 
			var password2 = $( "#password2" ).val(); 
			/*
			if(new_password == ''){
				$( "#new_password" ).addClass("invalid");
				err = 1;
			}		
			if(password2 == ''){
				$( "#password2" ).addClass("invalid");
				err = 1;
			}	
			*/
			if(new_password != password2){
				$( "#new_password" ).addClass("invalid");
				$( "#password2" ).addClass("invalid");
				alert('Konfirm Password tidak sama!');
				err = 1;
			}
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>home/do_edit_setting",
					data: $('#form-setting').serialize(), 
					success: function(msg){	
						data = explode('#', msg);
						if(data[0] == 'success'){			
							$( "#validasi-setting" ).html( '<font color="blue"> Data sudah disimpan</font>' );	
						}else{
							$( "#validasi-setting" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						
						return false;
					}
				});
			}else{
				$( "#validasi-setting" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
		});
		
	
});
	
function ajaxFileUpload()
	{
		var hd_id = $( "#hd_id" ).val(); 
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'<?php echo base_url(); ?>pegawai/upload_foto/',
				secureuri:false,
				fileElementId:'fileFoto',
				dataType : 'JSON',
				data:{id:hd_id},
				success: function (data, status)
				{
					if(status == 'success')
					{
						//$('img #foto_tumb').attr('src', "<?php echo APP_URL ?>/Uploads/foto/"+data.file);
						setTimeout("location.reload(true);",1000);
						
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
	
</script>
</head>
<body>
	<?php $this->load->view('layout/_top'); ?>
	
	<!-- Content container -->
	<div id="container">
		
		<?php 
		$is_notifikasi_active = 0;
					
		$this->load->view('layout/_sidebar'); ?>
		
		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
		                <li class="active"><a href="<?php echo base_url(); ?>home/setting">Setting</a></li>
		            </ul>
					<?php 
					$this->load->view('layout/_messages'); 
					?>
			    </div>
			    <!-- /breadcrumbs line -->
				<br />
			    <?php $this->load->view('layout/_actionwrapper'); ?>
                           
				<!-- Media datatable -->
				
				 
                <div class="widget">
					<div class="navbar">
						<div class="navbar-inner">
							<h6>Setting</h6>
						</div>
					
                    <div class="table-overflow" style="background-color: #FFF; padding: 20px;">
						<input type="hidden" id="hd_id" name="hd_id" value="<?php echo get_name('pegawai','id','nip_baru', $username); ?>"/>
						<table cellpadding="3" cellspacing="3">								
								<tr>
									<td>NIP | Username</td><td>:</td>
									<td>
										<?php echo $foto_user->nip_baru; ?>
										<input type="hidden" id="username" name="username" value="<?php echo $username;?>" />
									</td>
								</tr>
								<tr>
									<td>Nama Lengkap</td><td>:</td>
									<td>
										<?php echo $foto_user->nama; ?>									
									</td>
								</tr>
						</table>
						
						<fieldset>
							<legend>Photo</legend>
							<img id="loading" src="<?php echo base_url(); ?>img/loading.gif" style="display:none;">
							<form name="form" action="" method="POST" enctype="multipart/form-data">
								&nbsp; &nbsp; &nbsp; <input id="fileFoto" type="file" size="45" name="fileFoto" accept="image/gif, image/jpeg, image/png" class="input">
								<br />
								&nbsp; &nbsp; &nbsp; <button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">Upload Foto</button>
							</form>
							
						</fieldset>
						
						<fieldset>
							<legend>Password</legend>
							<form id="form-setting" action="" method="POST">
								<table cellpadding="3" cellspacing="3">		
									<tr>
										<td>&nbsp; &nbsp; &nbsp; Password</td><td>:</td>
										<td>
											<input type="password" name="new_password" id="new_password" class="input-xlarge" />
											 &nbsp; Kosongkan jika tidak diubah!
										</td>
									</tr>
									<tr>
										<td>&nbsp; &nbsp; &nbsp; Konfirm Password</td><td>:</td>
										<td>
											<input type="password" name="password2" id="password2" class="input-xlarge" />
											&nbsp; Kosongkan jika tidak diubah!
										</td>
									</tr>
								</table>
							</form>
							<div class="form-actions">
								<button id="simpan-setting" class="btn btn-primary">Simpan</button>
								<div id="validasi-setting"></div>
							</div>
						</fieldset>
						
						
						
					</div>
                    </div>	
                </div>
                <!-- /media datatable -->
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>

</body>
</html>
