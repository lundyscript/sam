<?php
include 'head.php';
include 'navbar.php';
$no = $_GET['no'];
$query = mysql_query("SELECT *FROM hutang WHERE no='$no'") or die ('Error!!'.mysql_error());
$row = mysql_fetch_array ($query);
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">BAYAR HUTANG</h4>
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
    <input class="form-control form-control-sm" type="text" name="txtnama1" placeholder="<?php echo $row['nama1'] ?>" disabled>
  </div>
  <div class="form-group col-md-6">
    <label for="txtjumlah"><b>JUMLAH</b></label>
    <input class="form-control form-control-sm" type="number" name="txtjumlah" placeholder="<?php echo "Hutang saat ini : ".$row['jumlah'] ?>" required>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtnama2"><b>PEMBERI</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama2" placeholder="<?php echo $row['nama2'] ?>" disabled>
  </div>
  <div class="form-group col-md-6">
    <label for="txtket"><b>KETERANGAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtket" placeholder="<?php echo $row['ket'] ?>">
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){

  $jumlah  = $_POST['txtjumlah'];
  $jumlah  = $row['jumlah'] - $jumlah;
  $txtket  = ucfirst($_POST['txtket']);

  if ($jumlah==0) {
    $delete = mysql_query("DELETE FROM hutang WHERE no='$no'") or die ('Error!!'.mysql_error());
    if ($delete) {
      ?>
      <div class="alertsuccess fixed-top">
        <span class="closebtn" onclick="window.location.href='/SAM/php/htg.php';">&times;</span> 
        <strong>Alhamdulillah!</strong> Lunas! Terima kasih.
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
  }else{
    $update = mysql_query("UPDATE hutang SET tgl='$tanggal' , jumlah='$jumlah' , ket='$txtket' WHERE no='$no'") or die ('Error!!'.mysql_error());
    if ($update) {
      ?>
      <div class="alertsuccess fixed-top">
        <span class="closebtn" onclick="window.location.href='/SAM/php/htg.php';">&times;</span> 
        <strong>Success!</strong> Data has been updated!
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
}


include 'foot.php';
?>