<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href=css/style.css>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="icon" sizes="192x192" href="img/icon.png">
    <title>USER PAGE</title>
  </head>

  <body>
    <header>
      <img class="logo" src="img/logo.png" alt="LOGO">
      <div id="menu-bar" class="fas fa-bars"></div>
      <nav class="navbar">
        <div class="dropdown">
          <div id="profile" class="fas fa-user"></div>
          <label for="profile">User</label> 
          <div class="dropdown-content">
            <div id="sign-out" class="fas fa-sign-out-alt"> Log Out</div>
          </div>
        </div>
      </nav>
    </header>
    
    <main>
      <section class="home">
        <div class="circle-1"></div>
        <div class="circle-2"></div>
        <div class="circle-3"></div>
        <div class="content">
          <h1>Survei Karyawan</h1>
          <div class="container">
            <div class="box">
              <h5>Pertanyaan 1</h5>
              <div class="radio">
                <h6>Tidak Puas</h6>
                <input type="radio" name="Nilai" id="TP">
                <input type="radio" name="Nilai" id="CP">
                <input type="radio" name="Nilai" id="N">
                <input type="radio" name="Nilai" id="P">
                <input type="radio" name="Nilai" id="SP">
                <h6>Sangat Puas</h6>
              </div>
            </div>
            <div class="box">
              <h5>Pertanyaan 1</h5>
              <div class="radio">
                <h6>Tidak Puas</h6>
                <input type="radio" name="Nilai1" id="TP">
                <input type="radio" name="Nilai1" id="CP">
                <input type="radio" name="Nilai1" id="N">
                <input type="radio" name="Nilai1" id="P">
                <input type="radio" name="Nilai1" id="SP">
                <h6>Sangat Puas</h6>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="btn">
          <div class="back">
            <a href="">Back</a>
          </div>
          <div class="next">
            <a href="">Next</a>
          </div>
        </div>
      </section>
    </main>
      
      
    
      <!-- Script JS -->
      <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>