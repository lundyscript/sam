<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">PELANGGAN BARU</h4>
<hr />
<form method="post">
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="txtnama"><b>NAMA PELANGGAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama" required>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtalamat"><b>ALAMAT</b></label>
    <input class="form-control form-control-sm" type="text" name="txtalamat">
  </div>
  <div class="form-group col-md-6">
    <label for="txtkec"><b>KECAMATAN</b></label>
    <input class="form-control form-control-sm" type="text" name="txtkec">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="txtnotel"><b>NO. TELPON</b></label>
    <input class="form-control form-control-sm" type="number" name="txtnotel"> 
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){
  $cari = mysql_query("SELECT max(no) AS nom FROM pelanggan");
  $data = mysql_fetch_assoc($cari);
  $no = (int) substr($data['nom'],0,5);
  $nomor = $no+1;
  $idp = "P".$nomor;
  $nama   = ucwords($_POST['txtnama']);
  $alamat = ucwords($_POST['txtalamat']);
  $area   = ucwords($_POST['txtkec']);
  $telp   = $_POST['txtnotel'];

  $insert = mysql_query("INSERT INTO pelanggan VALUES('$nomor','$idp','$nama','$alamat','$area','$telp')") or die ('Error!!'.mysql_error());
  if ($insert) {
    ?>
    <div class="alertsuccess fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/pela.php';">&times;</span> 
      <strong>Success!</strong> New data has been added!
    </div>
    <?php
    }else{
    ?>
    <div class="alerterror fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/pelb.php';">&times;</span> 
      <strong>ERROR!</strong>
    </div>
    <?php
  }
}


include 'foot.php';
?>