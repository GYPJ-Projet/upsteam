<?php
    /* Classe       : ListeAchat
     * Description  : Permet de gerer la liste de commande pour une facture (ListeAchat)
     */
    class ListeAchat
    {
        private $idCommande;
        private $idVoiture;
        private $prixVenteFinal;

        public function  __construct($idCommande = 0, $idVoiture = 0, $prixVenteFinal = 0)
        {
            $this->idCommande = $idCommande;
            $this->idVoiture = $idVoiture;
            $this->prixVenteFinal = $prixVenteFinal;
        }

        public function getIdCommande()
        {
            return $this->idCommande;
        }

        public function getIdVoiture()
        {
            return $this->idVoiture;
        }

        public function getPrixVenteFinal()
        {
            return $this->prixVenteFinal;
        }
    }

?>