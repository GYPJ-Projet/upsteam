<?php

    /* Classe       : TabLangue
     * Description  : C'est une table qui contient les traductions du produit dans les 
     *                différentes langues supportées.
     * Exemple      : Les tables de langues sont :  typeCarburant, couleur, transmission, etc
     */
    class TabLangue
    {
        private $id;
        private $idLangue;
        private $nom;

        public function  __construct($id = 0, $idLangue = 0, $nom = "")
        {
            $this->id = $id;
            $this->idLangue = $idLangue;
            $this->nom = $nom;
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
    }

?>