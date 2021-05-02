<?php

    /* Classe       : Annee
     * Description  : Permet de gerer des annees de vehicules
     */
    class Annee
    {
        private $id;
        private $annee;

        public function  __construct($id = 0, $annee = "")
        {
            $this->id = $id;
            $this->annee = $annee;   
        }

        public function getId()
        {
            return $this->id;
        }

        public function getAnnee()
        {
            return $this->annee;
        }

    }

?>