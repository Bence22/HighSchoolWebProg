<?php
session_start();
if (isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) {
    try {
        // Kapcsolódás
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'bence22', 'Nobel00', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        // Felhsználó keresése
        $sqlSelect = "SELECT id, csaladi_nev, utonev, jogosultsag FROM felhasznalok WHERE bejelentkezes = :bejelentkezes AND jelszo = sha1(:jelszo)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo'], ':jelszo' => $_POST['jelszo']));
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo '<p>Sikeres bejelentkezés!</p>';
            echo '<p>Családi név: ' . $row['csaladi_nev'] . '</p>';
            echo '<p>Utónév: ' . $row['utonev'] . '</p>';
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['id'];
        } else {
            echo '<p>Hibás felhasználónév vagy jelszó!</p>';
        }
    } catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
}

if (isset($_POST['felhasznalo']) && isset($_POST['jelszo']) && isset($_POST['vezeteknev']) && isset($_POST['utonev'])) {
    try {
        // Kapcsolódás
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'bence22', 'Nobel00', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        // Létezik már a felhasználói név?
        $sqlSelect = "select id from felhasznalok where bejelentkezes = :bejelentkezes";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo']));

        if ($sth->fetch(PDO::FETCH_ASSOC)) {
            $uzenet = "A felhasználónév már foglalt!";
            $ujra = "true";
        } else {
            // Ha nem létezik, akkor regisztráljuk
            $sqlInsert = "insert into felhasznalok(id, csaladi_nev, utonev, bejelentkezes, jelszo)
                              values(0, :csaladinev, :utonev, :bejelentkezes, :jelszo)";
            $stmt = $dbh->prepare($sqlInsert);
            $stmt->execute(array(':csaladinev' => $_POST['vezeteknev'], ':utonev' => $_POST['utonev'], ':bejelentkezes' => $_POST['felhasznalo'], ':jelszo' => sha1($_POST['jelszo'])));

            if ($count = $stmt->rowCount()) {
                $newid = $dbh->lastInsertId();
                echo "<p>Sikeres regisztráció!</p>";
                echo "<p>Azonosítója: {$newid}</p>";
                $ujra = false;
            } else {
                echo "<p>A regisztráció nem sikerült.</p>";
                $ujra = true;
            }
        }
    } catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>

<body>


    <?php
    if (isset($uzenet)) {
        echo '<p>' . $uzenet . '</p>';
    }
    ?>

    <?php if (!isset($row) || !$row) : ?>
        <!-- Bejelentkezési űrlap -->
        <h1>Bejelentkezés</h1>
        <form action="" method="post">
            <label for="felhasznalo">Felhasználónév:</label>
            <input type="text" id="felhasznalo" name="felhasznalo" required>

            <label for="jelszo">Jelszó:</label>
            <input type="password" id="jelszo" name="jelszo" required>

            <button type="submit">Bejelentkezés</button>
        </form>

        <!-- Regisztrációs űrlap -->
        <h2>Regisztráció</h2>
        <form action="" method="post">
            <label for="vezeteknev">Családi név:</label>
            <input type="text" id="vezeteknev" name="vezeteknev" required>

            <label for="utonev">Utónév:</label>
            <input type="text" id="utonev" name="utonev" required>

            <label for="reg_felhasznalo">Felhasználónév:</label>
            <input type="text" id="reg_felhasznalo" name="felhasznalo" required>

            <label for="reg_jelszo">Jelszó:</label>
            <input type="password" id="reg_jelszo" name="jelszo" required>

            <button type="submit" name="register">Regisztráció</button>
        </form>

    <?php endif; ?>

</body>

</html>