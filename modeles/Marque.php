<?php

    /* Classe       : Marque
     * Description  : Permet de gerer des marques de vehicules
     */
    class Marque
    {
        private $id;
        private $nom;
        private $disponibilite;

        public function  __construct($id = 0, $nom = "", $disponibilite = 1)
        {
            $this->id = $id;
            $this->nom = $nom;
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

        public function getDisponibilite() 
        {
            return $this->disponibilite;
        }
    }

?>