<?php
include "../../config/koneksi.php";

$nama = $_GET['nama'];
$sql = mysql_query("select * from jasaservice where nama_jasa='$nama'");
$r=mysql_fetch_array($sql);
echo "$r[diskon]";
?>