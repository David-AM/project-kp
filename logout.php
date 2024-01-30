<?php
session_start();
unset($_SESSION['Nip']);
session_destroy();
header('Location: login.php');
echo "<script>alert('Anda telah logout')</script>";
?>
