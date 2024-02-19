<?php

include "../connection.php";

$id_pesanan = $_POST['id_pesanan'];
$id_jenis = $_POST['jenis'];
$berat = $_POST['jumlah'];
$status = $_POST['status'];

if($status == ""){
    $query = "UPDATE `pesanan` SET `id_jenis`='$id_jenis',`berat`='$berat' WHERE id_pesanan = $id_pesanan";
}
else{
    $query = "UPDATE `pesanan` SET `status`='$status' WHERE id_pesanan = $id_pesanan";
}
$sql = mysqli_query($conn, $query);

if($sql){
    echo"<script>alert('Berhasil Update Pesanan');location.href='../../pemesanan.php';</script>";
}
else{
    echo"<script>alert('Gagal Update Pesanan');history.back();</script>";
}





?>