<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>

<script type="text/javascript"> 
 $(function() {
				
		$( "#simpan-pbapeljakat" ).click(function(){
			var err = 0;
			var periode_awal = $( "#periode_awal" ).val(); 
			var periode_akhir = $( "#periode_akhir" ).val(); 
			
			if(periode_awal == ''){
				$( "#periode_awal" ).addClass("invalid");
				err = 1;
			}		
			if(periode_akhir == ''){
				$( "#periode_akhir" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>bapeljakat/add_periode_bapeljakat",
					data: $('#form-addbapeljakatperiode').serialize(), 
					success: function(msg){	
						data = explode('#', msg);
						if(data[0] == 'success'){			
							$( "#validasi-pbapeljakat" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							window.location.assign("<?php echo base_url();?>bapeljakat");											
						}else{
							$( "#validasi-pbapeljakat" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-pbapeljakat" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
		});
		
	
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
						<li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						<li class="active"><a href="#" title="">Baperjakat</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <br />

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
				
				 
                <div class="widget">
					<div class="navbar">
						<div class="navbar-inner">
							<h6>BAHAN PERSIDANGAN USUL PENGISIAN JABATAN</h6>
						</div>
					</div>	
                    <div class="table-overflow" style="background-color: #FFF;">
						<form id="form-addbapeljakatperiode" method="post" >
							<input type="hidden" id="id_pb" name="id_pb" />
							<table cellpadding="3" cellspacing="3">								
								<tr>
									<td>&nbsp; &nbsp; &nbsp; Periode Dari</td><td>:</td>
									<td>
										<input id="periode_awal" type="text" name="periode_awal" value="" class="input-medium datepicker2" />
									</td>
								</tr>
								<tr>
									<td>&nbsp; &nbsp; &nbsp; Periode Sampai</td><td>:</td>
									<td>
										<input id="periode_akhir" type="text" name="periode_akhir" value="" class="input-medium datepicker2" />
									</td>
								</tr>
							</table>
						</form>
						<div class="form-actions">
							<a href="<?php echo base_url().'bapeljakat'; ?>" class="btn btn-primary" title="List"><< Back</a>
							<button id="simpan-pbapeljakat" class="btn btn-primary">Simpan</button>
							<div id="validasi-pbapeljakat"></div>
						</div>
						
					</div>
                    
                </div>
                <!-- /media datatable -->
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>