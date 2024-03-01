<?php
include "../koneksi.php";

if (isset($_GET['page'])) {
    if ($_GET['page'] == "hapus") {
        $hapus = mysqli_query($conn, "DELETE FROM karyawan WHERE id = '$_GET[id]'");
        // if ($hapus) {
        //     echo "<script>
        //       alert('Suksess');
        //       document.location='setKaryawan.php';
        //       </script>";
        // } else {
        //     echo "<script>
        //       alert('Gagal');
        //       document.location='setKaryawan.php';
        //       </script>";
        // }
    }
}


//new
// if($_SERVER['REQUEST_METHOD']=="POST"){
//     $pencarian = trim(mysqli_real_escape_string($conn, $_POST['pencarian']));
//     if($pencarian != ''){
//         $sql = "SELECT * FROM karyawan WHERE Nama LIKE '%$pencarian%'";
//         $query = $sql;
//         $queryjml = $sql;
//     }else {
//         $query = "SELECT * FROM karyawan LIMIT $firstIndex, $entries";
//         $queryjml = "SELECT * FROM karyawan";
//     }
// }else {
//     $query = "SELECT * FROM karyawan LIMIT $firstIndex, $entries";
//     $queryjml = "SELECT * FROM karyawan";
// }

// if($_POST['pencarian'] == ""){
//     $jml = mysqli_num_rows(mysqli_query($conn, $queryjml));
//     echo $jml;

