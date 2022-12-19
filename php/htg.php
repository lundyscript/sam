<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-8">
<div class="alert alert-danger text-center" role="alert"><b>Catatan Hutang!</b> LUNASI HUTANGMU, HATIMU PUN TENANG ☺</div>
<center>
<?php
if ($_SESSION['level']=="admin" || $_SESSION['level']=="master") {
?>
<div class="form-group col-md-12" style="text-align: right">
  <a class="btn btn-sm btn-danger" href="htgb.php" role="button">Hutang Baru &raquo;</a>
</div>
<?php
}
?>
<table class="table table-sm">
  <thead>
    <tr align="center">
      <th scope="col">LINK</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Penerima</th>
      <th scope="col">Jumlah (Rp)</th>
      <th scope="col">Pemberi</th>
      <th scope="col">Keterangan</th>
    </tr>
  </thead>
  <tbody>
<?php
  $arraynomer = array();
  $query = mysql_query("SELECT *FROM hutang ORDER BY nama1") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    array_push($arraynomer, $row['no']);
  }
  for($i=0; $i<count($arraynomer); $i++){
    $query = mysql_query("SELECT *FROM hutang WHERE no='$arraynomer[$i]'") or die ('Error!!'.mysql_error());
    $row = mysql_fetch_array ($query);
    extract($row);
    $arr       = explode('-', $tgl);
    $tgl    = $arr[2].'/'.$arr[1].'/'.$arr[0];
    if ($_SESSION['level']=="karyawan") {
      echo "
        <tr align='center'>
          <td><a><img src='../img/htg0.png' width='20'/></a> | <a><img src='../img/money0.png' width='20'/></a></td>
          <td>".$tgl."</td>
          <td>".$nama1."</td>
          <td align='right'>".number_format($jumlah,0,",",".")."</td>
          <td>".$nama2."</td>
          <td>".$ket."</td>
        </tr>
      ";
    }else{
      echo "
        <tr align='center'>
          <td><a href='htgt.php?no=$no'><img src='../img/htg.png' width='20'/></a> | <a href='htgl.php?no=$no'><img src='../img/money.png' width='20'/></a></td>
          <td>".$tgl."</td>
          <td>".$nama1."</td>
          <td align='right'>".number_format($jumlah,0,",",".")."</td>
          <td>".$nama2."</td>
          <td>".$ket."</td>
        </tr>
      ";
    }
  }
?>
</tbody>
</table>
</center>
</main>
<?php
include 'foot.php';
?>