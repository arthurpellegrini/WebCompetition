<?php
session_start();
?>
<header class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">
        <img src="img/logo.png" alt="logo de MesOutils" width="5%">
    <h1 class="navbar-brand">MesOutils</h1>
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <?php
                if (isset($_SESSION['username'])){
                    echo"<a href='deconnexion.php' class='nav-link'> Déconnexion </a>";
                }
                ?>
            </li>

        </ul>

    </div>
</header>

