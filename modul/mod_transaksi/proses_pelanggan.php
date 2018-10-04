<?php
include "../../config/koneksi.php";

$q = strtolower($_GET["q"]);
if (!$q) return;
	
	$sql = mysql_query("select no_polisi from pelanggan where no_polisi like '%$q%'");
	
	while($r=mysql_fetch_array($sql)){
		$no_polisi = $r['no_polisi'];
		echo "$no_polisi \n";
	}

?>