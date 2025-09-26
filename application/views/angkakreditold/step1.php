<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript"> 	

	$(document).ready(function(){
		//Initialisasi
		$( ".datepicker" ).datepicker({ 
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-10:+10"
		});
		
		$( "#next-wizard1" ).hide();
		$( ".fadd_message" ).val('');
		$( ".lbl_nip_lama" ).html( $( "#nip_lama" ).val() );						
		$( ".lbl_nip_baru" ).html( $( "#nip_baru" ).val() );						
		$( ".lbl_nama" ).html( $( "#nama" ).val() );	
		$( "#hd_nip_lama2" ).val( $( "#nip_lama" ).val() );						
		$( "#hd_nip_baru2" ).val( $( "#nip_baru" ).val() );						
		$( "#hd_nama2" ).val( $( "#nama" ).val() );	
		$( "#status_menikah" ).val( $( "#status_perkawinan" ).val() );	
		$("#nip_baru").val('');					
		$("#nama").val('');					
		$("#gelar_depan").val('');					
		$("#gelar_belakang").val('');						
		$("#no_kartu").val('');				
		$("#jenis_kelamin").val('');						
		$("#tempat_lahir").val('');					
		$("#tanggal_lahir").val('');		
		$("#hd_id").val('');	
		$("#id_golongan").val('');	
		$("#golongan").val('');	
		$("#pangkat").val('');	
		$("#tmt_pangkat").val('');	
		$("#strata").val('');	
		$("#jabatan").val('');	
		$("#pilih_golongan").val('');	
		$("#tmt_jabatan").val('');	
		$("#last_unit_kerja").val('');	
		$("#program_studi").val('');	
		
		//Wizard 1
		$( "#simpan-wizard1" ).click(function(){
			var err = 0;
			var nama = $( "#nama" ).val(); 
			var jenis_kelamin = $( "#jenis_kelamin" ).val(); 
			var nip_baru = $( "#nip_baru" ).val(); 
			var tempat_lahir = $( "#tempat_lahir" ).val(); 
			var tanggal_lahir = $( "#tanggal_lahir" ).val(); 
			var no_kartu = $( "#no_kartu" ).val(); 
			var id_golongan = $( "#id_golongan" ).val(); 
			var pilih_golongan = $( "#pilih_golongan" ).val(); 
			var pangkat = $( "#pangkat" ).val(); 
			var tmt_pangkat = $( "#tmt_pangkat" ).val(); 
			var strata = $( "#strata" ).val(); 
			var jabatan = $( "#jabatan" ).val(); 
			var tmt_jabatan = $( "#tmt_jabatan" ).val(); 
			var last_unit_kerja = $( "#last_unit_kerja" ).val(); 
			var program_studi = $( "#program_studi" ).val(); 
			
			if(nama == ''){
				$( "#nama" ).addClass("invalid");
				err = 1;
			}		
			if(jenis_kelamin == ''){
				$( "#jenis_kelamin" ).addClass("invalid");
				err = 1;
			}
			if(nip_baru == ''){
				$( "#nip_baru" ).addClass("invalid");
				err = 1;
			}
			if(tempat_lahir == ''){
				$( "#tempat_lahir" ).addClass("invalid");
				err = 1;
			}
			if(tanggal_lahir == ''){
				$( "#tanggal_lahir" ).addClass("invalid");
				err = 1;
			}
			if(no_kartu == ''){
				$( "#no_kartu" ).addClass("invalid");
				err = 1;
			}	
			if(id_golongan == ''){
				$( "#id_golongan" ).addClass("invalid");
				err = 1;
			}	
			if(pilih_golongan == ''){
				$( "#pilih_golongan" ).addClass("invalid");
				err = 1;
			}	
			if(pangkat == ''){
				$( "#pangkat" ).addClass("invalid");
				err = 1;
			}	
			if(tmt_pangkat == ''){
				$( "#tmt_pangkat" ).addClass("invalid");
				err = 1;
			}	
			if(strata == ''){
				$( "#strata" ).addClass("invalid");
				err = 1;
			}	
			if(jabatan == ''){
				$( "#jabatan" ).addClass("invalid");
				err = 1;
			}	
			if(tmt_jabatan == ''){
				$( "#tmt_jabatan" ).addClass("invalid");
				err = 1;
			}	
			if(last_unit_kerja == ''){
				$( "#last_unit_kerja" ).addClass("invalid");
				err = 1;
			}	
			if(program_studi == ''){
				$( "#program_studi" ).addClass("invalid");
				err = 1;
			}	
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>angkakredit/do_add_wizard1",
					data: $('#form-wizard1').serialize(), 
					success: function(msg){	
						var xdata = explode('#', msg);
						//alert(msg);
						if(xdata[0] == 'success'){					
							$( "#validasi-wizard1" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							
							window.location.replace("<?php echo base_url(); ?>angkakredit/step2/"+ xdata[1] + '/' + xdata[2]);
						}else{
							$( "#validasi-wizard1" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-wizard1" ).html( '<font color="red"> Input Salah, Silahkan cek input warna merah!</font>' );	
			}
		});	
		
		//check NIP
		$("#nip_baru").autocomplete("<?php echo base_url(); ?>angkakredit/check_nip_baru/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});
		
		$("#nip_baru").result(function(event, data, formatted) {
			if (data[0] != 'error'){  
				$("#nip_baru").val(data[1]);					
				$("#nama").val(data[2]);					
				$("#gelar_depan").val(data[3]);					
				$("#gelar_belakang").val(data[4]);					
				$("#no_kartu").val(data[5]);					
				$("#jenis_kelamin").val(data[6]);				
				$("#tempat_lahir").val(data[7]);					
				$("#tanggal_lahir").val(data[8]);					
				$("#hd_id").val(data[9]);					
				$("#golongan").val(data[10]);	
				$("#pangkat").val(data[11]);					
				$("#tmt_pangkat").val(data[12]);					
				$("#id_golongan").val(data[13]);		
				$("#pilih_golongan option:selected").val(data[13] +'#'+ data[10]);									
				$("#pilih_golongan option:selected").text(data[10]);									
				$("#jabatan").val(data[14]);	
				$("#tmt_jabatan").val(data[15]);	
				$("#last_unit_kerja option:selected").val(data[16]);									
				$("#last_unit_kerja option:selected").text(data[17]);					
				$("#strata option:selected").val(data[18]);									
				$("#strata option:selected").text(data[19]);					
				$("#program_studi").val(data[20]);	
			}
		});			
			
		//onChange pilih_golongan
		$( "#pilih_golongan" ).change(function() {
			var pil_gol = $( "#pilih_golongan" ).val();
			var exp_pil_gol = explode('#',pil_gol);
			$( "#id_golongan" ).val(exp_pil_gol[0]);
			$( "#golongan" ).val(exp_pil_gol[1]);
			if(exp_pil_gol[1]){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/change_golongan",
					data: "golongan1="+ exp_pil_gol[1], 
					success: function(msg){	
						if(msg){
							$( "#pangkat" ).val(msg);
						}
						return false;
					}
				});
			}
		});	
		
		//onChange pilih_rencana_jabatan
		$( "#pilih_rencana_jabatan" ).change(function() {
			var rencana_jabatan = $( "#pilih_rencana_jabatan" ).val();
			var exp_rencana_jabatan = explode('#',rencana_jabatan);
			$( "#rencana_id_ak" ).val(exp_rencana_jabatan[0]);
			$( "#rencana_id_jabatan" ).val(exp_rencana_jabatan[1]);
			$( "#rencana_id_golongan" ).val(exp_rencana_jabatan[2]);
		});	
		
	});
				
	</script>
<style>
.content-add {
	margin: 5px; 0px 5px 0px;
}
</style>

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
						<li class="active"><a href="#" title="">Angka Kredit</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Pengajuan Angka Kredit</h5>
			    	</div>
					<div class="page-title-right">
						<a href="<?php echo base_url(); ?>angkakredit/histori" title="" class="btn btn-primary" >Histori Angka Kredit</a>
					</div>
			    </div>
				
			     <!-- /page header -->				
			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<div>
					<form id="form-wizard1" class="form-horizontal row-fluid well" method="post" action="" >
						<input type="hidden" id="hd_id" name="hd_id" />
						<div class="control-group">
							<label class="control-label">NIP / NRP Baru  :</label>
							<div class="controls">
								<input id="nip_baru" type="text" name="nip_baru" value="" onkeyup="NumberOnly(this)" class="input-xlarge uppercase" />
								<span id="cek_nip_baru"></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Nama  :</label>
							<div class="controls">
								<input id="nama" type="text" name="nama" value="" class="input-xlarge" />
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Gelar Depan  :</label>
							<div class="controls">
								<input id="gelar_depan" type="text" name="gelar_depan" value="" class="input-medium " />
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Gelar Belakang  :</label>
							<div class="controls">
								<input id="gelar_belakang" type="text" name="gelar_belakang" value="" class="input-medium " />
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">No Kartu Pegawai  :</label>
							<div class="controls">
								<input id="no_kartu" type="text" name="no_kartu" value="" class="input-xlarge uppercase" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Jenis Kelamin  :</label>
							<div class="controls">
								<select id="jenis_kelamin" name="jenis_kelamin" class="input-medium">
									<option value=""> </option>
									<option value="Laki-laki">Laki-laki </option>
									<option value="Perempuan">Perempuan  </option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tempat Lahir  :</label>
							<div class="controls">
								<input id="tempat_lahir" type="text" name="tempat_lahir" value="" class="input-xlarge uppercase" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tanggal Lahir  :</label>
							<div class="controls">
								<input id="tanggal_lahir" type="text" name="tanggal_lahir" value="" class="input-medium datepicker uppercase" />
							</div>
						</div>		
						<div class="control-group">
							<label class="control-label">Golongan  :</label>
							<div class="controls">
								<select id="pilih_golongan" name="pilih_golongan" class="input-medium is_required">
									<option value=""> </option>
									<?php
									if($data_golongan){
										foreach($data_golongan as $row){
											
											echo "<option value='".$row->id_golongan."#".$row->kode_golongan."' >".$row->kode_golongan."</option>";
										}
									}
									?>
								</select>
								<input id="id_golongan" type="hidden" name="id_golongan" class="input-large is_required"/>
								<input id="golongan" type="hidden" name="golongan" class="input-large is_required"/>
								
							</div>
						</div>		
						<div class="control-group">
							<label class="control-label">Pangkat  :</label>
							<div class="controls">
								<input id="pangkat" type="text" name="pangkat" class="input-large is_required" readonly="readonly"/>
							</div>
						</div>		
						<div class="control-group">
							<label class="control-label">TMT Kepangkatan  :</label>
							<div class="controls">
								<input id="tmt_pangkat" type="text" name="tmt_pangkat" class="input-medium datepicker uppercase" />
							</div>
						</div>	
						<div class="control-group">
							<label class="control-label">Pendidikan  :</label>
							<div class="controls">
								<select id="strata" name="strata" class="input-large is_required">
									<option value=""> </option>
									<?php
									if($data_strata){
										foreach($data_strata as $row){
											
											echo "<option value='".$row->id_strata."' >".$row->nama_strata."</option>";
										}
									}
									?>
								</select>
								&nbsp;Program Studi : 
								<input id="program_studi" type="text" name="program_studi" class="input-large" />
							</div>
						</div>	
						<div class="control-group">
							<label class="control-label">Jabatan  :</label>
							<div class="controls">
								<select id="jabatan" name="jabatan" class="input-large is_required">
									<option value=""> </option>
									<?php
										foreach($data_jabatan as $row){
											
											echo "<option value='".$row->id_jabatan."' >".$row->nama_jabatan."</option>";
										}
									?>
								</select>
							</div>
						</div>		
						<div class="control-group">
							<label class="control-label">TMT Jabatan  :</label>
							<div class="controls">
								<input id="tmt_jabatan" type="text" name="tmt_jabatan" class="input-medium datepicker" />
							</div>
						</div>							
						<div class="control-group">
							<label class="control-label">Unit Kerja</label>
							<div class="controls">
								<select id="last_unit_kerja" name="last_unit_kerja" class="input-xlarge">
									<option value=""></option>
									<?php
										foreach($data_unit_kerja as $row){
											$selected = '';	
											//if(strtoupper($data_tempatkerja->unit_kerja) == strtoupper($row->kode_unit_kerja)){
											//	$selected =  'selected = "selected"'; 
											//}
											echo "<option value='".$row->kode_unit_kerja."' ".$selected.">".$row->nama_unit_kerja."</option>";
										}
									?>
								</select>
							</div>
						</div> 			
						<div class="control-group">
							<label class="control-label">Masa Penilaian</label>
							<div class="controls">
								<input id="periode_awal" type="text" name="periode_awal" class="input-medium datepicker" />
								&nbsp; S/d &nbsp;
								<input id="periode_akhir" type="text" name="periode_akhir" class="input-medium datepicker" />
							</div>
						</div> 			
						<div class="control-group">
							<label class="control-label">Rencana Jabatan  :</label>
							<div class="controls">
								<select id="pilih_rencana_jabatan" name="pilih_rencana_jabatan" class="input-large is_required">
									<option value=""> </option>
									<?php
										foreach($data_rencana_jabatan as $row){
											
											echo "<option value='".$row->id_ak."#".$row->id_jabatan."#".$row->id_golongan."' >".$row->nama_jabatan." / ".$row->nama_golongan." (".$row->kode_golongan.")</option>";
										}
									?>
								</select>
								<input id="rencana_id_ak" type="hidden" name="rencana_id_ak" class="input-large is_required"/>
								<input id="rencana_id_jabatan" type="hidden" name="rencana_id_jabatan" class="input-large is_required"/>
								<input id="rencana_id_golongan" type="hidden" name="rencana_id_golongan" class="input-large is_required"/>
							</div>
						</div>	
						
					</form>
					<div class="form-actions">
						<button id="simpan-wizard1" class="btn btn-primary">Next >></button> 
						<div id="validasi-wizard1"></div>
					</div>		
				
				</div>
				
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