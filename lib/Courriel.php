<?php

    /* Classe       : Courriel
     * Description  : Permet d'envoyer des courriels.
     *
     * PH
     * On doit fournir
     * Le courriel du destinataire
     * Le sujet du courriel
     * Le contenue du courriel.
     */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Courriel
    {
        public static function envoieCourriel($langue,$adrCourriel, $sujet, $message, $fichier=''){
            require 'lib/PHPMailer.php';
            require 'lib/SMTP.php';
            require 'lib/Exception.php';

            $signature = $langue['signature'];
            $signature = utf8_decode($signature);

            // $logo = '../logo/logo_v2.jpg';
            $message .= '<br><br><p>' . $signature . '</p><br>';
            $message = utf8_decode($message);
            // $message .='<img src="logo/logo.jpg" alt="logo">';

            //paramètres de connexion et envoie
            $courriel = new PHPMailer();
            $courriel->isSMTP();
            $courriel->Host = "smtp.gmail.com";
            $courriel->SMTPAuth = "true";
            $courriel->SMTPSecure = "tls";
            $courriel->Port = "587";
            $courriel->Username = "gypj.projet@gmail.com";
            $courriel->Password = 'VLLMcRi3R4EGta2IGZyvIp87gEB5';
            $courriel->Subject = $sujet;
            $courriel->setFrom('gypj.projet@gmail.com');
            $courriel->isHTML(true);
            $courriel->addAttachment($fichier);
            $courriel->Body = $message;
            $courriel->addAddress($adrCourriel);
            $courriel->send();
            $courriel->smtpClose();
        }
    }

?>