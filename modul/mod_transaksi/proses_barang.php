<?php
include "../../config/koneksi.php";

$q = strtolower($_GET["q"]);
if (!$q) return;
	
	$sql = mysql_query("select nm_barang from barang where nm_barang like '%$q%'");
	
	while($r=mysql_fetch_array($sql)){
		$nama_barang = $r['nm_barang'];
		echo "$nama_barang \n";
	}

?>