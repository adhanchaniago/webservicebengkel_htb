<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input Jasa Service
if ($module=='jasaservice' AND $act=='input'){
	$kd_jasa = $_POST['kd_jasa'];
	$nama_jasa = $_POST['nama_jasa'];
	$harga = $_POST['harga'];
	$diskon = $_POST['diskon'];
	
	mysql_query("insert into jasaservice(kd_jasa,nama_jasa,harga,diskon)
				values('$kd_jasa','$nama_jasa','$harga','$diskon')");
	header('location:../../media.php?module='.$module);
}
// Update Jasa Service
elseif ($module=='jasaservice' AND $act=='update'){
	$kd_jasa = $_POST['kd_jasa'];
	$nama_jasa = $_POST['nama_jasa'];
	$harga = $_POST['harga'];
	$diskon = $_POST['diskon'];
	
	mysql_query("update jasaservice set kd_jasa='$kd_jasa',
										nama_jasa='$nama_jasa',
										harga = '$harga',
										diskon = '$diskon'
						where kd_jasa ='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}
// Hapus Jasa Service
elseif ($module=='jasaservice' AND $act=='hapus'){
	mysql_query("delete from jasaservice where kd_jasa='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
}
?>