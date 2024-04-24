<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="icon" sizes="192x192" href="../../src/img/icon.png" />
    <title>Login Page</title>
</head>

<style>
    #container {
        background-image: url(../../src/img/BGLogin.png) !important;
        background-size: 83%;
        background-repeat: no-repeat;
        background-position: right;
        /* border: solid; */
    }

    #card {
        box-shadow: -9px 10px 7px -4px rgba(135, 135, 135, 0.75), 8px 12px 12px 0px rgba(145, 145, 145, 0.75);
        -webkit-box-shadow: -9px 10px 7px -4px rgba(135, 135, 135, 0.75), 8px 12px 12px 0px rgba(145, 145, 145, 0.75);
        -moz-box-shadow: -9px 10px 7px -4px rgba(135, 135, 135, 0.75), 8px 12px 12px 0px rgba(145, 145, 145, 0.75);
    }

    .vector {
        /* margin-left: 120px; */
        animation: float 4s linear infinite;
        /* border: solid; */
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0rem);
        }

        50% {
            transform: translateY(1rem);
        }
    }

    #card input:focus,
    #card input:focus~i,
    #card input:valid~i,
    #card input:focus~label,
    #card input:valid~label {
        top: 0 !important;
        color: #3E8EEE;
    }
</style>

<body class="mx-40 box-border">
    <header>
        <nav class="top-0 left-0 flex">
            <img src="../../src/img/logo.png" alt="Logo" class="my-8 w-80" />
        </nav>
    </header>

    <main>
        <div class="w-[950px] h-[500px] rounded-3xl border-t border-solid" id="card">
            <div class="w-[1000px] h-[500px]" id="container">
                <div class="w-48 h-full flex flex-col  mx-40">
                    <form method="post" action="cek_login.php">
                        <h2 class="text-4xl text-center my-24 font-semibold">Login Page</h2>
                        <div class="relative w-40 my-12">
                            <input type="number" class="w-[120%] pt-3 outline-none border-b-2 border-solid border-black font-semibold bg-transparent text-[#3E8EEE]" name="Nip" id="NIP" required />
                            <i class="fas fa-user absolute top-1/2 -translate-y-1/2 pointer-events-none transition-all ease-linear duration-300 px-[0.1rem]"></i>
                            <label for="NIP" class="absolute top-1/2 -translate-y-1/2 pointer-events-none transition-all ease-linear duration-300 left-6 font-semibold">NIP</label>
                        </div>
                        <button class="block w-full h-12 bg-[#3E8EEE] rounded-3xl outline-none text-xl font-semibold text-white uppercase my-4 cursor-pointer duration-300 hover:bg-sky-800">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Script JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</body>

</html>