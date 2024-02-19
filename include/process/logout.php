<?php 
    include "../connection.php";
    session_destroy();
    echo"
    <script>
        alert('Berhasil Logout');
       location.href='../../index.html';
    </script>";
?>