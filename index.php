<html lang="fr">
<head>
    <title>Connexion</title>
    <link rel='stylesheet' href='css/bootstrap.css'>
    <link rel='stylesheet' href='css/adminTemplates.css'>
    <link rel="icon" type="image/png" href="img/logo.png"/>
</head>

<body>
<?php
include_once("header.php");
if (isset($_SESSION['username'])) {
    if ($_SESSION['admin']) {
        header("Location: admin.php");
    } else {
        header("Location: professeur.php");
    }
    exit();
}

?>
<div class="conteneur">
    <div class='form'>
        <form class='connexion' method='post' action=''>
            <h2>Connexion :</h2>
            <div class="form-group">
                <label for='username'>Nom d'utilisateur : </label> <br/>
                <input type='text' id='username' name='username' autocomplete="off" required/>
                <br></br>
            </div>

            <div class="form-group">
                <label for='password'>Mot de passe : </label><br/>
                <input type='password' id='password' name='password' autocomplete="off" required/>
                <br></br>
            </div>

            <div class="form-group">
                <input type='submit' name='ok' value='Connexion'/>
                <br/><br/>
            </div>

            <a href="inscription.php">Vous n'avez pas de compte ? Créez un compte </a>
            <?php
            //todo verfier id inutilisé
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
include_once("userManagementDB.php");
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
        header('Location: index.php?id2=1'); //recharge la page avec un bandeau
    }

}
echo "</html>";
?>

