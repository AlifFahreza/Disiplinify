<?php
session_start();
if (!isset($_SESSION['nis'])) {
    header("Location: ../index.php");
}

include '../config.php';
$namasiswa = $_SESSION['namasiswa'];
$nis = $_SESSION['nis'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Siswa</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard-siswa.php">
            <div class="sidebar-brand-text mx-3">Disiplinify.</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="dashboard-siswa.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="rekap-pelanggaran.php">
                <i class="fas fa-fw fa-file"></i>
                <span>Pelanggaran Siswa</span>
            </a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="edit-profil.php">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Edit Profil</span></a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="ubah-password.php">
                <i class="fas fa-fw fa-eye"></i>
                <span>Ubah Password</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a href="logout.php" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid mt-3">
                <!-- DataTales Example -->
                <?php if (@$_SESSION['insertsuccess']) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['insertsuccess'] ?>
                    </div>
                    <?php unset($_SESSION['insertsuccess']);
                } ?>

                <?php if (@$_SESSION['insertfailed']) { ?>k,
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['insertfailed'] ?>
                    </div>
                    <?php unset($_SESSION['insertfailed']);
                } ?>

                <!-- DataTales Example -->
                <div class="card shadow mb-5">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                    </div>

                    <div class="card-body p-4">
                        <form class="g-3 needs-validation" method="post" action="action/action-update-profil.php"
                            name="form-input-siswa" novalidate>
                            <?php
                            $sql = mysqli_query($conn, "select * from siswa where nis='$nis'");
                            if (mysqli_num_rows($sql) == 0) {
                            } else {
                                $rowEdit = mysqli_fetch_assoc($sql);
                            }
                            ?>
                            <div class="row">
                                <div class="col">
                                    <label for="validationCustom01" class="form-label">Nomor Induk Siswa</label>
                                    <input type="number" class="form-control" aria-label="NIS" name="nis" value="<?php echo $rowEdit['nis']; ?>"
                                        required readonly>
                                    <div class="invalid-feedback">
                                        Masukkan NIS terlebih dahulu!
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="exampleInputNama" class="form-label">Nama Lengkap Siswa</label>
                                    <input type="text" class="form-control" aria-label="Nama Lengkap" name="nama" value="<?php echo $rowEdit['nama']; ?>"
                                        required readonly>
                                    <div class="invalid-feedback">
                                        Masukkan nama siswa terlebih dahulu!
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label for="exampleInputNIS" class="form-label">Kelas dan Jurusan</label>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" id="exampleFormControlSelect1" name="angkatan" required
                                    readonly>
                                        <option value="10" <?= ($rowEdit["kelas"] == "10") ? "selected" : "" ?>>Kelas 10</option>
                                        <option value="11" <?= ($rowEdit["kelas"] == "11") ? "selected" : "" ?>>Kelas 11</option>
                                        <option value="12" <?= ($rowEdit["kelas"] == "12") ? "selected" : "" ?>>Kelas 12</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih kelas terlebih dahulu
                                    </div>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="exampleFormControlSelect1" name="jurusan" required
                                    readonly>
                                        <option value="Rekayasa Perangkat Lunak"<?= ($rowEdit["jurusan"] == "Rekayasa Perangkat Lunak") ? "selected" : "" ?>>Rekayasa Perangkat Lunak</option>
                                        <option value="Desain Komunikasi Visual" <?= ($rowEdit["jurusan"] == "Desain Komunikasi Visual") ? "selected" : "" ?>> Desain Komunikasi Visual</option>
                                        <option value="Teknik Komputer dan Jaringan"<?= ($rowEdit["jurusan"] == "Teknik Komputer dan Jaringan") ? "selected" : "" ?>>Teknik Komputer dan Jaringan</option>
                                        <option value="Teknik Mesin" <?= ($rowEdit["jurusan"] == "Teknik Mesin") ? "selected" : "" ?>>Teknik Mesin</option>
                                        <option value="Animasi" <?= ($rowEdit["jurusan"] == "Animasi") ? "selected" : "" ?>>Animasi</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih jurusan terlebih dahulu
                                    </div>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="exampleFormControlSelect1" name="kelas" required
                                    readonly>
                                        <option value="A" <?= ($rowEdit["subkelas"] == "A") ? "selected" : "" ?>>Kelas A</option>
                                        <option value="B" <?= ($rowEdit["subkelas"] == "B") ? "selected" : "" ?>>Kelas B</option>
                                        <option value="C" <?= ($rowEdit["subkelas"] == "C") ? "selected" : "" ?>>Kelas C</option>
                                        <option value="D" <?= ($rowEdit["subkelas"] == "D") ? "selected" : "" ?>>Kelas D</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih kelas terlebih dahulu
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="validationCustom01" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" aria-label="tempatlahir" name="tempatlahir" required value="<?php echo $rowEdit['tempatlahir']; ?>">
                                    <div class="invalid-feedback">
                                        Masukkan tempat lahir terlebih dahulu!
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="exampleInputNama" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" aria-label="tgllahir" name="tgllahir" value="<?php echo $rowEdit['tgllahir']; ?>"
                                        required>
                                    <div class="invalid-feedback">
                                        Masukkan tanggal lahir terlebih dahulu!
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="validationCustom01" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" aria-label="alamat" name="alamat" required value="<?php echo $rowEdit['alamat']; ?>">
                                    <div class="invalid-feedback">
                                        Masukkan alamat terlebih dahulu!
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="validationCustom01" class="form-label">No. Handphone</label>
                                    <input type="number" class="form-control" aria-label="nohp" name="nohp" required value="<?php echo $rowEdit['nohp']; ?>">
                                    <div class="invalid-feedback">
                                        Masukkan no handphone terlebih dahulu!
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary w-100" type="submit" name="Submit">Edit Profil</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
    </body>

</html>