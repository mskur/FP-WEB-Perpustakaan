<?php

require '../conn.php';
$buku = query("SELECT * FROM buku");
$totalBuku = count($buku);


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <input type="checkbox" id="check">
        <header>
            <label for="check">
                <i class="fas fa-bars" id="sidebar_btn"></i>
            </label>
            <div class="left_area">
                <h3>Perpustakaan <span>Akbar</span></h3>
            </div>
        </header>

        <?php 
        
        include "../template/sidebar.php"
        
        ?>

        <div class="content">
            <div class="isi_konten">
                <h2>Selamat Datang Di Perpustakaan Akbar</h2>
                
                    <form action="#" method="POST">
                        <input class="kolomm" type="text" id="keyword" placeholder="Cari Sesuatu">
                    </form>
                <h4>Jumlah Buku Perpustakaan : <?= $totalBuku; ?></h4>
                <div id="tabelData">
                    <table border="2" cellpadding="3" cellspacing="1">
                        <thead>
                            <tr>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Tahun</th>
                                <th>Penulis</th>
                                <th>Rak</th>
                                <th>Genre</th>
                                <th>Status</th>
                                <th>Barcode</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($buku as $bk) : ?>
                            <tr>
                                <th><?= $bk["id_buku"]; ?></th>
                                <td><?= $bk["judul"]; ?></td>
                                <th><?= $bk["tahun"]; ?></th>
                                <td><?= $bk["penulis"]; ?></td>
                                <th><?= $bk["rak"]; ?></th>
                                <td><?= $bk["genre"]; ?></td>
                                <?php if($bk['status'] != "Tersedia") : ?>
                                    <th style="color : red;">
                                <?php else: ?>
                                    <th>
                                <?php endif; ?>
                                    <?= $bk["status"]; ?>
                                </th>
                                <th>
                                    <img src="../img-barcode/<?= $bk["barcode"];?>">
                                    <a href="printBarcode.php?kode=<?= $bk["barcode"]; ?>">
                                        <img src="../icon/printer.png" width="30" style="padding-bottom: 30px; padding-left: 10px;">
                                    </a>
                                </th>
                                <th>
                                    <?php if($bk['status'] != "Tersedia") : ?>
                                        <img src="../icon/prohibition.png" style="text-align: center;" alt="Qries" width="30">
                                    <?php else : ?>
                                        <a href="../update/updateBuku.php?id=<?= $bk["id_buku"]; ?>">
                                            <img src="../icon/update.png" style="text-align: center;" alt="Qries" width="30">
                                        </a>
                                    <?php endif; ?>
                                </th>
                                <th>
                                    <?php if($bk['status'] != "Tersedia") : ?>
                                        <img src="../icon/prohibition.png" style="text-align: center;" alt="Qries" width="30">
                                    <?php else : ?>
                                        <a href="../delete/deleteBuku.php?id=<?= $bk["id_buku"]; ?>" onclick="return confirm('Yakin Ingin Menghapus Buku Dengan Kode <?= $bk["id_buku"]; ?>?');">
                                            <img src="../icon/delete.png" style="text-align: center;" alt="Qries" width="30">
                                        </a>
                                    <?php endif; ?>
                                </th>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

    <script src="../script/jquery.js"></script>
    <script src="../script/script.js"></script>
</html>
