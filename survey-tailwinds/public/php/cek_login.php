<?php
include "koneksi.php";
$nip = mysqli_escape_string($conn, $_POST['Nip']);

$cek_user = mysqli_query($conn, "SELECT * FROM karyawan WHERE Nip = '$nip'");
$user_valid = mysqli_fetch_array($cek_user);


if ($user_valid) {
    session_start();
    $_SESSION["Nip"] = $user_valid["Nip"];
    $_SESSION['Nama'] = $user_valid['Nama'];
    $_SESSION['Jabatan'] = $user_valid['Jabatan'];
    $_SESSION['Divisi'] = $user_valid['Divisi'];
    $_SESSION['Role'] = $user_valid['Role'];

    $_SESSION['last_login_timestamp'] = time();
      
    $sql = "SELECT * FROM rekap WHERE NIP = '$nip'";
    $result = mysqli_query($conn, $sql);

    if ($user_valid['Role'] == "Admin") {
        header("location:Admin.php");
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Anda Sudah Mengisi')
            document.location='login.php'
            </script>";
        } else {
            header('location:user.php');
        }
    }
}

// echo "<script>alert('Nip Tidak Ada')
//       document.location='login.php'
//       </script>";
