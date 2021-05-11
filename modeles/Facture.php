<?php
    /* Classe       :  Facture
     * Description  :  C'est la Facture de la commande de voitures 
     *                
     */
    class Facture {
        private $id;
        private $idClient;
        private $date;
        private $prixTotal;
        private $quantite;
        private $idStatut;
        private $idExpedition;
        private $idModePaiement;
        private $noAutorisation;


        public function __construct($id = 0, $idClient = 0, $date = 0, $prixTotal = 0, 
                                    $idStatut = 0, $idExpedition = 0,
                                    $idModePaiement = 0, $noAutorisation = "") {
            $this->id = $id;
            $this->idClient = $idClient;
            $this->date = $date;
            $this->prixTotal = $prixTotal;
            $this->quantite = 1;
            $this->idStatut = $idStatut;
            $this->idExpedition = $idExpedition;
            $this->idModePaiement = $idModePaiement;
            $this->noAutorisation = $noAutorisation;
        }

        public function getId() {
            return $this->id;
        }

        public function getIdClient() {
            return $this->idClient;
        }

        public function getDate() {
            return $this->date;
        }

        public function getPrixTotal() {
            return $this->prixTotal;
        }

        public function getQuantite() {
            return $this->quantite;
        }

        public function getIdStatut() {
            return $this->idStatut;
        }

        public function getIdExpedition() {
            return $this->idExpedition;
        }

        public function getIdModePaiement() {
            return $this->idModePaiement;
        }

        public function getNoAutorisation() {
            return $this->noAutorisation;
        }
    }
?>