<?php 

include "../connection.php";

$id_users = $_GET['id_users'];

$query = "DELETE FROM users WHERE id_users = $id_users";
$sql = mysqli_query($conn, $query);

if($sql){
    echo "<script>alert('Berhasil Delete Pelanggan');location.href='../../pelanggan.php';</script>";
}
else{
    echo "<script>alert('Gagal Delete Pelanggan');history.back();</script>";
}


?>