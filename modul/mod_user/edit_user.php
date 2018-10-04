<?php
include "../../config/koneksi.php";

$edit = mysql_query("select * from user where userid='$_GET[id]'");
$data = mysql_fetch_array($edit);

echo "<h2>Edit User</h2>
<form method='post' action='update_user.php'>
<input type='hidden' name='id' value='$data[userid]' />
<table>
<tr>
	<td>User ID</td>
	<td> : <input type='text' name='userid' size='20' maxlength='20' value='$data[userid]' /></td>
</tr>
<tr>
	<td>Password</td>
	<td> : <input type='password' name='password' size='35' maxlength='50' /> *)</td>
</tr>
<tr>
	<td>Nama Lengkap</td>
	<td> : <input type='text' name='nama' size='40' maxlength='100' value='$data[nama]' /></td>
</tr>
<tr>
	<td>Level</td>
	<td> : <select name='level'>";
	if ($data['level']=='admin') {
		echo"<option value='admin' selected>Admin</option>
			<option value='kasir'>Kasir</option>";			
	}
	elseif ($data['level']=='kasir') {
	echo"<option value='admin'>Admin</option>
		<option value='kasir' selected>Kasir</option>";
	}
echo "</select></td>
</tr>
<tr>
	<td colspan='2'><input type='submit' name='submit' value='Update' />
	<input type='button' value='Batal' onclick=self.history.back() />
	</td>
</tr>
</table>
</form>";
?>