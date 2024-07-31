<?php
session_start();
include_once '../../config.php';

$nis = $_POST['nis'];
$password = md5($_POST['password']);
$konfirmpassword = md5($_POST['konfirmpassword']);

$query = "UPDATE siswa SET password='$password' where nis='$nis'";
if($password == $konfirmpassword){
    if (mysqli_query($conn, $query)) {
        $_SESSION["insertsuccess"] = 'Password Anda Berhasil Dirubah!';
        header('Location: ../ubah-password.php');
    } else {
        $_SESSION["insertfailed"] = 'Maaf, Gagal Merubah Password Anda!';
        header('Location: ../ubah-password.php');
    }
}else{
    $_SESSION["insertfailed"] = 'Maaf, Password dan Konfirmasi Password Tidak Sama, Mohon Cek Kembali!';
    header('Location: ../ubah-password.php');
}