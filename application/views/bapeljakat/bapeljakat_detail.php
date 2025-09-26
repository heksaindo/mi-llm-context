<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>

<script type="text/javascript"> 
 $(function() {
	$("#calon_pejabat").val('');	
	$('#dialog-nilai').hide();
	$('#dialog-print').hide();
	
	//===== Datatables =====//
	oTable_bapeljakat_detail = $('table#list-bapeljakat_detail').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>bapeljakat/ajax_bapeljakat_detail",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			
			aoData.push({name: "id_bapeljakat", value: $('#id_bapeljakat').val() });
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		},
		"fnDrawCallback": function () {
		  $( '.tip' ).tooltip( {
			"delay": 0,
			"track": true,
			"fade": 250
		  } );
		}
			
	});
	
	//autocomplete bapeljakat
		$("#calon_pejabat").autocomplete("<?php echo base_url(); ?>bapeljakat/auto_pegawai_bapeljakat", {
			width: 400,
			minChars:0,
			max:100,
			selectFirst: false
		});

		$("#calon_pejabat").result(function(event, data, formatted) {
			if (data){  
				$("#calon_pejabat").val(data[0]);					
				$("#calon_nama").val(data[1]);					
				$("#calon_nip").val(data[2]);					
				$("#calon_golongan").val(data[3]);					
				$("#calon_tmt_golongan").val(data[4]);					
				$("#calon_pendidikan").val(data[5]);					
				$("#calon_diklat").val(data[6]);					
				$("#calon_riwayatjabatan").val(data[7]);					
				
			}
		});
		
	$("#add-bapeljakat_detail").click(function(){
		var id_bapeljakat = $("#id_bapeljakat").val();
		var calon_nama = $("#calon_nama").val();
		var calon_nip = $("#calon_nip").val();
		var calon_golongan = $("#calon_golongan").val();
		var calon_tmt_golongan = $("#calon_tmt_golongan").val();
		var calon_pendidikan = $("#calon_pendidikan").val();
		var calon_diklat = $("#calon_diklat").val();
		var calon_riwayatjabatan = $("#calon_riwayatjabatan").val();
		if(calon_nama){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>bapeljakat/add_bapeljakat_detail",
				data: "calon_nama="+calon_nama+"&calon_nip="+calon_nip+"&calon_golongan="+calon_golongan+"&calon_tmt_golongan="+calon_tmt_golongan+
						"&id_bapeljakat="+id_bapeljakat+"&calon_pendidikan="+calon_pendidikan+"&calon_diklat="+calon_diklat+"&calon_riwayatjabatan="+calon_riwayatjabatan, 
				success: function(msg){	
					if(msg == 'success'){			
						oTable_bapeljakat_detail.fnDraw();	
						$("#calon_pejabat").val('');									
						$("#calon_nama").val('');									
						$("#calon_nip").val('');									
						$("#calon_golongan").val('');									
						$("#calon_tmt_golongan").val('');									
						$("#calon_pendidikan").val('');									
						$("#calon_diklat").val('');									
						$("#calon_riwayatjabatan").val('');									
					}
					return false;
				}
			});
		}else{
			$( "#validasi_bapeljakat_detail" ).html( '<font color="red"> Pilih bapeljakat detail.</font>' );	
		}
	});
	
});

function onDeleteBapeljakat_detail(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>bapeljakat/do_delete_bapeljakat_detail",
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_bapeljakat_detail.fnDraw();	
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function onEditBapeljakat_detail(id) {

	$( "#id" ).val( id );
	$( "#nilai_1" ).val('');
	$( "#nilai_2" ).val('');
	$( "#nilai_3" ).val('');
	$( "#nilai_4" ).val('');
	$( "#nilai_5" ).val('');
	$( "#nilai_6" ).val('');
	$( "#nilai_7" ).val('');
	$( "#nilai_8" ).val('');
	$( "#nilai_9" ).val('');
	$( "#nilai_10" ).val('');
	$( "#nilai_11" ).val('');
	$( "#nilai_12" ).val('');
	$( "#nilai_13" ).val('');
	$( "#catatan_hasil" ).val('');
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>bapeljakat/cek_nilai/"+id,
			//data: $('#form-eselon').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#calon_nama_edit" ).html( dt[0] );
				$( "#calon_nip_edit" ).html( dt[1] );
				$( "#nilai_1" ).val( dt[2] );
				$( "#nilai_2" ).val( dt[3] );
				$( "#nilai_3" ).val( dt[4] );
				$( "#nilai_4" ).val( dt[5] );
				$( "#nilai_5" ).val( dt[6] );
				$( "#nilai_6" ).val( dt[7] );
				$( "#nilai_7" ).val( dt[8] );
				$( "#nilai_8" ).val( dt[9] );
				$( "#nilai_9" ).val( dt[10] );
				$( "#nilai_10" ).val( dt[11] );
				$( "#nilai_11" ).val( dt[12] );
				$( "#nilai_12" ).val( dt[13] );
				$( "#nilai_13" ).val( dt[14] );
				$( "#catatan_hasil" ).val( dt[15] );
			}
		});
	}else{
		$( "#nama_eselon" ).val( "" );
	}
	
	$( "#dialog-nilai" ).dialog({
		  autoOpen: false,
		  height: 500,
		  width: 600,
		  modal: true,
		  title: 'Edit Nilai/Skor Setiap Unsur',
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>bapeljakat/do_change_nilai/"+id,
					data: $('#form-nilai').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							oTable_bapeljakat_detail.fnDraw();	
									
						}else{
							alert( 'Data tidak dapat disimpan, cek input!' );	
						}						
					}
				});
				
				$( this ).dialog( "close" );	
			  }
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	
	$( "#dialog-nilai" ).dialog( "open" );
	
}

