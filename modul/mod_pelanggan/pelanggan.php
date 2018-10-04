<?php
$aksi = "modul/mod_pelanggan/aksi_pelanggan.php";

switch($_GET[act]){
	// Tampil Pelanggan
	default:
	echo "<h2>Data Pelanggan</h2>
	<input type=button value='Tambah Pelanggan' onclick=\"window.location.href='?module=pelanggan&act=tambahpelanggan';\">
	<table class='list'>
	<thead>
	<tr>
		<td class='left'>No.</td>
		<td class='left'>No. Polisi</td>
		<td class='left'>Nama Pelanggan</td>
		<td class='left'>Kota</td>
		<td class='left'>Telpon</td>
		<td class='left'>Edit</td>
		<td class='left'>Hapus</td>
	</tr></thead><tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("select * from pelanggan order by no_polisi limit $posisi,$batas");
	$no=$posisi+1;
	while($data=mysql_fetch_array($tampil)){
		echo "<tr>
				<td class='left' width='25'>$no</td>
				<td class='left'>$data[no_polisi]</td>
				<td class='left'>$data[nm_pelanggan]</td>
				<td class='left'>$data[kota]</td>
				<td class='left'>$data[telp]</td>
				<td class='left'><a href='?module=pelanggan&act=editpelanggan&id=$data[no_polisi]'><img src='images/btn_edit.png' width='20' height='20' /></a></td>
				<td class='left'><a href='$aksi?module=pelanggan&act=hapus&id=$data[no_polisi]'><img src='images/btn_delete.png' width='20' height='20' /></a></td>
			 </tr>";
		$no++;
	}
	echo "</tbody></table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM pelanggan"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

	echo "<div class=\"pagination\"> $linkHalaman</div>";
	break;
	
	case "tambahpelanggan":
	echo "<h2>Tambah Pelanggan</h2>
	<form method='post' action='$aksi?module=pelanggan&act=input'>
	<table class='list'>
	<tr>
		<td>No. Polisi</td>
		<td> : <input type='text' name='no_polisi' size='12' maxlength='12' /></td>
	</tr>
	<tr>
		<td>Nama Pelanggan</td>
		<td> : <input type='text' name='nm_pelanggan' size='35' maxlength='100' /></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td> : <input type='text' name='alamat' size='60' maxlength='200' /></td>
	</tr>
	<tr>
		<td>Kota</td>
		<td> : <input type='text' name='kota' size='35' maxlength='50' /></td>
	</tr>
	<tr>
		<td>Telpon</td>
		<td> : <input type='text' name='telp' size='12' maxlength='12' /></td>
	</tr>
	<tr>
		<td>Tipe Kendaraan</td>
		<td> : <input type='text' name='tipe_kendaraan' size='35' maxlength='35' /></td>
	</tr>
	<tr>
		<td>Nomor Rangka</td>
		<td> : <input type='text' name='no_rangka' size='20' maxlength='20' /></td>
	</tr>
	<tr>
		<td>Nomor Mesin</td>
		<td> : <input type='text' name='no_mesin' size='12' maxlength='12' /></td>
	</tr>
	
	<tr>
		<td colspan='2'><input type='submit' value='Simpan' />
		<input type='button' value='Batal' onclick=self.history.back()></td>
	</tr>
	</table>
	</form>";
	break;
	
	case "editpelanggan":
	$edit = mysql_query("select * from pelanggan where no_polisi='$_GET[id]'");
	$data = mysql_fetch_array($edit);
	echo "<h2>Edit Pelanggan</h2>
	<form method='post' action='$aksi?module=pelanggan&act=update'>
	<input type='hidden' name='id' value='$data[no_polisi]' />
	<table class='list'>
	<tr>
		<td>No. Polisi</td>
		<td> : <input type='text' name='no_polisi' value='$data[no_polisi]' size='12' maxlength='12' /></td>
	</tr>
	<tr>
		<td>Nama Pelanggan</td>
		<td> : <input type='text' name='nm_pelanggan' value='$data[nm_pelanggan]' size='35' maxlength='100' /></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td> : <input type='text' name='alamat' value='$data[alamat]' size='60' maxlength='200' /></td>
	</tr>
	<tr>
		<td>Kota</td>
		<td> : <input type='text' name='kota' value='$data[kota]' size='35' maxlength='50' /></td>
	</tr>
	<tr>
		<td>Telpon</td>
		<td> : <input type='text' name='telp' value='$data[telp]' size='12' maxlength='12' /></td>
	</tr>
	<tr>
		<td>Tipe Kendaraan</td>
		<td> : <input type='text' name='tipe_kendaraan' value='$data[tipe_kendaraan]' size='35' maxlength='35' /></td>
	</tr>
	<tr>
		<td>Nomor Rangka</td>
		<td> : <input type='text' name='no_rangka' value='$data[no_rangka]' size='20' maxlength='20' /></td>
	</tr>
	<tr>
		<td>Nomor Mesin</td>
		<td> : <input type='text' name='no_mesin' value='$data[no_mesin]' size='12' maxlength='12' /></td>
	</tr>
	<tr>
		<td colspan='2'><input type='submit' value='Update' />
		<input type='button' value='Batal' onclick=self.history.back()></td>
	</tr>
	</table>
	</form>";
	break;
}
?>