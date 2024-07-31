<?php
session_start();
if (!isset($_SESSION['nis'])) {
    header("Location: ../index.php");
}

include '../config.php';
$namasiswa = $_SESSION['namasiswa'];
$nis = $_SESSION['nis'];

//PERHITUNGAN METODE SMART
// Step 1 Langkah 1: Tentukan banyaknya kriteria dan Berikan bobot ke masing-masing kriteria dengan interval 1-100
$query_kriteria = "SELECT * FROM kriteria";
$result_kriteria = mysqli_query($conn, $query_kriteria);

// Step 1 Langkah 2 Buat array asosiatif untuk menyimpan nilai kriteria
$kriteria = [];
while ($row_kriteria = mysqli_fetch_assoc($result_kriteria)) {
    $kriteria[$row_kriteria['namakriteria']] = $row_kriteria['bobot'];
}

// Step 2 sudah gabung di step 1
// Step 3 Ambil nilai kriteria untuk siswa tertentu (misalnya, $nis = '12345')
$query_nilai_kriteria = "SELECT * FROM nilai_kriteria WHERE nis = '$nis'";
$result_nilai_kriteria = mysqli_query($conn, $query_nilai_kriteria);

// Step 4 Langkah 1 Buat array asosiatif untuk menyimpan nilai kriteria siswa
$nilai_kriteria_siswa = [];
while ($row_nilai_kriteria = mysqli_fetch_assoc($result_nilai_kriteria)) {
    $nilai_kriteria_siswa[$row_nilai_kriteria['namakriteria']] = $row_nilai_kriteria['total_poin'];
}

// Step 4 Langkah 2 Hitung total bobot untuk setiap kriteria
$totalBobot = array_sum($kriteria);
$normalisasiBobot = [];
foreach ($kriteria as $kriteriaNama => $nilai) {
    $normalisasiBobot[$kriteriaNama] = $nilai / $totalBobot;
}

// Step 5 Tentukan nilai utiliti dengan mengkonversi nilai kriteria siswa pada masing-masing kriteria yang akan menjadi nilai kriteria data baku
$nilaiUtilitiSiswa = [];
foreach ($kriteria as $kriteriaNama => $nilai) {
    if (isset($nilai_kriteria_siswa[$kriteriaNama])) {
        $nilaiUtilitiSiswa[$kriteriaNama] = $nilai_kriteria_siswa[$kriteriaNama] / 100;
    } else {
        $nilaiUtilitiSiswa[$kriteriaNama] = 0;
    }
}

// Step 6 Hitung total nilai siswa dan Tentukan nilai-nilai akhir dari masing-masing kriteria dengan mengalihkan nilai yang didapat dari normalisasi nilai kriteria data baku dengan nilai normalisasi bobot kriteria. Kemudian jumlahkan nilai dari perkalian tersebut.
$totalNilaiSiswa = 0;
foreach ($kriteria as $kriteriaNama => $nilai) {
    $totalNilaiSiswa += $nilaiUtilitiSiswa[$kriteriaNama] * $normalisasiBobot[$kriteriaNama];
}

// Hitung total bobot siswa
$totalBobotSiswa = $totalNilaiSiswa * 100;

