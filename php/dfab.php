<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-8">
<h4 class="display-4 text-center" style="font-size: 26pt">Absen Karyawan</h4>
<hr />
<form method="post">
  <div class="form-row justify-content-center">
    <div class="form-group col-md-1">
    </div>
    <div class="form-group col-md-4">
      <input type="text" class="form-control datepicker" id="datepicker" name="txttgl1" placeholder="00/00/0000" value="<?php echo $txttgl; ?>" required>
    </div>
    _
    <div class="form-group col-md-4">
      <input type="text" class="form-control datepicker" id="datepicker" name="txttgl2" placeholder="00/00/0000" value="<?php echo $txttgl; ?>" required>
    </div>
    <div class="form-group col-md-1">
      <button class="btn btn-sm btn-primary btn-block" type="submit" name="cari">Cari</button>
    </div>
  </div>
</form>
<table class="table table-sm table-bordered align-middle text-center">
<thead>
  <tr>
    <th scope="col" width="10%">NO</th>
    <th scope="col" width="10%">TANGGAL</th>
    <th scope="col" width="30%">NAMA KARYAWAN</th>
    <th scope="col" width="15%">TELP</th>
    <th scope="col" width="15%">KETERANGAN</th>
  </tr>
</thead>
<tbody>
<?php
if (isset ($_POST['cari'])) {
  $txttgl1   = $_POST['txttgl1'];
  $arr       = explode('/', $txttgl1);
  $txttgl1   = $arr[2].'-'.$arr[1].'-'.$arr[0];
  $txttgl2   = $_POST['txttgl2'];
  $arr       = explode('/', $txttgl2);
  $txttgl2   = $arr[2].'-'.$arr[1].'-'.$arr[0];

  $query = mysql_query("SELECT *FROM absen WHERE tgl>='$txttgl1' AND tgl<='$txttgl2' ORDER BY tgl") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    $row = extract($row);
    $que = mysql_query("SELECT *FROM karyawan WHERE idka=$idka") or die ('Error!!'.mysql_error());
    $pri = mysql_fetch_array ($que);
    $arr    = explode('-', $tgl);
    $txttgl = $arr[2].'/'.$arr[1].'/'.$arr[0];
    if ($keterangan=='Masuk') {
      echo "
        <tr>
          <td>".$no."</td>
          <td>".$txttgl."</td>
          <td align='left'>".$pri['nama']."</td>
          <td align='left'>".$pri['telp']."</td>
          <td align='left'><img src='../img/checked.png' width='20'/> ".$keterangan."</td>
        </tr>
      ";
    }elseif ($keterangan=='Izin') {
      echo "
        <tr>
          <td>".$no."</td>
          <td>".$txttgl."</td>
          <td align='left'>".$pri['nama']."</td>
          <td align='left'>".$pri['telp']."</td>
          <td align='left'><img src='../img/information.png' width='20'/> ".$keterangan."</td>
        </tr>
      ";
    }elseif ($keterangan=='Tidak Masuk') {
      echo "
        <tr>
          <td>".$no."</td>
          <td>".$txttgl."</td>
          <td align='left'>".$pri['nama']."</td>
          <td align='left'>".$pri['telp']."</td>
          <td align='left'><img src='../img/cancel.png' width='20'/> ".$keterangan."</td>
        </tr>
      ";
    }
  }
}else{
  $query = mysql_query("SELECT *FROM absen WHERE tgl='$tanggal' ORDER BY tgl") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    $row = extract($row);
    $que = mysql_query("SELECT *FROM karyawan WHERE idka=$idka") or die ('Error!!'.mysql_error());
    $pri = mysql_fetch_array ($que);
    $arr    = explode('-', $tgl);
    $txttgl = $arr[2].'/'.$arr[1].'/'.$arr[0];
    if ($keterangan=='Masuk') {
      echo "
        <tr>
          <td>".$no."</td>
          <td>".$txttgl."</td>
          <td align='left'>".$pri['nama']."</td>
          <td align='left'>".$pri['telp']."</td>
          <td align='left'><img src='../img/checked.png' width='20'/> ".$keterangan."</td>
        </tr>
      ";
    }elseif ($keterangan=='Izin') {
      echo "
        <tr>
          <td>".$no."</td>
          <td>".$txttgl."</td>
          <td align='left'>".$pri['nama']."</td>
          <td align='left'>".$pri['telp']."</td>
          <td align='left'><img src='../img/information.png' width='20'/> ".$keterangan."</td>
        </tr>
      ";
    }elseif ($keterangan=='Tidak Masuk') {
      echo "
        <tr>
          <td>".$no."</td>
          <td>".$txttgl."</td>
          <td align='left'>".$pri['nama']."</td>
          <td align='left'>".$pri['telp']."</td>
          <td align='left'><img src='../img/cancel.png' width='20'/> ".$keterangan."</td>
        </tr>
      ";
    }
  }
}
?>
</tbody>
</table>
</main>
<?php
include 'foot.php';
?>