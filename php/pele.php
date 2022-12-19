<?php
include 'head.php';
include 'navbar.php';
$idp = $_GET['idp'];
$query = mysql_query("SELECT *FROM pelanggan WHERE idp='$idp'") or die ('Error!!'.mysql_error());
$row = mysql_fetch_array ($query);
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">EDIT DATA PELANGGAN</h4>
<hr />
<form method="post">
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="txtnama"><b>NAMA PELANGGAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama" placeholder="<?php echo $row['nama'] ?>" required >
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtalamat"><b>ALAMAT</b></label>
    <input class="form-control form-control-sm" type="text" name="txtalamat" placeholder="<?php echo $row['alamat'] ?>">
  </div>
  <div class="form-group col-md-6">
    <label for="txtkec"><b>KECAMATAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtkec" placeholder="<?php echo $row['area'] ?>">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="txtnotel"><b>NO. TELPON</b></label>
    <input class="form-control form-control-sm" type="number" name="txtnotel" placeholder="<?php echo $row['telp'] ?>"> 
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){
  $nama   = ucfirst($_POST['txtnama']);
  $alamat = ucfirst($_POST['txtalamat']);
  $area   = ucfirst($_POST['txtkec']);
  $telp   = $_POST['txtnotel'];

  $update = mysql_query("UPDATE pelanggan SET nama='$nama', alamat='$alamat', area='$area', telp='$telp' WHERE idp='$idp'") or die ('Error!!'.mysql_error());
  if ($update) {
    ?>
    <div class="alertsuccess fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/pela.php';">&times;</span> 
      <strong>Success!</strong> Data has been changed!
    </div>
    <?php
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