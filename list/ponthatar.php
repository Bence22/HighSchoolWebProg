<?php

require 'database/Database.php';
$database = new Database("localhost", "highschool", "admin", "log");

try {
    $dbh = new PDO('mysql:host=localhost;dbname=highschool', 'admin', 'log');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    $stmt = $dbh->query("SELECT nev, minimum FROM kepzes");

    echo '<ul>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<li>' . $row['nev'] . ' - Minimum: ' . $row['minimum'] . '</li>';
    }
    echo '</ul>';
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
} finally {
    $dbh = null;
}
?>
