<?php
include "../../config/koneksi.php";
$nama = $_GET['nama'];
$sql = mysql_query("select * from barang where nm_barang='$nama'");
$r=mysql_fetch_array($sql);
echo "$r[kd_barang]";
?>