<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            
			 oTable_ibel = $('table#table-ibel').dataTable({
			   "sPaginationType": "full_numbers",
			   "sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
			   "oLanguage": {
				   "sSearch": "<span>Filter records:</span> _INPUT_",
				   "sLengthMenu": "<span>Show entries:</span> _MENU_",
				   "oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
			   },
			   "iDisplayLength": 10,
			   "sAjaxSource": "<?php echo base_url(); ?>ibel/ajax_ibel_pegawai/<?php echo $group;?>",
			   "fnServerData": function ( sSource, aoData, fnCallback ) { 
					   //alert($('#table-src_tahun').val());
					   //aoData.push({name: "bulan", value: $('#table-src_bulan').val() });
					   //aoData.push({name: "tahun", value: $('#table-src_tahun').val() });
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
		   });
			 
            onTambah = function(id){
                window.location = '<?php echo base_url()."ibel/mpegawai/";?>'+id;
            };
			
			onEdit = function(group,id){
				window.location = '<?php echo base_url()."ibel/mpegawai/";?>'+group+'/'+id;
			};
			
			onDelete = function(group,id){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>ibel/del_detail_ibel", 
					data: {"id":id,"group":group}, 
					success: function(data){
						if(data == 'success'){
							oTable_ibel.fnDraw();
						}else{
							$( "#validasi-list" ).html( '<font color="red"> Data tidak dapat dihapus!</font>' );
						}
					}
				});
			};
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
		                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
						<li><a href="<?php echo base_url(); ?>pendidikan" title="">Pendidikan</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>ibel" title="">Izin Belajar</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Data ibel</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Daftar Pegawai Izin Belajar, Surat Pengantar No: <?php echo $sp;?></h6>
							<div style="float: right;">
                                <a href="<?php echo base_url().'ibel'; ?>" class="btn btn-primary" title="List"><< Back</a>
								<span onclick="javascript:onTambah('<?php echo $group;?>')" style="cursor: pointer;"  class="btn btn-primary">Tambah</span>
							</div>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="table-ibel" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th width="20">No</th>
                                    <th width="200">Nama</th>
                                    <th width="100">Nip</th>
                                    <th width="100">Pangkat / Gol</th>
                                    <th width="100">Pendidikan Terakhir</th>
                                    <th width="100">Jenis Pendidikan / Jurusan Yang Dituju</th>
                                    <th width="100">Instansi Pendidikan Yang Dituju</th>
                                    <th width="50">Tahun Akademik</th>
                                    <th width="100">Unit Kerja</th>
                                    <th width="50">Status</th>
									<th width="50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							
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