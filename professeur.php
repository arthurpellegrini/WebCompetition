<?php
//todo verif connection
//todo GET("err") pour erreure de réservation/déreservation
$reservationUser = ["Outils 4", "4"];

function GetData() : array
{
    return array(["Outils 1", "1"], ["Outils 2", "2"], ["Outils 3", "3"]);
}

function DisplayReservationList($data , $reservationUser)
{
    $itemCount = count($data);

    echo "
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
        $id = $data[$i][1];

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
    ";
}
?>

<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <title>Mes outils</title>
        <link rel='stylesheet' href='css/adminTemplates.css'>
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
    <?php DisplayReservationList(GetData(), $reservationUser);?>
    </body>
</html>