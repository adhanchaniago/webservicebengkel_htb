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

// Input Barang
if ($module=='barang' AND $act=='input'){
	$kd_barang = $_POST['kd_barang'];
	$nm_barang = $_POST['nm_barang'];
	$harga_beli = $_POST['harga_beli'];
	$harga_jual = $_POST['harga_jual'];
	$diskon = $_POST['diskon'];
	$stok = $_POST['stok'];
	
	mysql_query("insert into barang(kd_barang,
									nm_barang,
									harga_beli,
									harga_jual,
									diskon,
									stok)
							values('$kd_barang',
									'$nm_barang',
									'$harga_beli',
									'$harga_jual',
									'$diskon',
									'$stok')");
	header('location:../../media.php?module='.$module);
}
// Update Barang
elseif ($module=='barang' AND $act=='update'){
	$kd_barang = $_POST['kd_barang'];
	$nm_barang = $_POST['nm_barang'];
	$harga_beli = $_POST['harga_beli'];
	$harga_jual = $_POST['harga_jual'];
	$diskon = $_POST['diskon'];
	$stok = $_POST['stok'];
	
	mysql_query("update barang set kd_barang='$kd_barang',
										nm_barang='$nm_barang',
										harga_beli='$harga_beli',
										harga_jual='$harga_jual',
										diskon ='$diskon',
										stok = '$stok'
						where kd_barang ='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}
// Hapus Barang
elseif ($module=='barang' AND $act=='hapus'){
	mysql_query("delete from barang where kd_barang='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
}
?>