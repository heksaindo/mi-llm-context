<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<script type="text/javascript"> 	

	$(document).ready(function(){
		//Initialisasi
		$( "#dialog-rkepangkatan" ).hide();
		$( "#dialog-rpendidikan" ).hide();
		$( "#dialog-rjabatan" ).hide();
		$( "#dialog-rdokumen" ).hide();
		$( "#dialog-rdiklatjabatan" ).hide();
		$( "#dialog-rdiklatteknis" ).hide();
		$( "#dialog-rpenghargaan" ).hide();
		$( "#dialog-rkeluarga" ).hide();
		$( "#dialog-rkinerja" ).hide();
		$( "#dialog-rkompetensi" ).hide();
		
		$('ul.nav-tabs li a').click(function(){  
			if ($('ul.nav-tabs li').hasClass('active')) {
				$('ul.nav-tabs li').removeClass('active');
				$(this).addClass('active'); 
			}		
		});
		
		$( ".fadd_message" ).val('');
		$( ".lbl_nip_lama" ).html( $( "#nip_lama" ).val() );						
		$( ".lbl_nip_baru" ).html( $( "#nip_baru" ).val() );						
		$( ".lbl_nama" ).html( $( "#nama" ).val() );	
		$( "#hd_nip_lama2" ).val( $( "#nip_lama" ).val() );						
		$( "#hd_nip_baru2" ).val( $( "#nip_baru" ).val() );						
		$( "#hd_nama2" ).val( $( "#nama" ).val() );	
		$( "#hd_nip_lama3" ).val( $( "#nip_lama" ).val() );						
		$( "#hd_nip_baru3" ).val( $( "#nip_baru" ).val() );						
		$( "#hd_nama3" ).val( $( "#nama" ).val() );	
		$( "#hd_nip_lama11" ).val( $( "#nip_lama" ).val() );						
		$( "#hd_nip_baru11" ).val( $( "#nip_baru" ).val() );						
		$( "#hd_nama11" ).val( $( "#nama" ).val() );			
		$( "#status_menikah" ).val( $( "#status_perkawinan" ).val() );	
		$( "#nip_baru4" ).val( $( "#nip_baru" ).val() );
		
		$( "#next-wizard1" ).hide();
		$( "#next-wizard2" ).hide();
		$( "#simpan-wizard3" ).hide();
		$( "#next-wizard3" ).hide();
		$( "#next-wizard11" ).hide();
		
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
					url: "<?php echo base_url(); ?>pegawai/do_edit_wizard1/<?php echo $id_peg;?>",
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
																				
						}else{
							$( "#validasi-wizard1" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-wizard1" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
		});
		
		$( "#next-wizard1" ).click(function(){
			$( '#tab1').removeClass('active');
			$( '#tab2' ).addClass('active'); 		
			$('ul.nav-tabs li').removeClass('active');
			$('ul.nav-tabs li.tab2').addClass('active'); 
		});
		$( "#next-wizard2" ).click(function(){
			$( '#tab2').removeClass('active');
			$( '#tab3' ).addClass('active'); 			
			$('ul.nav-tabs li').removeClass('active');
			$('ul.nav-tabs li.tab3').addClass('active'); 	
		});
		$( "#next-wizard3" ).click(function(){
			$( '#tab3').removeClass('active');
			$( '#tab4' ).addClass('active'); 
			$('ul.nav-tabs li').removeClass('active');			
			$('ul.nav-tabs li.tab4').addClass('active'); 		
		});
		$( "#next-wizard11" ).click(function(){
			$( '#tab11').removeClass('active');
			$( '#tab12' ).addClass('active'); 	
			$('ul.nav-tabs li').removeClass('active');
			$('ul.nav-tabs li.tab13').addClass('active'); 		
		});
		
		//Wizard 2
		$( "#simpan-wizard2" ).click(function(){
			var err = 0;
			var tmt_cpns = $( "#tmt_cpns" ).val(); 
			var status_kepegawaian = $( "#status_kepegawaian" ).val(); 
			var jenis_kepegawaian = $( "#jenis_kepegawaian" ).val(); 
			
			if(tmt_cpns === ''){
				$( "#tmt_cpns" ).addClass("invalid");
				err = 1;
			}		
			if(status_kepegawaian === ''){
				$( "#status_kepegawaian" ).addClass("invalid");
				err = 1;
			}
			if(jenis_kepegawaian === ''){
				$( "#jenis_kepegawaian" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err === 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_edit_wizard2/<?php echo $id_peg;?>",
					data: $('#form-wizard2').serialize(), 
					success: function(msg){	
						var xdata = explode('#', msg);
						//alert(msg);
						if(xdata[0] == 'success'){					
							$( ".lbl_nip_lama" ).html( xdata[2] );						
							$( ".lbl_nip_baru" ).html( xdata[3] );						
							$( ".lbl_nama" ).html( xdata[4] );		
							$( "#hd_nip_lama3" ).val( xdata[2] );						
							$( "#hd_nip_baru3" ).val( xdata[3] );						
							$( "#hd_nama3" ).val( xdata[4] );								
							$( "#validasi-wizard2" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							$( "#next-wizard2" ).show();															
						}else{
							$( "#validasi-wizard2" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-wizard2" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
		});
		
		//Wizard 3
		$( "#simpan-wizard3" ).click(function(){
			var err = 0;
			var tanggal_tugas = $( "#tanggal_tugas" ).val(); 
			var instansi = $( "#instansi" ).val(); 
			
			if(tanggal_tugas == ''){
				$( "#tanggal_tugas" ).addClass("invalid");
				err = 1;
			}		
			if(instansi == ''){
				$( "#instansi" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_edit_wizard3/<?php echo $id_peg;?>",
					data: $('#form-wizard3').serialize(), 
					success: function(msg){	
						var xdata = explode('#', msg);
						//alert(msg);
						if(xdata[0] == 'success'){					
							$( ".lbl_nip_lama" ).html( xdata[2] );						
							$( ".lbl_nip_baru" ).html( xdata[3] );						
							$( ".lbl_nama" ).html( xdata[4] );		
							$( "#hd_nip_lama4" ).val( xdata[2] );						
							$( "#hd_nip_baru4" ).val( xdata[3] );						
							$( "#hd_nama4" ).val( xdata[4] );								
							$( "#validasi-wizard3" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							$( "#next-wizard3" ).show();															
						}else{
							$( "#validasi-wizard3" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-wizard3" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
		});
		
		//Wizard 11
		$( "#simpan-wizard11" ).click(function(){
			var err = 0;
			var tanggal_tugas = $( "#tanggal_tugas" ).val(); 
			var instansi = $( "#instansi" ).val(); 
			
			if(tanggal_tugas == ''){
				$( "#tanggal_tugas" ).addClass("invalid");
				err = 1;
			}		
			if(instansi == ''){
				$( "#instansi" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_edit_wizard11/<?php echo $id_peg;?>",
					data: $('#form-wizard11').serialize(), 
					success: function(msg){	
						var xdata = explode('#', msg);
						//alert(msg);
						if(xdata[0] == 'success'){					
							$( ".lbl_nip_lama" ).html( xdata[2] );						
							$( ".lbl_nip_baru" ).html( xdata[3] );						
							$( ".lbl_nama" ).html( xdata[4] );									
							$( "#validasi-wizard11" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							$( "#next-wizard11" ).show();															
						}else{
							$( "#validasi-wizard11" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-wizard11" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
		});
		
		//Cek NIP Lama
		$( "#nip_lama" ).blur(function(){
			var hd_id = $( "#hd_id" ).val(); 
			var nip_lama = $( "#nip_lama" ).val(); 
			var regex =/^[0-9]{9}$/;
			if (!regex.test(nip_lama)){
			//if(nip_lama.length != 9){
				$( "#cek_nip_lama" ).html( '<font color="red"> "Input harus 9 digit angka, silahkan periksa lagi! </font>' );	
				$( "#nip_lama" ).addClass("invalid");
				$( "#nip_lama" ).focus();
			}else{
			
				if(nip_lama){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/check_nip_lama",
						data: "nip_lama="+nip_lama+"&hd_id="+hd_id, 
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
					$( "#cek_nip_lama" ).html( '<font color="red"> Input salah, silahkan periksa lagi! </font>' );	
					$( "#nip_lama" ).addClass("invalid");
					$( "#nip_lama" ).focus();
				}	
			}
		});
		//Cek NIP Baru
		$( "#nip_baru" ).blur(function(){
			var nip_baru = $( "#nip_baru" ).val(); 
			var hd_id = $( "#hd_id" ).val(); 
			var regex =/^[0-9]{18}$/;
			if (!regex.test(nip_baru)){
			//if(nip_baru.length != 18){
				$( "#cek_nip_baru" ).html( '<font color="red"> Input harus 18 digit angka, silahkan periksa lagi! </font>' );	
				$( "#nip_baru" ).addClass("invalid");
				$( "#nip_baru" ).focus();
			}else{
			
				if(nip_baru){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/check_nip_baru",
						data: "nip_baru="+nip_baru+"&hd_id="+hd_id,
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
					$( "#cek_nip_baru" ).html( '<font color="red"> Input salah, silahkan periksa lagi! </font>' );
					$( "#nip_baru" ).addClass("invalid");
				}
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
		
		$( "#kabupaten" ).change(function() {
			var kab_id = $( "#kabupaten" ).val();
			$( "#kabupaten_id" ).val(kab_id);
		});
		
		//onChange Jabatan
		$( "#jabatan3" ).change(function() {
			var status_id = $( "#jabatan3" ).val();
			if(status_id){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/change_jabatan",
					data: "status_id="+ status_id, 
					success: function(msg){	
						if(msg){
							$( "#onNamaJabatan3" ).html(msg);
						}
						return false;
					}
				});
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
						//alert(data.msg);
						$('img #foto_tumb').attr('src', "<?php echo APP_URL ?>/Uploads/foto/"+data.file);
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
	
	<?php $this->load->view('layout/_sidebar');?>
	
	<!-- Content -->
	<div id="content">

		<!-- Content wrapper -->
		<div class="wrapper">

			<!-- Breadcrumbs line -->
			<div class="crumbs">
				<ul id="breadcrumbs" class="breadcrumb"> 
					<!--<li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
					<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>-->
					<li><a href="<?php echo base_url(); ?>pegawai" title="">Daftar Riwayat Hidup Pegawai</a></li>
					<li class="active"><a href="#" title="">Edit Data Pegawai</a></li>					 
				</ul>
				<?php $this->load->view('layout/_messages'); ?>
			</div>
			<!-- /breadcrumbs line -->

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h5>Edit Data Pegawai</h5>  
				</div>
			</div>
			 <!-- /page header -->
			<?php $this->load->view('layout/_actionwrapper'); ?>	
			
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span2">	
						<div class="sidebar-user widget">
							<div class="nav-foto">
								<?php if($data_pegawai->foto!=''){ $foto=$data_pegawai->foto; }else{ $foto='no-photo.jpg'; } ?>
								<img id="foto_tumb" src="<?php echo APP_URL; ?>Uploads/foto/<?php echo $foto; ?>" alt="" /></a>
							</div>
							<img id="loading" src="<?php echo base_url(); ?>img/loading.gif" style="display:none;">
							<form name="form" action="" method="POST" enctype="multipart/form-data">
								<input id="fileFoto" type="file" size="45" name="fileFoto" accept="image/gif, image/jpeg, image/png" class="input">
								<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">Upload Foto</button>
							</form>
								
							<ul class="nav nav-tabs nav-left">
								<li class="tab5"><a data-toggle="tab" href="#tab5" title="" rel="5">Riwayat Kepangkatan</a></li>
								<li class="tab6"><a data-toggle="tab" href="#tab6" title="" rel="6">Riwayat Pendidikan</a></li>
								<li class="tab7"><a data-toggle="tab" href="#tab7" title="" rel="7">Riwayat Jabatan</a></li>
								<li class="tab8"><a data-toggle="tab" href="#tab8" title="" rel="8">Riwayat Diklat Jabatan</a></li>
								<li class="tab9"><a data-toggle="tab" href="#tab9" title="" rel="9">Riwayat Diklat Teknis</a></li>
								<li class="tab10"><a data-toggle="tab" href="#tab10" title="" rel="10">Riwayat Penghargaan</a></li>
								<li class="tab11"><a data-toggle="tab" href="#tab11" title="" rel="11">Suami/Istri</a></li>
								<li class="tab12"><a data-toggle="tab" href="#tab12" title="" rel="12">Riwayat Anak</a></li>
								<li class="tab13"><a data-toggle="tab" href="#tab13" title="" rel="13">Riwayat Kinerja</a></li>
								<li class="tab14"><a data-toggle="tab" href="#tab14" title="" rel="14">Riwayat Kompetensi</a></li>
							</ul>
						</div>
					</div>                        
                    <div class="span9">
  						<div class="widget-box">
                          <div class="widget-title">
                            <ul class="nav nav-tabs">
                              <li class="tab1 active"><a data-toggle="tab" href="#tab1" rel="1">Identitas Pribadi</a></li>
                              <li class="tab2"><a data-toggle="tab" href="#tab2" rel="2">Kepegawaian</a></li>
                              <li class="tab3"><a data-toggle="tab" href="#tab3" rel="3">Tempat Kerja</a></li>
                              <li class="tab4"><a data-toggle="tab" href="#tab4" rel="4">Data Dokumen</a></li>
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
									<input type="hidden" id="hd_id" name="hd_id" value="<?php echo $hd_id ?>"/>
									<input type="hidden" id="hd_nip_baru" name="hd_nip_baru" value="<?php echo $hd_nip_baru ?>"/>
									<input type="hidden" id="nip_baru_before" name="nip_baru_before" value="<?php echo $hd_nip_baru ?>"/>
									<div class="control-group">
										<label class="control-label">NIP / NRP Lama  :</label>
										<div class="controls">
											<input id="nip_lama" type="text" name="nip_lama" value="<?php echo $data_pegawai->nip_lama;?>" onkeyup="NumberOnly(this)" class="input-xlarge uppercase" />
											<span id="cek_nip_lama"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">NIP / NRP Baru  :</label>
										<div class="controls">
											<input id="nip_baru" type="text" name="nip_baru" value="<?php echo $data_pegawai->nip_baru;?>" onkeyup="NumberOnly(this)" class="input-xlarge uppercase" />
											<span id="cek_nip_baru"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Nama  :</label>
										<div class="controls">
											<input id="gelar_depan" type="text" name="gelar_depan" value="<?php echo $data_pegawai->gelar_depan;?>" class="input-medium " />
											<input id="nama" type="text" name="nama" value="<?php echo $data_pegawai->nama;?>" class="input-xlarge uppercase" />
											<input id="gelar_belakang" type="text" name="gelar_belakang" value="<?php echo $data_pegawai->gelar_belakang;?>" class="input-medium uppercase" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">No Kartu Pegawai  :</label>
										<div class="controls">
											<input id="no_kartu" type="text" name="no_kartu" value="<?php echo $data_pegawai->no_kartu;?>" class="input-xlarge uppercase" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jenis Kelamin  :</label>
										<div class="controls">
											<select id="jenis_kelamin" name="jenis_kelamin" class="input-medium">
												<option value="" <?php if(rtrim($data_pegawai->jenis_kelamin) == '') echo 'selected = "selected"';?> > </option>
												<option value="Laki-laki" <?php if(rtrim($data_pegawai->jenis_kelamin) == 'Laki-laki') echo 'selected = "selected"'; ?> >Laki-laki </option>
												<option value="Perempuan" <?php if(rtrim($data_pegawai->jenis_kelamin) == 'Perempuan') echo 'selected = "selected"';?>>Perempuan  </option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tempat Lahir  :</label>
										<div class="controls">
											<input id="tempat_lahir" type="text" name="tempat_lahir" value="<?php echo $data_pegawai->tempat_lahir;?>" class="input-xlarge uppercase" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Lahir  :</label>
										<div class="controls">
											<input id="tanggal_lahir" type="text" name="tanggal_lahir" value="<?php if($data_pegawai->tanggal_lahir) echo date('d-m-Y', strtotime($data_pegawai->tanggal_lahir));?>" class="input-medium datepicker uppercase" />
										</div>
									</div>									
									<div class="control-group">
										<label class="control-label">Agama  :</label>
										<div class="controls">
											<select id="agama" name="agama" class="input-medium">
												<option value="">--Pilih--</option>
												<?php foreach($data_agama as $row):?>
												<?php if($data_pegawai->agama == $row->id) : $selec ='selected="selected"'; else: $selec = ''; endif;?>
												<option value="<?php echo $row->id;?>" <?php echo $selec;?>><?php echo $row->label;?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status Perkawinan  :</label>
										<div class="controls">
											<select id="status_perkawinan" name="status_perkawinan" class="input-medium">
												<option value="">--Pilih--</option>
												<?php foreach($data_statusperkawinan as $row):?>
												<?php if($data_pegawai->status_perkawinan == $row->id) : $selec ='selected="selected"'; else: $selec = ''; endif;?>
												<option value="<?php echo $row->id;?>" <?php echo $selec;?>><?php echo $row->label;?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Alamat  :</label>
										<div class="controls">
											<input id="alamat" type="text" name="alamat" value="<?php echo $data_pegawai->alamat;?>" class="input-xxlarge uppercase" />									
											<div style="margin-top:5px;">
												RT : <input name="rt"  id="rt" value="<?php echo $data_pegawai->rt;?>"  style="width:40px" class="tfield" type="text"> / RW : <input name="rw" id="rw" value="<?php echo $data_pegawai->rw;?>"  style="width:40px" class="tfield" type="text">&nbsp;&nbsp;&nbsp;
											</div>
											<div style="margin-top:5px;">
												Desa/Kelurahan : <input id="kelurahan" name="kelurahan" value="<?php echo $data_pegawai->kelurahan;?>"  style="width:150px" class="tfield" type="text">&nbsp;&nbsp;&nbsp;
												Kecamatan : <input id="kecamatan" name="kecamatan" value="<?php echo $data_pegawai->kecamatan;?>"  style="width:150px" class="tfield" type="text">
											</div>
											<div style="margin-top:5px;">
												Provinsi : 
												<select id="s_propinsi" name="s_propinsi" class="input-large">
													<option value=""> </option>
													<?php										
														foreach($data_prov as $row){
															$selected = '';	
															if($data_pegawai->propinsi == $row->prov_id){
																$selected =  'selected = "selected"'; 
															}
															echo "<option value='".$row->prov_id."' ".$selected.">".strtoupper($row->prov_name)."</option>";
														}
													?>													
												</select>
												<input type="hidden" id="propinsi" name="propinsi" />
												&nbsp;
												Kab/Kota : 
												<span id="onKabupaten">
													<input type="text" id="kabupaten" name="kabupaten" style="width:150px" value="<?php echo get_name('m_cities','city_name','city_id', $data_pegawai->kabupaten); ?>" />
												</span>
												<input type="hidden" id="kabupaten_id" name="kabupaten_id" value="<?php echo $data_pegawai->kabupaten;?>" />
											</div>
											<div style="margin-top:5px;">
												Kodepos : <input id="kodepos" name="kodepos" value="<?php echo $data_pegawai->kodepos;?>"  style="width:80px" class="tfield" type="text">
											</div>
											
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">No. Telp  :</label>
										<div class="controls">
											<input id="telp" type="text" name="telp" value="<?php echo $data_pegawai->telp;?>" class="input-xlarge uppercase" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status KPE  :</label>
										<div class="controls">
											<select id="status_kpe" name="status_kpe" class="input-medium">
												<option value="" <?php if(rtrim($data_pegawai->status_kpe) == '') echo 'selected = "selected"'; ?> > </option>
												<option value="Belum KPE" <?php if(rtrim($data_pegawai->status_kpe) == 'Belum KPE') echo 'selected = "selected"'; ?> >Belum KPE</option>
												<option value="Sudah Foto" <?php if(rtrim($data_pegawai->status_kpe) == 'Sudah Foto') echo 'selected = "selected"'; ?> >Sudah Foto</option>
												<option value="Cetak KPE" <?php if(rtrim($data_pegawai->status_kpe) == 'Cetak KPE') echo 'selected = "selected"'; ?> >Cetak KPE</option>
												<option value="Terima KPE" <?php if(rtrim($data_pegawai->status_kpe) == 'Terima KPE') echo 'selected = "selected"'; ?> >Terima KPE</option>
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
							
                            <div id="tab2" class="tab-pane">
								<div class="navbar">
									<div class="navbar-inner">
										<h6>Kepegawaian</h6>
									</div>
								</div>	
								<form id="form-wizard2" class="form-horizontal row-fluid well" method="post" action="" >
									<div class="hide control-group">
										<label class="control-label">NIP/NRP Lama  :</label>
										<div class="controls">
											<div class="lbl_nip_lama"></div>
											<input type="hidden" id="hd_nip_lama2" name="hd_nip_lama2" />
										</div>
									</div>
									<div class="hide control-group">
										<label class="control-label">NIP/NRP Baru  :</label>
										<div class="controls">
											<div class="lbl_nip_baru"></div>
											<input type="hidden" id="hd_nip_baru2" name="hd_nip_baru2" />
										</div>
									</div>
									<div class="hide control-group">
										<label class="control-label">Nama  :</label>
										<div class="controls">
											<div class="lbl_nama"></div>
											<input type="hidden" id="hd_nama2" name="hd_nama2" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Pendidikan Waktu Diangkat  :</label>
										<div class="controls">
											<?php echo $data_kepegawaian->strata_diangkat.' - '.$data_kepegawaian->jurusan_diangkat;?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TMT CPNS*  :</label>
										<div class="controls">
											<?php if($data_kepegawaian->tmt_cpns) echo date('d-m-Y', strtotime($data_kepegawaian->tmt_cpns));?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TMT PNS  :</label>
										<div class="controls">
											<?php  if($data_kepegawaian->tmt_pns) echo date('d-m-Y', strtotime($data_kepegawaian->tmt_pns));?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status Kepegawaian*  :</label>
										<div class="controls">
											 <?php echo $data_kepegawaian->status_kepegawaian;?>
											
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jenis Kepegawaian*  :</label>
										<div class="controls">
											<select name="jenis_kepegawaian" class="input-xlarge">
												<option value="0"<?php if($data_kepegawaian->jenis_kepegawaian == 0) echo 'selected = "selected"'; ?>>-</option>
												<?php
												foreach($db_jkp->result() as $djk){
													
													?>
												<option value="<?php echo $djk->id_jenis_kepegawaian?>"<?php if($data_kepegawaian->jenis_kepegawaian == $djk->id_jenis_kepegawaian) echo 'selected = "selected"'; ?>><?php echo $djk->nama_jenis_kepegawaian?></option>
												<?php }?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Golongan Terakhir  :</label>
										<div class="controls">
											<?php
												echo $data_kepegawaian->gol_terakhir;
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TMT Gol. Terakhir  :</label>
										<div class="controls">
											<?php if($data_kepegawaian->tmt_gol_terakhir) echo date('d-m-Y', strtotime($data_kepegawaian->tmt_gol_terakhir));?>
										</div>
									</div>
									<div class=" hide control-group">
										<label class="control-label">Masa Kerja Keseluruhan  :</label>
										<div class="controls">
											<?php //echo $data_kepegawaian->masa_kerja_keseluruhan;?>
											<?php
											$mkg = datediff($tmt_kerja->tmt_kepangkatan, $tmt_pns->tmt_kepangkatan);
											/*if(!empty($data_kepegawaian->masa_kerja_keseluruhan)) {
												echo $data_kepegawaian->mkk_tahun.' Thn '.$data_kepegawaian->mkk_bulan.' Bln';
												echo '<input type="hidden" id="mkk_tahun" name="mkk_tahun" value="'.$data_kepegawaian->mkk_tahun.'" />';
												echo '<input type="hidden" id="mkk_bulan" name="mkk_bulan" value="'.$data_kepegawaian->mkk_bulan.'" />';
											}else{*/
											?>
												<span style="padding-right: 20px;">TMT <?php echo date('d-m-Y', strtotime($tmt_kerja->tmt_kepangkatan));?> :</span>
												<input id="mkk_tahun" type="text" name="mkk_tahun" value="<?php echo $mkg['years'];?>" class="input-small" readonly /> Tahun &nbsp;
												<input id="mkk_bulan" type="text" name="mkk_bulan" value="<?php echo $mkg['months'];?>" class="input-small" readonly /> Bulan
											
											<?php //} ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Masa Kerja Tambahan  :</label>
										<div class="controls">
											<?php 
											//if(!empty($data_kepegawaian->masa_kerja_tambahan)) {
											//	echo $data_kepegawaian->mkt_tahun.' Thn '.$data_kepegawaian->mkt_bulan.' Bln';
											//	echo '<input type="hidden" id="mkt_tahun" name="mkt_tahun" value="'.$data_kepegawaian->mkt_tahun.'" />';
											//	echo '<input type="hidden" id="mkt_bulan" name="mkt_bulan" value="'.$data_kepegawaian->mkt_bulan.'" />';
											//}else{
											?> 
												<input id="mkt_tahun" type="text" name="mkt_tahun" value="<?php echo $data_kepegawaian->mkt_tahun;?>" class="input-small" /> Tahun &nbsp;
												<input id="mkt_bulan" type="text" name="mkt_bulan" value="<?php echo $data_kepegawaian->mkt_bulan;?>" class="input-small" /> Bulan 
										
											<?php  ?>
										</div>
									</div>
									<div class=" hide control-group">
										<label class="control-label">Masa Kerja Golongan  :</label>
										<div class="controls">
											<?php
											$mkg = datediff($tmt_kerja->tmt_kepangkatan, $tmt_pns->tmt_kepangkatan);
											//if(!empty($data_kepegawaian->masa_kerja_tahun)) {
											//	echo $data_kepegawaian->masa_kerja_tahun.' Thn '.$data_kepegawaian->masa_kerja_bulan.' Bln';
											//	echo '<input type="hidden" id="masa_kerja_tahun" name="masa_kerja_tahun" value="'.$data_kepegawaian->masa_kerja_tahun.'" />';
											//	echo '<input type="hidden" id="masa_kerja_bulan" name="masa_kerja_bulan" value="'.$data_kepegawaian->masa_kerja_bulan.'" />';
											//}else{
											?>
											<span style="padding-right: 20px;">TMT <?php echo date('d-m-Y', strtotime($tmt_kerja->tmt_kepangkatan));?> :</span>
											<input id="masa_kerja_tahun" type="text" name="masa_kerja_tahun" value="<?php echo $mkg['years'];?>" class="input-small" readonly /> Tahun &nbsp;
											<input id="masa_kerja_bulan" type="text" name="masa_kerja_bulan" value="<?php echo $mkg['months'];?>" class="input-small" readonly /> Bulan
											
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status Gaji :</label>
										<div class="controls">
											<select name="status_gaji">
												<option value="">--Pilih--</option>
												<?php foreach($data_status_gaji as $row):?>
												<?php if($data_kepegawaian->status_gaji == $row->id) : $selec ='selected="selected"'; else: $selec = ''; endif;?>
												<option value="<?php echo $row->id;?>" <?php echo $selec;?>><?php echo $row->label;?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Lokasi Gaji  :</label>
										<div class="controls">
											<select name="lokasi_gaji">
												<option value="">--Pilih--</option>
												<?php foreach($data_lokasi_gaji as $row):?>
												<?php if($data_kepegawaian->lokasi_gaji == $row->id) : $selec ='selected="selected"'; else: $selec = ''; endif;?>
												<option value="<?php echo $row->id;?>" <?php echo $selec;?>><?php echo $row->label;?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="hide control-group">
										<label class="control-label">TMT KGB Terakhir  :</label>
										<div class="controls">
											<?php if($data_kepegawaian->tmt_kgb_terakhir) echo date('d-m-Y', strtotime($data_kepegawaian->tmt_kgb_terakhir));?>
										</div>
									</div>
									<!--<div class="control-group">
										<label class="control-label">Satuan Kerja  :</label>
										<div class="controls">
											<select id="satuan_kerja" name="satuan_kerja" class="input-xxlarge">
												<option value=""></option>
												<?php
												/*	foreach($data_satuan_kerja as $row){
														$selected = '';	
														if(strtoupper(rtrim($data_kepegawaian->satuan_kerja)) == strtoupper(rtrim($row->id_unit_kerja))){
															$selected =  'selected = "selected"'; 
														}
														echo "<option value='".$row->id_unit_kerja."' ".$selected.">".$row->nama_unit_kerja."</option>";
													}
											*/	?>
											</select>
										</div>
									</div>-->
									<div class="hide control-group">
										<label class="control-label">Cuti Besar  :</label>
										<div class="controls">
											<?php echo $data_kepegawaian->cuti_besar;?>
											
										</div>
									</div>									
                                </form>
								<div class="form-actions">
									<button id="simpan-wizard2" class="btn btn-primary">Simpan</button> 
									<button id="next-wizard2" class="btn btn-primary">Next >></button> 
									<div id="validasi-wizard2"></div>
								</div>
							</div>
							
                            <div id="tab3" class="tab-pane">
								<div class="navbar">
									<div class="navbar-inner">
										<h6>Tempat Kerja</h6>
									</div>
								</div>	
								<form id="form-wizard3" class="form-horizontal row-fluid well" method="post" action="" >
									<div class="hide control-group">
										<label class="control-label">NIP/NRP Lama  :</label>
										<div class="controls">
											<div class="lbl_nip_lama"></div>
											<input type="hidden" id="hd_nip_lama3" name="hd_nip_lama3" />
										</div>
									</div>
									<div class="hide control-group">
										<label class="control-label">NIP/NRP Baru  :</label>
										<div class="controls">
											<div class="lbl_nip_baru"></div>
											<input type="hidden" id="hd_nip_baru3" name="hd_nip_baru3" />
										</div>
									</div>
									<div class="hide control-group">
										<label class="control-label">Nama  :</label>
										<div class="controls">
											<div class="lbl_nama"></div>
											<input type="hidden" id="hd_nama3" name="hd_nama3" />
										</div>
									</div> 
								
									<div class="control-group">
										<label class="control-label">Tgl Mulai Tugas :</label>
										<div class="controls">
											<?php if(@$data_tempatkerja->tanggal_tugas) echo date('d-m-Y', strtotime($data_tempatkerja->tanggal_tugas));?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TMT Jabatan :</label>
										<div class="controls">
											<?php if(@$data_tempatkerja->tmt_jabatan) echo date('d-m-Y', strtotime($data_tempatkerja->tmt_jabatan));?>
										</div>
									</div>									
									<div class="control-group">
										<label class="control-label">Instansi Bekerja  :</label>
										<div class="controls">
											<?php if(@$data_tempatkerja->instansi) echo $data_tempatkerja->instansi;?> 
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Organisasi  :</label>
										<div class="controls">
											<?php 
											echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$data_tempatkerja->organisasi_kerja);
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Satuan Kerja</label>
										<div class="controls">
											<?php 
											echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$data_tempatkerja->satuan_kerja);
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Satuan Organisasi</label>
										<div class="controls">
											<?php 
											echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$data_tempatkerja->satuan_organisasi);
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Unit Organisasi</label>
										<div class="controls">
											<?php 
											echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', @$data_tempatkerja->unit_organisasi);
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jabatan</label>
										<div class="controls">
											<?php 
											echo @$data_detail_jabatan->nama_jabatan;
											?>
											
										</div>
									</div> 									
								</form>
								<div class="form-actions">
									<button id="simpan-wizard3" class="btn btn-primary">Simpan</button> 
									<button id="next-wizard3" class="btn btn-primary">Next >></button> 
									<div id="validasi-wizard3"></div>
								</div>
                            </div>
                            
							<div id="tab4" class="tab-pane">
								<div class="navbar">
									<div class="navbar-inner">
										<h6>Data Dokumen</h6>
									</div>
								</div>	
								<form id="form-wizard4" class="form-horizontal row-fluid well" method="post" action="" >
									<div class="hide control-group">
										<label class="control-label">NIP/NRP Lama  :</label>
										<div class="controls">
											<div class="lbl_nip_lama"></div>
										</div>
									</div>
									<div class="hide control-group">
										<label class="control-label">NIP/NRP Baru  :</label>
										<div class="controls">
											<div class="lbl_nip_baru"></div>
										</div>
									</div>
									<div class="hide control-group">
										<label class="control-label">Nama  :</label>
										<div class="controls">
											<div class="lbl_nama"></div>
										</div>
									</div>
								</form>
                                <div class="widget-box">
									<button id="add-rdokumen" class="btn btn-primary">Tambah</button>
									<div class="widget-content">									
										<table id="list-rdokumen" class="table table-bordered table-striped with-check">
										  <thead>
											<tr>
											  <th>No.</th>
											  <th>Nama Dokumen</th>
											  <th>Tanggal Upload</th>
											  <th>Tipe Dokumen</th>
											  <th>File Name</th>
											  <th>Options</th>
											</tr>
										  </thead>
										  
										</table>
									</div>
								</div>
                            </div>
							
							<div id="tab5" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Kepangkatan</h6>
										</div>
									</div>
									<form id="form-wizard5" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rkepangkatan" class="btn btn-primary">Tambah</button>
									<div class="widget-content">									
									<table id="list-rkepangkatan" class="table table-bordered table-striped with-check">
										<thead>
											<tr>
												<th>No.</th>
												<th>Pangkat</th>
												<th>Golongan</th>
												<th>TMT</th>
												<th>No & Tgl SK</th>
												<th>Pejabat Penandatangan</th>
												<th>Action</th>
											</tr>
										</thead>									  
										</table>
									</div>
								</div>
                            </div>
							
							<div id="tab6" class="tab-pane">
								<div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Pendidikan</h6>
										</div>
									</div>	
									<form id="form-wizard6" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rpendidikan" class="btn btn-primary">Tambah</button>
									<div class="widget-content">
										<div class="table-overflow">
											<table id="list-rpendidikan" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Strata</th>
														<th>Kategori</th>
														<th>Jenis Tenaga</th>
														<th>Program Studi</th>
														<th>Jurusan</th>
														<th>Nama Sekolah</th>
														<th>Tahun Ijazah</th>
														<th>Action</th>
													</tr>
												</thead>
												
											</table>
										</div>
									</div>
								</div>
                            </div>
							
							<div id="tab7" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Jabatan</h6>
										</div>
									</div>
									<form id="form-wizard7" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rjabatan" class="btn btn-primary">Tambah</button>
								  <div class="widget-content">
									<table id="list-rjabatan" class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Jabatan</th>
										  <th>Eselon</th>
										  <th>TMT</th>
										  <th>No SK</th>
										  <th>Tanggal SK</th>
										  <th>Unit Organisasi</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab8" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Diklat Jabatan</h6>
										</div>
									</div>
									<form id="form-wizard8" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rdiklatjabatan" class="btn btn-primary">Tambah</button>
								  <div class="widget-content">
									<table id="list-rdiklatjabatan" class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Jenis Pelatihan</th>
										  <th>Nama Pelatihan</th>
										  <th>Lembaga</th>
										  <th>Tahun</th>
										  <th>Jam</th>
										  <th>Action</th>
										</tr>
									  </thead>
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab9" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Pelatihan Teknis</h6>
										</div>
									</div>
									<form id="form-wizard9" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
								  <button id="add-rdiklatteknis" class="btn btn-primary">Tambah</button>
								  <div class="widget-content">
									<table id="list-rdiklatteknis" class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Kategori</th>
										  <th>Nama Pelatihan</th>
										  <th>Lembaga Pelatihan</th>
										  <th>Negara Pelatihan</th>
										  <th>Jenis Pelatihan</th>
										  <th>Tahun</th>
										  <th>Action</th>
										</tr>
									  </thead>
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab10" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Penghargaan</h6>
										</div>
									</div>
									<form id="form-wizard10" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rpenghargaan" class="btn btn-primary">Tambah</button>
								  <div class="widget-content">
									<table id="list-rpenghargaan" class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No</th>
										  <th>Pelaksana</th>
										  <th>Nama Penghargaan</th>
										  <th>Tanda Jasa</th>
										  <th>No SK</th>
										  <th>Tgl SK</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab11" class="tab-pane">
								<div class="navbar">
									<div class="navbar-inner">
										<h6>Suami/Istri</h6>
									</div>
								</div>	
								<form id="form-wizard11" class="form-horizontal row-fluid well" method="post" action="" >
									<div class="control-group">
										<label class="control-label">NIP/NRP Lama  :</label>
										<div class="controls">
											<div class="lbl_nip_lama"></div>
											<input type="hidden" id="hd_nip_lama11" name="hd_nip_lama11" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">NIP/NRP Baru  :</label>
										<div class="controls">
											<div class="lbl_nip_baru"></div>
											<input type="hidden" id="hd_nip_baru11" name="hd_nip_baru11" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Nama  :</label>
										<div class="controls">
											<div class="lbl_nama"></div>
											<input type="hidden" id="hd_nama11" name="hd_nama11" />
										</div>
									</div> 
									<?php
									if(trim(@$data_pegawai->jenis_kelamin) == 'Laki-laki'){
										$label_sutri = 'Nama Istri';
									}else{
										$label_sutri = 'Nama Suami';
									}								
									?>
									<div class="control-group">
										<label class="control-label">Status Perkawinan  :</label>
										<div class="controls">
											<select id="status_menikah" name="status_menikah" class="input-medium">
												<option value="">--Pilih--</option>
												<?php foreach($data_statusperkawinan as $row):?>
												<?php if(@$data_sutri->status_menikah == $row->id) : $selec ='selected="selected"'; else: $selec = ''; endif;?>
												<option value="<?php echo $row->id;?>" <?php echo $selec;?>><?php echo $row->label;?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label"><?php echo @$label_sutri;?>  :</label>
										<div class="controls">
											<input id="nama_suami_istri" type="text" name="nama_suami_istri" value="<?php echo @$data_sutri->nama_suami_istri;?>" class="input-large" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Lahir  :</label>
										<div class="controls">
											<input id="tgl_lahir" type="text" name="tgl_lahir" value="<?php if(@$data_sutri->tgl_lahir) echo date('d-m-Y', strtotime($data_sutri->tgl_lahir));?>" class="input-medium datepicker" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Nikah  :</label>
										<div class="controls">
											<input id="tgl_nikah" type="text" name="tgl_nikah" value="<?php if(@$data_sutri->tgl_nikah) echo date('d-m-Y', strtotime($data_sutri->tgl_nikah));?>" class="input-medium datepicker" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Pekerjaan  :</label>
										<div class="controls">
											<input id="pekerjaan" type="text" name="pekerjaan" value="<?php echo @$data_sutri->pekerjaan;?>" class="input-large" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">No Seri Karis  :</label>
										<div class="controls">
											<input id="no_karis" type="text" name="no_karis" value="<?php echo @$data_sutri->no_karis;?>" class="input-medium" />
										</div>
									</div>
								</form>
								<div class="form-actions">
									<button id="simpan-wizard11" class="btn btn-primary">Simpan</button> 
									<button id="next-wizard11" class="btn btn-primary">Next >></button> 
									<div id="validasi-wizard11"></div>
								</div>
							</div>
							
							<div id="tab12" class="tab-pane">
								<div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Anak</h6>
										</div>
									</div>
									<form id="form-wizard12" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rkeluarga" class="btn btn-primary">Tambah</button>
									<div class="widget-content">
										<div class="table-overflow">
											<table id="list-rkeluarga" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Anak</th>
														<th>Tanggal Lahir</th>
														<th>Jenis Kelamin</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												
											</table>
										</div>
									</div>
								</div>
							</div>
							
							<div id="tab13" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Kinerja</h6>
										</div>
									</div>
									<form id="form-wizard13" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rkinerja" class="btn btn-primary">Tambah</button>
								  <div class="widget-content">
									<table id="list-rkinerja" class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Jabatan</th>
										  <th>Capaian SKP</th>
										  <th>Pejabat Penilai</th>
										  <th>Tahun</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab14" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Kompetensi</h6>
										</div>
									</div>
									<form id="form-wizard14" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<div class="lbl_nip_lama"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<div class="lbl_nip_baru"></div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<div class="lbl_nama"></div>
											</div>
										</div>
									</form>
									<button id="add-rkompetensi" class="btn btn-primary">Tambah</button>
								  <div class="widget-content">
									<table id="list-rkompetensi" class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th width="5">No.</th>
										  <th>Jabatan</th>
										  <th>Kompetensi</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  
									</table>
								  </div>
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
				<a href="<?php echo base_url().'pegawai/detail/'.$data_pegawai->id; ?>" class="btn btn-primary" title="List"><< Back</a>
			</div>
			<br />	  
		</div>
		<!-- /content wrapper -->

	</div>
	<!-- /content -->
	
</div>
<!-- /content container -->

<!-- /content Popup -->
<div id="dialog-rkepangkatan" title=""> 
	<form id="form-popup1" method="post" action="" >
		<input type="hidden" id="id_rkepangkatan" name="id_rkepangkatan" value="" />
		<input type="hidden" id="nip_baru1" name="nip_baru1" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		
		<table>
			<tr>
				<td>Status Kepegawaian</td>
				<td>:</td>
				<td>
				<select id="pangkatpertama" name="pangkatpertama" class="input-medium is_required">
					<option value="CPNS">CPNS</option>
					<option value="PNS">PNS</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>Golongan</td>
				<td>:</td>
				<td>
					<select id="golongan1" name="golongan1" class="input-medium is_required">
						<option value=""> </option>
						<?php
							foreach($data_golongan as $row){
								
								echo "<option value='".$row->kode_golongan."' >".$row->kode_golongan."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nama Gol / Pangkat</td>
				<td>:</td>
				<td>
					<input id="pangkat1" type="text" name="pangkat1" class="input-large is_required" />
				</td>
			</tr>
			<tr>
				<td>TMT Kepangkatan</td>
				<td>:</td>
				<td>
					<input id="tmt1" type="text" name="tmt1" class="input-medium datepicker" />
				</td>
			</tr>
			<tr>
				<td>Pejabat Penandatangan</td>
				<td>:</td>
				<td>
					<input id="pejabat1" type="text" name="pejabat1" class="input-large" />
				</td>
			</tr>
			<tr>
				<td>No SK</td>
				<td>:</td>
				<td>
					<input id="no_sk1" type="text" name="no_sk1" class="input-large" />
				</td>
			</tr>
			<tr>
				<td>Tanggal SK</td>
				<td>:</td>
				<td>
					<input id="tanggal_sk1" type="text" name="tanggal_sk1" class="input-medium datepicker" />
				</td>
			</tr>
			<tr>
				<td>Pangkat Terakhir ?</td>
				<td>:</td>
				<td>
					<input id="is_last1" name="is_last1" type="checkbox" value="Ya"  > 
				</td>
			</tr>
		</table>	
	</form>
</div>

<div id="dialog-rpendidikan" title=""> 
	<form id="form-popup2" method="post" action="" >
		<input type="hidden" id="id_rpendidikan" name="id_rpendidikan" value="" />
		<input type="hidden" id="nip_baru2" name="nip_baru2" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Strata</td>
				<td>:</td>
				<td>
					<select id="strata2" name="strata2" class="input-large is_required">
						<option value=""> </option>
						<?php
							foreach($data_strata as $row){
								
								echo "<option value='".$row->id_strata."' >".$row->nama_strata."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td>:</td>
				<td>
					<select id="kategori2" name="kategori2" class="input-large is_required" >
						<option value=""> </option>
						<?php
							foreach($data_kategori_dik as $row){
								
								echo "<option value='".$row->value."' >".$row->value."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jenis Tenaga</td>
				<td>:</td>
				<td>
					<select id="jenis_tenaga2" name="jenis_tenaga2" class="input-large" >
						<option value=""> </option>
						<option value="Medis">Medis </option>
						<option value="Non Kesehatan">Non Kesehatan </option>
						<option value="Keperawatan">Keperawatan </option>
						<option value="Kesehatan Masyarakat">Kesehatan Masyarakat </option>						
					</select>
				</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>
					<input id="program_studi2" type="text" name="program_studi2" class="input-large" />
				</td>
			</tr>	
			<tr>
				<td>Jurusan</td>
				<td>:</td>
				<td>
					<input id="jurusan2" type="text" name="jurusan2" class="input-large" />
				</td>
			</tr>	
			<tr>
				<td>Nama Sekolah</td>
				<td>:</td>
				<td>
					<input id="nama_sekolah2" type="text" name="nama_sekolah2" class="input-large" />
				</td>
			</tr>	
			<tr>
				<td>Tahun Lulus</td>
				<td>:</td>
				<td>
					<input id="tahun_lulus2" type="text" name="tahun_lulus2" class="input-small" />
				</td>
			</tr>	
			<tr>
				<td>Pendidikan Saat Diangkat</td>
				<td>:</td>
				<td>
					<select id="pendidikan_saat_diangkat2" name="pendidikan_saat_diangkat2" class="input-small">
					   <option value="Tidak" selected>Tidak</option>
					   <option value="Ya">Ya</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Pendidikan Terakhir ?</td>
				<td>:</td>
				<td>
					<input id="is_last2" name="is_last2" type="checkbox" value="Ya"  > 
				</td>
			</tr>
			
		</table>	
	</form>
</div>

<div id="dialog-rjabatan" title=""> 
	<form id="form-popup3" method="post" action="" >
		<input type="hidden" id="id_rjabatan" name="id_rjabatan" value="" />
		<input type="hidden" id="nip_baru3" name="nip_baru3" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Tipe Jabatan</td>
				<td>:</td>
				<td>
					<select name="jabatan3" id="jabatan3" class="input-small">
						<option value=""></option>
						<?php
							foreach($data_status_jabatan as $row){
								 ?>
								<option value="<?php echo $row->id_status_jabatan?>"><?php echo $row->nama_status_jabatan?></option>
							<?php }
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nama Jabatan</td>
				<td>:</td>
				<td>
					<span id="onNamaJabatan3">
						<select name="nama_jabatan3" id="nama_jabatan3" class="input-large">							
						</select>
					</span>
				</td>
			</tr>
			<tr>
				<td>Eselon</td>
				<td>:</td>
				<td>
					<select name="eselon3" id="eselon3" class="input-small">
						<option value=""></option>
						<?php
							foreach($data_eselon as $row){
								
								echo "<option value='".$row->nama_eselon."'>".$row->nama_eselon."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>No SK</td>
				<td>:</td>
				<td>
					<input id="no_sk3" type="text" name="no_sk3" class="input-large" />
				</td>
			</tr>	
			<tr>
				<td>Tanggal SK</td>
				<td>:</td>
				<td>
					<input id="tgl_sk3" type="text" name="tgl_sk3" class="input-medium datepicker" />
				</td>
			</tr>
			<tr>
				<td>TMT Jabatan</td>
				<td>:</td>
				<td>
					<input id="tmt_jabatan3" type="text" name="tmt_jabatan3" class="input-medium datepicker" />
				</td>
			</tr>
			<tr>
				<td>Tgl Masuk Unit</td>
				<td>:</td>
				<td>
					<input id="tgl_masuk_unit3" type="text" name="tgl_masuk_unit3" class="input-medium datepicker" />
				</td>
			</tr>
			<tr>
				<td>Instansi Bekerja</td>
				<td>:</td>
				<td>
					<select name="instansi_bekerja3" id="instansi_bekerja3" class="input-xlarge" >
						<option></option>
						<option value="Kementerian Kesehatan RI" selected="selected">Kementerian Kesehatan RI</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Organisasi Kerja</td>
				<td>:</td>
				<td>
					<select name="organisasi_kerja3" id="organisasi_kerja3" class="input-xlarge" onchange="change_organisasi_kerja3()">
						<option></option>
						<?php
						if($data_organisasi_kerja){
							foreach($data_organisasi_kerja as $row){								
								echo "<option value='".$row->kode_unit_kerja."'>".$row->nama_unit_kerja."</option>";
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Satuan Kerja</td>
				<td>:</td>
				<td>
					<span id="onSatuanKerja">
						<select name="satuan_kerja3" id="satuan_kerja3" class="input-xlarge">
							<option></option>
						</select>
					</span>
				</td>
			</tr>	
			<tr>
				<td>Satuan Organisasi</td>
				<td>:</td>
				<td>
					<span id="onSatuanOrganisasi">
						<select name="satuan_organisasi3" id="satuan_organisasi3" class="input-xlarge">
							<option></option>
						</select>
					</span>
				</td>
				
			</tr>
			<tr>
				<td>Unit Organisasi</td>
				<td>:</td>
				<td>
					<span id="onUnitOrganisasi">
						<select name="unit_organisasi3" id="unit_organisasi3" class="input-xlarge">
							<option></option>
						</select>
					</span>
				</td>				
			</tr>
			<tr>
				<td>Unit Kerja</td>
				<td>:</td>
				<td>
					<span id="onUnitKerja">
						<select name="unit_kerja3" id="unit_kerja3" class="input-xlarge">
							<option></option>
						</select>
					</span>
				</td>				
			</tr>
			<tr>
				<td>Unit Kerja Penempatan</td>
				<td>:</td>
				<td><input name="unit_kerja_penempatan3" id="unit_kerja_penempatan3" class="input-xlarge" type="text"></td>
			</tr>
			<tr>
				<td>Propinsi</td>
				<td>:</td>
				<td>
					<select id="s_propinsi3" name="s_propinsi3" class="input-large">
						<option value=""> </option>
						<?php										
							foreach($data_prov as $row){
								
								echo "<option value='".$row->prov_id."'>".strtoupper($row->prov_name)."</option>";
							}
						?>													
					</select>
					<input type="hidden" id="propinsi3" name="propinsi3" />
				</td>
			</tr>
			<tr>
				<td>Kabupaten/Kota</td>
				<td>:</td>
				<td>
					<span id="onKabupaten3">
						<select id="kabupaten3" name="kabupaten3" class="input-large">
							<option value=""> </option>
							<?php																										
								foreach($data_city as $row){
									
									echo "<option value='".$row->city_name."'>".strtoupper($row->city_name)."</option>";
								}
							?>													
						</select>
					</span>
				</td>
			</tr>
			
			<tr>
				<td>Kelas Jabatan</td>
				<td>:</td>
				<td>
					<input name="kelas_jabatan3" id="kelas_jabatan3" class="input-small" type="text">
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td>
					<input name="keterangan3" id="keterangan3" class="input-xlarge" type="text">
				</td>
			</tr>
			<tr>
				<td>Jabatan Terakhir ?</td>
				<td>:</td>
				<td>
					<input id="is_last3" name="is_last3" type="checkbox" value="Ya"  > 
				</td>
			</tr>
			
		</table>	
	</form>
</div>

<div id="dialog-rdokumen" title=""> 
	<form id="form-popup4" method="post" action=""  enctype="multipart/form-data">
		<input type="hidden" id="id_rdokumen" name="id_rdokumen" value="" />
		<input type="hidden" id="nip_baru4" name="nip_baru4" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Tipe Dokumen</td>
				<td>:</td>
				<td>
					<select id="tipe_dokumen4" name="tipe_dokumen4" class="input-large is_required">
						<option value=""> </option>
						<?php
							foreach($data_tipe_dokumen as $row){
								
								echo "<option value='".$row->id."' >".$row->tipe_dokumen."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nama Dokumen</td>
				<td>:</td>
				<td>
					<input id="nama_dokumen4" type="text" name="nama_dokumen4" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Upload Dokumen</td>
				<td>:</td>
				<td>
					<span id="filename4_txt"></span>
					<br />
					<input id="jenis_doc" type="hidden" name="jenis" />
					<input id="jenis_id" type="hidden" name="jenis_id" />
					<input id="filename4" type="file" name="filename4" accept=".png,.jpg,.jpeg,.gif,.docx,.doc,.xlsx,.xls,.pdf" class="input-medium" />
				
				</td>
			</tr>
			
		</table>	
	</form>
</div>

<div id="dialog-rdiklatjabatan" title=""> 
	<form id="form-popup5" method="post" action="" >
		<input type="hidden" id="id_rdiklatjabatan" name="id_rdiklatjabatan" value="" />
		<input type="hidden" id="nip_baru5" name="nip_baru5" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Jenis Pelatihan</td>
				<td>:</td>
				<td>
					<select id="jenis_pelatihan5" name="jenis_pelatihan5" class="input-small is_required">
						<option value=""></option>
						<option value="Struktural">Struktural</option>
						<option value="Fungsional">Fungsional</option>
						<option value="Staf">Staf</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nama Pelatihan</td>
				<td>:</td>
				<td>
					<select name="nama_pelatihan5" id="nama_pelatihan5" class="input-xlarge">
						<option value=""></option>
						<?php
							foreach($data_pelatihan as $row){
								
								echo "<option value='".$row->id_pelatihan."'>".$row->nama_pelatihan."</option>";
							}
						?>
					</select>
				</td>
			</tr>	
			<tr>
				<td>Lembaga Pelaksana</td>
				<td>:</td>
				<td>
					<input id="lembaga_pelaksana5" type="text" name="lembaga_pelaksana5" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>Tahun Sertifikasi</td>
				<td>:</td>
				<td>
					<input id="tahun_sertifikasi5" type="text" name="tahun_sertifikasi5" class="input-small" />
				</td>
			</tr>	
			<tr>
				<td>Jumlah Jam Kursus</td>
				<td>:</td>
				<td>
					<input name="jml_jam_kursus5" id="jml_jam_kursus5" class="input-small" type="text">
				</td>
			</tr>
			<tr>
				<td>Diklat Terakhir ?</td>
				<td>:</td>
				<td>
					<input id="is_last5" name="is_last5" type="checkbox" value="Ya"  > 
				</td>
			</tr>
			
		</table>	
	</form>
</div>

<div id="dialog-rdiklatteknis" title=""> 
	<form id="form-popup6" method="post" action="" >
		<input type="hidden" id="id_rdiklatteknis" name="id_rdiklatteknis" value="" />
		<input type="hidden" id="nip_baru6" name="nip_baru6" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Kategori</td>
				<td>:</td>
				<td>
					<select id="kategori6" name="kategori6" class="input-medium is_required">
						<option value=""></option>
						<?php
							foreach($data_kategori_diklat as $row){
								
								echo "<option value='".$row->value."'>".$row->value."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nama Pelatihan</td>
				<td>:</td>
				<td>
					<input id="nama_pelatihan6" type="text" name="nama_pelatihan6" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>Lembaga Pelaksana</td>
				<td>:</td>
				<td>
					<input id="lembaga_pelaksana6" type="text" name="lembaga_pelaksana6" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>Negara Pelaksana</td>
				<td>:</td>
				<td>
					<input id="negara_pelaksana6" type="text" name="negara_pelaksana6" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>Jenis Pelatihan</td>
				<td>:</td>
				<td>
					<input id="jenis_pelatihan6" type="text" name="jenis_pelatihan6" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>Tahun Sertifikasi</td>
				<td>:</td>
				<td>
					<input id="tahun_sertifikasi6" type="text" name="tahun_sertifikasi6" class="input-small" />
				</td>
			</tr>	
			<tr>
				<td>Jumlah Jam Kursus</td>
				<td>:</td>
				<td>
					<input name="jml_jam_kursus6" id="jml_jam_kursus6" class="input-small" type="text">
				</td>
			</tr>
			<tr>
				<td>Diklat Terakhir ?</td>
				<td>:</td>
				<td>
					<input id="is_last6" name="is_last6" type="checkbox" value="Ya"  > 
				</td>
			</tr>
		</table>	
	</form>
</div>

<div id="dialog-rpenghargaan" title=""> 
	<form id="form-popup7" method="post" action="" >
		<input type="hidden" id="id_rpenghargaan" name="id_rpenghargaan" value="" />
		<input type="hidden" id="nip_baru7" name="nip_baru7" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Instansi Pelaksana</td>
				<td>:</td>
				<td>
					<select id="instansi_pelaksana7" name="instansi_pelaksana7" class="input-medium is_required">
						<option value=""></option>
						<option value="PRESIDEN">PRESIDEN</option>
						<option value="MENTERI KESEHATAN">MENTERI KESEHATAN</option>
						<option value="INSTANSI PEMERINTAH LAINNYA">INSTANSI PEMERINTAH LAINNYA</option>						
					</select>
				</td>
			</tr>
			<tr>
				<td>Nama Penghargaan</td>
				<td>:</td>
				<td>
					<select id="nama_penghargaan7" name="nama_penghargaan7" class="input-xlarge" >
						<option value=""> </option>
						<?php
							foreach($data_penghargaan as $row){
								
								echo "<option value='".$row->id_penghargaan."' >".$row->nama_penghargaan."</option>";
							}
						?>
					</select>
				</td>
			</tr>	
			<tr>
				<td>Tanda Jasa</td>
				<td>:</td>
				<td>
					<input id="tanda_jasa7" type="text" name="tanda_jasa7" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>No SK</td>
				<td>:</td>
				<td>
					<input id="no_sk7" type="text" name="no_sk7" class="input-medium" />
				</td>
			</tr>	
			<tr>
				<td>Tanggal SK</td>
				<td>:</td>
				<td>
					<input id="tgl_sk7" type="text" name="tgl_sk7" class="input-medium datepicker" />
				</td>
			</tr>	
			<tr>
				<td>Penghargaan Terakhir ?</td>
				<td>:</td>
				<td>
					<input id="is_last7" name="is_last7" type="checkbox" value="Ya"  > 
				</td>
			</tr>
		</table>	
	</form>
</div>

<div id="dialog-rkeluarga" title=""> 
	<form id="form-popup8" method="post" action="" >
		<input type="hidden" id="id_rkeluarga" name="id_rkeluarga" value="" />
		<input type="hidden" id="nip_baru8" name="nip_baru8" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Nama Anak</td>
				<td>:</td>
				<td>
					<input id="nama_anak8" type="text" name="nama_anak8" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td>
					<input id="tanggal_lahir8" type="text" name="tanggal_lahir8" class="input-medium datepicker" />
				</td>
			</tr>	
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<select id="jenis_kelamin8" name="jenis_kelamin8" class="input-medium is_required">
						<option value=""></option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>					
					</select>
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td>
					<input id="status8" type="text" name="status8" class="input-medium" />
				</td>
			</tr>	
			
		</table>	
	</form>
</div>

<div id="dialog-rkinerja" title=""> 
	<form id="form-popup9" method="post" action="" >
		<input type="hidden" id="id_rkinerja" name="id_rkinerja" value="" />
		<input type="hidden" id="nip_baru9" name="nip_baru9" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>
					<select name="jabatan9" id="jabatan9" class="input-xlarge">
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
				<td>Capaian SKP</td>
				<td>:</td>
				<td>
					<input id="capaian_skp9" type="text" name="capaian_skp9" class="input-xlarge" />
				</td>
			</tr>	
			<tr>
				<td>Pejabat Penilai</td>
				<td>:</td>
				<td>
					<input id="pejabat_penilai9" type="text" name="pejabat_penilai9" class="input-xlarge" />
				</td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td>:</td>
				<td>
					<input id="tahun9" type="text" name="tahun9" class="input-small" />
				</td>
			</tr>	
			
		</table>	
	</form>
</div>

<div id="dialog-rkompetensi" title=""> 
	<form id="form-popup10" method="post" action="" >
		<input type="hidden" id="id_rkompetensi" name="id_rkompetensi" value="" />
		<input type="hidden" id="nip_baru10" name="nip_baru10" value="<?php echo $hd_nip_baru ?>" />
		<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>" />
		<table>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>
					<select name="jabatan10" id="jabatan10" class="input-xlarge">
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
				<td>Capaian SKP</td>
				<td>:</td>
				<td>
					<input id="kompetensi10" type="text" name="kompetensi10" class="input-xlarge" />
				</td>
			</tr>	
		</table>	
	</form>
</div>


<script type="text/javascript"> 
 $(function() {
		$( ".datepicker" ).datepicker({ 
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-90:+0"
		});
		

	//===== Datatables =====//
	oTable_rkepangkatan = $('table#list-rkepangkatan').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkepangkatan/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rpendidikan = $('table#list-rpendidikan').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rpendidikan/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rjabatan = $('table#list-rjabatan').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rjabatan/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rdokumen = $('table#list-rdokumen').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rdokumen/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rdiklatjabatan = $('table#list-rdiklatjabatan').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rdiklatjabatan/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rdiklatteknis = $('table#list-rdiklatteknis').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rdiklatteknis/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rpenghargaan = $('table#list-rpenghargaan').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rpenghargaan/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rkeluarga = $('table#list-rkeluarga').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkeluarga/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rkinerja = $('table#list-rkinerja').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkinerja/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rkompetensi = $('table#list-rkompetensi').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkompetensi/edit",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({
				name: "nip_baru", value: $('#hd_nip_baru').val(),
				name: "id_peg", value: $('#id_peg').val()
				});
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	

	//Tambah
	$( "#add-rkepangkatan" ).button().click(function() {
		open_dialog_rkepangkatan('', 'Add Riwayat Kepangkatan');
	});
	$( "#add-rpendidikan" ).button().click(function() {
		open_dialog_rpendidikan('', 'Add Riwayat Pendidikan');
	});
	$( "#add-rjabatan" ).button().click(function() {
		open_dialog_rjabatan('', 'Add Riwayat Jabatan');
	});
	$( "#add-rdokumen" ).button().click(function() {
		open_dialog_rdokumen('', 'Add Dokumen');
	});
	$( "#add-rdiklatjabatan" ).button().click(function() {
		open_dialog_rdiklatjabatan('', 'Add Riwayat Diklat Jabatan');
	});
	$( "#add-rdiklatteknis" ).button().click(function() {
		open_dialog_rdiklatteknis('', 'Add Riwayat Diklat Teknis');
	});
	$( "#add-rpenghargaan" ).button().click(function() {
		open_dialog_rpenghargaan('', 'Add Riwayat Penghargaan');
	});
	$( "#add-rkeluarga" ).button().click(function() {
		open_dialog_rkeluarga('', 'Add Riwayat Keluarga');
	});	
	$( "#add-rkinerja" ).button().click(function() {
		open_dialog_rkinerja('', 'Add Riwayat Kinerja');
	});
	$( "#add-rkompetensi" ).button().click(function() {
		open_dialog_rkompetensi('', 'Add Riwayat Kompetensi');
	});
		
	//onChange Province-city
	$( "#s_propinsi3" ).change(function() {
		var prov_id = $( "#s_propinsi3 option:selected" ).val();
		var prov_txt = $( "#s_propinsi3 option:selected" ).text();
		$( "#propinsi3" ).val(prov_txt);
		if(prov_id){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/change_prov",
				data: "prov_id="+ prov_id + "&kab=kabupaten3", 
				success: function(msg){	
					if(msg){
						$( "#onKabupaten3" ).html(msg);
					}
					return false;
				}
			});
		}
	});	
	
	//onChange Golongan
	$( "#golongan1" ).change(function() {
		var golongan1 = $( "#golongan1" ).val();
		if(golongan1){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/change_golongan",
				data: "golongan1="+ golongan1, 
				success: function(msg){	
					if(msg){
						$( "#pangkat1" ).val(msg);
					}
					return false;
				}
			});
		}
	});	
	
		
});

//OnChange Org
function change_organisasi_kerja3(){
	var organisasi_kerja3 = $( "#organisasi_kerja3 option:selected" ).val(); 
	if(organisasi_kerja3){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/change_organisasi_kerja",
			data: "organisasi_kerja3="+ organisasi_kerja3, 
			success: function(msg){	
				if(msg){
					$( "#onSatuanKerja" ).html(msg);
				}
				
			}
		});
	}
}

function change_satuan_kerja3(){
	var satuan_kerja3 = $( "#satuan_kerja3 option:selected" ).val();
	if(satuan_kerja3){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/change_satuan_kerja",
			data: "satuan_kerja3="+ satuan_kerja3, 
			success: function(msg){	
				if(msg){
					$( "#onSatuanOrganisasi" ).html(msg);
				}
				return false;
			}
		});
	}
}

function change_satuan_organisasi3(){
		var satuan_organisasi3 = $( "#satuan_organisasi3 option:selected" ).val();
		if(satuan_organisasi3){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/change_satuan_organisasi",
				data: "satuan_organisasi3="+ satuan_organisasi3, 
				success: function(msg){	
					if(msg){
						$( "#onUnitOrganisasi" ).html(msg);
					}
					return false;
				}
			});
		}
}
	
function change_unit_organisasi3(){
		var unit_organisasi3 = $( "#unit_organisasi3 option:selected" ).val();
		if(unit_organisasi3){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/change_unit_organisasi",
				data: "unit_organisasi3="+ unit_organisasi3, 
				success: function(msg){	
					if(msg){
						$( "#onUnitKerja" ).html(msg);
					}
					return false;
				}
			});
		}
}

function onUpload(id,type){
	open_dialog_rdokumen('','Add Dokumen',type,id);
}

//===Riwayat Kepangkatan===	
function onEditRkepangkatan(id) {
	open_dialog_rkepangkatan(id, 'Edit Riwayat Kepangkatan');
}

function onDeleteRkepangkatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rkepangkatan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rkepangkatan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rkepangkatan(id, titlex) {

	$( "#id_rkepangkatan" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rkepangkatan/"+id,
			//data: $('#form-popup1').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#pangkat1" ).val( dt[1] );
				$( "#golongan1" ).val( dt[2] );
				$( "#tmt1" ).val( dt[3] );
				$( "#no_sk1" ).val( dt[4] );
				$( "#tanggal_sk1" ).val( dt[5] );
				$( "#pejabat1" ).val( dt[6] );
				if(dt[7]=='Ya'){
					$( "#is_last1" ).prop('checked', true);
				}else{
					$( "#is_last1" ).prop('checked', false);
				}
				$( "#pangkatpertama" ).val( dt[8] );
			}
		});
	}else{
		$( "#pangkatpertama" ).val("CPNS");
		$( "#pangkat1" ).val( "" );
		$( "#golongan1" ).val( "" );
		$( "#tmt1" ).val( "" );
		$( "#no_sk1" ).val( "" );
		$( "#tanggal_sk1" ).val( "" );
		$( "#pejabat1" ).val( "" );
		$( "#is_last1" ).prop('checked', false);
	}
	
	$( "#dialog-rkepangkatan" ).dialog({
		  autoOpen: false,
		  height: 350,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
			  ////pangkat1, golongan1, tmt1, pejabat1,no_sk1, tanggal_sk1
				var pangkatpertama = $( "#pangkatpertama" ).val(); 
				var pangkat1 = $( "#pangkat1" ).val(); 
				var golongan1 = $( "#golongan1" ).val(); 
				var tmt1 = $( "#tmt1" ).val(); 
				var pejabat1 = $( "#pejabat1" ).val(); 
				var no_sk1 = $( "#no_sk1" ).val(); 
				var tanggal_sk1 = $( "#tanggal_sk1" ).val(); 
				
				if(pangkat1 == ''){
					$( "#pangkat1" ).addClass("invalid");
					bValid = false;
				}		
				if(golongan1 == ''){
					$( "#golongan1" ).addClass("invalid");
					bValid = false;
				}		
				if(tmt1 == ''){
					$( "#tmt1" ).addClass("invalid");
					bValid = false;
				}	
				if(pejabat1 == ''){
					$( "#pejabat1" ).addClass("invalid");
					bValid = false;
				}		
				if(no_sk1 == ''){
					$( "#no_sk1" ).addClass("invalid");
					bValid = false;
				}		
				if(tanggal_sk1 == ''){
					$( "#tanggal_sk1" ).addClass("invalid");
					bValid = false;
				}	
				
			  if ( bValid ) {
				$( "#pangkat1" ).removeClass("invalid");		
				$( "#golongan1" ).removeClass("invalid");		
				$( "#tmt1" ).removeClass("invalid");
				$( "#pejabat1" ).removeClass("invalid");
				$( "#no_sk1" ).removeClass("invalid");
				$( "#tanggal_sk1" ).removeClass("invalid");
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_popup_rkepangkatan/"+id,
					data: $('#form-popup1').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							oTable_rkepangkatan.fnDraw();
									
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
	
	$( "#dialog-rkepangkatan" ).dialog( "open" );
	
}
	
//====Riwayat Pendidikan====
function onEditRpendidikan(id) {
	open_dialog_rpendidikan(id, 'Edit Riwayat Pendidikan');
}
	
function onDeleteRpendidikan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rpendidikan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rpendidikan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rpendidikan(id, titlex) {

	$( "#id_rpendidikan" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rpendidikan/"+id,
			//data: $('#form-popup2').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#strata2" ).val( dt[1] );
				$( "#kategori2" ).val( dt[2] );
				$( "#jenis_tenaga2" ).val( dt[3] );
				$( "#program_studi2" ).val( dt[4] );
				$( "#jurusan2" ).val( dt[5] );
				$( "#nama_sekolah2" ).val( dt[6] );
				$( "#tahun_lulus2" ).val( dt[7] );
				$( "#pendidikan_saat_diangkat2" ).val( dt[8] );
				
				if(dt[9]=='Ya'){
					$( "#is_last2" ).prop('checked', true);
				}else{
					$( "#is_last2" ).prop('checked', false);
				}
			}
		});
	}else{
		$( "#strata2" ).val( "" );
		$( "#kategori2" ).val( "" );
		$( "#jenis_tenaga2" ).val( "" );
		$( "#program_studi2" ).val( "" );
		$( "#jurusan2" ).val( "" );
		$( "#nama_sekolah2" ).val( "" );
		$( "#tahun_lulus2" ).val( "" );
		$( "#pendidikan_saat_diangkat2" ).val( "" );
		$( "#is_last2" ).prop('checked', true);
	}
	
	$( "#dialog-rpendidikan" ).dialog({
		  autoOpen: false,
		  height: 400,
		  width: 440,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
		
				var strata2 = $( "#strata2" ).val(); 
				var nama_sekolah2 = $( "#nama_sekolah2" ).val(); 
				var tahun_lulus2 = $( "#tahun_lulus2" ).val(); 
				
				if(strata2 == ''){
					$( "#strata2" ).addClass("invalid");
					bValid = false;
				}		
				if(nama_sekolah2 == ''){
					$( "#nama_sekolah2" ).addClass("invalid");
					bValid = false;
				}		
				if(tahun_lulus2 == ''){
					$( "#tahun_lulus2" ).addClass("invalid");
					bValid = false;
				}		
			  if ( bValid ) {
				$( "#strata2" ).removeClass("invalid");		
				$( "#nama_sekolah2" ).removeClass("invalid");		
				$( "#tahun_lulus2" ).removeClass("invalid");
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_popup_rpendidikan/"+id,
					data: $('#form-popup2').serialize(), 
					success: function(msg){	
						if(msg == 'success'){
							oTable_rpendidikan.fnDraw();
							
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
	
	$( "#dialog-rpendidikan" ).dialog( "open" );
}


//====Riwayat Jabatan====
function onEditrjabatan(id) {
	open_dialog_rjabatan(id, 'Edit Riwayat Jabatan');
}
	
function onDeleterjabatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rjabatan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rjabatan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rjabatan(id, titlex) {
	$( "#id_rjabatan" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rjabatan/"+id,
			//data: $('#form-popup3').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#jabatan3" ).val( dt[1] ).change();
				$( "#eselon3" ).val( dt[3] );
				$( "#no_sk3" ).val( dt[4] );
				$( "#tgl_sk3" ).val( dt[5] );
				$( "#tmt_jabatan3" ).val( dt[6] );
				$( "#tgl_masuk_unit3" ).val( dt[7] );
				$( "#instansi_bekerja3" ).val( dt[8] ).change();
				$( "#organisasi_kerja3" ).val( dt[9] ).change();
				$( "#satuan_kerja3" ).val( dt[10] ).change();
				$( "#satuan_organisasi3" ).val( dt[11] ).change();
				$( "#unit_organisasi3" ).val( dt[12] ).change();
				$( "#unit_kerja3" ).val( dt[13] ).change();
				$( "#unit_kerja_penempatan3" ).val( dt[14] );
				//$( "#propinsi3" ).val( dt[15] );
				$( "#kabupaten3" ).val( dt[16] );
				//$( "#tipe_jabatan_formasi3" ).val( dt[17] );
				//$( "#nama_jabatan_formasi3 option:selected" ).text( dt[17] );
				$( "#kelas_jabatan3" ).val( dt[17] );
				$( "#keterangan3" ).val( dt[18] );
				if(dt[19]=='Ya'){
					$( "#is_last3" ).prop('checked', true);
				}else{
					$( "#is_last3" ).prop('checked', false);
				}
				setTimeout(function(){
						$( "#s_propinsi3" ).val( dt[15] ).change();
						setTimeout(function(){
							$( "#kabupaten3" ).val( dt[16] );
						},1100);
				},1500);
				setTimeout(function(){
						$( "#nama_jabatan3" ).val( dt[0] );
				},1500);
				setTimeout(function(){
						$( "#satuan_kerja3" ).val( dt[10] ).change();
						
						setTimeout(function(){
							$( "#satuan_organisasi3" ).val( dt[11] ).change();
								setTimeout(function(){
										$( "#unit_organisasi3" ).val( dt[12] ).change();
											setTimeout(function(){
													$( "#unit_kerja3" ).val( dt[13] );
											},1100);
								},1200);
						},1300);
				},1500);
				
			}
		});
	}else{
		$( "#jabatan3" ).val( "" );
		$( "#nama_jabatan3" ).val( "" );
		$( "#eselon3" ).val( "" );
		$( "#no_sk3" ).val( "" );
		$( "#tgl_sk3" ).val( "" );
		$( "#tmt_jabatan3" ).val( "" );
		$( "#tgl_masuk_unit3" ).val( "" );
		$( "#instansi_bekerja3" ).val( "" );
		$( "#organisasi_kerja3" ).val( "" );
		$( "#satuan_kerja3" ).val( "" );
		$( "#satuan_organisasi3" ).val( "" );
		$( "#unit_organisasi3" ).val( "" );
		$( "#unit_kerja3" ).val( "" );
		$( "#unit_kerja_penempatan3" ).val( "" );
		$( "#propinsi3" ).val( "" );
		$( "#kabupaten3" ).val( "" );
		//$( "#nama_jabatan_formasi3" ).val( "" );
		$( "#kelas_jabatan3" ).val( "" );
		$( "#keterangan3" ).val( "" );
		$( "#is_last3" ).prop('checked', false);
	}
	
	$( "#dialog-rjabatan" ).dialog({
		  autoOpen: false,
		  height: 550,
		  width: 540,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var jabatan3 = $( "#jabatan3" ).val(); 
				var tmt_jabatan3 = $( "#tmt_jabatan3" ).val(); 
				var tgl_masuk_unit3 = $( "#tgl_masuk_unit3" ).val(); 
				
				if(jabatan3 == ''){
					$( "#jabatan3" ).addClass("invalid");
					bValid = false;
				}		
				if(tmt_jabatan3 == ''){
					$( "#tmt_jabatan3" ).addClass("invalid");
					bValid = false;
				}		
				if(tgl_masuk_unit3 == ''){
					$( "#tgl_masuk_unit3" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$( "#jabatan3" ).removeClass("invalid");		
					$( "#tmt_jabatan3" ).removeClass("invalid");		
					$( "#tgl_masuk_unit3" ).removeClass("invalid");	
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rjabatan/"+id,
						data: $('#form-popup3').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								
								oTable_rjabatan.fnDraw();
										
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
	
	$( "#dialog-rjabatan" ).dialog( "open" );
		
}


//===Dokumen===	
function onEditrdokumen(id) {
	open_dialog_rdokumen(id, 'Edit Dokumen');
}

function onShowrdokumen(id) {
	open_dialog_rdokumen(id, 'Show Dokumen');
}

function onDeleterdokumen(id, name, file) {
	if(confirm('Delete data '+ name +' ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rdokumen/"+id,
			data: "id="+id+"&filex="+file, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rdokumen.fnDraw();
				}else{
					alert( 'Data '+ name +' tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rdokumen(id, titlex , jn, jid) {

	$( "#id_rdokumen" ).val( id );
	if(jn){
		$('#jenis_doc').val(jn);
		$('#jenis_id').val(jid);
	}else{
		$('#jenis_doc').val("");
		$('#jenis_id').val("");
	}
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rdokumen/"+id,
			data: $('#form-popup4').serialize(), 
			success: function(data){	
				var dt2 = explode('|', data);
				$( "#tipe_dokumen4" ).val( dt2[1] );
				$( "#nama_dokumen4" ).val( dt2[2] );
				//$( "#filename4" ).val( '' );
				$( "#filename4_txt" ).html( dt2[3] );
				
			}
		});
	}else{
		$( "#nama_dokumen4" ).val( "" );
		$( "#filename4" ).val( "" );
		$( "#filename4_txt" ).html( "" );
		$( "#tipe_dokumen4" ).val( "" );
	}
	
	$( "#dialog-rdokumen" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				var nama_dokumen4 = $( "#nama_dokumen4" ).val(); 
				var tipe_dokumen4 = $( "#tipe_dokumen4" ).val(); 
				var filename4 = $( "#filename4" ).val(); 
				var id_pegawai = $( "#hd_id" ).val(); 

				if(nama_dokumen4 == ''){
					$( "#nama_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
				if(tipe_dokumen4 == ''){
					$( "#tipe_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
	
			  if ( bValid ) {
					$( "#nama_dokumen4" ).removeClass("invalid");		
					$( "#tipe_dokumen4" ).removeClass("invalid");	
					
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_popup_rdokumen/"+id,
					data: $('#form-popup4').serialize() + "&filename4="+filename4+ "&id_pegawai="+id_pegawai, 
					success: function(msg){	
						datax = explode('#', msg);
						if(datax[0] == 'success'){		
							ajaxDocumentUpload(datax[1]);		
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
	
	$( "#dialog-rdokumen" ).dialog( "open" );
	
}

function ajaxDocumentUpload(id) {
	var hd_id = $( "#hd_id" ).val(); 
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});
	
	$.ajaxFileUpload
	({
			url:'<?php echo base_url(); ?>pegawai/do_popup_rdokumen/'+id,
			secureuri:false,
			fileElementId:'filename4',
			dataType : 'JSON',
			data:{id:hd_id},
			success: function (data)
			{
				datax = explode('#', data);
				if(datax[0] == 'success'){
					oTable_rdokumen.fnDraw();
				}else{
					alert('Upload Gagal!');
				}
			},
			error: function (data, status, e)
			{
				//alert(e);
			}
		});
	
	return false;
}

//====Riwayat Diklat Jabatan====
function onEditrdiklatjabatan(id) {
	open_dialog_rdiklatjabatan(id, 'Edit Riwayat Diklat Jabatan');
}
	
function onDeleterdiklatjabatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rdiklatjabatan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rdiklatjabatan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rdiklatjabatan(id, titlex) {
	$( "#id_rdiklatjabatan" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rdiklatjabatan/"+id,
			//data: $('#form-popup3').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#jenis_pelatihan5" ).val( dt[1] );
				$( "#nama_pelatihan5" ).val( dt[2] );
				$( "#lembaga_pelaksana5" ).val( dt[3] );
				$( "#tahun_sertifikasi5" ).val( dt[4] );
				$( "#jml_jam_kursus5" ).val( dt[5] );
				if(dt[6]=='Ya'){
					$( "#is_last5" ).prop('checked', true);
				}else{
					$( "#is_last5" ).prop('checked', false);
				}
			}
		});
	}else{
		$( "#jenis_pelatihan5" ).val( "" );
		$( "#nama_pelatihan5" ).val( "" );
		$( "#lembaga_pelaksana5" ).val( "" );
		$( "#tahun_sertifikasi5" ).val( "" );
		$( "#jml_jam_kursus5" ).val( "" );
		$( "#is_last5" ).prop('checked', false);
	}
	
	$( "#dialog-rdiklatjabatan" ).dialog({
		  autoOpen: false,
		  height: 300,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var jenis_pelatihan5 = $( "#jenis_pelatihan5" ).val(); 
				var nama_pelatihan5 = $( "#nama_pelatihan5" ).val(); 
				var lembaga_pelaksana5 = $( "#lembaga_pelaksana5" ).val(); 
				
				if(jenis_pelatihan5 == ''){
					$( "#jenis_pelatihan5" ).addClass("invalid");
					bValid = false;
				}		
				if(nama_pelatihan5 == ''){
					$( "#nama_pelatihan5" ).addClass("invalid");
					bValid = false;
				}		
				if(lembaga_pelaksana5 == ''){
					$( "#lembaga_pelaksana5" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$( "#jenis_pelatihan5" ).removeClass("invalid");		
					$( "#nama_pelatihan5" ).removeClass("invalid");	
					$( "#lembaga_pelaksana5" ).removeClass("invalid");	
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rdiklatjabatan/"+id,
						data: $('#form-popup5').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								oTable_rdiklatjabatan.fnDraw();
										
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
	
	$( "#dialog-rdiklatjabatan" ).dialog( "open" );
		
}

//====Riwayat Diklat Teknis====
function onEditrdiklatteknis(id) {
	open_dialog_rdiklatteknis(id, 'Edit Riwayat Diklat Teknis');
}
	
function onDeleterdiklatteknis(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rdiklatteknis/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rdiklatteknis.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rdiklatteknis(id, titlex) {
	$( "#id_rdiklatteknis" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rdiklatteknis/"+id,
			//data: $('#form-popup6').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#kategori6" ).val( dt[1] );
				$( "#nama_pelatihan6" ).val( dt[2] );
				$( "#lembaga_pelaksana6" ).val( dt[3] );
				$( "#negara_pelaksana6" ).val( dt[4] );
				$( "#jenis_pelatihan6" ).val( dt[5] );
				$( "#tahun_sertifikasi6" ).val( dt[6] );
				$( "#jml_jam_kursus6" ).val( dt[7] );
				if(dt[8]=='Ya'){
					$( "#is_last6" ).prop('checked', true);
				}else{
					$( "#is_last6" ).prop('checked', false);
				}
			}
		});
	}else{
		$( "#kategori6" ).val( "" );
		$( "#nama_pelatihan6" ).val( "" );
		$( "#lembaga_pelaksana6" ).val( "" );
		$( "#negara_pelaksana6" ).val( "" );
		$( "#jenis_pelatihan6" ).val( "" );
		$( "#tahun_sertifikasi6" ).val( "" );
		$( "#jml_jam_kursus6" ).val( "" );
		$( "#is_last6" ).prop('checked', false);
	}
	
	$( "#dialog-rdiklatteknis" ).dialog({
		  autoOpen: false,
		  height: 350,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var kategori6 = $( "#kategori6" ).val(); 
				var nama_pelatihan6 = $( "#nama_pelatihan6" ).val(); 
				var lembaga_pelaksana6 = $( "#lembaga_pelaksana6" ).val(); 
				
				if(kategori6 == ''){
					$( "#kategori6" ).addClass("invalid");
					bValid = false;
				}		
				if(nama_pelatihan6 == ''){
					$( "#nama_pelatihan6" ).addClass("invalid");
					bValid = false;
				}		
				if(lembaga_pelaksana6 == ''){
					$( "#lembaga_pelaksana6" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$( "#kategori6" ).removeClass("invalid");		
					$( "#nama_pelatihan6" ).removeClass("invalid");	
					$( "#lembaga_pelaksana6" ).removeClass("invalid");	
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rdiklatteknis/"+id,
						data: $('#form-popup6').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								oTable_rdiklatteknis.fnDraw();
										
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
	
	$( "#dialog-rdiklatteknis" ).dialog( "open" );
		
}


//====Riwayat Penghargaan====
function onEditrpenghargaan(id) {
	open_dialog_rpenghargaan(id, 'Edit Riwayat Penghargaan');
}
	
function onDeleterpenghargaan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rpenghargaan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rpenghargaan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rpenghargaan(id, titlex) {
	$( "#id_rpenghargaan" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rpenghargaan/"+id,
			//data: $('#form-popup7').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#instansi_pelaksana7" ).val( dt[1] );
				$( "#nama_penghargaan7" ).val( dt[2] );
				$( "#tanda_jasa7" ).val( dt[3] );
				$( "#no_sk7" ).val( dt[4] );
				$( "#tgl_sk7" ).val( dt[5] );
				if(dt[6]=='Ya'){
					$( "#is_last7" ).prop('checked', true);
				}else{
					$( "#is_last7" ).prop('checked', false);
				}
			}
		});
	}else{
		$( "#instansi_pelaksana7" ).val( "" );
		$( "#nama_penghargaan7" ).val( "" );
		$( "#tanda_jasa7" ).val( "" );
		$( "#no_sk7" ).val( "" );
		$( "#tgl_sk7" ).val( "" );
		$( "#is_last7" ).prop('checked', false);
	}
	
	$( "#dialog-rpenghargaan" ).dialog({
		  autoOpen: false,
		  height: 300,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var instansi_pelaksana7 = $( "#instansi_pelaksana7" ).val(); 
				var nama_penghargaan7 = $( "#nama_penghargaan7" ).val(); 
				
				if(instansi_pelaksana7 == ''){
					$( "#instansi_pelaksana7" ).addClass("invalid");
					bValid = false;
				}		
				if(nama_penghargaan7 == ''){
					$( "#nama_penghargaan7" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$( "#nama_penghargaan7" ).removeClass("invalid");		
					$( "#instansi_pelaksana7" ).removeClass("invalid");	
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rpenghargaan/"+id,
						data: $('#form-popup7').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								
								oTable_rpenghargaan.fnDraw();
										
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
	
	$( "#dialog-rpenghargaan" ).dialog( "open" );
		
}


//====Riwayat keluarga====
function onEditrkeluarga(id) {
	open_dialog_rkeluarga(id, 'Edit Riwayat keluarga');
}
	
function onDeleterkeluarga(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rkeluarga/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rkeluarga.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rkeluarga(id, titlex) {
	$( "#id_rkeluarga" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rkeluarga/"+id,
			//data: $('#form-popup8').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_anak8" ).val( dt[1] );
				$( "#tanggal_lahir8" ).val( dt[2] );
				$( "#jenis_kelamin8" ).val( dt[3] );
				$( "#status8" ).val( dt[4] );
			}
		});
	}else{
		$( "#nama_anak8" ).val( "" );
		$( "#tanggal_lahir8" ).val( "" );
		$( "#jenis_kelamin8" ).val( "" );
		$( "#status8" ).val( "" );
	}
	
	$( "#dialog-rkeluarga" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var nama_anak8 = $( "#nama_anak8" ).val(); 
				var tanggal_lahir8 = $( "#tanggal_lahir8" ).val(); 
				
				if(nama_anak8 == ''){
					$( "#nama_anak8" ).addClass("invalid");
					bValid = false;
				}		
				if(tanggal_lahir8 == ''){
					$( "#tanggal_lahir8" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rkeluarga/"+id,
						data: $('#form-popup8').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								$( "#nama_anak8" ).removeClass("invalid");		
								$( "#tanggal_lahir8" ).removeClass("invalid");	
								oTable_rkeluarga.fnDraw();
										
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
		}
		  
	}); 
	
	$( "#dialog-rkeluarga" ).dialog( "open" );
}


//====Riwayat Kinerja====
function onEditrkinerja(id) {
	open_dialog_rkinerja(id, 'Edit Riwayat Kinerja');
}
	
function onDeleterkinerja(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rkinerja/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rkinerja.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rkinerja(id, titlex) {
	$( "#id_rkinerja" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rkinerja/"+id,
			//data: $('#form-popup9').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#jabatan9" ).val( dt[1] );
				$( "#capaian_skp9" ).val( dt[2] );
				$( "#pejabat_penilai9" ).val( dt[3] );
				$( "#tahun9" ).val( dt[4] );
			}
		});
	}else{
		$( "#jabatan9" ).val( "" );
		$( "#capaian_skp9" ).val( "" );
		$( "#pejabat_penilai9" ).val( "" );
		$( "#tahun9" ).val( "" );
	}
	
	$( "#dialog-rkinerja" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var jabatan9 = $( "#jabatan9" ).val(); 
				var capaian_skp9 = $( "#capaian_skp9" ).val(); 
				
				if(jabatan9 == ''){
					$( "#jabatan9" ).addClass("invalid");
					bValid = false;
				}		
				if(capaian_skp9 == ''){
					$( "#capaian_skp9" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$( "#jabatan9" ).removeClass("invalid");		
					$( "#capaian_skp9" ).removeClass("invalid");	
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rkinerja/"+id,
						data: $('#form-popup9').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								
								oTable_rkinerja.fnDraw();
										
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
	
	$( "#dialog-rkinerja" ).dialog( "open" );
		
}


//====Riwayat Kompetensi====
function onEditrkompetensi(id) {
	open_dialog_rkompetensi(id, 'Edit Riwayat Kompetensi');
}
	
function onDeleterkompetensi(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rkompetensi/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rkompetensi.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rkompetensi(id, titlex) {
	$( "#id_rkompetensi" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rkompetensi/"+id,
			//data: $('#form-popup10').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#jabatan10" ).val( dt[1] );
				$( "#kompetensi10" ).val( dt[2] );
			}
		});
	}else{
		$( "#jabatan10" ).val( "" );
		$( "#kompetensi10" ).val( "" );
	}
	$( "#dialog-rkompetensi" ).dialog({
		  autoOpen: false,
		  height: 350,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var jabatan10 = $( "#jabatan10" ).val(); 
				var kompetensi10 = $( "#kompetensi10" ).val(); 
				
				if(jabatan10 == ''){
					$( "#jabatan10" ).addClass("invalid");
					bValid = false;
				}		
				if(kompetensi10 == ''){
					$( "#kompetensi10" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$( "#jabatan10" ).removeClass("invalid");		
					$( "#kompetensi10" ).removeClass("invalid");	
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rkompetensi/"+id,
						data: $('#form-popup10').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								oTable_rkompetensi.fnDraw();
										
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
	
	$( "#dialog-rkompetensi" ).dialog( "open" );
		
}


</script>
<?php $this->load->view('layout/_footer'); ?>
</body>
</html>