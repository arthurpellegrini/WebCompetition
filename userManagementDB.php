<?php
include("connexionBD.php");

class user
{
    public $id;
    public $username;
    public $admin;

    function __construct($id, $username, $admin)
    {
        $this->id = $id;
        $this->username = $username;
        $this->admin = $admin;
    }
}

function connexionUtilisateur($username, $password)
{
    $connexion = connectionDB();
    $req = "SELECT ID, EST_ADMIN, PASSWORD FROM professeurs WHERE USERNAME= ?";//préparation de la requête SQL
    $reqprepare = mysqli_prepare($connexion, $req);//prépare la commande en s'assurant qu'il n'y a pas d'éxécution de code à l'intérieur
    mysqli_stmt_bind_param($reqprepare, 's', $username);
    mysqli_stmt_execute($reqprepare);//éxécute la commande
    $resultat = mysqli_stmt_get_result($reqprepare);
    $nb_result = mysqli_num_rows($resultat);

    if ($nb_result == 0) {
        return false;
    }
    $result = mysqli_fetch_row($resultat);//récupère les résultats de la requête

    mysqli_close($connexion);//fermeture de la connexion à la BD

    if (password_verify($password, $result[2])) {
        return new user($result[0], $username, $result[1]);
    } else
        return false;
}

function inscriptionUtilisateur($username, $password)
{
    $connexion = connectionDB();
    $table = "professeurs";
    //requête pour vérifier si le nom d'utilisateur n'est pas déjà utilisé
    $req = "SELECT USERNAME FROM $table WHERE USERNAME= ?";
    $reqprepare = mysqli_prepare($connexion, $req);
    mysqli_stmt_bind_param($reqprepare, 's', $username);
    mysqli_stmt_execute($reqprepare);
    $resultat = mysqli_stmt_get_result($reqprepare);
    $nb_result = mysqli_num_rows($resultat);

    // On s'assure que le nom d'utilisateur entré est unique dans la base de données
    if (empty($nb_result)) {
        $req = "INSERT into $table (USERNAME,PASSWORD)";
        //concaténer (ecrire a la suite de la variable)
        $req .= "VALUES(?,?)";

        $reqprepare = mysqli_prepare($connexion, $req);
        //insère les informations dans la BD
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        mysqli_stmt_bind_param($reqprepare, 'ss', $username, $hashed_password);
        mysqli_stmt_execute($reqprepare);

        mysqli_close($connexion);//fermeture de la connexion à la BD

        return True;
    } else
        return "usernameExist";
}
