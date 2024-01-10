<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'bence22', 'Nobel00',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
} catch (PDOException $e) {
    
    die("Adatbázis kapcsolódási hiba: " . $e->getMessage());
}

$chartData = array("labels" => array(), "data" => array());

$stmt = $dbh->query("SELECT nev, minimum FROM kepzes");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $chartData["labels"][] = $row['nev'];
    $chartData["data"][] = $row['minimum'];
}

// JSON válasz küldése
header('Content-Type: application/json');
echo json_encode($chartData);
?>