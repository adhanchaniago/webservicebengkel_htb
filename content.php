<?php
include "config/koneksi.php";
include "config/library.php";
include "config/library2.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";
// Bagian Home
if ($_GET['module']=='home'){
if ($_SESSION['leveluser']=='admin'){
$jam=date("H:i:s");
$tgl=tgl_indo(date("Y m d")); 	
  echo "<br /><p align=center>Hai <b>$_SESSION[namalengkap]</b>!<br>
          Silakan Anda klik menu pilihan yang berada di bagian header untuk mengelola Modul Aplikasi.</p><br />";
  echo "<table class='list'><thead>
		<td class='center' colspan=5><center>Control Panel</center></td></thead>
		<tr>
		  <td width=120 align=center><a href=media.php?module=user><img src=images/user.jpg border=none><br /><b>Data User</b></a></td>
		  <td width=120 align=center><a href=media.php?module=barang><img src=images/barang.png border=none><br /><b>Data Barang/Sparepart</b></a></td>
		  <td width=120 align=center><a href=media.php?module=pelanggan><img src=images/pelanggan.png border=none><br /><b>Data Pelanggan</b></a></td>
		  <td width=120 align=center><a href=media.php?module=tekhnisi><img src=images/teknisi.png border=none><br /><b>Data Tekhnisi</b></a></td>
		  <td width=120 align=center><a href=media.php?module=jasaservice><img src=images/service.png border=none><br /><b>Data Service</b></a></td>
    </tr>
		<tr>
		  <td width=120 align=center><a href=media.php?module=transaksi><img src=images/sservice.png border=none><br /><b>Transaksi<br />(Jasa Service & Penjualan Sparepart)</b></a></td>
		  <td width=120 align=center><a href='modul/mod_lapbarang/lapbarang.php'><img src=images/lapbarang.png border=none><br /><b>Daftar Barang</b></a></td>
		  <td width=120 align=center><a href='modul/mod_lappelanggan/lappelanggan.php'><img src=images/lappelanggan.png border=none><br /><b>Daftar Pelanggan</b></a></td>
		  <td width=120 align=center><a href=modul/mod_lapjasaservice/lapjasaservice.php><img src=images/lapservice.png border=none><br /><b>Daftar Jasa Service</b></a></td>
		  <td width=120 align=center><a href=media.php?module=laptransaksi><img src=images/lapjasaservice.png border=none><br /><b>Laporan Transaksi<br />Jasa Service & Penj. Sparepart</b></a></td>
    </tr>
    </table>
	<div align='right'><b>$hari_ini, $tgl, $jam </b>WIB</div>
	<br>";
  }
  elseif ($_SESSION['leveluser']=='kasir'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>!<br> 
          Silakan Anda klik menu pilihan yang berada di bagian header untuk mengelola Module Aplikasi. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
 	}
}
// Bagian User
elseif ($_GET['module']=='user'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='kasir'){
    include "modul/mod_user/user.php";
  }
}
// Bagian Jasa Service
elseif ($_GET['module']=='jasaservice'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_jasaservice/jasaservice.php";
  }
}
// Bagian Tekhnisi
elseif ($_GET['module']=='tekhnisi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_tekhnisi/tekhnisi.php";
  }
}
// Bagian Pelanggan
elseif ($_GET['module']=='pelanggan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pelanggan/pelanggan.php";                            
  }
}
// Bagian Barang
elseif ($_GET['module']=='barang'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_barang/barang.php";
  }
}
// Bagian Transaksi
elseif ($_GET['module']=='transaksi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='kasir'){
    include "modul/mod_transaksi/transaksi.php";
  }
}
// Bagian Transaksi
elseif ($_GET['module']=='laptransaksi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='kasir'){
    include "modul/mod_laptransaksi/laptransaksi.php";
  }
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>