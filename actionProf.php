<?php
//todo verifier user
session_start();
include_once("gestionoutils.php");
$err = false;
if (isset($_GET["reservation"])) {
    $reservation = $_GET["reservation"];
    $err = !faire_reservation($_SESSION["id"], $reservation);

} else if (isset($_GET["annulation"])) {
    $annulation = $_GET["annulation"];
    $err = !annuler_reservation($_SESSION["id"], $annulation);
}
$url = "professeur.php";
if($err){
    $url = "$url?err";
}
header("Location: $url");
