<?php

require '../conn.php';

$id_buku = $_GET["id"];
    if(deleteBuku($id_buku) > 0){
        echo "
            <script>
                alert('Data Berhasil Dihapus');
                document.location.href = '../dataIndex/indexBuku.php';
            </script>";
    }

    else{
        echo "
            <script>
                alert('Data Gagal Dihapus');
                document.location.href = '../dataIndex/indexBuku.php';
            </script>";
    }



?>