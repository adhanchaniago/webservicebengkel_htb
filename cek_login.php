<?php
include "config/koneksi.php";
$pass = md5($_POST['password']);
$login=mysql_query("SELECT * FROM user WHERE userid='$_POST[username]' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION['namauser']     = $r['userid'];
  $_SESSION['namalengkap']  = $r['nama'];
  $_SESSION['passuser']     = $r['password'];
  $_SESSION['leveluser']    = $r['level'];
  header('location:media.php?module=home');
}
else{
  include "error-login.php";
}
?>
