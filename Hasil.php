<?php 
include('koneksi.php');

$viewKategori = 'Tampil Kategori';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="img/icon.png">
    <link rel="stylesheet" href="css/Hasil.css?v=<?php echo time()?>">
    <title>Admin | View Result</title>
</head>
<body>
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
    <center> <h1 style="color: #3E8EEE; margin-bottom: 5rem;">Hasil Survey PT. PAL Indonesia</h1> </center>
        <div class="grafikHasil">
            <canvas id="grafikHasil"></canvas>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php 
    $y = "
    <script>
        const ctx = document.getElementById('grafikHasil').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['HCM', 'Kapal Perang', 'Kapal Selam', 'Teknologi Informasi', 'K3LH'],
                datasets: [{
                    label: 'Kategori 1',
                    data: [12, 19, 3, 5, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
                }],
            },
            options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
            }
            }
        });
    </script>
";
        
            echo $y;
            echo "<br>" .$y;
        ?>
</body>
</html>

$query    =mysqli_query($conn, "SELECT * FROM tb_barang");
    while ($data    =mysqli_fetch_array($query)){
        // looping atribut jumlah dan harga
        $jumlah[]    =$data['jumlah'];
        $n_harga[]    =$data['jumlah']*$data['harga'];
    }
    //total
    $jumlah_barang    =array_sum($jumlah);
    $total_harga    =array_sum($n_harga);