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
						 <li><a href="<?php echo base_url(); ?>pendidikan" title="">Pendidikan</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>tubel" title="">Tugas Belajar</a></li>
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Data Tugas Belajar</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<div>
				 <table>
					<tr>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>tubel/add" class="btn btn-block btn-info">pengajuan tubel</a></td>
						<?php if ($this->session->userdata('login_state') == 'Admin'){ ?>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>tubel/approve" class="btn btn-block btn-info">approve tubel</a></td>
						<?php } ?>
					</tr>
				 </table>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Riwayat Tugas Belajar</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
									<th>NIP</th>
									<th>Nama</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Jenis Tubel</th>
									<th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$nomor_urut = 1;
								foreach ($data_tubel as $tubel){
									$tubel_id = $tubel['id'];
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $tubel['nip'] ?></td>
										<td><?php echo $tubel['nama'] ?></td> 	
										<td><?php echo $tubel['tanggal_mulai'] ?></td>
										<td><?php echo $tubel['tanggal_akhir'] ?></td>
										<td><?php echo $tubel['jenis_tubel'] ?></td>
										<td><?php echo $tubel['status'] ?></td>
										<td>
											<?php if ($tubel['status'] == 'approved'){ ?>
											<ul class="table-controls">
												<li><a onclick="printpage('<?php echo base_url(); ?>tubel/cetak/<?php echo $tubel_id;?>');" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>
											</ul>
											<?php }else if ($tubel['status'] == 'submit'){ ?>
											<ul class="table-controls">
												<li><a href="<?php echo base_url(); ?>tubel/edit/<?php echo $tubel_id;?>" class="tip" title="Edit entry"><i class="fam-pencil"></i></a> </li>
												<li><a href="#" class="tip" onClick="return confirm('Are you sure you want to delete?')" title="Remove entry"><i class="fam-cross"></i></a> </li>
											</ul>
											<?php } ?>
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