<?php
include "include/connection.php";
if (empty($_SESSION["email"])) {
    echo "
      <script>
          alert('Belum login');
          location.href='index.html';
      </script>";
}
$id_users = $_SESSION['id_users'];

$query2 = "SELECT * FROM users WHERE id_users = '$id_users'";
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
                    <h1 class="mt-4">My Profile</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Update Profile</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            Update Profile 
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="include/process/update_profile.php" method="POST">
                                <input type="hidden" value="<?= $id_users ?>" name="id_users">
                                <div class="col-md-4 pt-1">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="inputEmail" value="<?= $data2['email'] ?>" required>
                                </div>
                                <div class="col-md-4 pt-1">
                                    <label for="inputUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="inputUsername" value="<?= $data2['username'] ?>" required>
                                </div>
                                <div class="col-md-4 pt-1">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="inputPassword">
                                    <i>*Let it empty if you don't wanna change it.</i>
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control"  name="alamat" id="inputAddress" value="<?= $data2['alamat']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputKontak" class="form-label">Kontak</label>
                                    <input type="text" class="form-control" name="kontak" id="inputKontak" value="<?= $data2['kontak']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputKontak" class="form-label">Jenis Kelamin</label>
                                    <select id="inputKontak" class="form-select" name="jk" required>
                                        <?php if($data2['jk'] == 'Pria'){?>
                                            <option value="<?= $data2['jk']; ?>" selected><?= $data2['jk']?></option>
                                            <option value="Wanita">Wanita</option>
                                        <?php } else {?>
                                            <option value="<?= $data2['jk']; ?>" selected><?= $data2['jk']?></option>
                                            <option value="Pria">Pria</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; GlitzyLaundry 2022</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>