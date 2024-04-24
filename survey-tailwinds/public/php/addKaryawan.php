<?php
include "koneksi.php";

$oNip = "";
$oNama = "";
$oDivisi = "-- Select Division --";
$oJabatan = "";
$oRole = "-- Select --";


if (($_GET['page'] == "edit")) {
    var_dump($oNip.$oNama.$oDivisi.$oJabatan.$oRole);
    $temp = mysqli_query($conn, "SELECT * FROM karyawan WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($temp);
        if ($data) {
            $oNip = $data['Nip'];
            $oNama = $data['Nama'];
            $oDivisi = $data['Divisi'];
            $oJabatan = $data['Jabatan'];
            $oRole = $data['Role'];
        }
    if (isset($_POST['bsave'])) {
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
                document.location='Karyawan.php';
                </script>";
        } else {
            echo "<script>
                alert('Edit Gagal');
                document.location='Karyawan.php';
                </script>";
        }
    }
} else {
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
            document.location='Karyawan.php';
        </script>";
    } else {
        echo "<script>
            alert('Simpan Gagal');
            document.location='Karyawan.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="../../src/img/icon.png">
    <!-- Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time() ?>">
    <title>Admin | Add User</title>
</head>

<style>
    .show {
        display: block;
    }

    #menu-list .activated {
        border-bottom: 5px solid black;
        bottom: 0;
        width: 100%;
        border-radius: 1px;
        transition: .5s ease;
        color: black;
    }

    #acc {
        font-size: 2.5rem;
    }

    /* #mode:checked ~ label div#toggle span {
        transform: rotate(180deg);
        transition: ease 2s;
    } */

    #mode:checked~label div#toggle {
        translate: 100%;
        transition: ease 1s;
    }

    #mode~label div#toggle {
        transition: ease 1s;
    }
</style>

