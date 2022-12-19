<?php
include 'head.php';
include 'navbar.php';
$idp = $_GET['idp'];
$query = mysql_query("SELECT *FROM pelanggan WHERE idp='$idp'") or die ('Error!!'.mysql_error());
$row = mysql_fetch_array ($query);
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">PENJUALAN BARU</h4>
<hr />
<form method="post">
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="txtnama"><b>NAMA PELANGGAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama" value="<?php echo $row['nama'] ?>" disabled >
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtbarang"><b>NAMA BARANG</b></label>
    <select class="form-control form-control-sm" name="txtbarang">
      <?php
      $query = mysql_query("SELECT *FROM harga ORDER BY idh")or die("Error!!".mysql_error());
      while ($row = mysql_fetch_array ($query)) {
        extract($row);
        echo "
        <option value='".$idh."'>".$tipe." - ".$harga."</option>
        ";
      }
      ?>
    </select>
  </div>
  <div class="form-group col-md-6">
    <label for="txtjumlah"><b>JUMLAH BARANG</b></label>
    <input class="form-control form-control-sm" type="number" name="txtjumlah" required>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="txtbayar"><b>PEMBAYARAN</b></label>
    <select class="form-control form-control-sm" name="txtbayar" required>
      <option value="Tunai">Tunai</option>
      <option value="Bon">Bon</option>
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtket"><b>KETERANGAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtket">
  </div>
  <div class="form-group col-md-6">
    <label for="txttgl"><b>TANGGAL NOTA</b></label>
    <input type="text" class="form-control form-control-sm datepicker" id="datepicker" name="txttgl" placeholder="00/00/0000" value="<?php echo $txttgl; ?>" required>
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){
  $cari = mysql_query("SELECT max(no) AS nom FROM penjualan");
  $data = mysql_fetch_assoc($cari);
  $no = (int) substr($data['nom'],0,5);
  $nomor = $no+1;
  $idj = "J".$nomor;
  $idh       = $_POST['txtbarang'];
  $jmlh      = $_POST['txtjumlah'];
  $cariharga = mysql_query("SELECT *FROM harga WHERE idh='$idh'");
  $dataharga = mysql_fetch_assoc($cariharga);
  $harga     = $dataharga['harga'];
  $tipe      = $dataharga['tipe'];
  $total     = $jmlh * $harga;
  $bayar     = ucfirst($_POST['txtbayar']);
  $txtket    = ucfirst($_POST['txtket']);
  $txttgl    = strtoupper($_POST['txttgl']);
  $arr       = explode('/', $txttgl);
  $txttgl    = $arr[2].'-'.$arr[1].'-'.$arr[0];
  $tgllns    = "0000-00-00";

  $insert = mysql_query("INSERT INTO penjualan VALUES('$nomor','$idj','$idp','$idh','$tipe','$jmlh','$harga','$total','$bayar','$txtket','$txttgl','$tgllns')") or die ('Error!!'.mysql_error());
  if ($insert) {
      echo "<script>window.location.href='/SAM/php/pela.php';</script>";
    }else{
      ?>
      <div class="alerterror fixed-top">
        <span class="closebtn" onclick="window.location.href='/SAM/php/pela.php';">&times;</span> 
        <strong>ERROR!</strong>
      </div>
      <?php
  }

}


include 'foot.php';
?>