<?php

    /* Classe       : Taxe
     * Description  : Permet de gerer des modeles de taxe
     */
    class Taxe
    {
        public $idTaxe;
        public $nomTaxe;
        public $taux;
        public $disponibilite;
        public $idProvince;
        public $nomProvince;

        public function  __construct($idTaxe = 0, $nomTaxe = "", $taux = 0, $disponibilite = 1, $idProvince = 0, $nomProvince = 0)
        {
            $this->idTaxe = $idTaxe;
            $this->nomTaxe = $nomTaxe;
            $this->taux = $taux;
            $this->disponibilite = $disponibilite;     
            $this->idProvince = $idProvince;
            $this->nomProvince = $nomProvince;
        }

        public function getIdTaxe()
        {
            return $this->idTaxe;
        }

        public function getNomTaxe()
        {
            return $this->nomTaxe;
        }

        public function getTaux()
        {
            return $this->taux;
        }

        public function getDisponibilite() 
        {
            return $this->disponibilite;
        }

        public function getIdProvince()
        {
            return $this->idProvince;
        }

        public function getNomProvince()
        {
            return $this->nomProvince;
        }
    }

?>