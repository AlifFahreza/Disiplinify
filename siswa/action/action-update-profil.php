<?php
session_start();
include_once '../../config.php';

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$angkatan = $_POST['angkatan'];
$kelas = $_POST['kelas'];
$tempatlahir = $_POST['tempatlahir'];
$tgllahir = $_POST['tgllahir'];
$alamat = $_POST['alamat'];
$nohp = $_POST['nohp'];

$query = "UPDATE siswa SET nis='$nis',nama='$nama',jurusan='$jurusan',kelas='$angkatan',subkelas='$kelas',tempatlahir='$tempatlahir',tgllahir='$tgllahir',alamat='$alamat',nohp='$nohp' where nis='$nis'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Diupdate!';
    header('Location: ../edit-profil.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Mengupdate Data Anda!';
    header('Location: ../edit-profil.php');
}