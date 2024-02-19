<?php 

include "../connection.php";

$que = "SELECT MAX(id_pesanan) AS max FROM pesanan";
$sq = mysqli_query($conn, $que);
$dt = mysqli_fetch_array($sq);


$kode = "GLZY-".$dt['max']+1;
$id_pelanggan = $_SESSION['id_users'];
$id_jenis = $_POST['jenis'];
$berat = $_POST['jumlah']; 

$query = "INSERT INTO `pesanan` (kode_pesanan,id_pelanggan,id_jenis,berat,tanggal,status) VALUES ('$kode','$id_pelanggan','$id_jenis','$berat',NOW(),'proses')";
$sql = mysqli_query($conn,$query);

if($sql){
    echo "<script>alert('Berhasil Tambah Pesanan');location.href='../../pemesanan.php';;</script>";
}
else{
    echo "<script>alert('Gagal Tambah Pesanan');history.back();</script>";
}
?>

