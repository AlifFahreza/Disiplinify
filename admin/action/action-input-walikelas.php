<?php
session_start();
include_once '../../config.php';
if (isset($_POST['Submit'])) {
    $nip = $_POST['nip'];
    $walikelas = $_POST['walikelas'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];
    $kelas = $_POST['kelas'];

    $sql = "INSERT INTO walikelas (nip,jurusan,kelas,subkelas,walikelas)
	 VALUES ('$nip','$jurusan','$angkatan','$kelas','$walikelas')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["insertsuccess"] = 'Data Berhasil Disimpan!';
        header('Location: ../data-walikelas.php');
    } else {
        $_SESSION["insertfailed"] = 'Maaf, Gagal Menyimpan Data Wali Kelas!';
        header('Location: ../data-walikelas.php');
    }
    mysqli_close($conn);
}
?>