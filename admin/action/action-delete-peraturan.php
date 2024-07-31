<?php
session_start();
include_once '../../config.php';

$id_peraturan = $_POST['id_peraturan'];

$query = "DELETE from peraturan where id_peraturan='$id_peraturan'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Dihapus!';
    header('Location: ../data-peraturan.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Menghapus Data Peraturan Sekolah!';
    header('Location: ../data-peraturan.php');
}

?>