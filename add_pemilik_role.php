<?php

$conn = new PDO('mysql:host=localhost;dbname=kuliah_wf_2025', 'root', '');

// Cek user faisal
echo "Checking user faisal (ID: 1):\n";
$user = $conn->query("SELECT * FROM user WHERE iduser = 1")->fetch(PDO::FETCH_OBJ);
if ($user) {
    echo "User found: {$user->name} ({$user->email})\n\n";
    
    // Cek role_user
    echo "Current roles:\n";
    $roles = $conn->query("SELECT ru.*, r.nama_role 
                           FROM role_user ru 
                           JOIN role r ON ru.idrole = r.idrole 
                           WHERE ru.iduser = 1");
    while($role = $roles->fetch(PDO::FETCH_OBJ)) {
        echo "  - {$role->nama_role} (status: {$role->status})\n";
    }
    
    // Cek apakah sudah punya role pemilik (idrole = 5 atau sesuai data)
    echo "\nChecking role 'Pemilik':\n";
    $roleCheck = $conn->query("SELECT idrole, nama_role FROM role WHERE nama_role LIKE '%pemilik%' OR nama_role LIKE '%owner%'")->fetch(PDO::FETCH_OBJ);
    
    if ($roleCheck) {
        echo "Role Pemilik found: ID {$roleCheck->idrole} - {$roleCheck->nama_role}\n";
        
        // Cek apakah user sudah punya role ini
        $hasRole = $conn->query("SELECT * FROM role_user WHERE iduser = 1 AND idrole = {$roleCheck->idrole}")->fetch();
        
        if (!$hasRole) {
            echo "\nAdding Pemilik role to user faisal...\n";
            $conn->exec("INSERT INTO role_user (iduser, idrole, status) VALUES (1, {$roleCheck->idrole}, 1)");
            echo "✓ Role added successfully!\n";
        } else {
            echo "\nUser already has Pemilik role.\n";
            if ($hasRole['status'] == 0) {
                echo "But status is inactive. Activating...\n";
                $conn->exec("UPDATE role_user SET status = 1 WHERE iduser = 1 AND idrole = {$roleCheck->idrole}");
                echo "✓ Role activated!\n";
            }
        }
    } else {
        echo "ERROR: Role 'Pemilik' not found!\n";
        echo "\nAll roles:\n";
        $allRoles = $conn->query("SELECT * FROM role");
        while($r = $allRoles->fetch(PDO::FETCH_OBJ)) {
            echo "  {$r->idrole}. {$r->nama_role}\n";
        }
    }
    
    // Cek data pemilik
    echo "\n\nChecking pemilik table:\n";
    $pemilik = $conn->query("SELECT * FROM pemilik WHERE iduser = 1")->fetch(PDO::FETCH_OBJ);
    if ($pemilik) {
        echo "Pemilik data found: ID {$pemilik->idpemilik}\n";
        
        // Cek pets
        $pets = $conn->query("SELECT * FROM pet WHERE idpemilik = {$pemilik->idpemilik}");
        echo "\nPets owned:\n";
        $petCount = 0;
        while($pet = $pets->fetch(PDO::FETCH_OBJ)) {
            echo "  - {$pet->nama} (ID: {$pet->idpet})\n";
            $petCount++;
        }
        echo "Total: {$petCount} pets\n";
    } else {
        echo "No pemilik record found for user ID 1\n";
    }
} else {
    echo "User not found!\n";
}
