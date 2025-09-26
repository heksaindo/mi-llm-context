<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head'); ?>
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
						 <li class="active"><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Data Pegawai Pribadi</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				  
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span2">	
						<div class="sidebar-user widget">
							<div class="navbar"><div class="navbar-inner"></div></div>
							<?php if($pegawai->foto!=''){ $foto=$pegawai->foto; }else{ $foto='no-photo.jpg'; } ?>
							<div align="center"><img src="<?php echo base_url(); ?>foto/<?php echo $foto; ?>" alt="" /></a></div>
							<ul class="user-links">
								<li><a data-toggle="tab" href="#tab5" title="">Tempat Kerja Sekarang</a></li>
								<li><a data-toggle="tab" href="#tab6" title="">Riwayat Kepangkatan</a></li>
								<li><a data-toggle="tab" href="#tab7" title="">Riwayat Jabatan</a></li>
								<li><a data-toggle="tab" href="#tab8" title="">Riwayat Pelatihan Jabatan</a></li>
								<li><a data-toggle="tab" href="#tab9" title="">Riwayat Pelatihan Teknis</a></li>
								<li><a data-toggle="tab" href="#tab10" title="">Riwayat Penghargaan</a></li>
								<li><a data-toggle="tab" href="#tab11" title="">Riwayat Kinerja</a></li>
								<li><a data-toggle="tab" href="#tab12" title="">Riwayat Kompetensi</a></li>
							</ul>
						</div>
					</div>                        
                    <div class="span10">
  						<div class="widget-box">
                          <div class="widget-title">
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab1">Data Pribadi</a></li>
                              <li><a data-toggle="tab" href="#tab2">Data Keluarga</a></li>
                              <li><a data-toggle="tab" href="#tab3">Data Pendidikan</a></li>
                              <li><a data-toggle="tab" href="#tab4">Data Dokumen</a></li>
                            </ul>
                          </div>
                          <div class="widget-content tab-content">
                            <div id="tab1" class="tab-pane active">
                                <form action="#" method="get" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">Nama  :</label>
										<div class="controls">
											<?php echo $pegawai->gelar_depan.' '.$pegawai->nama.' '.$pegawai->gelar_belakang ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">NIP / NRP Baru  :</label>
										<div class="controls">
											<?php echo $pegawai->nip_baru ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">NIP / NRP Lama  :</label>
										<div class="controls">
											<?php echo $pegawai->nip_lama ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">No Kartu Pegawai  :</label>
										<div class="controls">
											<?php echo $pegawai->no_kartu ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tempat Lahir  :</label>
										<div class="controls">
											<?php echo $pegawai->tempat_lahir ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Lahir  :</label>
										<div class="controls">
											<?php 
												if(!empty($pegawai->tmt_pns)){
													echo date('d/m/Y', strtotime($pegawai->tanggal_lahir)); 
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jenis Kelamin  :</label>
										<div class="controls">
											<?php echo $pegawai->jenis_kelamin ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Agama  :</label>
										<div class="controls">
											<?php echo $pegawai->agama ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status Perkawinan  :</label>
										<div class="controls">
											<?php echo $pegawai->status_perkawinan?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Alamat  :</label>
										<div class="controls">
											<?php echo $pegawai->alamat ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">No. Telp  :</label>
										<div class="controls">
											<?php echo $pegawai->telp ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TMT CPNS  :</label>
										<div class="controls">
											<?php 
												if(!empty($pegawai->tmt_cpns)){
													echo date('d/m/Y', strtotime($pegawai->tmt_cpns)); 
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TMT PNS  :</label>
										<div class="controls">
											<?php 
												if(!empty($pegawai->tmt_pns)){
													echo date('d/m/Y', strtotime($pegawai->tmt_pns)); 
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Status Kepegawaian  :</label>
										<div class="controls">
											<?php echo $pegawai->status_kepegawaian ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Pendidikan Terakhir  :</label>
										<div class="controls">
											<?php echo $pegawai->pendidikan ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Jabatan Saat Ini  :</label>
										<div class="controls">
											<?php echo $pegawai->jabatan ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">TMT Jabatan Saat Ini  :</label>
										<div class="controls">
											<?php 
												if(!empty($pegawai->tmt_jabatan)){
													echo date('d/m/Y', strtotime($pegawai->tmt_jabatan)); 
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Masa Kerja Golongan  :</label>
										<div class="controls">
											<?php echo $pegawai->masa_kerja_golongan ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Eselon  :</label>
										<div class="controls">
											<?php echo $pegawai->eselon ?>
										</div>
									</div>
                                </form>
                            </div>
                            <div id="tab2" class="tab-pane">
                                <form action="#" method="get" class="form-horizontal">
									<?php
										if($pegawai->jenis_kelamin == 'Laki-laki '){
											$label_sutri = 'Nama Istri';
										}else{
											$label_sutri = 'Nama Suami';
										}
				
										$nama_suami_istri = $data_sutri->nama_suami_istri;
										$tgl_lahir = $data_sutri->tgl_lahir;
										$tgl_nikah = $data_sutri->tgl_nikah;
										$pekerjaan = $data_sutri->pekerjaan;
										$no_karis = $data_sutri->no_karis;
									
										?>
									<div class="control-group">
									<label class="control-label"><?php echo $label_sutri;?>  :</label>
										<div class="controls">
											<?php echo $nama_suami_istri ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Lahir  :</label>
										<div class="controls">
											<?php 
												if(!empty($tgl_lahir)){
													echo date('d/m/Y', strtotime($tgl_lahir)); 
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tanggal Nikah  :</label>
										<div class="controls">
											<?php 
												if(!empty($tgl_nikah)){
													echo date('d/m/Y', strtotime($tgl_nikah)); 
												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Pekerjaan  :</label>
										<div class="controls">
											<?php echo $pekerjaan ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">No Seri Karis  :</label>
										<div class="controls">
											<?php echo $no_karis ?>
										</div>
									</div>
									<div class="widget">
										<div class="navbar">
											<div class="navbar-inner">
													<h6>Riwayat Anak</h6>
											</div>
										</div>
										<div class="table-overflow">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama</th>
														<th>Tanggal Lahir</th>
														<th>Jenis Kelamin</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php
														if(!empty($list_riwayatkeluarga)){
															$i=1;
															foreach($list_riwayatkeluarga as $row){
															?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $row->nama_anak;?></td>
																	<td><?php echo date('d/m/Y', strtotime($row->tanggal_lahir));?></td>
																	<td><?php echo $row->jenis_kelamin;?></td>
																	<td><?php echo $row->status;?></td>
																</tr> 
															<?php	
																$i++;
															}
														}else{
															echo '<tr><td colspan="6">Data Kosong</td></tr>';
														}
													?>													
												</tbody>
											</table>
										</div>
									</div>
                                </form>
                            </div>
                            <div id="tab3" class="tab-pane">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Pendidikan</th>
                                      <th>Nama Sekolah</th>
                                      <th>Tahun Ijazah</th>
                                    </tr>
                                  </thead>
                                  <tbody>
									<?php
										if(!empty($list_riwayatpendidikan)){
											$i=1;
											foreach($list_riwayatpendidikan as $row){
											?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $row->pendidikan;?></td>
													<td><?php echo $row->nama_sekolah;?></td>
													<td><?php echo $row->tahun_ijazah;?></td>
												</tr> 
											<?php	
												$i++;
											}
										}else{
											echo '<tr><td colspan="4">Data Kosong</td></tr>';
										}
										?>                                   
                                  </tbody>
                                </table>
                            </div>
                            <div id="tab4" class="tab-pane">
                                <div class="widget-box">
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Nama Dokumen</th>
										  <th>Tanggal Upload</th>
										  <th>Lihat Dokumen</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_dokumen)){
												$i=1;
												foreach($list_dokumen as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->nama_dokumen;?></td>
														<td><?php echo $row->dateinserted;?></td>
														<td><a href="<?php echo base_url() ?>Uploads/dokumen/<?php echo $row->letak_dokumen;?>" class="tip" title="Download"><i class="fam-page-save"></i></a></td>
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="4">Data Kosong</td></tr>';
											}
										?>	
										
									  </tbody>
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab5" class="tab-pane">
								<div class="navbar">
									<div class="navbar-inner">
										<h6>Tempat Kerja Sekarang</h6>
									</div>
								</div>							
								<div class="widget-content">
									<form action="#" method="get" class="form-horizontal">									
										<div class="control-group">
											<label class="control-label">Organisasi  :</label>
											<div class="controls">
												<?php echo $data_kerja->organisasi_kerja ?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Satuan Kerja  :</label>
											<div class="controls">
												<?php echo $data_kerja->satuan_kerja ?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Satuan Organisasi  :</label>
											<div class="controls">
												<?php echo $data_kerja->satuan_organisasi ?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Unit Organisasi  :</label>
											<div class="controls">
												<?php echo $data_kerja->unit_organisasi ?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Unit Kerja  :</label>
											<div class="controls">
												<?php echo $data_kerja->unit_kerja ?>
											</div>
										</div>
										
									</form>
								</div>
                            </div>
							
							<div id="tab6" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Kepangkatan</h6>
										</div>
									</div>
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Pangkat</th>
										  <th>Golongan</th>
										  <th>TMT</th>
										  <th>No SK</th>
										  <th>Tanggal SK</th>
										  <th>Pejabat Penandatangan</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_riwayatkepangkatan)){
												$i=1;
												foreach($list_riwayatkepangkatan as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->pangkat;?></td>
														<td><?php echo $row->golongan;?></td>
														<td><?php echo date('d/m/Y', strtotime($row->tmt));?></td>
														<td><?php echo $row->no_sk;?></td>
														<td><?php echo date('d/m/Y', strtotime($row->tanggal_sk));?></td>
														
														<td><?php echo $row->pejabat;?></td>
													
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="7">Data Kosong</td></tr>';
											}
										?>											
									  </tbody>
									</table>
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
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Jabatan</th>
										  <th>Eselon</th>
										  <th>TMT</th>
										  <th>No SK</th>
										  <th>Tanggal SK</th>
										  <th>Satuan Kerja</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_riwayatjabatan)){
												$i=1;
												foreach($list_riwayatjabatan as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->jabatan;?></td>
														<td><?php echo $row->eselon;?></td>
														<td><?php echo date('d/m/Y', strtotime($row->tmt));?></td>
														<td><?php echo $row->no_sk;?></td>
														<td><?php echo date('d/m/Y', strtotime($row->tanggal_sk));?></td>
														<td><?php echo $row->satuan_kerja;?></td>
													
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="7">Data Kosong</td></tr>';
											}
										?>											
									  </tbody>
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab8" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Pelatihan Jabatan</h6>
										</div>
									</div>
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Nama Pelatihan</th>
										  <th>Lembaga</th>
										  <th>Tahun</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_riwayatpelatihanjabatan)){
												$i=1;
												foreach($list_riwayatpelatihanjabatan as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->nama_pelatihan;?></td>
														<td><?php echo $row->lembaga;?></td>
														<td><?php echo $row->tahun;?></td>
													
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="4">Data Kosong</td></tr>';
											}
										?>											
									  </tbody>
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
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Nama Pelatihan</th>
										  <th>Lembaga</th>
										  <th>Negara</th>
										  <th>Tahun</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_riwayatpelatihanteknis)){
												$i=1;
												foreach($list_riwayatpelatihanteknis as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->nama_pelatihan;?></td>
														<td><?php echo $row->lembaga;?></td>
														<td><?php echo $row->negara;?></td>
														<td><?php echo $row->tahun;?></td>
													
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="5">Data Kosong</td></tr>';
											}
										?>											
									  </tbody>
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
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Nama Penghargaan</th>
										  <th>No SK</th>
										  <th>Tanggal SK</th>
										  <th>Instansi Pemberi</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_riwayatpenghargaan)){
												$i=1;
												foreach($list_riwayatpenghargaan as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->nama_penghargaan;?></td>
														<td><?php echo $row->no_sk;?></td>
														<td><?php echo date('d/m/Y', strtotime($row->tanggal_sk));?></td>
														<td><?php echo $row->instansi_pemberi;?></td>
													
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="5">Data Kosong</td></tr>';
											}
										?>											
									  </tbody>
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab11" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Kinerja</h6>
										</div>
									</div>
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Jabatan</th>
										  <th>Capaian SKP</th>
										  <th>Pejabat Penilai</th>
										  <th>Tahun</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_riwayatkinerja)){
												$i=1;
												foreach($list_riwayatkinerja as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->jabatan;?></td>
														<td><?php echo $row->capaian_skp;?></td>
														<td><?php echo $row->pejabat_penilai;?></td>
														<td><?php echo $row->tahun;?></td>
													
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="5">Data Kosong</td></tr>';
											}
										?>											
									  </tbody>
									</table>
								  </div>
								</div>
                            </div>
							
							<div id="tab12" class="tab-pane">
                                <div class="widget-box">
									<div class="navbar">
										<div class="navbar-inner">
											<h6>Riwayat Kompetensi</h6>
										</div>
									</div>
								  <div class="widget-content">
									<table class="table table-bordered table-striped with-check">
									  <thead>
										<tr>
										  <th>No.</th>
										  <th>Jabatan</th>
										  <th>Kompetensi</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											if(!empty($list_riwayatkompetensi)){
												$i=1;
												foreach($list_riwayatkompetensi as $row){
												?>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row->jabatan;?></td>
														<td><?php echo $row->kompetensi;?></td>
													
													</tr> 
												<?php	
													$i++;
												}
											}else{
												echo '<tr><td colspan="3">Data Kosong</td></tr>';
											}
										?>											
									  </tbody>
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
		
				  
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>