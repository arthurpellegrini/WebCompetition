<?php
function GetData()
{
    return $data = array(array("Outils 1", "Outils 2", "Outils 3"), array("Prof 1", "Prof 2", "Prof 3"));
}

function DisplayReservationTable($data)
{
    $itemCount = count($data[0]);

    echo "
<table>
    <thead>
        <tr>
            <th colspan='2'>Réservation</th>
        </tr>
        <tr>
            <th colspan='1'>Outils</th>
            <th colspan='1'>Professeurs</th>
        </tr>
    </thead>
    <tbody>";

    for($i = 0; $i < $itemCount; $i++)
    {
        $outils = $data[0][$i];
        $prof = $data[1][$i];
        echo "
        <tr>
            <td>$outils</td>
            <td>$prof</td>
        </tr>
        ";
    }
    echo "
    </tbody>
</table>
    ";
}

function Main()
{
    echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mes outils</title>
</head>
<body>';

    DisplayReservationTable(GetData());

    echo '</body>
</html>';
}

Main();
?>