<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript" charset="utf-8">
	
	function do_cetak_karpeg() {
		var usulan_table = $('.media-table').dataTable();
		var chkIdx; var aData; var idColl=''; var dataColl='';
		$('input:checkbox:checked').each(function(i){
			chkIdx = $(this).val();
			if(chkIdx != "")
			{
				aData = usulan_table.fnGetData(chkIdx);
				idColl += $("#id"+chkIdx).val() + ';';
				dataColl += aData[0] + '_';
			}else{
				alert('Pilih Pegawai yang akan di proses!');
			}
		});
		
		if(idColl.length>0)
		{
			if(confirm('Anda yakin akan cetak karpeg dengan NIP dibawah ini ?\n'+ idColl)){		
			
				if(idColl.length == 1){
					$( "#dialog-cetak_usulan" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/one/'+idColl)
						.dialog({
						  autoOpen: false,
						  height: 600,
						  width: 800,
						  modal: true,
						  title: 'Cetak Usulan Karpeg',
						  buttons: {
							"Simpan": function() {
								do_cetak(idColl,'Karpeg');
								$( this ).dialog( "close" );
							},
							"Batal": function() {
							  $( this ).dialog( "close" );
							}
						 },
						  
					}); 
					$( "#dialog-cetak_usulan" ).dialog( "open" );
					
				}else{
					
					$( "#dialog-cetak_usulan_list" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/many/'+dataColl)
						.dialog({
						  autoOpen: false,
						  height: 600,
						  width: 800,
						  modal: true,
						  title: 'Cetak Usulan Pegawai',
						  buttons: {
							"Cetak": function() {
								do_cetak(idColl, 'Karpeg');
								$( this ).dialog( "close" );
							},
							"Batal": function() {
							  $( this ).dialog( "close" );
							}
						 },
						  
					}); 
					
					$( "#dialog-cetak_usulan_list" ).dialog( "open" );
				}

			}
		}
		
	}
	
	function do_cetak_karsu() {
		var usulan_table = $('.media-table').dataTable();
		var chkIdx; var aData; var idColl=''; var dataColl='';
		$('input:checkbox:checked').each(function(i){
			chkIdx = $(this).val();
			if(chkIdx != "")
			{
				aData = usulan_table.fnGetData(chkIdx);
				idColl += $("#id"+chkIdx).val() + ';';
				dataColl += aData[0] + '_';
			}else{
				alert('Pilih Pegawai yang akan di proses!');
			}
		});
		
		if(idColl.length>0)
		{
			if(confirm('Anda yakin akan cetak Karsu dengan NIP dibawah ini ?\n'+ idColl)){		
			
				if(idColl.length == 1){
					$( "#dialog-cetak_usulan" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/one/'+idColl)
						.dialog({
						  autoOpen: false,
						  height: 600,
						  width: 800,
						  modal: true,
						  title: 'Cetak Usulan Karsu',
						  buttons: {
							"Simpan": function() {
								do_cetak(idColl, 'Karsu');
								$( this ).dialog( "close" );
							},
							"Batal": function() {
							  $( this ).dialog( "close" );
							}
						 },
						  
					}); 
					$( "#dialog-cetak_usulan" ).dialog( "open" );
					
				}else{
					
					$( "#dialog-cetak_usulan_list" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/many/'+dataColl)
						.dialog({
						  autoOpen: false,
						  height: 600,
						  width: 800,
						  modal: true,
						  title: 'Cetak Usulan Pegawai',
						  buttons: {
							"Cetak": function() {
								do_cetak(idColl, 'Karsu');
								$( this ).dialog( "close" );
							},
							"Batal": function() {
							  $( this ).dialog( "close" );
							}
						 },
						  
					}); 
					
					$( "#dialog-cetak_usulan_list" ).dialog( "open" );
				}

			}
		}
		
	}
	
	function do_cetak_karis() {
		var usulan_table = $('.media-table').dataTable();
		var chkIdx; var aData; var idColl=''; var dataColl='';
		$('input:checkbox:checked').each(function(i){
			chkIdx = $(this).val();
			if(chkIdx != "")
			{
				aData = usulan_table.fnGetData(chkIdx);
				idColl += $("#id"+chkIdx).val() + ';';
				dataColl += aData[0] + '_';
			}else{
				alert('Pilih Pegawai yang akan di proses!');
			}
		});
		
		if(idColl.length>0)
		{
			if(confirm('Anda yakin akan cetak karis dengan NIP dibawah ini ?\n'+ idColl)){		
			
				if(idColl.length == 1){
					$( "#dialog-cetak_usulan" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/one/'+idColl)
						.dialog({
						  autoOpen: false,
						  height: 600,
						  width: 800,
						  modal: true,
						  title: 'Cetak Usulan Karis',
						  buttons: {
							"Simpan": function() {
								do_cetak(idColl, 'Karis');
								$( this ).dialog( "close" );
							},
							"Batal": function() {
							  $( this ).dialog( "close" );
							}
						 },
						  
					}); 
					$( "#dialog-cetak_usulan" ).dialog( "open" );
					
				}else{
					
					$( "#dialog-cetak_usulan_list" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/many/'+dataColl)
						.dialog({
						  autoOpen: false,
						  height: 600,
						  width: 800,
						  modal: true,
						  title: 'Cetak Usulan Pegawai',
						  buttons: {
							"Cetak": function() {
								do_cetak(idColl, 'Karis');
								$( this ).dialog( "close" );
							},
							"Batal": function() {
							  $( this ).dialog( "close" );
							}
						 },
						  
					}); 
					
					$( "#dialog-cetak_usulan_list" ).dialog( "open" );
				}

			}
		}
		
	}
	
	function do_cetak(idColl, tipe_usulan){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_cetak_usulan",
			data: 'idColl='+idColl+'&tipe_usulan='+tipe_usulan, 
			success: function(msg){	
				//alert(msg);
				if(msg == 'success'){	
					window.print();										
				}else{
					alert('Cetak Usulan Gagal');
				}
				
			}
		});
		return false;
	}
	
	function printpage(url)	{
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
						<li><a href="<?php echo base_url(); ?>pegawai" title="">Daftar Riwayat Hidup Pegawai</a></li>
						<li class="active"><a href="#" title="">Usulan Pegawai</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>List Histori Usulan</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
                <div class="widget">
                	<div style="float: right;">
						<a href="<?php echo base_url().'pegawai/cetak_usulan'; ?>"  class="btn btn-primary"><< Add Cetak Usulan</a>
					</div>
					<div style="clear: both;"></div>
					 
                    <div class="table-overflow">
					<form id="form_usulan" name="form_usulan" action="" method="POST" >
                        <table  class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Kode</th>
                                    <th>Usulan</th>
                                    <th>Tanggal</th>
                                    <th>NIP Baru</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								if($data_pegawai){
									foreach ($data_pegawai as $pegawai){
										$pegawai_id = $pegawai['id'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $pegawai['kode_usulan'] ?></td>
											<td><?php echo $pegawai['tipe_usulan'] ?></td>
											<td><?php echo reformat_date($pegawai['updated_date'],'d-m-Y'); ?></td>
											<td><?php echo $pegawai['nip_baru'] ?></td>
											<td><?php echo $pegawai['nama'] ?></td>
											<td><?php echo $pegawai['status_pegawai'] ?></td>
										</tr>
									<?php
									$no = $no + 1;
									}
								}
								?>
                            </tbody>
                        </table>
					</form>
                    </div>
                </div>
                <!-- /media datatable -->

				<a href="<?php echo base_url().'pegawai/cetak_usulan'; ?>"  class="btn btn-primary"><< Back</a>
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>