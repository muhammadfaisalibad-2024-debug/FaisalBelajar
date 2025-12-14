<?php

$conn = new PDO('mysql:host=localhost;dbname=kuliah_wf_2025', 'root', '');

echo "Checking user 'faisal' (ID: 1):\n";
$stmt = $conn->query("SELECT * FROM owner WHERE iduser = 1");
$owner = $stmt->fetch(PDO::FETCH_OBJ);

if($owner) {
    echo "Owner found: {$owner->nama} (ID: {$owner->idowner})\n";
    echo "Phone: {$owner->no_hp}\n";
    echo "Address: {$owner->alamat}\n\n";
    
    // Check pets
    $pets = $conn->query("SELECT * FROM pet WHERE idowner = {$owner->idowner}");
    echo "Pets owned:\n";
    while($pet = $pets->fetch(PDO::FETCH_OBJ)) {
        echo "  - {$pet->nama} (ID: {$pet->idpet})\n";
    }
} else {
    echo "NO owner record found for user ID 1\n\n";
    
    echo "All owners in database:\n";
    $all = $conn->query("SELECT o.idowner, o.nama, o.iduser, u.name as user_name 
                         FROM owner o 
                         LEFT JOIN user u ON o.iduser = u.iduser");
    while($row = $all->fetch(PDO::FETCH_ASSOC)) {
        echo "  Owner {$row['idowner']}: {$row['nama']} (user_id: {$row['iduser']}, user: {$row['user_name']})\n";
    }
}
