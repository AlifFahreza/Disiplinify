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
        <li class="nav-item">
            <a class="nav-link" href="edit-profil.php">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Edit Profil</span></a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
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

                <?php if (@$_SESSION['insertfailed']) { ?>
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
                        <form class="g-3 needs-validation" action="action/action-update-password.php" method="POST"
                            name="form-input-siswa" novalidate>
                            <div class="row">
                                <input type="hidden" class="form-control" value="<?php echo $nis; ?>" name="nis"
                                    required>
                                <div class="col">
                                    <label for="validationCustom01" class="form-label">Masukkan Password Baru:</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" aria-label="password" id="password" name="password"
                                            required>
                                        <span class="input-group-text" id="showHide">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        <div class="invalid-feedback">
                                            Masukkan Password Baru Terlebih Dahulu!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="validationCustom01" class="form-label">Ulangi Password Baru:</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" aria-label="password"
                                            name="konfirmpassword" id="password" required>
                                        <span class="input-group-text" id="showHide">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        <div class="invalid-feedback">
                                            Ulangi Konfimasi Password Baru Terlebih Dahulu!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary w-100" type="submit" name="Submit">Ubah Password</button>
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

    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

    </script>

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
    <script src="../js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
    </body>

</html>