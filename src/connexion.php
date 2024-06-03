<?php


const DBHOST = "db";
const DBNAME = "projet";
const DBUSER = "test";
const DBPASS = "test";

$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

try {
    // Ici, on essaye de se connecter//
    $db = new PDO($dsn, DBUSER, DBPASS);
    // echo "Connexion reussi" . "<br>";
} catch(PDOException $error) {
    echo "échec de la connexion: " . $error->getMessage() . "<br>";
}
