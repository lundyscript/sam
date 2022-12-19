<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-10">
<div class="alert alert-info text-center" role="alert"><b>Selamat Datang </b>di Sistem Administrasi MoyaMu - Universitas Muhammadiyah Jember</div>
<center>
<table class="table-sm">
  <tr>
    <td width="49%" class="text-right">NAMA</td>
    <td width="2%">:</td>
    <td width="49%"><?php echo $_SESSION['nama'];?></td>
  </tr>
  <tr>
    <td class="text-right">USERNAME</td>
    <td>:</td>
    <td><?php echo $_SESSION['username'];?></td>
  </tr>
  <tr>
    <td class="text-right">PASSWORD</td>
    <td>:</td>
    <td><?php echo $_SESSION['password'];?></td>
  </tr>
  <tr>
    <td colspan="3"><div class="logout text-center"><a href="eur.php">EDIT</a></div></td>
  </tr>
</table>
</center>
</main>
<?php
include 'foot.php';
?>