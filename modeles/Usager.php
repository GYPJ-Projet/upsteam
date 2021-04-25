<?php

    /* Classe       : Usager
     * Description  : Permet aux usager normal, employe et administrateur d'exister dans la BD
     *                le champ idRole est à 0 (zéro) pour un usager normal
     *                et ce champ est à 1 (un) lorsque cet usager est administrateur du site.
     */
    class Usager
    {
        private $id;
        private $nomUsager;
        private $motDePasse;
        private $nom;
        private $prenom;
        private $dateNaissance;
        private $adresse;
        private $codePostal;
        private $ville;
        private $telephone;
        private $telephoneCellulaire;
        private $courriel;
        private $idLangue;
        private $idRole;
        private $disponibilite;
        private $nomLangue;

        public function  __construct(
                                    $id = 0, $nomUsager = "", $motDePasse = "",
                                    $nom = "", $prenom = "", $dateNaissance = 0, 
                                    $adresse  = "", $codePostal = "", $ville = "", 
                                    $telephone = "", $telephoneCellulaire = "", $courriel = "",
                                    $idLangue = 0, $idRole = 0, $disponibilite = 1, $nomLangue = "")
        {
            $this->id = $id;
            $this->nomUsager = $nomUsager;
            $this->motDePasse = $motDePasse;
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
            $this->idRole = $idRole;
            $this->disponibilite = $disponibilite;
            $this->nomLangue = $nomLangue;
            
        }


        public function getId()
        {
            return $this->id;
        }

        public function getNomUsager()
        {
            return $this->nomUsager;
        }

        public function getMotDePasse()
        {
            return $this->motDePasse;
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

        public function getIdRole()
        {
            return $this->idRole;
        }

        public function getDisponibilite() {
            return $this->disponibilite;
        }

        public function getNomLangue() {
            return $this->nomLangue;
        }
    }

?>