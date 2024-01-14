<?php
$op = isset($_POST['op']) ? $_POST['op'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

$eredmeny = array("lista" => array());

try {
    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'bence22', 'Nobel00',
                  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    switch ($op) {
        case 'jelentkezes':
            $stmt = $dbh->prepare("SELECT jelentkezoid, kepzesid, szerzett FROM jelentkezes WHERE jelentkezoid = :id");
            break;
        case 'jelentkezo':
            $stmt = $dbh->prepare("SELECT id, nev FROM jelentkezo WHERE id = :id");
            break;
        case 'kepzes':
            $stmt = $dbh->prepare("SELECT id, nev FROM kepzes WHERE kepzesid = :id");
            break;
        default:
            echo json_encode(array("error" => "Érvénytelen 'op' érték."));
            exit;
    }

    $stmt->execute(array(":id" => $id));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $eredmeny["lista"][] = $row;
    }

    echo json_encode($eredmeny);
} catch (PDOException $e) {
    echo json_encode(array("error" => "Hiba történt a szerver oldalán."));
}
?>