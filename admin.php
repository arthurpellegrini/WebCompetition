<?php
include("gestionoutils.php");
/**
 * @return string[][]
 */
function GetData(): array
{
    $liste_reservations = liste_reservations();
    return $liste_reservations;
    //return $data = array(array("Outils 1", "Outils 2", "Outils 3"), array("Prof 1", "Prof 2", "Prof 3"));
}

function DisplayReservationTable($data)
{
    echo "
<div class='table'>
    <table class='styled-table'>
        <thead>
            <tr>
                <th colspan='2'>Réservations</th>
            </tr>
            <tr>
                <th colspan='1'>Libéllé</th>
                <th colspan='1'>Dénomination</th>
                <th colspan='1'>Professeurs</th>
            </tr>
        </thead>
        <tbody>";

    for ($i = 0; $i < count($data); $i++) {
        $outils = $data[$i][0];
        $prof = $data[$i][1];
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
</head>
<body>
<?php DisplayReservationTable(GetData()); ?></body>
</html>
