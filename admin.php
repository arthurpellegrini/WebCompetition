<?php
//todo verif connection
include("gestionoutils.php");
/**
 * @return string[][]
 */
$professorList = ["blabla"];

function GetData(): array
{
    return liste_reservations(false);
}

function DisplayReservationTable($data)
{
    echo "
<div class='table'>
    <table class='styled-table'>
        <thead>
            <tr>
                <th colspan='3'>Réservations</th>
            </tr>
            <tr>
                <th colspan='1'>Outils</th>
                <th colspan='1'>Dénomination</th>
                <th colspan='1'>Professeurs</th>
            </tr>
        </thead>
        <tbody>";

    for ($i = 0; $i < count($data); $i++) {
        $outils = $data[$i][0];
        $denomination = $data[$i][1];
        $prof = $data[$i][2];
        echo "
        <tr>
            <td>$denomination</td>
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

function DisplayProfessorList($professorList)
{
    $itemCount = count($professorList);

    echo "
<div class='table'>
    <table class='styled-table'>
        <thead>
            <tr>
                <th colspan='1'>Utilisateurs</th>
            </tr>
        </thead>
        <tbody>";

    for($i = 0; $i < $itemCount; $i++)
    {
        echo "
        <tr>
            <td>$professorList[$i]</td>
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
<?php DisplayReservationTable(GetData());
DisplayProfessorList($professorList);
echo(faire_reservation(5,10));
?>
</body>
</html>
