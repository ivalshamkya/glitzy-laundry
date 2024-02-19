<?php 

include "../connection.php";

$id_users = $_GET['id_users'];

$query = "DELETE FROM pegawai WHERE id_users = $id_users";
$sql = mysqli_query($conn, $query);

if($sql){
    echo "<script>alert('Berhasil Delete Pegawai');location.href='../../pegawai.php';;</script>";
}
else{
    echo "<script>alert('Gagal Delete Pegawai');history.back();</script>";
}


?>