<?php
include ('../../pdf/class.ezpdf.php');
$pdf = new Cezpdf();

$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('../../pdf/fonts/Helvetica.afm');

$all= $pdf->openObject();

$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo-kia.png',20,800,69);

$pdf->addText(187, 820, 14,'<b>LAPORAN DAFTAR PELANGGAN</b>');
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
$sql = mysql_query("select * from pelanggan order by nm_pelanggan");
$i=1;
while($r = mysql_fetch_array($sql)){
	$data[$i]=array('<b>No</b>'=>$i,
	                '<b>No Polisi</b>'=>$r[no_polisi],
					'<b>Nama Pelanggan</b>'=>$r[nm_pelanggan],
					'<b>Kota</b>'=>$r[kota],
					'<b>Telpon</b>'=>$r[telp],
					'<b>Type Kendaraan</b>'=>$r[tipe_kendaraan],
					'<b>No. Mesin</b>'=>$r[no_mesin]);
$i++;
}
$pdf->ezTable($data, '', '', '');

$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
?>