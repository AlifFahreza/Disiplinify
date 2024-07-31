<?php
session_start();
include_once '../../config.php';

$nis = $_POST['nis'];

$query = "DELETE from siswa where nis='$nis'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Dihapus!';
    header('Location: ../data-siswa.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Menghapus Data Siswa!';
    header('Location: ../data-siswa.php');
}

?>