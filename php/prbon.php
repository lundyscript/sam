<?php
//koneksi ke database
include "koneksi.php"; 
//include "head.php";

#ambil data di tabel dan masukkan ke array
$arrayidj = array();
$query = mysql_query("SELECT *FROM bon")or die("Error!!".mysql_error());
while ($row = mysql_fetch_array ($query)) {
  extract($row);
  array_push($arrayidj, $idj);
}
$dari   = $_GET['d'];
$sampai = $_GET['s'];
$dayList = array(
  'Sunday' => 'Minggu',
  'Monday' => 'Senin',
  'Tuesday' => 'Selasa',
  'Wednesday' => 'Rabu',
  'Thursday' => 'Kamis',
  'Friday' => 'Jumat',
  'Saturday' => 'Sabtu'
);
$hari1   = date("l",strtotime($dari));
$hari2   = date("l",strtotime($sampai));
$arr     = explode('-', $dari);
$txttgl1 = $arr[2].'/'.$arr[1].'/'.$arr[0];
$arr     = explode('-', $sampai);
$txttgl2 = $arr[2].'/'.$arr[1].'/'.$arr[0];

#sertakan library FPDF dan bentuk objek
require_once ("../fpdf181/fpdf.php");
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetTopMargin(20);
 
#setting judul laporan dan header tabel
$judul1 = "PENGAJUAN KAS BON MOYAMU";
$judul2 = $dayList[$hari1].", ".$txttgl1." -- ".$dayList[$hari2].", ".$txttgl2;
$header = array(
  array("label"=>"TGL ORDER", "length"=>30, "align"=>"C"),
  array("label"=>"NAMA PELANGGAN", "length"=>45, "align"=>"C"),
  array("label"=>"JENIS BARANG", "length"=>35, "align"=>"C"),
  array("label"=>"JUMLAH", "length"=>20, "align"=>"C"),
  array("label"=>"HARGA (Rp)", "length"=>30, "align"=>"C"),
  array("label"=>"TOTAL (Rp)", "length"=>30, "align"=>"C"),
);

$data = array();
$arraytotal = array();
for ($i=0; $i < count($arrayidj); $i++) { 
  $query = mysql_query("SELECT *FROM penjualan WHERE idj='$arrayidj[$i]'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $tglorder = date('d/m/Y', strtotime($tglorder));
    $pelanggan = mysql_query("SELECT *FROM pelanggan WHERE idp='$idp'")or die("Error!!".mysql_error());
    $dataplg = mysql_fetch_array ($pelanggan);
    $nama = $dataplg['nama'];
    $brg = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $databrg = mysql_fetch_array ($brg);
    $barang = $databrg['tipe'];
    $harga = number_format($harga,0,",",".");
    array_push($arraytotal, $total);
    $total = number_format($total,0,",",".");
    $newdata = array("tglorder"=>"$tglorder","nama"=>"$nama","barang"=>"$barang","jumlah"=>"$jumlah","harga"=>"$harga","total"=>"$total");
    array_push($data, $newdata);
  }
  mysql_query("DELETE FROM bon WHERE idj='$arrayidj[$i]'") or die ('Error!!'.mysql_error());
}
$jmltotal = array_sum($arraytotal);
$jmltotal = number_format($jmltotal,0,",",".");

#tampilkan judul laporan
$pdf->SetFont('Helvetica','','16');
$pdf->Cell(0,10, $judul1, '0', 1, 'C');
$pdf->SetFont('Helvetica','','12');
$pdf->Cell(0,10, $judul2, '0', 1, 'C');
$pdf->Ln(4);

#buat header tabel
$pdf->SetFont('Helvetica','','11');
$pdf->SetFillColor(180,180,180);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header as $kolom) {
  $pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();

#tampilkan data tabelnya
$pdf->SetFillColor(227,227,227);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data as $baris) {
  $i = 0;
  foreach ($baris as $cell) {
    $pdf->Cell($header[$i]['length'], 8, $cell, 1, '0', $kolom['align'], $fill);
    $i++;
  }
  $fill = !$fill;
  $pdf->Ln();
}
$pdf->Cell(160,8, "TOTAL (Rp)",  1, '0', 'R', $fill);
$pdf->Cell(30,8, $jmltotal,  1, '0', 'C', $fill);

#output file PDF
$pdf->Output();
?>