<?php
include 'head.php';
include 'navbar.php';
$idj = $_GET['idj'];
$delete = mysql_query("DELETE FROM penjualan WHERE idj='$idj'") or die ('Error!!'.mysql_error());
if ($delete) {
  ?>
  <div class="alertsuccess fixed-top">
    <span class="closebtn" onclick="window.location.href='/SAM/php/penj.php';">&times;</span> 
    <strong>Success!</strong> Data has been deleted!
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