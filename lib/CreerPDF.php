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
        public static function creationPDF($nomFichier, $titre, $texte, $destination) {
            require 'lib/fpdf.php';

            $chemin = 'pdf/' . $nomFichier . '.pdf';
            $logo = 'logo/logo_v2.jpg';
            
            $nomCompagnie = "Véhicules d'occasion";
            $nomCompagnie = utf8_decode($nomCompagnie);
            $adresseL1Compagnie =  utf8_decode("6220 Sherbrooke E");
            $adresseL2Compagnie =  utf8_decode("Montréal, Qc");
            $adresseL3Compagnie =  utf8_decode("H1N 1C1");
            $signature =  "L'équipe de Voiture d'occasion.";
            $signature = utf8_decode($signature);

            
            $titre = utf8_decode($titre);
            $texte = utf8_decode($texte);


            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(190,10,$nomCompagnie,'B');
            $pdf->Ln(10);
            $pdf->Cell(190,10,$adresseL1Compagnie);
            $pdf->Ln(10);
            $pdf->Cell(190,10,$adresseL2Compagnie);
            $pdf->Ln(10);
            $pdf->Cell(190,10,$adresseL3Compagnie);
            $pdf->Ln(20);
            $pdf->MultiCell(190,10,$titre);
            $pdf->Ln(10);
            $pdf->MultiCell(190,10,$texte);
            $pdf->Ln(20);
            $pdf->Cell(190,10,$signature);
            $pdf->Ln(10);
            $pdf->Image($logo);
            $pdf->Output($chemin,$destination);
        }



        static function creationRecuPDF($nomFichier, 
                                        $titre, 
                                        $lePanier, 
                                        $date, 
                                        $laTaxeFederale, 
                                        $laTaxeProvinciale, 
                                        $destination) {

            require 'lib/fpdf.php';

            $chemin = 'pdf/' . $nomFichier . '.pdf';
            $logo = 'logo/logo_v2.jpg';

            // on converti le JSON reçu en array
            $tabPanier = json_decode($lePanier, true);

            $sousTotal              = 0.00;
            $totalTaxeFederale      = 0.00;
            $totalTaxeProvinciale   = 0.00;
            $taxeFederale           = floatval($laTaxeFederale['taux']);
            $nomTaxeFederale        = $laTaxeFederale['nomTaxe'];
            if ($laTaxeProvinciale != null) {
                $taxeProvinciale     = floatval($laTaxeProvinciale['taux']);
                $nomTaxeProvinciale  = $laTaxeProvinciale['nomTaxe'];
            } else {
                $taxeProvinciale = 0.00;
            }
            
            $nomCompagnie = "Véhicules d'occasion Inc";
            $adresseL1Compagnie =  "6220 Sherbrooke E";
            $adresseL2Compagnie =  "Montréal, Qc";
            $adresseL3Compagnie =  "H1N 1C1";
            $signature =  "L'équipe de Voiture d'occasion.";
           

            
            $nomCompagnie       = utf8_decode($nomCompagnie);
            $adresseL1Compagnie = utf8_decode($adresseL1Compagnie);
            $adresseL2Compagnie = utf8_decode($adresseL2Compagnie);
            $adresseL3Compagnie = utf8_decode($adresseL3Compagnie);
            $titre              = utf8_decode($titre);
            $signature          = utf8_decode($signature);

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Ln(3); 
            $pdf->Image($logo);
            $pdf->Cell(190,10,$nomCompagnie,'B',1,'C',false);
            $pdf->Cell(190,10,$adresseL1Compagnie,0,1,'C',false);
            $pdf->Cell(190,10,$adresseL2Compagnie,0,1,'C',false);
            $pdf->Cell(190,10,$adresseL3Compagnie,'B',1,'C',false);
            $pdf->Ln(8);
            $pdf->Cell(190,10,$titre,0,1,'C',false);
            $pdf->Ln(5); 
            $width_cell=array(130,60);
            foreach ($tabPanier as $panier) {
                if ($panier != null) {
                    $pdf->Cell($width_cell[0],10,$panier["marque"] . ' '. $panier["modele"] . ' '.$panier["annee"]  ,0,0,'L',false);
                    $pdf->Cell($width_cell[1],10,number_format($panier["prix"], 2, '.', '') . ' $',0,1,'R',false);
                    $sousTotal += round(floatval($panier["prix"]),2);
                }
            }
            $pdf->Ln(5);
            //Sous-total 
          /*   $sousTotal = floatval(round($sousTotal,2)); */
            $sousTotal = floatval($sousTotal * 1.00);
            $pdf->Cell($width_cell[0],10,'Total des articles','T',0,'R',false);
            $pdf->Cell($width_cell[1],10, number_format($sousTotal, 2, '.', '') . ' $','T',1,'R',false);

            
            // Les taxes  
            $totalTaxeFederale      =  round(($sousTotal * $taxeFederale), 2);
            $totalTaxeProvinciale   =  round(($sousTotal * $taxeProvinciale), 2);

            // Le calcul du total de la facture;
            $total  = floatval($sousTotal) + floatval($totalTaxeFederale)  + floatval($totalTaxeProvinciale);
            // La taxe fédérale 
            $pdf->Cell($width_cell[0],10, 'Plus ' . $nomTaxeFederale,0,0,'R',false);
            $pdf->Cell($width_cell[1],10 , number_format($totalTaxeFederale, 2, '.', '')  . ' $',0,1,'R',false);

            // La taxe provinciale si elle existe dans cette province 
            if ($laTaxeProvinciale != null) {
                $pdf->Cell($width_cell[0],10,'Plus ' . $nomTaxeProvinciale,0,0,'R',false);
                $pdf->Cell($width_cell[1],10 , number_format($totalTaxeProvinciale, 2, '.', '') . ' $',0,1,'R',false);
            }

            // La total avec les taxes
            $pdf->Cell($width_cell[0],10, 'Montant total de la commande',0,0,'R',false);
            $pdf->Cell($width_cell[1],10 , number_format($total, 2, '.', '') . ' $','T',1,'R',false);
            $pdf->Ln(10);
            $pdf->Cell(190,10,'# autorisation : ' . $nomFichier,0,1,'C',false);
            $pdf->Cell(190,10,'Date  : ' . $date,0,1,'C',false);
            $pdf->Ln(10);
            $pdf->Cell(190,10,$signature,0,1,'C',false);
 /*            $pdf->Ln(10); */
           /*  $width_cell=array(95,95);
            $pdf->Cell($width_cell[0],10,'',0,0,'C',false);
            $pdf->Cell($width_cell[1],10,$signature,0,1,'C',false);
            $pdf->Cell($width_cell[0],5,$pdf->Image($logo),0,0,'C',false);
            $pdf->Cell($width_cell[1],5,'',0,1,'C',false); */

            $pdf->Output($chemin,$destination);
        }
    }

?>