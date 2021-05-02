<?php

    /* Classe       : Motopropulseur
     * Description  : Permet de gerer des motopropulseur de vehicules
     */
    class Motopropulseur
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