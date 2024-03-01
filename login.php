<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login2.css" />
    <link rel="icon" sizes="192x192" href="img/icon.png" />
    <title>Login Page</title>
  </head>
  <body>
    <header>
      <nav>
        <img class="logo" src="img/logo.png" alt="Logo" />
      </nav>
    </header>

    <main>
      <div class="container">
        <div class="vector">
          <img src="img/Vector.png" style="width: 450px; height: 335px" />
        </div>
        <div class="login">
          <form method="post" action="cek_login.php">
            <h2 class="title">Login Page</h2>
            <div class="input">
              <input type="number" class="input-nip" name="Nip" required />
              <i class="fas fa-user"></i>
              <label for="">NIP</label>
            </div>
            <button class="btn">Login</button>
          </form>
        </div>
      </div>
    </main>

    <!-- Script JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  </body>
</html>
