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

// Input Pelanggan
if ($module=='pelanggan' AND $act=='input'){
	$no_polisi = $_POST['no_polisi'];
	$nm_pelanggan = $_POST['nm_pelanggan'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$telp = $_POST['telp'];
	$tipe_kendaraan = $_POST['tipe_kendaraan'];
	$no_rangka = $_POST['no_rangka'];
	$no_mesin = $_POST['no_mesin'];
	
	mysql_query("insert into pelanggan(no_polisi,nm_pelanggan,alamat,kota,telp,tipe_kendaraan,no_rangka,no_mesin)
				values('$no_polisi','$nm_pelanggan','$alamat','$kota','$telp','$tipe_kendaraan','$no_rangka','$no_mesin')");
	header('location:../../media.php?module='.$module);
}
// Update Jasa Service
elseif ($module=='pelanggan' AND $act=='update'){
	$no_polisi = $_POST['no_polisi'];
	$nm_pelanggan = $_POST['nm_pelanggan'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$telp = $_POST['telp'];
	$tipe_kendaraan = $_POST['tipe_kendaraan'];
	$no_rangka = $_POST['no_rangka'];
	$no_mesin = $_POST['no_mesin'];
	
	mysql_query("update pelanggan set no_polisi='$no_polisi',
										nm_pelanggan='$nm_pelanggan',
										alamat='$alamat',
										kota='$kota',
										telp='$telp',
										tipe_kendaraan='$tipe_kendaraan',
										no_rangka='$no_rangka',
										no_mesin='$no_mesin'
						where no_polisi ='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}
// Hapus Jasa Service
elseif ($module=='pelanggan' AND $act=='hapus'){
	mysql_query("delete from pelanggan where no_polisi='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
}
?>