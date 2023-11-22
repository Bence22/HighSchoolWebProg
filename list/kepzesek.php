<?php
$dbh = new PDO('mysql:host=localhost;dbname=highschool', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

// Adatbázis lekérdezés
$stmt = $dbh->query("SELECT nev FROM kepzes");

// Eredmény kiírása
echo '<ul>';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<li>' . $row['nev'] . '</li>';
}
echo '</ul>';
?>