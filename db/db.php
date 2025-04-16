<?php
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "auth_system";

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
