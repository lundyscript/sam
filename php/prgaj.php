<?php
//koneksi ke database
include "koneksi.php"; 
//include "head.php";

#ambil data di tabel dan masukkan ke array
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
$judul1 = "LAPORAN KEUNTUNGAN MOYAMU";
$judul2 = $dayList[$hari1].", ".$txttgl1." -- ".$dayList[$hari2].", ".$txttgl2;

#tampilkan judul laporan
$pdf->SetFont('Helvetica','','16');
$pdf->Cell(0,10, $judul1, '0', 1, 'C');
$pdf->SetFont('Helvetica','','12');
$pdf->Cell(0,5, $judul2, '0', 1, 'C');
$pdf->Ln(4);

#PENJUALAN
$penjualan = "PENJUALAN KOTOR";
$header1 = array(
  array("label"=>"NAMA BARANG", "length"=>100, "align"=>"C"),
  array("label"=>"JUMLAH", "length"=>30, "align"=>"C"),
  array("label"=>"HARGA (Rp)", "length"=>30, "align"=>"C"),
  array("label"=>"TOTAL (Rp)", "length"=>30, "align"=>"C"),
);
$data1 = array();
$total1 = array();
$query = mysql_query("SELECT idh, tipe, SUM(jumlah) AS jumlah, SUM(total) AS total FROM penjualan WHERE tglorder>='$dari' AND tglorder<='$sampai' GROUP BY idh") or die ('Error!!'.mysql_error());
while ($row = mysql_fetch_array ($query)) {
  extract($row);
  $hrg = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
  $dataharga = mysql_fetch_array ($hrg);
  $harga = $dataharga['harga'];
  array_push($total1, $total);
  $harga = number_format($harga,0,",",".");
  $total = number_format($total,0,",",".");
  $newdata1 = array("tipe"=>"$tipe","jumlah"=>"$jumlah","harga"=>"$harga","total"=>"$total");
  array_push($data1, $newdata1);
}
$jml1 = array_sum($total1);
$jmltotal1 = number_format($jml1,0,",",".");
$pdf->SetFont('Helvetica','B','12');
$pdf->Cell(0,10, $penjualan, '0', 1, 'L');
$pdf->SetFont('Helvetica','','11');
$pdf->SetFillColor(180,180,180);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header1 as $kolom) {
  $pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data1 as $baris) {
  $i = 0;
  foreach ($baris as $cell) {
    $pdf->Cell($header1[$i]['length'], 8, $cell, 1, '0', $kolom['align'], $fill);
    $i++;
  }
  $fill = !$fill;
  $pdf->Ln();
}
$pdf->Cell(160,8, "TOTAL (Rp)",  1, '0', 'R', $fill);
$pdf->Cell(30,8, $jmltotal1,  1, '0', 'C', $fill);
$pdf->Ln();

#BIAYAPRODUKSI
$produksi = "BIAYA PRODUKSI";
$header2 = array(
  array("label"=>"NAMA PENGELUARAN", "length"=>100, "align"=>"C"),
  array("label"=>"JUMLAH", "length"=>30, "align"=>"C"),
  array("label"=>"HARGA (Rp)", "length"=>30, "align"=>"C"),
  array("label"=>"TOTAL (Rp)", "length"=>30, "align"=>"C"),
);
$data2 = array();
$tipe = array("Galon 19l","Dus 240ml","Dus 330ml","Dus 600ml","Botol 330ml","Botol 600ml");
$arr1 = array();
for ($i=0; $i < count($tipe); $i++) { 
  $jual = mysql_query("SELECT SUM(jumlah) AS jumlah FROM penjualan WHERE tipe='$tipe[$i]' AND tglorder>='$dari' AND tglorder<='$sampai'")or die("Error!!".mysql_error());
  $data = mysql_fetch_array ($jual);
  $htng = mysql_query("SELECT *FROM biaya WHERE tipe='$tipe[$i]'")or die("Error!!".mysql_error());
  while ($row = mysql_fetch_array ($htng)) {
    if ($data['jumlah']==0) {
      array_push($arr1, 0);
    }else{
      array_push($arr1, $data['jumlah']);
    }
  }
}
$arr2 = array();
for ($i=0; $i < count($tipe); $i++) { 
  $htng = mysql_query("SELECT harga FROM biaya WHERE tipe='$tipe[$i]'")or die("Error!!".mysql_error());
  while ($row = mysql_fetch_array ($htng)) {
    array_push($arr2, $row['harga']);
  }
}
$arr3 = array();
for ($i=0; $i < count($arr1); $i++) { 
  $arr1[6] = $arr1[5] * 48;
  $arr1[7] = $arr1[5] * 48;
  $arr1[9] = $arr1[8] * 28;
  $arr1[10] = $arr1[8] * 28;
  $arr1[11] = $arr1[8] * 28;
  $arr1[13] = $arr1[12] * 18;
  $arr1[14] = $arr1[12] * 18;
  $arr1[15] = $arr1[12] * 18;
  $kali = $arr1[$i] * $arr2[$i];
  array_push($arr3, $kali);
}
$jml2 = array_sum($arr3);
$total2 = number_format($jml2,0,",",".");
$query = mysql_query("SELECT *FROM biaya")or die("Error!!".mysql_error());
$i = 0;
while ($row = mysql_fetch_array ($query)) {
  extract($row);
  $nama = $tipe." - ".$nama;
  $harga1 = number_format($arr1[$i],0,",",".");
  $harga2 = number_format($harga,0,",",".");
  $total  = number_format($arr3[$i],0,",",".");
  $newdata2 = array("nama"=>"$nama","harga1"=>"$harga1","harga2"=>"$harga2","total"=>"$total");
  array_push($data2, $newdata2);
  $i++;
}
$pdf->SetFont('Helvetica','B','12');
$pdf->Cell(0,10, $produksi, '0', 1, 'L');
$pdf->SetFont('Helvetica','','11');
$pdf->SetFillColor(180,180,180);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header2 as $kolom) {
  $pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data2 as $baris) {
  $i = 0;
  foreach ($baris as $cell) {
    $pdf->Cell($header2[$i]['length'], 8, $cell, 1, '0', $kolom['align'], $fill);
    $i++;
  }
  $fill = !$fill;
  $pdf->Ln();
}
$pdf->Cell(160,8, "TOTAL (Rp)",  1, '0', 'R', $fill);
$pdf->Cell(30,8, $total2,  1, '0', 'C', $fill);
$pdf->Ln();

