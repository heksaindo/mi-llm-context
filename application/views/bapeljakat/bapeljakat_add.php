<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
	
<script type="text/javascript"> 
 $(function() {
	//autocomplete bapeljakat
		$("#pejabat_lama").autocomplete("<?php echo base_url(); ?>bapeljakat/auto_pegawai", {
			width: 400,
			minChars:0,
			max:100,
			selectFirst: false
		});
		
		$("#pejabat_lama").result(function(event, data, formatted) {
			if (data){  
				$("#pejabat_lama").val(data[2]);					
				$("#pejabat_nip").val(data[1]);					
				$("#golongan_lama").val(data[3]);					
				$("#pangkat_lama").val(data[4]);					
				
			}
		});	
		
	
		$( "#simpan-bapeljakat" ).click(function(){
			var err = 0;
			var unit_kerja_pengusul = $( "#unit_kerja_pengusul" ).val(); 
			var jabatan_usulan = $( "#jabatan_usulan" ).val(); 
			var pejabat_nip = $( "#pejabat_nip" ).val(); 
			
			if(unit_kerja_pengusul == ''){
				$( "#unit_kerja_pengusul" ).addClass("invalid");
				err = 1;
			}		
			if(jabatan_usulan == ''){
				$( "#jabatan_usulan" ).addClass("invalid");
				err = 1;
			}	
			if(pejabat_nip == ''){
				$( "#pejabat_nip" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>bapeljakat/add_bapeljakat",
					data: $('#form-addbapeljakat').serialize(), 
					success: function(msg){	
						data = explode('#', msg);
						if(data[0] == 'success'){			
							$( "#validasi-bapeljakat" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							window.location.assign("<?php echo base_url();?>bapeljakat/bapeljakat_detail/"+data[1]+"/"+data[2]);											
						}else{
							$( "#validasi-bapeljakat" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-bapeljakat" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
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
							<h6>BAHAN PERSIDANGAN USUL PENGISIAN JABATAN - Periode <?php echo $periode_name;?></h6>
						</div>
					</div>	
                    <div class="table-overflow" style="background-color: #FFF;">
						<form id="form-addbapeljakat" method="post" >
							<input id="id_pb" type="hidden" name="id_pb" value="<?php echo $id_pb;?>" />
							<table cellpadding="3" cellspacing="3">
								<tr>
									<td>Unit Kerja Pengusul</td><td>:</td>
									<td>
										<select id="unit_kerja_pengusul" name="unit_kerja_pengusul" class="input-xxlarge">
											<option value=""></option>
											<?php
												foreach($data_unit_kerja as $row){
													$selected = '';	
													if(strtoupper($data_tempatkerja->unit_kerja_pengusul) == strtoupper($row->kode_unit_kerja)){
														$selected =  'selected = "selected"'; 
													}
													echo "<option value='".$row->kode_unit_kerja."' ".$selected.">".$row->nama_unit_kerja."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Jabatan Yang Akan Diisi</td><td>:</td>
									<td>
										<select name="jabatan_usulan" id="jabatan_usulan" class="input-xxlarge">
											<option value=""></option>
											<?php
												foreach($data_jabatan as $row){
													
													echo "<option value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="3">Pejabat Lama</td>
								</tr>
								<tr>
									<td>&nbsp; &nbsp; &nbsp; Nama</td><td>:</td>
									<td>
										<input name="pejabat_lama" id="pejabat_lama" class="input-xxlarge" type="text" />
										<input name="pejabat_nip" id="pejabat_nip" type="hidden" />
									</td>
								</tr>
								<tr>
									<td>&nbsp; &nbsp; &nbsp; Pangkat/Golongan</td><td>:</td>
									<td>
										<input name="pangkat_lama" id="pangkat_lama" class="input-xlarge" type="text" />
										<input name="golongan_lama" id="golongan_lama" class="input-small" type="text" />
										
									</td>
								</tr>
								<tr>
									<td>&nbsp; &nbsp; &nbsp; Keterangan</td><td>:</td>
									<td>
									<input name="keterangan" id="keterangan" class="input-xxlarge" type="text" />
									</td>
								</tr>
								
							</table>
						</form>
						<div class="form-actions">
							<a href="<?php echo base_url(); ?>bapeljakat/bapeljakat_list/<?php echo $id_pb;?>" class="btn btn-primary" title="List"><< Back</a>
							<button id="simpan-bapeljakat" class="btn btn-primary">Simpan</button>
							<div id="validasi-bapeljakat"></div>
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