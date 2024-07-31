<?php
require_once('../tcpdf/tcpdf.php');
include '../config.php';

// Buat objek TCPDF baru
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Atur informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Muhammad Alif Fahreza Al Rafi');
$pdf->SetTitle('Contoh Dokumen PDF');
$pdf->SetSubject('Contoh Dokumen PDF');
$pdf->SetKeywords('TCPDF, contoh, PDF');

// Atur font
$pdf->SetFont('helvetica', '', 12);

if (isset($_POST['peringatanI'])) {
    // Tambahkan halaman
    $pdf->AddPage();

    $tanggalHariIni = date('Y-m-d');
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $nomor = 1;

    // Isi konten PDF
    $content1 = '
    <br>
    <h4 style="text-align:center;">SURAT PERINGATAN PERTAMA</h4>
    <br>
    <p style="text-align:left;">Kepada Yth,</p>
    <p style="text-align:left;">Orang tua Siswa '.$nama.'</p>
    <p style="text-align:left;">Di Tempat</p>
    <br>
    <p style="text-align:left;">Dengan Hormat,</p>
    <p style="text-align:left;">Dengan ini kami sampaikan kepada Bapak/Ibu/Wali dari:</p>
    <p style="text-align:left;">Nama : '.$nama.'</p>
    <p style="text-align:left;">Kelas : '.$kelas.'</p>
    <p>Sehubungan dengan sikap tidak disiplin dan pelanggaran terhadap tata tertib sekolah yang Siswa lakukan, maka dengan ini pihak sekolah memberikan surat peringatan pertama (SP-1). Bahwa siswa/siswi tersebut telah melakukan pelanggaran tata tertib berupa:</p>
    <table border="0">';
    $data_pelanggaran = mysqli_query($conn, "SELECT pelanggaran.tanggal, pelanggaran.nis, 
                            peraturan.nama_peraturan, peraturan.poin,
                            kriteria.namakriteria, kriteria.bobot
                            FROM pelanggaran
                            INNER JOIN peraturan ON pelanggaran.id_peraturan = peraturan.id_peraturan
                            INNER JOIN kriteria ON peraturan.id_kriteria = kriteria.id_kriteria WHERE pelanggaran.nis=$nis;");
    while ($d = mysqli_fetch_array($data_pelanggaran)) {
        $content1 .= '
            <tr>
                <td style="width:10%; text-align:center;">' . $nomor++ . '.</td>
                <td style="width:90%; text-align:left">' . $d['nama_peraturan'] . '</td>
            </tr>';
    }

    $content1 .= '
    </table>
    <p>Dengan surat peringatan ini diharapkan agar kiranya Bapak/Ibu/Wali lebih mengawasi kegiatan siswa baik dari segi sikap individu, sosial, dan spiritual. Agar dikemudian hari siswa tidak mengulangi kesalahan yang sama dan atau kesalahan lainnya, sehingga tercipta perilaku siswa yang lebih baik.</p>
    <p>Demikian surat ini kami sampaikan, atas perhatiannya saya ucapkan terimakasih.</p>
    <br>
    <table border="1">
    <tr>
        <td style="width:34%; text-align:center;">Orang tua/wali siswa</td>
        <td style="width:34%; text-align:center;">Siswa yang berangkutan</td>
        <td style="width:32%; text-align:center;">Wakasek Kesiswaan</td>
    </tr>
    <tr>
        <td style="width:34%; height:100px; text-align:center;"></td>
        <td style="width:34%; height:100px; text-align:center;"></td>
        <td style="width:32%; height:100px; text-align:center;"></td>
    </tr>
    </table>
';

    // Tampilkan konten dalam PDF
    $pdf->writeHTML($content1, true, false, true, false, '');

} else if (isset($_POST['peringatanII'])) {
    // Tambahkan halaman
    $pdf->AddPage();

    $tanggalHariIni = date('Y-m-d');
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $nomor = 1;

        // Isi konten PDF
        $content1 = '
        <br>
        <h4 style="text-align:center;">SURAT PERINGATAN KEDUA</h4>
        <br>
        <p style="text-align:left;">Kepada Yth,</p>
        <p style="text-align:left;">Orang tua Siswa '.$nama.'</p>
        <p style="text-align:left;">Di Tempat</p>
        <br>
        <p style="text-align:left;">Dengan Hormat,</p>
        <p style="text-align:left;">Dengan ini kami sampaikan kepada Bapak/Ibu/Wali dari:</p>
        <p style="text-align:left;">Nama : '.$nama.'</p>
        <p style="text-align:left;">Kelas : '.$kelas.'</p>
        <p>Sehubungan dengan sikap tidak disiplin dan pelanggaran terhadap tata tertib sekolah yang Siswa lakukan, maka dengan ini pihak sekolah memberikan surat peringatan kedua (SP-2). Bahwa siswa/siswi tersebut telah melakukan pelanggaran tata tertib berupa:</p>
        <table border="0">';
        $data_pelanggaran = mysqli_query($conn, "SELECT pelanggaran.tanggal, pelanggaran.nis, 
                                peraturan.nama_peraturan, peraturan.poin,
                                kriteria.namakriteria, kriteria.bobot
                                FROM pelanggaran
                                INNER JOIN peraturan ON pelanggaran.id_peraturan = peraturan.id_peraturan
                                INNER JOIN kriteria ON peraturan.id_kriteria = kriteria.id_kriteria WHERE pelanggaran.nis=$nis;");
        while ($d = mysqli_fetch_array($data_pelanggaran)) {
            $content1 .= '
                <tr>
                    <td style="width:10%; text-align:center;">' . $nomor++ . '.</td>
                    <td style="width:90%; text-align:left">' . $d['nama_peraturan'] . '</td>
                </tr>';
        }
    
        $content1 .= '
        </table>
        <p>Dengan surat peringatan ini diharapkan agar kiranya Bapak/Ibu/Wali lebih mengawasi kegiatan siswa baik dari segi sikap individu, sosial, dan spiritual. Agar dikemudian hari siswa tidak mengulangi kesalahan yang sama dan atau kesalahan lainnya, sehingga tercipta perilaku siswa yang lebih baik.</p>
        <p>Demikian surat ini kami sampaikan, atas perhatiannya saya ucapkan terimakasih.</p>
        <br>
        <table border="1">
        <tr>
            <td style="width:34%; text-align:center;">Orang tua/wali siswa</td>
            <td style="width:34%; text-align:center;">Siswa yang berangkutan</td>
            <td style="width:32%; text-align:center;">Wakasek Kesiswaan</td>
        </tr>
        <tr>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:32%; height:100px; text-align:center;"></td>
        </tr>
        </table>
    ';

    // Tampilkan konten dalam PDF
    $pdf->writeHTML($content1, true, false, true, false, '');
} else if (isset($_POST['panggilanortu'])) {
    // Tambahkan halaman
    $pdf->AddPage();

    $tanggalHariIni = date('Y-m-d');
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];

        // Isi konten PDF
        $content1 = '
        <br>
        <h4 style="text-align:center;">SURAT PANGGILAN ORANG TUA</h4>
        <br>
        <p style="text-align:left;">Kepada Yth,</p>
        <p style="text-align:left;">Bapak/Ibu Wali Murid</p>
        <p style="text-align:left;">Di Tempat</p>
        <br>
        <p style="text-align:left;">Assalamualaikum Wr. Wb.</p>
        <p style="text-align:left;">Sehubungan dengan adanya permasalahan yang harus diselesaikan bersama, maka dengan ini kami mengharapkan kehadiran Bapak/Ibu Wali Murid:</p>
        <p style="text-align:left;">Nama : '.$nama.'</p>
        <p style="text-align:left;">Kelas : '.$kelas.'</p>
        <p style="text-align:left;">Untuk hadir besok pada:</p>
        <p style="text-align:left;">Tanggal : '.$tanggalHariIni.'</p>
        <p style="text-align:left;">Waktu : 10.00 WIB</p>
        <p style="text-align:left;">Tempat : Ruang Kesiswaan SMK PGRI 3 Malang</p>
        <br>
        <p>Bahwa siswa tersebut telah melakukan beberapa pelanggaran seperti yang tertera pada halaman kedua(lampiran)</p>
        <p>Mengingat pentingnya hal tersebut maka kami mengharapkan Bapak/Ibu Wali Murid untuk datang tepat pada waktu yang telah ditentukan.</p>
        <br>
        <p>Demikian surat panggilan ini kami sampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.</p>
        <br>
        <table border="1">
        <tr>
            <td style="width:34%; text-align:center;">Waka Kesiswaan</td>
            <td style="width:34%; text-align:center;">Wali Kelas</td>
            <td style="width:32%; text-align:center;">Kepala Sekolah</td>
        </tr>
        <tr>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:32%; height:100px; text-align:center;"></td>
        </tr>
        </table>
    ';

    // Tampilkan konten dalam PDF
    $pdf->writeHTML($content1, true, false, true, false, '');
} else if (isset($_POST['skorsing'])) {
    // Tambahkan halaman
    $pdf->AddPage();

    $tanggalHariIni = date('Y-m-d');
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];

    // Isi konten PDF
    $content1 = '
    <br>
    <h4 style="text-align:center;">PEMBERITAHUAN SKORSING</h4>
    <br>
    <p style="text-align:left;">Malang, ' . $tanggalHariIni . '</p>
    <br>
    <p>Kepada Yth.</p>
    <p>Orang Tua dari ' . $nama . ' di tempat,</p>
    <p>Assalamu’alaikum Wr. Wb</p>
    <p>Sehubungan dengan adanya pelanggaran tata tertib yang dilakukan oleh siswa yang dengan :</p>
    <table cellpadding="4">
        <tr>
            <td width="200">Nama</td>
            <td>: ' . $nama . '</td>
        </tr>
        <tr>
            <td>Nomor Induk Siswa</td>
            <td>: ' . $nis . '</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: ' . $kelas . '</td>
        </tr>
    </table>
    <p>Maka kami memberitahukan kepada bapak/ibu wali siswa dari ' . $nama . ' bahwa siswa tersebut diskor dikarenakan melakukan beberapa pelanggaran yang dapat dilihat pada lembar kedua(lampiran).</p>
    <p>Kami dari pihak sekolah mohon maklum adanya, dan meminta maaf yang sebesar-besarnya.</p>
    <br>
    <p>Wassalamu’alaikum Wr. Wb</p>
    <br>
    <table border="1">
        <tr>
            <td style="width:34%; text-align:center;">Bapak/Ibu/Wali Murid</td>
            <td style="width:34%; text-align:center;">Wali Kelas</td>
            <td style="width:32%; text-align:center;">Kepala Sekolah</td>
        </tr>
        <tr>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:32%; height:100px; text-align:center;"></td>
        </tr>
        </table>
';

    // Tampilkan konten dalam PDF
    $pdf->writeHTML($content1, true, false, true, false, '');

    // Tambahkan halaman kedua
    $pdf->AddPage();

    // Isi konten halaman kedua
// Isi konten PDF
    $contentPage2 = '
<br>
<h2 style="text-align:center;">Detail Pelanggaran</h2>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th style="width:10%; text-align:center;">No</th>
            <th style="width:20%; text-align:center;">Tanggal Pelanggaran</th>
            <th style="width:40%; text-align:center;">Uraian Pelanggaran</th>
            <th style="width:20%; text-align:center;">Kategori</th>
            <th style="width:10%; text-align:center;">Poin</th>
        </tr>
    </thead>
    <tbody>';

    $nomor = 1;
    $data_siswa = mysqli_query($conn, "SELECT pelanggaran.tanggal, pelanggaran.nis, 
                            peraturan.nama_peraturan, peraturan.poin,
                            kriteria.namakriteria, kriteria.bobot
                            FROM pelanggaran
                            INNER JOIN peraturan ON pelanggaran.id_peraturan = peraturan.id_peraturan
                            INNER JOIN kriteria ON peraturan.id_kriteria = kriteria.id_kriteria WHERE pelanggaran.nis=$nis;");
    while ($d = mysqli_fetch_array($data_siswa)) {
        $total_poin = 0;
        $total_poin += $d['poin'];
        $contentPage2 .= '
            <tr>
                <td style="width:10%; text-align:center;">' . $nomor++ . '</td>
                <td style="width:20%; text-align:center">' . $d['tanggal'] . '</td>
                <td style="width:40%; text-align:center">' . $d['nama_peraturan'] . '</td>
                <td style="width:20%; text-align:center">' . $d['namakriteria'] . '</td>
                <td style="width:10%; text-align:center">' . $d['poin'] . '</td>
            </tr>';
    }

    $contentPage2 .= '
        <tr>
            <td style="width:70%; text-align:center;">Total Poin Pelanggaran</td>
            <td style="width:30%; text-align:center">' . $total_poin . ' Poin</td>
        </tr>
        </tbody>
    </table>';


    // Tampilkan konten halaman kedua dalam PDF
    $pdf->writeHTML($contentPage2, true, false, true, false, '');
} else if (isset($_POST['dikembalikan'])) {
    // Tambahkan halaman
    $pdf->AddPage();

    $tanggalHariIni = date('Y-m-d');
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];

    // Isi konten PDF
    $content1 = '
    <br>
    <h4 style="text-align:center;">PENGEMBALIAN SISWA KEPADA ORANG TUA/WALI</h4>
    <br>
    <p style="text-align:left;">Malang, ' . $tanggalHariIni . '</p>
    <br>
    <p>Kepada Yth.</p>
    <p>Orang Tua/Wali Murid dari ' . $nama . ' di tempat,</p>
    <p>Dengan Hormat,</p>
    <p>Berdasarkan data yang ada pada kami tentang pelanggaran tata tertib sekolah yang telah dilakukan oleh siswa atas nama:</p>
    <table cellpadding="4">
        <tr>
            <td width="200">Nama</td>
            <td>: ' . $nama . '</td>
        </tr>
        <tr>
            <td>Nomor Induk Siswa</td>
            <td>: ' . $nis . '</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: ' . $kelas . '</td>
        </tr>
    </table>
    <p>Maka dengan sangat terpaksa kami mengambil tindakan tegas berupa sanksi pengembalian siswa kepada orang tua/wali. Siswa tersebut tidak diperkenankan untuk tetap bersekolah di SMK PGRI 3 Malang.</p>
    <p>Demikian surat ini kami sampaikan atas perhatiannya diucapkan terima kasih.</p>
    <br>
    <table border="1">
        <tr>
            <td style="width:34%; text-align:center;">Bapak/Ibu/Wali Murid</td>
            <td style="width:34%; text-align:center;">Wali Kelas</td>
            <td style="width:32%; text-align:center;">Kepala Sekolah</td>
        </tr>
        <tr>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:34%; height:100px; text-align:center;"></td>
            <td style="width:32%; height:100px; text-align:center;"></td>
        </tr>
        </table>
';

    // Tampilkan konten dalam PDF
    $pdf->writeHTML($content1, true, false, true, false, '');

    // Tambahkan halaman kedua
    $pdf->AddPage();

    // Isi konten halaman kedua
// Isi konten PDF
    $contentPage2 = '
<br>
<h2 style="text-align:center;">Detail Pelanggaran</h2>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th style="width:10%; text-align:center;">No</th>
            <th style="width:20%; text-align:center;">Tanggal Pelanggaran</th>
            <th style="width:40%; text-align:center;">Uraian Pelanggaran</th>
            <th style="width:20%; text-align:center;">Kategori</th>
            <th style="width:10%; text-align:center;">Poin</th>
        </tr>
    </thead>
    <tbody>';

    $nomor = 1;
    $data_siswa = mysqli_query($conn, "SELECT pelanggaran.tanggal, pelanggaran.nis, 
                            peraturan.nama_peraturan, peraturan.poin,
                            kriteria.namakriteria, kriteria.bobot
                            FROM pelanggaran
                            INNER JOIN peraturan ON pelanggaran.id_peraturan = peraturan.id_peraturan
                            INNER JOIN kriteria ON peraturan.id_kriteria = kriteria.id_kriteria WHERE pelanggaran.nis=$nis;");
    while ($d = mysqli_fetch_array($data_siswa)) {
        $total_poin = 0;
        $total_poin += $d['poin'];
        $contentPage2 .= '
            <tr>
                <td style="width:10%; text-align:center;">' . $nomor++ . '</td>
                <td style="width:20%; text-align:center">' . $d['tanggal'] . '</td>
                <td style="width:40%; text-align:center">' . $d['nama_peraturan'] . '</td>
                <td style="width:20%; text-align:center">' . $d['namakriteria'] . '</td>
                <td style="width:10%; text-align:center">' . $d['poin'] . '</td>
            </tr>';
    }

    $contentPage2 .= '
        <tr>
            <td style="width:70%; text-align:center;">Total Poin Pelanggaran</td>
            <td style="width:30%; text-align:center">' . $total_poin . ' Poin</td>
        </tr>
        </tbody>
    </table>';

    // Tampilkan konten dalam PDF
    $pdf->writeHTML($contentPage2, true, false, true, false, '');
}
// Tentukan nama file dan unduh PDF
$pdfName = 'Surat_Pelanggaran_' . $nama . '.pdf';
$pdf->Output($pdfName, 'D');
?>