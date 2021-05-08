<?php

    /* Classe       : Province
     * Description  : Permet de gerer des modeles de province
     */
    class Province
    {
        private $id;
        private $idLangue;
        private $nom;
        private $idPays;

        public function  __construct($id = 0, $idLangue = "", $nom = 0, $idPays = 1)
        {
            $this->id = $id;
            $this->idLangue = $idLangue;
            $this->nom = $nom;
            $this->idPays = $idPays;     
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

        public function getIdPays() 
        {
            return $this->idPays;
        }
    }

?>