<?php
//todo verif connection
//todo GET("err") pour erreure de réservation/déreservation
include_once("gestionoutils.php");
session_start();
$reservationUser = get_reservation_prof($_SESSION["id"]);

function GetData() : array
{
    return liste_reservations();
}

function DisplayReservationList($data , $reservationUser)
{
    $itemCount = count($data);

    echo "
<div class='conteneur-table'>
<div class='table'>
    <table class='styled-table'>
        <thead>
            <tr>
                <th colspan='2'>Libéllé</th>
            </tr>
        </thead>
        <tbody>";

    for($i = 0; $i < $itemCount; $i++)
    {
        $outils = $data[$i][0];
        $id = $data[$i][3];

        echo "
        <tr>
            <td>$outils</td>";

        if(!$reservationUser)
        {
            echo "
            <td>
                <button onclick='reserver(\"$outils\", \"$id\")'>Réserver</button>
            </td>";
        }

        echo "
        </tr>
        ";
    }
    if($reservationUser)
    {
        echo "
        <tr>
            <td>$reservationUser[0]</td>
            
            <td>
                <button onclick='rendre(\"$reservationUser[0]\", \"$reservationUser[1]\")'>Rendre</button>
            </td>
        </tr>
        ";
    }
    echo "
        </tbody>
    </table>
</div>
</div>
    ";
}
?>

<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <title>Mes outils</title>
        <link rel='stylesheet' href='css/bootstrap.css'>
        <link rel='stylesheet' href='css/adminTemplates.css'>
        <link rel="icon" type="image/png" href="img/logo.png"/>

        <script>
            function reserver(outils, id)
            {
                if(confirm("Êtes-vous sûr de vouloir réserver " + outils + " ?"))
                    location.href ="actionProf.php?reservation=" + id;
            }

            function rendre(outils, id)
            {
                if(confirm("Êtes-vous sûr de vouloir rendre " + outils + " ?"))
                    location.href ="actionProf.php?annulation=" + id;
            }
        </script>
    </head>
    <body>
    <?php
    include("header.php");
    DisplayReservationList(GetData(), $reservationUser);?>
    </body>
</html>