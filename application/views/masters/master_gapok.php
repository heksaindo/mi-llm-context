<?php
$error = '';
?>

<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head2'); ?>
<script type="text/javascript"> 

$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback ){
    if ( typeof sNewSource != 'undefined' ){
        oSettings.sAjaxSource = sNewSource;
    }
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
     
    oSettings.fnServerData( oSettings.sAjaxSource, null, function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );
         
        /* Got the data - add it to the table */
        for ( var i=0 ; i<json.aaData.length ; i++ ){
            that.oApi._fnAddData( oSettings, json.aaData[i] );
        }
         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        that.fnDraw( that );
        that.oApi._fnProcessingDisplay( oSettings, false );
         
        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' ){
            fnCallback( oSettings );
        }
    });
}
 
var oTable_gapok;

$(document).ready(function(){
	$( "#dialog-gapok" ).hide();
	$( "#dialog-migrasi_gapok" ).hide();
	
	oTable_gapok = $('table#list-gapok').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>master_gapok/ajax_gapok",
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			$.ajax( {
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			} );
		},
		"fnDrawCallback": function () {
		  $( '.tip' ).tooltip( {
			"delay": 0,
			"track": true,
			"fade": 250
		  } );
		}
	} );
	
});

function onMigrasi_gapok() {
	open_dialog_migrasi('Migrasi Gapok');
}
		
function onEdit_gapok(id_gapok) {
	open_dialog(id_gapok, 'Edit Gapok');
}
function onAdd_gapok(id_gapok) {
	open_dialog('', 'Tambah Gapok');
}

function onDelete_gapok(id_gapok) {
	if(confirm('Delete data ?')){	
		if(!empty(id_gapok)){
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>master_gapok/do_delete_gapok/"+id_gapok,
				data: "id_gapok="+id_gapok, 
				success: function(msg){	
					if(msg == 'success'){		
						//window.location.reload();
						oTable_gapok.fnReloadAjax();	
					}else{
						alert( 'Data tidak dapat dihapus!' );	
					}						
				}
			});
		}
	}
}

function open_dialog(id_gapok, titlex) {

	
	if(!empty(id_gapok)){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_gapok/cek_gapok/"+id_gapok,
			//data: $('#form-gapok').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_golongan" ).val( dt[0] );
				$( "#kdkelgapok" ).val( dt[1] );
				$( "#kdgapok" ).val( dt[2] );
				$( "#gapok" ).val( dt[3] );
				$( "#daper").val( dt[4] );
			}
		});
	}else{
		$( "#nama_golongan" ).val( "" );
		$( "#kdkelgapok" ).val( "" );
		$( "#kdgapok" ).val( "" );
		$( "#gapok" ).val( "" );
		$( "#daper").val("");
	}
	
	$( "#dialog-gapok" ).dialog({
		  autoOpen: false,
		  height: 235,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_gapok/do_popup_gapok/"+id_gapok,
					data: $('#form-gapok').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							//window.location.reload();
							oTable_gapok.fnReloadAjax();		
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
			  oTable_gapok.fnReloadAjax();
			}
		 },
		  
	}); 
	
	$( "#dialog-gapok" ).dialog( "open" );
	
}

function open_dialog_migrasi(titlex) {
	
	$( "#dialog-migrasi_gapok" ).dialog({
		  autoOpen: false,
		  height: 300,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			
			"Batal": function() {
			  $( this ).dialog( "close" );
			  oTable_gapok.fnReloadAjax();
			}
		 },
		  
	}); 
	
	$( "#dialog-migrasi_gapok" ).dialog( "open" );
	
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
		                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>master_data" title="">Administrasi Master Data</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>master_gapok" title="">Master Gapok</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master gapok</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_gapok()"  class="btn btn-primary">Tambah</button>				
				<button onclick="javascript:onMigrasi_gapok()"  class="btn btn-primary">Migrasi Excel</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Gaji Pokok</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-gapok" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Golongan</th>
                                    <th>Kode Golongan</th>
                                    <th>MKG</th>
                                    <th>Gaji Pokok</th>
									<th>Dasar Peraturan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	
	
<!-- /content Popup -->
<div id="dialog-gapok" title=""> 
	<form id="form-gapok" method="post" action="" >
		<table>
			<input type="hidden" name="id_gapok">
			<tr>
				<td>Golongan</td>
				<td>:</td>
				<td>
					<select name="kdkelgapok" id="kdkelgapok" class="input-large">
						<option value=""></option>
						<?php
						foreach($data_golongan as $row){
							echo "<option value='".$row->kdkelgapok."' >".$row->nama_golongan."</option>";
						}
						?>					
					</select>
				</td>
			</tr>
			<tr>
				<td>MKG</td>
				<td>:</td>
				<td>
					<input id="kdgapok" type="text" name="kdgapok" class="input-medium" />
				</td>
			</tr>
			<tr>
				<td>Gaji Pokok</td>
				<td>:</td>
				<td>
					<input id="gapok" type="text" name="gapok" class="input-medium" />
				</td>
			</tr>		
			<tr>
				<td>Dasar Peraturan</td>
				<td>:</td>
				<td>
					<input id="daper" type="text" name="daper" class="input-medium" />
				</td>
			</tr>
		</table>	
	</form>
</div>


<!-- /content Popup -->
<div id="dialog-migrasi_gapok" title=""> 
	
	<h3> Upload Migrasi Excel Gapok </h3>
	<?php 
	echo $error;
	?>
	
	<form method="post" action="<?php echo base_url();?>master_gapok/do_migrasi_gapok" enctype="multipart/form-data" >
	
	<input type="file" name="userfile" size="20" />

	<br />

	<input type="submit" value="upload" />

	</form>
	
	<br/>
	<br/>
	<a href="<?php echo base_url();?>Uploads/excel/template_migrasi_kgb.xls">>>Download Template Excel<a>
	
	
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>