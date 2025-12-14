<?php

$conn = new PDO('mysql:host=localhost;dbname=kuliah_wf_2025', 'root', '');

echo "=== CEK DATA REKAM MEDIS ===\n\n";

// Cek rekam medis
$stmt = $conn->query("SELECT idrekam_medis, anamnesa, diagnosa, idreservasi_dokter, dokter_pemeriksa FROM rekam_medis");
echo "Data Rekam Medis:\n";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "  ID: {$row['idrekam_medis']}, Anamnesa: {$row['anamnesa']}, ";
    echo "ID Reservasi: " . ($row['idreservasi_dokter'] ?? 'NULL') . ", ";
    echo "Dokter: " . ($row['dokter_pemeriksa'] ?? 'NULL') . "\n";
}

echo "\n=== CEK DATA TEMU DOKTER ===\n\n";

// Cek temu dokter
$stmt = $conn->query("
    SELECT td.idreservasi_dokter, td.no_urut, td.waktu_daftar, td.idpet, 
           p.nama as pet_name, pm.idpemilik
    FROM temu_dokter td
    LEFT JOIN pet p ON td.idpet = p.idpet
    LEFT JOIN pemilik pm ON p.idpemilik = pm.idpemilik
");

echo "Data Temu Dokter:\n";
$temuDokterCount = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $temuDokterCount++;
    echo "  ID Reservasi: {$row['idreservasi_dokter']}, No Urut: {$row['no_urut']}, ";
    echo "Pet: {$row['pet_name']}, ID Pemilik: {$row['idpemilik']}\n";
}

if ($temuDokterCount == 0) {
    echo "  TIDAK ADA DATA TEMU DOKTER!\n";
    echo "\n=== SOLUSI ===\n";
    echo "Anda perlu membuat data Temu Dokter terlebih dahulu melalui menu admin atau resepsionis.\n";
    echo "Atau jalankan query manual untuk insert data temu dokter.\n";
} else {
    echo "\n=== SOLUSI ===\n";
    echo "Update rekam medis agar terhubung ke temu dokter yang ada.\n";
    echo "Contoh query:\n";
    echo "UPDATE rekam_medis SET idreservasi_dokter = 1 WHERE idrekam_medis = 1;\n";
}

echo "\n=== CEK DATA PET ===\n\n";
$stmt = $conn->query("
    SELECT p.idpet, p.nama, pm.idpemilik, u.nama as owner_name
    FROM pet p
    JOIN pemilik pm ON p.idpemilik = pm.idpemilik
    JOIN user u ON pm.iduser = u.iduser
");

echo "Data Pet:\n";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "  ID Pet: {$row['idpet']}, Nama: {$row['nama']}, Pemilik: {$row['owner_name']}\n";
}
