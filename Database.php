<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database
{
    private static $connection = null;

    private static function connect_pdo($crd)
    {
        $dsn = "mysql:dbname={$crd['db']};host={$crd['host']};port={$crd['port']};";
        try {
            self::$connection = new PDO($dsn, $crd['user'], $crd['password']);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    static function connect($credentials)
    {
        if (!isset(self::$connection)) {
            self::connect_pdo($credentials);
        }
        return self::$connection;
    }

    static function insert($table, $record)
    {
        try {
            $query = "INSERT INTO {$table} (name, email, password, room_no, ext, image)
                    VALUES (:name, :email, :password, :room_no, :ext, :image)";
            $stmt = self::$connection->prepare($query);
            $stmt->bindParam(":name", $record['name'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $record['email'], PDO::PARAM_STR);
            $stmt->bindParam(":password", $record['password'], PDO::PARAM_STR);
            $stmt->bindParam(":room_no", $record['room_no'], PDO::PARAM_STR);
            $stmt->bindParam(":ext", $record['ext'], PDO::PARAM_INT);
            $stmt->bindParam(":image", $record['image'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_msg($e->getMessage());
        }
    }

    static function select($table)
    {
        try {
            $query = "SELECT * FROM {$table};";
            $stmt = self::$connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_msg($e->getMessage());
        }
    }

    static function update($table, $id, $record)
    {
        try {
            $query = "UPDATE {$table} SET name = :name, email = :email, 
            password = :password, room_no = :room_no, ext = :ext, image = :image
            WHERE id = :id";
            $stmt = self::$connection->prepare($query);
            $stmt->bindParam(":name", $record['name'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $record['email'], PDO::PARAM_STR);
            $stmt->bindParam(":password", $record['password'], PDO::PARAM_STR);
            $stmt->bindParam(":room_no", $record['room_no'], PDO::PARAM_STR);
            $stmt->bindParam(":ext", $record['ext'], PDO::PARAM_INT);
            $stmt->bindParam(":image", $record['image'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_msg($e->getMessage());
        }
    }

    static function delete($table, $id)
    {
        try {
            $query = "DELETE FROM {$table} WHERE id = :id";
            $stmt = self::$connection->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_msg($e->getMessage());
        }
    }
}
