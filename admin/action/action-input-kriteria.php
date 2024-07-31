<?php
session_start();
include_once '../../config.php';
if (isset($_POST['Submit'])) {
    $id_kriteria = $_POST['id_kriteria'];
    $namakriteria = $_POST['namakriteria'];
    $bobot = $_POST['bobot'];

    $query = "SELECT SUM(bobot) AS total_bobot FROM kriteria";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    $total_bobot_di_database = $row['total_bobot'];

    if ($total_bobot_di_database + $bobot <= 100) {
        $sql = "INSERT INTO kriteria (id_kriteria,namakriteria,bobot) VALUES ('$id_kriteria','$namakriteria','$bobot')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["insertsuccess"] = 'Data Berhasil Disimpan!';
            header('Location: ../data-kriteria.php');
        } else {
            $_SESSION["insertfailed"] = 'Maaf, Gagal Menyimpan Jenis Kriteria!';
            header('Location: ../data-kriteria.php');
        }
    } else {
        $_SESSION["insertfailed"] = 'Maaf, Jumlah bobot kriteria tidak boleh lebih dari 100!';
        header('Location: ../data-kriteria.php');
    }

    mysqli_close($conn);
}
?>