// Tentukan hasil berdasarkan total bobot siswa
function tentukanHasil($conn, $totalBobot)
{
    $query = "SELECT hasil FROM penanganan WHERE batas_bawah <= $totalBobot AND batas_atas >= $totalBobot";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row['hasil'];
        }
    }

    // Jika query gagal atau tidak ada hasil yang ditemukan, kembalikan default
    return "Tidak Ditemukan";
}
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
    <style>
        /* Optional: atur ukuran foto */
        .custom-img {
            width: 220px;
            /* Sesuaikan dengan kebutuhan */
            height: 210px;
            /* Sesuaikan dengan kebutuhan */
        }
    </style>
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
        <li class="nav-item active">
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
                <div class="card shadow mb-5">
                    <div class="card-header py-3">
                        <h4 class="ml-0 text-center text-primary font-weight-bold">REKAPITULASI PELANGGARAN SISWA</h4>
                    </div>
                    <div class="card-body p-4 pl-5 pr-5">
                        <div class="container ml-5 mt-3">
                            <div class="row">
                                <div class="col-sm" style="margin-left: -70px;">
                                    <h6 class="m-0 text-dark font-weight-bold">Data Siswa</h6><br>
                                    <form action="printpdf.php" method="POST">
                                        <table border="0" style="width: 115%;">
                                            <tbody>
                                                <?php
                                                $sql = mysqli_query($conn, "select * from siswa where nis='$nis'");
                                                if (mysqli_num_rows($sql) == 0) {
                                                } else {
                                                    $rowSiswa = mysqli_fetch_assoc($sql);
                                                }
                                                ?>
                                                <tr>
                                                    <td>Nama Lengkap</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="hidden" name="nama"
                                                            value="<?php echo $rowSiswa['nama']; ?>">
                                                        <?php echo $rowSiswa['nama']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Induk Siswa</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="hidden" name="nis"
                                                            value="<?php echo $rowSiswa['nis']; ?>">
                                                        <?php echo $rowSiswa['nis']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tempat Lahir</td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php
                                                        if (isset($rowSiswa['tempatlahir'])) {
                                                            echo $rowSiswa['tempatlahir'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Lahir</td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php
                                                        if (isset($rowSiswa['tgllahir'])) {
                                                            echo $rowSiswa['tgllahir'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kelas</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="hidden" name="kelas"
                                                            value="<?php echo $rowSiswa['kelas'] . " " . $rowSiswa['jurusan'] . " " . $rowSiswa['subkelas']; ?>">
                                                        <?php echo $rowSiswa['kelas'] . " " . $rowSiswa['jurusan'] . " " . $rowSiswa['subkelas']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Lengkap</td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php
                                                        if (isset($rowSiswa['alamat'])) {
                                                            echo $rowSiswa['alamat'];
                                                        } else {
                                                            echo "-";
                                                        } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>No Handphone</td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php if (isset($rowSiswa['nohp'])) {
                                                            echo $rowSiswa['nohp'];
                                                        } else {
                                                            echo "-";
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                                <div class="col-sm"></div>
                                <div class="col-sm float-right" style="margin-top: 30px;">
                                    <?php
                                    $foto = $rowSiswa['foto'];
                                    if ($foto == null) {
                                        echo "<img src='img/foto.png' width='170' height='170' />";
                                    } else {
                                        echo "<img src='img/$rowSiswa[foto]' class='img-fluid rounded-circle custom-img' alt='Foto Lingkaran'/>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pelanggaran</th>
                                        <th>Uraian Pelanggaran</th>
                                        <th>Kategori</th>
                                        <th>Poin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../config.php';

                                    $siswa_melanggar = "SELECT * from pelanggaran WHERE nis=$nis";
                                    $result_melanggar = $conn->query($siswa_melanggar);

                                    if ($result_melanggar->num_rows > 0) {
                                        $nomor = 1;
                                        $total_poin = 0; // Inisialisasi total poin
                                        $data_siswa = mysqli_query($conn, "SELECT pelanggaran.tanggal, pelanggaran.nis, 
                                                                    peraturan.nama_peraturan, peraturan.poin,
                                                                    kriteria.namakriteria, kriteria.bobot
                                                                    FROM pelanggaran
                                                                    INNER JOIN peraturan ON pelanggaran.id_peraturan = peraturan.id_peraturan
                                                                    INNER JOIN kriteria ON peraturan.id_kriteria = kriteria.id_kriteria WHERE pelanggaran.nis=$nis;");
                                        while ($d = mysqli_fetch_array($data_siswa)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $nomor++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $d['tanggal']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $d['nama_peraturan']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $d['namakriteria']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $d['poin'];
                                                    $total_poin += $d['poin']; // Menambahkan poin ke total poin
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4"><strong>Total Poin Pelanggaran:</strong></td>
                                            <td colspan="2"><strong>
                                                    <?php echo $total_poin; ?>
                                                </strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Total Bobot:</strong></td>
                                            <td colspan="2"><strong>
                                                    <?php echo $totalBobotSiswa; ?>
                                                </strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Penanganan Pelanggaran:</strong></td>
                                            <td colspan="2"><strong>
                                                    <?php echo tentukanHasil($conn, $totalBobotSiswa);
                                                    ?>
                                                </strong></td>
                                        </tr>
                                        <?php
                                    } else { ?>
                                        <tr>
                                            <td style="text-align: center;" colspan="100%"><strong>
                                                    <?php echo "Siswa Tidak Melakukan Pelanggaran"; ?>
                                                </strong></td>
                                        </tr>
                                        <?php
                                    } ?>
                                </tbody>
                            </table>
                            <?php
                            if ($result_melanggar->num_rows > 0) {
                                if (tentukanHasil($conn, $totalBobotSiswa) == "PERINGATAN I") { ?>
                                    <div class="d-grid gap-2" style="width: 300px;">
                                        <button class="btn btn-success w-100" type="submit" name="peringatanI"><i
                                                class="fa fa-print"></i> &nbsp PRINT SURAT
                                            <?php echo tentukanHasil($conn, $totalBobotSiswa); ?>
                                        </button>
                                    </div>
                                    <?php
                                } else if (tentukanHasil($conn, $totalBobotSiswa) == "PERINGATAN II") {
                                    ?>
                                        <div class="d-grid gap-2" style="width: 300px;">
                                            <button class="btn btn-success w-100" type="submit" name="peringatanII"><i
                                                    class="fa fa-print"></i> &nbsp PRINT
                                                SURAT
                                            <?php echo tentukanHasil($conn, $totalBobotSiswa); ?>
                                            </button>
                                        </div>
                                    <?php
                                } else if (tentukanHasil($conn, $totalBobotSiswa) == "PANGGILAN ORANG TUA") { ?>
                                            <div class="d-grid gap-2" style="width: 370px;">
                                                <button class="btn btn-success w-100" type="submit" name="panggilanortu"><i
                                                        class="fa fa-print"></i> &nbsp PRINT
                                                    SURAT
                                            <?php echo tentukanHasil($conn, $totalBobotSiswa); ?>
                                                </button>
                                            </div>
                                    <?php
                                } else if (tentukanHasil($conn, $totalBobotSiswa) == "SKORSING") { ?>
                                                <div class="d-grid gap-2" style="width: 300px;">
                                                    <button class="btn btn-success w-100" type="submit" name="skorsing"><i
                                                            class="fa fa-print"></i> &nbsp PRINT SURAT
                                            <?php echo tentukanHasil($conn, $totalBobotSiswa); ?>
                                                    </button>
                                                </div>
                                    <?php
                                } else { ?>
                                                <div class="d-grid gap-2" style="width: 450px;">
                                                    <button class="btn btn-success w-100" type="submit" name="dikembalikan"><i
                                                            class="fa fa-print"></i> &nbsp PRINT
                                                        SURAT
                                            <?php echo tentukanHasil($conn, $totalBobotSiswa); ?>
                                                    </button>
                                                </div>
                                    <?php
                                }
                            } else {

                            }
                            ?>
                        </div>
                        </form>
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