<?php
$aksi = "modul/mod_jasaservice/aksi_jasaservice.php";

switch($_GET[act]){
	// Tampil Jasa Service
	default:
	echo "<h2>Data Jasa Service</h2>
	<input type=button value='Tambah Jasa Service' onclick=\"window.location.href='?module=jasaservice&act=tambahjasaservice';\">
	<table class='list'>
	<thead>
	<tr>
		<td class='left'>No.</td>
		<td class='left'>Kode Jasa</td>
		<td class='left'>Nama Jasa</td>
		<td class='left'>Harga</td>
		<td class='left'>Disc(%)</td>
		<td class='left'>Edit</td>
		<td class='left'>Hapus</td>
	</tr></thead><tbody>";
	$tampil = mysql_query("select * from jasaservice order by kd_jasa");
	$no=1;
	while($data=mysql_fetch_array($tampil)){
		echo "<tr>
				<td class='left' width='25'>$no</td>
				<td class='left'>$data[kd_jasa]</td>
				<td class='left'>$data[nama_jasa]</td>
				<td class='left'>$data[harga]</td>
				<td class='left'>$data[diskon]</td>
				<td class='left'><a href='?module=jasaservice&act=editjasaservice&id=$data[kd_jasa]'><img src='images/btn_edit.png' width='20' height='20' /></a></td>
				<td class='left'><a href='$aksi?module=jasaservice&act=hapus&id=$data[kd_jasa]'><img src='images/btn_delete.png' width='20' height='20' /></a></td>
			 </tr>";
		$no++;
	}
	echo "</tbody></table>";
	break;
	
	case "tambahjasaservice":
	echo "<h2>Tambah Jasa Service</h2>
	<form method='post' action='$aksi?module=jasaservice&act=input'>
	<table class='list'>
	<tr>
		<td>Kode Jasa</td>
		<td> : <input type='text' name='kd_jasa' size='15' maxlength='15' /></td>
	</tr>
	<tr>
		<td>Nama Jasa</td>
		<td> : <input type='text' name='nama_jasa' size='35' maxlength='100' /></td>
	</tr>
	<tr>
		<td>Harga</td>
		<td> : <input type='text' id='harga' name='harga' size='10' maxlength='10' /><span id='pesan'></span></td>
	</tr>
	<tr>
		<td>Disc(%)</td>
		<td> : <input type='text' id='diskon' name='diskon' size='3' maxlength='3' /><span id='pesan'></span></td>
	</tr>
	<tr>
		<td colspan='2'><input type='submit' value='Simpan' />
		<input type='button' value='Batal' onclick=self.history.back()></td>
	</tr>
	</table>
	</form>";
	break;
	
	case "editjasaservice":
	$edit = mysql_query("select * from jasaservice where kd_jasa='$_GET[id]'");
	$data = mysql_fetch_array($edit);
	echo "<h2>Edit Jasa Service</h2>
	<form method='post' action='$aksi?module=jasaservice&act=update'>
	<input type='hidden' name='id' value='$data[kd_jasa]' />
	<table class='list'>
	<tr>
		<td>Kode Jasa</td>
		<td> : <input type='text' name='kd_jasa' size='15' maxlength='15' value='$data[kd_jasa]' /></td>
	</tr>
	<tr>
		<td>Nama Jasa</td>
		<td> : <input type='text' name='nama_jasa' size='35' maxlength='100' value='$data[nama_jasa]' /></td>
	</tr>
	<tr>
		<td>Harga</td>
		<td> : <input type='text' id='harga' name='harga' size='10' maxlength='10' value='$data[harga]' /><span id='pesan'></span></td>
	</tr>
	<tr>
		<td>Disc(%)</td>
		<td> : <input type='text' id='diskon' name='diskon' size='3' maxlength='3' value='$data[diskon]' /><span id='pesan'></span></td>
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