#BIAYAOPERASIONAL
$operasional = "BIAYA OPERASIONAL";
$header3 = array(
  array("label"=>"TANGGAL NOTA", "length"=>40, "align"=>"C"),
  array("label"=>"NAMA PENGELUARAN", "length"=>60, "align"=>"C"),
  array("label"=>"JUMLAH", "length"=>30, "align"=>"C"),
  array("label"=>"HARGA (Rp)", "length"=>30, "align"=>"C"),
  array("label"=>"TOTAL (Rp)", "length"=>30, "align"=>"C"),
);
$data3 = array();
$total3 = array();
$query = mysql_query("SELECT *FROM operasional WHERE tglnota>='$dari' AND tglnota<='$sampai' ORDER BY tglnota") or die ('Data Tidak Ditemukan!!');
$count = mysql_num_rows($query);
$arraynomer = array();
while ($row = mysql_fetch_array ($query)) {
  array_push($arraynomer, $row['no']);
}
for($i=0; $i<count($arraynomer); $i++){
  $query = mysql_query("SELECT *FROM operasional WHERE no='$arraynomer[$i]'") or die ('Data Tidak Ditemukan!!');
  $row = mysql_fetch_array ($query);
  $no = $i+1;
  $tgl = date('d/m/Y', strtotime($row['tglnota']));
  array_push($total3, $row['total']);
  $nama = $row['nama'];
  $jumlah = $row['jumlah'];
  $harga = number_format($row['harga'],0,",",".");
  $total = number_format($row['total'],0,",",".");
  $newdata3 = array("tanggal"=>"$tgl","nama"=>"$nama","jumlah"=>"$jumlah","harga"=>"$harga","total"=>"$total");
  array_push($data3, $newdata3);
}
$jml3 = array_sum($total3);
$jmltotal3 = number_format($jml3,0,",",".");
$pdf->SetFont('Helvetica','B','12');
$pdf->Cell(0,10, $operasional, '0', 1, 'L');
$pdf->SetFont('Helvetica','','11');
$pdf->SetFillColor(180,180,180);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header3 as $kolom) {
  $pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data3 as $baris) {
  $i = 0;
  foreach ($baris as $cell) {
    $pdf->Cell($header3[$i]['length'], 8, $cell, 1, '0', $kolom['align'], $fill);
    $i++;
  }
  $fill = !$fill;
  $pdf->Ln();
}
$pdf->Cell(160,8, "TOTAL (Rp)",  1, '0', 'R', $fill);
$pdf->Cell(30,8, $jmltotal3,  1, '0', 'C', $fill);
$pdf->Ln();

#KEUNTUNGAN
$keuntungan = "KEUNTUNGAN";
$header4 = array(
  array("label"=>"PENJUALAN KOTOR (Rp)", "length"=>50, "align"=>"C"),
  array("label"=>"BIAYA PRODUKSI (Rp)", "length"=>45, "align"=>"C"),
  array("label"=>"BIAYA OPERASIONAL (Rp)", "length"=>50, "align"=>"C"),
  array("label"=>"KEUNTUNGAN (Rp)", "length"=>45, "align"=>"C"),
);
$htguntung = $jml1-($jml2+$jml3);
$untung = number_format($htguntung,0,",",".");
$pdf->SetFont('Helvetica','B','12');
$pdf->Cell(0,10, $keuntungan, '0', 1, 'L');
$pdf->SetFont('Helvetica','','10');
$pdf->SetFillColor(180,180,180);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header4 as $kolom) {
  $pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFont('Helvetica','','11');
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Cell(50,8, $jmltotal1,  1, '0', 'C', $fill);
$pdf->Cell(45,8, $total2,  1, '0', 'C', $fill);
$pdf->Cell(50,8, $jmltotal3,  1, '0', 'C', $fill);
$pdf->Cell(45,8, $untung,  1, '0', 'C', $fill);

#output file PDF
$pdf->Output();
?>