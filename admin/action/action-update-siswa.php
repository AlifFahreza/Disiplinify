<?php
session_start();
include_once '../../config.php';

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$angkatan = $_POST['angkatan'];
$kelas = $_POST['kelas'];

$query = "UPDATE siswa SET nis='$nis',nama='$nama',jurusan='$jurusan',kelas='$angkatan',subkelas='$kelas' where nis='$nis'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Diupdate!';
    header('Location: ../data-siswa.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Mengupdate Data Siswa!';
    header('Location: ../data-siswa.php');
}