<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<link href='css/style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else {
	include "../../config/koneksi.php";

	$module=$_GET['module'];
	$act=$_GET['act'];
	
	if ($module=='transaksi' AND $act=='tambah'){
		$sid=session_id();
		$kode = $_POST['kode'];
		$harga = $_POST['harga_jual'];
		$jumlah = $_POST['jumlah'];
		
		$sql2 = mysql_query("select stok from barang where kd_barang='$kode'");
		$r = mysql_fetch_array($sql2);
		$stok = $r['stok'];
		if($stok==0) {
			echo "Stok Habis";
		}
		else {
			$sql = mysql_query("select kode from tmp_transaksi where kode='$kode' AND id_session='$sid'");
			$ketemu = mysql_num_rows($sql);
			if($ketemu==0){
				mysql_query("insert into tmp_transaksi(kode,harga,jumlah,id_session)
								values('$kode','$harga','$jumlah','$sid')");
			}
			header('location:../../media.php?module='.$module);
		}
	}
	elseif ($module=='transaksi' AND $act=='hapus'){
		mysql_query("DELETE FROM tmp_transaksi WHERE id='$_GET[id]'"); 
		header('location:../../media.php?module='.$module);
	}
	
}
?>