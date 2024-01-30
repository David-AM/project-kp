<?php
session_start();
$temp = $_SESSION['Nama'];
$nama = explode(' ', $temp)[0];
// if(empty($_SESSION['Nip']) || $_SESSION['Role']!= 'admin'){
//   echo "<script>alert('Anda Harus Login Terlebih dahulu')</script>";
//   header('location:login.php');
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href=css/style.css>
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link rel="icon" sizes="192x192" href="img/icon.png">
  <title>ADMIN PAGE</title>
</head>

<body>
  <header>
    <img class="logo" src="img/logo.png" alt="LOGO">
    <div id="menu-bar" class="fas fa-bars"></div>
    <nav class="navbar">
      <a href="Setting_pertanyaan.php">Setting Pertanyaan</a>
      <a href="check_result.php">Setting User</a>
      <a href="history.php">Result</a>
      <div class="dropdown">
        <div id="profile" class="fas fa-user"></div>
        <div class="dropdown-content">
          <a href="logout.php">
          <i id="sign-out" class="fas fa-sign-out-alt"> Log Out</i>
          </a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <section class="home">
      <div class="circle-1"></div>
      <div class="circle-2"></div>
      <div class="circle-3"></div>
      <div class="content">
        <h3>Hello <?= $nama ?>...</h3>
        <h4>Welcome!</h4>
      </div>
    </section>
  </main>

  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>