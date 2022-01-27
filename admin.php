<?php
//todo verif connection
include_once("gestionoutils.php");
include_once("userManagementDB.php");
/**
 * @return string[][]
 */
$professorList = listeUtilisateurs();

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
                <th colspan='1'>Outil</th>
                <th colspan='1'>Dénomination</th>
                <th colspan='1'>Réservé Par</th>
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
    <link rel='stylesheet' href='css/bootstrap.css'>
    <link rel='stylesheet' href='css/adminTemplates.css'>
    <link rel="icon" type="image/png" href="img/logo.png"/>
</head>
<body>
<?php
include_once("header.php");
DisplayReservationTable(GetData());
DisplayProfessorList($professorList);
?>

<div class='form'>
    <form method='post' action=''>
        <h2>Ajouter un outil :</h2>
        <div class="form-group">
            <label for='username'>Libellé de l'outil : </label> <br/>
            <input type='text' id='libelle' name='libelle' autocomplete="off" required/>
            <br></br>
        </div>

        <div class="form-group">
            <label for='password'>Dénomination de l'outil : </label><br/>
            <input type='password' id='denomination' name='denomination' autocomplete="off" required/>
            <br></br>
        </div>

        <div class="form-group">
            <input type='submit' name='ok' value='Ajouter'/>
            <br/><br/>
        </div>
    </form>
</div>
</body>
</html>
