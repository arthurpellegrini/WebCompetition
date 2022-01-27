<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="" />
        <title>Inscription</title>
    </head>


    <body>
    <?php
    include("header.php");
    ?>
    <div class='form'>
        <div id='connexion'>
            <h2>Création de compte :</h2>
            <form class='connexion' method='post' action=''>
                <p>
                    <label for="username">Username : </label><br/>
                    <input type='text' id="username" name='username' autocomplete="off"   minlength="3" maxlength="50" required pattern= "^[A-Za-z0-9 '-_]+$">
                    <br></br>

                    <label for="password">Password : </label><br/>
                    <input type='password' id="password" name='password' minlength="3">
                    <br></br>

                    <label for="confirmation">Confirmation password: </label><br/>
                    <input type='password' id="confirmation" name='confirmation'  minlength="3">
                    <br></br>

                    <input type='submit' name='ok' value='Créer un compte'/>
                    <br/><br/>

                    <a href="Connexion.php?header=RetournerAccueil">Vous avez déjà un compte ? Connectez vous </a><!--lien vers la page de connexion-->
                </p>

                <?php


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
                    }//fin du switch
                }//fin du if
                ?>

            </form>
        </div>
    </div>
    </body>

    </html>


<?php
include("userManagementDB.php");
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

    // On s'assure que le mot de passe entré dans le champ mot de passe et confirmation sont indentiques
    if ($password==$C_password){
        $result = inscriptionUtilisateur($username, $password);
        if ($result){
            header('Location: connexion.php?id=1');
        }
        else
            header('Location: inscription.php?id=4');
    }
    else //cas où les mots de passes ne sont pas identiques
        header('Location: inscription.php?id=3');

}


?>