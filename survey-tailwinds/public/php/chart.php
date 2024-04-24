<?php
include("koneksi.php");
session_start();

// Fetch unique categories from the database
$categoryResult = $conn->query("SELECT DISTINCT `Kategori` FROM `rekap`");
$categories = [];
while ($row = $categoryResult->fetch_assoc()) {
  $categories[] = $row['Kategori'];
}

// Prepare the data array with dynamic keys based on categories
$chartData = array_fill_keys($categories, []);

// Query to fetch all data
$query = $conn->query("SELECT Total, Divisi, Kategori FROM rekap INNER JOIN karyawan ON rekap.NIP = karyawan.Nip");

// Group data by category
foreach ($query as $row) {
  $chartData[$row['Kategori']][] = [
    'Divisi' => $row['Divisi'],
    'Total' => $row['Total']
  ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="icon" sizes="192x192" href="img/icon.png">
  <title>Admin | Grafik Hasil</title>
</head>

<style>
  .show {
    display: block;
  }

  #menu-list .activated {
    border-bottom: 5px solid black;
    bottom: 0;
    width: 100%;
    border-radius: 1px;
    transition: .5s ease;
    color: black;
  }

  #acc {
    font-size: 2.5rem;
  }

  /* #mode:checked ~ label div#toggle span {
        transform: rotate(180deg);
        transition: ease 2s;
    } */

  #mode:checked~label div#toggle {
    translate: 100%;
    transition: ease 1s;
  }

  #mode~label div#toggle {
    transition: ease 1s;
  }
</style>

<body class="box-border bg-white font-inter dark:bg-slate-700">
  <header class="top-0 sticky z-10">
    <nav class="bg-[#3E8EEE] text-white font-semibold flex justify-between items-center px-4 shadow-[0_.5rem_1rem_rgba(0,0,0,0.1)]">
      <a href="admin.php">
            <img src="../../src/img/logo.png" class="w-[250px] p-2 bg-white rounded-lg" alt="logo">
            </a>
      <ul class="flex gap-2" id="nav">
        <li id="menu-list">
          <a href="admin.php" class="inline-block py-4 px-2 transition-all ease-linear duration-200 group">
            <!-- <span class="material-symbols-outlined">assignment</span> -->
            <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2" id="menu">
              Home</p>
          </a>
        </li>
        <li id="menu-list">
          <a href="Pertanyaan.php" class="inline-block py-4 px-2 transition-all ease-linear duration-200 group">
            <!-- <span class="material-symbols-outlined">assignment</span> -->
            <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2" id="menu">
              Pertanyaan</p>
          </a>
        </li>
        <li id="menu-list">
          <a href="Karyawan.php" class="inline-block py-4 px-2 transition-all ease-linear duration-200 group">
            <!-- <span class="material-symbols-outlined">manage_accounts</span> -->
            <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2" id="menu">
              Karyawan</p>
          </a>
        </li>
        <li id="menu-list">
          <div class="relative inline-block py-4 px-2 transition-all ease-linear duration-200 cursor-pointer group">
            <!-- <span class="material-symbols-outlined">table_chart_view</span> -->
            <p class="top-0 relative transition-all ease-in duration-200 group-hover:-top-2 group-hover:block" id="menu">Hasil</p>
            <div class="hidden absolute bg-white w-max z-10 rounded-lg  group-hover:block">
              <a href="Hasil.php" class="text-[#3E8EEE] px-4 py-3 decoration-0 flex gap-3 hover:text-black">
                <span class="material-symbols-outlined">data_table</span>
                <p>Tabel</p>
              </a>
              <a href="Chart.php" class="text-[#3E8EEE] px-4 py-3 decoration-0 flex gap-3 hover:text-black">
                <span class="material-symbols-outlined">bar_chart_4_bars</span>
                <p>Grafik</p>
              </a>
            </div>
          </div>
        </li>
        <li>
          <span class="material-symbols-outlined py-4 px-2 cursor-pointer" onclick="profile()" id="profile">Account_Circle</span>
          <div class="profile-menu absolute hidden right-2 bg-white p-3 rounded-lg text-sky-500 text-xs" id="profile-menu">
            <div class="flex gap-3 justify-center">
              <span class="material-symbols-outlined" id="acc">Account_Circle</span>
              <div class="text-start">
                <p class="text-sm"><?= $_SESSION['Nama'] ?></p>
                <p class="text-xs"><?= $_SESSION['Jabatan'] ?></p>
              </div>
            </div>

            <hr class="border border-sky-500 my-4">

            <label for="mode" class="flex gap-3 justify-between items-center cursor-pointer">
              <p>Dark Mode</p>
              <div>
                <input type="checkbox" name="mode" id="mode" class="hidden">
                <label for="mode" class="cursor-pointer">
                  <div class="flex items-center w-8 h-5 rounded-full bg-slate-400 p-1">
                    <div class="w-3 h-3 rounded-full bg-white flex items-center justify-center" id="toggle"></div>
                  </div>
                </label>
              </div>
            </label>

            <a href="login.php" class="flex items-center gap-3 mt-4">
              <span class="material-symbols-outlined">Logout</span>
              <p>Signout</p>
            </a>
          </div>
        </li>
      </ul>
    </nav>
  </header>

  
  <main>
    <div class="flex flex-wrap justify-around pt-24 gap-10">
      <?php foreach ($categories as $category) : ?>
        <div class="grow shrink-0 basis-2/4 mb-5 max-w-[600px] max-[768px]:basis-full max-[768px]:max-w-full">
          <canvas id="Chart<?php echo str_replace(' ', '', $category); ?>"></canvas>
        </div>
      <?php endforeach; ?>
    </div>
  </main>



  <script>
    <?php foreach ($chartData as $kategori => $dataPoints) : ?>
        (function() {
          // Prepare the data arrays
          const chartLabels = [];
          const chartData = [];
          <?php foreach ($dataPoints as $point) : ?>
            chartLabels.push('<?php echo $point['Divisi'] ?>');
            chartData.push(<?php echo $point['Total'] ?>);
          <?php endforeach; ?>

          // Create the chart data object
          const data = {
            labels: chartLabels,
            datasets: [{
              label: '<?php echo $kategori ?>',
              data: chartData,
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
              ],
              borderColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
              ],
              borderWidth: 1
            }]
          };

          // Chart configuration
          const config = {
            type: 'bar',
            data: data,
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            },
          };

          // Initialize the chart
          new Chart(
            document.getElementById('Chart' + '<?php echo str_replace(' ', '', $kategori) ?>'),
            config
          );
        })();
    <?php endforeach; ?>
  </script>

  <script>
    //Dropdown Profile
    function profile() {
      document.getElementById("profile-menu").classList.toggle("show");
    }

    window.onclick = function(event) {
      if (event.target.id !== "profile") {
        let dropdowns = document.getElementsByClassName("profile-menu");
        for (let i = 0; i < dropdowns.length; i++) {
          let openDropdown = dropdowns[i];

          if (openDropdown.classList.contains("show")) {
            openDropdown.classList.remove("show");
          }
        }
      }
    }

    let mode = document.querySelector('#mode');
    let html = document.querySelector('html');

    mode.addEventListener('click', function() {
      mode.checked ? html.classList.add('dark') : html.classList.remove('dark');
    })
  </script>

</body>

</html>