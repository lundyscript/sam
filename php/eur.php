<?php
include 'head.php';
include 'navbar.php';
$idu = $_SESSION['iduser'];
$query = mysql_query("SELECT *FROM user WHERE iduser='$idu'") or die ('Error!!'.mysql_error());
$row = mysql_fetch_array ($query);
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">EDIT PROFIL</h4>
<hr />
<form method="post">
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="txtnama"><b>NAMA</b></label>
    <input class="form-control form-control-sm" type="text" name="txtnama" placeholder="<?php echo $row['nama'] ?>" required>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="txtbarang"><b>USERNAME</b></label>
    <input class="form-control form-control-sm" type="text" name="txtusername" placeholder="<?php echo $row['username'] ?>" required>
  </div>
  <div class="form-group col-md-6">
    <label for="txtjumlah"><b>PASSWORD</b></label>
    <input class="form-control form-control-sm" type="password" name="txtpassword" placeholder="<?php echo md5($row['password']) ?>" required>
  </div>
</div>
<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Simpan</button>
</form>
</main>
<?php
if(isset ($_POST['submit'])){
  $nama     = ucfirst($_POST['txtnama']);
  $username = $_POST['txtusername'];
  $password = md5($_POST['txtpassword']);


  $update = mysql_query("UPDATE user SET nama='$nama', username='$username', password='$password' WHERE iduser='$idu'") or die ('Error!!'.mysql_error());
  if ($update) {
    ?>
    <div class="alertsuccess fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/signout.php';">&times;</span> 
      <strong>Success!</strong> Data has been changed! Please Sign In.
    </div>
    <?php
    }else{
    ?>
    <div class="alerterror fixed-top">
      <span class="closebtn" onclick="window.location.href='/SAM/php/';">&times;</span> 
      <strong>ERROR!</strong>
    </div>
    <?php
  }
}


include 'foot.php';
?>