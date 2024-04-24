<?php
include("koneksi.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- DataTable Bootstrap 5 Style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

    <link rel="stylesheet" href="../css/style.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <title>Admin | Set Pertanyaan</title>
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
        animation-duration: 3s;
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
            <h1 class="font-inter font-bold text-3xl text-[#3E8EEE] text-center my-8">Daftar Pertanyaan Survey PT. PAL Indonesia</h1>
            <button onclick="window.location.href='addPertanyaan.php'" class="w-28 text-center my-2 py-2 rounded-lg relative border-none text-white text-xl font-semibold cursor-pointer bg-[#3E8EEE]">Add</button>
            <table id="example" class="table display h-fit overflow-x-auto table-fixed" style="width: 100%; ">
                <thead class="bg-[#3E8EEE] ">
                    <tr>
                        <th class="border text-white text-center" width="6%">No</th>
                        <th class="border text-white text-center" width="20%">Kategori</th>
                        <th class="border text-white text-center" width="60%">Pertanyaan</th>
                        <th class="border text-white text-center" width="14%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = "SELECT * FROM pertanyaan";
                    $filterView = mysqli_query($conn, $query);
                    $no = 1;
                    while ($pertanyaan = mysqli_fetch_array($filterView)) : ?>
                        <tr>
                            <td class="border text-center"><?= $no++ ?></td>
                            <td class="border text-center"><?= $pertanyaan['Kategori'] ?></td>
                            <td class="border text-center overflow-hidden text-ellipsis whitespace-nowrap"><?= $pertanyaan['Pertanyaan'] ?></td>
                            <td class="border text-center" height="30px">
                                <a href="editPertanyaan.php?page=edit&id=<?= $pertanyaan['id']; ?>" id="edit" class="py-1 px-2 rounded-md font-semibold bg-sky-600 text-white">Edit</a>
                                <a href="delete.php?id=<?= $pertanyaan['id']; ?>" id="delete" class="alert_notif py-1 px-2 rounded-md font-semibold bg-red-600 text-white">Delete</a>

                                <!-- <a href="editPertanyaan.php?page=edit&id=<?= $pertanyaan['id']; ?>" id="editLogo" class="fas fa-edit"></a>
                                <a href="delete.php?id=<?= $pertanyaan['id']; ?>" id="deleteLogo" class="fas fa-trash alert_notif"></a> -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        new DataTable('#example');
    </script>
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

    <?php if (@$_SESSION['sukses']) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Di Hapus',
                // text: '',                        
                timer: 3000,
                showConfirmButton: false
            })
        </script>
    <?php unset($_SESSION['sukses']);
    } ?>

    <?php if (@$_SESSION['gagal']) { ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Berhasil Di Hapus',
                // text: '',                        
                timer: 3000,
                showConfirmButton: false
            })
        </script>
    <?php unset($_SESSION['gagal']);
    } ?>

    <script>
        $('.alert_notif').on('click', function() {
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"

            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = getLink
                }
            })
            return false;
        });
    </script>
</body>

</html>