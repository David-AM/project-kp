<?php
session_start();
unset($_SESSION['Nip']);
session_destroy();
echo "<script>alert('Anda telah logout')</script>";
header('Location: login.php');
?>
