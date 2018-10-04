<?php
include ('../../pdf/class.ezpdf.php');
$pdf = new Cezpdf();

$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('../../pdf/fonts/Helvetica.afm');

$all= $pdf->openObject();

$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo-kia.png',20,800,69);

$pdf->addText(200, 820, 14,'<b>LAPORAN DAFTAR BARANG</b>');
$pdf->addText(213, 800, 14,'<b>PT. KIA MOBIL DINAMIKA</b>');

$pdf->line(10, 780, 578, 780);

// Garis bawah untuk footer
$pdf->line(10, 50, 578, 50);
// Teks kiri bawah
$pdf->addText(30,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s'));

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

include "../../config/koneksi.php";
$sql = mysql_query("select * from barang order by kd_barang");
$i=1;
while($r = mysql_fetch_array($sql)){
	$data[$i]=array('<b>No</b>'=>$i,
	                '<b>Kode Barang</b>'=>$r[kd_barang],
					'<b>Nama Barang</b>'=>$r[nm_barang],
					'<b>Harga Beli (Rp)</b>'=>number_format($r[harga_beli],0,',','.'),
					'<b>Harga Jual (Rp)</b>'=>number_format($r[harga_jual],0,',','.'),
					'<b>Disc (%)</b>'=>$r[diskon],
					'<b>Stok</b>'=>$r[stok]);
$i++;
}
$pdf->ezTable($data, '', '', '');

$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
?>