<?php
include "koneksi.php";
// include "setKaryawan.php";

$oNip = "";
$oNama = "";
$oDivisi = "-- Select Division --";
$oJabatan = "";
$oRole = "-- Select --";

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $temp = mysqli_query($conn, "SELECT * FROM karyawan WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($temp);
        if ($data) {
            $oNip = $data['Nip'];
            $oNama = $data['Nama'];
            $oDivisi = $data['Divisi'];
            $oJabatan = $data['Jabatan'];
            $oRole = $data['Role'];
        }
    }
}
if (isset($_POST['bsave'])) {
    if ($_GET['hal'] == "edit") {
        $edit = mysqli_query($conn, "UPDATE karyawan SET
                                                Nip = '$_POST[nip]',
                                                Nama = '$_POST[nama]', 
                                                Jabatan = '$_POST[jabatan]', 
                                                Divisi = '$_POST[divisi]', 
                                                Role = '$_POST[otoritas]'
                                        WHERE id = '$_GET[id]';
                            ");
        if ($edit) {
            echo "<script>
                alert('Edit Suksess');
                document.location='setKaryawan.php';
                </script>";
        } else {
            echo "<script>
                alert('Edit Gagal');
                document.location='setKaryawan.php';
                </script>";
        }
    }
    else{
    $save = mysqli_query($conn, "INSERT INTO karyawan (Nip, Nama, Jabatan, Divisi, Role)
                                        VALUE ('$_POST[nip]',
                                            '$_POST[nama]', 
                                            '$_POST[jabatan]', 
                                            '$_POST[divisi]', 
                                            '$_POST[otoritas]' 
                                            )
                                    ");
    if ($save) {
        echo "<script>
            alert('Simpan Suksess');
            document.location='setKaryawan.php';
        </script>";
    } else {
        echo "<script>
            alert('Simpan Gagal');
            document.location='setKaryawan.php';
        </script>";
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="img/icon.png" />
    <link rel="stylesheet" href="css/addUser.css">
    <title>Admin | Add User</title>
</head>

<body id="top">
    <header>
        <a href="Admin.php">
            <img class="logo" src="img/logo.png" alt="LOGO">
        </a>
        <div id="menu-bar" class="fas fa-bars"></div>
        <nav class="navbar">
        <a class="navbar-list" href="setPertanyaan.php">Setting Pertanyaan</a>
            <a class="navbar-list" href="setKaryawan.php">Setting Karyawan</a>
            <a class="navbar-list" href="/">Hasil Survey</a>
            <div class="dropdown">
                <!-- <span>Admin</span> -->
                <i onclick="myFunction()" id="profile" class="fas fa-user"></i>
                <i onclick="myFunction()" id="profile" class="fas fa-caret-down ml-2"></i>
                <div id="myDropdown" class="dropdown-content">
                    <a class="dropdown-item" href="login.php">
                        <i class="fas fa-trash"> Delete Account</i>
                    </a>
                    <a class="dropdown-item" href="logout.php">
                        <i class="fas fa-sign-out-alt"> Sign Out</i>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <form method="POST">
            <center>
                <h1 style="color: #3E8EEE; margin: 5% 0;">Data Karyawan PT. PAL Indonesia</h1>
            </center>

            <div class="user">
                <h5 class="title">NIP :</h5>
                <input type="number" name="nip" id="nip" value="<?= $oNip ?>" placeholder="Masukkan NIP" required>
                <h5 class="title">Nama :</h5>
                <input type="text" name="nama" id="nama" value="<?= $oNama ?>" placeholder="Masukkan Nama" required>
                <h5 class="title">Jabatan :</h5>
                <input type="text" name="jabatan" id="jabatan" value="<?= $oJabatan ?>" placeholder="Masukkan Jabatan" required>
            </div>
            <div class="pilih">
                <div class="divisi">
                    <h5 class="title">Divisi :</h5>
                    <select name="divisi" required>
                        <option value="<?= $oDivisi ?>" selected disabled><?= $oDivisi ?></option>
                        <option value="Divisi Rekayasa Umum">Divisi Rekayasa Umum</option>
                        <option value="Divisi Kapal Niaga">Divisi Kapal Niaga</option>
                        <option value="Divisi Kapal Perang">Divisi Kapal Perang</option>
                        <option value="Divisi Kapal Selam">Divisi Kapal Selam</option>
                        <option value="Divisi Pemeliharaan & Perbaikan">Divisi Pemeliharaan & Perbaikan</option>
                        <option value="Divisi Production Management Office">Divisi Production Management Office</option>
                        <option value="Divisi Pemasaran & Penjualan Kapal">Divisi Pemasaran & Penjualan Kapal</option>
                        <option value="Divisi Penjualan Rekumhar">Divisi Penjualan Rekumhar</option>
                        <option value="Divisi Supply Chain">Divisi Supply Chain</option>
                        <option value="Divisi Kawasan & K3LH">Divisi Kawasan & K3LH</option>
                        <option value="Divisi Perencanaan Strategis Perusahaan">Divisi Perencanaan Strategis Perusahaan</option>
                        <option value="Divisi Perbendaharaan">Divisi Perbendaharaan</option>
                        <option value="Divisi Akuntansi">Divisi Akuntansi</option>
                        <option value="Divisi Human Capital Management">Human Capital Management</option>
                        <option value="Divisi Manajemen Risiko">Divisi Manajemen Risiko</option>
                        <option value="Divisi Office Of The Beard">Of The Beard</option>
                        <option value="Divisi Legal">Divisi Legal</option>
                        <option value="Divisi Technology & Quality Assurance">Divisi Technology & Quality Assurance</option>
                        <option value="Divisi Teknologi Informasi">Divisi Teknologi Informasi</option>
                        <option value="Divisi Desain">Divisi Desain</option>
                    </select>
                </div>
                <div class="otoritas">
                    <h5 class="title">Otoritas :</h5>
                    <select name="otoritas" required>
                        <option value="<?= $oRole ?>" selected disabled><?= $oRole ?></option>
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="btn">
                <button name="bsave" class="save">Save</button>
                <a onclick="cancel();" href="setKaryawan.php" class="cancel">Cancel</a>
                <!-- <button onclick="cancel(); window.location.href='setKaryawan.php'" class="cancel">Cancel</button> -->
            </div>
        </form>
    </main>

    <a href="#top" class="fas fa-angle-up" id="scroll-top"></a>

    <!-- Script JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</body>

</html>