<?php
session_start();
echo "<link href='../../css/stylelap.css' rel='stylesheet' type='text/css'>";
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/library2.php";
include "../../config/fungsi_indotgl.php";

echo "<h2>KUITANSI ASLI - PT. KIA MOBIL DINAMIKA</h2>
<table class='list'>";

$sql4 = mysql_query("select transaksi.*, tekhnisi.nm_tekhnisi, pelanggan.* from transaksi,pelanggan,tekhnisi where pelanggan.no_polisi=transaksi.no_polisi AND tekhnisi.kd_tekhnisi=transaksi.kd_tekhnisi AND no_invoice ='$_GET[no_nota]'");
$r4 = mysql_fetch_array($sql4);

$tanggal = IndonesiaTgl($r4['tanggal']);
$no_invoice = $r4['no_invoice'];
$tekhnisi = $r4['nm_tekhnisi'];
$no_polisi = $r4['no_polisi'];
$nama = $r4['nm_pelanggan'];
$alamat = $r4['alamat'];
$telpon = $r4['telp'];
$no_rangka = $r4['no_rangka'];
$no_mesin = $r4['no_mesin'];
$tipe_kendaraan = $r4['tipe_kendaraan'];
	
echo "
		<tr>
			<td class='left' width='100' colspan='2'>Tanggal : $tanggal
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Technician : $tekhnisi</td></tr>
		<tr><td class='left' colspan='2'>No. Invoice : $no_invoice</td></tr>
		<tr><td class='left' colspan='2'>No. Polisi : $no_polisi</td></tr>
		<tr>
			<td class='left'>Nama : $nama
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			No. Rangka : $no_rangka</td>
		</tr>
		<tr>
			<td class='left'>Alamat : $alamat
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;
			No. Mesin : $no_mesin</td>
		</tr>
		<tr>
			<td class='left'>Telepon : $telpon
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Tipe Kendaraan : $tipe_kendaraan</td>
		</tr>
		<tr><td><br></td></tr>
		<tr><td colspan='2'>";
echo "<table class='list'>
<thead>
<tr>
	<td class='left' width='25'>No.</td>
	<td class='left'>Kode</td>
	<td class='left'>Keterangan</td>
	<td class='left'>Harga(Rp)</td>
	<td class='left'>Disc(%)</td>
	<td class='left'>Harga Disc</td>
	<td class='left'>QTY</td>
	<td class='left'>Subtotal</td>
</tr>
</thead>
<tr><td colspan='8' class='left'><strong>SERVICE:</strong></td></tr>";
$sql5 = mysql_query("select * from transaksi_item where no_invoice='$_GET[no_nota]' AND jenis_transaksi='Service'");
$no=1;
while($r5=mysql_fetch_array($sql5)){
	$kodes = $r5['kode'];
	$namab = $r5['nama'];
	$harga = $r5['harga'];
	$diskonb = $r5['diskon'];
	$jt = $r5['jenis_transaksi'];
	$jumlahb = $r5['jumlah'];
	$harga_rp = format_rupiah($r5['harga']);
	$harga_jdisc = ($harga - (($r5['diskon']/100)*$harga));
	$harga_jdisc_rp = format_rupiah($harga_jdisc);
	$subtotal = $r5['jumlah'] * $harga_jdisc;
	$total = $total + $subtotal;
	$jumlahbrg = $jumlahbrg + $r5['jumlah'];
	$subtotal_rp = format_rupiah($subtotal);
	$total_rp = format_rupiah($total);
	echo "<tr><td class='left'>$no</td>
		<td class='left'>$kodes</td>
		<td class='left'>$namab</td>
		<td class='left'>$harga_rp</td>
		<td class='left'>$diskonb</td>
		<td class='left'>$harga_jdisc_rp</td>
		<td class='left'>$jumlahb</td>
		<td class='left'>$subtotal_rp</td>
	</tr>";
	$no++;
}
echo "<tr><td colspan='8' class='left'><strong>SPAREPART:</strong></td></tr>";
$sql6 = mysql_query("select * from transaksi_item where no_invoice='$_GET[no_nota]' AND jenis_transaksi='Sparepart'");
$no2=1;
while($r6=mysql_fetch_array($sql6)){
	$kodes2 = $r6['kode'];
	$namab2 = $r6['nama'];
	$harga2 = $r6['harga'];
	$diskonb2 = $r6['diskon'];
	$jt2 = $r6['jenis_transaksi'];
	$jumlahb2 = $r6['jumlah'];
	$harga_rp2 = format_rupiah($r6['harga']);
	$harga_jdisc2 = ($harga2 - (($r6['diskon']/100)*$harga2));
	$harga_jdisc_rp2 = format_rupiah($harga_jdisc2);
	$subtotal2 = $r6['jumlah'] * $harga_jdisc2;
	$total2 = $total2 + $subtotal2;
	$jumlahbrg2 = $jumlahbrg2 + $r6['jumlah'];
	$subtotal_rp2 = format_rupiah($subtotal2);
	$total_rp2 = format_rupiah($total2);
	echo "<tr><td class='left'>$no2</td>
		<td class='left'>$kodes2</td>
		<td class='left'>$namab2</td>
		<td class='left'>$harga_rp2</td>
		<td class='left'>$diskonb2</td>
		<td class='left'>$harga_jdisc_rp2</td>
		<td class='left'>$jumlahb2</td>
		<td class='left'>$subtotal_rp2</td>
	</tr>";
	$no2++;
}
$bayar = $total + $total2;
$bayar_rp = format_rupiah($bayar);
echo "</table></td></tr>
<tr>
	<td class='left'>Harga sudah termasuk PPN 10%</td><td class='right'>Total Service : $total_rp</td>
</tr>
<tr>
<td class='left'>&nbsp;</td><td class='right'>Total Sparepart : $total_rp2</td>
</tr>
<tr>
<td class='left'>&nbsp;</td><td class='right'>Total Bayar : $bayar_rp</td>
</tr>
<tr>
<td class='left'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Advisor Servis</strong>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Kasir</strong>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Pelanggan</strong></td>
</tr>
<tr>
<td><br><br><br></td>
</tr>
<tr>
<td align='left'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
</tr>
</tbody>
</table>";
?>
<script>window.print();</script>