    <?php 
        $langue = $donnees["langue"];       //Pour affichage des langues
    ?>
    
    <footer>
        <section class="pied_de_page">
            <section class="footer__adresse">
                <h3>
                <?= $langue['pdp_information'] ?>
                </h3>
                <a href="index.php?Voiture&action=apropos"><?= $langue['pdp_propos'] ?></a><br>
                <a href="index.php?Voiture&action=contact"><?= $langue['pdp_contact'] ?></a><br>
                <a href="index.php?Voiture&action=termes"><?= $langue['pdp_termes'] ?></a><br>
            </section>
            <section class="footer__heures">
                <h3>
                    <?= $langue['pdp_heures'] ?>
                </h3>
                <p><?= $langue['pdp_lundi'] ?> - <?= $langue['pdp_vendredi'] ?>    : 8h - 18h</p>
                <p><?= $langue['pdp_samedi'] ?>              : 8h - 16h</p>
                <p><?= $langue['pdp_dimanche'] ?>           : 9h - 16h</p>
            </section>               
            <section class="footer__partage">
                <h3>
                    <?= $langue['pdp_partager'] ?>
                </h3>
                <div class="footer__icones">
                    <a href="https://www.facebook.com/"><img src="images/icones/facebook" alt="facebook" width="25px" height="16px">Facebook</a>
                    <a href="https://twitter.com/"><img src="images/icones/twiter.png" alt="twiter" width="25px" height="16px">Twiter</a>
                    <a href="https://www.instagram.com/"><img src="images/icones/instagram.png" alt="instagram" width="25px"height="16px">Instagram</a>
                </div>              
            </section>   
        </section>      
    </footer>
</div>
</html>