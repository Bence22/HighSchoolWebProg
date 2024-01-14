<?php
session_start();

// Példa adatbázisból
$registeredUsers = array(
    'user1' => array('password' => 'password1', 'role' => 'user'),
    'admin1' => array('password' => 'adminpassword1', 'role' => 'admin')
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['felhasznalo'];
    $password = $_POST['jelszo'];

    // Ellenőrizzük a bejelentkezési adatokat
    if (array_key_exists($username, $registeredUsers) && $registeredUsers[$username]['password'] === $password) {
        // Sikeres bejelentkezés
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $registeredUsers[$username]['role'];
        header('Location: index.php');
        exit;
    } else {
        // Sikertelen bejelentkezés
        $errorMessage = 'Hibás felhasználónév vagy jelszó!';
    }
}

// Ellenőrizze, hogy a felhasználó be van-e jelentkezve
$loggedIn = isset($_SESSION['username']);

// Ellenőrizze, hogy a felhasználó milyen szerepkörben van
$role = $loggedIn ? $_SESSION['role'] : 'visitor';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>

<h1>Bejelentkezés</h1>

<?php
if (isset($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
}

// Ha be van jelentkezve, írja ki a szerepkört
if ($loggedIn) {
    echo '<p>Bejelentkezve, Szerepkör: <strong>' . ucfirst($role) . '</strong></p>';
}
?>

<form action="" method="post">
    <label for="felhasznalo">Felhasználónév:</label>
    <input type="text" id="felhasznalo" name="felhasznalo" required>
    
    <label for="jelszo">Jelszó:</label>
    <input type="password" id="jelszo" name="jelszo" required>

    <button type="submit">Bejelentkezés</button>
</form>

</body>
</html>