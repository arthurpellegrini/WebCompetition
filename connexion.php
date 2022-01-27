<html lang="fr">
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href=""/>
</head>

<body>
<?php
include("header.php");
?>
<div class='form'>
    <div id='connexion'>
        <h2>Connexion :</h2>
        <form class='connexion' method='post' action=''>
            <label for='username'>Username : </label> <br/>
            <input type='text' id='username' name='username' autocomplete="off" required/>
            <br></br>

            <label for='password'>Password : </label><br/>
            <input type='password' id='password' name='password' autocomplete="off" required/>
            <br></br>

            <input type='submit' name='ok' value='Connexion'/>
            <br/><br/>
            <a href="inscription.php">Vous n'avez pas de compte ? Créez un compte </a>
            <?php
            if (isset($_GET['id2'])) { //différentes réponses en cas d'erreur ou de modification de la connexion
                switch ($_GET['id2']) {
                    case "1"://en cas d'erreur dans le formulaire
                        echo "<p style = 'color: red ; '> Identifiant ou mot de passe incorrect </p>";
                        break;
                    case "2"://en cas de formulaire vide
                        echo "<p style = 'color: blue; '> Connectez-vous </p>";
                        break;
                    case "3"://quand l'utilisateur se déconnecte
                        echo "<p style = 'color: green; '> Vous vous êtes déconnecté </p>";
                        break;
                    case "4": //en cas d'erreur de connexion
                        echo "<p style = 'color: red; '> Connexion impossible </p>";
                        break;
                }
            }
            ?>

        </form>
    </div>
</div>
</body>

<?php
include("userManagementDB.php");
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = connexionUtilisateur($username, $password);
    if ($user) {//dans le cas où un résultat est renvoyé
        $_SESSION['id'] = $user->id;//les résultats sont stockés dans des variables
        $_SESSION['username'] = $user->username;
        $_SESSION['admin'] = $user->admin;
        header('Location: index.php');//renvoie à la page d'accueil avec le paramètre connecté pour le bandeau.
    } else {//dans le cas d'une requête qui ne correspond pas aux comptes enregistrés
        header('Location: connexion.php?id2=1'); //recharge la page avec un bandeau
    }

}
echo "</html>";
?>

