<?php
	//$key = '/##/*()Pu4l4mj4y4';
	//$this->encrypt->set_cipher(MCRYPT_BLOWFISH);
	//$this->encrypt->set_mode(MCRYPT_MODE_CFB);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript">
function printpage(url)
{
	child = window.open(url, "", "scrollbars=1,height=800, width=600"); //Open the child in a tiny window.
}
		
$(function() {
 
	$('#btn_cetak_mutasi').click( function() {
		var sData = $('input', oTable.fnGetNodes()).serialize();
		//alert(sData);
		var checked =  '#';
		var rowcollection =  oTable.$(".call-checkbox:checked", {"page": "all"});
		rowcollection.each(function(index,elem){
			var checkbox_value = $(elem).val();
			//Do something with 'checkbox_value'
			checked = checked+'_'+checkbox_value;
		});
		
		checked = str_replace('#_', '', checked);
		
		var url = '<?php echo base_url()?>mutasi/cetak_multi/'+checked; 
		child = window.open(url, "", "scrollbars=1,height=800, width=600");
		return false;
	} );
	
	$('#btn_cetak_lampiran').click( function() {
		var sData = $('input', oTable.fnGetNodes()).serialize();
		//alert(sData);
		var checked =  '#';
		var rowcollection =  oTable.$(".call-checkbox:checked", {"page": "all"});
		rowcollection.each(function(index,elem){
			var checkbox_value = $(elem).val();
			//Do something with 'checkbox_value'
			checked = checked+'_'+checkbox_value;
		});
		
		checked = str_replace('#_', '', checked);
		
		var url = '<?php echo base_url()?>mutasi/cetak_lampiran/'+checked; 
		child = window.open(url, "", "scrollbars=1,height=600, width=850");
		return false;
	} );
	
});

</script>
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
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						<li class="active"><a href="<?php echo base_url(); ?>mutasi" title="">Mutasi Pegawai</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5><?php echo $title?></h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                 
				
				<div>
				 <table width="100%">
					<tr>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>mutasi" class="btn btn-block btn-info">Daftar Mutasi Pegawai</a></td>
						<?php if ($this->session->userdata('login_state') == 'Admin'){ ?>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>mutasi/surat" class="btn btn-block btn-info">Buat Surat</a></td>
						<?php } ?>
						<td>
							<div style="text-align:right;">
								<button id="btn_cetak_mutasi" class="btn"><i class="fam-printer "></i> Print Kumulatif</button>
								<button id="btn_cetak_lampiran" class="btn"><i class="fam-printer "></i> Print Lampiran</button>
							</div>
						</td>
					</tr>
				 </table>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6><?php echo $title?></h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
									<th>No Surat</th>
									<th>Tanggal</th>
                                    <th>Penanda Tangan</th>
                                    <th>Jumlah Pegawai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$nomor_urut = 1;
								foreach ($surat as $row){
									$id = $row->id;
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $row->no_surat ?></td>
										<td><?php echo $row->tanggal ?></td> 	
										<td><?php echo $row->sekretaris ?></td>
										<td><?php echo $row->jumlah ?></td>
										<td>
											<ul class="table-controls">
												<li><input type="checkbox" value="<?php echo $row->id;?>" class="call-checkbox tip" title="Pilih untuk Print Kumulatif"></li>
												<li><a onclick="printpage('<?php echo base_url(); ?>mutasi/cetak/<?php echo $id;?>');" href="#" class="tip" title="Print Perorangan"><i class="fam-printer"></i></a> </li>
												<li><a href="<?php echo base_url(); ?>mutasi/EditSurat/<?php echo $id;?>" class="tip" title="Edit entry"><i class="fam-pencil"></i></a> </li>
												<li><a href="<?php echo base_url(); ?>mutasi/delete/<?php echo $id;?>" class="tip" onClick="return confirm('Are you sure you want to delete?')" title="Remove entry"><i class="fam-cross"></i></a> </li>
											</ul>
										</td>
									</tr>
								<?php
								$nomor_urut = $nomor_urut + 1;
								}
								?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>