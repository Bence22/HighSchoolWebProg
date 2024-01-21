<h2>Belépés</h2>
<form action="<?= SITE_ROOT ?>beleptet" method="post">
    <label for="login">Felhasználó:</label><input type="text" name="login" id="login" required><br>
    <label for="password">Jelszó:</label><input type="password" name="password" id="password" required><br>
    <input type="submit" value="Küldés">
</form>

<p>Nincs még fiókod? Akkor regisztrálj!</p>


<h2>Regisztráció</h2>
<form action="<?= SITE_ROOT ?>regisztracio" method="post">
    <label for="csaladi_nev">Családi név:</label><input type="text" name="csaladi_nev" id="csaladi_nev" required><br>
    <label for="utonev">Utónév:</label><input type="text" name="utonev" id="utonev" required><br>
    <label for="bejelentkezes">Felhasználónév:</label><input type="text" name="bejelentkezes" id="bejelentkezes" required><br>
    <label for="jelszo">Jelszó:</label><input type="password" name="jelszo" id="jelszo" required><br>
    <input type="submit" value="Regisztráció">
</form>
