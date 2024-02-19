<?php 

include "../connection.php";

$id = $_GET['id_transaksi'];

$query = "DELETE FROM transaksi WHERE id_transaksi = $id";
$sql = mysqli_query($conn, $query);

if($sql){
    echo "<script>alert('Berhasil Delete Pesanan');location.href='../../transaksi.php';</script>";
}
else{
    echo "<script>alert('Gagal Delete Pesanan');history.back();</script>";
}


?>