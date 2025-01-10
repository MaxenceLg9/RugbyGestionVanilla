<?php include_once "../components/nav.php";
function createPlayerCard($joueur): string
{
    if($joueur->getUrl() == ""){
        $url = "../resources/img/data/default.png";
    }else{
        $url = $joueur->getUrl();
    }
    $class = $joueur->isPremiereLigne() ? 'premiere-ligne': '';
    return '<div class="player-card '.$class.'" data-id="1">
        <img src="' .$url.'" alt="Profile picture of '.$joueur->getNom() . " " . $joueur->getPrenom().'" width="40" height="40">
        <p>'.$joueur->getNom() . ' ' . $joueur->getPrenom().'</p>
        <input type="hidden" name="id" value="'.$joueur->getIdJoueur().'">
        <input type="hidden" name="premiereLigne" value="'.$joueur->isPremiereLigne().'">
    </div>';
}
?>
<div class="main">
    <article>

        <h1>Select Players for the Match</h1>
        <div class="container">
            <aside>
                <p id="">Il y a <strong id="fieldNbJoueurs"></strong> joueurs sur la feuille de match</p>
                <p id="">Il y a <strong id="fieldNbPremieresLignes"></strong> joueurs ayant la spécificité 1ère ligne sur la feuille de match</p>

                <?php if($valider || $archive){?>
                    <p>Le match est archivé, vous ne pouvez plus le modifier</p>
                <?php } else {?>

                    <div class="players-container" id="players">
                        <!-- Example Player Cards -->

                        <?php
                        if($joueursNP) {
                            foreach ($joueursNP as $joueurNP) {
                                echo createPlayerCard($joueurNP);
                            }
                        }else {
                            echo "<p>Vous n'avez aucun joueur actif</p>";
                        }?>
                    </div>
                <?php } ?>
                <div>
            </aside>
            <form action="gererfdm.php" method="post" class="form">
                <div class="field" id="field">
                    <!-- Position slots -->
                    <?php
                    $nbJoueurs = 0;
                    $nbPremieresLignes = 0;
                    for($i = 1; $i <= 23; $i++){
                        $value = ""?>
                        <div class="position-slot slot-<?=$i?>" data-position="<?=$i?>"><?php if(array_key_exists($i,$jouerLeMatch)) {
                                $nbJoueurs++;
                                if($jouerLeMatch[$i]->getJoueur()->isPremiereLigne()){
                                    $nbPremieresLignes++;
                                }
                                echo createPlayerCard($jouerLeMatch[$i]->getJoueur());
                                $value = $jouerLeMatch[$i]->getJoueur()->getIdJoueur();
                            } ?></div>
                        <input type="hidden" name="position-<?=$i?>" value="<?= $value?>">
                    <?php } ?>
                </div>
                <input name="nbJoueurs" type="hidden" value="" id="inputNbJoueurs">
                <input name="nbPremieresLignes" type="hidden" value="" id="inputNbPremieresLignes">
                <input type="hidden" name="type" value="ajout">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($_GET["idMatch"] . $_SESSION['csrf_token'] . "ajout", PASSWORD_BCRYPT)) ?>">
                <input type="hidden" name="idMatch" value="<?=$_GET["idMatch"]?>">
                <?php if($valider || $archive){ ?>
                    <p>Match validé, vous pouvez saisir le score</p>
                    <input type="submit" name="submit" class="button saisie" value="Saisir le score" id="btnScore">
                <?php } else {?>
                    <input type="hidden" name="idMatch" value="<?=$_GET["idMatch"]?>">
                    <input type="submit" name="submit" class="button saisie" value="ajouter">
                    <input type="submit" name="submit" class="button modify" value="valider" id="buttonValider">
                <?php } ?>
            </form>
        </div>
    </article>
</div>
<script>
    let nbJoueurs = <?php echo $nbJoueurs ?>;
    let nbPremieresLignes = <?php echo $nbPremieresLignes ?>;
    let archiveMatch = <?php echo $archive || $valider ? 1 : 0?>;
</script>
<script src="../resources/js/fdm.js"></script>