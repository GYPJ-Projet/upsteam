
    
    <section class="pageDonnees contenueConteneur">
    <?php 
        $langue = $donnees["langue"];
        $pageCourante = $donnees["pageCourante"];
        $nbPages = $donnees["nbPages"];
        $tri = $donnees["tri"];
        $ordre = $donnees["ordre"];
    ?>
            <h1><?= $langue["gestion_usager"] ?></h1>


        <div class='contenueConteneur' data-js-component="GestionUsager" data-js-controleur="Usager" data-js-controleur-action="gestionUsager">

            <!-- <a class="bouton" href="index.php?Usager&action=afficherFormulaireUsager&page=<?= $pageCourante ?>" data-js-ajouter><?= $langue["button_ajouter"] ?></a>     -->
            <a class="bouton" href="index.php?Usager&action=afficherFormulaireUsager&retour=gestionUsager" data-js-ajouter><?= $langue["button_ajouter"] ?></a>    
            <div class="defilement">
            <table class="table ">
                <thead>
                    <tr>
                        <th>
                            <span>ID</span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'id' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="id" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'id' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="id" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["nom_usager"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nom' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nom" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nom' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nom" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["prenom_usager"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'prenom' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prenom" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'prenom' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="prenom" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["courriel"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'courriel' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="courriel" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'courriel' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="courriel" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["dateNaissance"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'dateNaissance' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="dateNaissance" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'dateNaissance' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="dateNaissance" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["adresse"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'adresse' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="adresse" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'adresse' && $ordre == "DESC")? "inactif" : "" ?>'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="adresse" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["ville"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'ville' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="ville" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'ville' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="ville" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["province"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nomProvince' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomProvince" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nomProvince' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomProvince" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["codePostal"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'codePostal' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="codePostal" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'codePostal' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="codePostal" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["telephone"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'telephone' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="telephone" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'telephone' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="telephone" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["cellulaire"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'telephoneCellulaire' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="telephoneCellulaire" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'telephoneCellulaire' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="telephoneCellulaire" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["langue"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nomLangue' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomLangue" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nomLangue' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomLangue" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th>
                            <span><?= $langue["role"] ?></span>
                            <div class="sourisPointer symboleTri">
                                <svg class='<?= ($tri == 'nomRole' && $ordre == "ASC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomRole" data-js-ordre="ASC"><path d="M10 132.5h980l-489.9 735L10 132.5z"/></svg>
                                <svg class='<?= ($tri == 'nomRole' && $ordre == "DESC")? "inactif" : "" ?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" version="1.1" fill="#333333" width="1vw" height="1vw" data-js-tri="nomRole" data-js-ordre="DESC"><path d="M10 881.1h980L500 118.9 10 881.1z"/></svg>
                            </div>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php
                foreach ($donnees["usager"] as $usager) {
            ?>
                    <tr>
                        <td><?= $usager["id"] ?></td>
                        <td><?= $usager["nom"] ?></td>
                        <td><?= $usager["prenom"] ?></td>
                        <td><?= $usager["courriel"] ?></td>
                        <td><?= $usager["dateNaissance"] ?></td>
                        <td><?= $usager["adresse"] ?></td>
                        <td><?= $usager["ville"] ?></td>
                        <td><?= $usager["nomProvince"] ?></td>
                        <td><?= $usager["codePostal"] ?></td>
                        <td><?= $usager["telephone"] ?></td>
                        <td><?= $usager["telephoneCellulaire"] ?></td>
                        <td><?= $usager["nomLangue"] ?></td>
                        <td><?= $usager["nomRole"] ?></td>
                        <td><a href="index.php?Usager&action=afficherFormulaireUsager&id=<?= $usager["id"] ?>&page=<?= $pageCourante ?>&retour=gestionUsager&modif" data-js-modifier data-js-id=<?= $usager["id"] ?>><?= $langue["button_modifier"] ?></a></td>
                    </tr>                 
            <?php
                }
            ?>
                </tbody>
            </table>

            </div>
            <div class="pagination" data-js-pagination>
    <?php
                if($pageCourante > 1) echo '<p data-js-page="'. ($pageCourante - 1) .'" class="fleche"><<</p>'; 
                for ($j = 1; $j <= $nbPages; $j++) {
                    if ($j == $pageCourante) {
                        echo '<p class="page-active" data-js-pageActive="'.$j.'">Page '.$j.'</p>';
                    } 
                }
                if($pageCourante < $nbPages) echo '<p data-js-page="'. ($pageCourante + 1) .'" class="fleche">>></p>';
    ?>
            </div>
        </div>
    </section>

