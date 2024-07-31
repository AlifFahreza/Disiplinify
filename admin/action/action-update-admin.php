<?php
session_start();
include_once '../../config.php';

$id_admin = $_POST['id_admin'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$namalengkap = $_POST['namalengkap'];

$query = "UPDATE admin SET username='$username',password='$password',namalengkap='$namalengkap' where id_admin='$id_admin'";
if (mysqli_query($conn, $query)) {
    $_SESSION["insertsuccess"] = 'Profil Anda Berhasil Diupdate!';
    header('Location: ../dashboard.php');
} else {
    $_SESSION["insertfailed"] = 'Maaf, Gagal Mengupdate Profil Anda!';
    header('Location: ../dashboard.php');
}