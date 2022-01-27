<?php
//todo verif connection
function GetData() : array
{
    return array(["Outils 1", "1"], ["Outils 2", "2"], ["Outils 3", "3"]);
}

function DisplayReservationList($data)
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
            <td>$outils</td>
            <td>
                <button onclick='reserver(\"$outils\", \"$id\")'>Réserver</button>
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
        </script>
    </head>
    <body>
    <?php DisplayReservationList(GetData());?>
    </body>
</html>