<!-- Fixed top -->
<?php 
$ses_nip_peg = $this->session->userdata('pegawai_id');
$ses_id_peg = '';	
$this->db->where('id', $ses_nip_peg);
$query = $this->db->get('pegawai');
if ($query->num_rows() > 0) {
	$dt_ses = $query->row();	
	$ses_id_peg = $dt_ses->id;
}
 ?>

<div id="top">
	<div class="fixed">
		<div class="logo">
				<a href="<?php echo base_url(); ?>home">
				<img style="height: 62px;width: auto;" src="<?php echo base_url(); ?>img/logodinkes.gif" />	</a>
				<img style="margin-top: -14px;" src="<?php echo base_url(); ?>img/logo.png" />
		</div>
		<ul class="top-menu">
			<li><a class="fullview"></a></li>
			<li><a class="showmenu"></a></li>
			<li><a href="<?php echo base_url();?>" target="_blank" class="info"></a></li>
			<!--<li><a href="#" title="" class="messages"><i class="new-message"></i></a></li>-->
			<li class="dropdown">
				<a class="user-menu" data-toggle="dropdown"><span>My Account <b class="caret"></b></span></a>
				<ul class="dropdown-menu">
				<?php if($ses_nip_peg != 'superadmin'){ ?>
					<li><a href="<?php echo base_url(); ?>pegawai/detail/<?php echo $ses_id_peg;?>" title=""><i class="icon-user"></i>Profile</a></li>
				<?php } ?>
					<li><a href="<?php echo base_url(); ?>home/setting" title=""><i class="icon-cog"></i>Settings</a></li>
					<li><a href="<?php echo base_url(); ?>logout" title=""><i class="icon-remove"></i>Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- End fixed top -->
