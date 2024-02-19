<?php 

include "../connection.php";

$username = $_POST['username'];
$email = $_POST['email']; 
$alamat = $_POST['alamat'];
$jk = $_POST['jk'];
$kontak = $_POST['kontak'];
$password = md5($_POST['password']);

$query = "INSERT INTO `users` (email,username,password,kontak,jk,alamat,level) VALUES ('$email','$username','$password','$kontak','$jk','$alamat','pelanggan')";
$sql = mysqli_query($conn,$query);

if($sql){
    echo "<script>alert('Berhasil Tambah Pelanggan');location.href='../../pelanggan.php';;</script>";
}
else{
    echo "<script>alert('Gagal Tambah Pelanggan');history.back();</script>";
}
?>

