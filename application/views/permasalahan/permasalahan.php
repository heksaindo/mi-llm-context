
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<script type="text/javascript"> 	
		//function change_status(e) {
// instead of using prompt() here do
			//window.open(<?php echo site_url(); ?>permasalahan/edit, "", "width=x, height=x,...");
		//}
		
		 $(function () {
				 $.widget("ui.tooltip", $.ui.tooltip, {
					 options: {
						 content: function () {
							 return $(this).prop('title');
						 }
					 }
				 });

				 $('[rel=tooltip]').tooltip({
					 position: {
						 my: "center bottom-20",
						 at: "center top",
						 using: function (position, feedback) {
							 $(this).css(position);
							 $("<div>")
								 .addClass("arrow")
								 .addClass(feedback.vertical)
								 .addClass(feedback.horizontal)
								 .appendTo(this);
						 }
					 }
				 });
			 });
			 
		$(document).ready( function() {
			
			 oTable = $("#permasalahan-table").dataTable({
					"bJQueryUI": false,
					"bAutoWidth": "100%",
					"sScrollX": "100%",
					"sScrollXInner": "110%",
					"sPaginationType": "full_numbers",
					"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
					"oLanguage": {
						"sSearch": "<span>Filter records:</span> _INPUT_",
						"sLengthMenu": "<span>Show entries:</span> _MENU_",
						"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
					},
					"fnDrawCallback": function () {
					  $( '.tip' ).tooltip( {
						"delay": 0,
						"track": false,
						"fade": 250,
						options: {
							  content: function () {
								  return $(this).prop('title');
							  }
					  }
					  } );
					},
					"aoColumnDefs": [
						{ "bSortable": false, "aTargets": [ 0 ] }
					] 
			} );
			
			//permasalahan();
			//input_permasalahan();
			
			
			
			

		} );
		
		
		function edit(ID){
			  var id  = ID;
				$.ajax({
				  type  : "POST",
				  url   : "<?php echo site_url(); ?>permasalahan/edit",
				  data  : "id="+id,
				  dataType : "json",
				  success : function(data){  
					
					$("#id").val(data.id);
					$("#kategori").val(data.kategori_id);
					$("#sub").val(data.sub_kategori_id);
					$("#nip").val(data.nip);
					$("#keterangan").val(data.keterangan);
					$("#tanggal").val(data.tanggal);
					//$('#input_permasalahan').dialog('open');
					
					$( "#nip" ).trigger( "change" );
					$( "#kategori" ).trigger( "change" );
					
					return false;
				  }
				});
			  
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
						<li class="active"><a href="<?php echo base_url(); ?>permasalahan" title="">Permasalahan Pegawai</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
				<div class="page-title">
					<h5>Data Permasalahan Pegawai</h5>  
				</div>
				</div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<div>
				 <table>
					<tr>
						<td style="width:150px;">
							<a href="<?php echo base_url(); ?>permasalahan/add" id="add" name="add" class="btn btn-block btn-info">Add Permasalahan Pegawai</a>
						</td>
					</tr>
				 </table>
				 </div>
				 
				 <!-- Media datatable -->
                <div class="widget">
					
					<div style="clear: both;"></div>
					
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Permasalahan Pegawai</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="permasalahan-table" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th width="20" rowspan="2">No</th>
                                    <th width="200" rowspan="2">Nama / NIP</th>
                                    <th width="160" rowspan="2">Unit Kerja</th>
									<th width="160" rowspan="2">Permasalahan</th>
									<th width="160" rowspan="2">Keterangan</th>
									<th width="23%" colspan="5"><div style="text-align:center;">Status</div></th>    
									<th width="50" rowspan="2">Action</th>									
                                </tr>
								<tr>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>5</th>
								</tr>
                            </thead>
                            <tbody>
							<?php 
								$nomor_urut = 1;
								foreach ($pegawai as $row){
									$id = $row->id;
								?>
									<tr>
										<td><?php echo $nomor_urut; ?></td>
										<td><?php echo $row->nip." - ".$row->nama;?></td>
										<td><?php echo $row->unit_kerja;?></td>
										<td><?php echo $row->kategori;?></td>
										<td><?php echo $row->keterangan;?></td>
										<td>
											<?php 
												switch ($row->dok_usulan_msk)
												{
													case 0:
														$img='<img src="'.base_url().'img/yellow.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/UsulanSurat/".$row->id." class='tip' title='Dokumen Usulan Masuk' >".$img."</a>";
														//echo "<a href='#' class='tip' title='Dokumen Usulan Masuk' >".$img."</a>";
													break;
													case 1:
														echo '<img src="'.base_url().'img/green.png" />';
														//$img='<img src="'.base_url().'img/green.png" />';
														//echo '<a href="#" id="status" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img.'</a>';
													break;
													case 2:
														$img='<img src="'.base_url().'img/red.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/UsulanSurat/".$row->id." class='tip' title='Dokumen Surat Masuk <p>Keterangan: ".$row->permasalahan."</P>	' >".$img."</a>";
													break;
												}
											?>
										</td>
										<td>
											<?php 
												if ($row->dok_usulan_msk==1)
												{
													switch ($row->proses_surat)
													{
														case 0:
														$img='<img src="'.base_url().'img/yellow.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/ProsesSurat/".$row->id." class='tip' title='Proses Entry Data' >".$img."</a>";
														//echo "<a href='#' class='tip' title='Dokumen Usulan Masuk' >".$img."</a>";
													break;
													case 1:
														echo '<img src="'.base_url().'img/green.png" />';
														//echo '<a href="#" id="status" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img.'</a>';
													break;
													case 2:
														$img='<img src="'.base_url().'img/red.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/ProsesSurat/".$row->id." class='tip' title='Proses Entry Data <p>Keterangan: ".$row->permasalahan."</P>	' >".$img."</a>";
													break;
													}
												} else {
													echo '<img src="'.base_url().'img/yellow.png" />';
												}
											?>
										</td>
										<td>
											<?php 
												if ($row->proses_surat==1)
												{
													switch ($row->tanda_tangan_surat)
													{
														case 0:
														$img='<img src="'.base_url().'img/yellow.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/TandaTangan/".$row->id." class='tip' title='Tanda Tangan Usulan' >".$img."</a>";
														//echo "<a href='#' class='tip' title='Dokumen Usulan Masuk' >".$img."</a>";
													break;
													case 1:
														echo '<img src="'.base_url().'img/green.png" />';
														//echo '<a href="#" id="status" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img.'</a>';
													break;
													case 2:
														$img='<img src="'.base_url().'img/red.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/TandaTangan/".$row->id." class='tip' title='Tanda Tangan Usulan <p>Keterangan: ".$row->permasalahan."</P>	' >".$img."</a>";
													break;
													}
												} else {
													echo '<img src="'.base_url().'img/yellow.png" />';
												}
											?>
										</td>
										<td>
											<?php 
												if ($row->tanda_tangan_surat==1)
												{
													switch ($row->surat_dikirim)
													{
														case 0:
														$img='<img src="'.base_url().'img/yellow.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/SuratDikirim/".$row->id." class='tip' title='Kirim Ke Biro' >".$img."</a>";
														//echo "<a href='#' class='tip' title='Dokumen Usulan Masuk' >".$img."</a>";
													break;
													case 1:
														echo '<img src="'.base_url().'img/green.png" />';
														//echo '<a href="#" id="status" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img.'</a>';
													break;
													case 2:
														$img='<img src="'.base_url().'img/red.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/SuratDikirim/".$row->id." class='tip' title='Kirim Ke Biro <p>Keterangan: ".$row->permasalahan."</P>	' >".$img."</a>";
													break;
													}
												} else {
													echo '<img src="'.base_url().'img/yellow.png" />';
												}
											?>
										</td>
										<td>
											<?php 
												if ($row->surat_dikirim==1)
												{
													switch ($row->sk_selesai)
													{
														case 0:
														$img='<img src="'.base_url().'img/yellow.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/Selesai/".$row->id." class='tip' title='Sk Selesai' >".$img."</a>";
														//echo "<a href='#' class='tip' title='Dokumen Usulan Masuk' >".$img."</a>";
													break;
													case 1:
														echo '<img src="'.base_url().'img/green.png" />';
														//echo '<a href="#" id="status" class="tip" data-toggle="tooltip" title="Dokumen Usulan Masuk">'.$img.'</a>';
													break;
													case 2:
														$img='<img src="'.base_url().'img/red.png" />';
														echo "<a href=".base_url()."permasalahan/UpdateStatus/Selesai/".$row->id." class='tip' title='SK Selesai <p>Keterangan: ".$row->permasalahan."</P>	' >".$img."</a>";
													break;
													}
												} else {
													echo '<img src="'.base_url().'img/yellow.png" />';
												}
											?>
										</td>
										<td>
											 <ul class="table-controls">
												<li><a href="<?php echo base_url(); ?>permasalahan/edit/<?php echo $id;?>" class="tip" title="Edit entry"><i class="fam-pencil"></i></a> </li>
												<li><a href="<?php echo base_url(); ?>permasalahan/delete/<?php echo $id;?>" class="tip" onClick="return confirm('Are you sure you want to delete?')" title="Remove entry"><i class="fam-cross"></i></a> </li>
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
				
				<!-- Media datatable -->
              
				
			
			<div id="InputStatus" title="Input Data"></div>
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	
	
	
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>
<script>

</script>
