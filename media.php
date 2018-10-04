<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
echo "<link href='css/style.css' rel='stylesheet' type='text/css'>
<center>Untuk mengakses modul, Anda harus login <br>";
echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>
<html>
<head>
<title>KIA - Cars Services Official Website</title>
<link rel="shortcut icon" href="images/logo-kia.png">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="js/dhtmlgoodies_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css" media="screen" />
<script type="text/javascript" src="js/dhtmlgoodies_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script> 
<script src="js/jquery.autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#no_polisi").autocomplete("modul/mod_transaksi/proses_pelanggan.php",{
width: 100,
max:10
});
function tampil() {
$("#nama").val('');
$("#kode").val('');
nama.focus();
var jenis_transaksi = $("#jenis_transaksi").val();
if (jenis_transaksi=="Sparepart"){
$("#nama").autocomplete("modul/mod_transaksi/proses_barang.php",{
width: 180,
max:10
});
}
else {
$("#nama").autocomplete("modul/mod_transaksi/proses_service.php",{
width: 180,
max:10
});
}
return true;
}
$("#jenis_transaksi").change(function(){
tampil();
});
$("#nama").keyup(function(){
var nama = $("#nama").val();
var jenis_transaksi = $("#jenis_transaksi").val();
if (jenis_transaksi=="Sparepart"){
$.ajax({
url: "modul/mod_transaksi/proses_caribrg.php",
data: "nama=" + nama,
success: function(data){
$("#kode").val(data);
}
});
}
else {
$.ajax({
url: "modul/mod_transaksi/proses_cariservice.php",
data: "nama=" + nama,
success: function(data){
$("#kode").val(data);
$("#jumlah").val('1');
}
});
}
});
$("#nama").keyup(function(){
var nama = $("#nama").val();
var jenis_transaksi = $("#jenis_transaksi").val();
if (jenis_transaksi=="Sparepart"){
$.ajax({
url: "modul/mod_transaksi/proses_cariharga.php",
data: "nama=" + nama,
success: function(data){
$("#harga_jual").val(data);
}
});
}
else {
$.ajax({
url: "modul/mod_transaksi/proses_carihargaservice.php",
data: "nama=" + nama,
success: function(data){
$("#harga_jual").val(data);
}
});
}
});
$("#nama").keyup(function(){
var nama = $("#nama").val();
var jenis_transaksi = $("#jenis_transaksi").val();
if (jenis_transaksi=="Sparepart"){
$.ajax({
url: "modul/mod_transaksi/proses_caridiskon.php",
data: "nama=" + nama,
success: function(data){
$("#diskonb").val(data);
}
});
}
else {
$.ajax({
url: "modul/mod_transaksi/proses_caridiskonservice.php",
data: "nama=" + nama,
success: function(data){
$("#diskonb").val(data);
}
});
}
});
$("#harga").keypress(function(data)
{
if(data.which!=8 && data.which!=0 &&
(data.which<48 || data.which>57))
{
$("#pesan").html("&nbsp;Isikan Angka").show().fadeOut("slow");
return false;
}
});
$("#harga_beli").keypress(function(data)
{
if(data.which!=8 && data.which!=0 &&
(data.which<48 || data.which>57))
{
$("#pesan1").html("&nbsp;Isikan Angka").show().fadeOut("slow");
return false;
}
});
$("#harga_jual").keypress(function(data)
{
if(data.which!=8 && data.which!=0 &&
(data.which<48 || data.which>57))
{
$("#pesan2").html("&nbsp;Isikan Angka").show().fadeOut("slow");
return false;
}
});
$("#diskon").keypress(function(data)
{
if(data.which!=8 && data.which!=0 &&
(data.which<48 || data.which>57))
{
$("#pesan3").html("&nbsp;Isikan Angka").show().fadeOut("slow");
return false;
}
});
$("#stok").keypress(function(data)
{
if(data.which!=8 && data.which!=0 &&
(data.which<48 || data.which>57))
{
$("#pesan4").html("&nbsp;Isikan Angka").show().fadeOut("slow");
return false;
}
});
$("#diskonb").keypress(function(data)
{
if(data.which!=8 && data.which!=0 &&
(data.which<48 || data.which>57))
{
$("#pesan4").html("&nbsp;Isikan Angka").show().fadeOut("slow");
return false;
}
});
$("#jumlah").keypress(function(data)
{
if(data.which!=8 && data.which!=0 &&
(data.which<48 || data.which>57 || data.which='-'))
{
return false;
}
});
});
</script>
<style type="text/css">
<!--
.style1 {font-family: Tahoma}
-->
</style>
</head>
<body>
<div id="header">
<div id="menu">
<div class="left">
<?php // include "menu.php"; ?>
<ul>
<li><a href="media.php?module=home">Home</a></li>
<li><a href="media.php?module=user">Data User</a></li>
<li><a href="#">Data Master</a>
<ul>
<li><a href="media.php?module=barang">Data Barang</a></li>
<li><a href="media.php?module=pelanggan">Data Pelanggan</a></li>
<li><a href="media.php?module=tekhnisi">Data Tekhnisi</a></li>
<li><a href="media.php?module=jasaservice">Data Service</a></li>
</ul>
</li>
<li><a href="#">Data Transaksi</a>
<ul>
<li><a href="media.php?module=transaksi">Jasa Service & Sparepart</a></li>
</ul>
</li>
<li><a href="#">Laporan Data</a>
<ul>
<li><a href="modul/mod_lapbarang/lapbarang.php">Daftar Barang</a></li>
<li><a href="modul/mod_lappelanggan/lappelanggan.php">Daftar Pelangan</a></li>
<li><a href="modul/mod_laptekhnisi/laptekhnisi.php">Daftar Tekhnisi</a></li>
<li><a href="modul/mod_lapjasaservice/lapjasaservice.php">Daftar Jasa Service</a></li>
<li><a href="media.php?module=laptransaksi">Service & Sparepart</a></li>
</ul>
</li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
</div>
</div>
<div id="wrap">
<div id="content">
<?php include "content.php"; ?>
</div>
<div class="style1" id="footer">
<div align="center" class="style1">Copyright &copy; 2018 Developed by Suci - STMIK Nusa Mandiri</div>
</div>
</div>
</body>
</html>
<?php
}
?>