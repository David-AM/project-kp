<?php 
    include ("koneksi.php");

    $oKategori="";
    $oPertanyaan="";
    $oSP="";
    $oP="";
    $oCP="";
    $oKP="";
    $oTP="";

    if($_GET['page'] == 'edit'){
        $temp = mysqli_query($conn, "SELECT * FROM pertanyaan WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($temp);

        if($data){
            $oKategori = $data['Kategori'];
            $oPertanyaan = $data['Pertanyaan'];
            $oSP = $data['SP'];
            $oP = $data['P'];
            $oCP = $data['CP'];
            $oKP = $data['KP'];
            $oTP = $data['TP'];
        }
    }
        if(isset($_POST['save'])){
            if($_GET['page'] == 'edit'){
                //Cek dan Simpan hanya 1 Kategori
                $result = mysqli_query($conn, "SELECT Kategori FROM kategori WHERE Kategori = '$_POST[kategori]'");
                // echo mysqli_num_rows($result) . "<br>";
                if (mysqli_num_rows($result) == 0) {                //Mengecek Apakah data input = DB (jika sama akan bernilai > 0)
                    mysqli_query($conn, "INSERT INTO kategori SET Kategori = '$_POST[kategori]'");        
                }

                //Simpan Pertanyaan, Kategori dan Nilai
                mysqli_query($conn, "UPDATE pertanyaan SET
                                        Pertanyaan = '$_POST[pertanyaan]',
                                        Kategori = '$_POST[kategori]',
                                        SP = '$_POST[SP]',
                                        P = '$_POST[P]',
                                        CP = '$_POST[CP]',
                                        KP = '$_POST[KP]',
                                        TP = '$_POST[TP]'
                                    WHERE id = '$_GET[id]'");    
            }
            
            echo "<script>alert('Data Berhasil di Simpan');
            document.location='setPertanyaan.php'</script>";
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="img/icon.png">
    <link rel="stylesheet" href="css/addPertanyaan.css">
    <title>Admin | Edit Question</title>
</head>

<body id="top">
    <header>
        <a href="/adminPage.html">
            <img class="logo" src="img/logo.png" alt="LOGO">
        </a>
        <div id="menu-bar" class="fas fa-bars"></div>
        <nav class="navbar">
            <a class="navbar-list" href="setPertanyaan.php">Setting Pertanyaan</a>
            <a class="navbar-list" href="setKaryawan.php">Setting Karyawan</a>
            <a class="navbar-list" href="/">Result</a>
            <div class="dropdown">
                <!-- <span>Admin</span> -->
                <i onclick="myFunction()" id="profile" class="fas fa-user"></i>
                <i onclick="myFunction()" id="profile" class="fas fa-caret-down ml-2"></i>
                <div id="myDropdown" class="dropdown-content">
                <a class="dropdown-item" href="Delete.html">
                    <i class="fas fa-trash"> Delete Account</i>
                </a>
                <a class="dropdown-item" href="login.html">
                    <i class="fas fa-sign-out-alt"> Sign Out</i>
                </a>
                </div>    
            </div>
        </nav>
    </header>

    <main>
    <form method="POST">
        <center><h1 style="color: #3E8EEE; margin: 5% 0;">Data Pertanyaan</h1></center>
        
        <div class="kategori">
            <h5 class="title">Kategori :</h5>
            <input type="text" name="kategori" value="<?=$oKategori?>" placeholder="Masukkan Kategori" style="margin-bottom:2rem" required>
        </div>

        <div class="pertanyaan">
            <h5 class="title">Pertanyaan : </h5>
            <input type="text" name="pertanyaan" value="<?=$oPertanyaan?>" placeholder="Masukkan Pertanyaan"  style="margin-bottom:1rem" required>
        </div>

        <div class="nilai">
            <h5 class="title">Nilai Jawaban :</h5>
            <div class="var">
                <h5 class="title">Sangat Puas :</h5>
                <input type="text" name="SP" value="<?=$oSP?>" placeholder="Masukkan Nilai">
            </div>
            <div class="var">
                <h5 class="title">Puas :</h5>
                <input type="text" name="P" value="<?=$oP?>" placeholder="Masukkan Nilai">
            </div>
            <div class="var">
                <h5 class="title">Cukup Puas :</h5>
                <input type="text" name="CP" value="<?=$oCP?>" placeholder="Masukkan Nilai">
            </div>
            <div class="var">
                <h5 class="title">Kurang Puas :</h5>
                <input type="text" name="KP" value="<?=$oKP?>" placeholder="Masukkan Nilai">
            </div>
            <div class="var">
                <h5 class="title">Tidak Puas :</h5>
                <input type="text" name="TP" value="<?=$oTP?>" placeholder="Masukkan Nilai">
            </div>
        </div>
        
        <div class="btn">
            <input type="button" class="cancel" name="cancel" value="Cancel" onclick="location.href='setPertanyaan.php';">
            <input type="submit" class="save" name="save" value="Save">
        </div>
    </form>
    </main>

    <a href="#top" class="fas fa-angle-up" id="scroll-top"></a>

    <!-- Script JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</body>
</html>