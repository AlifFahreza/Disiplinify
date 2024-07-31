<?php
session_start();
include_once '../../config.php';

$nip = $_POST['nip'];

$query = "DELETE from walikelas where nip='$nip'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Data Berhasil Dihapus!';
    header('Location: ../data-walikelas.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Menghapus Data Wali Kelas!';
    header('Location: ../data-walikelas.php');
}

?>