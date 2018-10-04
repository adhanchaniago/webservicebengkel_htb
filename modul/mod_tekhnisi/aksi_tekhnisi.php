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
if ($module=='tekhnisi' AND $act=='input'){
	$kd_tekhnisi = $_POST['kd_tekhnisi'];
	$nm_tekhnisi = $_POST['nm_tekhnisi'];
	
	mysql_query("insert into tekhnisi(kd_tekhnisi,nm_tekhnisi)
				values('$kd_tekhnisi','$nm_tekhnisi')");
	header('location:../../media.php?module='.$module);
}
// Update Jasa Service
elseif ($module=='tekhnisi' AND $act=='update'){
	$kd_tekhnisi = $_POST['kd_tekhnisi'];
	$nm_tekhnisi = $_POST['nm_tekhnisi'];
	
	mysql_query("update tekhnisi set kd_tekhnisi='$kd_tekhnisi',
										nm_tekhnisi='$nm_tekhnisi'
						where kd_tekhnisi ='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}
// Hapus Jasa Service
elseif ($module=='tekhnisi' AND $act=='hapus'){
	mysql_query("delete from tekhnisi where kd_tekhnisi='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
}
?>