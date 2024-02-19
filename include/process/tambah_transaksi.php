<?php 

include "../connection.php";

$id_pesanan = $_POST['id_pesanan'];
$tgl_ambil = $_POST['tanggal_ambil'];
$total = $_POST['total'];

$query = "INSERT INTO `transaksi` (id_pesanan,tanggal_ambil,total,status) VALUES ('$id_pesanan','$tgl_ambil','$total','bayar')";
$sql = mysqli_query($conn,$query);

if($sql){
    echo "<script>alert('Transaksi Berhasil Disimpan');location.href='../../transaksi.php';;</script>";
}
else{
    echo "<script>alert('Transaksi Gagal Disimpan');history.back();</script>";
}
?>

