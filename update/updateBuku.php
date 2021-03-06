<?php

require '../conn.php';

$id_buku = $_GET["id"];
$buku = $conn->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
$buku->bindParam(":id_buku", $id_buku);
$buku->execute();

$genre = ["Petualangan", "Fantasi", "Fiksi", "Sejarah", "Sastra", "Humor", "Horror", "Teknologi", "Romansa", "Anak", "Misteri", "Lainnya"];

if(isset($_POST["submit"])){
    if(updateBuku($_POST) > 0){
        echo "
            <script>
                alert('Data Berhasil Diupdate!');
                document.location.href = '../dataIndex/indexBuku.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = '../dataIndex/indexBuku.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Buku</title>
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
                <h2>Update Buku</h2>
                <center>
                    <div class="add-brg">
                        <form action="" method="POST">
                            <?php while ($bk = $buku->fetch(PDO::FETCH_ASSOC)) :  ?>
                                <label>Kode Buku</label><br>
                                <input class="kolom" type="text" name="id_buku" value="<?= $bk["id_buku"]; ?>" required readonly><br>
                                <label>Judul Buku</label><br>
                                <input class="kolom" type="text" name="judul" required value="<?= $bk["judul"]; ?>"><br>
                                <label>Tahun</label><br>
                                <input class="kolom" type="text" name="tahun" required value="<?= $bk["tahun"]; ?>"><br>
                                <label>Penulis</label><br>
                                <input class="kolom" type="text" name="penulis" required value="<?= $bk["penulis"]; ?>"><br>
                                <label>Rak Buku</label><br>
                                <input class="kolom" type="number" min="1" max="10" name="rak" required value="<?= $bk["rak"]; ?>"><br>
                                <label>Genre</label><br>
                                <select class="kolom" name="genre" required>
                                    <option value="">Pilih Genre</option>
                                    <?php foreach($genre as $g) : ?>
                                        <?php if($bk["genre"] == $g) : ?>
                                            <option value="<?= $g ?>" selected><?= $g ?></option>
                                        <?php else : ?>
                                            <option value="<?= $g ?>"><?= $g ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?> <br><br>
                                <input type="hidden" name="status" value="<?= $bk["status"]; ?>"><br>
                                <center>
                                    <input class="button" type="submit" name="submit" value="Update">
                                </center>
                            <?php endwhile; ?>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>
