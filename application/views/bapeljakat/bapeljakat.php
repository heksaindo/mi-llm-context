<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
	
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
		"sAjaxSource": "<?php echo base_url(); ?>bapeljakat/ajax_list_bapeljakat",
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
	
	
function onDeleteBapeljakat(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>bapeljakat/do_delete_bapeljakat",
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_bapeljakat.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
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
						<li class="active"><a href="<?php echo base_url(); ?>bapeljakat/bapeljakat_list/<?php echo $id_pb;?>" title="">List Baperjakat</a></li>					 
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
				
				<a href="<?php echo base_url(); ?>bapeljakat/bapeljakat_add/<?php echo $id_pb;?>" class="btn btn-primary">Add Baperjakat</a>
                <div class="widget">
					<div class="navbar">
						<div class="navbar-inner">
							<h6>BAHAN PERSIDANGAN USUL PENGISIAN JABATAN - Periode <?php echo $periode_name;?></h6>
						</div>
					</div>	
                    
                    <div class="table-overflow">
						<input id="id_pb" type="hidden" name="id_pb" value="<?php echo $id_pb;?>" />
						<div class="widget-content">									
						<table id="list-bapeljakat" width="100%" class="table table-bordered table-striped with-check">
							<thead>
								<tr>
									<th width="50" rowspan="2">No</th>
									<th width="150" rowspan="2">Unit Kerja Pengusul</th>
									<th width="150" rowspan="2">Usulan Jabatan</th>
									<th colspan="4"><div style="text-align:center;">Pejabat Lama</div></th>
									<th width="50" rowspan="2">Action</th>
								</tr>
								<tr>
									<th>Nama</th>
									<th>Nip</th>
									<th>pangkat</th>
									<th>Gol</th>
								</tr>
							</thead>									  
						</table>
						</div>
				
                    </div>
                </div>
                <!-- /media datatable -->

				
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