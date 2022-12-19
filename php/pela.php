<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-8">
<h4 class="display-4 text-center" style="font-size: 26pt">Pelanggan</h4>
<hr />
<form method="post">
  <div class="form-row">
  <div class="form-group col-md-4">
    <input class="form-control form-control-sm" type="text" name="txtcari" placeholder="Nama Pelanggan" required>
  </div>
  <div class="form-group col-md-1">
    <button class="btn btn-sm btn-primary btn-block" type="submit" name="cari">Cari</button>
  </div>
  <div class="form-group col-md-7" style="text-align: right">
    <a class="btn btn-sm btn-primary" href="pelb.php" role="button">Pelanggan Baru &raquo;</a>
  </div>
</div>
</form>
<table class="table table-sm table-bordered align-middle text-center">
<thead>
  <tr>
    <th scope="col" width="10%">LINK</th>
    <th scope="col" width="10%">NO</th>
    <th scope="col" width="30%">NAMA PELANGGAN</th>
    <th scope="col" width="30%">ALAMAT</th>
    <th scope="col" width="15%">TELP</th>
  </tr>
</thead>
<tbody>
<?php
if(isset ($_POST['cari'])){
  $txtcari   = $_POST['txtcari'];
  $query = mysql_query("SELECT *FROM pelanggan WHERE nama LIKE '%$txtcari%'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    echo "
      <tr>
        <td><a href='beli.php?idp=$idp'><img src='../img/money.png' width='20'/></a> | <a href='pele.php?idp=$idp'><img src='../img/doc.png' width='20'/></a></td>
        <td>".$no."</td>
        <td align='left'>".$nama."</td>
        <td align='left'>".$alamat."</td>
        <td>".$telp."</td>
      </tr>
    ";
  }
}else{
  $arraynomer = array();
  $query = mysql_query("SELECT *FROM pelanggan ORDER BY no") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    array_push($arraynomer, $row['no']);
  }
  for($i=0; $i<count($arraynomer); $i++){
    $query = mysql_query("SELECT *FROM pelanggan WHERE no='$arraynomer[$i]'") or die ('Error!!'.mysql_error());
    $row = mysql_fetch_array ($query);
    $no = $i+1;
    $idp = $row['idp'];
    echo "
      <tr>
        <td><a href='beli.php?idp=$idp'><img src='../img/money.png' width='20'/></a> | <a href='pele.php?idp=$idp'><img src='../img/doc.png' width='20'/></a></td>
        <td>".$no."</td>
        <td align='left'>".$row['nama']."</td>
        <td align='left'>".$row['alamat']."</td>
        <td>".$row['telp']."</td>
      </tr>
    ";
  }
}
?>
</tbody>
</table>
</main>
<?php
include 'foot.php';
?>