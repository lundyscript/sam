<?php
include 'head.php';
include 'navbar.php';
$peng = $_GET['peng'];
$no = $_GET['no'];
$delete = mysql_query("DELETE FROM ".$peng." WHERE no='$no'") or die ('Error!!'.mysql_error());
if ($delete) {
  ?>
  <div class="alertsuccess fixed-top">
    <span class="closebtn" onclick="window.location.href='/SAM/php/peng.php';">&times;</span> 
    <strong>Success!</strong> Data has been deleted!
  </div>
  <?php
  }else{
  ?>
  <div class="alerterror fixed-top">
    <span class="closebtn" onclick="window.location.href='/SAM/php/peng.php';">&times;</span> 
    <strong>ERROR!</strong>
  </div>
  <?php
}
include 'foot.php';
?>