<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Input user
if ($module=='user' AND $act=='input'){
  	$userid = $_POST['userid'];
	$pass = md5($_POST['password']);
	$nama = $_POST['nama'];
	$level = $_POST['level'];
	
	mysql_query("insert into user(userid,password,nama,level)
				values('$userid','$pass','$nama','$level')");
  	header('location:../../media.php?module='.$module);
}

// Update user
elseif ($module=='user' AND $act=='update'){
  	$userid=$_POST['userid'];
	$nama = $_POST['nama'];
	$pass = md5($_POST['password']);
	$level = $_POST['level'];
	if (empty($_POST['password'])){
		mysql_query("update user set userid='$userid',
									nama='$nama',
									level='$level'
							where userid='$_POST[id]'");
	}
	else {
		mysql_query("update user set userid='$userid',
									password='$pass',
									nama='$nama',
									level='$level'
							where userid='$_POST[id]'");
	}
	 	header('location:../../media.php?module='.$module);
}
	// Hapus User
elseif($module=='user' AND $act=='hapus'){
		mysql_query("delete from user where userid='$_GET[id]'");
		header('location:../../media.php?module='.$module);
}
}
?>
