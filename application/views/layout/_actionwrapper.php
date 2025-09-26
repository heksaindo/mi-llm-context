<div class="actions-wrapper">
	<div class="actions">

		<div id="user-stats">
			<ul class="round-buttons">
				<li><div class="depth"><a href="<?php echo base_url(); ?>administrasipegawai" title="Kepegawaian" class="tip"><i class="icon-user"></i></a></div></li>
				<li><div class="depth"><a href="<?php echo base_url(); ?>penugasandankehadiran" title="Kehadiran Pegawai" class="tip"><i class="icon-time"></i></a></div></li>
				<!--<li><div class="depth"><a href="<?php echo base_url(); ?>pendidikan" title="Pendidikan & Pelatihan" class="tip"><i class="icon-book"></i></a></div></li>-->
				<li><div class="depth"><a href="<?php echo base_url(); ?>laporan" title="Laporan" class="tip"><i class="icon-bar-chart"></i></a></div></li>
				<?php if($this->session->userdata('login_state') != 'User') { ?>
				<!--<li><div class="depth"><a href="<?php echo base_url(); ?>organisasi" title="Manajemen Organisasi" class="tip"><i class="icon-sitemap"></i></a></div></li>-->
				<?php } ?>
				<!--
				<li><div class="depth"><a href="<?php echo base_url(); ?>karir" title="Administrasi Karir" class="tip"><i class="icon-signal"></i></a></div></li>		
				<li><div class="depth"><a href="<?php echo base_url(); ?>formasi" title="Formasi & Perencanaan" class="tip"><i class="icon-group"></i></a></div></li>
				-->
				<?php if($this->session->userdata('login_state') == 'Admin') { ?>
				<li><div class="depth"><a href="<?php echo base_url(); ?>master_data" title="Master Data" class="tip"><i class="icon-group"></i></a></div></li>
				<?php } ?>
			</ul>
		</div>

		<!--<div id="quick-actions">
			<ul class="round-buttons">
				<li><div class="depth"><a href="#" title="Create Dashboard" class="tip"><i class="icon-plus"></i></a></div></li>
			</ul>
		</div>-->

		<!--<div id="map">
			<ul class="round-buttons">
				<li><div class="depth"><a href="<?php echo base_url(); ?>engine_report" title="Engine Report" class="tip"><i class="icon-plus"></i></a></div></li>
			</ul>
		</div>-->

		<ul class="action-tabs">
			<li><a href="#user-stats" title="">Layanan</a></li>
			<!--<li><a href="#quick-actions" title="">Dashboard Systems</a></li>-->
			<!--<li><a href="#map" title="" >Engine Report</a></li>-->
		</ul>
	</div>
</div>

