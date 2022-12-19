<?php
include 'head.php';
include 'navbar.php';
$idka = $_GET['idka'];
$abse = $_GET['abse'];
date_default_timezone_set("Asia/Jakarta");
$tgl  = date('Y-m-d');
$cari = mysql_query("SELECT max(no) AS nom FROM absen");
$data = mysql_fetch_assoc($cari);
$no = (int) substr($data['nom'],0,9);
$nomor = $no+1;

$quecek = mysql_query("SELECT *FROM absen WHERE idka='$idka' AND tgl='$tanggal'") or die ('Error!!'.mysql_error());
$row = mysql_fetch_array ($quecek);
if (!empty($row)) {
	echo "<script>alert('Karyawan Sudah Absen!')</script>";
	echo "<script>window.location.href='/SAM/php/abs.php'</script>";
}else{
	if ($abse=='1') {
	  $insert = mysql_query("INSERT INTO absen VALUES('$nomor','$tgl','$idka','Masuk')") or die ('Error!!'.mysql_error());
	  echo "<script>alert('Absen Masuk Berhasil Disimpan!')</script>";
	  echo "<script>window.location.href='/SAM/php/abs.php'</script>";
	}elseif ($abse=='2') {
	  $insert = mysql_query("INSERT INTO absen VALUES('$nomor','$tgl','$idka','Izin')") or die ('Error!!'.mysql_error());
	  echo "<script>alert('Absen Izin Berhasil Disimpan!')</script>";
	  echo "<script>window.location.href='/SAM/php/abs.php'</script>";
	}elseif ($abse=='3') {
	  $insert = mysql_query("INSERT INTO absen VALUES('$nomor','$tgl','$idka','Tidak Masuk')") or die ('Error!!'.mysql_error());
	  echo "<script>alert('Absen Tidak Masuk Berhasil Disimpan!')</script>";
	  echo "<script>window.location.href='/SAM/php/abs.php'</script>";
	}
}
?>