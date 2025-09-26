<html>
<head>
<title>Upload Migrasi Excel Pegawai</title>
</head>
<body>

<h3> Upload Migrasi Excel Pegawai </h3>
<?php 
echo $error;

?>

<?php echo form_open_multipart('migrasi_pegawai/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>