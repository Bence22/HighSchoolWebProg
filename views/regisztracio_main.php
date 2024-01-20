<?php
// Adatbázis kapcsolódás
$host = "localhost";
$dbname = "web2";
$username = "bence22";
$password = "Nobel00";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // PDO beállítások a hibák kiváltásához
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Hiba az adatbázishoz való kapcsolódás során: " . $e->getMessage());
}

// Ellenőrizze, hogy a POST kérés történt-e (az űrlap beküldése)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ellenőrizze a felhasználói beviteli mezőket
    $csaladi_nev = $_POST['csaladi_nev'];
    $utonev = $_POST['utonev'];
    $bejelentkezes = $_POST['bejelentkezes'];
    $jelszo = $_POST['jelszo'];

    // Ellenőrizze, hogy a felhasználónév még nem létezik
    $query = $dbh->prepare("SELECT id FROM felhasznalok WHERE bejelentkezes = :bejelentkezes");
    $query->bindParam(":bejelentkezes", $bejelentkezes);
    $query->execute();

    if ($query->rowCount() > 0) {
        $error_message = "A megadott felhasználónév már foglalt.";
    } else {
        // Jelszó titkosítása
        $hash_jelszo = password_hash($jelszo, PASSWORD_BCRYPT);

        // Felhasználó hozzáadása az adatbázishoz
        $insert_query = $dbh->prepare("INSERT INTO felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo) VALUES (:csaladi_nev, :utonev, :bejelentkezes, :jelszo)");
        $insert_query->bindParam(":csaladi_nev", $csaladi_nev);
        $insert_query->bindParam(":utonev", $utonev);
        $insert_query->bindParam(":bejelentkezes", $bejelentkezes);
        $insert_query->bindParam(":jelszo", $hash_jelszo);

        if ($insert_query->execute()) {
            
            echo "Sikeres regisztráció! Kérem, lépjen vissza a Belépő felületre.";
            exit();
        } else {
            $error_message = "Hiba történt a regisztráció során. Kérjük, próbálja újra.";
        }
    }
}
?>