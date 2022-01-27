<?php
//todo empecher acces
function ajoutelement() {

}

function genererpdf() {

}

function get_reservation_prof($prof_id){
    //todo renvoi la réservation du prof ou "null"
}

function faire_reservation($prof_id,$elem_id){
//todo faire reservation et verifier si
    // le prof a déja reservé un truc -> pas possible
    // l'objet demandé est déja reservé -> pas possible
    //renvoi un boolen vrai si reussi sinon faux
}

function annuler_reservation($prof_id,$elem_id){
//todo enlever reservation et verifier si
    // le prof a bien réservé ce truc
    //renvoi un boolen vrai si reussi sinon faux
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