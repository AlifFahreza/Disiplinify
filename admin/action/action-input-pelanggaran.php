<?php
session_start();
include_once '../../config.php';
if (isset($_POST['Submit'])) {
    $nis = $_POST['nis'];
    $id_peraturan = $_POST['id_peraturan'];

    $tanggal_hari_ini = date("Y-m-d");

    $sql = "INSERT INTO pelanggaran (id_pelanggaran,nis,id_peraturan, tanggal)
	 VALUES (0,'$nis','$id_peraturan','$tanggal_hari_ini')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION["insertsuccess"] = 'Berhasil Menambahkan Data Pelanggaran Siswa!';

        // Mengambil informasi nama kriteria dan poin dari tabel kriteria dan peraturan berdasarkan id_peraturan
        $sql_get_info = "SELECT k.namakriteria, p.poin 
                        FROM kriteria k
                        INNER JOIN peraturan p ON k.id_kriteria = p.id_kriteria
                        WHERE p.id_peraturan = '$id_peraturan'";

        $result_info = mysqli_query($conn, $sql_get_info);

        if (mysqli_num_rows($result_info) > 0) {
            // Jika terdapat hasil dari query, ambil nama kriteria dan poin
            $row_info = mysqli_fetch_assoc($result_info);
            $nama_kriteria = $row_info['namakriteria'];
            $poin = $row_info['poin'];

            // Cek apakah entri dengan nis dan nama_kriteria sudah ada
            $sql_check_entry = "SELECT * FROM nilai_kriteria WHERE nis = '$nis' AND namakriteria = '$nama_kriteria'";
            $result_check_entry = mysqli_query($conn, $sql_check_entry);

            if (mysqli_num_rows($result_check_entry) > 0) {
                // Jika entri sudah ada, update total_poin
                $sql_update_poin = "UPDATE nilai_kriteria SET total_poin = total_poin + '$poin' 
                                    WHERE nis = '$nis' AND namakriteria = '$nama_kriteria'";
                mysqli_query($conn, $sql_update_poin);
            } else {
                // Insert atau update ke tabel poin
                $sql_insert_update = "INSERT INTO nilai_kriteria (id_nilai_kriteria, nis, namakriteria, total_poin)
                VALUES (0,'$nis', '$nama_kriteria', '$poin')";
                mysqli_query($conn, $sql_insert_update);
            }
        }

        header('Location: ../data-siswa.php');
    } else {
        $_SESSION["insertfailed"] = 'Maaf, Gagal Menambahkan Data Pelanggaran Siswa!';
        header('Location: ../data-siswa.php');
    }
    mysqli_close($conn);
}
?>