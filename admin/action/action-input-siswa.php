<?php
session_start();
include_once '../../config.php';
if (isset($_POST['Submit'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];
    $kelas = $_POST['kelas'];
    $password = md5('123');

    $sql = "INSERT INTO siswa (nis,nama,password,jurusan,kelas,subkelas)
	 VALUES ('$nis','$nama','$password','$jurusan','$angkatan','$kelas')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["insertsuccess"] = 'Data Berhasil Disimpan!';
        header('Location: ../data-siswa.php');
    } else {
        $_SESSION["insertfailed"] = 'Maaf, Gagal Menyimpan Data Siswa!';
        header('Location: ../data-siswa.php');
    }
    mysqli_close($conn);
}
?>