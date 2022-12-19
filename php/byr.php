<?php
include 'head.php';
include 'navbar.php';
$idj = $_GET['idj'];
$tanggal = date('Y-m-d');
$query = mysql_query("SELECT *FROM penjualan WHERE idj='$idj'") or die ('Error!!'.mysql_error());
$row = mysql_fetch_array ($query);
extract($row);
$status = "Lunas";
$update = mysql_query("UPDATE penjualan SET status='$status' , tgllunas='$tanggal' WHERE idj='$idj'") or die ('Error!!'.mysql_error());
if ($update) {
  ?>
  <div class="alertsuccess fixed-top">
    <span class="closebtn" onclick="window.location.href='/SAM/php/penj.php';">&times;</span> 
    <strong>Success!</strong> Data has been changed!
  </div>
  <?php
  }else{
  ?>
  <div class="alerterror fixed-top">
    <span class="closebtn" onclick="window.location.href='/SAM/php/penj.php';">&times;</span> 
    <strong>ERROR!</strong>
  </div>
  <?php
}
include 'foot.php';
?>