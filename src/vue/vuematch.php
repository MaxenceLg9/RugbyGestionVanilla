<?php include_once "../components/nav.php" ?>
<div class="main">
    <article>
        <script src="../resources/js/fdm.js"></script>
        <div class="container">
            <h1>Select Players for the Match</h1>
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
                    <div class="player-card" draggable="true" data-id="1">
                        <img src="<?= $url?>" alt="Profile picture of <?=$joueur->getNom() . " " . $joueur->getPrenom()?>" width="80" height="80">
                        <p><?=$joueur->getNom() . " " . $joueur->getPrenom()?></p>
                    </div>
                <?php }
                else {
                    echo "<p>Vous n'avez aucun joueur actif</p>";
                }?>

                <!-- Add more players dynamically -->
            </div>
            <div class="field" id="field">
                <!-- Position slots -->
                <?php for($i = 1; $i <= 15; $i++){?>
                    <div class="position-slot slot-<?=$i?>" ondrop="drop()" data-position="<?=$i?>"><?=$i?></div>
                <?php } ?>
            </div>
        </div>
    </article>
</div>