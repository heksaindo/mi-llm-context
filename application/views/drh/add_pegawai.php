<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<script type="text/javascript"> 	

	$(document).ready(function(){
		//Initialisasi
		$( ".datepicker" ).datepicker({ 
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-90:+0"
		});
		
		$('ul.nav-tabs li a').click(function(){  
			if ($('ul.nav-tabs li').hasClass('active')) {
				$('ul.nav-tabs li').removeClass('active');
				//$(this).addClass('active'); 
				$('ul.nav-tabs li.tab1').addClass('active'); 
			}		
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
		
		//Wizard 1
		$( "#simpan-wizard1" ).click(function(){
			var err = 0;
			var nama = $( "#nama" ).val(); 
			var jenis_kelamin = $( "#jenis_kelamin" ).val(); 
			var nip_baru = $( "#nip_baru" ).val(); 
			var nip_lama = $( "#nip_lama" ).val(); 
			var tempat_lahir = $( "#tempat_lahir" ).val(); 
			var tanggal_lahir = $( "#tanggal_lahir" ).val(); 
			var no_kartu = $( "#no_kartu" ).val(); 
			
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
			if(nip_lama == ''){
				$( "#nip_lama" ).addClass("invalid");
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
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_add_wizard1",
					data: $('#form-wizard1').serialize(), 
					success: function(msg){	
						var xdata = explode('#', msg);
						//alert(msg);
						if(xdata[0] == 'success'){					
							$( ".lbl_nip_lama" ).html( xdata[2] );						
							$( ".lbl_nip_baru" ).html( xdata[3] );						
							$( ".lbl_nama" ).html( xdata[4] );						
							$( "#hd_nip_lama2" ).val( xdata[2] );						
							$( "#hd_nip_baru2" ).val( xdata[3] );						
							$( "#hd_nama2" ).val( xdata[4] );						
							$( "#validasi-wizard1" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							$( "#next-wizard1" ).show();
							if( xdata[5] != ''){
								//Redirect to Edit
								window.location.replace("<?php echo base_url(); ?>pegawai/edit/"+ xdata[5]);
							}
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
		
		$( "#nip_lama" ).blur(function(){
			var nip_lama = $( "#nip_lama" ).val(); 
			if(nip_lama){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/check_nip_lama",
					data: "nip_lama="+nip_lama+"&hd_id=''", 
					success: function(msg){	
						if(msg == 'valid'){ 
							if(nip_lama.length == 9){
								$( "#cek_nip_lama" ).html( '<font color="blue"> "NIP / NRP Lama" bisa digunakan</font>' );	
								$( "#nip_lama" ).removeClass("invalid");
							}else{
								$( "#cek_nip_lama" ).html( '<font color="red"> Input harus 9 digit! </font>' );
								$( "#nip_lama" ).addClass("invalid");
							}
						}else{
							$( "#cek_nip_lama" ).html( '<font color="red"> "NIP / NRP Lama" sudah digunakan! </font>' );
							$( "#nip_lama" ).addClass("invalid");
						}
						return false;
					}
				});
			}else{
				$( "#cek_nip_lama" ).html( '<font color="red"> "NIP / NRP Lama" Salah, Periksa lagi! </font>' );	
				$( "#nip_lama" ).addClass("invalid");
			}
		});
		
		$( "#nip_baru" ).blur(function(){
			var nip_baru = $( "#nip_baru" ).val(); 
			if(nip_baru){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/check_nip_baru",
					data: "nip_baru="+nip_baru+"&hd_id=''", 
					success: function(msg){	
						if(msg == 'valid'){
							if(nip_baru.length == 18){
								$( "#cek_nip_baru" ).html( '<font color="blue"> "NIP / NRP Baru" bisa digunakan</font>' );	
								$( "#nip_baru" ).removeClass("invalid");
							}else{
								$( "#cek_nip_baru" ).html( '<font color="red">  Input harus 18 digit! </font>' );	
								$( "#nip_baru" ).addClass("invalid");
							}
						}else{
							$( "#cek_nip_baru" ).html( '<font color="red"> "NIP / NRP Baru" sudah digunakan! </font>' );	
							$( "#nip_baru" ).addClass("invalid");
						}
						return false;
					}
				});
			}else{
				$( "#cek_nip_baru" ).html( '<font color="red"> "NIP / NRP Baru" Salah, Periksa lagi! </font>' );
				$( "#nip_baru" ).addClass("invalid");
			}
		});
		
		//onChange Province-city
		$( "#s_propinsi" ).change(function() {
			var prov_id = $( "#s_propinsi" ).val();
			var prov_txt = $( "#s_propinsi option:selected" ).text(); 
			$( "#propinsi" ).val(prov_txt);
			if(prov_id){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/change_prov",
					data: "prov_id="+ prov_id + "&kab=kabupaten", 
					success: function(msg){	
						if(msg){
							$( "#onKabupaten" ).html(msg);
						}
						return false;
					}
				});
			}
		});
		
	});
				
	</script>

</head>
<body>
<?php $this->load->view('layout/_top'); ?>

<!-- Content container -->
<div id="container">
	
	<?php $this->load->view('layout/_sidebar');?>
	
	<!-- Content -->
	<div id="content">

		<!-- Content wrapper -->
		<div class="wrapper">

			<!-- Breadcrumbs line -->
			<div class="crumbs">
				<ul id="breadcrumbs" class="breadcrumb"> 
					<li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
					<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>pegawai" title="">Daftar Riwayat Hidup Pegawai</a></li>
					<li class="active"><a href="#" title="">Add Data Pegawai</a></li>					 
				</ul>
				<?php $this->load->view('layout/_messages'); ?>
			</div>
			<!-- /breadcrumbs line -->

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h5>Add Data Pegawai   </h5>  
				</div>
			</div>
			 <!-- /page header -->
			<?php $this->load->view('layout/_actionwrapper'); ?>		  
			
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span2">	
						<div class="sidebar-user widget">
							<div class="nav-foto">
								<?php if(@$data_pegawai->foto!=''){ $foto=$data_pegawai->foto; }else{ $foto='no-photo.jpg'; } ?>
								<img src="<?php echo base_url(); ?>Uploads/foto/no-photo.jpg" alt="" /></a>
							</div>
							<ul class="nav nav-tabs nav-left">
								<li class="inactive"><a >Riwayat Kepangkatan</a></li>
								<li class="inactive"><a >Riwayat Pendidikan</a></li>
								<li class="inactive"><a >Riwayat Jabatan</a></li>
								<li class="inactive"><a >Riwayat Diklat Jabatan</a></li>
								<li class="inactive"><a >Riwayat Diklat Teknis</a></li>
								<li class="inactive"><a >Riwayat Penghargaan</a></li>
								<li class="inactive"><a >Suami/Istri</a></li>
								<li class="inactive"><a >Riwayat Anak</a></li>
								<li class="inactive"><a >Riwayat Kinerja</a></li>
								<li class="inactive"><a >Riwayat Kompetensi</a></li>
							</ul>
						</div>
					</div>                        
                    <div class="span9">
  						<div class="widget-box">
                          <div class="widget-title">
                            <ul class="nav nav-tabs">
                              <li class="tab1 active"><a data-toggle="tab" href="#tab1" rel="1">Identitas Pribadi</a></li>
                              <li><a >Kepegawaian</a></li>
                              <li class="inactive"><a >Tempat Kerja</a></li>
                              <li class="inactive"><a >Data Dokumen</a></li>
                            </ul>
                          </div>
                          <div class="widget-content tab-content">
						  
                            <div id="tab1" class="tab-pane active">		
								<div class="navbar">
									<div class="navbar-inner">
										<h6>Identitas Pribadi</h6>
									</div>
								</div>	
								<form id="form-wizard1" class="form-horizontal row-fluid well" method="post" action="" >
									<input type="hidden" id="hd_id" name="hd_id" />
									<div class="control-group">
										<label class="control-label">NIP / NRP Lama  :</label>
										<div class="controls">
											<input id="nip_lama" type="text" name="nip_lama" value="" onkeyup="NumberOnly(this)" class="input-xlarge uppercase" />
											<span id="cek_nip_lama"></span>
										</div>
									</div>
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
											<input id="nama" type="text" name="nama" value="" class="input-xlarge uppercase" />
											
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
										<label class="control-label">Agama  :</label>
										<div class="controls">
											<select id="agama" name="agama" class="input-medium">
												<option value=""> </option>
												<option value="ISLAM">ISLAM  </option>
												<option value="PROTESTAN">PROTESTAN  </option>
												<option value="KATOLIK">KATOLIK </option>
												<option value="HINDU">HINDU  </option>
												<option value="BUDHA">BUDHA  </option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status Perkawinan  :</label>
										<div class="controls">
											<select id="status_perkawinan" name="status_perkawinan" class="input-medium">
											<option value=""> </option>
												<option value="Menikah">Menikah</option>
												<option value="Belum Menikah">Belum Menikah </option>
												<option value="Janda/Duda">Janda/Duda </option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Alamat  :</label>
										<div class="controls">
											<input id="alamat" type="text" name="alamat" value="" class="input-xxlarge uppercase" />									
											<div style="margin-top:5px;">
												RT : <input name="rt"  id="rt" value=""  style="width:40px" class="tfield" type="text"> / RW : <input name="rw" id="rw" value=""  style="width:40px" class="tfield" type="text">&nbsp;&nbsp;&nbsp;
											</div>
											<div style="margin-top:5px;">
												Desa/Kelurahan : <input id="kelurahan" name="kelurahan" value=""  style="width:150px" class="tfield" type="text">&nbsp;&nbsp;&nbsp;
												Kecamatan : <input id="kecamatan" name="kecamatan" value=""  style="width:150px" class="tfield" type="text">
											</div>
											<div style="margin-top:5px;">
												Provinsi : 
												<select id="s_propinsi" name="s_propinsi" class="input-large">
													<option value=""> </option>
													<?php										
														foreach($data_prov as $row){
															
															echo "<option value='".$row->prov_id."'>".strtoupper($row->prov_name)."</option>";
														}
													?>													
												</select>
												<input type="hidden" id="propinsi" name="propinsi" />
												&nbsp;
												Kab/Kota : 
												<span id="onKabupaten">
													<select id="kabupaten" name="kabupaten" class="input-medium">
														<option value=""> </option>
														<?php																										
															foreach($data_city as $row){
																echo "<option value='".$row->city_id."'>".strtoupper($row->city_name)."</option>";
															}
														?>													
													</select>
												</span>
											</div>
											<div style="margin-top:5px;">
												Kodepos : <input id="kodepos" name="kodepos" value=""  style="width:80px" class="tfield" type="text">
											</div>
											
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">No. Telp  :</label>
										<div class="controls">
											<input id="telp" type="text" name="telp" value="" class="input-xlarge uppercase" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status KPE  :</label>
										<div class="controls">
											<select id="status_kpe" name="status_kpe" class="input-medium">
												<option value=""> </option>
												<option value="Belum KPE" >Belum KPE</option>
												<option value="Sudah Foto" >Sudah Foto</option>
												<option value="Cetak KPE" >Cetak KPE</option>
												<option value="Terima KPE" >Terima KPE</option>
											</select>
										</div>
									</div>
									
                                </form>
								<div class="form-actions">
									<button id="simpan-wizard1" class="btn btn-primary">Simpan</button> 
									<button id="next-wizard1" class="btn btn-primary">Next >></button> 
									<div id="validasi-wizard1"></div>
								</div>									
                            </div>
						
                          </div>
                        </div>
                    </div>
                </div>
				<div class="row-fluid">
					<div class="span8"></div>
					<div class="span4"></div>
				</div>
				<div class="row-fluid">
					<div class="span3"></div>
					<div class="span3"></div>
					<div class="span3"></div>
					<div class="span3"></div>
				</div>
			</div>
			
			<div class="form-actions">				
				<a href="<?php echo base_url().'pegawai'; ?>" class="btn btn-primary" title="List"><< Back</a>
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