<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel='stylesheet' href='css/adminTemplates.css'>
        <title>Inscription</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>


    <body>
    <?php
    include_once("header.php");
    ?>
    <div class='conteneur'>
        <div class='form'>
            <form class='connexion' method='post' action=''>
                <h2>Création de compte :</h2>
                <p>
                    <label for="username">Nom d'utilisateur : </label><br/>
                    <input type='text' id="username" name='username' autocomplete="off"   minlength="3" maxlength="50" required pattern= "^[A-Za-z0-9 '-_]+$">
                    <br></br>

                    <label for="password">Mot de passe : </label><br/>
                    <input type='password' id="password" name='password' minlength="3">
                    <br></br>

                    <label for="confirmation">Confirmation du mot de passe: </label><br/>
                    <input type='password' id="confirmation" name='confirmation'  minlength="3">
                    <br></br>

                    <input type='submit' name='ok' value='Créer un compte'/>
                    <br/><br/>

                    <a href="index.php?header=RetournerAccueil">Vous avez déjà un compte ? Connectez vous </a><!--lien vers la page de connexion-->
                </p>

                <?php

//todo verifier id inutilisés
                if (isset($_GET['id'])){//les différents cas après la tentative de création de compte
                    switch ($_GET['id']){
                        case "1"://cas où le compte à été créé
                            echo "<p style = 'color: green ; '> Votre compte a bien été créé </p>";
                            break;
                        case "2"://cas où un ou plusieurs champs n'ont pas été remplis en respectant les conditions
                            //soit manquants, soit mal remplis
                            echo "<p style = 'color: red ; '> Les champs ne sont pas tous renseignés </p>";
                            break;
                        case "3"://cas où les deux mots de passes sont différents
                            echo "<p style = 'color: red ; '> Les mots de passes entrés doivent être identiques</p>";
                            break;
                        case "4"://cas où le nom d'utilisateur est déjà pris
                            echo "<p style = 'color: red ; '> Votre nom d'utilisateur est déja utilisé par un autre utilisateur</p>";
                            break;
                        case "5"://cas où le captcha n'est pas validé
                            echo "<p style = 'color: red ; '> Vous n&quot;avez pas validé le Captcha</p>";
                            break;
                    }//fin du switch
                }//fin du if
                ?>
                <div class="g-recaptcha" data-sitekey="6LeAHD8eAAAAAFdmYmbJp0Tqf-l-8YBcYCJLJteH"></div>
            </form>
        </div>
    </div>
    </body>

    </html>


<?php
include_once("userManagementDB.php");

function isValidCaptcha()
{
    try {

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = ['secret'   => '6LeAHD8eAAAAAJnOkXrgJXw0HooeI0EiubpYIiqN',
            'response' => $_POST['g-recaptcha-response'],
            'remoteip' => $_SERVER['REMOTE_ADDR']];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result)->success;
    }
    catch (Exception $e) {
        return null;
    }
}
function valid_donnees($donnees){//s'assure que les données sont valides
    $donnees = trim($donnees);//supprime les espaces en début et fin de chaîne
    $donnees = stripslashes($donnees);//supprime les antislashs
    $donnees = htmlspecialchars($donnees);//Convertit les caractères spéciaux en entités HTML
    return $donnees;//renvoie les données mises à jour
}


if (isset($_POST['username'],$_POST['password'],$_POST['confirmation'])){
    //on récupère les informations du formulaire
    $username = valid_donnees($_POST["username"]);
    $password = valid_donnees($_POST["password"]);
    $C_password = valid_donnees($_POST["confirmation"]);

    if(!isValidCaptcha())
        header('Location: inscription.php?id=5');
    // On s'assure que le mot de passe entré dans le champ mot de passe et confirmation sont indentiques
    if ($password==$C_password){
        $result = inscriptionUtilisateur($username, $password);
        if ($result && connexionUtilisateur($username,$password)){
            header('Location: index.php');
        }
        else
            header('Location: inscription.php?id=4');
    }
    else //cas où les mots de passes ne sont pas identiques
        header('Location: inscription.php?id=3');

}


?>