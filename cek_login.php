<?php

include "koneksi.php";

$nip = mysqli_escape_string($koneksi, $_POST['Nip']);

$cek_user = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE Nip = '$nip'");
$user_valid = mysqli_fetch_array($cek_user);


if($user_valid){
    session_start();
    $_SESSION["Nip"] = $user_valid["Nip"];
    $_SESSION['Nama'] = $user_valid['Nama'];
    $_SESSION['Jabatan'] = $user_valid['Jabatan'];
    $_SESSION['Divisi'] = $user_valid['Divisi'];
    $_SESSION['Role'] = $user_valid['Role'];

    if($user_valid['Role']=="admin"){
        header('location:Admin.php');
    }
    else{
    header('location:User.php');
    }
}
echo "<script>alert('Nip Tidak Ada')
      document.location='login.php'
      </script>";
?>