<?php include_once "../components/nav.php" ?>
<div class="main">
    <article>

        <h1>Select Players for the Match</h1>
        <div class="container">

            <div class="players-container" id="players">
                <!-- Example Player Cards -->

                <?php
                if($joueurs)
                    foreach ($joueurs as $joueur){
                        if($joueur->getUrl() == ""){
                            $url = "../resources/img/data/default.png";
                        }else{
                            $url = $joueur->getUrl();
                        }?>
                        <div class="player-card <?= $joueur->isPremiereLigne() ? "premiere-ligne": ""?> " draggable="true" data-id="1">
                            <img src="<?= $url?>" alt="Profile picture of <?=$joueur->getNom() . " " . $joueur->getPrenom()?>" width="40" height="40">
                            <p><?=$joueur->getNom() . " " . $joueur->getPrenom()?></p>
                            <input type="hidden" name="id" value="<?=$joueur->getIdJoueur()?>">
                            <input type="hidden" name="premiereLigne" value="<?=$joueur->isPremiereLigne()?>">
                        </div>
                    <?php }
                else {
                    echo "<p>Vous n'avez aucun joueur actif</p>";
                }?>
            </div>
            <div>
                <p id="fieldNbJoueurs"></p>
                <p id="fieldNbPremieresLignes"></p>
                <form action="gererfdm.php" method="post" class="form">
                    <div class="field" id="field">
                        <!-- Position slots -->
                        <?php for($i = 1; $i <= 23; $i++){?>
                            <div class="position-slot slot-<?=$i?>" ondrop="drop()" data-position="<?=$i?>"></div>
                            <input type="hidden" name="position<?=$i?>" value="">
                        <?php } ?>
                    </div>
                    <input type="hidden" name="type" value="ajout">
                    <input type="hidden" name="csrf_token" value="<?=$_GET["csrf_token"]?>">
                    <input type="hidden" name="idMatch" value="<?=$_GET["idMatch"]?>">
                    <input type="submit" name="submit" class="button saisie" value="Submit">
                </form>
            </div>
        </div>
    </article>
</div>
<script src="../resources/js/fdm.js"></script>