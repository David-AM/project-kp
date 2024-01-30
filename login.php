<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="icon" sizes="192x192" href="img/icon.png">
</head>
<body>
    <nav>
        <img class="logo" src="img/logo.png" alt="Logo">
    </nav>
    <div class="container">
        <div class="vector">
            <img src="img/Vector.png" style="width: 550px; height: 435px;">
        </div>
        <div class="login">
            <form method="post" action="cek_login.php">
                <h2>Login Page</h2>
                <div class="input-NIP">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>NIP</h5>
                        <input type="text" class="input" name="Nip">
                    </div>
                </div>
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>

    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>