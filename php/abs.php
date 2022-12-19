<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-8">
<h4 class="display-4 text-center" style="font-size: 26pt">Absen Karyawan</h4>
<hr />
<div class="form-group">
  <a class="btn btn-sm btn-primary" href="dfab.php" role="button">Daftar Absensi &raquo;</a>
</div>
<table class="table table-sm table-bordered align-middle text-center">
<thead>
  <tr>
    <th scope="col" width="10%">LINK</th>
    <th scope="col" width="10%">NO</th>
    <th scope="col" width="30%">NAMA KARYAWAN</th>
    <th scope="col" width="15%">SEBAGAI</th>
    <th scope="col" width="15%">NO. TELP</th>
  </tr>
</thead>
<tbody>
<?php
$query = mysql_query("SELECT *FROM karyawan ORDER BY idka") or die ('Error!!'.mysql_error());
while ($row = mysql_fetch_array ($query)) {
  $row = extract($row);
  echo "
    <tr>
      <td><a href='abse.php?idka=$idka&abse=1'><img src='../img/checked.png' width='20'/></a> | <a href='abse.php?idka=$idka&abse=2'><img src='../img/information.png' width='20'/></a> | <a href='abse.php?idka=$idka&abse=3'><img src='../img/cancel.png' width='20'/></a></td>
      <td>".$idka."</td>
      <td align='left'>".$nama."</td>
      <td align='left'>".$jbtn."</td>
      <td align='left'>".$telp."</td>
    </tr>
  ";
}
?>
</tbody>
</table>
</main>
<?php
include 'foot.php';
?>