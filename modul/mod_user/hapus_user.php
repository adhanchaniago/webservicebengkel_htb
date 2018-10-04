<?php
include "../../config/koneksi.php";
mysql_query("delete from user where userid='$_GET[id]'");
header('location:tampil_user.php');
?>