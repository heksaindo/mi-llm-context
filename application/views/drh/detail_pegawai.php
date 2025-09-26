<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	
	<script type="text/javascript"> 	
	$(document).ready(function(){
	
		$( "#dialog-request_user" ).hide();
		$( "#dialog-print_cv" ).hide();
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
					<li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
					<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
					<li><a href="<?php echo base_url(); ?>pegawai" title="">Daftar Riwayat Hidup Pegawai</a></li>
					<li class="active"><a href="#" title="">Detail Data Pegawai</a></li>					 
				</ul>
				<?php $this->load->view('layout/_messages'); ?>
			</div>
			<!-- /breadcrumbs line -->

			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h5>Detail Data Pegawai   </h5>  
				</div>
			</div>
			 <!-- /page header -->
				 
			<?php $this->load->view('layout/_actionwrapper'); ?>	  
				 
			<?php 
			
			if(!empty($hd_id)){ ?>
				  
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span2">	
							<div class="sidebar-user widget">			
								<div class="nav-foto">
									<?php if($data_pegawai->foto!=''){ $foto=$data_pegawai->foto; }else{ $foto='no-photo.jpg'; } ?>
									<img src="<?php echo APP_URL ?>/Uploads/foto/<?php echo $foto; ?>" width="200" alt="" />
								</div>
								<ul class="nav nav-tabs nav-left">
									<li><a data-toggle="tab" href="#tab5" title="" rel="5">Riwayat Kepangkatan</a></li>
									<li><a data-toggle="tab" href="#tab6" title="" rel="6">Riwayat Pendidikan</a></li>
									<li><a data-toggle="tab" href="#tab7" title="" rel="7">Riwayat Jabatan</a></li>
									<li><a data-toggle="tab" href="#tab8" title="" rel="8">Riwayat Diklat Jabatan</a></li>
									<li><a data-toggle="tab" href="#tab9" title="" rel="9">Riwayat Diklat Teknis</a></li>
									<li><a data-toggle="tab" href="#tab10" title="" rel="10">Riwayat Penghargaan</a></li>
									<li><a data-toggle="tab" href="#tab11" title="" rel="11">Suami/Istri</a></li>
									<li><a data-toggle="tab" href="#tab12" title="" rel="12">Riwayat Anak</a></li>
									<li><a data-toggle="tab" href="#tab13" title="" rel="13">Riwayat Kinerja</a></li>
									<li><a data-toggle="tab" href="#tab14" title="" rel="14">Riwayat Kompetensi</a></li>
								</ul>
							</div>
						</div>                        
						<div class="span9">
							<div class="widget-box">
							  <div class="widget-title">
								<ul class="nav nav-tabs">
								  <li class="active"><a data-toggle="tab" href="#tab1" rel="1">Identitas Pribadi</a></li>
								  <li><a data-toggle="tab" href="#tab2" rel="2">Kepegawaian</a></li>
								  <li><a data-toggle="tab" href="#tab3" rel="3">Tempat Kerja</a></li>
								  <li><a data-toggle="tab" href="#tab4" rel="4">Data Dokumen</a></li>
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
										<input type="hidden" id="id_peg" name="id_peg" value="<?php echo $id_peg ?>"/>
										<div class="control-group">
											<label class="control-label">NIP / NRP Lama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_lama;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP / NRP Baru  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_baru;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->gelar_depan; ?> &nbsp;
												 <?php echo $data_pegawai->nama;?> &nbsp;
												<?php echo $data_pegawai->gelar_belakang;?>											
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">No Kartu Pegawai  :</label>
											<div class="controls">
												<?php echo $data_pegawai->no_kartu;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Jenis Kelamin  :</label>
											<div class="controls">
												<?php echo $data_pegawai->jenis_kelamin;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Tempat Lahir  :</label>
											<div class="controls">
												<?php echo $data_pegawai->tempat_lahir;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Tanggal Lahir  :</label>
											<div class="controls">
												<?php if($data_pegawai->tanggal_lahir) echo date('d-m-Y', strtotime($data_pegawai->tanggal_lahir));?>
											</div>
										</div>									
										<div class="control-group">
											<label class="control-label">Agama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->agama_txt; ?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Status Perkawinan  :</label>
											<div class="controls">
												<?php echo $data_pegawai->perkawinan_txt; ?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Alamat  :</label>
											<div class="controls">
												<?php echo $data_pegawai->alamat;?>							
												<div style="margin-top:5px;">
													RT : <?php echo $data_pegawai->rt;?> &nbsp;&nbsp;&nbsp; / RW : <?php echo $data_pegawai->rw;?>&nbsp;&nbsp;&nbsp;
												</div>
												<div style="margin-top:5px;">
													Desa/Kelurahan : <?php echo $data_pegawai->kelurahan;?> &nbsp;&nbsp;&nbsp;
													Kecamatan : <?php echo $data_pegawai->kecamatan;?>
												</div>
												<div style="margin-top:5px;">
													Provinsi : <?php echo get_name('m_provinces','prov_name','prov_id', $data_pegawai->propinsi);?>
													&nbsp;&nbsp;&nbsp;
													Kab/Kota : <?php echo get_name('m_cities','city_name','city_id', $data_pegawai->kabupaten);?>
													
												</div>
												<div style="margin-top:5px;">
													Kodepos : <?php echo $data_pegawai->kodepos;?>
												</div>
												
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">No. Telp  :</label>
											<div class="controls">
												<?php echo $data_pegawai->telp;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Status KPE  :</label>
											<div class="controls">
												<?php echo $data_pegawai->status_kpe;?>
											</div>
										</div>
										
									</form>							
								</div>
								
								<div id="tab2" class="tab-pane">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Kepegawaian</h6>
										</div>
									</div>	
									<form id="form-wizard2" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP / NRP Lama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_lama;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP / NRP Baru  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_baru;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->gelar_depan;?> &nbsp;
												<?php echo $data_pegawai->nama;?> &nbsp;
												<?php echo $data_pegawai->gelar_belakang;?>											
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Pendidikan Waktu Diangkat  :</label>
											<div class="controls">
												<?php echo $data_kepegawaian->strata_diangkat.' - '.$data_kepegawaian->jurusan_diangkat;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">TMT CPNS  :</label>
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
												<?php echo $data_kepegawaian->nama_jenis_kepegawaian;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Golongan Terakhir  :</label>
											<div class="controls">
												<?php echo $data_kepegawaian->gol_terakhir;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">TMT Gol. Terakhir  :</label>
											<div class="controls">
												<?php if($data_kepegawaian->tmt_gol_terakhir) echo date('d-m-Y', strtotime($data_kepegawaian->tmt_gol_terakhir));?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Masa Kerja Keseluruhan  :</label>
											<div class="controls">
												<?php
												$mkt='';
												$mkb='';
												if(!empty($data_kepegawaian->tmt_cpns)){
													$mkt = $this->utility->dateDifference(date("Y-m-d"),date("Y-m-d",strtotime($data_kepegawaian->tmt_cpns)),'%y').' Thn';
													$mkb = $this->utility->dateDifference(date("Y-m-d"),date("Y-m-d",strtotime($data_kepegawaian->tmt_cpns)),'%m').' Bln';
												}
												echo $mkt.' '.$mkb;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Masa Kerja Tambahan  :</label>
											<div class="controls">
												<?php
												$mktt = $data_kepegawaian->mkt_tahun. ' Thn';
												$mktb = $data_kepegawaian->mkt_bulan. ' Bln';
												if($data_kepegawaian->mkt_tahun > 0){
													$mktt = $data_kepegawaian->mkt_tahun.' Thn';
												}
												if($data_kepegawaian->mkt_bulan > 0){
													$mktb = $data_kepegawaian->mkt_bulan.' Bln';
												}
												echo $mktt.' '.$mktb;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Masa Kerja Golongan  :</label>
											<div class="controls">
												<?php
												$mkgt = $data_kepegawaian->masa_kerja_tahun. ' Thn';
												$mkgb = $data_kepegawaian->masa_kerja_bulan. ' Bln';
												echo $mkgt.' '.$mkgb;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Status Gaji :</label>
											<div class="controls">
												<?php echo $data_kepegawaian->status_gaji_txt;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Lokasi Gaji  :</label>
											<div class="controls">
												<?php echo $data_kepegawaian->lokasi_gaji_txt;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">TMT KGB Terakhir  :</label>
											<div class="controls">
												<?php if($data_kepegawaian->tmt_kgb_terakhir) echo date('d-m-Y', strtotime($data_kepegawaian->tmt_kgb_terakhir));?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Satuan Kerja  :</label>
											<div class="controls">
												<?php echo $data_kepegawaian->satuan_kerja_txt;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Cuti Besar  :</label>
											<div class="controls">
												<?php echo $data_kepegawaian->cuti_besar;?>
											</div>
										</div>									
									</form>
									
								</div>
								
								<div id="tab3" class="tab-pane">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Tempat Kerja</h6>
										</div>
									</div>	
									<form id="form-wizard3" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP / NRP Lama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_lama;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP / NRP Baru  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_baru;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->gelar_depan;?> &nbsp;
												<?php echo $data_pegawai->nama;?> &nbsp;
												<?php echo $data_pegawai->gelar_belakang;?>											
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Tgl Mulai Tugas :</label>
											<div class="controls">
												<?php if(array_key_exists('tanggal_tugas',$data_tempatkerja)) echo date('d-m-Y', strtotime($data_tempatkerja->tanggal_tugas));?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">TMT Jabatan :</label>
											<div class="controls">
												<?php if(array_key_exists('tmt_jabatan',$data_tempatkerja)) echo date('d-m-Y', strtotime($data_tempatkerja->tmt_jabatan));?>
											</div>
										</div>									
										<div class="control-group">
											<label class="control-label">Instansi Bekerja  :</label>
											<div class="controls">
												<?php if(array_key_exists('instansi',$data_tempatkerja)) echo $data_tempatkerja->instansi;?>	
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Organisasi  :</label>
											<div class="controls">
												<?php if(array_key_exists('organisasi_kerja',$data_tempatkerja)) echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_tempatkerja->organisasi_kerja);?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Satuan Kerja</label>
											<div class="controls">
												<?php if(array_key_exists('satuan_kerja',$data_tempatkerja)) echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_tempatkerja->satuan_kerja);?>	
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Satuan Organisasi</label>
											<div class="controls">
												<?php if(array_key_exists('satuan_organisasi',$data_tempatkerja)) echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_tempatkerja->satuan_organisasi);?>	
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Unit Organisasi</label>
											<div class="controls">
												<?php if(array_key_exists('unit_organisasi',$data_tempatkerja)) echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_tempatkerja->unit_organisasi);?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Jabatan</label>
											<div class="controls">
												<?php if(array_key_exists('nama_jabatan',$data_jabatan)) echo $data_jabatan->nama_jabatan;?>	
											</div>
										</div> 									
									</form>
									
								</div>
								
								<div id="tab4" class="tab-pane">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Data Dokumen</h6>
										</div>
									</div>	
									<form id="form-wizard4" class="form-horizontal row-fluid well" method="post" action="" >
										<div class="control-group">
											<label class="control-label">NIP/NRP Lama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_lama;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP/NRP Baru  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_baru;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
											</div>
										</div>
									</form>
									<div class="widget-box">
										<div class="widget-content">									
											<table id="list-rdokumen" class="table table-bordered table-striped with-check">
											  <thead>
												<tr>
												  <th>No.</th>
												  <th>Nama Dokumen</th>
												  <th>Tanggal Upload</th>
												  <th>Tipe Dokumen</th>
												  <th>File Name</th>
												  <?php if($login_state == 'User') { ?>
												  <th>Options</th>
												  <?php } ?>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo @$data_pegawai->gelar_depan.' '.@$data_pegawai->nama.' '.@$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
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
											<label class="control-label">NIP / NRP Lama  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_lama;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">NIP / NRP Baru  :</label>
											<div class="controls">
												<?php echo $data_pegawai->nip_baru;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama  :</label>
											<div class="controls">
												<?php echo @$data_pegawai->gelar_depan; ?> &nbsp;
												 <?php echo @$data_pegawai->nama;?> &nbsp;
												<?php echo @$data_pegawai->gelar_belakang;?>											
											</div>
										</div>
										<?php
										if(trim($data_pegawai->jenis_kelamin) == 'Laki-laki'){
											$label_sutri = 'Nama Istri';
										}else{
											$label_sutri = 'Nama Suami';
										}								
										?>
										<div class="control-group">
											<label class="control-label">Status Nikah  :</label>
											<div class="controls">
												<?php echo @$data_sutri->status_menikah_txt;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?php echo $label_sutri;?>  :</label>
											<div class="controls">
												<?php echo @$data_sutri->nama_suami_istri;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Tanggal Lahir  :</label>
											<div class="controls">
												<?php if(@$data_sutri->tgl_lahir) echo date('d-m-Y', strtotime(@$data_sutri->tgl_lahir));?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Tanggal Nikah  :</label>
											<div class="controls">
												<?php if(@$data_sutri->tgl_nikah) echo date('d-m-Y', strtotime(@$data_sutri->tgl_nikah));?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Pekerjaan  :</label>
											<div class="controls">
												<?php echo @$data_sutri->pekerjaan;?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">No Seri Karis  :</label>
											<div class="controls">
												<?php echo @$data_sutri->no_karis;?>
											</div>
										</div>
									</form>
									
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
									  <div class="widget-content">
										<table id="list-rkinerja" class="table table-bordered table-striped with-check">
										  <thead>
											<tr>
											  <th>No.</th>
											  <th>Jabatan</th>
											  <th>Capaian SKP</th>
											  <th>Pejabat Penilai</th>
											  <th>Tahun</th>
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
													<?php echo $data_pegawai->nip_lama;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">NIP/NRP Baru  :</label>
												<div class="controls">
													<?php echo $data_pegawai->nip_baru;?>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Nama  :</label>
												<div class="controls">
													<?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?>	
												</div>
											</div>
										</form>
									  <div class="widget-content">
										<table id="list-rkompetensi" class="table table-bordered table-striped with-check">
										  <thead>
											<tr>
											  <th>No.</th>
											  <th>Jabatan</th>
											  <th>Kompetensi</th>
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
					<a href="javascript:history.back();"  class="btn btn-primary"><< Back</a>
					<?php if($login_state != 'User') { ?>
						<button id="print_datacv" onclick="return do_print_cv(<?php echo $data_pegawai->id;?>,<?php echo $data_pegawai->nip_baru;?>);" class="btn btn-primary">Print CV</button>
						<a href="<?php echo base_url().'pegawai/edit/'.$data_pegawai->id ?>" class="btn btn-primary" title="Edit">Edit</a>
					<?php }else{ 
							if($user_request == $hd_nip_baru) {
							?>
								<button id="print_datacv" onclick="return do_print_cv(<?php echo $data_pegawai->id;?>,<?php echo $data_pegawai->nip_baru;?>);" class="btn btn-primary">Print CV</button>
								<button id="request_user" onclick="return do_request_user();" class="btn btn-primary">Permintaan Ubah Data</button> 
							<?php 
							}
						} 
					?>
				</div>
			
			<?php } ?>
			<br />	  
		</div>
		<!-- /content wrapper -->

	</div>
	<!-- /content -->
	
