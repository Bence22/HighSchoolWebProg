<?php
if (isset($_POST['felhasznalo']) && isset($_POST['jelszo']) && isset($_POST['logout'])) {
    session_start();
    session_destroy();
    echo '<script>window.location.href = "belepes.php";</script>';
    exit();
}
?>
