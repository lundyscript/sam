<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/drops1.png">
    <title>SISTEM ADMINISTRASI MOYAMU</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/sam.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
    <!-- Custom JS -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script>
    <script type="text/javascript" src="http://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.css">

    <!-- Single Datepicker -->
    <meta charset='UTF-8'><meta name="robots" content="noindex">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css'>

  </head>
  <body>
  </br></br>
  <center>
    <img class="mb-2" src="../img/drops1.png" alt="" width="120"></br>
    <img class="mb-6 sam" src="../img/sam.png" alt="">
  </center>
  <div class="container-fluid text-center">
    <form class="form-signin" method="post">
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="text" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      <p class="mt-3 mb-3 text-muted">&copy;2018</p>
    </form>
  </div>
<?php
include 'foot.php';
include "koneksi.php";
if(isset ($_POST['submit'])){
  $pass     = md5($_POST['inputPassword']); 
  $query    = mysql_query("SELECT *FROM user WHERE username = '$_POST[inputUsername]' AND password = '$pass'"); 
  $data     = mysql_fetch_array($query);
  $hasil    = mysql_num_rows($query);
  if($hasil > 0 ){
    $_SESSION['iduser']   = $data['iduser']; 
    $_SESSION['username'] = $data['username']; 
    $_SESSION['password'] = $data['password']; 
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['level']    = $data['level'];
    $_SESSION['timestamp'] = time();
    echo "<script>window.location.href='/SAM/php/'</script>";
  }else{
    ?>
    <div class="alerterror fixed-top">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Error Message :</strong> The username or password is incorrect.
    </div>
    <?php
  }
} 
?>