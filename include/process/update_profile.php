<?php

include "../connection.php";

$id_users = $_POST['id_users'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$kontak = $_POST['kontak'];


if($password == ""){
    $query = "UPDATE `users` SET `email`='$email',`username`='$username',`kontak`='$kontak',`jk`='$jk',`alamat`='$alamat' WHERE id_users = $id_users";
}
else{
    $password = md5($password);
    $query = "UPDATE `users` SET `email`='$email',`username`='$username',`password`='$password',`kontak`='$kontak',`jk`='$jk',`alamat`='$alamat' WHERE id_users = $id_users";
}

$sql = mysqli_query($conn, $query);
if($sql){
    echo"<script>alert('Berhasil Update Profile');history.back();</script>";
}
else{
    echo"<script>alert('Gagal Update Profile');history.back();</script>";
}





?>