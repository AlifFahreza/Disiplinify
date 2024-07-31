<?php
session_start();
include_once '../../config.php';

$id_kriteria = $_POST['id_kriteria'];
$namakriteria = $_POST['namakriteria'];
$bobot = $_POST['bobot'];

$query = "UPDATE kriteria SET namakriteria='$namakriteria',bobot='$bobot' where id_kriteria='$id_kriteria'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Diupdate!';
    header('Location: ../data-kriteria.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Mengupdate Jenis Kriteria!';
    header('Location: ../data-kriteria.php');
}