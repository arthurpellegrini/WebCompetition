<?php
//todo verif sécurité
include_once("lib/fpdf184/fpdf.php");
include_once("gestionoutils.php");
$data = liste_reservations(false);
$header = array("Objet", "Dénomination", "Réservé Par");

for ($j = 0; $j < count($header); $j++) {
    $header[$j] = utf8_decode($header[$j]);
}

for ($i = 0; $i < count($data); $i++) {
    for ($j = 0; $j < count($data[$i]); $j++) {
        $data[$i][$j] = utf8_decode($data[$i][$j]);
    }
}

$w = array(130, 75, 70);
$pdf = new FPDF();
$pdf->AddPage("L");
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetX(130);
$pdf->Cell(50,10,utf8_decode("Liste des réservations"),align: "C");
$pdf->SetX(0);
$pdf->SetY(30);

// Couleurs, épaisseur du trait et police grasse
$pdf->SetFillColor(255, 0, 0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128, 0, 0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('', 'B');
// En-tête
for ($i = 0; $i < count($header); $i++)
    $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
$pdf->Ln();
// Restauration des couleurs et de la police
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
// Données
$fill = false;
foreach ($data as $row) {
    $pdf->Cell($w[0], 6, $row[0], 'LR', 0, 'C', $fill);
    $pdf->Cell($w[1], 6, $row[1], 'LR', 0, 'C', $fill);
    $pdf->Cell($w[2], 6, $row[2], 'LR', 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill;
}
// Trait de terminaison
$pdf->Cell(array_sum($w), 0, '', 'T');

$pdf->Output();