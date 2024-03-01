<?php
include("koneksi.php");
session_start();

// if (!isset($_SESSION['selectedRadio'])) {
//     $_SESSION['selectedRadio'] = array();
// }

$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanyaan"));
$radio = $data['id'];

// $totalNilai = 0;
// $query = "SELECT Kategori, GROUP_CONCAT(pertanyaan SEPARATOR ', ') as pertanyaan_concat
//           FROM pertanyaan GROUP BY Kategori";
// $result = $conn->query($query);
// $dataArray = array();

// while ($row = $result->fetch_assoc()) {
//     $kategori = $row['Kategori'];
//     $pertanyaanArray = explode(', ', $row['pertanyaan_concat']);

//     $kategoriData = array(
//         'kategori' => $kategori,
//         'pertanyaan' => $pertanyaanArray
//     );

//     $dataArray[] = $kategoriData;
// }

// $jumlahKategori = count($dataArray);
// $kategoriIndex = isset($_GET['kategori']) ? intval($_GET['kategori']) : 0;
// $kategoriSekarang = $dataArray[$kategoriIndex]['kategori'];
// $pertanyaanSekarang = $dataArray[$kategoriIndex]['pertanyaan'];

// if (isset($_POST['next'])) {
//     $kategoriIndex++;
//     header("Location: ?kategori=$kategoriIndex");
// }

// if (isset($_POST['back'])) {
//     $kategoriIndex--;
//     header("Location: ?kategori=$kategoriIndex");
// }

$kategoriQuery = "SELECT DISTINCT Kategori FROM pertanyaan";
$kategoriResult = $conn->query($kategoriQuery);

// Ambil pertanyaan pertama dari kategori pertama
$kategoriIndex = isset($_GET['kategori']) ? intval($_GET['kategori']) : 0;
$kategoriResult->data_seek($kategoriIndex);
$kategoriSekarang = $kategoriResult->fetch_assoc()['Kategori'];

$pertanyaanQuery = "SELECT * FROM pertanyaan WHERE Kategori = '$kategoriSekarang'";
$pertanyaanResult = $conn->query($pertanyaanQuery);

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        // Simpan nilai radio button ke dalam sesi
        if (strpos($key, 'radio_') === 0) {
            $_SESSION[$key] = $value;
        }
    }
}

// Ambil nilai radio button dari sesi jika ada
$radioValues = array();
foreach ($_SESSION as $key => $value) {
    if (strpos($key, 'radio_') === 0) {
        $radioValues[$key] = $value;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="img/icon.png">
    <link rel="stylesheet" href="css/userPage.css?v=<?php echo time() ?>">
    <title>User | Survey</title>
</head>

<body id="top">
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
                        <a class="dropdown-item" href="login.php">
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
        <form method="POST">
        <main>
            <h1 class="title">Survey Karyawan PT. PAL Indonesia</h1>
            <!-- <?php
                    foreach ($pertanyaanSekarang as $pertanyaan) :
                        $radioButton = str_replace(' ', '_', $pertanyaan);
                        // $checkedValue = isset($_SESSION['selectedRadio'][$radioName]) ? $_SESSION['selectedRadio'][$radioName] : '';
                    ?>
                <div class="box">
                    <h5 class="pertanyaan"><?= $pertanyaan ?></h5>
                    <div class="radio">
                        <h6>Tidak Puas</h6>
                        <input type="radio" name="<?= $radioButton ?>" value="<?= $data['TP'] ?>" <?php if (isset($_POST[$radioButton]) && $_POST[$radioButton] == $data['TP'])  echo ' checked="checked"'; ?> />
                        <input type="radio" name="<?= $radioButton ?>" value="<?= $data['KP'] ?>" <?php if (isset($_POST[$radioButton]) && $_POST[$radioButton] == $data['KP'])  echo ' checked="checked"'; ?> />
                        <input type="radio" name="<?= $radioButton ?>" value="<?= $data['N'] ?>" <?php if (isset($_POST[$radioButton]) && $_POST[$radioButton] == $data['N'])  echo ' checked="checked"'; ?> />
                        <input type="radio" name="<?= $radioButton ?>" value="<?= $data['P'] ?>" <?php if (isset($_POST[$radioButton]) && $_POST[$radioButton] == $data['P'])  echo ' checked="checked"'; ?> />
                        <input type="radio" name="<?= $radioButton ?>" value="<?= $data['SP'] ?>" <?php if (isset($_POST[$radioButton]) && $_POST[$radioButton] == $data['SP'])  echo ' checked="checked"'; ?> />
                        <h6>Sangat Puas</h6>
                    </div>
                </div>
            <?php endforeach; ?> -->

            <?php while ($pertanyaan = $pertanyaanResult->fetch_assoc()) : ?>
                <div class="card">
                    <div class="pertanyaan"><?= $pertanyaan['Pertanyaan'] ?></div>
                    <form method="post">
                        <div class="radio">
                            <h6>Tidak Puas</h6>
                            <label>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $data['TP'] ?>" id="additionalRadio" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $data['TP']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $data['KP'] ?>" id="additionalRadio" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $data['KP']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $data['N'] ?>" id="additionalRadio" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $data['N']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $data['P'] ?>" id="additionalRadio" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $data['P']) echo 'checked'; ?>>
                                <input type="radio" name="radio_<?= $pertanyaan['id'] ?>" value="<?= $data['SP'] ?>" id="additionalRadio" <?php if (isset($radioValues["radio_" . $pertanyaan['id']]) && $radioValues["radio_" . $pertanyaan['id']] == $data['SP']) echo 'checked'; ?>>
                            </label>
                            <h6>Sangat Puas</h6>
                            <input type="hidden" name="kategori" value="<?= $kategoriIndex ?>">
                        </div>
                        <input type="submit" value="Submit" class="submit" name="submit">
                    </form>
                </div>
            <?php endwhile; ?>
        </main>
        <div class="btn">
            <?php if ($kategoriIndex > 0) : ?>
                <a href="?kategori=<?= $kategoriIndex - 1 ?>" class="back">Back</a>
                <a href="?kategori=<?= $kategoriIndex + 1 ?>" class="next">Next</a>
            <?php endif; ?>

            <?php if ($kategoriIndex < $kategoriResult->num_rows - 1) : ?>
                <a href="?kategori=<?= $kategoriIndex + 1 ?>" class="next">Next</a>
            <?php endif; ?>
        </div>
    </form>
    <a href="#top" class="fas fa-angle-up" id="scroll-top"></a>
</body>

<!-- Script JS -->
<script type="text/javascript" src="js/main.js"></script>
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
<script>
    document.getElementById('additionalRadio').addEventListener('change', function() {
        document.getElementById('nextButton').disabled = !this.checked;
    });
</script>

</html>