function do_print(bapel_id) {
		
	$( "#dialog-print" ).load("<?php echo base_url(); ?>bapeljakat/do_print/"+bapel_id)
		.dialog({
		  autoOpen: false,
		  height: 600,
		  width: 1000,
		  modal: true,
		  title: 'Baperjakat ',
		  buttons: {				
			"Cetak": function() {
				w=window.open("","", "scrollbars=1,height=600, width=900");
				w.document.write($('#dialog-print').html());
				w.print();
				//w.close();					
				$( this ).dialog( "close" );
			},
			"Close": function() {
				$( this ).dialog( "close" );
			}
		 },
		  
	}); 
	$( "#dialog-print" ).dialog( "open" );
	
	
	return false;
}

	
</script>
<style>
.content-add {
	margin: 5px; 0px 5px 0px;
}

</style>

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
						<li class="active"><a href="#" title="">Baperjakat</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <br />

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
				
				 
                <div class="widget">
					<div class="navbar">
						<div class="navbar-inner">
							<h6>BAHAN PERSIDANGAN USUL PENGISIAN JABATAN - Periode <?php echo $periode_name;?></h6>
						</div>
					</div>	
                    <div class="table-overflow" style="background-color: #FFF; width:100%;padding-left:14px;">
						<input id="id_pb" type="hidden" name="id_pb" value="<?php echo $id_pb;?>" />
						<table cellpadding="3" cellspacing="3">
							<tr>
								<td>Unit Kerja Pengusul</td><td>:</td>
								<td><?php echo $bapeljakat->nama_unit_kerja;?></td>
							</tr>
							<tr>
								<td>Jabatan Yang Akan Diisi</td><td>:</td>
								<td><?php echo $bapeljakat->nama_jabatan; ?></td>
							</tr>
							<tr>
								<td colspan="3">Pejabat Lama</td>
							</tr>
							<tr>
								<td>&nbsp; &nbsp; Nama</td><td>:</td>
								<td><?php echo $bapeljakat->pejabat_lama; ?></td>
							</tr>
							<tr>
								<td>&nbsp; &nbsp; Pangkat/Golongan</td><td>:</td>
								<td><?php echo $bapeljakat->pangkat_lama.' / '.$bapeljakat->golongan_lama; ?></td>
							</tr>
							<tr>
								<td>&nbsp; &nbsp; Keterangan</td><td>:</td>
								<td><?php echo $bapeljakat->keterangan; ?></td>
							</tr>		
						</table>
					</div>
                    <div class="table-overflow">
						<div class="content-add" style="float: left;">
							<input id="calon_pejabat" type="text" name="calon_pejabat" class="input-xlarge" style="width:400px;" value="" />
							<input id="id_bapeljakat" type="hidden" name="id_bapeljakat" value="<?php echo $bapeljakat->id_bapeljakat; ?>"/>
							<input id="calon_nama" name="calon_nama" type="hidden" />
							<input id="calon_nip" name="calon_nip" type="hidden" />
							<input id="calon_golongan" name="calon_golongan" type="hidden" />
							<input id="calon_tmt_golongan" name="calon_tmt_golongan" type="hidden" />
							<input id="calon_pendidikan" name="calon_pendidikan" type="hidden" />
							<input id="calon_diklat" name="calon_diklat" type="hidden" />
							<input id="calon_riwayatjabatan" name="calon_riwayatjabatan" type="hidden" />
							<button id="add-bapeljakat_detail" class="btn btn-primary">Tambah Calon Pejabat</button>
							<div id="validasi_bapeljakat_detail"></div>
						</div>
						<!--<div style="float: right;">
							<a href="<?php //echo base_url().'bapeljakat'; ?>"  class="btn btn-primary">List bapeljakat >></a>
						</div>-->
						<div style="clear: both;"></div>
						<div class="widget-content">									
						<table id="list-bapeljakat_detail" width="100%" class="table table-bordered table-striped with-check">
							<thead>
								<tr class="xcenter">
									<th width="20" rowspan="2">No</th>
									<th class="xcenter" width="150" colspan="4"><div style="text-align:center;">DAFTAR CALON PEJABAT YANG DIUSULKAN</div></th>
									<th class="xcenter" colspan="13"><div style="text-align:center;">NILAI/SKOR SETIAP UNSUR *)</div></th>
									<th rowspan="2">JUMLAH</th>
									<th rowspan="2">PENSIUN<br>TMT</th>
									<th rowspan="2">CATATAN <br>HASIL<br>SIDANG</th>
									<th width="10" rowspan="2">&nbsp;</th>
								</tr>
								<tr class="xcenter">
									<th>NAMA/NIP/TGL.<br>LAHIR/AGAMA</th>
									<th>GOL/TMT</th>
									<th>PENDIDIKAN/<br>DIKLAT</th>
									<th>RIWAYAT JABATAN</th>
									<th class="xcenter">1</th>
									<th class="xcenter">2</th>
									<th class="xcenter">3</th>
									<th class="xcenter">4</th>
									<th class="xcenter">5</th>
									<th class="xcenter">6</th>
									<th class="xcenter">7</th>
									<th class="xcenter">8</th>
									<th class="xcenter">9</th>
									<th class="xcenter">10</th>
									<th class="xcenter">11</th>
									<th class="xcenter">12</th>
									<th class="xcenter">13</th>
									
								</tr>
								<tr>
									<th class="xcenter">A</th>
									<th class="xcenter">B</th>
									<th class="xcenter">C</th>
									<th class="xcenter">D</th>
									<th class="xcenter">E</th>
									<th class="xcenter">F</th>
									<th class="xcenter">G</th>
									<th class="xcenter">H</th>
									<th class="xcenter">I</th>
									<th class="xcenter">J</th>
									<th class="xcenter">K</th>
									<th class="xcenter">L</th>
									<th class="xcenter">M</th>
									<th class="xcenter">N</th>
									<th class="xcenter">O</th>
									<th class="xcenter">P</th>
									<th class="xcenter">Q</th>
									<th class="xcenter">R</th>
									<th class="xcenter">S</th>
									<th class="xcenter">T</th>
									<th class="xcenter">U</th>
									<th class="xcenter"></th>
								</tr>
							</thead>									  
						</table>
						</div>
				
                    </div>
                </div>
                <!-- /media datatable -->

				
				<div class="form-actions">
					 <table width="100%">
						<tr>
							<td style="width:70px;">
								<a href="<?php echo base_url(); ?>bapeljakat/bapeljakat_list/<?php echo $id_pb;?>"  class="btn btn-primary"><< Back</a>
								<button id="print_data" onclick="return do_print(<?php echo $bapeljakat->id_bapeljakat;?>);" class="btn btn-primary">Cetak</button>
								<a href="<?php echo base_url()?>bapeljakat/bapeljakat_rekap/<?php echo $bapeljakat->id_bapeljakat;?>/<?php echo $id_pb;?>"  class="btn btn-primary">Next >></a>
							</td>
							
						</tr>
					 </table>
					
				</div>
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->
			
			
			<!-- /content Popup -->
			<div id="dialog-nilai" title=""> 
				<form id="form-nilai" method="post" action="" >
					<input type="hidden" id="id" name="id" value="" />
						<table>
							<tr>
								<td>Nama Pejabat</td><td>:</td>
								<td><div id="calon_nama_edit"></div></td>
							</tr>
							<tr>
								<td>NIP</td><td>:</td>
								<td><div id="calon_nip_edit"></div></td>
							</tr>
							<tr>
								<td colspan="3">Penilaian Unsur : </td>
							</tr>
							<?php
							$query = $this->db->get("m_unsur_penilaian");
										
							if($query->num_rows() > 0){
								foreach($query->result() as $row){
									?>
									<tr>
										<td><?php echo $row->id_unsur.'  '. $row->nama_unsur;?> </td>
										<td>:</td>
										<td>					
											<select name="nilai_<?php echo $row->id_unsur;?>" id="nilai_<?php echo $row->id_unsur?>" class="input-large">
												<option value=""></option>
												<?php
													$this->db->where('id_unsur', $row->id_unsur);
													$query2 = $this->db->get("m_unsur_klasifikasi");
													
													if($query2->num_rows() > 0){
														foreach($query2->result() as $row2){
															$selected="";
															if($sel_id==$row2->skor){
																$selected='selected="selected"';
															}
															echo "<option value='".$row2->skor."' ".$selected."> ".$row2->nama_klasifikasi."</option>";
														}
													}
												?>
											</select>								
										</td>
									</tr>
								<?php
								}
							}
							?>
							<tr>
								<td>Catatan Hasil Sidang</td><td>:</td>
								<td>
									<textarea id="catatan_hasil" name="catatan_hasil" class="input-large"></textarea>
								</td>
							</tr>
							
						</table>	

				</form>
			</div>

			<div id="dialog-print"></div>
			
		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
	

</body>
</html>