<?php

    /* Classe       : Modele
     * Description  : Permet de gerer des modeles de vehicules
     */
    class Modele
    {
        private $id;
        private $nom;
        private $idMarque;
        private $disponibilite;

        public function  __construct($id = 0, $nom = "", $idMarque = 0, $disponibilite = 1)
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->idMarque = $idMarque;
            $this->disponibilite = $disponibilite;     
        }

        public function getId()
        {
            return $this->id;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getIdMarque()
        {
            return $this->idMarque;
        }

        public function getDisponibilite() 
        {
            return $this->disponibilite;
        }
    }

?>