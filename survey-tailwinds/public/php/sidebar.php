<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav-style.css?v=<?php echo time() ?>">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <title>Document</title>
</head>

<style>
    #sidebar.active {
        width: 3.5rem;
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

<body>
    <div class="flex">
        <!-- <span class="material-symbols-outlined order-2 cursor-pointer" onclick="menu()">menu</span> -->

        <div class="bg-sky-500  order-2 w-8 h-8 cursor-pointer relative rounded-ee-md">
            <div class="flex flex-col h-3 justify-between cursor-pointer mt-2 mx-1 absolute" id="menu" onclick="menu()">
                <span class="block w-5 h-[2px] bg-white rounded translate-x-0 translate-y-[5px] rotate-45 duration-300"></span>
                <span class="block w-5 h-[2px] bg-white rounded opacity-0 duration-300"></span>
                <span class="block w-5 h-[2px] bg-white rounded translate-x-0 -translate-y-[5px] -rotate-45 duration-300"></span>
            </div>
        </div>

        <aside class="bg-sky-500 font-semibold h-screen w-max" id="sidebar">
            <nav class="h-full flex flex-col justify-between p-2 text-white box-border" id="navbar">
                <!-- <img class="logo" src="../img/survey.png" alt="LOGO"> -->
                <div class="flex flex-col items-center mb-12">
                    <i class="material-symbols-outlined" id="account">account_circle</i>
                    <div class=" flex justify-center flex-col items-center">
                        <p class="list-menu cursor-pointer text-base text-white">Alexis Enache</p>
                        <p class="list-menu cursor-pointer text-xs text-gray-300">alexis81@gmail.com</p>
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
                <!-- <div class="flex justify-center items-center space-x-2">
                    <span class="material-symbols-outlined">account_circle</span>
                    <div class="flex justify-start flex-col items-start">
                        <p class="cursor-pointer text-sm leading-5 text-white">Alexis Enache</p>
                        <p class="cursor-pointer text-xs leading-3 text-gray-300">alexis81@gmail.com</p>
                    </div>
                    <a class="border" href="">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                </div> -->
            </nav>
        </aside>

        <!-- <main class="order-3">
            <h1>Dashbord</h1>
            <div class="container">
                <div class="card">
                    <i class="fas fa-user"></i>
                    <div>
                        <h1>Total Karyawan</h1>
                        <h2>20</h2>
                    </div>
                </div>

                <div class="card">
                    <i class="fas fa-user"></i>
                    <div>
                        <h1>Total Pertanyaan</h1>
                        <h2>30</h2>
                    </div>
                </div>
            </div>

        </main> -->
    </div>

    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>