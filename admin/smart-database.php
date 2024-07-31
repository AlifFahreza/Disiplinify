<?php
// Ambil data dari database untuk kriteria dan nilai_kriteria sesuai dengan kebutuhan Anda
// Lakukan koneksi ke database
include '../config.php';

// Ambil nilai kriteria dari database
$query_kriteria = "SELECT * FROM kriteria";
$result_kriteria = mysqli_query($conn, $query_kriteria);

// Buat array asosiatif untuk menyimpan nilai kriteria
$kriteria = [];
while ($row_kriteria = mysqli_fetch_assoc($result_kriteria)) {
    $kriteria[$row_kriteria['nama_kriteria']] = $row_kriteria['bobot'];
}

// Ambil nilai kriteria untuk siswa tertentu (misalnya, $nis = '12345')
$nis = '12345'; // Ganti dengan NIS yang sesuai
$query_nilai_kriteria = "SELECT * FROM nilai_kriteria WHERE nis = '$nis'";
$result_nilai_kriteria = mysqli_query($conn, $query_nilai_kriteria);

// Buat array asosiatif untuk menyimpan nilai kriteria siswa
$nilai_kriteria_siswa = [];
while ($row_nilai_kriteria = mysqli_fetch_assoc($result_nilai_kriteria)) {
    $nilai_kriteria_siswa[$row_nilai_kriteria['nama_kriteria']] = $row_nilai_kriteria['nilai'];
}

// Hitung total bobot untuk setiap kriteria
$totalBobot = array_sum($kriteria);
$normalisasiBobot = [];
foreach ($kriteria as $kriteriaNama => $nilai) {
    $normalisasiBobot[$kriteriaNama] = $nilai / $totalBobot;
}

// Tentukan nilai utiliti dengan mengkonversi nilai kriteria siswa pada masing-masing kriteria
//yang akan menjadi nilai kriteria data baku
$nilaiUtilitiSiswa = [];
foreach ($kriteria as $kriteriaNama => $nilai) {
    $nilaiUtilitiSiswa[$kriteriaNama] = $nilai_kriteria_siswa[$kriteriaNama] / 100;
}

// Hitung total nilai siswa
$totalNilaiSiswa = 0;

foreach ($kriteria as $kriteriaNama => $nilai) {
    $totalNilaiSiswa += $nilaiUtilitiSiswa[$kriteriaNama] * $normalisasiBobot[$kriteriaNama];
}

// Hitung total bobot siswa
$totalBobotSiswa = $totalNilaiSiswa * 100;

// Tentukan hasil berdasarkan total bobot siswa
function tentukanHasil($totalBobotSiswa)
{
    // Definisikan logika untuk menentukan hasil berdasarkan total bobot siswa
    // Misalnya, menggunakan rentang tertentu untuk kategori hasil
    // Sesuaikan dengan logika yang Anda miliki dalam fungsi tentukanHasil() sebelumnya
}

// Tampilkan hasil
echo "Total bobot siswa: " . $totalBobotSiswa . "\n";
echo "Hasil siswa: " . tentukanHasil($totalBobotSiswa) . "\n";

// Tutup koneksi ke database jika sudah selesai
mysqli_close($conn);
?>