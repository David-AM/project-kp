<?php
include("koneksi.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/style.css?v=<?php echo time() ?>"> -->
    <!-- Icon -->
    <!-- <script src="https://kit.fontawesome.com/a81368914c.js"></script> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <!-- Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <!-- DataTable -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script> -->

    <!-- DataTable Bootstrap 5 Style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <title>Admin | Set Pertanyaan</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time() ?>">
</head>

<style>
    #sidebar {
        transition: all ease-out 500ms;
    }

    #sidebar.active {
        width: 3.5rem;
        transition: all ease-in 500ms;
    }

    #main {
        transition: all ease-out 500ms;
    }

    #main.active {
        width: 88%;
        margin-left: 7rem;
        transition: all ease-in 500ms;
    }

    #sidebar.active .list-menu {
        display: none;
    }

    #sidebar.active #navbar {
        align-items: center;
    }

    #account {
        font-size: 3.75rem;
    }

    #sidebar.active #account {
        font-size: 2rem;
    }

    .change span:nth-child(1) {
        transform: translate(0, 0px) rotate(0deg);
    }

    .change span:nth-child(2) {
        opacity: 100%;
    }

    .change span:nth-child(3) {
        transform: translate(0, 0px) rotate(0deg);
    }
</style>

<body class="box-border font-inter">
    <div class="flex fixed top-0">
        <div class="bg-sky-500 order-2 w-8 h-8 cursor-pointer relative rounded-ee-md" onclick="menu()">
            <div class="flex flex-col h-3 justify-between cursor-pointer mt-2 mx-1 absolute" id="menu">
                <span class="block w-5 h-[2px] bg-white rounded translate-y-[5px] rotate-45 duration-300"></span>
                <span class="block w-5 h-[2px] bg-white rounded opacity-0 duration-300"></span>
                <span class="block w-5 h-[2px] bg-white rounded -translate-y-[5px] -rotate-45 duration-300"></span>
            </div>
        </div>

        <aside class="bg-sky-500 font-semibold h-screen w-40" id="sidebar">
            <nav class="h-full flex flex-col justify-between p-2 text-white" id="navbar">
                <!-- <img class="logo" src="../img/survey.png" alt="LOGO"> -->
                <div class="flex flex-col items-center mb-12">
                    <i class="material-symbols-outlined" id="account">account_circle</i>
                    <div class=" flex justify-center flex-col items-center">
                        <p class="list-menu cursor-pointer text-base text-white">Nama</p>
                        <p class="list-menu cursor-pointer text-xs text-gray-300">Jabatan</p>
                    </div>
                </div>
                <ul class="flex flex-col gap-3">
                    <li class="flex items-center hover:bg-sky-300 p-2 rounded">
                        <a class="flex" href="">
                            <span class="material-symbols-outlined">dashboard</span>
                            <p class="list-menu mx-3">Dashboard</p>
                        </a>
                    </li>
                    <li class="flex items-center hover:bg-sky-300 p-2 rounded">
                        <a class="flex" href="">
                            <span class="material-symbols-outlined">assignment</span>
                            <p class="list-menu mx-3">Pertanyaan</p>
                        </a>
                    </li>
                    <li class="flex items-center hover:bg-sky-300 p-2 rounded">
                        <a class="flex" href="">
                            <span class="material-symbols-outlined">manage_accounts</span>
                            <p class="list-menu mx-3">Karyawan</p>
                        </a>
                    </li>
                    <li class="flex items-center hover:bg-sky-300 p-2 rounded">
                        <a class="flex" href="">
                            <span class="material-symbols-outlined">table_chart_view</span>
                            <p class="list-menu mx-3">Hasil</p>
                        </a>
                    </li>
                </ul>

                <ul class="mt-48">
                    <li class="flex items-center hover:bg-sky-300 p-2 rounded">
                        <a class="flex" href="">
                            <span class="material-symbols-outlined">Logout</span>
                            <p class="list-menu mx-3">Signout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
    </div>

    <main class="ml-56 h-full w-4/5 absolute" id="main">
        <h1 class="font-inter font-bold text-3xl text-sky-500 text-center my-8">Daftar Pertanyaan Survey PT. PAL Indonesia</h1>
        <table id="example" class="table display h-fit overflow-x-auto table-fixed" style="width: 100%; ">
            <thead class="bg-sky-500 ">
                <tr>
                    <th class="border text-white" width="6%">No</th>
                    <th class="border text-white" width="20%">Kategori</th>
                    <th class="border text-white" width="60%">Pertanyaan</th>
                    <th class="border text-white" width="14%">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $query = "SELECT * FROM pertanyaan";
                $filterView = mysqli_query($conn, $query);
                $no = 1;
                while ($pertanyaan = mysqli_fetch_array($filterView)) : ?>
                    <tr>
                        <td class="border"><?= $no++ ?></td>
                        <td class="border"><?= $pertanyaan['Kategori'] ?></td>
                        <td class=" border overflow-hidden text-ellipsis whitespace-nowrap"><?= $pertanyaan['Pertanyaan'] ?></td>
                        <td class="border" height="30px">
                            <a href="editPertanyaan.php?page=edit&id=<?= $pertanyaan['id']; ?>" id="edit" class="py-1 px-2 rounded-md font-semibold bg-sky-600 text-white">Edit</a>
                            <a href="delete.php?id=<?= $pertanyaan['id']; ?>" id="delete" class="alert_notif py-1 px-2 rounded-md font-semibold bg-red-600 text-white">Delete</a>

                            <!-- <a href="editPertanyaan.php?page=edit&id=<?= $pertanyaan['id']; ?>" id="editLogo" class="fas fa-edit"></a>
                                <a href="delete.php?id=<?= $pertanyaan['id']; ?>" id="deleteLogo" class="fas fa-trash alert_notif"></a> -->
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <script type="text/javascript" src="../js/main.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        function menu() {
            document.querySelector('#sidebar').classList.toggle('active');
            document.querySelector('#main').classList.toggle('active');
            document.querySelector('#menu').classList.toggle('change');
        }
    </script>
</body>

</html>