<?php
session_start();
$temp = $_SESSION['Nama'];
$nama = explode(' ', $temp)[0];
if($nama == '.'){
  $nama = explode(' ', $temp)[1];
}
if(empty($_SESSION['Nip']) || $_SESSION['Role']!= 'Admin'){
  echo "<script>
        alert('Anda Harus Login Terlebih dahulu')
        </script>";
  header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="icon" sizes="192x192" href="img/icon.png">
    <title>Admin | Home</title>
  </head>

  <body>
    <header>
      <a href="admin.php">
        <img class="logo" src="img/logo.png" alt="LOGO">
      </a>
      <div id="menu-bar" class="fas fa-bars"></div>
      <nav class="navbar">
      <a class="navbar-list" href="setPertanyaan.php">Setting Pertanyaan</a>
            <a class="navbar-list" href="setKaryawan.php">Setting Karyawan</a>
          <a class="navbar-list" href="history.php">Hasil Survey</a>
          <div class="dropdown">
            <!-- <span>Admin</span> -->
            <i onclick="myFunction()" id="profile" class="fas fa-user"></i>
            <i onclick="myFunction()" id="profile" class="fas fa-caret-down ml-2"></i>
            <div id="myDropdown" class="dropdown-content">
              <a class="dropdown-item" href="login.php">
                <i class="fas fa-trash"> Delete Account</i>
              </a>
              <a class="dropdown-item" href="logout.php">
                <i class="fas fa-sign-out-alt"> Log Out</i>
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
      
    <!-- Script JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  </body>
</html>