<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-10">
<h4 class="display-4 text-center" style="font-size: 26pt">HR OPERASIONAL</h4>
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
      <td width="20%"></td>
    </tr>
  </table>
  <div class="container col-md-4">
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="5%">JUMLAH</th>
      <th scope="col" width="5%">BARANG</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $query = mysql_query("SELECT idh, tipe, SUM(jumlah) AS jumlah, SUM(total) AS total FROM penjualan WHERE tglorder>='$txttgl1' AND tglorder<='$txttgl2' GROUP BY tipe ORDER BY tipe DESC") or die ('Error!!'.mysql_error());
  $arrayjmlh = array();
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $harga = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $dataharga = mysql_fetch_array ($harga);
    $arrayjmlh[$tipe]=$jumlah;
    echo "
    <tr>
      <td>".$jumlah." </td>
      <td>".$tipe."</td>
    </tr>";
  }
  echo "
  </tbody>
  </table>
  </div>
  ";
  $hrgalon1 = $arrayjmlh["Galon 19l"] * 1800;
  $hrgalon2 = $arrayjmlh["Galon 19l"] * 1200;
  if (array_key_exists("Dus 240ml", $arrayjmlh)) {
    $hrdus1 = $arrayjmlh["Dus 240ml"] * 150;
    $hrdus2 = $arrayjmlh["Dus 240ml"] * 150;
    $jmlhdus1 = $arrayjmlh["Dus 240ml"];
  }else{
    $jmlhdus1 = 0;
    $hrdus1 = 0 * 150;
    $hrdus2 = 0 * 150;
  }
  if (array_key_exists("Dus 330ml", $arrayjmlh)) {
    $hrdus3 = $arrayjmlh["Dus 330ml"] * 150;
    $hrdus4 = $arrayjmlh["Dus 330ml"] * 150;
    $jmlhdus2 = $arrayjmlh["Dus 330ml"];
  }else{
    $jmlhdus2 = 0;
    $hrdus3 = 0 * 150;
    $hrdus4 = 0 * 150;
  }
  if (array_key_exists("Dus 600ml", $arrayjmlh)) {
    $hrdus5 = $arrayjmlh["Dus 600ml"] * 150;
    $hrdus6 = $arrayjmlh["Dus 600ml"] * 150;
    $jmlhdus3 = $arrayjmlh["Dus 600ml"];
  }else{
    $jmlhdus3 = 0;
    $hrdus5 = 0 * 150;
    $hrdus6 = 0 * 150;
  }
  if (array_key_exists("Botol 600ml", $arrayjmlh)) {
    $hrbotol600f  = $arrayjmlh["Botol 600ml"] * 8;
    $hrbotol600w  = $arrayjmlh["Botol 600ml"] * 8;
    $jmlhbotol600 = $arrayjmlh["Botol 600ml"];
  }else{
    $jmlhbotol600 = 0;
    $hrbotol600f  = 0 * 8;
    $hrbotol600w  = 0 * 8;
  }
  if (array_key_exists("Botol 330ml", $arrayjmlh)) {
    $hrbotol330f  = $arrayjmlh["Botol 330ml"] * 5;
    $hrbotol330w  = $arrayjmlh["Botol 330ml"] * 5;
    $jmlhbotol330 = $arrayjmlh["Botol 330ml"];
  }else{
    $jmlhbotol330 = 0;
    $hrbotol330f  = 0 * 5;
    $hrbotol330w  = 0 * 5;
  }
  $hr1 = $hrgalon1 + $hrdus1 + $hrdus3 + $hrdus5 + $hrbotol600f + $hrbotol330f;
  $hr2 = $hrgalon2 + $hrdus2 + $hrdus4 + $hrdus6 + $hrbotol600w + $hrbotol330w;
  $hrt = $hr1 + $hr2;
  ?>
  <div class="container col-md-6">
  <table class="table-sm table-borderless">
  <?php
  echo "
    <tr>
      <td width='5%'><b>GAFUR</b></td>
    </tr>
    <tr>
      <td>(".$arrayjmlh["Galon 19l"]." * 1.800) + (".$jmlhdus3." * 150) + (".$jmlhdus2." * 150) + (".$jmlhdus1." * 150) + (".$jmlhbotol600." * 8) + (".$jmlhbotol330." * 5)</td>
    </tr>
    <tr>
      <td>".number_format($hrgalon1,0,",",".")." + ".number_format($hrdus5,0,",",".")." + ".number_format($hrdus3,0,",",".")." + ".number_format($hrdus1,0,",",".")." + ".number_format($hrbotol600f,0,",",".")." + ".number_format($hrbotol330f,0,",",".")."</td>
    </tr>
    <tr>
      <td>".number_format($hr1,0,",",".")."</td>
    </tr>
    <tr>
      <td width='5%'><b>TAUFIK</b></td>
    </tr>
    <tr>
      <td>(".$arrayjmlh["Galon 19l"]." * 1.200) + (".$jmlhdus3." * 150) + (".$jmlhdus2." * 150) + (".$jmlhdus1." * 150) + (".$jmlhbotol600." * 8) + (".$jmlhbotol330." * 5)</td>
    </tr>
    <tr>
      <td>".number_format($hrgalon2,0,",",".")." + ".number_format($hrdus6,0,",",".")." + ".number_format($hrdus4,0,",",".")." + ".number_format($hrdus2,0,",",".")." + ".number_format($hrbotol600w,0,",",".")." + ".number_format($hrbotol330w,0,",",".")."</td>
    </tr>
    <tr>
      <td>".number_format($hr2,0,",",".")."</td>
    </tr>
    <tr>
      <td><b>TOTAL (Rp) :</b> ".number_format($hrt,0,",",".")."</td>
    </tr>
    ";
  }
  ?>
  </table>
</main>
<?php
include 'foot.php';
?>