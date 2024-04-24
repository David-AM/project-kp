<?php
include("koneksi.php");

session_start();

$kategoriQuery = "SELECT DISTINCT Kategori FROM pertanyaan";
$kategoriResult = mysqli_query($conn, $kategoriQuery);

// Ambil pertanyaan pertama dari kategori pertama
$kategoriIndex = isset($_GET['kategori']) ? intval($_GET['kategori']) : 0;
$kategoriResult->data_seek($kategoriIndex);
$kategoriSekarang = mysqli_fetch_assoc($kategoriResult)['Kategori'];

$pertanyaanQuery = "SELECT * FROM pertanyaan WHERE Kategori = '$kategoriSekarang'";
$pertanyaanResult = mysqli_query($conn, $pertanyaanQuery);

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        // Simpan nilai radio button ke dalam sesi
        if (strpos($key, 'radio_') === 0) {
            $_SESSION[$key] = $value;
        }
    }
}

// Ambil nilai radio button dari sesi jika ada
$radioValues = array();
foreach ($_SESSION as $key => $value) {
    if (strpos($key, 'radio_') === 0) {
        $radioValues[$key] = $value;
    }
}


if (isset($_POST['next'])) {
    echo "<script>document.location = '?kategori=" . $kategoriIndex + 1 . "' </script>";
}
if (isset($_POST['next']) || isset($_POST['finish'])) {
    while ($pertanyaan = mysqli_fetch_assoc($pertanyaanResult)) {
        $userAnswer = "radio_" . $pertanyaan['id'];
        $jawabanResult = mysqli_query($conn, "SELECT Pertanyaan FROM jawaban WHERE Pertanyaan = '$pertanyaan[Pertanyaan]'");
        if (mysqli_num_rows($jawabanResult) == 1 && !empty($userAnswer)) {
            mysqli_query($conn, "UPDATE jawaban SET Nilai = '$_POST[$userAnswer]' WHERE Pertanyaan = '$pertanyaan[Pertanyaan]'");
        } else {
            mysqli_query($conn, "INSERT INTO jawaban SET
                        NIP = $_SESSION[Nip],
                        Kategori = '$pertanyaan[Kategori]', 
                        Pertanyaan = '$pertanyaan[Pertanyaan]',
                        Nilai = '$_POST[$userAnswer]'");
        }
    }
}

if (isset($_POST['finish'])) {
    // Perintah SQL untuk menyimpan nilai ke dalam tabel rekap
    $rekapQuery = "INSERT INTO rekap (NIP, Kategori, Total) 
                    SELECT $_SESSION[Nip], Kategori, SUM(Nilai) AS total FROM jawaban GROUP BY Kategori";
    // Eksekusi perintah SQL
    mysqli_query($conn, $rekapQuery);
    echo '<script>';
    echo 'if (confirm("Apakah Anda yakin ingin menyelesaikan survey?")) {';
    echo '  window.location.href = "login.php";'; // Arahkan ke login.php jika "OK" diklik
    echo '}';
    echo '</script>';

    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <!-- <script src="https://kit.fontawesome.com/a81368914c.js"></script> -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <title>Document</title>
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

    main>form>#card {
        /* Awalnya kartu tidak terlihat */
        animation-duration: 1s;
        animation-fill-mode: forwards;
    }

    /* Animasi untuk kartu ganjil */
    .slideInRight {
        animation-name: slideInRight;
    }

    /* Animasi untuk kartu genap */
    .slideInLeft {
        animation-name: slideInLeft;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
<?php
if (isset($_SESSION["Nip"])) {
    if ((time() - $_SESSION['last_login_timestamp']) > 30) // 900 = 15 * 60  
    {
        header("location:logout.php");
    } else {
        $_SESSION['last_login_timestamp'] = time(); ?>

        <body class="box-border bg-white font-inter dark:bg-slate-700">
            <header class="top-0 sticky z-10">
                <nav class="bg-[#3E8EEE] text-white font-semibold flex justify-between items-center px-4 shadow-[0_.5rem_1rem_rgba(0,0,0,0.1)]">
                    <a href="admin.php">
            <img src="../../src/img/logo.png" class="w-[250px] p-2 bg-white rounded-lg" alt="logo">
            </a>
                    <ul class="flex gap-5" id="nav">
                        <li>

                            <label for="profile" class="cursor-pointer flex gap-3 items-center">
                                <p><?= $_SESSION['Nama'] ?></p>
                                <span class="material-symbols-outlined py-4 px-2 cursor-pointer" onclick="profile()" id="profile">Account_Circle</span>
                            </label>
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

            <main>
                
                <form method="POST" class="flex flex-col items-center">
                    <h1 class="text-4xl my-10 font-semibold">Survey Karyawan PT. PAL Indonesia</h1>
                    <?php while ($pertanyaan = mysqli_fetch_assoc($pertanyaanResult)) :
                        $animationClass = ($pertanyaan['id'] % 2 == 0) ? 'slideInRight' : 'slideInLeft'; ?>
                        <div id="card" class="<?= $animationClass ?> w-3/5 p-4 bg-white rounded-lg mb-8 box-border break-words relative overflow-hidden opacity-0 border">
                            <p class="my-4 text-xl text-center"><?= $pertanyaan['Pertanyaan'] ?></p>
                            <div class="flex gap-4 my-4 items-center justify-center">
                                <h6>Tidak Puas</h6>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $pertanyaan['TP'] ?>" class="appearance-none w-8 h-8 border border-[#3E8EEE] rounded-full outline-none cursor-pointer shadow-[0_0_5px_0_rgba(62,142,238,1)] before:block before:w-3/5 before:h-3/5 before:my-[20%] before:mx-auto before:rounded-full checked:before:bg-[#3E8EEE]" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $pertanyaan['TP']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $pertanyaan['KP'] ?>" class="appearance-none w-8 h-8 border border-[#3E8EEE] rounded-full outline-none cursor-pointer shadow-[0_0_5px_0_rgba(62,142,238,1)] before:block before:w-3/5 before:h-3/5 before:my-[20%] before:mx-auto before:rounded-full checked:before:bg-[#3E8EEE]" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $pertanyaan['KP']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $pertanyaan['CP'] ?>" class="appearance-none w-8 h-8 border border-[#3E8EEE] rounded-full outline-none cursor-pointer shadow-[0_0_5px_0_rgba(62,142,238,1)] before:block before:w-3/5 before:h-3/5 before:my-[20%] before:mx-auto before:rounded-full checked:before:bg-[#3E8EEE]" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $pertanyaan['CP']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $pertanyaan['P'] ?>" class="appearance-none w-8 h-8 border border-[#3E8EEE] rounded-full outline-none cursor-pointer shadow-[0_0_5px_0_rgba(62,142,238,1)] before:block before:w-3/5 before:h-3/5 before:my-[20%] before:mx-auto before:rounded-full checked:before:bg-[#3E8EEE]" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $pertanyaan['P']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $pertanyaan['SP'] ?>" class="appearance-none w-8 h-8 border border-[#3E8EEE] rounded-full outline-none cursor-pointer shadow-[0_0_5px_0_rgba(62,142,238,1)] before:block before:w-3/5 before:h-3/5 before:my-[20%] before:mx-auto before:rounded-full checked:before:bg-[#3E8EEE]" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $pertanyaan['SP']) echo 'checked'; ?>>
                                <h6>Sangat Puas</h6>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <div class="flex gap-x-8 justify-center">
                        <?php if ($kategoriIndex > 0) : ?>
                            <a href="?kategori=<?= $kategoriIndex - 1 ?>" class="z-10 w-28 text-center my-8 py-2 rounded-lg border-none box-border text-white text-xl cursor-pointer bg-[#d33]" name="back">Back</a>
                        <?php endif; ?>

                        <?php if ($kategoriIndex < $kategoriResult->num_rows - 1) : ?>
                            <input type="submit" name="next" class="z-10 w-28 text-center my-8 py-2 rounded-lg border-none box-border text-white text-xl cursor-pointer bg-[#3E8EEE]" value="Next">
                        <?php endif; ?>

                        <?php if ($kategoriIndex == $kategoriResult->num_rows - 1) : ?>
                            <input type="submit" name="finish" class="z-10 w-28 my-8 py-2 text-center text-xl text-[#d33] border rounded-lg box-border cursor-pointer hover:text-white hover:bg-[#d33] hover:rounded-lg" value="Finish">
                        <?php endif; ?>
                    </div>
                </form>
            </main>

            <a href="#top" class="fas fa-angle-up fixed top-full right-8 px-4 py-2 text-3xl bg-[#3E8EEE] text-white rounded-xl z-10 transition-all ease-linear active:top-[calc(100% - 5rem)]" id="scroll-top"></a>

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
<?php
    }
} else {
    header('location:login.php');
}  ?>

</html>