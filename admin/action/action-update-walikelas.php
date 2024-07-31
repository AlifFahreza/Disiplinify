<?php
session_start();
include_once '../../config.php';

$nip = $_POST['nip'];
$walikelas = $_POST['walikelas'];
$jurusan = $_POST['jurusan'];
$angkatan = $_POST['angkatan'];
$kelas = $_POST['kelas'];

$query = "UPDATE walikelas SET nip='$nip',jurusan='$jurusan',kelas='$angkatan',subkelas='$kelas',walikelas='$walikelas' where nip='$nip'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Diupdate!';
    header('Location: ../data-walikelas.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Mengupdate Data Wali Kelas!';
    header('Location: ../data-walikelas.php');
}