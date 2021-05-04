<?php

    /* Classe       : Usager
     * Description  : Permet aux usager normal, employe et administrateur d'exister dans la BD
     *                le champ idRole est à 0 (zéro) pour un usager normal
     *                et ce champ est à 1 (un) lorsque cet usager est administrateur du site.
     */
    class Usager
    {
        private $id;
        private $courriel;
        private $motPasse;
        private $nom;
        private $prenom;
        private $dateNaissance;
        private $adresse;
        private $codePostal;
        private $ville;
        private $idProvince;
        private $telephone;
        private $telephoneCellulaire;
        private $idLangue;
        private $idRole;
        private $token;
        private $code;

        public function  __construct(
                                    $id = 0, $motPasse = "", $courriel = "",
                                    $nom = "", $prenom = "", $dateNaissance = 0, 
                                    $adresse  = "", $codePostal = "", $ville = "", 
                                    $telephone = "", $telephoneCellulaire = "",
                                    $idLangue = 0, $idRole = 0, $idProvince ="",
                                    $token = "", $code = "")
        {
            $this->id = $id;
            $this->courriel = $courriel;
            $this->motPasse = $motPasse;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->dateNaissance = $dateNaissance;
            $this->adresse = $adresse;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->idProvince = $idProvince;
            $this->telephone = $telephone;
            $this->telephoneCellulaire = $telephoneCellulaire;
            $this->idLangue = $idLangue;
            $this->idRole = $idRole;
            $this->token = $token;
            $this->code = $code;
            
        }


        public function getId()
        {
            return $this->id;
        }

        public function getCourriel() {
            return $this->courriel;
        }

        public function getMotPasse()
        {
            return $this->motPasse;
        }
        public function getNom() {
            return $this->nom;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function getDateNaissance() {
            return $this->dateNaissance;
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

        public function getIdProvince() {
            return $this->idProvince;
        }

        public function getTelephone() {
            return $this->telephone;
        }

        public function getTelephoneCellulaire() {
            return $this->telephoneCellulaire;
        }

        public function getIdLangue() {
            return $this->idLangue;
        }

        public function getIdRole()
        {
            return $this->idRole;
        }

        public function getToken() {
            return $this->token;
        }

        public function getCode() {
            return $this->code;
        }
    }
?>