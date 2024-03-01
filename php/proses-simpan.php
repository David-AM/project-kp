<?php
include('koneksi.php');

if(isset($_POST['simpan'])){
    $pertanyaan = $_POST['pertanyaan'];
    $jumlah = $_POST['jumlah'];
    
    for($i=0; $i<$jumlah; $i++){
        $add = "INSERT INTO set_pertanyaan SET pertanyaan = '$pertanyaan[$i]'";
        $result = mysqli_query ($conn, $add) or die(mysqli_error($conn));
    }
    
    // echo "<script>alert('Data Berhasil di Simpan');
    // document.location='coba.php'</script>";
    
    
}
?>


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


            <?php if($activePage > 1) : ?>
                <a class="non-activePage fa fa-angle-left" href="?page=<?= $activePage - 1?>"></a>
            <?php elseif($startNum > 1) : ?>
                <a class="non-activePage" href="?page=1">1</a>
            <?php elseif($startNum > 2) : ?>
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
            <?php elseif($endNum < $page) : ?>
                <a class="non-activePage" href="?page=<?=$page?>"><?=$page?></a>
            <?php elseif($activePage < $page) : ?>
                <a class="non-activePage fa fa-angle-right" href="?page=<?= $activePage + 1?>"></a>
            <?php endif; ?>