<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">PEMBELIAN BARANG</h4>
<hr />
<form method="post">
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txttgl"><b>TANGGAL NOTA</b></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="txttgl" placeholder="00/00/0000" value="<?php echo $txttgl; ?>" required>
  </div>
  <div class="form-group col-md-6">
    <label for="txtnama"><b>NAMA BARANG</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama" required>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtjumlah"><b>JUMLAH BARANG</b></label>
    <input class="form-control form-control-sm" type="number" name="txtjumlah" required>
  </div>
  <div class="form-group col-md-6">
    <label for="txtharga"><b>HARGA BARANG</b></label>
    <input class="form-control form-control-sm" type="number" name="txtharga" required>
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){
  $query  = mysql_query("SELECT max(no) AS nom FROM barang");
  $data   = mysql_fetch_assoc($query);
  $no   = (int) substr($data['nom'],0,5);
  $nomor  = $no+1;
  $txttgl    = $_POST['txttgl'];
  $arr       = explode('/', $txttgl);
  $txttgl    = $arr[2].'-'.$arr[1].'-'.$arr[0];
  $txtnama   = ucwords($_POST['txtnama']);
  $txtjumlah = $_POST['txtjumlah'];
  $txtharga  = $_POST['txtharga'];
  $total     = ($txtjumlah * $txtharga);
  
  $insert = mysql_query("INSERT INTO barang VALUES('$nomor','$txttgl','$txtnama','$txtjumlah','$txtharga','$total')") or die ('Error!!'.mysql_error());
  if ($insert) {
    ?>
    <div class="alertsuccess fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/pem.php';">&times;</span> 
      <strong>Success!</strong> New data has been added!
    </div>
    <?php
    }else{
    ?>
    <div class="alerterror fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/pem.php';">&times;</span> 
      <strong>ERROR!</strong>
    </div>
    <?php
  }
}


include 'foot.php';
?>