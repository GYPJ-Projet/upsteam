<?php
    class Debug{

        /**
         * PARCE QUE LES LOGS C'EST LA VIE ;)
         * Recoit 2 params. 
         * 1 obligatoire
         * 1 optionnel
         * affiche les deux à la suite dans le fichier ./logs/Debug_log.txt
         * Utilisation: Debug::toLog(param1, param2-optionnel);
         */
        public static function toLog($data, $data1 = ''){
            // Création d'un répertoire log si il n'existe pas.
            if(is_dir('./logs') === false){
                mkdir("./logs");
            }

            // Ouverture du fichier
            $log_file = fopen("logs/Debug_log.txt", "a");
            
            // Rend le contenue lisible
            $result_data = print_r($data,true);
            $result_data1 = print_r($data1,true);
            
            //Ajout des datas au fichier
            fwrite($log_file, date("d-m-Y h:i:s")."\n");
            fwrite($log_file, $result_data."\n");
            fwrite($log_file, $result_data1."\n");

            // Fermeture du fichier
            fclose($log_file);
        }
 

        public static function creation_fichier_log() {
            // Création d'un répertoire log si il n'existe pas.
            if(is_dir('./logs') === false){
                mkdir("./logs");
            }

            $log_file = fopen("logs/Debug_log.txt", 'w');
            fwrite($log_file, "");
            fclose($log_file);
        }
        
    }
?>