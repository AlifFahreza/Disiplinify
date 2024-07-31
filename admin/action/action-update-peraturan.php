<?php
session_start();
include_once '../../config.php';

$id_peraturan = $_POST['id_peraturan'];
$nama_peraturan = $_POST['nama_peraturan'];
$poin = $_POST['poin'];

$query = "UPDATE peraturan SET nama_peraturan='$nama_peraturan',poin='$poin' where id_peraturan='$id_peraturan'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Diupdate!';
    header('Location: ../data-peraturan.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Mengupdate Data Peraturan Sekolah!';
    header('Location: ../data-peraturan.php');
}