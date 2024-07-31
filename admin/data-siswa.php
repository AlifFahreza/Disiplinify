<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

$namaadmin = $_SESSION['namalengkap'];
$username = $_SESSION['username'];
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
            <div class="sidebar-brand-text mx-3">Disiplinify.</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
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
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Data Administratif</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilihan Menu:</h6>
                    <a class="collapse-item" href="data-siswa.php">Data Siswa</a>
                    <a class="collapse-item" href="data-walikelas.php">Data Wali Kelas</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pelanggaran Siswa</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilihan Menu:</h6>
                    <a class="collapse-item" href="data-kriteria.php">Kriteria Pelanggaran</a>
                    <a class="collapse-item" href="data-peraturan.php">Peraturan Sekolah</a>
                    <a class="collapse-item" href="pelanggaran.php">Pelanggaran Siswa</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form action="" method="get"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Data Siswa..."
                            aria-label="Search" aria-describedby="basic-addon2" name="cari">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form action="" method="GET" class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" name="cari" class="form-control bg-light border-0 small"
                                        placeholder="Cari Siswa..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php echo "Hi " . $namaadmin . "!" ?>
                            </span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a href="update-profile.php" class="dropdown-item" data-toggle="modal"
                                    data-target="#profileModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <div class="container-fluid">

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
                        <form class="g-3 needs-validation" action="action/action-input-siswa.php" method="POST"
                            name="form-input-siswa" novalidate>
                            <div class="row">
                                <div class="col">
                                    <label for="validationCustom01" class="form-label">Inputkan NIS Siswa</label>
                                    <input type="number" class="form-control" placeholder="Nomor Induk Siswa"
                                        aria-label="NIS" name="nis" required>
                                    <div class="invalid-feedback">
                                        Masukkan NIS terlebih dahulu!
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="exampleInputNama" class="form-label">Inputkan Nama Siswa</label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                        aria-label="Nama Lengkap" name="nama" required>
                                    <div class="invalid-feedback">
                                        Masukkan nama siswa terlebih dahulu!
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label for="exampleInputNIS" class="form-label">Pilih Kelas dan Jurusan</label>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" id="exampleFormControlSelect1" name="angkatan"
                                        required>
                                        <option selected disabled value="">Pilih...</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih kelas terlebih dahulu
                                    </div>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="exampleFormControlSelect1" name="jurusan" required>
                                        <option selected disabled value="">Pilih...</option>
                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                        <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan
                                        </option>
                                        <option value="Teknik Mesin">Teknik Mesin</option>
                                        <option value="Animasi">Animasi</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih jurusan terlebih dahulu
                                    </div>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="exampleFormControlSelect1" name="kelas" required>
                                        <option selected disabled value="">Pilih...</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih kelas terlebih dahulu
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-9 col-12">
                                    <div class="btn-group w-100">
                                    <button class="btn btn-primary" type="submit" name="Submit">Tambah Data
                                            Siswa</button>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="btn-group w-100">
                                    <a class="btn btn-success" href="import-excel-siswa.php"><i class="fas fa-file-excel"></i> Import Data
                                            Siswa</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kelas</th>
                                        <th colspan="3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../config.php';

                                    $batas = 10;
                                    $halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
                                    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                                    $previous = $halaman - 1;
                                    $next = $halaman + 1;

                                    $data = mysqli_query($conn, "select * from siswa");
                                    $jumlah_data = mysqli_num_rows($data);
                                    $total_halaman = ceil($jumlah_data / $batas);
                                    $nomor = $halaman_awal + 1;

                                    if (isset($_GET['cari'])) {
                                        $filtervalues = $_GET['cari'];
                                        $data_siswa = mysqli_query($conn, "select * from siswa WHERE concat(nis,nama) LIKE '%$filtervalues%' limit $halaman_awal, $batas");
                                    } else {
                                        $data_siswa = mysqli_query($conn, "select * from siswa limit $halaman_awal, $batas");
                                    }

                                    while ($d = mysqli_fetch_array($data_siswa)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $nomor++; ?>
                                            </td>
                                            <td>
                                                <?php echo $d['nis']; ?>
                                            </td>
                                            <td>
                                                <?php echo $d['nama']; ?>
                                            </td>
                                            <td>
                                                <?php echo $d['kelas'];
                                                echo (" ");
                                                echo $d['jurusan'];
                                                echo (" ");
                                                echo $d['subkelas'] ?>
                                            </td>
                                            <td width='300'>
                                                <a href="tambah-pelanggaran.php?nis=<?php echo $d['nis']; ?>"
                                                    class="btn btn-success btn-sm">Tambah
                                                    Pelanggaran Siswa</a>
                                                <a href="#editEmployeeModal<?php echo $d['nis']; ?>"
                                                    class="fas fa-edit bg-warning p-2 text-white rounded edit"
                                                    data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                        title="Edit"></i></a>
                                                <a href="#deleteEmployeeModal<?php echo $d['nis']; ?>" class="delete"
                                                    data-toggle="modal"><i
                                                        class="fas fa-trash-alt bg-danger p-2 text-white rounded hapus"
                                                        data-toggle="tooltip" title="Delete"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal HTML -->
                                        <div id="editEmployeeModal<?php echo $d['nis']; ?>" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post" action="action/action-update-siswa.php">
                                                        <input type="hidden" class="form-control"
                                                            value="<?php echo $d['nis']; ?>" name="nis" required>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Siswa</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>NIS</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo $d['nis']; ?>" name="nis" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Lengkap</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo $d['nama']; ?>" name="nama" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Angkatan</label>
                                                                <select class="form-control" id="exampleFormControlSelect1"
                                                                    name="angkatan" required>
                                                                    <option value="10" <?= ($d["kelas"] == "10") ? "selected" : "" ?>>Kelas 10</option>
                                                                    <option value="11" <?= ($d["kelas"] == "11") ? "selected" : "" ?>>Kelas 11</option>
                                                                    <option value="12" <?= ($d["kelas"] == "12") ? "selected" : "" ?>>Kelas 12</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jurusan</label>
                                                                <select class="form-control" id="exampleFormControlSelect1"
                                                                    name="jurusan" required>
                                                                    <option value="Rekayasa Perangkat Lunak"
                                                                        <?= ($d["jurusan"] == "Rekayasa Perangkat Lunak") ? "selected" : "" ?>>Rekayasa Perangkat Lunak</option>
                                                                    <option value="Desain Komunikasi Visual"
                                                                        <?= ($d["jurusan"] == "Desain Komunikasi Visual") ? "selected" : "" ?>> Desain Komunikasi Visual
                                                                    </option>
                                                                    <option value="Teknik Komputer dan Jaringan"
                                                                        <?= ($d["jurusan"] == "Teknik Komputer dan Jaringan") ? "selected" : "" ?>>Teknik Komputer dan Jaringan
                                                                    </option>
                                                                    <option value="Teknik Mesin" <?= ($d["jurusan"] == "Teknik Mesin") ? "selected" : "" ?>>Teknik Mesin</option>
                                                                    <option value="Animasi" <?= ($d["jurusan"] == "Animasi") ? "selected" : "" ?>>Animasi</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kelas</label>
                                                                <select class="form-control" id="exampleFormControlSelect1"
                                                                    name="kelas" required>
                                                                    <option value="A" <?= ($d["subkelas"] == "A") ? "selected" : "" ?>>Kelas A</option>
                                                                    <option value="B" <?= ($d["subkelas"] == "B") ? "selected" : "" ?>>Kelas B</option>
                                                                    <option value="C" <?= ($d["subkelas"] == "C") ? "selected" : "" ?>>Kelas C</option>
                                                                    <option value="D" <?= ($d["subkelas"] == "D") ? "selected" : "" ?>>Kelas D</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="button" class="btn btn-default"
                                                                data-dismiss="modal" value="Cancel">
                                                            <input type="submit" class="btn btn-info" value="Save"
                                                                name="edit">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal HTML -->
                                        <div id="deleteEmployeeModal<?php echo $d['nis']; ?>" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post" action="action/action-delete-siswa.php">
                                                        <input type="hidden" class="form-control"
                                                            value="<?php echo $d['nis']; ?>" name="nis" required>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data Siswa</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus data siswa bernama
                                                                <?php echo $d['nama']; ?>?
                                                            </p>
                                                            <p class="text-warning"><small>Data yang sudah terhapus tidak
                                                                    bisa dikembalikan lagi</small></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="button" class="btn btn-default"
                                                                data-dismiss="modal" value="Cancel">
                                                            <input type="submit" class="btn btn-danger" value="Delete"
                                                                name="delete">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" <?php if ($halaman > 1) {
                                            echo "href='?halaman=$previous'";
                                        } ?>>Previous</a>
                                    </li>
                                    <?php
                                    for ($x = 1; $x <= $total_halaman; $x++) {
                                        ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                        <?php
                                    }
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                            echo "href='?halaman=$next'";
                                        } ?>>Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
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

<!-- Edit Modal HTML -->
<div id="profileModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="action/action-update-admin.php">
                    <?php
                    $sql = mysqli_query($conn, "select * from admin where username='$username'");
                    if (mysqli_num_rows($sql) == 0) {
                    } else {
                        $rowadmin = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <input type="hidden" class="form-control" value="<?php echo $rowadmin['id_admin']; ?>"
                        name="id_admin" required>
                    <div class="modal-header">
                        <h4 class="modal-title">Profile Admin</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Lengkap:</label>

                            <input type="text" class="form-control" name="namalengkap"
                                value="<?php echo $rowadmin['namalengkap'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Username:</label>

                            <input type="text" class="form-control" name="username"
                                value="<?php echo $rowadmin['username'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Password Baru:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" required>
                                <span class="input-group-text" id="showHide">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save" name="edit">
                    </div>
                </form>
            </div>
        </div>
    </div>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

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
</body>

</html>