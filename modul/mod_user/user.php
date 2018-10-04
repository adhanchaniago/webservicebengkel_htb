<?php
if(!isset($_SESSION)) {session_start();}
$aksi = "modul/mod_user/aksi_user.php";
switch($_GET['act']){
  // Tampil User
  default:
  if ($_SESSION['leveluser']=='admin'){
  	$tampil = mysql_query("SELECT * FROM user ORDER BY userid");
    echo "<h2>Data User</h2>
    <input type=button value='Tambah User' onclick=\"window.location.href='?module=user&act=tambahuser';\">";
  }
  else{
  	$tampil=mysql_query("SELECT * FROM user 
    WHERE userid='$_SESSION[namauser]'");
    echo "<h2>Data User</h2>";
  }
echo "<table class='list'>
	<thead>
	<tr>
		<td class='left'>No.</td><td class='left'>Nama Lengkap</td><td class='left'>User ID</td><td class='left'>Level</td><td class='left'>Edit</td>";
		if ($_SESSION['leveluser']=='admin'){
		echo "<td class='left'>Hapus</td>";
		}
		echo "</tr></thead><tbody>";
	$no=1;
	while($data=mysql_fetch_array($tampil)){
	echo "<tr><td class='left' width='25'>$no</td>
			<td class='left'>$data[nama]</td>
			<td class='left'>$data[userid]</td>
			<td class='left'>$data[level]</td>
			<td class='left'><a href='?module=user&act=edituser&id=$data[userid]'><img src='images/btn_edit.png' width='20' height='20' /></a></td>";
			if ($_SESSION['leveluser']=='admin'){
			echo "<td class='left'><a href='$aksi?module=user&act=hapus&id=$data[userid]'><img src='images/btn_delete.png' width='20' height='20' /></a></td>";
			}
		echo "</tr>";
	$no++;
	}
	echo "</tbody></table>";
	break;
	
	case "tambahuser":
    if ($_SESSION['leveluser']=='admin'){
    echo "<h2>Tambah User</h2>
	<form method ='POST' action='$aksi?module=user&act=input'>
	<table class='list'>
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
    }
    else{
      echo "Anda tidak berhak mengakses halaman ini.";
    }
    break;

case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE userid='$_GET[id]'");
    $data=mysql_fetch_array($edit);

	echo "<h2>Edit User</h2>
	<form method='post' action='$aksi?module=user&act=update'>
	<input type='hidden' name='id' value='$data[userid]' />
	<table class='list'>
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
	</tr>";
	if ($_SESSION['leveluser']=='admin'){
	echo "<tr>
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
	</tr>";
	}
	else {
		echo "<tr>
		<td>Level</td>
		<td> : <select name='level'>
			<option value='kasir'>Kasir</option>			
		</select></td>
	</tr>";
	}
	echo "<tr>
		<td colspan='2'><input type='submit' name='submit' value='Update' />
		<input type='button' value='Batal' onclick=self.history.back() />
		</td>
	</tr>
	</table>
	</form>";
    break;  
}
?>