<?php 

$host = 'localhost';
$db = 'ifoa_office';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$_GET["id"]]);

header("Location: http://localhost/IFOA-BackEnd/Esercizio%20S1-L3/homepage.php");