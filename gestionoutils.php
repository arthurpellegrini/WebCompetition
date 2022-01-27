<?php

function ajoutelement() {

}

function genererpdf() {

}

function liste_reservations(): array
{
    $host="localhost";
    $login="root";
    $mdp="";
//connexion au SGBD Mysql en root
    $connexion=mysqli_connect($host,$login,$mdp)
    or die("Connexion Impossible");
//utilisation de mesoutils
    $filebd="mesoutils";
    $bd=mysqli_select_db($connexion,$filebd);

    $req="SELECT e.LIBELLE,p.USERNAME FROM elements e,professeurs p WHERE e.RESERVE_PAR = p.ID AND RESERVE_PAR is not null;";

    $result = mysqli_query($connexion,$req);

    $array = array();
    while($ligne=mysqli_fetch_row($result)){
            $array[] = $ligne;
    }
    return $array;
}