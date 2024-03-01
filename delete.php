<?php
session_start();
include('koneksi.php');

$id = $_GET['id'];

$delete = mysqli_query($conn, "DELETE FROM pertanyaan WHERE id=$id");

if ($delete){
    //set session sukses
    $_SESSION["sukses"] = 'Data Berhasil Di Hapus';
}else {
    //set session gagal
    $_SESSION["gagal"] = 'Data Tidak Berhasil Di Hapus';
}


header("location:setPertanyaan.php");
?>