<?php

    include "include/connection.php";

    if(empty($_SESSION["email"])) {
    echo"
    <script>
        alert('Belum login');
        location.href='index.html';
    </script>";
    }
    $kode = $_GET['kode_pesanan'];
    $id = $_GET['id_transaksi'];

    $query = "SELECT * FROM transaksi WHERE id_transaksi = $id";
    $sql = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($sql);

    $query2 = "SELECT * FROM pesanan INNER JOIN jenis_laundry ON pesanan.id_jenis=jenis_laundry.id_jenis INNER JOIN users ON pesanan.id_pelanggan=users.id_users WHERE kode_pesanan = '$kode';";
    $sql2 = mysqli_query($conn, $query2);
    $data2 = mysqli_fetch_array($sql2);



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
                        <h1 class="mt-4">Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Detail Transaksi <b class="text-success"><?=$kode?></b></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header d-flex">
                                <div style="margin-right:auto;">
                                    <i class="fa fa-table me-1"></i>
                                    Detail Transaksi <b class="text-success"><?=$kode?></b>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if($data['status'] == 'bayar'){ ?>
                                <marquee>Segera Lakukan Pembayaran Agar Kami Dapat Segera Mengirimkan Pakaian Anda &#128522;</marquee>
                                <?php } else if($data['status'] == 'lunas'){ ?>
                                <marquee>Terimakasih Atas Orderannya Kak <?= $_SESSION['username'] ?>, Pakaian Kakak Akan Segera Kami Antar Kerumah &#128150;</marquee>
                                <?php } else if($data['status'] == 'diterima'){ ?>
                                <marquee>Terimakasih Atas Kepercayaan Kak <?= $_SESSION['username'] ?>, Kami Sangat Senang Dapat Membantu &#128522;&#128150;</marquee>
                                <?php } ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode Pesanan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jenis Laundry</th>
                                            <th>Berat (Kg)</th>
                                            <th>Tanggal Ambil</th>
                                            <th>Tanggal Antar</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td align="center"> <?= $kode ?> </td>
                                            <td> <?= ucfirst($data2['username'])?> </td>
                                            <td> <?= $data2['jenis']?> </td>
                                            <td align="center"> <?= $data2['berat']?> </td>
                                            <td align="center"> <?= $data['tanggal_ambil']?> </td>
                                            <?php if($data['tanggal_antar'] == "0000-00-00"){ ?>
                                                <td align="center"> - </td>
                                            <?php } else {?>
                                                <td align="center"> <?= $data['tanggal_antar']?> </td>
                                            <?php } ?>
                                            <td align="center" class="text-danger">Rp. <?= number_format($data['total'])?> </td>
                                            <td align="center"> <?= ucfirst($data['status'])?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php if($data['status'] == 'bayar'){ ?>
                                <center><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Bayar Sekarang</button></center>
                                <?php } else if($data['status'] == 'lunas'){ ?>
                                <form action="include/process/pembayaran.php" method="POST">
                                    <input type="hidden" name="id_transaksi" value="<?= $id ?>">
                                    <input type="hidden" name="proses" value="2">
                                    <center><button type="submit" class="btn btn-primary">Diterima</button></center>
                                </form>
                                <?php } ?>
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


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                    <i>*Mohon Untuk Memasukkan Nominal Pas</i>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="include/process/pembayaran.php" method="POST">
            <div class="modal-body">
                    <i>Nominal Yang Harus Anda Bayar</i>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                        </div>
                        <input type="text" class="form-control text-danger" value="<?= number_format($data['total']); ?>" aria-describedby="basic-addon1" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                        </div>
                        <input type="hidden" name="proses" value="1">
                        <input type="hidden" name="id_transaksi" value="<?= $id ?>">
                        <input type="hidden" name="bayar" value="<?= $data['total'] ?>">
                        <input type="number" name="uang" class="form-control" aria-describedby="basic-addon1" min="0" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
            </form>
            </div>
        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
