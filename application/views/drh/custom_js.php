
<script type="text/javascript"> 	
$(document).ready(function(){
	//Initialisasi
	$( "#dialog-rkepangkatan" ).hide();
	$( "#dialog-rpendidikan" ).hide();
	$( "#dialog-rjabatan" ).hide();
	$( "#dialog-rdokumen" ).hide();
	
	$( ".datepicker" ).datepicker({ 
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		yearRange: "-90:+0"
	});
	$( ".fadd_message" ).val('');
	$( ".lbl_nip_lama" ).html( $( "#nip_lama" ).val() );						
	$( ".lbl_nip_baru" ).html( $( "#nip_baru" ).val() );						
	$( ".lbl_nama" ).html( $( "#nama" ).val() );	
	$( "#hd_nip_lama2" ).val( $( "#nip_lama" ).val() );						
	$( "#hd_nip_baru2" ).val( $( "#nip_baru" ).val() );						
	$( "#hd_nama2" ).val( $( "#nama" ).val() );	
	$( "#hd_nip_lama3" ).val( $( "#nip_lama" ).val() );						
	$( "#hd_nip_baru3" ).val( $( "#nip_baru" ).val() );						
	$( "#hd_nama3" ).val( $( "#nama" ).val() );	
	$( "#hd_nip_lama11" ).val( $( "#nip_lama" ).val() );						
	$( "#hd_nip_baru11" ).val( $( "#nip_baru" ).val() );						
	$( "#hd_nama11" ).val( $( "#nama" ).val() );			
	$( "#status_menikah" ).val( $( "#status_perkawinan" ).val() );	
	$( "#nip_baru4" ).val( $( "#nip_baru" ).val() );
	
	//Wizard 1
	$( "#simpan-wizard1" ).click(function(){
		var err = 0;
		var nama = $( "#nama" ).val(); 
		var jenis_kelamin = $( "#jenis_kelamin" ).val(); 
		var nip_baru = $( "#nip_baru" ).val(); 
		var nip_lama = $( "#nip_lama" ).val(); 
		var tempat_lahir = $( "#tempat_lahir" ).val(); 
		var tanggal_lahir = $( "#tanggal_lahir" ).val(); 
		var agama = $( "#agama" ).val(); 
		
		if(nama == ''){
			$( "#nama" ).addClass("invalid");
			err = 1;
		}		
		if(jenis_kelamin == ''){
			$( "#jenis_kelamin" ).addClass("invalid");
			err = 1;
		}
		if(nip_baru == ''){
			$( "#nip_baru" ).addClass("invalid");
			err = 1;
		}
		if(nip_lama == ''){
			$( "#nip_lama" ).addClass("invalid");
			err = 1;
		}
		if(tempat_lahir == ''){
			$( "#tempat_lahir" ).addClass("invalid");
			err = 1;
		}
		if(tanggal_lahir == ''){
			$( "#tanggal_lahir" ).addClass("invalid");
			err = 1;
		}
		if(agama == ''){
			$( "#agama" ).addClass("invalid");
			err = 1;
		}	
		//alert(err);
		if(err == 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/do_edit_wizard1",
				data: $('#form-wizard1').serialize(), 
				success: function(msg){	
					var xdata = explode('#', msg);
					//alert(msg);
					if(xdata[0] == 'success'){					
						$( ".lbl_nip_lama" ).html( xdata[2] );						
						$( ".lbl_nip_baru" ).html( xdata[3] );						
						$( ".lbl_nama" ).html( xdata[4] );						
						$( "#hd_nip_lama2" ).val( xdata[2] );						
						$( "#hd_nip_baru2" ).val( xdata[3] );						
						$( "#hd_nama2" ).val( xdata[4] );						
						$( "#validasi-wizard1" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
																			
					}else{
						$( "#validasi-wizard1" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
					}
					return false;
				}
			});
		}else{
			$( "#validasi-wizard1" ).html( '<font color="red"> Input Salah, Silahkan cek input warna merah!</font>' );	
		}
	});
	
	//Wizard 2
	$( "#simpan-wizard2" ).click(function(){
		var err = 0;
		var tmt_cpns = $( "#tmt_cpns" ).val(); 
		var status_kepegawaian = $( "#status_kepegawaian" ).val(); 
		var jenis_kepegawaian = $( "#jenis_kepegawaian" ).val(); 
		
		if(tmt_cpns == ''){
			$( "#tmt_cpns" ).addClass("invalid");
			err = 1;
		}		
		if(status_kepegawaian == ''){
			$( "#status_kepegawaian" ).addClass("invalid");
			err = 1;
		}
		if(jenis_kepegawaian == ''){
			$( "#jenis_kepegawaian" ).addClass("invalid");
			err = 1;
		}
		//alert(err);
		if(err == 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/do_edit_wizard2",
				data: $('#form-wizard2').serialize(), 
				success: function(msg){	
					var xdata = explode('#', msg);
					//alert(msg);
					if(xdata[0] == 'success'){					
						$( ".lbl_nip_lama" ).html( xdata[2] );						
						$( ".lbl_nip_baru" ).html( xdata[3] );						
						$( ".lbl_nama" ).html( xdata[4] );		
						$( "#hd_nip_lama3" ).val( xdata[2] );						
						$( "#hd_nip_baru3" ).val( xdata[3] );						
						$( "#hd_nama3" ).val( xdata[4] );								
						$( "#validasi-wizard2" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
																			
					}else{
						$( "#validasi-wizard2" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
					}
					return false;
				}
			});
		}else{
			$( "#validasi-wizard2" ).html( '<font color="red"> Input Salah, Silahkan cek input warna merah!</font>' );	
		}
	});
	
	//Wizard 3
	$( "#simpan-wizard3" ).click(function(){
		var err = 0;
		var tanggal_tugas = $( "#tanggal_tugas" ).val(); 
		var instansi = $( "#instansi" ).val(); 
		
		if(tanggal_tugas == ''){
			$( "#tanggal_tugas" ).addClass("invalid");
			err = 1;
		}		
		if(instansi == ''){
			$( "#instansi" ).addClass("invalid");
			err = 1;
		}
		//alert(err);
		if(err == 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/do_edit_wizard3",
				data: $('#form-wizard3').serialize(), 
				success: function(msg){	
					var xdata = explode('#', msg);
					//alert(msg);
					if(xdata[0] == 'success'){					
						$( ".lbl_nip_lama" ).html( xdata[2] );						
						$( ".lbl_nip_baru" ).html( xdata[3] );						
						$( ".lbl_nama" ).html( xdata[4] );		
						$( "#hd_nip_lama4" ).val( xdata[2] );						
						$( "#hd_nip_baru4" ).val( xdata[3] );						
						$( "#hd_nama4" ).val( xdata[4] );								
						$( "#validasi-wizard3" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
																			
					}else{
						$( "#validasi-wizard3" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
					}
					return false;
				}
			});
		}else{
			$( "#validasi-wizard3" ).html( '<font color="red"> Input Salah, Silahkan cek input warna merah!</font>' );	
		}
	});
	
	//Wizard 11
	$( "#simpan-wizard11" ).click(function(){
		var err = 0;
		var tanggal_tugas = $( "#tanggal_tugas" ).val(); 
		var instansi = $( "#instansi" ).val(); 
		
		if(tanggal_tugas == ''){
			$( "#tanggal_tugas" ).addClass("invalid");
			err = 1;
		}		
		if(instansi == ''){
			$( "#instansi" ).addClass("invalid");
			err = 1;
		}
		//alert(err);
		if(err == 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/do_edit_wizard11",
				data: $('#form-wizard11').serialize(), 
				success: function(msg){	
					var xdata = explode('#', msg);
					//alert(msg);
					if(xdata[0] == 'success'){					
						$( ".lbl_nip_lama" ).html( xdata[2] );						
						$( ".lbl_nip_baru" ).html( xdata[3] );						
						$( ".lbl_nama" ).html( xdata[4] );									
						$( "#validasi-wizard11" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
																			
					}else{
						$( "#validasi-wizard11" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
					}
					return false;
				}
			});
		}else{
			$( "#validasi-wizard11" ).html( '<font color="red"> Input Salah, Silahkan cek input warna merah!</font>' );	
		}
	});
	
	//Cek NIP Lama
	$( "#nip_lama" ).blur(function(){
		var nip_lama = $( "#nip_lama" ).val(); 
		var hd_id = $( "#hd_id" ).val(); 
		if(nip_lama){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/check_nip_lama",
				data: "nip_lama="+nip_lama+"&hd_id="+hd_id, 
				success: function(msg){	
					if(msg == 'valid'){
						$( "#cek_nip_lama" ).html( '<font color="blue"> "NIP / NRP Lama" bisa digunakan</font>' );	
						$( "#nip_lama" ).removeClass("invalid");
					}else{
						$( "#cek_nip_lama" ).html( '<font color="red"> "NIP / NRP Lama" sudah digunakan! </font>' );
						$( "#nip_lama" ).addClass("invalid");
					}
					return false;
				}
			});
		}else{
			$( "#cek_nip_lama" ).html( '<font color="red"> "NIP / NRP Lama" Salah, Periksa lagi! </font>' );	
			$( "#nip_lama" ).addClass("invalid");
		}
	});
	//Cek NIP Baru
	$( "#nip_baru" ).blur(function(){
		var nip_baru = $( "#nip_baru" ).val(); 
		var hd_id = $( "#hd_id" ).val(); 
		if(nip_baru){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/check_nip_baru",
				data: "nip_baru="+nip_baru+"&hd_id="+hd_id,
				success: function(msg){	
					if(msg == 'valid'){
						$( "#cek_nip_baru" ).html( '<font color="blue"> "NIP / NRP Baru" bisa digunakan</font>' );	
						$( "#nip_baru" ).removeClass("invalid");
					}else{
						$( "#cek_nip_baru" ).html( '<font color="red"> "NIP / NRP Baru" sudah digunakan! </font>' );	
						$( "#nip_baru" ).addClass("invalid");
					}
					return false;
				}
			});
		}else{
			$( "#cek_nip_baru" ).html( '<font color="red"> "NIP / NRP Baru" Salah, Periksa lagi! </font>' );
			$( "#nip_baru" ).addClass("invalid");
		}
	});
	
	//onChange Province-city
	$( "#s_propinsi" ).change(function() {
		var prov_id = $( "#s_propinsi" ).val();
		var prov_txt = $( "#s_propinsi" ).text();
		$( "#propinsi" ).val(prov_txt);
		if(prov_id){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/change_prov",
				data: "prov_id="+ prov_id + "&kab=kabupaten3", 
				success: function(msg){	
					if(msg){
						$( "#onKabupaten" ).html(msg);
					}
					return false;
				}
			});
		}
	});
	
	//===== Datatables =====//
	oTable_rkepangkatan = $('table#list-rkepangkatan').dataTable({
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
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rkepangkatan",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			
			aoData.push({name: "nip_baru", value: $('#hd_nip_baru').val() });
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rpendidikan = $('table#list-rpendidikan').dataTable({
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
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rpendidikan",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({name: "nip_baru", value: $('#hd_nip_baru').val() });
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rjabatan = $('table#list-rjabatan').dataTable({
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
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rjabatan",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({name: "nip_baru", value: $('#hd_nip_baru').val() });
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	oTable_rdokumen = $('table#list-rdokumen').dataTable({
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
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_rdokumen",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			aoData.push({name: "nip_baru", value: $('#hd_nip_baru').val() });
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	

	//Tambah
	$( "#add-rkepangkatan" ).button().click(function() {
		open_dialog_rkepangkatan('', 'Add Riwayat Kepangkatan');
	});
	$( "#add-rpendidikan" ).button().click(function() {
		open_dialog_rpendidikan('', 'Add Riwayat Pendidikan');
	});
	$( "#add-rjabatan" ).button().click(function() {
		open_dialog_rjabatan('', 'Add Riwayat Jabatan');
	});
	$( "#add-rdokumen" ).button().click(function() {
		open_dialog_rdokumen('', 'Add Dokumen');
	});
	
		
	//onChange Province-city
	$( "#s_propinsi3" ).change(function() {
		var prov_id = $( "#s_propinsi3" ).val();
		var prov_txt = $( "#s_propinsi3" ).text();
		$( "#propinsi3" ).val(prov_txt);
		if(prov_id){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/change_prov",
				data: "prov_id="+ prov_id + "&kab=kabupaten3", 
				success: function(msg){	
					if(msg){
						$( "#onKabupaten3" ).html(msg);
					}
					return false;
				}
			});
		}
	});	
	
});
	
	
function ajaxFileUpload()
{
	var hd_id = $( "#hd_id" ).val(); 
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});

	$.ajaxFileUpload
	(
		{
			url:'<?php echo base_url(); ?>pegawai/upload_foto/',
			secureuri:false,
			fileElementId:'fileFoto',
			dataType : 'JSON',
			data:{id:hd_id},
			success: function (data, status)
			{
				if(status == 'success')
				{
					//alert(data.msg);
					$('img #foto_tumb').attr('src', "<?php echo APP_URL ?>/Uploads/foto/"+data.file);
					setTimeout("location.reload(true);",1000);
					
				}
			},
			error: function (data, status, e)
			{
				alert(e);
			}
		}
	)
	
	return false;

}

//===Riwayat Kepangkatan===	
function onEditRkepangkatan(id) {
	open_dialog_rkepangkatan(id, 'Edit Riwayat Kepangkatan');
}

function onDeleteRkepangkatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rkepangkatan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rkepangkatan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rkepangkatan(id, titlex) {

	$( "#id_rkepangkatan" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rkepangkatan/"+id,
			//data: $('#form-popup1').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#pangkat1" ).val( dt[1] );
				$( "#golongan1" ).val( dt[2] );
				$( "#tmt1" ).val( dt[3] );
				$( "#no_sk1" ).val( dt[4] );
				$( "#tanggal_sk1" ).val( dt[5] );
				$( "#pejabat1" ).val( dt[6] );
			}
		});
	}else{
		$( "#pangkat1" ).val( "" );
		$( "#golongan1" ).val( "" );
		$( "#tmt1" ).val( "" );
		$( "#no_sk1" ).val( "" );
		$( "#tanggal_sk1" ).val( "" );
		$( "#pejabat1" ).val( "" );
	}
	
	$( "#dialog-rkepangkatan" ).dialog({
		  autoOpen: false,
		  height: 330,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_popup_rkepangkatan/"+id,
					data: $('#form-popup1').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							oTable_rkepangkatan.fnDraw();
									
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
	
	$( "#dialog-rkepangkatan" ).dialog( "open" );
	
}
	
//====Riwayat Pendidikan====
function onEditRpendidikan(id) {
	open_dialog_rpendidikan(id, 'Edit Riwayat Pendidikan');
}
	
function onDeleteRpendidikan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rpendidikan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rpendidikan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rpendidikan(id, titlex) {

	$( "#id_rpendidikan" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rpendidikan/"+id,
			//data: $('#form-popup2').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#strata2" ).val( dt[1] );
				$( "#kategori2" ).val( dt[2] );
				$( "#jenis_tenaga2" ).val( dt[3] );
				$( "#program_studi2" ).val( dt[4] );
				$( "#jurusan2" ).val( dt[5] );
				$( "#nama_sekolah2" ).val( dt[6] );
				$( "#tahun_lulus2" ).val( dt[7] );
				$( "#pendidikan_saat_diangkat2" ).val( dt[8] );
				$( "#is_last2" ).val( dt[9] );
			}
		});
	}else{
		$( "#strata2" ).val( "" );
		$( "#kategori2" ).val( "" );
		$( "#jenis_tenaga2" ).val( "" );
		$( "#program_studi2" ).val( "" );
		$( "#jurusan2" ).val( "" );
		$( "#nama_sekolah2" ).val( "" );
		$( "#tahun_lulus2" ).val( "" );
		$( "#pendidikan_saat_diangkat2" ).val( "" );
		$( "#is_last2" ).val( "" );
	}
	
	$( "#dialog-rpendidikan" ).dialog({
		  autoOpen: false,
		  height: 400,
		  width: 440,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_popup_rpendidikan/"+id,
					data: $('#form-popup2').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							oTable_rpendidikan.fnDraw();
									
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
	
	$( "#dialog-rpendidikan" ).dialog( "open" );
}

//====Riwayat Jabatan====
function onEditrjabatan(id) {
	open_dialog_rjabatan(id, 'Edit Riwayat Jabatan');
}
	
function onDeleterjabatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rjabatan/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rjabatan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rjabatan(id, titlex) {
	$( "#id_rjabatan" ).val( id );
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rjabatan/"+id,
			//data: $('#form-popup3').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#jabatan3" ).val( dt[1] );
				$( "#nama_jabatan3" ).val( dt[2] );
				$( "#eselon3" ).val( dt[3] );
				$( "#no_sk3" ).val( dt[4] );
				$( "#tgl_sk3" ).val( dt[5] );
				$( "#tmt_jabatan3" ).val( dt[6] );
				$( "#tgl_masuk_unit3" ).val( dt[7] );
				$( "#instansi_bekerja3" ).val( dt[8] );
				$( "#organisasi_bekerja3" ).val( dt[9] );
				$( "#satuan_kerja3" ).val( dt[10] );
				$( "#satuan_organisasi3" ).val( dt[11] );
				$( "#unit_organisasi3" ).val( dt[12] );
				$( "#unit_kerja3" ).val( dt[13] );
				$( "#unit_kerja_penempatan3" ).val( dt[14] );
				$( "#propinsi3" ).val( dt[15] );
				$( "#kabupaten3" ).val( dt[16] );
				$( "#tipe_jabatan_formasi3" ).val( dt[17] );
				$( "#nama_jabatan_formasi3" ).val( dt[18] );
				$( "#kelas_jabatan3" ).val( dt[19] );
				$( "#keterangan3" ).val( dt[20] );
			}
		});
	}else{
		$( "#jabatan3" ).val( "" );
		$( "#nama_jabatan3" ).val( "" );
		$( "#eselon3" ).val( "" );
		$( "#no_sk3" ).val( "" );
		$( "#tgl_sk3" ).val( "" );
		$( "#tmt_jabatan3" ).val( "" );
		$( "#tgl_masuk_unit3" ).val( "" );
		$( "#instansi_bekerja3" ).val( "" );
		$( "#organisasi_bekerja3" ).val( "" );
		$( "#satuan_kerja3" ).val( "" );
		$( "#satuan_organisasi3" ).val( "" );
		$( "#unit_organisasi3" ).val( "" );
		$( "#unit_kerja3" ).val( "" );
		$( "#unit_kerja_penempatan3" ).val( "" );
		$( "#propinsi3" ).val( "" );
		$( "#kabupaten3" ).val( "" );
		$( "#tipe_jabatan_formasi3" ).val( "" );
		$( "#nama_jabatan_formasi3" ).val( "" );
		$( "#kelas_jabatan3" ).val( "" );
		$( "#keterangan3" ).val( "" );
	}
	
	$( "#dialog-rjabatan" ).dialog({
		  autoOpen: false,
		  height: 500,
		  width: 540,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
				var bValid = true;
				var jabatan3 = $( "#jabatan3" ).val(); 
				var tmt_jabatan3 = $( "#tmt_jabatan3" ).val(); 
				var tgl_masuk_unit3 = $( "#tgl_masuk_unit3" ).val(); 
				
				if(jabatan3 == ''){
					$( "#jabatan3" ).addClass("invalid");
					bValid = false;
				}		
				if(tmt_jabatan3 == ''){
					$( "#tmt_jabatan3" ).addClass("invalid");
					bValid = false;
				}		
				if(tgl_masuk_unit3 == ''){
					$( "#tgl_masuk_unit3" ).addClass("invalid");
					bValid = false;
				}		
					
				if ( bValid ) {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/do_popup_rjabatan/"+id,
						data: $('#form-popup3').serialize(), 
						success: function(msg){	
							if(msg == 'success'){		
								oTable_rjabatan.fnDraw();
										
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
	
	$( "#dialog-rjabatan" ).dialog( "open" );
		
}

//===Dokumen===	
function onEditrdokumen(id) {
	open_dialog_rdokumen(id, 'Edit Dokumen');
}
function onShowrdokumen(id) {
	open_dialog_rdokumen(id, 'Show Dokumen');
}

function onDeleterdokumen(id, name, file) {
	if(confirm('Delete data '+ name +' ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_rdokumen/"+id,
			data: "id="+id+"&filex="+file, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_rdokumen.fnDraw();
				}else{
					alert( 'Data '+ name +' tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog_rdokumen(id, titlex) {

	$( "#id_rdokumen" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rdokumen/"+id,
			//data: $('#form-popup4').serialize(), 
			success: function(data){	
				var dt2 = explode('|', data);
				$( "#tipe_dokumen4" ).val( dt2[1] );
				$( "#nama_dokumen4" ).val( dt2[2] );
				$( "#filename4" ).val( '' );
				$( "#filename4_txt" ).html( dt2[3] );
				
			}
		});
	}else{
		$( "#nama_dokumen4" ).val( "" );
		$( "#filename4" ).val( "" );
		$( "#filename4_txt" ).html( "" );
		$( "#tipe_dokumen4" ).val( "" );
	}
	
	$( "#dialog-rdokumen" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				var nama_dokumen4 = $( "#nama_dokumen4" ).val(); 
				var tipe_dokumen4 = $( "#tipe_dokumen4" ).val(); 
				//var filename4 = $( "#filename4" ).val(); 
				
				if(nama_dokumen4 == ''){
					$( "#nama_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
				if(tipe_dokumen4 == ''){
					$( "#tipe_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
				//if(filename4 == ''){
				//	$( "#filename4" ).addClass("invalid");
				//	bValid = false;
				//}		
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_popup_rdokumen/"+id,
					data: $('#form-popup4').serialize(), 
					success: function(msg){	
						datax = explode('#', msg);
						if(datax[0] == 'success'){		
							oTable_rdokumen.fnDraw();
							ajaxDocumentUpload(datax[1]);		
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
	
	$( "#dialog-rdokumen" ).dialog( "open" );
}

function ajaxDocumentUpload(id)
{
	var hd_id = $( "#hd_id" ).val(); 
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});
	
	$.ajaxFileUpload
	(
		{
			url:'<?php echo base_url(); ?>pegawai/do_popup_rdokumen/'+id,
			secureuri:false,
			fileElementId:'filename4',
			dataType : 'JSON',
			data:{id:hd_id},
			success: function (data, status)
			{
				
				if(status == 'success')
				{
					{
						alert(data.msg);
					}
				}
			},
			error: function (data, status, e)
			{
				alert(e);
			}
		}
	)
	
	return false;
}

</script>