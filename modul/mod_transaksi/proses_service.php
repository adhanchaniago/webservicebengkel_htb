<?php
include "../../config/koneksi.php";

$q = strtolower($_GET["q"]);
if (!$q) return;
	$sql = mysql_query("select nama_jasa from jasaservice where nama_jasa like '%$q%'");
	
	while($r=mysql_fetch_array($sql)){
		$nama_service = $r['nama_jasa'];
		echo "$nama_service \n";
	}
?>