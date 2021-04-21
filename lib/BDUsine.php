<?php

	class BDUsine
	{
		// Permet d'ouvrire un connexion PDO avec la BD selon le type demandé
		public static function getBD($typeBD, $nomBD, $hote, $nomUsager, $mdp)
		{
			if($typeBD == "mysql")
			{
				$laBD = new PDO("mysql:host=$hote;dbname=$nomBD", $nomUsager, $mdp);
			}
			else if($typeBD == "oracle")
			{
				$laBD = new PDO("oci:host=$hote;dbname=$nomBD", $nomUsager, $mdp);		
			}
			else
				trigger_error("Le type de BD spécifié n'est pas supporté.");
			//else if...
			
			$laBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$laBD->exec("SET NAMES 'utf8'");
			return $laBD;			
		}
	}
?>

