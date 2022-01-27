<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: prof.php");
    }
} else {
    header("Location: connexion.php");
}
?>