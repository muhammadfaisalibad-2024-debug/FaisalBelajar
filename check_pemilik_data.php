<?php

$conn = new PDO('mysql:host=localhost;dbname=kuliah_wf_2025', 'root', '');

echo "=== Checking User faisal (ID: 1) ===\n\n";

// Check pemilik
$stmt = $conn->query("SELECT * FROM pemilik WHERE iduser = 1");
$pemilik = $stmt->fetch(PDO::FETCH_OBJ);

if ($pemilik) {
    echo "Pemilik found:\n";
    echo "  ID: {$pemilik->idpemilik}\n";
    echo "  No WA: {$pemilik->no_wa}\n";
    echo "  Alamat: {$pemilik->alamat}\n\n";
    
    // Check pets
    echo "=== Checking Pets ===\n";
    $pets = $conn->query("SELECT * FROM pet WHERE idpemilik = {$pemilik->idpemilik}");
    $petCount = 0;
    while ($pet = $pets->fetch(PDO::FETCH_OBJ)) {
        $petCount++;
        echo "Pet {$petCount}:\n";
        echo "  ID: {$pet->idpet}\n";
        echo "  Nama: {$pet->nama}\n";
        echo "  idpemilik: {$pet->idpemilik}\n\n";
    }
    echo "Total pets: {$petCount}\n\n";
    
    // Check temu_dokter for these pets
    echo "=== Checking Temu Dokter ===\n";
    $temu = $conn->query("SELECT t.*, p.nama as pet_name 
                          FROM temu_dokter t 
                          JOIN pet p ON t.idpet = p.idpet 
                          WHERE p.idpemilik = {$pemilik->idpemilik}");
    $temuCount = 0;
    while ($t = $temu->fetch(PDO::FETCH_OBJ)) {
        $temuCount++;
        echo "Temu Dokter {$temuCount}:\n";
        echo "  ID: {$t->idtemu_dokter}\n";
        echo "  Pet: {$t->pet_name}\n";
        echo "  No Urut: {$t->no_urut}\n";
        echo "  Waktu: {$t->waktu_daftar}\n\n";
    }
    echo "Total temu dokter: {$temuCount}\n\n";
    
    // Check rekam medis
    echo "=== Checking Rekam Medis ===\n";
    $rekam = $conn->query("SELECT r.*, t.idtemu_dokter, p.nama as pet_name 
                           FROM rekam_medis r 
                           JOIN temu_dokter t ON r.idtemu_dokter = t.idtemu_dokter 
                           JOIN pet p ON t.idpet = p.idpet 
                           WHERE p.idpemilik = {$pemilik->idpemilik}");
    $rekamCount = 0;
    while ($r = $rekam->fetch(PDO::FETCH_OBJ)) {
        $rekamCount++;
        echo "Rekam Medis {$rekamCount}:\n";
        echo "  ID: {$r->idrekam_medis}\n";
        echo "  Pet: {$r->pet_name}\n";
        echo "  Anamnesa: {$r->anamnesa}\n";
        echo "  Diagnosa: {$r->diagnosa}\n\n";
    }
    echo "Total rekam medis: {$rekamCount}\n";
    
} else {
    echo "NO pemilik record found for user ID 1\n";
    echo "\nAll pemilik records:\n";
    $all = $conn->query("SELECT p.*, u.name FROM pemilik p LEFT JOIN user u ON p.iduser = u.iduser");
    while ($row = $all->fetch(PDO::FETCH_ASSOC)) {
        echo "  Pemilik {$row['idpemilik']}: user_id={$row['iduser']}, user_name={$row['name']}\n";
    }
}