</div>


<div id="dialog-print_cv"></div>

<div id="dialog-request_user">
	<?php if($data_user){ ?>
		<form id="form-request_user" class="form-horizontal row-fluid well" method="post" action="" >
			<div class="control-group">
				<label class="control-label">NIP / NRP Lama  :</label>
				<div class="controls">
					<?php echo $data_user['nip_lama'];?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">NIP / NRP Baru  :</label>
				<div class="controls">
					<input type="hidden" id="msg_from" name="msg_from" value="<?php echo $data_user['nip_baru'];?>" />
					<?php echo $data_user['nip_baru'];?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Nama  :</label>
				<div class="controls">
					<?php echo $data_user['gelar_depan'];?> &nbsp;
					<?php echo $data_user['nama'];?> &nbsp;
					<?php echo $data_user['gelar_belakang'];?>											
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Permintaan :</label>
				<div class="controls">
					<input id="msg_subject" type="text" name="msg_subject" value="Permintaan Perubahan Data" class="input-xxlarge" />
				</div>
			</div>		
			<div class="control-group">
				<label class="control-label">Pesan :</label>
				<div class="controls">
					<textarea id="msg_text" name="msg_text" rows="7" class="input-xxlarge" ></textarea><br />
				</div>
			</div>
			
		</form> 
	<?php } ?>
