<?php
include_once("connexionBD.php");
function ajoutelement()
{

}

function genererpdf()
{

}

function liste_reservations($uniquement_reserve = true): array
{
    $connexion = connectionDB();


    $req = "SELECT e.LIBELLE, e.DENOMINATION, e.RESERVE_PAR FROM elements e";
    if($uniquement_reserve){
        $req = "$req WHERE e.RESERVE_PAR IS NOT NULL";
    }
    $result = mysqli_query($connexion, $req);

    $array = array();
    while ($data = mysqli_fetch_row($result)) {
        $outils = $data[0];
        $denomination = $data[1];
        $prof = $data[2];
        if ($prof) {
            $req2 = "SELECT USERNAME from professeurs where id=$prof";
            $result2 = mysqli_query($connexion, $req2);
            while ($data2 = mysqli_fetch_row($result2)) {
                $prof = $data2[0];
            }
        }

        $array[] = array($outils, $denomination, $prof);
    }
    return $array;
}


/**$host = "localhost";
 * $login = "root";
 * $mdp = "";
 * //connexion au SGBD Mysql en root
 * $connexion = mysqli_connect($host, $login, $mdp)
 * or die("Connexion Impossible");
 * //utilisation de mesoutils
 * $filebd = "mesoutils";
 * $bd = mysqli_select_db($connexion, $filebd);*/