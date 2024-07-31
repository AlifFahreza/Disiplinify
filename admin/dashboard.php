<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

include '../config.php';

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

    <title>Dashboard Admin</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
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
            <li class="nav-item active">
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
            <li class="nav-item">
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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo
                                    <?php
                                    $sql = mysqli_query($conn, "select * from admin where username='$username'");
                                    if (mysqli_num_rows($sql) == 0) {
                                    } else {
                                        $row = mysqli_fetch_assoc($sql);
                                    }
                                    ?>
                                    <?php echo $row['namalengkap']; ?>!
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
                                <a href="logout.php" class="dropdown-item" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Jumlah Siswa</div>
                                            <?php
                                            $result = mysqli_query($conn, "select count(nis) as num_rows from siswa");
                                            $row = mysqli_fetch_object($result);
                                            $total = $row->num_rows;
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $total ?> Siswa
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Jumlah Wali Kelas</div>
                                            <?php
                                            $result = mysqli_query($conn, "select count(nip) as num_rows from walikelas");
                                            $row = mysqli_fetch_object($result);
                                            $total = $row->num_rows;
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $total ?> Wali Kelas
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Jumlah Pelanggaran</div>
                                            <?php
                                            $result = mysqli_query($conn, "select count(id_peraturan) as num_rows from peraturan");
                                            $row = mysqli_fetch_object($result);
                                            $total = $row->num_rows;
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $total ?> Pelanggaran
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Total Siswa Yang Melanggar</div>
                                            <?php
                                            $result = mysqli_query($conn, "select count(DISTINCT nis) as num_rows from pelanggaran");
                                            $row = mysqli_fetch_object($result);
                                            $total = $row->num_rows;
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total ?> Siswa</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pelanggaran Berdasarkan Jurusan</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas height=120px id="siswaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pelanggaran Berdasarkan Kelas</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas height="270px" id="kelasChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-lg-6 mb-3">
                            <div class="card shadow mb-3 pb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pelanggaran Yang Sering Terjadi</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <?php
                                    $kriteria = mysqli_query($conn, "SELECT peraturan.nama_peraturan, COUNT(pelanggaran.id_peraturan) AS jumlah_pelanggaran
                                    FROM pelanggaran
                                    JOIN peraturan ON pelanggaran.id_peraturan = peraturan.id_peraturan
                                    GROUP BY pelanggaran.id_peraturan
                                    ORDER BY jumlah_pelanggaran DESC
                                    LIMIT 3");

                                    if ($kriteria && $kriteria->num_rows > 0) {
                                        while ($row = $kriteria->fetch_assoc()) {
                                            $nama_peraturan = $row['nama_peraturan'];
                                            $jumlah_pelanggaran = $row['jumlah_pelanggaran'];
                                            $total_pelanggaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pelanggaran"))['total'];
                                            $persentase = ($jumlah_pelanggaran / $total_pelanggaran) * 100; // totalPelanggaran() merupakan fungsi untuk mendapatkan total pelanggaran
                                            ?>
                                            <div class="card-body">
                                            <h4 class="small font-weight-bold"><?php echo $nama_peraturan; ?><span
                                                    class="float-right"><?php echo number_format($persentase, 2); ?>%</span></h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $persentase; ?>%"
                                                    aria-valuenow="<?php echo $persentase;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                    </div>
                                            <?php
                                        }
                                    } else {
                                        echo 'Data pelanggaran tidak ditemukan';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-lg-6">
                            <div class="card shadow pb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Rata-Rata Kriteria Yang Dilanggar Oleh Siswa</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="margin-top: -10px;">
                                <?php
                                    $sql = "SELECT namakriteria, SUM(total_poin) as total FROM nilai_kriteria GROUP BY namakriteria";
                                    $result = $conn->query($sql);
                                    
                                    $data = array();
                                    
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $data[] = $row;
                                        }
                                    }
                                    
                                    $total_poin = array_reduce($data, function($carry, $item) {
                                        return $carry + $item['total'];
                                    }, 0);
                                    
                                    $percentages = array_map(function($item) use ($total_poin) {
                                        return round(($item['total'] / $total_poin) * 100);
                                    }, $data);

                                    // Urutkan $percentages dan $data bersama-sama berdasarkan nilai persentase
                                    array_multisort($percentages, SORT_DESC, $data);
                                ?>
                                
                                <div class="card-body mb-2">
                                <?php foreach ($data as $key => $item) : ?>
                                    <br>
                                    <h4 class="small font-weight-bold"><?php echo $item['namakriteria']; ?><span
                                            class="float-right"><?php echo $percentages[$key]; ?>%</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentages[$key]; ?>%"
                                            aria-valuenow="<?php echo $percentages[$key]; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row" style="width: 100%;">

                        <!-- Area Chart -->
                        <div class="col-xl-12" style="margin-left: 10px;">
                            <div class="card shadow mb-4" style="width: 100%;">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pelanggaran Setiap Bulannya</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php
                                        $data_pelanggaran = [];

                                        try {
                                            // Query untuk mengambil jumlah pelanggaran berdasarkan jurusan
                                            $query = "
                                                SELECT MONTH(p.tanggal) as bulan, s.jurusan, COUNT(p.id_pelanggaran) as total_pelanggaran
                                                FROM pelanggaran p
                                                INNER JOIN siswa s ON p.nis = s.nis
                                                GROUP BY bulan, s.jurusan
                                                ORDER BY bulan
                                            ";
                                        
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                        
                                            // Mengambil hasil query
                                            $result = $stmt->get_result();
                                        
                                            // Mengambil hasil query sebagai array assosiatif
                                            while ($row = $result->fetch_assoc()) {
                                                $bulan = date('F', mktime(0, 0, 0, $row['bulan'], 1)); // Mengubah angka bulan menjadi nama bulan
                                                $data_pelanggaran[$bulan][] = [
                                                    'jurusan' => $row['jurusan'],
                                                    'total_pelanggaran' => $row['total_pelanggaran']
                                                ];
                                            }
                                        } catch (Exception $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                    ?>
                                    <div class="chart-area">
                                        <canvas height="80" id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Area Chart -->
                        <div class="col-xl-12" style="margin-left: 10px;">
                            <div class="card shadow mb-4" style="width: 100%;">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pelanggaran Setiap Semester</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php
                                        $data_pelanggarans = [];

                                        try {
                                            // Query untuk mengambil jumlah pelanggaran berdasarkan jurusan
                                            $querys = "
                                            SELECT CASE
                                            WHEN MONTH(p.tanggal) BETWEEN 1 AND 6 THEN 'Semester Ganjil'
                                            ELSE 'Semester Genap'
                                            END AS semester,
                                            s.jurusan, COUNT(p.id_pelanggaran) as total_pelanggaran
                                            FROM pelanggaran p
                                            INNER JOIN siswa s ON p.nis = s.nis
                                            GROUP BY semester, s.jurusan
                                            ORDER BY semester
                                            ";
                                        
                                            $stmts = $conn->prepare($querys);
                                            $stmts->execute();
                                        
                                            // Mengambil hasil query
                                            $results = $stmts->get_result();
                                        
                                            // Mengelompokkan data berdasarkan semester
                                            while ($rows = $results->fetch_assoc()) {
                                                $semester = $rows['semester'];
                                                $data_pelanggarans[$semester][] = [
                                                    'jurusan' => $rows['jurusan'],
                                                    'total_pelanggaran' => $rows['total_pelanggaran']
                                                ];
                                            }
                                        } catch (Exception $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                    ?>
                                    <div class="chart-area">
                                        <canvas height="80" id="semesterChart"></canvas>
                                    </div>
                                </div>
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

    <script>
        var ctx = document.getElementById("siswaChart").getContext('2d');
        // Menghitung jumlah pelanggaran unik per jurusan
        <?php
        $query = "SELECT jurusan, COUNT(DISTINCT pelanggaran.nis) AS jumlah_pelanggaran 
                FROM siswa 
                LEFT JOIN pelanggaran ON siswa.nis = pelanggaran.nis 
                GROUP BY siswa.jurusan";
        
        $result = $conn->query($query);
        
        $jumlah_pelanggaran = array();
        $labels = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jurusan = $row['jurusan'];
                $jumlah_pelanggaran[$jurusan] = $row['jumlah_pelanggaran'];
                $labels[] = $jurusan;
            }
        }
        ?>

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Jumlah Pelanggaran Siswa per Jurusan',
                    data: <?php echo json_encode(array_values($jumlah_pelanggaran)); ?>,
                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)', 'rgb(246, 194, 62)'],
                    borderColor: ['rgb(255, 99, 132)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById("kelasChart").getContext('2d');
        // Menghitung jumlah siswa yang melanggar per kelas
    <?php
        $query = "SELECT kelas, COUNT(DISTINCT pelanggaran.nis) AS jumlah_pelanggaran 
                FROM siswa 
                LEFT JOIN pelanggaran ON siswa.nis = pelanggaran.nis 
                WHERE siswa.kelas IN ('10', '11', '12')
                GROUP BY siswa.kelas";
        
        $result = $conn->query($query);
        
        $jumlah_pelanggaran = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kelas = $row['kelas'];
                $jumlah_pelanggaran[$kelas] = $row['jumlah_pelanggaran'];
            }
        }
    ?>

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Kelas 10", "Kelas 11", "Kelas 12"],
                datasets: [{
                    label: 'Jumlah Pelanggaran Siswa per Kelas',
                    data: [
                        <?php echo $jumlah_pelanggaran['10'] ?? 0; ?>,
                        <?php echo $jumlah_pelanggaran['11'] ?? 0; ?>,
                        <?php echo $jumlah_pelanggaran['12'] ?? 0; ?>
                    ],
                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)', 'rgb(246, 194, 62)'],
                    borderColor: ['rgb(255, 99, 132)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script src="../js/script.js"></script>
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

<script>
        var dataPHP = <?php echo json_encode($data_pelanggaran); ?>;

var labels = Object.keys(dataPHP);
var datasets = [];
var jurusan = []; // Pindahkan definisi variabel jurusan ke luar dari loop forEach

// Memproses data untuk grafik
labels.forEach(function(bulan) {
    var dataByBulan = dataPHP[bulan];
    var total_pelanggaran = [];

    dataByBulan.forEach(function(item) {
        if (!jurusan.includes(item.jurusan)) {
            jurusan.push(item.jurusan);
        }
        total_pelanggaran.push(item.total_pelanggaran);
    });

    datasets.push({
        label: bulan,
        data: total_pelanggaran,
        backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)', 'rgb(246, 194, 62)'],
        borderColor: ['rgb(255, 99, 132)'],
        borderWidth: 1
    });
});

var ctx = document.getElementById('lineChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: jurusan, // Menggunakan jurusan sebagai label sumbu X
        datasets: datasets
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<script>
        var dataPHPs = <?php echo json_encode($data_pelanggaran); ?>;
        
        var labels = Object.keys(dataPHP);
        var datasets = [];

        // Memproses data untuk grafik
        labels.forEach(function(semester) {
            var dataBySemester = dataPHP[semester];
            var jurusan = [];
            var total_pelanggaran = [];

            dataBySemester.forEach(function(item) {
                jurusan.push(item.jurusan);
                total_pelanggaran.push(item.total_pelanggaran);
            });

            datasets.push({
                label: semester,
                data: total_pelanggaran,
                backgroundColor: ['rgb(153, 102, 255)', 'rgb(255, 159, 64)', 'rgb(75, 192, 192)'],
                borderColor: ['rgb(153, 102, 255)'],
                borderWidth: 1
            });
        });

        var ctx = document.getElementById('semesterChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: jurusan, // Menggunakan jurusan sebagai label sumbu X
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>