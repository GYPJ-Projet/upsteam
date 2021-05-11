<?php

    /* Classe       : CreerPDF
     * Description  : Génère un pdf.
     *
     * PH
     * On doit fournir
     * 
     */

    class CreerPDF
    {
        public static function creationPDF($nomFichier, $titre, $texte){
            require 'lib/fpdf.php';

            $chemin = 'pdf/' . $nomFichier . '.pdf';
            $logo = 'logo/logo_v2.jpg';
            
            $nomCompagnie = "Véhicules d'occasion";
            $nomCompagnie = utf8_decode($nomCompagnie);

            $signature =  "L'équipe de Voiture d'occasion.";
            $signature = utf8_decode($signature);

            
            $titre = utf8_decode($titre);
            $texte = utf8_decode($texte);


            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(190,10,$nomCompagnie,'B');
            $pdf->Ln(20);
            $pdf->MultiCell(190,10,$titre);
            $pdf->Ln(10);
            $pdf->MultiCell(190,10,$texte);
            $pdf->Ln(20);
            $pdf->Cell(190,10,$signature);
            $pdf->Ln(10);
            $pdf->Image($logo);
            $pdf->Output($chemin,'F');
        }
    }

?>