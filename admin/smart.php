<?php

// Step 1: Tentukan banyaknya kriteria dan Berikan bobot ke masing-masing kriteria dengan interval 1-100
$kriteria = [
    'kerajinan' => 24,
    'kerapian' => 15,
    'sikap' => 61
];

// Step 3: Normalisasi nilai bobot kriteria
$totalBobot = array_sum($kriteria);
$normalisasiBobot = [];
foreach ($kriteria as $kriteriaNama => $nilai) {
    $normalisasiBobot[$kriteriaNama] = $nilai / $totalBobot;
}

// Step 4: Berikan nilai parameter kriteria pada setiap kriteria untuk setiap alternatif (Alif)
$alif = [
    'kerajinan' => 19, // Terlambat lebih dari 15 menit
    'kerapian' => 0, // Memanjangkan kuku (3 poin) + Rambut tidak sesuai (10 poin)
    'sikap' => 35 // Membawa rokok
];

// Step 5: Tentukan nilai utiliti dengan mengkonversi nilai kriteria pada masing-masing kriteria yang akan menjadi nilai kriteria data baku
$nilaiUtilitiAlif = [];
foreach ($kriteria as $kriteriaNama => $nilai) {
    $nilaiUtilitiAlif[$kriteriaNama] = $alif[$kriteriaNama] / 100;
}

// Step 6: Tentukan nilai-nilai akhir dari masing-masing kriteria dengan mengalihkan nilai yang didapat dari normalisasi nilai kriteria data baku dengan nilai normalisasi bobot kriteria. Kemudian jumlahkan nilai dari perkalian tersebut.
$totalNilaiAlif = 0;

foreach ($kriteria as $kriteriaNama => $nilai) {
    $totalNilaiAlif += $nilaiUtilitiAlif[$kriteriaNama] * $normalisasiBobot[$kriteriaNama];
}

// Hitung total bobot
$totalBobotAlif = $totalNilaiAlif * 100;

// Tentukan hasil berdasarkan total bobot
function tentukanHasil($totalBobot)
{
    if ($totalBobot >= 0.6 && $totalBobot <= 20) {
        return "PERINGATAN I";
    } elseif ($totalBobot >= 21 && $totalBobot <= 40) {
        return "PERINGATAN II";
    } elseif ($totalBobot >= 41 && $totalBobot <= 80) {
        return "PANGGILAN ORANG TUA";
    } elseif ($totalBobot >= 81 && $totalBobot <= 120) {
        return "SKORSING";
    } else {
        return "DIKEMBALIKAN KE ORANG TUA";
    }
}

// Tampilkan hasil
echo "Total bobot:" . $totalBobotAlif . "\n";
echo "Hasil Alif: " . tentukanHasil($totalBobotAlif) . "\n";

?>
