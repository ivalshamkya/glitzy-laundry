<?php

    include "include/connection.php";

    if(empty($_SESSION["email"])) {
    echo"
    <script>
        alert('Belum login');
        location.href='index.html';
    </script>";
    }
    $kode = $_POST['kode_pesanan'];
    $level = $_SESSION['level'];
    $id_pelanggan = $_SESSION['id_users'];

    if($level != 'pelanggan'){
        $query = "SELECT * FROM `pesanan` WHERE id_pesanan NOT IN(SELECT id_pesanan FROM transaksi) AND status = 'selesai'";
        $sql = mysqli_query($conn, $query);

        $query4 = "SELECT * FROM transaksi";
        $sql4 = mysqli_query($conn, $query4);

        if($kode != ""){
            $query2 = "SELECT * FROM pesanan WHERE kode_pesanan = '$kode'";
            $sql2 = mysqli_query($conn, $query2);
            $data2 = mysqli_fetch_array($sql2);
        }
    }
    else{
        $query4 = "SELECT t.*, p.id_pesanan, p.kode_pesanan, p.id_pelanggan, p.id_jenis, p.berat, p.tanggal, p.status as status_pesanan FROM transaksi t INNER JOIN pesanan as p ON t.id_pesanan = p.id_pesanan WHERE p.id_pelanggan = $id_pelanggan;";
        $sql4 = mysqli_query($conn, $query4);

        $query = "SELECT * FROM pesanan WHERE status = 'selesai' AND id_pelanggan = $id_pelanggan";
        $sql = mysqli_query($conn, $query);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <link href="css/dashboard.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Glitzy Laundry</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-person-circle"></i> <?= $_SESSION['username']; ?></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person"></i>&nbsp;My Profile</a></li>
                        <li><a class="dropdown-item" onclick="Logout();"><i class="bi bi-box-arrow-right"></i>&nbsp;Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <?php if($_SESSION['level'] == 'pelanggan'){ ?>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="pemesanan.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-basket"></i></div>
                                Pemesanan
                            </a>
                            <a class="nav-link" href="transaksi.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-cash"></i></div>
                                Transaksi
                            </a>
                        </div>
                        <?php } ?>
                        <?php if($_SESSION['level'] == 'admin'){ ?>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="pegawai.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-badge"></i></div>
                                Pegawai
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-people"></i></div>
                                Pelanggan
                            </a>
                            <a class="nav-link" href="jenis_laundry.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tshirt"></i></div>
                                Jenis Laundry
                            </a>
                            <a class="nav-link" href="pemesanan.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-basket"></i></div>
                                Pemesanan
                            </a>
                            <a class="nav-link" href="transaksi.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-cash"></i></div>
                                Transaksi
                            </a>
                            <div class="sb-sidenav-menu-heading">Lainnya</div>
                            <a class="nav-link" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Laporan
                            </a>
                            
                        </div>
                        <?php } ?>
                        <?php if($_SESSION['level'] == 'kasir'){ ?>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-people"></i></div>
                                Pelanggan
                            </a>
                            <a class="nav-link" href="transaksi.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-cash"></i></div>
                                Transaksi
                            </a>
                            <div class="sb-sidenav-menu-heading">Lainnya</div>
                            <a class="nav-link" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Laporan
                            </a>
                        </div>
                        <?php } ?>
                        <?php if($_SESSION['level'] == 'owner'){ ?>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Laporan
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="sb-sidenav-footer text-capitalize">
                        <div class="small">Login Sebagai :</div>
                        <?= $_SESSION['username']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Table Transaksi</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <div style="margin-right:auto;">
                                    <i class="fa fa-table me-1"></i>
                                    Daftar Transaksi
                                </div>
                            </div>
                            <?php if($_SESSION['level'] != 'pelanggan'){ ?>
                            <div class="card-body">
                            <form method="post" action="">
                                <label for="KT">Kode Pesanan</label>
                                <select name="kode_pesanan" id="KT" class="form-select" onchange="submit()">
                                    <option selected disabled>-- Select --</option>
                                    <?php while($data = mysqli_fetch_array($sql)){ ?>
                                    <?php if($kode == $data['kode_pesanan']){?>
                                        <option value="<?= $data['kode_pesanan'] ?>" selected><?= $data['kode_pesanan'] ?></option>
                                    <?php } else {?>
                                        <option value="<?= $data['kode_pesanan'] ?>"><?= $data['kode_pesanan'] ?></option>
                                    <?php }} ?>
                                </select>
                            </form>
                            <br>
                            <?php if($kode != ""){
                                $jl = $data2['id_jenis'];
                                $query3 = "SELECT * FROM jenis_laundry WHERE id_jenis = '$jl'";
                                $sql3 = mysqli_query($conn, $query3);
                                $data3 = mysqli_fetch_array($sql3);
                                ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Jenis</th>
                                        <th>Berat (Kg)</th>
                                        <th>Biaya Antar</th>
                                        <th>Total Bayar</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" name="jenis" value="<?= $data3['jenis'] ?>" disabled></td>
                                            <td><input type="text" class="form-control" name="berat" value="<?= $data2['berat'] ?>" disabled></td>
                                            <td>
                                                <?php
                                                if($data2['berat'] > 7){$ba = 5000;}
                                                else if($data2['berat'] > 15){$ba = 10000;}
                                                else if($data2['berat'] > 21){$ba = 15000;}
                                                else{$ba = 0;}
                                                ?>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control" value="<?= number_format($ba); ?>" aria-describedby="basic-addon1" readonly>
                                            </div>
                                            </td>
                                            <td>
                                                <?php $total = $data3['harga'] * $data2['berat'] + $ba; ?>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control" value="<?= number_format($total); ?>" aria-describedby="basic-addon1" readonly>
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <th>Total Bayar</th>
                                        <th colspan="3" class="text-danger">
                                            <?= number_format($data3['harga']) ?> x <?= $data2['berat'] ?> 
                                            <br>
                                            <?php if($ba > 0){ ?>
                                            = <?=number_format($t = $data3['harga'] * $data2['berat'] ) ?> + Rp. <?= number_format($ba) ?>
                                            <br>
                                            <?php } ?>
                                        <!-- $total = $data3['harga'] * $data2['berat'] + $ba; -->
                                            <h2> = Rp. <?= number_format($total) ?></h2></th>
                                    </tfoot>
                                </table>
                                <form action="include/process/tambah_transaksi.php" method="POST">
                            <input type="hidden" name="id_pesanan" value="<?= $data2['id_pesanan'] ?>">
                            <input type="hidden" name="tanggal_ambil" value="<?= $data2['tanggal'] ?>">
                            <!-- <input type="hidden" name="jenis" value="<?= $data3['jenis'] ?>">
                            <input type="hidden" name="berat" value="<?= $data2['berat'] ?>"> -->
                            <!-- <input type="hidden" name="biaya_antar" class="form-control" value="<?= $ba ?>"> -->
                            <input type="hidden" name="total" class="form-control" value="<?= $total ?>">
                            <center>
                                <button class="btn btn-primary px-5 mb-4">Simpan</button>
                            </center>
                            </form>
                            <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </main>
                <main>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pesanan</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pesanan</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $i=1;
                                            while($data4 = mysqli_fetch_array($sql4)){
                                                $idp = $data4['id_pesanan'];
                                                $query5 = "SELECT * FROM pesanan WHERE id_pesanan = $idp";
                                                $sql5 = mysqli_query($conn, $query5);
                                                $data5 = mysqli_fetch_array($sql5);
                                        ?>
                                        <tr>
                                            <td align="center"> <?= $i++?> </td>
                                            <td> <a href="detail_transaksi.php?id_transaksi=<?= $data4['id_transaksi']?>&kode_pesanan=<?= $data5['kode_pesanan']?>"> <?= $data5['kode_pesanan']?> </a></td>
                                            <td> <?= $data5['tanggal']?> </td>
                                            <td align="center"> <?= ucfirst($data4['status']) ?> </td>
                                            <td align="center">
                                                <a href="include/process/delete_transaksi.php?id_transaksi=<?=$data4['id_transaksi'];?>" class="btn btn-danger mx-1"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Glitzy Laundry 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
