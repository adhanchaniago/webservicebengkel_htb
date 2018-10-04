<?php
include "../../config/koneksi.php";
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
header('location:tampil_user.php');
?>