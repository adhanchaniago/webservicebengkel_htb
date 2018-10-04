<?php
include "../../config/koneksi.php";
$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];

$sql = mysql_query("select * from transaksi where (tanggal BETWEEN '$mulai' AND '$selesai')");
while($r = mysql_fetch_array($sql)){
	echo "Data Transaksi :<br />
	$r[no_invoice],$r[tanggal]";
}
?>