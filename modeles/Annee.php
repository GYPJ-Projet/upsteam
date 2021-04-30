<?php

    /* Classe       : Annee
     * Description  : Permet de gerer des annees de vehicules
     */
    class Annee
    {
        private $id;
        private $nom;

        public function  __construct($id = 0, $nom = "")
        {
            $this->id = $id;
            $this->nom = $nom;   
        }

        public function getId()
        {
            return $this->id;
        }

        public function getNom()
        {
            return $this->nom;
        }

    }

?>