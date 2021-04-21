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
        private $idRole;

        public function  __construct($id = 0, $nomUsager = "", $motDePasse = "", $idRole = 0)
        {
            $this->id = $id;
            $this->nomUsager = $nomUsager;
            $this->motDePasse = $motDePasse;
            $this->idRole = $idRole;
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

        public function getIdRole()
        {
            return $this->idRole;
        }
    }

?>