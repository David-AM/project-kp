<?php
include("koneksi.php");

if (isset($_POST['save'])) {
    //Cek dan Simpan hanya 1 Kategori
    $result = mysqli_query($conn, "SELECT Kategori FROM kategori WHERE Kategori = '$_POST[kategori]'");
    // echo mysqli_num_rows($result) . "<br>";
    if (mysqli_num_rows($result) == 0) {                //Mengecek Apakah data input = DB (jika sama akan bernilai > 0)
        mysqli_query($conn, "INSERT INTO kategori SET Kategori = '$_POST[kategori]'");
    }

    //Simpan Pertanyaan, Kategori dan Nilai
    $pertanyaan = $_POST['pertanyaan'];
    for ($i = 0; $i < $_POST['jumlah']; $i++) {
        $add = mysqli_query($conn, "INSERT INTO pertanyaan SET
                                    Pertanyaan = '$pertanyaan[$i]',
                                    Kategori = '$_POST[kategori]',
                                    SP = '$_POST[SP]',
                                    P = '$_POST[P]',
                                    CP = '$_POST[CP]',
                                    KP = '$_POST[KP]',
                                    TP = '$_POST[TP]'");
    }
    echo "<script>alert('Data Berhasil di Simpan');
            document.location='Pertanyaan.php'</script>";
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
    <title>Admin | Add Question</title>
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

    
    <main class="flex justify-center items-center">
        <section class="h-full w-4/5">
            <form method="POST">
                <center>
                    <h1 class="font-inter font-bold text-3xl text-[#3E8EEE] text-center my-8">Data Pertanyaan</h1>
                </center>

                <div class="jumlah">
                    <h5 class="relative">Jumlah Pertanyaan : </h5>
                    <input type="text" name="jumlah" id="jumlah" class="my-6 relative  py-3 px-2 border-[0.1rem] border-solid rounded-xl w-8/12" value="" placeholder="Masukkan Jumlah Pertanyaan">
                    <input type="submit" name="submit" class="py-3 uppercase rounded-lg w-1/5 font-semibold text-white bg-[#3E8EEE] cursor-pointer" value="Submit" required>
                    <input type="button" class="py-3 uppercase rounded-lg w-1/5 font-semibold text-white bg-[#EE3E3E] cursor-pointer" name="cancel" value="Cancel" onclick="location.href='\Pertanyaan.php';">
                </div>

                <?php
                if (isset($_POST['submit'])) : ?>
                    <style>
                        .jumlah>input,
                        .jumlah>h5 {
                            display: none;
                        }
                    </style>
                    <h5 class="relative" style="margin-bottom:2rem">Banyak Pertanyaan : <?php echo $_POST['jumlah'] ?></h5>

                    <div class="flex flex-wrap gap-2">
                        <h5 class="relative">Kategori :</h5>
                        <input type="text" name="kategori" class="relative  p-4 border-[0.1rem] border-solid rounded-xl w-full" placeholder="Masukkan Kategori" style="margin-bottom:2rem" required>
                    </div>

                    <?php
                    for ($i = 1; $i <= $_POST['jumlah']; $i++) : ?>
                        <div class="flex flex-wrap gap-2">
                            <h5 class="relative">Pertanyaan : <?php echo $i ?></h5>
                            <textarea name="pertanyaan[]" cols="100" rows="5" class="relative bg-[#D9D9D9] p-4 border-[0.1rem] border-solid rounded-xl w-full" placeholder="Masukkan Pertanyaan" style="margin-bottom:1rem" required></textarea>
                        </div>
                    <?php endfor; ?>

                    <div class="my-6">
                        <h5 class="relative">Nilai Jawaban :</h5>
                        <div class="my-2 grid grid-cols-[20% 100%] items-center">
                            <h5 class="relative">Sangat Puas :</h5>
                            <input type="text" name="SP" class="relative bg-[#D9D9D9] px-4 py-3 border-[0.1rem] border-solid rounded-xl w-2/12" placeholder="Masukkan Nilai">
                        </div>
                        <div class="my-2 grid grid-cols-[20% 100%] items-center">
                            <h5 class="relative">Puas :</h5>
                            <input type="text" name="P" class="relative bg-[#D9D9D9] px-4 py-3 border-[0.1rem] border-solid rounded-xl w-2/12" placeholder="Masukkan Nilai">
                        </div>
                        <div class="my-2 grid grid-cols-[20% 100%] items-center">
                            <h5 class="relative">Cukup Puas :</h5>
                            <input type="text" name="CP" class="relative bg-[#D9D9D9] px-4 py-3 border-[0.1rem] border-solid rounded-xl w-2/12" placeholder="Masukkan Nilai">
                        </div>
                        <div class="my-2 grid grid-cols-[20% 100%] items-center">
                            <h5 class="relative">Kurang Puas :</h5>
                            <input type="text" name="KP" class="relative bg-[#D9D9D9] px-4 py-3 border-[0.1rem] border-solid rounded-xl w-2/12" placeholder="Masukkan Nilai">
                        </div>
                        <div class="my-2 grid grid-cols-[20% 100%] items-center">
                            <h5 class="relative">Tidak Puas :</h5>
                            <input type="text" name="TP" class="relative bg-[#D9D9D9] px-4 py-3 border-[0.1rem] border-solid rounded-xl w-2/12" placeholder="Masukkan Nilai">
                        </div>
                    </div>

                    <div class="flex gap-x-8 justify-center">
                        <input type="hidden" name="jumlah" value="<?php echo $_POST['jumlah']; ?>">
                        <input type="button" class="w-28 text-center my-20 py-2 rounded-lg relative border-none text-white text-xl font-semibold cursor-pointer bg-[#EE3E3E]" name="cancel" value="Cancel" onclick="location.href='\Pertanyaan.php';">
                        <input type="submit" class="w-28 text-center my-20 py-2 rounded-lg relative border-none text-white text-xl font-semibold cursor-pointer bg-[#3E8EEE]" name="save" value="Save">
                    </div>
                <?php endif; ?>
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