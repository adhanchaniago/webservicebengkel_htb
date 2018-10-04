<?php
echo "<h2>Tambah User</h2>
<form method ='POST' action='input_user.php'>
<table>
<tr>
	<td>User ID</td>
	<td> : <input type='text' name='userid' size='20' maxlength='20' /></td>
</tr>
<tr>
	<td>Password</td>
	<td> : <input type='password' name='password' size='35' maxlength='50' /></td>
</tr>
<tr>
	<td>Nama Lengkap</td>
	<td> : <input type='text' name='nama' size='40' maxlength='100' /></td>
</tr>
<tr>
	<td>Level</td>
	<td> : <select name='level'>
		<option value='admin' selected>Admin</option>
		<option value='kasir'>Kasir</option>
		</select>
	</td>
</tr>
<tr>
	<td colspan='2'><input type='submit' name='submit' value='Simpan' />
	<input type='button' value='Batal' onclick=self.history.back() />
	</td>
</tr>
</table>
</form>";