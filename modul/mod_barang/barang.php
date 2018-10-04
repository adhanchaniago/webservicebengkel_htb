<?php
$aksi = "modul/mod_barang/aksi_barang.php";

switch($_GET[act]){
	// Tampil Barang
	default:
	echo "<h2>Data Barang</h2>
	<input type=button value='Tambah Barang' onclick=\"window.location.href='?module=barang&act=tambahbarang';\">
	<table class='list'>
	<thead>
	<tr>
		<td class='left'>No.</td>
		<td class='left'>Kd. Barang</td>
		<td class='left'>Nama Barang</td>
		<td class='left'>Beli (Rp)</td>
		<td class='left'>Jual (Rp)</td>
		<td class='left'>Disc (%)</td>
		<td class='left'>Stok</td>
		<td class='left'>Edit</td>
		<td class='left'>Hapus</td>
	</tr></thead><tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	
	$tampil = mysql_query("select * from barang order by kd_barang LIMIT $posisi,$batas");
	$no = $posisi+1;
	while($data=mysql_fetch_array($tampil)){
		echo "<tr>
				<td class='left' width='25'>$no</td>
				<td class='left'>$data[kd_barang]</td>
				<td class='left'>$data[nm_barang]</td>
				<td class='left'>$data[harga_beli]</td>
				<td class='left'>$data[harga_jual]</td>
				<td class='left'>$data[diskon]</td>
				<td class='left'>$data[stok]</td>
				<td class='left'><a href='?module=barang&act=editbarang&id=$data[kd_barang]'><img src='images/btn_edit.png' width='20' height='20' /></a></td>
				<td class='left'><a href='$aksi?module=barang&act=hapus&id=$data[kd_barang]'><img src='images/btn_delete.png' width='20' height='20' /></a></td>
			 </tr>";
		$no++;
	}
	echo "</tbody></table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM barang"));
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

	echo "<div class=\"pagination\"> $linkHalaman</div>";

	break;
	
	case "tambahbarang":
	echo "<h2>Tambah Barang</h2>
	<form method='post' action='$aksi?module=barang&act=input'>
	<table class='list'>
	<tr>
		<td>Kode Barang</td>
		<td> : <input type='text' name='kd_barang' size='15' maxlength='15' /></td>
	</tr>
	<tr>
		<td>Nama Barang</td>
		<td> : <input type='text' name='nm_barang' size='35' maxlength='100' /></td>
	</tr>
	<tr>
		<td>Harga Beli</td>
		<td> : <input type='text' id='harga_beli' name='harga_beli' size='10' maxlength='10' /><span id='pesan1'></span></td>
	</tr>
	<tr>
		<td>Harga Jual</td>
		<td> : <input type='text' id='harga_jual' name='harga_jual' size='10' maxlength='10' /><span id='pesan2'></span></td>
	</tr>
	<tr>
		<td>Diskon (%)</td>
		<td> : <input type='text' id='diskon' name='diskon' size='3' maxlength='3' /> % &nbsp;<span id='pesan3'></span></td>
	</tr>
	<tr>
		<td>Stok</td>
		<td> : <input type='text' id='stok' name='stok' size='3' maxlength='3' /><span id='pesan4'></span></td>
	</tr>
	<tr>
		<td colspan='2'><input type='submit' value='Simpan' />
		<input type='button' value='Batal' onclick=self.history.back()></td>
	</tr>
	</table>
	</form>";
	break;
	
	case "editbarang":
	$edit = mysql_query("select * from barang where kd_barang='$_GET[id]'");
	$data = mysql_fetch_array($edit);
	echo "<h2>Edit Barang</h2>
	<form method='post' action='$aksi?module=barang&act=update'>
	<input type='hidden' name='id' value='$data[kd_barang]' />
	<table class='list'>
	<tr>
		<td>Kode Barang</td>
		<td> : <input type='text' value='$data[kd_barang]' name='kd_barang' size='15' maxlength='15' /></td>
	</tr>
	<tr>
		<td>Nama Barang</td>
		<td> : <input type='text' value='$data[nm_barang]' name='nm_barang' size='35' maxlength='100' /></td>
	</tr>
	<tr>
		<td>Harga Beli</td>
		<td> : <input type='text' id='harga_beli' value='$data[harga_beli]' name='harga_beli' size='10' maxlength='10' /><span id='pesan1'></td>
	</tr>
	<tr>
		<td>Harga Jual</td>
		<td> : <input type='text' id='harga_jual' value='$data[harga_jual]' name='harga_jual' size='10' maxlength='10' /><span id='pesan2'></td>
	</tr>
	<tr>
		<td>Diskon (%)</td>
		<td> : <input type='text' id='diskon' value='$data[diskon]' name='diskon' size='3' maxlength='3' /> % &nbsp;<span id='pesan3'></td>
	</tr>
	<tr>
		<td>Stok</td>
		<td> : <input type='text' id='stok' value='$data[stok]' name='stok' size='3' maxlength='3' /><span id='pesan4'></td>
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