<body class="box-border bg-white font-inter dark:bg-slate-700">
    <header class="top-0 sticky z-10">
        <nav class="bg-[#3E8EEE] text-white font-semibold flex justify-between items-center px-4 shadow-[0_.5rem_1rem_rgba(0,0,0,0.1)]">
            <a href="admin.php">
            <img src="../../src/img/logo.png" class="w-[250px] p-2 bg-white rounded-lg" alt="logo">
            </a>
            <ul class="flex gap-2" id="nav">
                <li id="menu-list">
                    <a href="admin.php" class="inline-block py-4 px-2 transition-all ease-linear duration-200 group">
                        <!-- <span class="material-symbols-outlined">assignment</span> -->
                        <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2" id="menu">
                            Home</p>
                    </a>
                </li>
                <li id="menu-list">
                    <a href="Pertanyaan.php" class="inline-block py-4 px-2 transition-all ease-linear duration-200 group">
                        <!-- <span class="material-symbols-outlined">assignment</span> -->
                        <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2" id="menu">
                            Pertanyaan</p>
                    </a>
                </li>
                <li id="menu-list">
                    <a href="Karyawan.php" class="inline-block py-4 px-2 transition-all ease-linear duration-200 group">
                        <!-- <span class="material-symbols-outlined">manage_accounts</span> -->
                        <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2" id="menu">
                            Karyawan</p>
                    </a>
                </li>
                <li id="menu-list">
                    <div class="relative inline-block py-4 px-2 transition-all ease-linear duration-200 cursor-pointer group">
                        <!-- <span class="material-symbols-outlined">table_chart_view</span> -->
                        <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2 group-hover:block" id="menu">Hasil</p>
                        <div class="hidden absolute bg-white w-max z-10 rounded-lg  group-hover:block">
                            <a href="Hasil.php" class="text-[#3E8EEE] px-4 py-3 decoration-0 flex gap-3 hover:text-black">
                                <span class="material-symbols-outlined">data_table</span>
                                <p>Tabel</p>
                            </a>
                            <a href="Chart.php" class="text-[#3E8EEE] px-4 py-3 decoration-0 flex gap-3 hover:text-black">
                                <span class="material-symbols-outlined">bar_chart_4_bars</span>
                                <p>Grafik</p>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="material-symbols-outlined py-4 px-2 cursor-pointer" onclick="profile()" id="profile">Account_Circle</span>
                    <div class="profile-menu absolute hidden right-2 bg-white p-3 rounded-lg text-sky-500 text-xs" id="profile-menu">
                        <div class="flex gap-3 justify-center">
                            <span class="material-symbols-outlined" id="acc">Account_Circle</span>
                            <div class="text-start">
                                <p class="text-sm"><?= $_SESSION['Nama'] ?></p>
                                <p class="text-xs"><?= $_SESSION['Jabatan'] ?></p>
                            </div>
                        </div>

                        <hr class="border border-sky-500 my-4">

                        <label for="mode" class="flex gap-3 justify-between items-center cursor-pointer">
                            <p>Dark Mode</p>
                            <div>
                                <input type="checkbox" name="mode" id="mode" class="hidden">
                                <label for="mode" class="cursor-pointer">
                                    <div class="flex items-center w-8 h-5 rounded-full bg-slate-400 p-1">
                                        <div class="w-3 h-3 rounded-full bg-white flex items-center justify-center" id="toggle"></div>
                                    </div>
                                </label>
                            </div>
                        </label>

                        <a href="login.php" class="flex items-center gap-3 mt-4">
                            <span class="material-symbols-outlined">Logout</span>
                            <p>Signout</p>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!--  -->
    <main class="flex justify-center items-center">
        <section class="h-full w-4/5">
            <form method="POST">
                <center>
                    <h1 class="font-inter font-bold text-3xl text-[#3E8EEE] text-center my-8">Data Karyawan PT. PAL Indonesia</h1>
                </center>

                <div class="flex flex-wrap gap-2">
                    <h5 class="relative">NIP :</h5>
                    <input type="number" name="nip" id="nip" class="relative bg-[#D9D9D9] py-3 px-4 border-[0.1rem] border-solid  rounded-xl w-full mb-8 focus:outline-none" value="<?= $oNip ?>" placeholder="Masukkan NIP" required>
                    <h5 class="relative">Nama :</h5>
                    <input type="text" name="nama" id="nama" class="relative bg-[#D9D9D9] py-3 px-4 border-[0.1rem] border-solid  rounded-xl w-full mb-8 focus:outline-none" value="<?= $oNama ?>" placeholder="Masukkan Nama" required>
                    <h5 class="relative">Jabatan :</h5>
                    <input type="text" name="jabatan" id="jabatan" class="relative bg-[#D9D9D9] py-3 px-4 border-[0.1rem] border-solid  rounded-xl w-full mb-8 focus:outline-none" value="<?= $oJabatan ?>" placeholder="Masukkan Jabatan" required>
                </div>
                <div class="grid grid-cols-2 gap-12">
                    <div class="flex items-center gap-12">
                        <h5 class="relative">Divisi :</h5>
                        <select name="divisi" class="h-12 w-4/6 font-semibold text-center py-3 px-4 border-[0.1rem] border-solid rounded-xl appearance-none bg-[#D9D9D9] cursor-pointer focus:outline-none">
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="<?= $oDivisi ?>" selected disabled><?= $oDivisi ?></option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Rekayasa Umum">Divisi Rekayasa Umum</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Kapal Niaga">Divisi Kapal Niaga</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Kapal Perang">Divisi Kapal Perang</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Kapal Selam">Divisi Kapal Selam</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Pemeliharaan & Perbaikan">Divisi Pemeliharaan & Perbaikan</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Production Management Office">Divisi Production Management Office</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Pemasaran & Penjualan Kapal">Divisi Pemasaran & Penjualan Kapal</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Penjualan Rekumhar">Divisi Penjualan Rekumhar</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Supply Chain">Divisi Supply Chain</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Kawasan & K3LH">Divisi Kawasan & K3LH</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Perencanaan Strategis Perusahaan">Divisi Perencanaan Strategis Perusahaan</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Perbendaharaan">Divisi Perbendaharaan</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Akuntansi">Divisi Akuntansi</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Human Capital Management">Human Capital Management</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Manajemen Risiko">Divisi Manajemen Risiko</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Office Of The Beard">Of The Beard</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Legal">Divisi Legal</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Technology & Quality Assurance">Divisi Technology & Quality Assurance</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Teknologi Informasi">Divisi Teknologi Informasi</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Divisi Desain">Divisi Desain</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-12">
                        <h5 class="relative">Otoritas :</h5>
                        <select name="otoritas" class="h-12 w-4/6 font-semibold text-center py-3 px-4 border-[0.1rem] border-solid rounded-xl appearance-none bg-[#D9D9D9] cursor-pointer focus:outline-none">
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="<?= $oRole ?>" selected disabled><?= $oRole ?></option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="User">User</option>
                            <option class="text-[#3E8EEE] font-semibold disabled:text-[#CCC]" value="Admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-x-8 justify-center">
                    <input type="button" class="w-28 text-center my-20 py-2 rounded-lg relative border-none text-white text-xl font-semibold cursor-pointer bg-[#EE3E3E]" name="cancel" value="Cancel" onclick="location.href='Karyawan.php';">
                    <button name="bsave" class="w-28 text-center my-20 py-2 rounded-lg relative border-none text-white text-xl font-semibold cursor-pointer bg-[#3E8EEE]">Save</button>
                    <!-- <button onclick="cancel(); window.location.href='Karyawan.php'" class="cancel">Cancel</button> -->
                </div>
            </form>
        </section>
    </main>

    <script>
        //Dropdown Profile
        function profile() {
            document.getElementById("profile-menu").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (event.target.id !== "profile") {
                let dropdowns = document.getElementsByClassName("profile-menu");
                for (let i = 0; i < dropdowns.length; i++) {
                    let openDropdown = dropdowns[i];

                    if (openDropdown.classList.contains("show")) {
                        openDropdown.classList.remove("show");
                    }
                }
            }
        }

        let mode = document.querySelector('#mode');
        let html = document.querySelector('html');

        mode.addEventListener('click', function() {
            mode.checked ? html.classList.add('dark') : html.classList.remove('dark');
        })
    </script>
</body>

</html>