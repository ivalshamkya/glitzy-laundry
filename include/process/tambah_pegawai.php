<?php 

include "../connection.php";

$id_users = $_POST['id_users'];

$query = "INSERT INTO pegawai (`id_users`) VALUES ($id_users)";
$sql = mysqli_query($conn, $query);

if($sql){
    echo "<script>alert('Berhasil Tambah Pegawai');location.href='../../pegawai.php';;</script>";
}
else{
    echo "<script>alert('Gagal Tambah Pegawai');history.back();</script>";
}
?>

