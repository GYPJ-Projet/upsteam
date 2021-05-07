<?php
	class Controleur_Erreur404 extends BaseControleur {

		// Méthode qui retourne le nom du contrôleur où aller chercher la langue 
		public function getNomControleur() {
			return "Erreur404";
		}

		// La fonction qui sera appelée par le routeur
		public function traite(array $params) {
			
			// Initialisation des donnees a un tableau vide par défaut
			$donnees = array();
			
			// On charge les fichiers de langue selon la langue choisi par l'usager.
			$donnees["langue"] = $this->chargerLangue($params);

			$idLangue = $donnees["langue"]["idLangue"]; // On récupère l'ID de la langue

			$this->afficheVue("tete");
			$this->afficheVue("entete", $donnees);
            $this->afficheVue("menu", $donnees);

			$this->afficheVue("afficherErreur404", $donnees);
			
			$this->afficheVue("piedDePage", $donnees);
		}
	}
?>