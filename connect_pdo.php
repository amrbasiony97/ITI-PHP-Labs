<?php
    function connect_pdo($db, $host, $port, $user, $password) {
        $dsn = "mysql:dbname={$db};host={$host};port={$port};"; #port number
        try {
            $db = new PDO($dsn, $user, $password);
            return $db;
        }
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
?>