</div>
	
<script type="text/javascript" charset="utf-8">
	 $(function() {
	
		$( "#dialog-request_user" ).hide();
		$( "#dialog-print_cv" ).hide();
		
		$('ul.nav-tabs li a').click(function(){  
			if ($('ul.nav-tabs li').hasClass('active')) {
				$('ul.nav-tabs li').removeClass('active');
				$(this).addClass('active'); 
			}		
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkepangkatan/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rpendidikan/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rjabatan/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rdokumen/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rdiklatjabatan/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rdiklatteknis/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rpenghargaan/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkeluarga/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkinerja/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
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
			"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkompetensi/detail",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "pegawai_id", value: $('#id_peg').val() });
				$.ajax({
					"dataType": 'json', 
					"type": "POST", 
					"url": sSource, 
					"data": aoData, 
					"success": fnCallback
				});
			}
				
		});
		
		/*
		$( "#print_datacv" ).click(function(){  
			var peg_id = $( '#hd_id' ).val();
			var peg_nip_baru = $( '#hd_nip_baru' ).val();
			var url_pdf = '<?php echo APP_URL ?>Uploads/cv/CV_'+peg_nip_baru+'.pdf';
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/data_print_cv/"+peg_id+"/"+peg_nip_baru,
				success: function(msg){	
					if(msg == 'success'){
						//$( "#frame-print_cv" ).attr('src', url_pdf);
						
						//open dialog cv
						$( "#dialog-print_cv" ).dialog({
							height: 600,
							width: 900,
							modal: true,
							title: 'CV '+ peg_nip_baru,
							buttons: {
								"Close": function() {
								  $( this ).dialog( "close" );
								}
							}
						});
					}
				}
			});	

		});
		*/

	});
	
	
	function do_print_cv(peg_id, peg_nip_baru) {
		
		$( "#dialog-print_cv" ).load("<?php echo base_url(); ?>pegawai/data_print_cv/"+peg_id+"/"+peg_nip_baru)
			.dialog({
			  autoOpen: false,
			  height: 600,
			  width: 800,
			  modal: true,
			  title: 'CV '+ peg_nip_baru,
			  buttons: {				
				"Cetak": function() {
					w=window.open("","", "scrollbars=1,height=600, width=700");
					w.document.write($('#dialog-print_cv').html());
					w.print();
					w.close();					
					$( this ).dialog( "close" );
				},
				"Close": function() {
					$( this ).dialog( "close" );
				}
			 },
			  
		}); 
		$( "#dialog-print_cv" ).dialog( "open" );
		
		
		return false;
	}
	
	function do_request_user() {
	
		$( "#dialog-request_user" ).dialog({
			  autoOpen: false,
			  height: 450,
			  width: 750,
			  modal: true,
			  title: 'Usulan Perubahan Data',
			  buttons: {
				"Simpan": function() {
					var bValid = true;
					var msg_subject = $( "#msg_subject" ).val(); 
					var msg_text = $( "#msg_text" ).val(); 
					
					if(msg_subject == ''){
						$( "#msg_subject" ).addClass("invalid");
						bValid = false;
					}		
					if(msg_text == ''){
						$( "#msg_text" ).addClass("invalid");
						bValid = false;
					}		
					
					if ( bValid ) {
						$.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>pegawai/do_request_user/",
							data: $('#form-request_user').serialize(), 
							success: function(msg){	
								if(!msg == 'success'){		
									alert( 'Data tidak dapat dikirim, cek input!' );	
								}else{
									alert( 'Data sudah dikirim' );
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
		$( "#dialog-request_user" ).dialog( "open" );
		
	}
	
</script>	
<!-- /content container -->
<?php $this->load->view('layout/_footer'); ?>
</body>
</html>