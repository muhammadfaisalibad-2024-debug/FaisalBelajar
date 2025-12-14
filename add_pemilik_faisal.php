<?php

$conn = new PDO('mysql:host=localhost;dbname=kuliah_wf_2025', 'root', '');

// Check user faisal
$user = $conn->query("SELECT * FROM user WHERE iduser = 1")->fetch(PDO::FETCH_OBJ);
echo "User: {$user->name} (ID: {$user->iduser}, Email: {$user->email})\n";

// Check if pemilik exists
$existing = $conn->query("SELECT * FROM pemilik WHERE iduser = 1")->fetch(PDO::FETCH_OBJ);

if ($existing) {
    echo "Pemilik already exists for this user!\n";
    echo "ID Pemilik: {$existing->idpemilik}\n";
} else {
    echo "No pemilik record found. Creating new pemilik...\n";
    
    $stmt = $conn->prepare("INSERT INTO pemilik (no_wa, alamat, iduser, created_at, updated_at) 
                            VALUES (?, ?, ?, NOW(), NOW())");
    $stmt->execute(['081234567890', 'Jl. Pemilik Faisal No. 1', 1]);
    
    $newId = $conn->lastInsertId();
    echo "SUCCESS! Created pemilik with ID: {$newId}\n";
    
    // Verify
    $verify = $conn->query("SELECT * FROM pemilik WHERE idpemilik = {$newId}")->fetch(PDO::FETCH_OBJ);
    echo "Pemilik: {$verify->no_wa}, alamat: {$verify->alamat}, user_id: {$verify->iduser}\n";
}
