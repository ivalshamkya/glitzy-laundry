<?php

include "../connection.php";

$id = $_GET['id_jenis'];

$query = "DELETE FROM `jenis_laundry` WHERE id_jenis = $id";
$sql  = mysqli_query($conn, $query);

if($sql){
    echo "<script>
    alert('Berhasil Hapus Jenis Laundry');
    history.back();
    </script>";
}
else{
    echo "<script>
    alert('Gagal Hapus Jenis Laundry');
    history.back();
    </script>";
}


?>