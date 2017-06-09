<?php

namespace MonNamespace\Models;

use \PDO;
use \Exception;

class Model {

    protected $table;

    private static $user = "root";
    private static $password = "";
    private static $database = "bet";
    private static $host = "localhost";

    protected static $_pdo = null;

    public function __construct() {
        if (self::$_pdo === null) {
            try {
                self::$_pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$database, self::$user, self::$password);
            } catch(Exception $e) {
                header("HTTP/1.1 500 Internal Server Error");
                die();
            }
        }
    }

    public function setUser($user) {
        self::$user = $user;
    }

    public function setPassword($password) {
        self::$password = $password;
    }

    public function setDatabase($database) {
        self::$database = $database;
    }

    public function setHost($host) {
        self::$host = $host;
    }

    public function getUser() {
        return self::$user;
    }

    public function getPassword() {
        return self::$password;
    }

    public function getDatabase() {
        return self::$database;
    }

    public function getHost() {
        return self::$host;
    }

    public function getTable() {
        $sql="SHOW TABLES";
        $query = self::$_pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read($table, $clause = null, $params = null) {
        $sql = "SELECT * FROM $table";
        if($clause !== null) {
            $sql .= " WHERE ".$clause;
        }
        $query = self::$_pdo->prepare($sql);
        $query->execute($params);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // public function save($table, $clause = null, $params = null) {
    //     $sql = "INSERT INTO $table";
    //     if($clause !== null) {
    //         $sql .= " WHERE ".$clause;
    //     }
    //     $query = self::$_pdo->prepare($sql);
    //     $query->execute($params);
    //     return $query->fetch(PDO::FETCH_ASSOC);
    // }

    // // public function delete($table, $clause = null, $params = null) {
        
    // // }

    public function find($table, $clause = null, $params = null) {
        $sql = "SELECT * FROM $table";
        if($clause !== null) {
            $sql .= " WHERE ".$clause;
        }
        $query = self::$_pdo->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function update($table, $clause = null, $params = null) {
    //     $sql = "UPDATE $table SET";
    //     if($clause !== null) {
    //         $sql .= " WHERE ".$clause;
    //     }
    //     $query = self::$_pdo->prepare($sql);
    //     $query->execute($params);
    //     return $query->fetch(PDO::FETCH_ASSOC);
    // }

}