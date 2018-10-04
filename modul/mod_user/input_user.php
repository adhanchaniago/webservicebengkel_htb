<?php
include "../../config/koneksi.php";
$userid = $_POST['userid'];
$pass = md5($_POST['password']);
$nama = $_POST['nama'];
$level = $_POST['level'];

mysql_query("insert into user(userid,password,nama,level)
			values('$userid','$pass','$nama','$level')");
header('location:tampil_user.php');
?>