<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-8">
<h4 class="display-4 text-center" style="font-size: 26pt">Pengeluaran</h4>
<hr />
<form method="post">
  <div class="form-row">
  <div class="form-group col-md-4">
    <input type="text" class="form-control datepicker" id="datepicker" name="txttgl" placeholder="00/00/0000" value="<?php echo $txttgl; ?>" required>
  </div>
  <div class="form-group col-md-1">
    <button class="btn btn-sm btn-primary btn-block" type="submit" name="cari">Cari</button>
  </div>
  <?php
  if ($_SESSION['level']=="admin" || $_SESSION['level']=="master") {
  ?>
    <div class="form-group col-md-7" style="text-align: right">
      <a class="btn btn-sm btn-primary" href="pegb.php" role="button">Pengeluaran Baru &raquo;</a>
    </div>
  <?php
  }
  ?>
</div>
</form>
<?php
if(isset ($_POST['cari'])){
  $txttgl   = $_POST['txttgl'];
  echo "Tanggal : ".$txttgl;
  ?>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="10%">LINK</th>
      <th scope="col" width="20%">JENIS</th>
      <th scope="col" width="30%">NAMA PENGELUARAN</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="15%">HARGA (Rp)</th>
      <th scope="col" width="15%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $arr       = explode('/', $txttgl);
  $txttgl    = $arr[2].'-'.$arr[1].'-'.$arr[0];
  $array = array("operasional","produksi");
  $ttl = array();
  for ($i=0; $i < count($array); $i++) {
    $query = mysql_query("SELECT *FROM ".$array[$i]." WHERE tglnota='$txttgl' ORDER BY no") or die ('Error!!'.mysql_error());
    while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $jenis = strtoupper($array[$i]);
    array_push($ttl, $total);
    if ($_SESSION['level']=="karyawan") {
      echo "
        <tr>
          <td><a><img src='../img/trash0.png' width='20'/></a></td>
          <td>".$jenis."</td>
          <td align='left'>".$nama."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
      ";
    }else{
       echo "
        <tr>
          <td><a href='hsop.php?peng=$array[$i]&no=$no'><img src='../img/trash.png' width='20'/></a></td>
          <td>".$jenis."</td>
          <td align='left'>".$nama."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
      ";
    }
    }
  }
  $jmlttl = array_sum($ttl);
  echo "
    <tr>
      <td colspan='5' align='right'><b>TOTAL (Rp)</b></td>
      <td>".number_format($jmlttl,0,",",".")."</td>
    </tr>
  ";
}else{
  echo "Tanggal : ".$txttgl;
  ?>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="10%">LINK</th>
      <th scope="col" width="20%">JENIS</th>
      <th scope="col" width="30%">NAMA PENGELUARAN</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="15%">HARGA (Rp)</th>
      <th scope="col" width="15%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $tanggal = date('Y-m-d');
  $array = array("operasional","produksi");
  $ttl = array();
  for ($i=0; $i < count($array); $i++) {
    $query = mysql_query("SELECT *FROM ".$array[$i]." WHERE tglnota='$tanggal' ORDER BY no") or die ('Error!!'.mysql_error());
    while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $jenis = ucfirst($array[$i]);
    array_push($ttl, $total);
    if ($_SESSION['level']=="karyawan") {
      echo "
        <tr>
          <td><a><img src='../img/trash0.png' width='20'/></a></td>
          <td>".$jenis."</td>
          <td align='left'>".$nama."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
      ";
    }else{
       echo "
        <tr>
          <td><a href='hsop.php?peng=$array[$i]&no=$no'><img src='../img/trash.png' width='20'/></a></td>
          <td>".$jenis."</td>
          <td align='left'>".$nama."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
      ";
    }
    }
  }
  $jmlttl = array_sum($ttl);
  echo "
    <tr>
      <td colspan='5' align='right'><b>TOTAL (Rp)</b></td>
      <td>".number_format($jmlttl,0,",",".")."</td>
    </tr>
  ";
}
?>
</tbody>
</main>
<?php
include 'foot.php';
?>