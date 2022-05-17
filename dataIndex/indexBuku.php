<?php

require '../conn.php';
$buku = query("SELECT * FROM buku");



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
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
                
                <div id="tabelData">
                    <table border="2" cellpadding="3" cellspacing="1">
                        <thead>
                            <tr>
                                <th>Kode Buku</th>
                                <th>Nama Buku</th>
                                <th>Tahun</th>
                                <th>Penulis</th>
                                <th>Rak</th>
                                <th>Genre</th>
                                <th>Status</th>
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
                                <th><?= $bk["status"]; ?></th>
                                <th>
                                    <a href="../update/updateBuku.php?id=<?= $bk["id_buku"]; ?>">
                                        <img src="../icon/update.png" style="text-align: center;" alt="Qries" width="30">
                                    </a>
                                </th>
                                <th>
                                    <a href="../delete/deleteBuku.php?id=<?= $bk["id_buku"]; ?>">
                                        <img src="../icon/delete.png" style="text-align: center;" alt="Qries" width="30">
                                    </a>
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
