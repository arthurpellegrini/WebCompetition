<?php
//todo empecher acces
include_once("connexionBD.php");
function ajoutelement($elem, $denomination)
{
    $connexion = connectionDB();
    $sql = "INSERT INTO elements (LIBELLE, DENOMINATION) VALUES(?,?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ss", $elem, $denomination);
    $stmt->execute();
    mysqli_close($connexion);
}

function get_prof($prof_id)
{
    $connexion = connectionDB();
    $req = "select USERNAME from professeurs where id=$prof_id";
    $result = mysqli_query($connexion, $req);

    $data = mysqli_fetch_row($result);
    mysqli_close($connexion);
    if ($data) {
        return $data[0];
    }
    return null;
}

function get_element($elem_id): array
{
    $connexion = connectionDB();
    $req = "SELECT LIBELLE, IDENTIFIANT FROM elements WHERE IDENTIFIANT=$elem_id";
    $result = mysqli_query($connexion, $req);

    $array = array();
    while ($data = mysqli_fetch_row($result)) {
        $array[] = array($data[0], $data[1]);
    }
    mysqli_close($connexion);
    return $array;
}

function get_reservation_prof($prof_id)
{
    $connexion = connectionDB();
    $req = "SELECT LIBELLE, IDENTIFIANT FROM elements WHERE RESERVE_PAR=$prof_id";
    $result = mysqli_query($connexion, $req);


    $data = mysqli_fetch_row($result);
    if ($data) {
        return array($data[0], $data[1]);
    }
    mysqli_close($connexion);
    return null;
}

function get_reservation_elem($elem_id)
{
    $connexion = connectionDB();
    $req = "SELECT LIBELLE, IDENTIFIANT FROM elements WHERE IDENTIFIANT=$elem_id AND RESERVE_PAR IS NOT NULL";
    $result = mysqli_query($connexion, $req);


    $data = mysqli_fetch_row($result);
    if ($data) {
        return array($data[0], $data[1]);
    }
    mysqli_close($connexion);
    return null;
}

function faire_reservation($prof_id, $elem_id): bool
{
//todo faire reservation et verifier si
    if (get_reservation_prof($prof_id) == null && get_element($elem_id) !== null && get_prof($prof_id) != null && get_reservation_elem($elem_id) == null) {
        $connexion = connectionDB();
        $sql = "UPDATE elements SET RESERVE_PAR=? WHERE IDENTIFIANT=?";

        $stmt = $connexion->prepare($sql);
        $stmt->bind_param("ii", $prof_id, $elem_id);
        $stmt->execute();
        mysqli_close($connexion);
        return true;
    }
    return false;
    // le prof a déja reservé un truc -> pas possible
    // l'objet demandé est déja reservé -> pas possible
    //renvoi un boolen vrai si reussi sinon faux
}

function annuler_reservation($prof_id, $elem_id)
{
//todo enlever reservation et verifier si
    // le prof a bien réservé ce truc
    //renvoi un boolen vrai si reussi sinon faux
}

function liste_reservations($uniquement_reserve = true): array
{
    $connexion = connectionDB();
    $req = "SELECT e.LIBELLE, e.DENOMINATION, e.RESERVE_PAR FROM elements e";
    if ($uniquement_reserve) {
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
    mysqli_close($connexion);
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