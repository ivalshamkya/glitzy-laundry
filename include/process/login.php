<?php
    session_start();
    include "../connection.php";
	$Email = $_POST['email']; #mengambil inputan email user dari form login
    $Password = md5($_POST['password']); #mengambil inputan email user dari form login
    
    #query untuk mengecek apakah data yang diinputkan user ada di table tb_users
    $sql = "SELECT * FROM users WHERE email='$Email' AND password='$Password'";
    $query = mysqli_query($conn, $sql); #fungsi untuk mengeksekusi query diatas
    $row = mysqli_num_rows($query);

    if ($row>0) {

        $data=mysqli_fetch_array($query);
        
        $_SESSION['email'] = $data['email'];
        $_SESSION['username'] = ucfirst($data['username']);
        $_SESSION['password'] = $data['password'];
        $_SESSION['id_users'] = $data['id_users'];
        $_SESSION['level'] = $data['level'];
        
        $user = $data['email'];
        $level = $data['level'];

        $query = mysqli_query($conn, $sql);
        echo"
        <script>
            alert('Login Berhasil');
            location.href='../../dashboard.php';
        </script>
        ";
    } else {
        echo"
        <script>
            alert('Login Gagal');
            history.back();
        </script>
    ";
    }
?>