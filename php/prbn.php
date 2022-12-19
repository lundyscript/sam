<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-10">
<h4 class="display-4 text-center" style="font-size: 26pt">PENGAJUAN KAS BON</h4>
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
<?php
if(isset ($_POST['cari'])){
  $txttgl1   = $_POST['txttgl1'];
  $arr       = explode('/', $txttgl1);
  $txttgl1   = $arr[2].'-'.$arr[1].'-'.$arr[0];
  $txttgl2   = $_POST['txttgl2'];
  $arr       = explode('/', $txttgl2);
  $txttgl2   = $arr[2].'-'.$arr[1].'-'.$arr[0];
  ?>
  <table class="table">
    <tr>
      <td width="20%"></td>
      <td width="60%" align="center"><b><?php echo $_POST['txttgl1']." - ".$_POST['txttgl2'].""; ?></b></td>
      <td width="20%" align="right" width="20%"></td>
    </tr>
  </table>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="5%">CHECK</th>
      <th scope="col" width="15%">TANGGAL ORDER</th>
      <th scope="col" width="5%">IDJ</th>
      <th scope="col" width="20%">NAMA PELANGGAN</th>
      <th scope="col" width="20%">NAMA BARANG</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="15%">HARGA (Rp)</th>
      <th scope="col" width="15%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $arraytotal = array();
  $query = mysql_query("SELECT *FROM penjualan WHERE status='Bon' AND tglorder>='$txttgl1' AND tglorder<='$txttgl2' ORDER BY tglorder") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $arr       = explode('-', $tglorder);
    $tglorder  = $arr[2].'/'.$arr[1].'/'.$arr[0];
    $pelanggan = mysql_query("SELECT *FROM pelanggan WHERE idp='$idp'")or die("Error!!".mysql_error());
    $data = mysql_fetch_array ($pelanggan);
    $brg = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $databrg = mysql_fetch_array ($brg);
    array_push($arraytotal, $total);
    ?>
    <form method="post" action="<?php echo "chk.php?d=$txttgl1&s=$txttgl2&idj=idj[]";?>" target="_blank">
    <tr align='center'>
      <td><label class="labelchk"><input type='checkbox' name='idj[]' value='<?php echo $idj; ?>'/><span class="checkmark"></span></label></td>
      <?php
      echo "
      <td>".$tglorder."</td>
      <td>".$idj."</td>
      <td align='left'>".$data['nama']."</td>
      <td align='left'>".$databrg['tipe']."</td>
      <td>".$jumlah."</td>
      <td>".number_format($harga,0,",",".")."</td>
      <td>".number_format($total,0,",",".")."</td>
    </tr>
    ";
  }
  $arraytotal  = array();
  $query1 = mysql_query("SELECT *FROM penjualan WHERE status='Bon' AND tglorder>='$txttgl1' AND tglorder<='$txttgl2' ORDER BY tglorder") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query1)) {
    extract($row);
    array_push($arraytotal, $total);
  }
  $jmltotal = array_sum($arraytotal);
  ?>
    <tr>
      <td><button type="submit" name="Submit" id="printer" value="Submit" ><img src="../img/printer.png"></button></td>
      <?php
      echo "
      <td colspan='6' align='right'><b>TOTAL (Rp)</b></td>
      <td>".number_format($jmltotal,0,",",".")."</td>
      ";
      ?>
    </tr>
  </tbody>
  </table>
  </form>
  <?php
}
?>
</main>
<?php
include 'foot.php';
?>