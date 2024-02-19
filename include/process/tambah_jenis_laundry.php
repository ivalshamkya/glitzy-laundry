<?php 

include "../connection.php";

$jenis = $_POST['jenis'];
$harga = $_POST['harga']; 

$query = "INSERT INTO `jenis_laundry` (`jenis`,`harga`) VALUES ('$jenis','$harga')";
$sql = mysqli_query($conn,$query);

if($sql){
    echo "<script>alert('Berhasil Tambah Jenis Laundry');location.href='../../jenis_laundry.php';;</script>";
}
else{
    echo "<script>alert('Gagal Tambah Jenis Laundry');history.back();</script>";
}
?>

