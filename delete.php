<?php
    require_once 'Database.php';
    require_once 'return_msg.php';
    
    Database::connect([
        'db' => 'php',
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'mans-os07',
        'password' => 'Abcd@1234'
    ]);

    $imagePath = $_GET['image'];
    $result = Database::delete('users', $_GET['id']);

    if ($result > 0) {
        if ($imagePath !== 'images/default.png') {
            unlink($imagePath);
        }
        return_msg('User deleted successfully', 'success');
    } else {
        return_msg('User not found', 'danger');
    }
?>