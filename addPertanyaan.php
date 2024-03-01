<?php
include("koneksi.php");

if (isset($_POST['save'])) {
    //Cek dan Simpan hanya 1 Kategori
    $result = mysqli_query($conn, "SELECT Kategori FROM kategori WHERE Kategori = '$_POST[kategori]'");
    // echo mysqli_num_rows($result) . "<br>";
    if (mysqli_num_rows($result) == 0) {                //Mengecek Apakah data input = DB (jika sama akan bernilai > 0)
        mysqli_query($conn, "INSERT INTO kategori SET Kategori = '$_POST[kategori]'");
    }
    for ($i = 1; $i <= $jumlah; $i++) {
        $checkColumn = mysqli_query($koneksi, "SHOW COLUMNS FROM trans_jawaban LIKE 'Pertanyaan$i'");

        if (mysqli_num_rows($checkColumn) == 0) {
            $addColumn = mysqli_query($koneksi, "ALTER TABLE trans_jawaban ADD COLUMN Pertanyaan$i varchar(255)");
        }
    }
    //Simpan Pertanyaan, Kategori dan Nilai
    $pertanyaan = $_POST['pertanyaan'];
    for ($i = 0; $i < $_POST['jumlah']; $i++) {
        $add = mysqli_query($conn, "INSERT INTO pertanyaan SET
                                    Pertanyaan = '$pertanyaan[$i]',
                                    Kategori = '$_POST[kategori]',
                                    SP = '$_POST[SP]',
                                    P = '$_POST[P]',
                                    CP = '$_POST[CP]',
                                    KP = '$_POST[KP]',
                                    TP = '$_POST[TP]'");
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
    <link rel="stylesheet" href="css/addPertanyaan.css?v=<?php echo time() ?>">
    <title>Admin | Add Question</title>
</head>

<header>
    <a href="Admin.php">
        <img class="logo" src="img/logo.png" alt="LOGO">
    </a>
    <div id="menu-bar" class="fas fa-bars"></div>
    <nav class="navbar">
        <a class="navbar-list" href="setPertanyaan.php">Setting Pertanyaan</a>
        <a class="navbar-list" href="setKaryawan.php">Setting Karyawan</a>
        <a class="navbar-list" href="/">Result</a>
        <div class="dropdown">
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

<body id="top">
    <main>
        <form method="POST">
            <center>
                <h1 style="color: #3E8EEE; margin: 5% 0;">Data Pertanyaan</h1>
            </center>

            <div class="jumlah">
                <h5 class="title">Jumlah Pertanyaan : </h5>
                <input type="text" name="jumlah" id="jumlah" value="" placeholder="Masukkan Jumlah Pertanyaan">
                <input type="submit" name="submit" class="next" value="Submit" required>
            </div>

            <?php
            if (isset($_POST['submit'])) : ?>
                <style>
                    .jumlah>input,
                    .jumlah>h5 {
                        display: none;
                    }
                </style>
                <h5 class="title" style="margin-bottom:2rem">Banyak Pertanyaan : <?php echo $_POST['jumlah'] ?></h5>

                <div class="kategori">
                    <h5 class="title">Kategori :</h5>
                    <input type="text" name="kategori" placeholder="Masukkan Kategori" style="margin-bottom:2rem" required>
                </div>

                <?php
                for ($i = 1; $i <= $_POST['jumlah']; $i++) : ?>
                    <div class="pertanyaan">
                        <h5 class="title">Pertanyaan : <?php echo $i ?></h5>
                        <textarea name="pertanyaan[]" cols="100" rows="5" placeholder="Masukkan Pertanyaan" style="margin-bottom:1rem" required></textarea>
                    </div>
                <?php endfor; ?>

                <div class="nilai">
                    <h5 class="title">Nilai Jawaban :</h5>
                    <div class="var">
                        <h5 class="title">Sangat Puas :</h5>
                        <input type="text" name="SP" placeholder="Masukkan Nilai">
                    </div>
                    <div class="var">
                        <h5 class="title">Puas :</h5>
                        <input type="text" name="P" placeholder="Masukkan Nilai">
                    </div>
                    <div class="var">
                        <h5 class="title">Cukup Puas :</h5>
                        <input type="text" name="CP" placeholder="Masukkan Nilai">
                    </div>
                    <div class="var">
                        <h5 class="title">Kurang Puas :</h5>
                        <input type="text" name="KP" placeholder="Masukkan Nilai">
                    </div>
                    <div class="var">
                        <h5 class="title">Tidak Puas :</h5>
                        <input type="text" name="TP" placeholder="Masukkan Nilai">
                    </div>
                </div>

                <div class="btn">
                    <input type="hidden" name="jumlah" value="<?php echo $_POST['jumlah']; ?>">
                    <input type="button" class="cancel" name="cancel" value="Cancel" onclick="location.href='\setPertanyaan.php';">
                    <input type="submit" class="save" name="save" value="Save">
                </div>
            <?php endif; ?>
        </form>
    </main>

    <a href="#top" class="fas fa-angle-up" id="scroll-top"></a>

    <!-- Script JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</body>

</html>