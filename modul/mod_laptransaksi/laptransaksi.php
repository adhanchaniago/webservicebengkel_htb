<?php
session_start();
		
echo "<h2>Laporan</h2>
    <form method=POST action='?module=laptransaksi'>
		<table class='list'>
        <tr><td colspan=2><strong>Laporan Per Periode</strong></td></tr>
        <tr><td>Dari Tanggal</td><td> : ";        
        combotgl(1,31,'tgl_mulai',$tgl_skrg);
        combonamabln(1,12,'bln_mulai',$bln_sekarang);
        combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang);

echo "</td></tr>
		<tr><td>s/d Tanggal</td><td> : ";
        combotgl(1,31,'tgl_selesai',$tgl_skrg);
        combonamabln(1,12,'bln_selesai',$bln_sekarang);
        combothn(2000,$thn_sekarang,'thn_selesai',$thn_sekarang);

echo "</td></tr>
        <tr><td colspan=2><input name='btnProses' type=submit value=Proses></td></tr>
        </table>
        </form>";

if($_GET) {
	if($_POST) {
		if(isset($_POST['btnProses'])){
			$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
			$selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];
			$sql = mysql_query("select * from transaksi where transaksi.tanggal BETWEEN '$mulai' AND '$selesai' order by no_invoice desc");
			echo "<h2>Data Service dan Penjualan Sparepart</h2>
				<table class='list'>
				<thead>
				<tr>
					<td class='left'>No.</td>
					<td class='left'>No Invoice</td>
					<td class='left'>Tanggal Transaksi</td>
					<td class='left'>No. Polisi (Pelanggan)</td>
					<td class='left'>Petugas</td>
					<td class='left'>View</td>
				</tr>
				</thead>";
			
			$no=1;
			while($r=mysql_fetch_array($sql)){
				$tgltransaksi = IndonesiaTgl($r['tanggal']);
				echo "<tbody>
				<tr>
					<td class='left' width='25'>$no</td>
					<td class='left'>$r[no_invoice]</td>
					<td class='left'>$tgltransaksi</td>
					<td class='left'>$r[no_polisi]</td>
					<td class='left'>$r[userid]</td>
					<td class='left'><a href='modul/mod_laptransaksi/laporanperinvoice.php?no_nota=$r[no_invoice]' target='_blank'><img src='images/btn_view.png' width='20' height='20' border='0' /></a></td>
				</tr>
				</tbody>";
			$no++;
			}
			echo "</table>";
			
		}
	}
}
?>
