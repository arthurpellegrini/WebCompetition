<?php

function connectionDB()
{
    //Variables nécessaires à la connexion
    $host = "localhost";
    $login = "root";
    $mdp = "";
    $filebd = "mesoutils"; //nom de la table

    //Connexion au SGBD mysql en root
    $connexion = mysqli_connect($host, $login, $mdp) //tentative de Connexion
    or die ("connexion impossible");  //en cas d'erreur de Connexion, annule le protocole et affiche "connexion impossible"

    mysqli_select_db($connexion, $filebd); //connexion à la bd

    return $connexion;
}


?>

