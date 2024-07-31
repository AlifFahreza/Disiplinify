<?php
session_start();
include_once '../../config.php';

$id_kriteria = $_POST['id_kriteria'];

$query = "DELETE from kriteria where id_kriteria='$id_kriteria'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Dihapus!';
    header('Location: ../data-kriteria.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Menghapus Jenis Kriteria!';
    header('Location: ../data-kriteria.php');
}

?>