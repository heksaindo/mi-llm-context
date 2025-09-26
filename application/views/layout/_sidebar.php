<!-- Sidebar -->
<div id="sidebar">
		
	<?php 
	$session_user_login = $this->session->userdata('user_id');
	$session_id = $this->session->userdata('pegawai_id');
	$session_privilege = $this->session->userdata('login_state');
	
	if(!empty($session_user_login)){
	
			if ($menumode == 'home'){
				$nav2 = $this->uri->segment(2);
				if($nav2 == 'setting'){ 
				?>
					<div id="general">
							<!-- Sidebar user -->
							<div class="sidebar-user widget">
								<div class="navbar"><div class="navbar-inner"><h6>Hello, <?php echo $foto_user->nama; ?></h6></div></div>
								<div class="nav-foto">
									<?php
										$foto = 'no-photo.jpg';
										if($foto_user){
											if($foto_user->foto != ''){ $foto = $foto_user->foto; } 
										}
									?>
									<a href="#" title="" class="user"><img src="<?php echo APP_URL ?>/Uploads/foto/<?php echo $foto; ?>" alt="" /></a>
								</div>
								
							</div>
							<!-- /sidebar user -->
							
						</div>
					<?php
				}else{
					?>	
					<div class="sidebar-tabs">
						<ul class="tabs-nav two-items">
							<li style="display: none !important;"><a href="#general" data-placement="bottom" title="Info" class="tip"><i class="icon-reorder"></i></a></li>
							<!--<li><a href="#stuff" data-placement="bottom" title="Notifikasi" class="tip"><i class="icon-cogs"></i></a></li>-->
						</ul>

						<!--<div id="stuff">
							<ul class="navigation widget">
								<?php
								$notifikasi_total_icon = 'icon-envelope';
								if(!empty($notifikasi['total'])){
									$notifikasi_total_icon = 'icon-envelope-alt';
								}
								?>
								<li class="active"><a href="javascript:void(0);" title=""><i class="<?php echo $notifikasi_total_icon; ?>"></i>Notifikasi <strong><?php echo $notifikasi['total']; ?></strong></a></li>
								<li><a href="<?php echo base_url(); ?>notifikasi/permintaan_cuti" title=""><i class="icon-info-sign"></i>Permintaan Cuti <strong><?php echo $notifikasi['permintaan_cuti']; ?></strong></a></li>
								<li><a href="<?php echo base_url(); ?>notifikasi/permintaan_lembur" title=""><i class="icon-info-sign"></i>Permintaan Lembur <strong><?php echo $notifikasi['permintaan_lembur']; ?></strong></a></li>
								<li><a href="<?php echo base_url(); ?>notifikasi/perubahan_drh" title=""><i class="icon-info-sign"></i>Perubahan DRH <strong><?php echo $notifikasi['perubahan_data_pegawai']; ?></strong></a></li>
						   
						   </ul>
						</div>-->

						<div id="general">
							<!-- Sidebar user -->
							<div class="sidebar-user widget">
								<div class="navbar"><div class="navbar-inner"><h6>Hello, <?php echo $foto_user->nama; ?></h6></div></div>
								<div class="nav-foto">
									<?php
										$foto = 'no-photo.jpg';
										if($foto_user){
											if($foto_user->foto != ''){ $foto = $foto_user->foto; } 
										}
									?>
									<a href="#" title="" class="user"><img src="<?php echo APP_URL ?>/Uploads/foto/<?php echo $foto; ?>" alt="" /></a>
								</div>
								
							</div>
							<!-- /sidebar user -->
							<!-- Wdiget Stat -->
							<!--<div class="general-stats widget">
								<ul class="head">
									<li><span>Total Cuti</span></li>
									<li><span>Dipakai</span></li>
									<li><span>Sisa</span></li>
								</ul>
								<ul class="body">
									<li><strong><?php echo $total_cuti ? $total_cuti : 0;?></strong></li>
									<li><strong><?php echo $cuti_dipakai ? $cuti_dipakai : 0;?></strong></li>
									<li><strong><?php echo $total_cuti - $cuti_dipakai;?></strong></li>
								</ul>
							</div>-->

							<!-- Datepicker -->
							<!--<div class="widget">
								<h6 class="widget-name"><i class="icon-calendar"></i>My Agenda</h6>
								<div class="inlinepicker datepicker-liquid"></div>
							</div> -->
							<!-- /datepicker -->


							<!-- Dates range -->
							<!-- <ul class="widget dates-range">
								<li><input type="text" id="fromDate" name="from" placeholder="From" /></li>
								<li class="sep">-</li>
								<li><input type="text" id="toDate" name="to" placeholder="To" /></li>
							</ul> -->
							<!-- /dates range -->

							<!-- Time picker range -->
							<!-- <ul class="widget dates-range">
								<li><input id="timeformatExample1" type="text" placeholder="Start" /></li>
								<li class="sep">-</li>
								<li><input id="timeformatExample2" type="text" placeholder="End" /></li>
							</ul> -->
							<!-- /time picker range -->

						</div>
					</div>
				<?php 
					}
				}else if ($menumode == 'administrasipegawai'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="<?php echo base_url(); ?>pegawai" title=""><i class="icon-reorder"></i>DRH & ADK</a></li>
			            <?php 
						if($session_privilege != 'User'){
						?>
							<!--<li><a href="<?php echo base_url(); ?>urutkepangkatan" title=""><i class="icon-reorder"></i>Daftar Urut Kepangkatan</a></li>-->
							<li><a href="<?php echo base_url(); ?>kenaikangajipegawai" title=""><i class="icon-reorder"></i>Kenaikan Gaji Berkala</a></li>
							<li><a href="<?php echo base_url(); ?>kenaikanpangkat" title=""><i class="icon-reorder"></i>Kenaikan Pangkat</a></li>
							<li><a href="<?php echo base_url(); ?>pensiun" title=""><i class="icon-reorder"></i>Pensiun</a></li>
							<!--<li><a href="<?php echo base_url(); ?>mutasi" title=""><i class="icon-tasks"></i>Mutasi Pegawai</a></li>				
							<li><a href="<?php echo base_url(); ?>penghargaan" title=""><i class="icon-tasks"></i>Penghargaan</a></li>
							<li><a href="<?php echo base_url(); ?>permasalahan" title=""><i class="icon-tasks"></i>Permasalahan Pegawai</a></li>
							<li><a href="<?php echo base_url(); ?>angkakredit" title=""><i class="icon-tasks"></i>Pengajuan Angka Kredit</a></li>-->
							<!--
							<li><a href="#" title=""><i class="icon-tasks"></i>Administrasi SK</a></li>
							<li><a href="#" title=""><i class="icon-tasks"></i>Laporan Pegawai</a></li>	
							-->
						<?php } ?>
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'penugasandankehadiran'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="<?php echo base_url(); ?>cuti" title=""><i class="icon-reorder"></i>Cuti, Ijin dan Sakit</a></li>
						<?php 
						if($session_privilege != 'User'){
						?>
							<!--<li><a href="<?php echo base_url(); ?>perjadin" title=""><i class="icon-th"></i>Perjalanan Dinas</a></li>-->
							<!--
							<li><a href="<?php echo base_url(); ?>lembur" title=""><i class="icon-tasks"></i>Lembur</a></li>
							<li><a href="#" title=""><i class="icon-picture"></i>Tugas Belajar</a></li>
							-->
							<!--<li><a href="<?php echo base_url(); ?>kehadiran" title=""><i class="icon-tasks"></i>Laporan Kehadiran</a></li>-->
						<?php } ?>			
			        </ul>
			    	
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'pendidikan'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
	
			            <!--<li><a href="#" title=""class="expand"><i class="icon-picture"></i>Diklat & Ujian Dinas Pegawai</a>
							<ul>
			                    <li><a href="<?php echo base_url(); ?>pendidikan/DiklatJabatan" title="">Pimpinan</a></li>
                                <li><a href="<?php echo base_url(); ?>pendidikan/DiklatTeknis" title="">Non Teknis</a></li>
			                </ul>
						</li>
						<li><a href="<?php echo base_url(); ?>tubel" title=""><i class="icon-th"></i>Tugas Belajar</a></li>-->
						<li><a href="<?php echo base_url(); ?>ibel" title=""><i class="icon-th"></i>Izin Belajar</a></li>		
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'organisasi'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
						<?php 
						if($session_privilege != 'User'){
						?>
							<li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
							<li><a href="<?php echo base_url(); ?>bapeljakat" title="Baperjakat"><i class="icon-reorder"></i>BAPERJAKAT</a></li>
							<!--
							<li><a href="#" title=""><i class="icon-tasks"></i>Manajeman Jabatan</a></li>
							<li><a href="#" title=""><i class="icon-picture"></i>Kompetensi Jabatan</a></li>
							<li><a href="#" title=""><i class="icon-th"></i>Analisa Jabatan</a></li>	
							<li><a href="#" title=""><i class="icon-th"></i>Struktur Organisasi</a></li>	
							<li><a href="#" title=""><i class="icon-th"></i>Laporan Organisasi</a></li>
							-->
						<?php } ?>
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'karir'){ ?>
						 <!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Pola Karir</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Perencanaan Karir</a></li>
			            <li><a href="#" title=""><i class="icon-picture"></i>Analisa Jalur Karir</a></li>
						<li><a href="#" title=""><i class="icon-th"></i>Perencanaan Jalur Karir</a></li>	
						<li><a href="#" title=""><i class="icon-th"></i>Catatan Karir</a></li>	
			            <li><a href="#" title=""><i class="icon-th"></i>Catatan Penghargaan</a></li>
						<li><a href="#" title=""><i class="icon-th"></i>Catatan Pelanggaran</a></li>	
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'formasi'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Formasi Pegawai</a>
							<ul>
			                    <li><a href="# title="">Pejabat Eselon 2</a></li>
                                <li><a href="#" title="">Pejabat Eselon 3 dan 4</a></li>
			                </ul>
						</li>
						<li><a href="#" title=""><i class="icon-picture"></i>Analisa Beban Kerja</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Distribusi Jabatan</a></li>
			            <li><a href="#" title=""><i class="icon-picture"></i>Analisa Kebutuhan Pegawai</a></li>
						<li><a href="#" title=""><i class="icon-th"></i>Perencanaan Pegawai</a></li>	
						<li><a href="#" title=""><i class="icon-th"></i>Perencanaan Jabatan</a></li>	
			            <li><a href="#" title=""><i class="icon-th"></i>Permintaan Penambahan Pegawai</a></li>
			        </ul>
			        <!-- /main navigation -->
				<?php }else if ($menumode == 'masterdata'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
						<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Master Pegawai</a>
							<ul>
			                    <li><a href="<?php echo base_url(); ?>master_users" title=""><i class="icon-th"></i>Users</a></li>
			                    <li><a href="<?php echo base_url(); ?>master_unitkerja" title=""><i class="icon-th"></i>Unit Kerja</a></li>
								<li><a href="<?php echo base_url(); ?>master_golongan" title=""><i class="icon-th"></i>Golongan</a></li>
								<li><a href="<?php echo base_url(); ?>master_eselon" title=""><i class="icon-th"></i>Eselon</a></li>
								<li><a href="<?php echo base_url(); ?>master_jabatan" title=""><i class="icon-th"></i>Jabatan</a></li>
								<li><a href="<?php echo base_url(); ?>master_statusjabatan" title=""><i class="icon-th"></i>Status Jabatan</a></li>
								<li><a href="<?php echo base_url(); ?>master_statuspegawai" title=""><i class="icon-th"></i>Status Pegawai</a></li>
								<li><a href="<?php echo base_url(); ?>master_jenispegawai" title=""><i class="icon-th"></i>Jenis Pegawai</a></li>
								<li><a href="<?php echo base_url(); ?>master_pelatihan" title=""><i class="icon-th"></i>Pelatihan</a></li>
								<li><a href="<?php echo base_url(); ?>master_pendidikan" title=""><i class="icon-th"></i>Strata Pendidikan</a></li>
								<li><a href="<?php echo base_url(); ?>master_penghargaan" title=""><i class="icon-th"></i>Penghargaan</a></li>
								<li><a href="<?php echo base_url(); ?>master_hukuman" title=""><i class="icon-th"></i>Hukuman</a></li>
								<li><a href="<?php echo base_url(); ?>master_gapok" title=""><i class="icon-th"></i>Gaji Pokok</a></li>
			                </ul>
						</li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Master Lokasi</a>
							<ul>
								<!--<li><a href="<?php echo base_url(); ?>master_lokasikerja" title=""><i class="icon-th"></i>Lokasi Kerja</a></li>-->	
								<li><a href="<?php echo base_url(); ?>master_lokasipelatihan" title=""><i class="icon-th"></i>Lokasi Pelatihan</a></li>				
								<li><a href="<?php echo base_url(); ?>master_provinces" title=""><i class="icon-th"></i>Propinsi</a></li>				
								<li><a href="<?php echo base_url(); ?>master_city" title=""><i class="icon-th"></i>Kabupaten/Kota</a></li>
							</ul>
						</li>
						<!--<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Master Penilaian</a>
							<ul>
								<li><a href="<?php echo base_url(); ?>master_unsurpenilaian" title=""><i class="icon-th"></i>Unsur Penilaian</a></li>				
								<li><a href="<?php echo base_url(); ?>master_unsurklasifikasi" title=""><i class="icon-th"></i>Unsur Klasifikasi</a></li>	
								<li><a href="<?php echo base_url(); ?>master_prasarat_angkakredit" title=""><i class="icon-th"></i>Prasarat AK</a></li>	
								<li><a href="<?php echo base_url(); ?>master_unsur_kegiatan" title=""><i class="icon-th"></i>Unsur Kegiatan </a></li>	
								<li><a href="<?php echo base_url(); ?>master_sub_unsur_kegiatan" title=""><i class="icon-th"></i>Sub Unsur Kegiatan</a></li>	
							</ul>
						</li>-->
						<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Master Parameter</a>
							<ul>
								<li><a href="<?php echo base_url(); ?>master_calendar" title=""><i class="icon-th"></i>Kalender</a></li>
								<li><a href="<?php echo base_url(); ?>master_syaratibel" title=""><i class="icon-th"></i>Syarat Dokumen</a></li>
								<li><a href="<?php echo base_url(); ?>master_tipedokumen" title=""><i class="icon-th"></i>Tipe Dokumen</a></li>
								<li><a href="<?php echo base_url(); ?>master_bup" title=""><i class="icon-th"></i>Batas Usia Pensiun</a></li>
								<li><a href="<?php echo base_url(); ?>master_bataspangkat" title=""><i class="icon-th"></i>Batas Kenaikan Pangkat</a></li>
								<li><a href="<?php echo base_url(); ?>master_cuti" title=""><i class="icon-th"></i>Cuti</a></li>
								<li><a href="<?php echo base_url(); ?>master_formasi" title=""><i class="icon-th"></i>Formasi Jabatan</a></li>
								<li><a href="<?php echo base_url(); ?>master_katmas" title=""><i class="icon-th"></i>Kat Masalah</a></li>
							</ul>
						</li>
			        </ul>
			        <!-- /main navigation -->
					
			<?php }else if ($menumode == 'notifikasi'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget">
						<?php
						$notifikasi_total_icon = 'icon-envelope';
						if(!empty($notifikasi['total'])){
							$notifikasi_total_icon = 'icon-envelope-alt';
						}
						
						$selected_permintaan_cuti = '';
						$selected_permintaan_lembur = '';
						$selected_perubahan_drh = '';
						
						if($notifikasi_tipe == 'permintaan_cuti'){
							$selected_permintaan_cuti = 'class="active"';
						}
						if($notifikasi_tipe == 'permintaan_lembur'){
							$selected_permintaan_lembur = 'class="active"';
						}
						if($notifikasi_tipe == 'perubahan_drh'){
							$selected_perubahan_drh = 'class="active"';
						}
						
						?>
						<li><a href="javascript:void(0);" title=""><i class="<?php echo $notifikasi_total_icon; ?>"></i>Notifikasi</a></li>
						<li <?php echo $selected_permintaan_cuti; ?>><a href="<?php echo base_url(); ?>notifikasi/permintaan_cuti" title=""><i class="icon-info-sign"></i>Permintaan Cuti <strong><?php echo $notifikasi['permintaan_cuti']; ?></strong></a></li>
						<li <?php echo $selected_permintaan_lembur; ?>><a href="<?php echo base_url(); ?>notifikasi/permintaan_lembur" title=""><i class="icon-info-sign"></i>Permintaan Lembur <strong><?php echo $notifikasi['permintaan_lembur']; ?></strong></a></li>
						<li <?php echo $selected_perubahan_drh; ?>><a href="<?php echo base_url(); ?>notifikasi/perubahan_drh" title=""><i class="icon-info-sign"></i>Perubahan DRH <strong><?php echo $notifikasi['perubahan_data_pegawai']; ?></strong></a></li>
			       
				   </ul>
			        <!-- /main navigation -->
					
			<?php }else if ($menumode == 'engine_report'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
						<li><a href="<?php echo base_url(); ?>engine_report" title=""><i class="icon-reorder"></i>Engine Report List</a>
						</li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Master Report</a>
							<ul>
								<li><a href="<?php echo base_url(); ?>engine_report_master_group" title=""><i class="icon-th"></i>Master Report - Group</a></li>				
								<li><a href="<?php echo base_url(); ?>engine_report_master_group_relasi" title=""><i class="icon-th"></i>Master Report - Relasi Group</a></li>				
								<li><a href="<?php echo base_url(); ?>engine_report_master_field" title=""><i class="icon-th"></i>Master Report - Field</a></li>	
							</ul>
						</li>
			        </ul>
			        <!-- /main navigation -->
					
			<?php }else if ($menumode == 'laporan'){ ?>
					<ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="<?php echo base_url(); ?>laporan" title=""><i class="icon-reorder"></i>List Report</a></li>
						<li><a href="<?php echo base_url(); ?>laporan/duk" title=""><i class="icon-reorder"></i>Daftar Urut Kepangkatan</a></li>
						<li><a href="<?php echo base_url(); ?>laporan/kgp" title=""><i class="icon-reorder"></i>List Report KGB</a></li>
						<!--<li><a href="<?php echo base_url(); ?>laporan/ibel" title=""><i class="icon-reorder"></i>Rekap Izin Belajar</a></li>-->
						<li><a href="<?php echo base_url(); ?>laporan/kp" title=""><i class="icon-reorder"></i>Rekap Kenaikan Pangkat</a></li>
						<li><a href="<?php echo base_url(); ?>laporan/pensiun" title=""><i class="icon-reorder"></i>Rekap Pensiun</a></li>
						<li><a href="<?php echo base_url(); ?>laporan/cuti" title=""><i class="icon-reorder"></i>Rekap Cuti</a></li>
					</ul>
			<?php }else{ 
						echo 'no menu';
				} 			
			?>
			
			<?php
				$nav = $this->uri->segment(1);
				if($nav == 'kenaikanpangkat' || $nav == 'pensiun'){
			?>			
					<ul class="navigation widget" >
			            <li><a href="#" title="">LEGEND STATUS
							<ol><img src="<?php echo base_url()?>img/red.png" /> : Ada Masalah </ol>
							<ol><img src="<?php echo base_url()?>img/yellow.png" /> : Belum di Proses</ol>
							<ol><img src="<?php echo base_url()?>img/green.png" /> : Sudah di Proses</ol>
							
							<ol>&nbsp; 1 &nbsp; : Dokumen Usulan Masuk</ol>
							<ol>&nbsp; 2 &nbsp; : Proses Entri Data</ol>
							<ol>&nbsp; 3 &nbsp; : Tanda Tangan Usulan</ol>
							<ol>&nbsp; 4 &nbsp; : Kirim Ke Biro</ol>
							<ol>&nbsp; 5 &nbsp; : Masalah</ol>
							<ol>&nbsp; 6 &nbsp; : SK Selesai</ol>
							
						</a></li>			
			        </ul>
			<?php
				}
			?>
			
			<?php
				if($nav == 'permasalahan'){
			?>			
					<ul class="navigation widget" >
			            <li><a href="#" title="">LEGEND STATUS
							<ol><img src="<?php echo base_url()?>img/red.png" /> : Ada Masalah </ol>
							<ol><img src="<?php echo base_url()?>img/yellow.png" /> : Belum di Proses</ol>
							<ol><img src="<?php echo base_url()?>img/green.png" /> : Sudah di Proses</ol>
							
							<ol>&nbsp; 1 &nbsp; : Dokumen Usulan Masuk</ol>
							<ol>&nbsp; 2 &nbsp; : Proses Entri Data</ol>
							<ol>&nbsp; 3 &nbsp; : Tanda Tangan Usulan</ol>
							<ol>&nbsp; 4 &nbsp; : Kirim Ke Biro</ol>
							<ol>&nbsp; 5 &nbsp; : SK Selesai</ol>
							
						</a></li>			
			        </ul>
			<?php
				}
			?>
			
			<?php
				$nav2 = $this->uri->segment(2);
				if($nav2 == 'bapeljakat_detail'){
			?>			
					<ul class="navigation widget" >
			            <li><a href="#" title="" style="font-size:10px;">NILAI/SKOR SETIAP UNSUR
							<ol> 1 &nbsp; : Pangkat</ol>
							<ol> 2 &nbsp; : Ijazah</ol>
							<ol> 3 &nbsp; : Diklat Pimpinan</ol>
							<ol> 4 &nbsp; : DUK</ol>
							<ol> 5 &nbsp; : Riwayat Jabatan</ol>
							<ol> 6 &nbsp; : Diklat Teknis/Fungsional</ol>
							<ol> 7 &nbsp; : Usia</ol>
							<ol> 8 &nbsp; : Kesehatan</ol>
							<ol> 9 &nbsp; : Hukum/Disiplin</ol>
							<ol> 10 : Penghargaan/Lama Pengabdian</ol>
							<ol> 11 : Kursus</ol>
							<ol> 12 : Kemampuan Bahasa Inggris</ol>
							<ol> 13 : Kursus yang berhubungan dengan jabatan</ol>
							
						</a></li>			
			        </ul>
			<?php
				}
		
		}
	?>
</div>
<!-- /sidebar -->
