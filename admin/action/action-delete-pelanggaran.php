<?php
session_start();
include_once '../../config.php';

if(isset($_POST['delete'])) {
    // Mengambil NIS dan id_peraturan dari formulir hapus
    $nis = $_POST['nis'];
    $id_peraturan = $_POST['id_peraturan'];
    $tanggal = $_POST['tanggal'];
    $poin = $_POST['poin'];
    $namakriteria = $_POST['namakriteria'];
        

    // Query untuk menghapus peraturan berdasarkan NIS dan id_peraturan
    $delete_query = "DELETE FROM pelanggaran WHERE nis = '$nis' AND id_peraturan = '$id_peraturan' AND tanggal = '$tanggal'";
    $delete_result = mysqli_query($conn, $delete_query);

    if($delete_result) {
        // Query untuk mendapatkan total poin yang harus dikurangi
        $get_total_poin_query = "SELECT total_poin FROM nilai_kriteria WHERE nis = '$nis' AND namakriteria = '$namakriteria'";
        $get_total_poin_result = mysqli_query($conn, $get_total_poin_query);
        $row = mysqli_fetch_assoc($get_total_poin_result);
        $total_poin_sekarang = $row['total_poin'];
        
        // Mengurangi total poin dengan poin yang dihapus
        $total_poin_baru = $total_poin_sekarang - $poin;

        // Query untuk melakukan update total poin di tabel nilai_kriteria
        $update_query = "UPDATE nilai_kriteria SET total_poin = '$total_poin_baru' WHERE nis = '$nis' AND namakriteria = '$namakriteria'";
        $update_result = mysqli_query($conn, $update_query);

        if($update_result) {
            // Jika penghapusan dan pembaruan berhasil, redirect ke halaman lain atau tampilkan pesan sukses
            $_SESSION["insertsuccess"] = 'Data Berhasil Dihapus!';
            header('Location: ../pelanggaran.php');
        } else {
            // Jika pembaruan total poin gagal, tampilkan pesan error atau melakukan tindakan lainnya
            $_SESSION["insertfailed"] = 'Maaf, Gagal Memperbarui Total Poin!';
            header('Location: ../pelanggaran.php');
        }
        
    } else {
        // Jika penghapusan gagal, tampilkan pesan error atau melakukan tindakan lainnya
        $_SESSION["insertfailed"] = 'Maaf, Gagal Menghapus Data Pelanggaran!';
        header('Location: ../pelanggaran.php');
    }
}

mysqli_close($conn);
?>