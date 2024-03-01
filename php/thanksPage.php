<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="img/icon.png">
    <link rel="stylesheet" href="../css/thanksPage.css?v=<?php echo time()?>">
    <title>User | Survey</title>
</head>
<body>
    <header>
        <a href="/userPage.html">
            <img class="logo" src="img/logo.png" alt="LOGO">
        </a>
        <div id="menu-bar" class="fas fa-bars"></div>
        <nav class="navbar">
            <div class="dropdown">
                <!-- <span>Admin</span> -->
                <i onclick="myFunction()" id="profile" class="fas fa-user"></i>
                <i onclick="myFunction()" id="profile" class="fas fa-caret-down ml-2"></i>
                <div id="myDropdown" class="dropdown-content">
                    <a class="dropdown-item" href="Delete.html">
                        <i class="fas fa-trash"> Delete Account</i>
                    </a>
                    <a class="dropdown-item" href="logout.php">
                        <i class="fas fa-sign-out-alt"> Log Out</i>
                    </a>
                </div>    
            </div>
        </nav>
    </header>

    <div class="bg">
        <div class="circle-1"></div>
        <div class="circle-2"></div>
        <div class="circle-3"></div>
    </div>

    <main>
        <div class="thanksCard">
            <h1>Terima Kasih Sudah Mengisi Survey</h1>
            <h2>Silahkan logout</h2>
        </div>
    

    </main>
</body>
    <!-- Script JS -->
    <script type="text/javascript" src="../js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</html>