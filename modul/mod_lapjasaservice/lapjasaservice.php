<?php
include ('../../pdf/class.ezpdf.php');
$pdf = new Cezpdf();

$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('../../pdf/fonts/Helvetica.afm');

$all= $pdf->openObject();

$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo-kia.png',20,800,69);

$pdf->addText(211, 820, 14,'<b>LAPORAN JASA SERVICE</b>');
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
$sql = mysql_query("select * from jasaservice order by kd_jasa");
$i=1;
while($r = mysql_fetch_array($sql)){
	$data[$i]=array('<b>No</b>'=>$i,
	                '<b>Kode Jasa</b>'=>$r[kd_jasa],
					'<b>Nama Jasa</b>'=>$r[nama_jasa],
					'<b>Harga Service (Rp)</b>  '=>"Rp ".number_format($r[harga],0,',','.'));
$i++;
}
$pdf->ezTable($data, '', '', '');

$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
?>