<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum login!!')</script>";
    echo "<script>window.location.href='/SAM/'</script>";
}
if(time() - $_SESSION['timestamp'] > 600) { //subtract new timestamp from the old one
    echo "<script>alert('Sesi login anda telah habis! Silahkan login kembali!');</script>";
    echo "<script>window.location.href='signout.php'</script>";
    exit;
} else {
    $_SESSION['timestamp'] = time(); //set new timestamp
}
$tanggal   = date('Y-m-d');
$arr       = explode('-', $tanggal);
$txttgl    = $arr[2].'/'.$arr[1].'/'.$arr[0];
$dayList = array(
  'Sunday' => 'Minggu',
  'Monday' => 'Senin',
  'Tuesday' => 'Selasa',
  'Wednesday' => 'Rabu',
  'Thursday' => 'Kamis',
  'Friday' => 'Jumat',
  'Saturday' => 'Sabtu'
);
$hari = date("l");
$hari = $dayList[$hari];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/drops1.png">
    <title>SISTEM ADMINISTRASI MOYAMU</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/sam.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="../css/bootstrap-4-hover-navbar.css" rel="stylesheet">

    <!-- Custom JS -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script>
    <script type="text/javascript" src="http://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.css">

    <!-- Single Datepicker -->
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css'>

  </head>
  <body>