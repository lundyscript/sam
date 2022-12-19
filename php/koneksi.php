<?php 
mysql_connect("localhost","lundy","09876") or die ("Koneksi Gagal ! ".mysql_error()); 
mysql_select_db("db_sam")  or die ("Database tidak tersedia ! ".mysql_error());
?>