<?php
    /* Classe       :  Voiture
     * Description  :  C'est la Voiture 
     *                
     */
    class Voiture {
        private $id;
        private $idModele;
        private $idAnnee;
        private $kilometrage;
        private $dateArrivee;
        private $prixAchat;
        private $prixVente;
        private $idMotopropulseur;
        private $idTypeCarburant;
        private $idCouleur;
        private $idTransmission;
        private $idTypeCarrosserie;
        private $disponibilite;
        private $vna;
        

        public function __construct($id = 0, $idModele = 0, $idAnnee = 0, $kilometrage = 0, 
                                    $dateArrivee = 0, $prixAchat = 0, 
                                    $prixVente = 0, $idMotopropulseur = 0, $idTypeCarburant = 0,
                                    $idCouleur = 0, $idTransmission = 0, $idTypeCarrosserie = 0, 
                                    $disponibilite = 1, $vna = "") {

            $this->id = $id;
            $this->idModele = $idModele;
            $this->idAnnee = $idAnnee;
            $this->kilometrage = $kilometrage;
            $this->dateArrivee = $dateArrivee;
            $this->prixAchat = $prixAchat;
            $this->prixVente = $prixVente;
            $this->idMotopropulseur = $idMotopropulseur;
            $this->idTypeCarburant = $idTypeCarburant;
            $this->idCouleur = $idCouleur;
            $this->idTransmission = $idTransmission;
            $this->idTypeCarrosserie = $idTypeCarrosserie;
            $this->disponibilite = $disponibilite;
            $this->vna = $vna;
        }

        public function getId() {
            return $this->id;
        }

        public function getIdModele() {
            return $this->idModele;
        }

        public function getIdAnnee() {
            return $this->idAnnee;
        }

        public function getKilometrage() {
            return $this->kilometrage;
        }

        public function getDateArrivee() {
            return $this->dateArrivee;
        }

        public function getPrixAchat() {
            return $this->prixAchat;
        }

        public function getPrixVente() {
            return $this->prixVente;
        }

        public function getIdMotopropulseur() {
            return $this->idMotopropulseur;
        }

        public function getIdTypeCarburant() {
            return $this->idTypeCarburant;
        }

        public function getIdTransmission() {
            return $this->idTransmission;
        }

        public function getIdCouleur() {
            return $this->idCouleur;
        }

        public function getIdTypeCarrosserie() {
            return $this->idTypeCarrosserie;
        }

        public function getDisponibilite() {
            return $this->disponibilite;
        }

        public function getVna() {
            return $this->vna;
        }



    }
?>