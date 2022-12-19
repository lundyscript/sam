<?php
include 'head.php';
include 'navbar.php';
$no = $_GET['no'];
$delete = mysql_query("DELETE FROM barang WHERE no='$no'") or die ('Error!!'.mysql_error());
if ($delete) {
  ?>
  <div class="alertsuccess fixed-top">
    <span class="closebtn" onclick="window.location.href='/SAM/php/pem.php';">&times;</span> 
    <strong>Success!</strong> Data has been deleted!
  </div>
  <?php
  }else{
  ?>
  <div class="alerterror fixed-top">
    <span class="closebtn" onclick="window.location.href='/SAM/php/pem.php';">&times;</span> 
    <strong>ERROR!</strong>
  </div>
  <?php
}
include 'foot.php';
?>