<?php 

include "../connection.php";

$id_pesanan = $_GET['id_pesanan'];

$query = "DELETE FROM pesanan WHERE id_pesanan = $id_pesanan";
$sql = mysqli_query($conn, $query);

if($sql){
    echo "<script>alert('Berhasil Delete Pesanan');location.href='../../pemesanan.php';</script>";
}
else{
    echo "<script>alert('Gagal Delete Pesanan');history.back();</script>";
}


?>