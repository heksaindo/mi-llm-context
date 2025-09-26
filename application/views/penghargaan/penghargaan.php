<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head'); ?>
	<script type="text/javascript">
		function printpage(url)
		{
		child = window.open(url, "", "scrollbars=1,height=800, width=600"); //Open the child in a tiny window.
		}
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
						<li class="active"><a href="<?php echo base_url(); ?>penghargaan" title="">Penghargaan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Penghargaan Pegawai</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				<div>
				 <table>
					<tr>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>penghargaan/addpenghargaan" class="btn btn-block btn-info">Add Penghargaan</a></td>
					</tr>
				 </table>
				 </div>
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Daftar Penghargaan Pegawai</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>NIP</th>
                                    <th>Instansi Pelaksana</th>
                                    <th>Nama Penghargaan</th>
                                    <th>Tanda Jasa</th>
                                    <th>No SK</th>
									<th>Tanggal SK</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$nomor_urut = 1;
								foreach ($data_pegawai as $pegawai){
									$pegawai_id = $pegawai->id;
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $pegawai->nama.'<br>'.$pegawai->nip_baru; ?></td>
										<td><?php echo $pegawai->instansi_pelaksana ?></td>
										<td><?php echo $pegawai->nama_penghargaan ?></td>
										<td><?php echo $pegawai->tanda_jasa ?></td>
										<td><?php echo $pegawai->no_sk ?></td>
										<td><?php echo $pegawai->tgl_sk ?></td>
										<td>
											 <ul class="table-controls">
												<li><a href="<?php echo base_url(); ?>penghargaan/edit/<?php echo $pegawai_id;?>" class="tip" title="Edit entry"><i class="fam-pencil"></i></a> </li>
												<li><a href="<?php echo base_url(); ?>penghargaan/delete/<?php echo $pegawai_id;?>" class="tip" onClick="return confirm('Are you sure you want to delete?')" title="Remove entry"><i class="fam-cross"></i></a> </li>
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
