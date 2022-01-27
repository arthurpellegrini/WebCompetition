<?php
session_start();
?>
<header>
    <h1>MesOutils</h1>
    <?php
    if (isset($_SESSION['username'])){
        echo"<a href='deconnexion.php' class='logoutButton'> Déconnexion </a>";
    }
    ?>
</header>

