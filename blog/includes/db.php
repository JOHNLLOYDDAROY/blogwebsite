<?php


// require_once('../config.php');
//include_once('../config.php');
include_once(__DIR__ . '/../config.php');
try {
     $db = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
   
} catch (PDOException $e) {
    echo "CONNECTION FAILED: " . $e->getMessage();
    exit;
}
?>

