<?php

    include "include/connection.php";
    error_reporting(0);
    if(empty($_SESSION["email"])) {
    echo"
    <script>
        alert('Belum login');
        location.href='index.html';
    </script>";
    }
    $bulan = $_POST['bulan'];
    $def_bulan = date('m');
    $level = $_SESSION['level'];
    $id_pelanggan = $_SESSION['id_users'];

    if(!empty($bulan)){
        $query = "SELECT * FROM transaksi WHERE MONTH(tanggal_antar) = $bulan";
        $query4 = "SELECT SUM(total) AS pemasukan FROM transaksi WHERE MONTH(tanggal_antar) = $bulan";
        if($bulan == '01'){$month = "Januari";}
        else if($bulan == '02'){$month = "Februari";}
        else if($bulan == '03'){$month = "Maret";}
        else if($bulan == '04'){$month = "April";}
        else if($bulan == '05'){$month = "Mei";}
        else if($bulan == '06'){$month = "Juni";}
        else if($bulan == '07'){$month = "Juli";}
        else if($bulan == '08'){$month = "Agustus";}
        else if($bulan == '09'){$month = "September";}
        else if($bulan == '10'){$month = "Oktober";}
        else if($bulan == '11'){$month = "November";}
        else if($bulan == '12'){$month = "Desember";}
    }
    else{
        $query = "SELECT * FROM transaksi WHERE MONTH(tanggal_antar) = $def_bulan";
        $query4 = "SELECT SUM(total) AS pemasukan FROM transaksi WHERE MONTH(tanggal_antar) = $def_bulan";
        if($def_bulan == '01'){$month = "Januari";}
        else if($def_bulan == '02'){$month = "Februari";}
        else if($def_bulan == '03'){$month = "Maret";}
        else if($def_bulan == '04'){$month = "April";}
        else if($def_bulan == '05'){$month = "Mei";}
        else if($def_bulan == '06'){$month = "Juni";}
        else if($def_bulan == '07'){$month = "Juli";}
        else if($def_bulan == '08'){$month = "Agustus";}
        else if($def_bulan == '09'){$month = "September";}
        else if($def_bulan == '10'){$month = "Oktober";}
        else if($def_bulan == '11'){$month = "November";}
        else if($def_bulan == '12'){$month = "Desember";}
        
    }
    $sql = mysqli_query($conn, $query);
    $sql4 = mysqli_query($conn, $query4);
    $sum = mysqli_fetch_array($sql4);

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
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-print-none">
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
                            <a class="nav-link" href="dashboard.php">
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
                            <a class="nav-link" href="dashboard.php">
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
                            <a class="nav-link" href="dashboard.php">
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
                            <a class="nav-link" href="dashboard.php">
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
                    <h1 class="mt-4">Laporan Bulan <?= $month ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Table Laporan Bulan <?= $month ?></li>
                        </ol>
                        <div class="card mb-4">
                        <div class="card-header d-flex d-print-none">
                                <div style="margin-right:auto;">
                                    <i class="fa fa-table me-1"></i>
                                    Daftar Transaksi Bulan <?= $month ?>
                                </div>
                                <div>
                                    <button class="btn btn-success mx-2" onclick="print()"><i class="fa fa-print"></i>Print</button>
                                </div>
                                <div>
                                    <form method="POST">
                                        <select name="bulan" id="bulan" class="form-select" onchange="submit()">
                                            <option selected disabled>-- Select --</option>
                                            <?php if($bulan == '01'){?>
                                            <option value="01" selected>Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '02'){?>
                                                <option value="01">Januari</option><option value="02" selected>Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '03'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03" selected>Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '04'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04" selected>April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '05'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05" selected>Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '06'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06" selected>Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '07'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07" selected>Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '08'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08" selected>Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '09'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09" selected>September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '10'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10" selected>Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '11'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11" selected>November</option><option value="12">Desember</option>
                                            <?php } else if($bulan == '12'){?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11" selected>November</option><option value="12" selected>Desember</option>
                                            <?php } else{?>
                                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                            <?php } ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pesanan</th>
                                            <th>Nama</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pesanan</th>
                                            <th>Nama</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $i=1;
                                            while($data = mysqli_fetch_array($sql)){
                                                $idp = $data['id_pesanan'];
                                                $query2 = "SELECT * FROM pesanan WHERE id_pesanan = $idp";
                                                $sql2 = mysqli_query($conn, $query2);
                                                $data2 = mysqli_fetch_array($sql2);
                                                $id = $data2['id_pelanggan'];
                                                $query3 = "SELECT * FROM users WHERE id_users = $id";
                                                $sql3 = mysqli_query($conn, $query3);
                                                $data3 = mysqli_fetch_array($sql3);
                                        ?>
                                        <tr>
                                            <td align="center"> <?= $i++?> </td>
                                            <td> <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi']?>&kode_pesanan=<?= $data2['kode_pesanan']?>"> <?= $data2['kode_pesanan']?> </a></td>
                                            <td align="center"> <?= ucfirst($data3['username']) ?></td>
                                            <td> <?= $data2['tanggal']?> </td>
                                            <td align="center">Rp.<?= number_format($data['total']) ?> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>                                    
                                </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <td><h4>Total Pemasukan</h4></td>
                                        <td colspan="4" class="text-danger"><h4>Rp.<?= number_format($sum['pemasukan'])?></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Glitzy Laundry 2022</div>
                            <div class="d-print-none">
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
