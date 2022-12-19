<!-- Static navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark btco-hover-menu">
  <a class="navbar-brand" href="/SAM/php/">
    <img src="../img/drops1.png" width="30" height="30" class="d-inline-block align-top" alt="">
    SAM
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php 
      if ($_SESSION['level']=="admin" || $_SESSION['level']=="master") {
      ?>
      <!--<li class="nav-item"><a class="nav-link" href="abs.php">Absensi</a></li>-->
      <li class="nav-item"><a class="nav-link" href="pela.php">Pelanggan</a></li>
      <li class="nav-item"><a class="nav-link" href="penj.php">Penjualan</a></li>
      <li class="nav-item"><a class="nav-link" href="peng.php">Pengeluaran</a></li>
      <li class="nav-item"><a class="nav-link" href="pem.php">Pembelian</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Perhitungan</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="prbn.php">Bon</a></li>
          <li><a class="dropdown-item" href="prln.php">Lunas</a></li>
          <li><a class="dropdown-item" href="prgj.php">Keuntungan</a></li>
          <li><a class="dropdown-item" href="prhr.php">HR (Mingguan)</a></li>
          <li><a class="dropdown-item" href="prhrh.php">HR (Harian)</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="pro.php">Biaya Produksi</a></li>
          <li><a class="dropdown-item" href="hrg.php">Harga Jual</a></li>
          <li><a class="dropdown-item" href="htg.php">Hutang</a></li>
          <li><a class="dropdown-item" href="http://localhost/phpmyadmin/" target="_blank">Database</a></li>
      <?php
      }
      if ($_SESSION['level']=="karyawan") {
      ?>
          <li><a class="dropdown-item" href="penj.php">Penjualan</a></li>
          <li><a class="dropdown-item" href="peng.php">Pengeluaran</a></li>
          <li><a class="dropdown-item" href="htg.php">Hutang</a></li>
      <?php
      }
      ?>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class="logout"><?php echo "(".$_SESSION['nama'].") ".$hari.", ".$txttgl." - ";?> <a href="signout.php">Keluar</a></div>