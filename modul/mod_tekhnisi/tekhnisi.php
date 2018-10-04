<?php
$aksi = "modul/mod_tekhnisi/aksi_tekhnisi.php";

switch($_GET[act]){
	// Tampil Tekhnisi
	default:
	echo "<h2>Data Tekhnisi</h2>
	<input type=button value='Tambah Tekhnisi' onclick=\"window.location.href='?module=tekhnisi&act=tambahtekhnisi';\">
	<table class='list'>
	<thead>
	<tr>
		<td class='left'>No.</td>
		<td class='left'>Kode Tekhnisi</td>
		<td class='left'>Nama Tekhnisi</td>
		<td class='left'>Edit</td>
		<td class='left'>Hapus</td>
	</tr></thead><tbody>";
	$tampil = mysql_query("select * from tekhnisi order by kd_tekhnisi");
	$no=1;
	while($data=mysql_fetch_array($tampil)){
		echo "<tr>
				<td class='left' width='25'>$no</td>
				<td class='left'>$data[kd_tekhnisi]</td>
				<td class='left'>$data[nm_tekhnisi]</td>
				<td class='left'><a href='?module=tekhnisi&act=edittekhnisi&id=$data[kd_tekhnisi]'><img src='images/btn_edit.png' width='20' height='20' /></a></td>
				<td class='left'><a href='$aksi?module=tekhnisi&act=hapus&id=$data[kd_tekhnisi]'><img src='images/btn_delete.png' width='20' height='20' /></a></td>
			 </tr>";
		$no++;
	}
	echo "</tbody></table>";
	break;
	
	case "tambahtekhnisi":
	echo "<h2>Tambah Tekhnisi</h2>
	<form method='post' action='$aksi?module=tekhnisi&act=input'>
	<table class='list'>
	<tr>
		<td>Kode Tekhnisi</td>
		<td> : <input type='text' name='kd_tekhnisi' size='10' maxlength='10' /></td>
	</tr>
	<tr>
		<td>Nama Tekhnisi</td>
		<td> : <input type='text' name='nm_tekhnisi' size='35' maxlength='100' /></td>
	</tr>
	<tr>
		<td colspan='2'><input type='submit' value='Simpan' />
		<input type='button' value='Batal' onclick=self.history.back()></td>
	</tr>
	</table>
	</form>";
	break;
	
	case "edittekhnisi":
	$edit = mysql_query("select * from tekhnisi where kd_tekhnisi='$_GET[id]'");
	$data = mysql_fetch_array($edit);
	echo "<h2>Edit Tekhnisi</h2>
	<form method='post' action='$aksi?module=tekhnisi&act=update'>
	<input type='hidden' name='id' value='$data[kd_tekhnisi]' />
	<table class='list'>
	<tr>
		<td>Kode Tekhnisi</td>
		<td> : <input type='text' name='kd_tekhnisi' size='10' maxlength='10' value='$data[kd_tekhnisi]' /></td>
	</tr>
	<tr>
		<td>Nama Tekhnisi</td>
		<td> : <input type='text' name='nm_tekhnisi' size='35' maxlength='100' value='$data[nm_tekhnisi]' /></td>
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