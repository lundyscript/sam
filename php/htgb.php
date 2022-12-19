<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">HUTANG BARU</h4>
<hr />
<form method="post">
<div class="form-row">
   <div class="form-group col-md-12">
    <label for="txttgl"><b>TANGGAL</b></label>
    <input class="form-control form-control-sm" type="text" name="txttgl" placeholder="<?php echo $txttgl ?>" disabled>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtnama1"><b>PENERIMA</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama1" required>
  </div>
  <div class="form-group col-md-6">
    <label for="txtjumlah"><b>JUMLAH</b></label>
    <input class="form-control form-control-sm" type="number" name="txtjumlah" required>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtnama2"><b>PEMBERI</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama2" required>
  </div>
  <div class="form-group col-md-6">
    <label for="txtket"><b>KETERANGAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtket">
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){
  $cari = mysql_query("SELECT max(no) AS nom FROM hutang");
  $data = mysql_fetch_assoc($cari);
  $no = (int) substr($data['nom'],0,5);
  $nomor = $no+1;
  $nama1  = ucfirst($_POST['txtnama1']);
  $jumlah = $_POST['txtjumlah'];
  $nama2  = ucfirst($_POST['txtnama2']);
  $txtket = ucfirst($_POST['txtket']);

  $insert = mysql_query("INSERT INTO hutang VALUES('$nomor','$tanggal','$nama1','$jumlah','$nama2','$txtket')") or die ('Error!!'.mysql_error());
  if ($insert) {
    ?>
    <div class="alertsuccess fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/htg.php';">&times;</span> 
      <strong>Success!</strong> Data has been added!
    </div>
    <?php
    }else{
    ?>
    <div class="alerterror fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/htg.php';">&times;</span> 
      <strong>ERROR!</strong>
    </div>
    <?php
  }
}


include 'foot.php';
?>