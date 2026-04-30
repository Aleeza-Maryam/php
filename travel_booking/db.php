<?php


$host   = 'localhost';   
$dbname = 'travel_db';  
$user   = 'root';        
$pass   = '';            
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("<p style='color:red;font-family:sans-serif;padding:20px'>
         ❌ Database Connection Failed: " . $e->getMessage() . "
         </p>");
}
?>