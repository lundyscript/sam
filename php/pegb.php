<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">PENGELUARAN BARU</h4>
<hr />
<form method="post">
<div class="form-row">
  <div class="form-group col-md-12">
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
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtjenis"><b>JENIS PENGELUARAN</b></label>
    <select class="form-control form-control-sm" name="txtjenis">
      <option value="operasional">OPERASIONAL</option>
      <option value="produksi">PRODUKSI</option>
    </select>
  </div>
  <div class="form-group col-md-6">
    <label for="txttgl"><b>TANGGAL NOTA</b></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="txttgl" placeholder="00/00/0000" value="<?php echo $txttgl; ?>" required>
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){
  $txtjenis  = $_POST['txtjenis'];
  $query  = mysql_query("SELECT max(no) AS nom FROM ".$txtjenis."");
  $data   = mysql_fetch_assoc($query);
  $no   = (int) substr($data['nom'],0,5);
  $nomor  = $no+1;
  if($txtjenis=="operasional"){
    $idpe = "OP".$nomor;
  }else if($txtjenis=="produksi"){
    $idpe = "PR".$nomor;
  }
  $txtnama   = ucwords($_POST['txtnama']);
  $txtjumlah = $_POST['txtjumlah'];
  $txtharga  = $_POST['txtharga'];
  $total     = ($txtjumlah * $txtharga);
  $txttgl    = $_POST['txttgl'];
  $arr       = explode('/', $txttgl);
  $txttgl    = $arr[2].'-'.$arr[1].'-'.$arr[0];

  $insert = mysql_query("INSERT INTO ".$txtjenis." VALUES('$nomor','$idpe','$txtnama','$txtjumlah','$txtharga',$total,'$txttgl')") or die ('Error!!'.mysql_error());
  if ($insert) {
    ?>
    <div class="alertsuccess fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/peng.php';">&times;</span> 
      <strong>Success!</strong> New data has been added!
    </div>
    <?php
    }else{
    ?>
    <div class="alerterror fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/peng.php';">&times;</span> 
      <strong>ERROR!</strong>
    </div>
    <?php
  }
}


include 'foot.php';
?>