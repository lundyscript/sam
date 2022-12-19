<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-8">
<h4 class="display-4 text-center" style="font-size: 26pt">Penjualan</h4>
<hr />
<form method="post">
  <div class="form-row">
  <div class="form-group col-md-4">
    <input type="text" class="form-control datepicker" id="datepicker" name="txttgl" placeholder="00/00/0000" value="<?php echo $txttgl; ?>" required>
  </div>
  <div class="form-group col-md-1">
    <button class="btn btn-sm btn-primary btn-block" type="submit" name="cari">Cari</button>
  </div>
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
      <th scope="col" width="5%">IDJ</th>
      <th scope="col" width="5%">STATUS</th>
      <th scope="col" width="23%">NAMA PELANGGAN</th>
      <th scope="col" width="17%">NAMA BARANG</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="12%">HARGA (Rp)</th>
      <th scope="col" width="12%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $txttgl    = strtoupper($_POST['txttgl']);
  $arr       = explode('/', $txttgl);
  $txttgl    = $arr[2].'-'.$arr[1].'-'.$arr[0];
  $arraytotal0  = array();
  $query0 = mysql_query("SELECT *FROM penjualan WHERE tglorder='$txttgl' ORDER BY status, idj") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query0)) {
    extract($row);
    array_push($arraytotal0, $total);
    $pelanggan = mysql_query("SELECT *FROM pelanggan WHERE idp='$idp'")or die("Error!!".mysql_error());
    $data = mysql_fetch_array ($pelanggan);
    $brg = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $databrg = mysql_fetch_array ($brg);
    if ($_SESSION['level']=="karyawan") {
      echo "
      <tr align='center'>
        <td><a><img src='../img/money0.png' width='20'/></a> | <a><img src='../img/trash0.png' width='20'/></a></td>
        <td>".$idj."</td>
        <td>".$status."</td>
        <td align='left'>".$data['nama']."</td>
        <td>".$databrg['tipe']."</td>
        <td>".$jumlah."</td>
        <td>".number_format($harga,0,",",".")."</td>
        <td>".number_format($total,0,",",".")."</td>
      </tr>
      ";
    }else{
      if ($status=="Bon") {
        echo "
        <tr align='center'>
          <td><a href='byr.php?idj=$idj'><img src='../img/money.png' width='20'/></a> | <a href='hps.php?idj=$idj'><img src='../img/trash.png' width='20'/></a></td>
          <td>".$idj."</td>
          <td>".$status."</td>
          <td align='left'>".$data['nama']."</td>
          <td>".$databrg['tipe']."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
        ";
      }else{
        echo "
        <tr align='center'>
          <td><a><img src='../img/money0.png' width='20'/></a> | <a href='hps.php?idj=$idj'><img src='../img/trash.png' width='20'/></a></td>
          <td>".$idj."</td>
          <td>".$status."</td>
          <td align='left'>".$data['nama']."</td>
          <td>".$databrg['tipe']."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
        ";
      }
    }
  }
  $jmltotal0 = array_sum($arraytotal0);
  echo "
    <tr>
      <td colspan='7' align='right'><b>TOTAL (Rp)</b></td>
      <td>".number_format($jmltotal0,0,",",".")."</td>
    </tr>
  ";
  $arraytotal1  = array();
  $query1 = mysql_query("SELECT *FROM penjualan WHERE tglorder='$txttgl' AND status='Tunai'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query1)) {
    extract($row);
    array_push($arraytotal1, $total);
  }
  $jmltotal1 = array_sum($arraytotal1);
  $arraytotal2  = array();
  $query1 = mysql_query("SELECT *FROM penjualan WHERE tgllunas='$txttgl' AND status='Lunas'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query1)) {
    extract($row);
    array_push($arraytotal2, $total);
  }
  $jmltotal2 = array_sum($arraytotal2);
  $arraytotal3  = array();
  $query2 = mysql_query("SELECT *FROM penjualan WHERE tglorder='$txttgl' AND status='Bon'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query2)) {
    extract($row);
    array_push($arraytotal3, $total);
  }
  $jmltotal3 = array_sum($arraytotal3);
  echo "
  </tbody>
  </table>
  <table>
    <tr>
      <td colspan='3'><b>KETERANGAN</b></td>
    </tr>
    <tr>
      <td>Uang Masuk</td><td>: Rp.</td><td align='right'>".number_format($jmltotal1,0,",",".").",-</td>
    </tr>
    <tr>
      <td>Bon Lunas</td><td>: Rp.</td><td align='right'>".number_format($jmltotal2,0,",",".").",-</td>
    </tr>
    <tr>
      <td>Uang Bon</td><td>: Rp.</td><td align='right'>".number_format($jmltotal3,0,",",".").",-</td>
    </tr>
  </table>
  <table>
    <tr>
      <td colspan='3'>Jumlah barang yang terjual :</td>
    </tr>
  ";
  $query = mysql_query("SELECT idh, tipe, SUM(jumlah) AS jumlah, SUM(total) AS total FROM penjualan WHERE tglorder='$txttgl' GROUP BY tipe") or die ('Error!!'.mysql_error());
  $arrayjmlh = array();
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $harga = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $dataharga = mysql_fetch_array ($harga);
    $arrayjmlh[$tipe]=$jumlah;
    echo "
    <tr>
      <td align='right'>".$jumlah." </td>
      <td></td>
      <td>".$tipe."</td>
    </tr>";
  }
  echo "</table></br>";
}else{
  echo "Tanggal : ".$txttgl;
  ?>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="10%">LINK</th>
      <th scope="col" width="5%">IDJ</th>
      <th scope="col" width="5%">STATUS</th>
      <th scope="col" width="23%">NAMA PELANGGAN</th>
      <th scope="col" width="17%">NAMA BARANG</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="12%">HARGA (Rp)</th>
      <th scope="col" width="12%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $arraytotal0  = array();
  $query0 = mysql_query("SELECT *FROM penjualan WHERE tglorder='$tanggal' ORDER BY status, idj") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query0)) {
    extract($row);
    array_push($arraytotal0, $total);
    $pelanggan = mysql_query("SELECT *FROM pelanggan WHERE idp='$idp'")or die("Error!!".mysql_error());
    $data = mysql_fetch_array ($pelanggan);
    $brg = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $databrg = mysql_fetch_array ($brg);
    if ($_SESSION['level']=="karyawan") {
      echo "
      <tr align='center'>
        <td><a><img src='../img/money0.png' width='20'/></a> | <a><img src='../img/trash0.png' width='20'/></a></td>
        <td>".$idj."</td>
        <td>".$status."</td>
        <td align='left'>".$data['nama']."</td>
        <td>".$databrg['tipe']."</td>
        <td>".$jumlah."</td>
        <td>".number_format($harga,0,",",".")."</td>
        <td>".number_format($total,0,",",".")."</td>
      </tr>
      ";
    }else{
      if ($status=="Bon") {
        echo "
        <tr align='center'>
          <td><a href='byr.php?idj=$idj'><img src='../img/money.png' width='20'/></a> | <a href='hps.php?idj=$idj'><img src='../img/trash.png' width='20'/></a></td>
          <td>".$idj."</td>
          <td>".$status."</td>
          <td align='left'>".$data['nama']."</td>
          <td>".$databrg['tipe']."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
        ";
      }else{
        echo "
        <tr align='center'>
          <td><a><img src='../img/money0.png' width='20'/></a> | <a href='hps.php?idj=$idj'><img src='../img/trash.png' width='20'/></a></td>
          <td>".$idj."</td>
          <td>".$status."</td>
          <td align='left'>".$data['nama']."</td>
          <td>".$databrg['tipe']."</td>
          <td>".$jumlah."</td>
          <td>".number_format($harga,0,",",".")."</td>
          <td>".number_format($total,0,",",".")."</td>
        </tr>
        ";
      }
    }
  }
  $jmltotal0 = array_sum($arraytotal0);
  echo "
    <tr>
      <td colspan='7' align='right'><b>TOTAL (Rp)</b></td>
      <td>".number_format($jmltotal0,0,",",".")."</td>
    </tr>
  ";
  $arraytotal1  = array();
  $query1 = mysql_query("SELECT *FROM penjualan WHERE tglorder='$tanggal' AND status='Tunai'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query1)) {
    extract($row);
    array_push($arraytotal1, $total);
  }
  $jmltotal1 = array_sum($arraytotal1);
  $arraytotal2  = array();
  $query1 = mysql_query("SELECT *FROM penjualan WHERE tgllunas='$tanggal' AND status='Lunas'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query1)) {
    extract($row);
    array_push($arraytotal2, $total);
  }
  $jmltotal2 = array_sum($arraytotal2);
  $arraytotal3  = array();
  $query2 = mysql_query("SELECT *FROM penjualan WHERE tglorder='$tanggal' AND status='Bon'") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query2)) {
    extract($row);
    array_push($arraytotal3, $total);
  }
  $jmltotal3 = array_sum($arraytotal3);
  echo "
  </tbody>
  </table>
  <table>
    <tr>
      <td colspan='3'><b>KETERANGAN</b></td>
    </tr>
    <tr>
      <td>Uang Masuk</td><td>: Rp.</td><td align='right'>".number_format($jmltotal1,0,",",".").",-</td>
    </tr>
    <tr>
      <td>Bon Lunas</td><td>: Rp.</td><td align='right'>".number_format($jmltotal2,0,",",".").",-</td>
    </tr>
    <tr>
      <td>Uang Bon</td><td>: Rp.</td><td align='right'>".number_format($jmltotal3,0,",",".").",-</td>
    </tr>
  </table>
  <table>
    <tr>
      <td colspan='3'>Jumlah barang yang terjual :</td>
    </tr>
  ";
  $query = mysql_query("SELECT idh, tipe, SUM(jumlah) AS jumlah, SUM(total) AS total FROM penjualan WHERE tglorder='$tanggal'GROUP BY tipe") or die ('Error!!'.mysql_error());
  $arrayjmlh = array();
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $harga = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $dataharga = mysql_fetch_array ($harga);
    $arrayjmlh[$tipe]=$jumlah;
    echo "
    <tr>
      <td align='right'>".$jumlah." </td>
      <td></td>
      <td>".$tipe."</td>
    </tr>";
  }
  echo "</table></br>";
}
?>
</main>
<?php
include 'foot.php';
?>