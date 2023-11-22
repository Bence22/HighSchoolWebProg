<?php
$dbh = new PDO('mysql:host=localhost;dbname=highschool', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

// Adatbázis lekérdezés
$stmt = $dbh->query("SELECT nev, minimum FROM kepzes");

// Eredmény kiírása
echo '<ul>';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<li>' . $row['nev'] . ' - Minimum: ' . $row['minimum'] . '</li>';
}
echo '</ul>';
?>
