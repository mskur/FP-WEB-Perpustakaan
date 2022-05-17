<?php

require '../conn.php';
$kode = $conn->query("SELECT max(id_buku) AS kodeTerbesar FROM buku");
$data = $kode->fetch();
$kodeBaru = $data['kodeTerbesar'];

$urutan = substr($kodeBaru, 4, 3);
$urutan++;
$huruf = "BOOK";
$kodeBaru = $huruf . sprintf("%03s", $urutan);

if(isset($_POST["submit"])){
    if(tambahBuku($_POST) > 0){
        echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                document.location.href = '../dataIndex/indexBuku.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Data Gagal Ditambahkan!');
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
                <h2>Tambah Buku</h2>
                <center>
                    <div class="add-brg">
                        <form action="" method="POST">
                            <label style="margin-right: 10px;">Kode Buku</label>
                            <input class="kolom" type="text" name="id_buku" value="<?= $kodeBaru ?>" required readonly><br>
                            <label style="margin-right: 10px;">Judul Buku</label>
                            <input class="kolom" type="text" name="judul" required><br>
                            <label style="margin-right: 45px;">Tahun</label>
                            <input class="kolom" type="text" name="tahun" required><br>
                            <label style="margin-right: 40px;">Penulis</label>
                            <input class="kolom" type="text" name="penulis" required><br>
                            <label style="margin-right: 22px;">Rak Buku</label>
                            <input class="kolom" type="number" min="1" max="10" name="rak" required><br>
                            <label style="margin-right: 45px;">Genre</label>
                            <input class="kolom" type="text" name="genre" required><br>
                            <label style="margin-right: 45px;">Status</label>
                            <input class="kolom" type="text" name="status" value="Tersedia" readonly><br>
                            <input type="hidden" value="qrcode" name="qrcode">
                            <center>
                                <input class="button" type="submit" name="submit" value="Tambah">
                            </center>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>