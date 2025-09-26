<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head_tiny.php'); ?>
    
    <style>
        #list-penunjang th{
            text-align: center;
        }
        #list-penunjang input{
            margin: 0px 25px;
        }
    </style>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#tableTipe").val("edit");
            
            oTable_rdokumen = $('table#list-penunjang').dataTable({
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
				"iDeferLoading": 0,
                "sAjaxSource": "<?php echo base_url(); ?>ibel/ajax_penunjang",
                "fnServerData": function(sSource,aoData,fnCallback,oSettings)
                {
                    aoData.push({name: "id_pegawai", value: $('#id_pegawai').val() });
                    aoData.push({name: "tipe", value: $('#tableTipe').val() });
                    aoData.push({name: "igroup", value: '<?php echo $group;?>' });
                    oSettings.jqXHR = $.ajax({
                        "dataType": 'json', 
                        "type": "POST", 
                        "url": sSource, 
                        "data": aoData, 
                        "success": fnCallback
                    });
                }
                    
            });
            $.ajax({
                 type: "POST",
                 url: "<?php echo base_url(); ?>ibel/detail_ibel", 
                 data: {"id":"<?php echo $id;?>"}, 
                 success: function(data){
                    dt = explode("|",data);
                    $('#nama').val(dt[0]);
                    $('#pendidikan_jenjang').val(dt[11]);
                    $('#jurusan_dituju').val(dt[1]);
                    $('#instansi_dituju').val(dt[2]);
                    $('#th_akademik_from').val(dt[3]);
                    $('#th_akademik_to').val(dt[4]);
                    $('#nip').val(dt[5]);
                    $('#pangkat').val(dt[6]);
                    $('#id_pegawai').val(dt[7]);
                    $('#pendidikan_terkahir').val(dt[10]);
                    $('#unit_kerja').val(dt[8]);
                    $("#kantor").val(dt[9]);
                    oTable_rdokumen.fnDraw();
                 }
            });
           
            $("#nama").autocomplete("<?php echo base_url(); ?>ibel/auto_pegawai/", {
                width: 250,
                minChars:1,
                max:100,
                selectFirst: false
            });
            
            $("#nama").result(function(event, data, formatted) {
                if (data){  
                    $("#nama").val(data[0]);	
                    $("#nip").val(data[1]);	
                    if($("#nip").val() == ''){
                        $("#nama").addClass('invalid');
                    }else{
                        $("#nama").removeClass('invalid');	
                    }
                    $("#pangkat").val(data[2]);	
                    $("#pendidikan_terkahir").val(data[6]);	
                    $("#kantor").val(data[4]);
                    $("#unit_kerja").val(data[3]);
                    $("#id_pegawai").val(data[10]);
                    oTable_rdokumen.fnDraw();
                }
            });
            
            //Simpan data
            $( "#simpan-list" ).click(function(){
                var err = 0;
                
                if(err === 0){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>ibel/insert_list",
                        data: $('#form-wizard').serialize() + '&igroup=<?php echo $group;?>', 
                        success: function(msg){	
                            if(msg == 'success'){			
                                $( "#validasi-list" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
                                window.location.assign("<?php echo base_url().'ibel/listpegawai/'.$group; ?>");											
                            }else{
                                $( "#validasi-list" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
                            }
                            return false;
                        }
                    });
                }else{
                    $( "#validasi-list" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
                }
            });
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
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Edit Pegawai</h6>
                        </div>
                    </div>
                    
                    <form id="form-wizard" class="form-horizontal row-fluid well" method="post" >
                        <div id="form-wizard-1" class="step">
							<div class="step-title">
								<i>1</i>
								<h5>Data Pegawai</h5>
								<span>Data 1</span>
							</div>
							<div class="control-group">
								<label class="control-label">Nama</label>
								<div class="controls">
                                    <input id="id" type="hidden" name="id" class="input-xlarge" value="<?php echo $id;?>" /> 
									<input id="nama" type="text" name="nama" class="input-xlarge" placeholder="Nama Pegawai" value="" />  (Auto Complete)
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">NIP</label>
								<div class="controls">
									<input id="id_pegawai" type="hidden" name="id_pegawai" value="" />
									<input id="nip" type="text" name="nip" class="input-xlarge" placeholder="Nip" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Pangkat/Gol</label>
								<div class="controls">
									<input id="pangkat" type="text" placeholder="Pangkat - Golongan" name="pangkat" class="input-xlarge" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Pendidikan Terakhir</label>
								<div class="controls">
									<input id="pendidikan_terkahir" type="text" name="pendidikan_terkahir" placeholder="Pendidikan Terakhir" class="input-xlarge" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Unit Kerja</label>
								<div class="controls">
									<input id="kantor" type="text" name="kantor" class="input-xlarge" placeholder="Unit" value="" />
									<input id="unit_kerja" type="hidden" name="unit_kerja" value="" />
								</div>
							</div>
						</div>
						
                        <div id="form-wizard-2" class="step">
							<div class="step-title">
								<i>2</i>
								<h5>Data Pendidikan</h5>
								<span>Data 2</span>
							</div>
							<div class="control-group">
								<label class="control-label">Jurusan Yang Dituju</label>
								<div class="controls">
									<input id="pendidikan_jenjang" type="text" name="pendidikan_jenjang" class="input-small" placeholder="Jenjang" value="" /> /
									<input id="jurusan_dituju" type="text" name="jurusan_dituju" placeholder="Jurusan" class="input-xlarge" value="" />
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label">Instansi Pendidikan Yang Dituju</label>
								<div class="controls">
									<input id="instansi_dituju" type="text" name="instansi_dituju" placeholder="Instansi" class="input-xlarge" value="" />
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label">Tahun Akademik</label>
								<div class="controls">
									<input id="th_akademik_from" type="text" name="th_akademik_from" placeholder="Dari" class="input-small" value="" /> /
                                    <input id="th_akademik_to" type="text" name="th_akademik_to" placeholder="Sampai" class="input-small" value="" />
								</div>
							</div>
                        </div>
					
                    
                    <div id="form-wizard-3" class="step">
						<div class="step-title">
							<i>3</i>
							<h5>Persyaratan Penunjang</h5>
							<span>Data 3</span>
						</div>
						<div class="table-overflow">
							<input id="tableTipe" type="hidden" value="" />
							<table id="list-penunjang" class="table table-striped table-bordered table-checks media-table">
								<thead>
									<tr>
										<th width="25" rowspan="2">No</th>
										<th rowspan="2">Uraian Kelengkapan Berkas</th>
										<th width="120" colspan="2">Keterangan</th>
									</tr>
                                    <tr>
                                        <th width="60">Ada</th>
                                        <th width="60">Tidak</th>
                                    </tr>
								</thead>
							</table>
						</div>
					</div>
                    </form>
                    <div class="form-actions">
						<a href="<?php echo base_url().'ibel/listpegawai/'.$group; ?>" class="btn btn-primary" title="List"><< Back</a>
						<button id="simpan-list" class="btn btn-primary">Simpan</button>
						<div id="validasi-list"></div>
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