<?php
include 'head.php';
include 'navbar.php';
include "koneksi.php"; 
$idj = $_POST['idj'];
$dari   = $_GET['d'];
$sampai = $_GET['s'];
if (empty($idj)) {
  echo "<script>window.close();</script>";
}else{
  for ($i=0; $i < count($idj); $i++) { 
	$insert = mysql_query("INSERT INTO bon VALUES('$i','$idj[$i]')") or die ('Error!!'.mysql_error());
  }
  echo "<script>window.location.href='prbon.php?d=$dari&s=$sampai'</script>";
}
?>