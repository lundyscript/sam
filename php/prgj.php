<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-10">
<h4 class="display-4 text-center" style="font-size: 26pt">KEUNTUNGAN</h4>
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
      <td width="20%" align="right"><?php echo "<a href='prgaj.php?d=$txttgl1&s=$txttgl2' target='_blank'><img class='icon' src='../img/printer.png'/></a>"; ?></td>
    </tr>
  </table>
  <h4 class="text-left" style="font-size: 12pt"><b>PENJUALAN KOTOR</b></h4>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="30%">NAMA BARANG</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="15%">HARGA (Rp)</th>
      <th scope="col" width="15%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $arraypenjualan = array();
  $query = mysql_query("SELECT idh, tipe, SUM(jumlah) AS jumlah, SUM(total) AS total FROM penjualan WHERE tglorder>='$txttgl1' AND tglorder<='$txttgl2' GROUP BY idh") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    $harga = mysql_query("SELECT *FROM harga WHERE idh='$idh'")or die("Error!!".mysql_error());
    $dataharga = mysql_fetch_array ($harga);
    echo "
    <tr align='center'>
      <td>".$tipe." ".$dataharga['ket']."</td>
      <td>".$jumlah."</td>
      <td>".number_format($dataharga['harga'],0,",",".")."</td>
      <td>".number_format($total,0,",",".")."</td>
    </tr>
    ";
    array_push($arraypenjualan, $total);
  }
  $jmltotal1 = array_sum($arraypenjualan);
  $total1 = number_format($jmltotal1,0,",",".");
  echo "
  <tr>
    <td colspan='3' align='right'><b>TOTAL (Rp)</b></td>
    <td>".$total1."</td>
  </tr>
  </tbody>
  </table>
  ";
  ?>
  <h4 class="text-left" style="font-size: 12pt"><b>BIAYA PRODUKSI</b></h4>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="30%">NAMA PENGELUARAN</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="15%">HARGA (Rp)</th>
      <th scope="col" width="15%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $tipe = array("Galon 19l","Dus 240ml","Dus 330ml","Dus 600ml","Botol 330ml","Botol 600ml");
  $arr1 = array();
  for ($i=0; $i < count($tipe); $i++) { 
    $jual = mysql_query("SELECT SUM(jumlah) AS jumlah FROM penjualan WHERE tipe='$tipe[$i]' AND tglorder>='$txttgl1' AND tglorder<='$txttgl2'")or die("Error!!".mysql_error());
    $data = mysql_fetch_array ($jual);
    $htng = mysql_query("SELECT *FROM biaya WHERE tipe='$tipe[$i]'")or die("Error!!".mysql_error());
    while ($row = mysql_fetch_array ($htng)) {
      if ($data['jumlah']==0) {
        array_push($arr1, 0);
      }else{
        array_push($arr1, $data['jumlah']);
      }
    }
  }
  $arr2 = array();
  for ($i=0; $i < count($tipe); $i++) { 
    $htng = mysql_query("SELECT harga FROM biaya WHERE tipe='$tipe[$i]'")or die("Error!!".mysql_error());
    while ($row = mysql_fetch_array ($htng)) {
      array_push($arr2, $row['harga']);
    }
  }
  $arr3 = array();
  for ($i=0; $i < count($arr1); $i++) { 
    $arr1[6] = $arr1[5] * 48;
    $arr1[7] = $arr1[5] * 48;
    $arr1[9] = $arr1[8] * 28;
    $arr1[10] = $arr1[8] * 28;
    $arr1[11] = $arr1[8] * 28;
    $arr1[13] = $arr1[12] * 18;
    $arr1[14] = $arr1[12] * 18;
    $arr1[15] = $arr1[12] * 18;
    $kali = $arr1[$i] * $arr2[$i];
    array_push($arr3, $kali);
  }
  $jmltotal2 = array_sum($arr3);
  $total2 = number_format($jmltotal2,0,",",".");
  $query = mysql_query("SELECT *FROM biaya")or die("Error!!".mysql_error());
  $i = 0;
  while ($row = mysql_fetch_array ($query)) {
    extract($row);
    echo "
    <tr>
      <td align='left'>&nbsp;&nbsp;&nbsp;".$tipe." - ".$nama."</td>
      <td>".number_format($arr1[$i],0,",",".")."</td>
      <td>".number_format($harga,0,",",".")."</td>
      <td>".number_format($arr3[$i],0,",",".")."</td>
    </tr>
    ";
    $i++;
  }
  echo "
  <tr>
    <td colspan='3' align='right'><b>TOTAL (Rp)</b></td>
    <td>".$total2."</td>
  </tr>
  </tbody>
  </table>";
  ?>
  <h4 class="text-left" style="font-size: 12pt"><b>BIAYA OPERASIONAL</b></h4>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="10%">TANGGAL</th>
      <th scope="col" width="20%">NAMA PENGELUARAN</th>
      <th scope="col" width="10%">JUMLAH</th>
      <th scope="col" width="15%">HARGA (Rp)</th>
      <th scope="col" width="15%">TOTAL (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $arrayoperasional = array();
  $query = mysql_query("SELECT *FROM operasional WHERE tglnota>='$txttgl1' AND tglnota<='$txttgl2' ORDER BY tglnota") or die ('Data Tidak Ditemukan!!');
  $count = mysql_num_rows($query);
  $arraynomer = array();
  while ($row = mysql_fetch_array ($query)) {
    array_push($arraynomer, $row['no']);
  }
  for($i=0; $i<count($arraynomer); $i++){
    $query = mysql_query("SELECT *FROM operasional WHERE no='$arraynomer[$i]'") or die ('Data Tidak Ditemukan!!');
    $row = mysql_fetch_array ($query);
    $no = $i+1;
    $tgl = date('d/m/Y', strtotime($row['tglnota']));
    array_push($arrayoperasional, $row['total']);
    echo "
    <tr align='center'>
      <td>".$tgl."</td>
      <td>".$row['nama']."</td>
      <td>".$row['jumlah']."</td>
      <td>".number_format($row['harga'],0,",",".")."</td>
      <td>".number_format($row['total'],0,",",".")."</td>
    </tr>
    ";
  }
  $jmltotal3 = array_sum($arrayoperasional);
  $total3 = number_format($jmltotal3,0,",",".");
  echo "
  <tr>
    <td colspan='4' align='right'><b>TOTAL (Rp)</b></td>
    <td>".$total3."</td>
  </tr>
  </tbody>
  </table>
  ";
  ?>
  <h4 class="text-left" style="font-size: 12pt"><b>KEUNTUNGAN</b></h4>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="20%">PENJUALAN KOTOR (Rp)</th>
      <th scope="col" width="20%">BIAYA PRODUKSI (Rp)</th>
      <th scope="col" width="20%">BIAYA OPERASIONAL (Rp)</th>
      <th scope="col" width="20%">KEUNTUNGAN (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $htguntung = $jmltotal1-($jmltotal2+$jmltotal3);
  $untung = number_format($htguntung,0,",",".");
  echo "
  <tr>
    <td>".$total1."</td>
    <td>".$total2."</td>
    <td>".$total3."</td>
    <td>".$untung."</td>
  </tr>
  </tbody>
  </table>
  ";
  ?>
  <h4 class="text-left" style="font-size: 12pt"><b>PERHITUNGAN GAJI</b></h4>
  <table class="table table-sm table-bordered align-middle text-center">
  <thead>
    <tr>
      <th scope="col" width="20%">70% KEUNTUNGAN (Rp)</th>
      <th scope="col" width="20%">45% ZULFA (Rp)</th>
      <th scope="col" width="20%">22% MAGANG (Rp)</th>
      <th scope="col" width="20%">33% GOFUR (Rp)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $unive = (70/100) * $htguntung;
  $lundy = (45/100) * $unive;
  $zulfa = (22/100) * $unive;
  $gofur = (33/100) * $unive;
  echo "
  <tr>
    <td>".number_format($unive,0,",",".")."</td>
    <td>".number_format($lundy,0,",",".")."</td>
    <td>".number_format($zulfa,0,",",".")."</td>
    <td>".number_format($gofur,0,",",".")."</td>
  </tr>
  </tbody>
  </table>
  ";
}
?>
</main>
<?php
include 'foot.php';
?>