<?php

include "../connection.php";

$id = $_POST['id_transaksi'];
$proses = $_POST['proses'];



if($proses == 1){

    $uang = $_POST['uang'];
    $bayar = $_POST['bayar'];

    if($uang >= $bayar){

        $query = "UPDATE transaksi SET `status` = 'lunas' WHERE id_transaksi = $id";
        $sql = mysqli_query($conn, $query);

        if($sql){
        echo "<script>
        alert('Pembayaran Berhasil, Pakaian Anda Akan Segera Kami Antar');
        location.href='../../transaksi.php';
        </script>";
        }
    }
    else{
        echo "<script>
        alert('Pembayaran Gagal Nominal Yang Anda Masukkan Kurang');
        history.back();
        </script>";
    }
}
else if($proses == 2){
    $query = "UPDATE transaksi SET `status` = 'diterima', `tanggal_antar` = NOW() WHERE id_transaksi = $id";
    $sql = mysqli_query($conn, $query);

    if($sql){
    echo "<script>
    alert('Terimakasih Atas Kepercayaan Anda Pada Kami');
    location.href='../../transaksi.php';
    </script>";
    }
}
?>