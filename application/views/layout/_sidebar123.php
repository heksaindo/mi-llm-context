<!-- Sidebar -->
		<div id="sidebar">

			<div class="sidebar-tabs">
		        <ul class="tabs-nav two-items">
		            <li><a href="#general" data-placement="bottom" title="Info" class="tip"><i class="icon-reorder"></i></a></li>
		            <li><a href="#stuff" data-placement="bottom" title="Menu" class="tip"><i class="icon-cogs"></i></a></li>
		        </ul>

		        <div id="stuff">

					<?php if ($menumode == 'home'){ ?>
				    <!-- Main navigation -->
			        <ul class="navigation widget">
			            <li class="active"><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Dashboard</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Aturan - Aturan Dasar<strong>3</strong></a>
			                <ul>
			                    <li><a href="<?php echo base_url(); ?>cuti" title="">Cuti</a></li>
			                    <li><a href="<?php echo base_url(); ?>kenaikanpangkat" title="">Kenaikan Pangkat</a></li>
			                    <li><a href="<?php echo base_url(); ?>kenaikangajipegawai" title="">Kenaikan Gaji</a></li>
			                </ul>
			            </li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Peraturan Pemerintah</a></li>
			            <li><a href="#" title=""><i class="icon-picture"></i>Peraturan Presiden</a></li>
			            <li><a href="#" title=""><i class="icon-th"></i>Keputusan Menteri</a></li>
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'administrasipegawai'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="<?php echo base_url(); ?>pegawai" title=""><i class="icon-reorder"></i>Daftar Riwayat Hidup</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Daftar Urut Kepangkatan</a></li>
			            <li><a href="<?php echo base_url(); ?>kenaikangajipegawai" title=""><i class="icon-picture"></i>Kenaikan Gaji Pegawai</a></li>
			            <li><a href="<?php echo base_url(); ?>kenaikanpangkat" title=""><i class="icon-th"></i>Kenaikan Pangkat</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Penghargaan</a></li>
			            <li><a href="<?php echo base_url(); ?>pensiun" title=""><i class="icon-picture"></i>Pensiun</a></li>
                        <li><a href="#" title=""><i class="icon-picture"></i>Mutasi Pegawai</a></li>
			            <li><a href="#" title=""><i class="icon-th"></i>Hukuman & Disiplin</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Administrasi SK</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Administrasi KARPEG dan KARIS/KARSU</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Laporan Pegawai</a></li>						
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'penugasandankehadiran'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Cuti Pegawai</a>
			                <ul>
			                    <li><a href="<?php echo base_url(); ?>cuti" title="">Pengajuan Cuti</a></li>
			                </ul>
			            </li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Ijin</a></li>
			            <li><a href="#" title=""><i class="icon-picture"></i>Sakit</a></li>
			            <li><a href="#" title=""><i class="icon-th"></i>Perjalanan Dinas</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Lembur</a></li>
			            <li><a href="#" title=""><i class="icon-picture"></i>Tugas Belajar</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Laporan Kehadiran</a></li>						
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'evaluasi'){ ?>
					 <!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Angka Kredit</a>
			                <ul>
			                    <li><a href="#" title="">Pengajuan Angka Kredit</a></li>
                                <li><a href="#" title="">Penetapan Angka Kredit</a></li>
                                <li><a href="#" title="">Updating Data Informasi Angka Kredit</a></li>
			                </ul>
			            </li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Penilaian Kinerja</a></li>
			            <li><a href="#" title=""><i class="icon-picture"></i>Analisa SDM</a></li>
			            <li><a href="#" title=""><i class="icon-th"></i>Laporan Penilaian</a></li>					
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'pendidikan'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="#" title=""><i class="icon-reorder"></i>Ujian Dinas</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Ujian Dinas Kenaikan Pangkat Penyesuaian Ijazah</a></li>
			            <li><a href="#" title=""class="expand"><i class="icon-picture"></i>Diklat Kepemimpinan</a>
							<ul>
			                    <li><a href="#" title="">Tingkat I dan II</a></li>
                                <li><a href="#" title="">Tingkat III dan IV</a></li>
			                </ul>
						</li>
						<li><a href="#" title="" class="expand"><i class="icon-th"></i>Tugas Belajar</a>
							<ul>
			                    <li><a href="#" title="">Dalam Negeri</a></li>
                                <li><a href="#" title="">Luar Negeri</a></li>
			                </ul>
						</li>	
						<li><a href="#" title=""><i class="icon-th"></i>Diklat Prajabatan</a></li>	
			            <li><a href="#" title=""><i class="icon-th"></i>Laporan Pendidikan & Pelatihan</a></li>					
			        </ul>
			        <!-- /main navigation -->
					<?php }else if ($menumode == 'organisasi'){ ?>
					<!-- Main navigation -->
			        <ul class="navigation widget" >
			            <li><a href="<?php echo base_url(); ?>home" title=""><i class="icon-home"></i>Home</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>BAPERJAKAT</a></li>
			            <li><a href="#" title=""><i class="icon-tasks"></i>Manajeman Jabatan</a></li>
			            <li><a href="#" title=""><i class="icon-picture"></i>Kompetensi Jabatan</a></li>
						<li><a href="#" title=""><i class="icon-th"></i>Analisa Jabatan</a></li>	
						<li><a href="#" title=""><i class="icon-th"></i>Struktur Organisasi</a></li>	
			            <li><a href="#" title=""><i class="icon-th"></i>Laporan Organisasi</a></li>					
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
					<?php }else{ 
						echo 'no menu';
					} ?>
		        </div>

		        <div id="general">
	
					<!-- Sidebar user -->
			        <div class="sidebar-user widget">
						<div class="navbar"><div class="navbar-inner"><h6>Hello, <?php echo $this->session->userdata('username'); ?></h6></div></div>
			            <div align="center"><a href="#" title="" class="user"><img src="<?php echo base_url(); ?>images/<?php echo $this->session->userdata('foto');?>" alt="" /></a></div>
			            <ul class="user-links">
			            	<li><a href="#" title="">Permintaan Cuti<strong>+3</strong></a></li>
			            	<li><a href="#" title="">Permintaan Lembur<strong>+2</strong></a></li>
			            	<li><a href="#" title="">Perubahan Data Pegawai <strong>+1</strong></a></li>
			            </ul>
			        </div>
			        <!-- /sidebar user -->
					<!-- Wdiget Stat -->
			        <div class="general-stats widget">
				        <ul class="head">
				        	<li><span>Total Cuti</span></li>
				        	<li><span>Dipakai</span></li>
				        	<li><span>Sisa</span></li>
				        </ul>
				        <ul class="body">
				        	<li><strong>24</strong></li>
				        	<li><strong>10</strong></li>
				        	<li><strong>14</strong></li>
				        </ul>
				    </div>

                    <!-- Datepicker -->
		        	<div class="widget">
		        		<h6 class="widget-name"><i class="icon-calendar"></i>My Agenda</h6>
		                <div class="inlinepicker datepicker-liquid"></div>
		            </div>
		            <!-- /datepicker -->


		            <!-- Dates range -->
                    <ul class="widget dates-range">
                        <li><input type="text" id="fromDate" name="from" placeholder="From" /></li>
                        <li class="sep">-</li>
                        <li><input type="text" id="toDate" name="to" placeholder="To" /></li>
                    </ul>
                    <!-- /dates range -->

                    <!-- Time picker range -->
                    <ul class="widget dates-range">
                        <li><input id="timeformatExample1" type="text" placeholder="Start" /></li>
                        <li class="sep">-</li>
                        <li><input id="timeformatExample2" type="text" placeholder="End" /></li>
                    </ul>
                    <!-- /time picker range -->

		        </div>

		    </div>
		</div>
		<!-- /sidebar -->