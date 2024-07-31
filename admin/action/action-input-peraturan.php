<?php
session_start();
include_once '../../config.php';
if (isset($_POST['Submit'])) {
    $id_peraturan = $_POST['id_peraturan'];
    $nama_peraturan = $_POST['nama_peraturan'];
    $poin = $_POST['poin'];
    $id_kriteria = $_POST['id_kriteria'];

    $sql = "INSERT INTO peraturan (id_peraturan,nama_peraturan,poin,id_kriteria)
	 VALUES ('$id_peraturan','$nama_peraturan','$poin','$id_kriteria')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["insertsuccess"] = 'Data Berhasil Disimpan!';
        header('Location: ../data-peraturan.php');
    } else {
        $_SESSION["insertfailed"] = 'Maaf, Gagal Menyimpan Data Peraturan Sekolah!';
        header('Location: ../data-peraturan.php');
    }
    mysqli_close($conn);
}
?>