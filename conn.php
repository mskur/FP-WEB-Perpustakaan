<?php

$dbServer = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'perpustakaan';

try{
    $conn = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $err){
    echo "Gagal conn" .  $err->getMessage();
}

function query($query){
    global $conn;
    $result = $conn->query($query);
    $rows = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $rows[] = $row;
    }
    return $rows;
}

function tambahBuku($data){
    global $conn;
    $id_buku = htmlspecialchars($data["id_buku"]);
    $judul = htmlspecialchars($data["judul"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $rak = htmlspecialchars($data["rak"]);
    $genre = htmlspecialchars($data["genre"]);
    $status = htmlspecialchars($data["status"]);
    $img_barcode = $id_buku . ".png";

    //MEMBUAT FOLDER BARCODE
    $tempdir = "../img-barcode/";
    if(!file_exists($tempdir))
    mkdir($tempdir, 0755);
    $target_path = $tempdir . $id_buku . ".png";
    //$sprotocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    //$fileImage = $sprotocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/../barcode.php?text=" . $id_buku . "&codetype=code128&print=true&size=55";
    $fileImage = "http://localhost".dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $id_buku . "&codetype=code128&print=true&size=55";
    $content = file_get_contents($fileImage);
    $p = file_put_contents($target_path, $content);

    $query = $conn->prepare("INSERT INTO buku VALUES (:id_buku, :judul, :tahun, :penulis, :rak, :genre, :status, :barcode)");
    $query->bindParam(":id_buku", $id_buku);
    $query->bindParam(":judul", $judul);
    $query->bindParam(":tahun", $tahun);
    $query->bindParam(":penulis", $penulis);
    $query->bindParam(":rak", $rak);
    $query->bindParam(":genre", $genre);
    $query->bindParam(":status", $status);
    $query->bindParam(":barcode", $img_barcode);
    return $query->execute();
}

function deleteBuku($id_buku){
    global $conn;
    $query = $conn->prepare("DELETE FROM buku WHERE id_buku = :id_buku");
    $query->bindParam(":id_buku", $id_buku);
    unlink("../img-barcode/" . $id_buku . ".png");
    return $query->execute();
}

function updateBuku($data){
    global $conn;
    $id_buku = htmlspecialchars($data["id_buku"]);
    $judul = htmlspecialchars($data["judul"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $rak = htmlspecialchars($data["rak"]);
    $genre = htmlspecialchars($data["genre"]);
    $status = htmlspecialchars($data["status"]);

    $query = $conn->prepare("UPDATE buku SET judul = :judul, tahun = :tahun, penulis = :penulis, rak = :rak, genre = :genre, status = :status WHERE id_buku = :id_buku");
    $query->bindParam(":id_buku", $id_buku);
    $query->bindParam(":judul", $judul);
    $query->bindParam(":tahun", $tahun);
    $query->bindParam(":penulis", $penulis);
    $query->bindParam(":rak", $rak);
    $query->bindParam(":genre", $genre);
    $query->bindParam(":status", $status);
    return $query->execute();
}

?>