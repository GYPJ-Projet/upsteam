<?php
    /* Classe       :  Client
     * Description  :  C'est un client
     *                
     */
    class Client {
        private $id;
        private $nom;
        private $prenom;
        private $dateNaissance;
        private $adresse;
        private $codePostal;
        private $ville;
        private $telephone;
        private $telephoneCellulaire;
        private $courriel;
        private $idUsager;
        private $idLangue;

        public function __construct($id = 0, $nom = "", $prenom = "", $dateNaissance = 0, 
                                    $adresse  = "", $codePostal = "", $ville = "", 
                                    $telephone = "", $telephoneCellulaire = "", $courriel = "",
                                    $idUsager = 0, $idLangue = 0) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->dateNaissance = $dateNaissance;
            $this->adresse = $adresse;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->telephone = $telephone;
            $this->telephoneCellulaire = $telephoneCellulaire;
            $this->courriel = $courriel;
            $this->idUsager = $idUsager;
            $this->idLangue = $idLangue;
        }

        public function getId() {
            return $this->id;
        }

        public function getNom() {
            return $this->nom;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function getDateNaissance() {
            return $this->kilometrage;
        }
 
        public function getAdresse() {
            return $this->adresse;
        }

        public function getCodePostal() {
            return $this->codePostal;
        }

        public function getVille() {
            return $this->ville;
        }

        public function getTelephone() {
            return $this->telephone;
        }

        public function getTelephoneCellulaire() {
            return $this->telephoneCellulaire;
        }

        public function getCourriel() {
            return $this->courriel;
        }

        public function getIdUsager() {
            return $this->idUsager;
        }

        public function getIdLangue() {
            return $this->idLangue;
        }
    }
?>