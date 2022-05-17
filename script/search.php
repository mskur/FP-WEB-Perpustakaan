<?php

require '../conn.php';
$keyword = $_GET["keyword"];

$buku = query("SELECT * FROM buku
                        WHERE
                        judul LIKE '%$keyword%' OR
                        penulis LIKE '%$keyword%' OR
                        rak LIKE '%$keyword%' OR
                        tahun LIKE '%$keyword%' OR
                        id_buku LIKE '%$keyword%' OR
                        genre LIKE '%$keyword%'");

?>


<?php if($buku == null): ?>
    <h1 style="text-align: center; ">Data tidak ditemukan</h1>

<?php else: ?>
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
            <?php foreach($buku as $bk) : ?>

            <tr>
                <th><?= $bk["id_buku"]; ?></th>
                <td><?= $bk["judul"]; ?></td>
                <td class="atur"><?= $bk["tahun"]; ?></td>
                <td><?= $bk["penulis"]; ?></td>
                <td class="atur"><?= $bk["rak"]; ?></td>
                <td><?= $bk["genre"]; ?></td>
                <td class="atur"><?= $bk["status"]; ?></td>
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
<?php endif; ?>