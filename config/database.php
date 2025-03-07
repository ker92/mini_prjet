<?php
// config/database.php

class Database {
    private static $host = "localhost";  // Adresse du serveur MySQL
    private static $dbname = "restaurant_admin"; // Nom de la base de données
    private static $username = "root"; // Nom d'utilisateur MySQL
    private static $password = ""; // Mot de passe MySQL
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8", self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function disconnect() {
        self::$conn = null;
    }
}
?>