//     $jml_hal = ceil($jml/$entries);
// }


    /////////
    isset($_POST['entries']) ? $entries = $_POST['entries'] : $entries = 2;     //batas
    $activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;                   //hal
    $firstIndex = ($entries * $activePage) - $entries;                          //posisi
    if(isset($_POST['pencarian'])){
        $pencarian = trim(mysqli_real_escape_string($conn, $_POST['pencarian']));
        if($pencarian != ''){
            $result = "SELECT * FROM karyawan WHERE Nama LIKE '%$pencarian%'";
            $filterView = $result;
            $queryjml = $result;
            $data = mysqli_num_rows(mysqli_query($conn, $queryjml));
            echo $data;
            $page = ceil($data / $entries);
        }else {
            $filterView = "SELECT * FROM karyawan LIMIT $firstIndex, $entries";
            $queryjml = "SELECT * FROM karyawan";
            $data = mysqli_num_rows(mysqli_query($conn, $queryjml));
            echo $data;
            $page = ceil($data / $entries);
            
        }
    }
    global $filterView;
    

    //filter
    
    // $result = mysqli_query($conn, "SELECT * FROM karyawan ORDER BY Nip ASC");
    // $filterView = mysqli_query($conn, "SELECT * FROM karyawan ORDER BY Nip ASC LIMIT $firstIndex, $entries");
    // $data = mysqli_num_rows($result);
    
    
    //Mengatur banyak halaman yang ditampilkan sebelum halaman aktif
    if($activePage > 1){
        $startNum = $activePage - 1;
    }else {
        $startNum = 1;
    }

    //Mengatur banyak halaman yang ditampilkan sesudah halaman aktif
    if($activePage < ($page - 1)){
        $endNum = $activePage + 1;
    }else {
        $endNum = $page;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="img/icon.png" />
    <link rel="stylesheet" href="../css/setUser.css?v=<?php echo time()?>">
    <link rel="stylesheet" href="../css/table.css?v=<?php echo time()?>">
    <title>Admin | Set Karyawan</title>
</head>

<body>
    <header>
        <a href="admin.php">
            <img class="logo" src="img/logo.png" alt="LOGO">
        </a>
        <div id="menu-bar" class="fas fa-bars"></div>
        <nav class="navbar">
        <a class="navbar-list" href="setPertanyaan.php">Setting Pertanyaan</a>
            <a class="navbar-list" href="setKaryawan.php">Setting Karyawan</a>
            <a class="navbar-list" href="history.php">Hasil Survey</a>
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

    <main>
        <center>
            <h2 style="color: #3E8EEE; margin-bottom: 1rem;">Daftar Karyawan PT. PAL Indonesia</h2>
        </center>
        <div class="btn">
            <form action="" method="POST">
                <button onclick="window.location.href='addUser.php'" class="add">Add</button>
                <div class="search">
                    <input type="text" class="search-input" id="search" name="pencarian" placeholder="Cari Nama Di Sini...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                    
                </div>
            </form>
        </div>

        <div class="showEntries">
            <form method="POST" id="entry_id">
                <label>Show </label>
                <select name="entries" onchange="document.getElementById('entry_id').submit()">
                    <?php foreach([25,50,100] as $entries): ?>
                        <option <?php if( isset($_POST["entries"]) && $_POST["entries"] == $entries) echo "selected" ?> value="<?= $entries; ?>"><?= $entries; ?></option>
                    <?php endforeach; ?>
                </select>
                <label> entries</label>
            </form>
        </div>

        <div class="table-container">
            <table class="table1">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Otoritas</th>
                    <th width="120px">Action</th>
                </tr>

                <?php $no = 1 + $firstIndex;
                foreach($karyawan as $list) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $list['Nip']?></td>
                        <td><?= $list['Nama']?></td>
                        <td><?= $list['Divisi']?></td>
                        <td><?= $list['Jabatan']?></td>
                        <td><?= $list['Role']?></td>
                        <td height="30px">
                            <a href="addUser.php?page=edit&id=<?= $list['id']?>" id="edit">Edit</a>
                            <a href="setKaryawan.php?page=hapus&id=<?= $list['id']; ?>" id="delete" class="alert_notif">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="valueEntries">
            <?= "Showing ".($firstIndex + 1)." to ".($no-1)." of ".$data." entries"; ?>
        </div>
    </main>

    <footer>
        <div class="pagination" >
            <?php if($activePage > 1) : ?>
                <a class="non-activePage fa fa-angle-left" href="?page=<?= $activePage - 1?>"></a>
            <?php endif; ?>

            <?php if($startNum > 1) : ?>
                <a class="non-activePage" href="?page=1">1</a>
            <?php endif; ?>

            <?php if($startNum > 2) : ?>
                <a class="non-activePage" disabled>...</a>
            <?php endif; ?>

            <?php for($i = $startNum; $i <= $endNum; $i++): ?>
                <?php if($i == $activePage) :?>
                    <a class="activePage" href="?page=<?= $i ?>"><?= $i ?></a>
                <?php else :?>
                        <a class="non-activePage" href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($endNum < $page-1) : ?>
                <a class="non-activePage" disabled>...</a>
            <?php endif; ?>

            <?php if($endNum < $page) : ?>
                <a class="non-activePage" href="?page=<?=$page?>"><?=$page?></a>
            <?php endif; ?>

            <?php if($activePage < $page) : ?>
                <a class="non-activePage fa fa-angle-right" href="?page=<?= $activePage + 1?>"></a>
            <?php endif; ?>
        </div>
    </footer>

    <!-- Script JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>    <!-- script js sweet alert di bawah ini  -->

    <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
    <?php if(@$_SESSION['sukses']){ ?>
        <script>
            Swal.fire({            
                icon: 'success',                   
                title: 'Data Berhasil Di Hapus',    
                // text: '',                        
                timer: 3000,                                
                showConfirmButton: false
            })
        </script>
    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['sukses']); } ?>

    <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
    <?php if(@$_SESSION['gagal']){ ?>
        <script>
            Swal.fire({            
                icon: 'error',                   
                title: 'Data Tidak Berhasil Di Hapus',    
                // text: '',                        
                timer: 3000,                                
                showConfirmButton: false
            })
        </script>
    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['gagal']); } ?>

    <!-- di bawah ini adalah script untuk konfirmasi hapus data dengan sweet alert  -->
    <script>
        $('.alert_notif').on('click',function(){
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus data?",            
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"
            
            }).then(result => {
                //jika klik ya maka arahkan ke proses.php
                if(result.isConfirmed){
                    window.location.href = getLink
                }
            })
            return false;
        });
    </script>
    <!-- <script>
        function redirect() {
            window.location.href = "addUser.php";
        }
    </script> -->

    <!-- Fungsi Pencarian -->
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table1");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2]; // Utk pncarian kolom nama [1]
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>