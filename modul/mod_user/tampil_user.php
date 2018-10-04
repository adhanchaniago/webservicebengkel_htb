<?php
echo "<h2>Data User</h2>
<form method='post' action='form_user.php'>
	<input type='submit' value='Tambah User'>
</form>
<table class='list'>
<thead>
<tr>
	<td class='left'>No.</td><td>Nama Lengkap</td><td>User ID</td><td>Level</td><td>Edit</td><td>Hapus</td></td></thead>";
	include "../../config/koneksi.php";
	$tampil = mysql_query("select * from user order by userid");
	$no=1;
	while($data=mysql_fetch_array($tampil)){
	echo "<tr><td class='left'>$no</td>
			<td>$data[nama]</td>
			<td>$data[userid]</td>
			<td>$data[level]</td>
			<td align='center'><a href='edit_user.php?id=$data[userid]'><img src='images/btn_edit.png' width='20' height='20' /></a></td>
			<td align='center'><a href='hapus_user.php?id=$data[userid]'><img src='images/btn_delete.png' width='20' height='20' /></a></td>
		</tr>";
	$no++;
	}
echo "</table>";
?>