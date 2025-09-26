<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>

<script type="text/javascript"> 
 $(function() {
	
	//===== Datatables =====//
	oTable_bapeljakat = $('table#list-bapeljakat').dataTable({
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
		"sAjaxSource": "<?php echo base_url(); ?>bapeljakat/ajax_rekap_bapeljakat",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({name: "id_pb", value: $('#id_pb').val() });
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
});
	

function do_print(id_pb) {
		
	$( "#dialog-print" ).load("<?php echo base_url(); ?>bapeljakat/do_print_rekap/"+id_pb)
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
				w.close();					
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
						<li><a href="<?php echo base_url(); ?>bapeljakat" title="">Baperjakat</a></li>					 
						<li class="active"><a href="<?php echo base_url(); ?>bapeljakat/bapeljakat_rekap" title="">Rekap Baperjakat</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Baperjakat</h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				<br />
			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
				
				<div class="widget">
					<div class="navbar">
						<div class="navbar-inner">
							<h6>DAFTAR LAMPIRAN USULAN PEJABAT STRUKTURAL ESELON III DAN IV - Periode <?php echo $periode_name;?><br/>
							DI LINGKUNGAN DEPARTEMEN KESEHATAN</h6>
						</div>
					</div>	
                    
                    <div class="table-overflow">
						<input id="id_pb" type="hidden" name="id_pb" value="<?php echo $id_pb;?>" />
						<input id="id_bapeljakat" type="hidden" name="id_bapeljakat" value="<?php echo $id_bapeljakat;?>" />
						<div class="widget-content">									
						<table id="list-bapeljakat" width="100%" class="table table-bordered table-striped with-check">
							<thead>
								<tr>
									<th width="10" rowspan="2">No</th>
									<th width="150" rowspan="2">JABATAN YANG AKAN DIISI</th>
									<th width="10" rowspan="2">ES</th>
									<th colspan="4"><div style="text-align:center;">CALON YANG DIUSULKAN</div></th>
									<th width="50" rowspan="2">KETERANGAN</th>
								</tr>
								<tr>
									<th>NAMA/NIP/TTL LAHIR</th>
									<th>GOL<br />TMT</th>
									<th>PENDIDIKAN/<br />DIKLAT</th>
									<th>JABATAN TERAKHIR</th>
								</tr>
								<!--<tr>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
									<td>8</td>
								</tr>-->
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
								<a href="<?php echo base_url(); ?>bapeljakat/bapeljakat_detail/<?php echo $id_pb;?>/<?php echo $id_bapeljakat;?>"  class="btn btn-primary"><< Back</a>
								<button id="print_data" onclick="return do_print(<?php echo $id_pb;?>);" class="btn btn-primary">Cetak</button>
							</td>
							
						</tr>
					 </table>
					
				</div>
				
				<br />	  
		    </div>
		    <!-- /content wrapper -->
			
			<div id="dialog-print"></div>
			
		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>