<?php
session_start();
require '../../vendor/autoload.php'; // Sesuaikan path ke autoload.php
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) {
    $target_dir = "../../excel/";
    $target_file = $target_dir . basename($_FILES["excelFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "xls" && $fileType != "xlsx") {
        echo "Hanya file Excel yang diperbolehkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, file tidak dapat diunggah.";
    } else {
        if (move_uploaded_file($_FILES["excelFile"]["tmp_name"], $target_file)) {

            include '../../config.php'; // Memanggil file koneksi.php

            $spreadsheet = IOFactory::load($target_file);

            foreach ($spreadsheet->getActiveSheet()->getRowIterator() as $row) {
                // Skip header (baris pertama)
                if ($row->getRowIndex() == 1) {
                    continue;
                }

                $nip = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(2, $row->getRowIndex())->getValue(); // Misalnya, kolom pertama
                $walikelas = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(3, $row->getRowIndex())->getValue(); // Misalnya, kolom kedua
                $kelas = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(5, $row->getRowIndex())->getValue(); // Misalnya, kolom ketiga
                $jurusan = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(4, $row->getRowIndex())->getValue(); // Misalnya, kolom keempat
                $subkelas = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(6, $row->getRowIndex())->getValue(); // Misalnya, kolom kelima

                if (!empty($nip) && is_numeric($nip) && !nisExists($nip, $conn)) {
                    $sql = "INSERT INTO walikelas (nip, jurusan, kelas, subkelas, walikelas) VALUES ('$nip', '$jurusan', '$kelas', '$subkelas', '$walikelas')";
                    mysqli_query($conn, $sql);
                    $_SESSION["insertsuccess"] = 'Data Wali Kelas Berhasil Ditambahkan!';
                    header('Location: ../import-excel-walikelas.php');
                } else {
                    // Tampilkan pesan error atau lakukan penanganan lainnya
                    $_SESSION["insertfailed"] = 'Maaf Gagal Menambahkan Data, Silahkan Cek Kembali!';
                    header('Location: ../import-excel-walikelas.php');
                }
            }
        } else {
            $_SESSION["insertfailed"] = 'Maaf, Terdapat Kesalahan Saat Mengunggah File!';
            header('Location: ../import-excel-walikelas.php');
        }
    }
}

// Fungsi untuk mengecek apakah NIS sudah ada di database
function nisExists($nip, $conn) {
    $query = "SELECT COUNT(*) FROM walikelas WHERE nip = '$nip'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_array($result)[0];
    return $count > 0;
}
?>