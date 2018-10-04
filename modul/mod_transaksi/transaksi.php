<?php
session_start();
$aksi = "modul/mod_transaksi/aksi.php";
$sid = session_id();
if($_GET) {
	
	if(isset($_GET['act'])){
		if(trim($_GET['act'])=="hapus"){
			mysql_query("DELETE FROM tmp_transaksi WHERE id='$_GET[id]' AND id_session='$sid'"); 
		}
	}
	
	if($_POST) {
		
		
		if(isset($_POST['btnTambah'])){
			if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
			echo "<link href='css/style.css' rel='stylesheet' type='text/css'>
			<center>Untuk mengakses modul, Anda harus login <br>";
			echo "<a href=index.php><b>LOGIN</b></a></center>";
		}
		else {
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$harga = $_POST['harga_jual'];
			$jumlah = $_POST['jumlah'];
			$diskonb = $_POST['diskonb'];
			$jenis_transaksi = $_POST['jenis_transaksi'];
					
			if ($_POST['jenis_transaksi']=="Sparepart"){
				$sql2 = mysql_query("select stok,diskon from barang where kd_barang='$kode'");
				$r = mysql_fetch_array($sql2);
				$diskon = $r['diskon'];
				$stok = $r['stok'];
				if($stok<=0) {
					echo "Stok Habis";
				}
				else if($jumlah > $stok) {
					echo "Jumlah tidak boleh melebihi Stok";
				}
				else {
					$sql = mysql_query("select kode,jumlah from tmp_transaksi where kode='$kode' AND id_session='$sid'");
					$r2=mysql_fetch_array($sql);
					$ketemu = mysql_num_rows($sql);
					if($ketemu==0){
						mysql_query("insert into tmp_transaksi(kode,nama,harga,diskon,jumlah,jenis_transaksi,id_session)
										values('$kode','$nama','$harga','$diskonb','$jumlah','$jenis_transaksi','$sid')");
					}
					else {
						$jumlah2 = $r2['jumlah']+$jumlah;
						mysql_query("update tmp_transaksi set kode='$kode',
															nama = '$nama',			
															harga = '$harga',
															diskon ='$diskonb',
															jumlah = '$jumlah2',
															jenis_transaksi = '$jenis_transaksi',
															id_session = '$sid'
										where kode='$kode'");
					}
		
				}
			}
			else {
				$sql6 = mysql_query("select * from jasaservice where kd_jasa='$kode'");
				$r6=mysql_fetch_array($sql6);
				$diskont=$r6['diskon'];
				$sql5 = mysql_query("select kode from tmp_transaksi where kode='$kode' AND id_session='$sid'");
					$ketemu = mysql_num_rows($sql5);
					if($ketemu==0){
						mysql_query("insert into tmp_transaksi(kode,nama,harga,diskon,jumlah,jenis_transaksi,id_session)
										values('$kode','$nama','$harga','$diskonb','$jumlah','$jenis_transaksi','$sid')");
					}
					
				}
			}
		}
		if(isset($_POST['btnSave'])){
			function isittemp() {
				$isitemp = array();
				$sid = session_id();
				
				$sql7 = mysql_query("select * from tmp_transaksi where id_session='$sid'");
				while($r7 = mysql_fetch_array($sql7)){
					$isitemp[] = $r7;
				}
				return $isitemp;
			}
		
			$no_invoice = $_POST['no_invoice'];
			$tanggal = InggrisTgl($_POST['tanggal']);
			$kd_tekhnisi2 = $_POST['kd_tekhnisi'];
			$no_polisi2 = $_POST['no_polisi'];
			$userid = $_SESSION['namauser'];
									
			// Simpan data Transaksi
			mysql_query("insert into transaksi(no_invoice,tanggal,kd_tekhnisi,no_polisi,userid)
										values('$no_invoice','$tanggal','$kd_tekhnisi2','$no_polisi2','$userid')");
					
			$id_transaksi = mysql_insert_id();
			
			$isitemp = isittemp();
			$jml = count($isitemp);
			
			
			for($i=0; $i < $jml; $i++){
				mysql_query("insert into transaksi_item(no_invoice,kode,nama,harga,diskon,jumlah,jenis_transaksi)
								values('$no_invoice','{$isitemp[$i]['kode']}','{$isitemp[$i]['nama']}',{$isitemp[$i]['harga']},{$isitemp[$i]['diskon']},{$isitemp[$i]['jumlah']},'{$isitemp[$i]['jenis_transaksi']}')");
			}
			
			for($i=0; $i < $jml; $i++){
				mysql_query("update barang set stok=stok-{$isitemp[$i]['jumlah']} where kd_barang={$isitemp[$i]['kode']}");
			}
			
			/*for($i=0; $i < $jml; $i++){
				mysql_query("delete from tmp_transaksi where id = {$isitemp[$i]['id']}");
			}*/
			
			for($i=0; $i < $jml; $i++){
				mysql_query("delete from tmp_transaksi where id = {$isitemp[$i]['id']}");
			}
			
			echo "Data Transaksi berhasil disimpan";
			
			/*echo "<meta http-equiv='refresh' content='0; url=modul/mod_laptransaksi/laporanperinvoice.php?no_nota=$no_invoice'>";*/
		}
		
	}
}
 
/*function format_rupiah($angka){
	$rupiah = number_format($angka,0,',','.');
	return $rupiah;
}*/

$nomorTransaksi = buatKode("transaksi", date("ym"));
$tglTransaksi 	= isset($_POST['tanggal']) ? $_POST['tanggal'] : date('d-m-Y');
$tekhnisi = isset($_POST['kd_tekhnisi']) ? $_POST['kd_tekhnisi'] : '';
$nopelanggan = isset($_POST['no_polisi']) ? $_POST['no_polisi'] : '';
$jtransaksi = isset($_POST['jenis_transaksi']) ? $_POST['jenis_transaksi'] : '';


echo "</h2>
<form method='post' action='?module=transaksi' target='_self' >
<table class='list'>
	<tr>
		<td>No. Invoice</td>
		<td> : <input type='text' name='no_invoice' size='10' readonly='readonly' maxlength='10' value='". $nomorTransaksi; echo "' /></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td> : "; echo form_tanggal("tanggal",$tglTransaksi);
		echo "</td>
	</tr>
	<tr>
		<td>Tekhnisi</td>
		<td> : <select name='kd_tekhnisi'>
		<option value=$tekhnisi selected>$tekhnisi</option>";
		$tampil = mysql_query("select * from tekhnisi order by nm_tekhnisi");
		while($r=mysql_fetch_array($tampil)){
			echo "<option value=$r[kd_tekhnisi]>$r[nm_tekhnisi]</option>";
		}
		echo "</select></td>
	</tr>
	<tr>
		<td>No. Polisi (Pelanggan)</td>
		<td> : <input text='no_polisi' id='no_polisi' name='no_polisi' size='12' maxlength='12' value='"; echo $nopelanggan; echo "' /></td>
	</tr>
	<tr>
		<td>Jenis Transaksi</td>
		<td> : <select name='jenis_transaksi' id='jenis_transaksi'>
			<option value='$jtransaksi' selected>$jtransaksi</option>
			<option value='Service'>Service</option>
			<option value='Sparepart'>Sparepart</option>
		</select></td>
	</tr>
	<tr>
		<td>Nama Barang / Jasa Service</td>
		<td> : <input type='text' id='nama' name='nama' size='30' maxlength='100'/>
		KD: <input type='text'  id='kode' name='kode' size='15' maxlength='15' readonly='readonly'/>
		Harga: <input type='text'  id='harga_jual' name='harga_jual' size='10' maxlength='10' readonly='readonly'/>
		Disc(%): <input type='text'  id='diskonb' name='diskonb' size='3' maxlength='3'/>
		QTY: <input type='text'  id='jumlah' name='jumlah' size='3' maxlength='3'/>
		<input name='btnTambah' type='submit' style='cursor:pointer;' value='TAMBAH' /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input name='btnSave' type='submit' style='cursor:pointer;' value=' SIMPAN TRANSAKSI ' /></td>
	</tr>
	<tr>
		<td colspan='2'>
			<table class='list'>
			<thead>
			<tr>
				<td class='left' width='25'>No.</td>
				<td class='left'>Kode</td>
				<td class='left'>Keterangan</td>
				<td class='left'>Harga</td>
				<td class='left'>Disc (%)</td>
				<td class='left'>Harga Disc</td>
				<td class='left'>QTY</td>
				<td class='left'>Subtotal</td>
				<td class='left'>Delete</td>
			</tr>
			</thead>";
			$tmpquery = mysql_query("SELECT * from tmp_transaksi WHERE tmp_transaksi.id_session='$sid'");
			$no=0;
			while($rtemp = mysql_fetch_array($tmpquery)){
				$ID = $rtemp['id'];
				$harga = $rtemp['harga'];
				$kodes = $rtemp['kode'];
				$namab = $rtemp['nama'];
				$diskonb = $rtemp['diskon'];
				$jt = $rtemp['jenis_transaksi'];
				$jumlahb = $rtemp['jumlah'];
				$harga_rp = format_rupiah($rtemp['harga']);
				$harga_jdisc = ($harga - (($rtemp['diskon']/100)*$harga));
				$harga_jdisc_rp = format_rupiah($harga_jdisc);
				$subtotal = $rtemp['jumlah'] * $harga_jdisc;
				$total = $total + $subtotal;
				$jumlahbrg = $jumlahbrg + $rtemp['jumlah'];
				$subtotal_rp = format_rupiah($subtotal);
				$total_rp = format_rupiah($total);
				$no++;
						
				echo "<tr>
				<td class='left' height='25'>"; echo $no; echo "</td>
				<td class='left'>"; echo $kodes; echo "</td>
				<td class='left'>"; echo $namab; echo "</td>
				<td class='left'>"; echo $harga_rp; echo "</td>
				<td class='left'>"; echo $diskonb; echo "</td>
				<td class='left'>"; echo $harga_jdisc_rp; echo "</td>
				<td class='left'>"; echo $jumlahb; echo "</td>
				<td class='left'>"; echo $subtotal_rp; echo "</td>
				<td class='left'><a href='?module=transaksi&act=hapus&id=$ID'><img src='images/hapus.gif' width='16' height='16' border='0' /></a></td>
			</tr>";
			}
			echo "<tr>
				<td colspan='6' align='right'>Grand Total</td>
				<td class='left'>"; echo $jumlahbrg; echo "</td>
				<td class='left'>"; echo $total_rp; echo "</td>
				<td class='left'>&nbsp;</td>
			</tr>
			</table>
			<input type='hidden' 
		</td>
	</tr>
</table>
</form>";
?>