<?php

    /* Classe       : Couleur
     * Description  : Permet de gerer des marques de couleur
     */
    class Couleur
    {
        private $id;
        private $idLangue;
        private $nom;
        private $disponibilite;

        public function  __construct($id = 0, $idLangue = 0, $nom = "", $disponibilite = 1)
        {
            $this->id = $id;
            $this->idLangue = $idLangue;
            $this->nom = $nom;
            $this->disponibilite = $disponibilite;     
        }

        public function getId()
        {
            return $this->id;
        }

        public function getIdLangue()
        {
            return $this->idLangue;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getDisponibilite() 
        {
            return $this->disponibilite;
        }
    }

?>