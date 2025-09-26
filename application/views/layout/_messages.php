<!--<ul class="alt-buttons">
	<li><a href="#" title=""><i class="icon-signal"></i><span>Stats</span></a></li>
	<li><a href="#" title=""><i class="icon-comments"></i><span>Messages</span></a></li>
	<?php
	
	
	if(!empty($notifikasi['total'])){
		
		$permintaan_cuti_hide = 'class="hide"';
		$permintaan_lembur_hide = 'class="hide"';
		$perubahan_data_pegawai_hide = 'class="hide"';
		
		if(!empty($notifikasi['permintaan_cuti'])){
			$permintaan_cuti_hide = '';
		}
		if(!empty($notifikasi['permintaan_lembur'])){
			$permintaan_lembur_hide = '';
		}
		if(!empty($notifikasi['perubahan_data_pegawai'])){
			$perubahan_data_pegawai_hide = '';
		}
	?>
		<li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-envelope-alt"></i><span>Notifikasi</span> <strong>(+<?php echo $notifikasi['total']; ?>)</strong></a>
			<ul class="dropdown-menu pull-right">
				<li <?php echo $permintaan_cuti_hide; ?>><a href="<?php echo base_url(); ?>notifikasi/permintaan_cuti" title=""><i class="icon-info-sign"></i>Permintaan Cuti <strong><?php echo '+'.$notifikasi['permintaan_cuti']; ?></strong></a></li>
				<li <?php echo $permintaan_lembur_hide; ?>><a href="<?php echo base_url(); ?>notifikasi/permintaan_lembur" title=""><i class="icon-info-sign"></i>Permintaan Lembur <strong><?php echo '+'.$notifikasi['permintaan_lembur']; ?></strong></a></li>
				<li <?php echo $perubahan_data_pegawai_hide; ?>><a href="<?php echo base_url(); ?>notifikasi/perubahan_drh" title=""><i class="icon-info-sign"></i>Perubahan DRH <strong><?php echo '+'.$notifikasi['perubahan_data_pegawai']; ?></strong></a></li>
			</ul>
		</li>
	<?php
	}else{
	?>
		<li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-envelope"></i><span>Notifikasi</span> <strong>(0)</strong></a>
			<ul class="dropdown-menu pull-right">
				<li class="hide"><a href="<?php echo base_url(); ?>notifikasi/permintaan_cuti" title=""><i class="icon-info-sign"></i>Permintaan Cuti<strong>0</strong></a></li>
				<li class="hide"><a href="<?php echo base_url(); ?>notifikasi/permintaan_lembur" title=""><i class="icon-info-sign"></i>Permintaan Lembur<strong>0</strong></a></li>
				<li class="hide"><a href="<?php echo base_url(); ?>notifikasi/perubahan_drh" title=""><i class="icon-info-sign"></i>Perubahan Data Pegawai <strong>0</strong></a></li>
			</ul>
		</li>
	<?php
	}
	?>
</ul>-->