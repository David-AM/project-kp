<?php 
    include ("koneksi.php");
    session_start();

    //filter
    isset($_POST['filter']) ? $_SESSION['filter']=$_POST['filter']: "";
    isset($_POST['entries']) ? $entries = $_POST['entries'] : $entries = 5;
    $activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;
    $firstIndex = ($entries * $activePage) - $entries;

    if(empty($_SESSION['filter']) || isset($_POST['resetFilter'])){
        unset($_SESSION['filter']);
        unset($_POST["filter"]);
        $result = mysqli_query($conn, "SELECT * FROM pertanyaan ORDER BY Kategori ASC");
        $filterView = mysqli_query($conn, "SELECT * FROM pertanyaan ORDER BY Kategori ASC LIMIT $firstIndex, $entries");
    }else{
        if(isset($_POST['filter'])){
            $filterr = $_POST['filter'];
            $_SESSION['filter'] = $filterr;
        }else{
            $filterr = $_SESSION['filter'];
        }
        $result = mysqli_query($conn, "SELECT * FROM pertanyaan WHERE Kategori = '$filterr'");
        $filterView = mysqli_query($conn, "SELECT * FROM pertanyaan WHERE Kategori = '$filterr' LIMIT $firstIndex, $entries");
    }
    
    $data = mysqli_num_rows($result);
    $page = ceil($data / $entries);
    $pertanyaan = $filterView->fetch_all(MYSQLI_ASSOC);
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
    <link rel="icon" sizes="192x192" href="img/icon.png">
    <link rel="stylesheet" href="css/setPertanyaan.css?v=<?php echo time()?>">
    <link rel="stylesheet" href="css/table.css?v=<?php echo time()?>">
    <title>Admin | Set Question</title>
</head>

<body id="top">
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
        <center> <h1 style="color: #3E8EEE; margin-bottom: 5rem;">Daftar Pertanyaan Survey PT. PAL Indonesia</h1> </center>
        <div class="btn">
            <button onclick="window.location.href='addPertanyaan.php'" class="add">Add</button>
            
            <div class="filter">
                <form  method="POST" id="filter">
                    <select name="filter" onchange="document.getElementById('filter').submit()">
                        <option value="" selected disabled>Filter By Category</option>
                        <?php 
                        //Merubah String to array
                        $result = mysqli_query($conn, "SELECT Kategori FROM kategori");
                        $kateogri = array();
                        while($row = mysqli_fetch_array($result)){
                            $kateogri[] = $row;
                        }
                        ?>
                        <?php foreach($kateogri as $filter): ?>
                            <option <?php if( isset($_POST["filter"]) && $_POST["filter"] == $filter["Kategori"]) echo "selected" ?> value="<?= $filter['Kategori']; ?>"><?= $filter['Kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="reset" name="resetFilter" value="Reset"></input>
                </form>
            </div>
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
            <table class="table1" height="100px">
                <tr>
                    <th width="20px">No</th>
                    <th width="150px">Kategori</th>
                    <th>Pertanyaan</th>
                    <th width="120px">Action</th>
                </tr>

                <?php $no = 1 + $firstIndex;
                foreach($pertanyaan as $list) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $list['Kategori'];?></td>
                        <td><?= substr($list['Pertanyaan'], 0, 100)?></td>
                        <td height="30px">
                            <a href="editPertanyaan.php?page=edit&id=<?= $list['id']; ?>" id="edit">Edit</a>
                            <a href="delete.php?id=<?= $list['id']; ?>" id="delete" class="alert_notif">Delete</a>
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

    <a href="#top" class="fas fa-angle-up" id="scroll-top"></a>

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
</body>
</html>