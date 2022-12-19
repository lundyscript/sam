<?php
session_start();
session_destroy();
echo "<script>window.location.href='/SAM/php/signin.php'</script>";
?>