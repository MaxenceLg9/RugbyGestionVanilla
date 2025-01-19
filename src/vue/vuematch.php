<?php include_once "../components/nav.php";

function createPlayerCard($joueur,$iv): string
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
        <input type="hidden" name="idJoueur" value="'.htmlspecialchars(openssl_encrypt($joueur->getIdJoueur(),'aes-256-cbc',$_SESSION['csrf_token'],0,$iv)).'">
        <input type="hidden" name="premiereLigne" value="'.$joueur->isPremiereLigne().'">
    </div>';
}
?>
<div class="main">
    <header class="header-section">
        <h1>Faites votre feuille de match</h1>
    </header>
    <article>
        <div class="container">
            <aside>
                <p>Il y a <strong id="fieldNbJoueurs"></strong> joueurs sur la feuille de match</p>
                <p>Il y a <strong id="fieldNbPremieresLignes"></strong> joueurs ayant la spécificité 1ère ligne sur la feuille de match</p>

                <?php if($valider || $archive){?>
                    <p>Le match est archivé, vous ne pouvez plus le modifier</p>
                <?php } else {?>

                    <div class="players-container" id="players">
                        <!-- Example Player Cards -->

                        <?php
                        if($joueursNP) {
                            foreach ($joueursNP as $joueurNP) {
                                echo createPlayerCard($joueurNP,$iv);
                            }
                        }else {
                            echo "<p>Vous n'avez aucun joueur actif</p>";
                        }?>
                    </div>
                <?php } ?>
                <div>
            </aside>
            <form action="/gererfdm.php" method="post" class="form">
                <div class="field" id="field">
                    <!-- Position slots -->
                    <?php
                    $nbJoueurs = 0;
                    $nbPremieresLignes = 0;
                    for($i = 1; $i <= 23; $i++){
                        $value = ""?>
                        <div class="position-slot slot-<?=$i?>" data-position="<?=$i?>">
                            <?php
                            $key = "position-" . htmlspecialchars(openssl_encrypt($i, 'aes-256-cbc',$_SESSION["csrf_token"],0,$iv));
                            if(array_key_exists($i,$jouerLeMatch)) {
                                $nbJoueurs++;
                                if($jouerLeMatch[$i]->getJoueur()->isPremiereLigne()){
                                    $nbPremieresLignes++;
                                }
                                echo createPlayerCard($jouerLeMatch[$i]->getJoueur(),$iv);

                                $value = htmlspecialchars(openssl_encrypt($jouerLeMatch[$i]->getJoueur()->getIdJoueur(),'aes-256-cbc',$_SESSION["csrf_token"],0,$iv));
                            }
                            ?>
                        </div>
                        <input type="hidden" name="<?=$key?>" value="<?= $value?>" >
                    <?php } ?>
                </div>
                <input name="nbJoueurs" type="hidden" value="" id="inputNbJoueurs">
                <input name="nbPremieresLignes" type="hidden" value="" id="inputNbPremieresLignes">

                <?php if($archive){ ?>
                    <p>Le match est archivé, vous ne pouvez plus le modifier</p>
                    <p>Résultat : <?=$match->getResultat()->name?></p>
                    <a class="button saisie" href="/gererfdm.php?type=notes&idMatch=<?=$match->getIdMatch()?>&csrf_token=<?=htmlspecialchars(password_hash($match->getIdMatch().$_SESSION["csrf_token"]."notes",PASSWORD_BCRYPT))?>">
                        <p>Saisir les notes</p>
                    </a>
                <?php } else { ?>
                    <input type="hidden" name="type" value="ajout">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(hash_hmac("sha256",$match->getIdMatch() . $_SESSION['csrf_token'] . "ajout", $csrf_token)) ?>">
                    <input type="hidden" name="idMatch" value="<?=$_GET["idMatch"]?>">
                    <?php if($valider){ ?>
                        <div class="row">
                            <p>Feuille de match validée, vous pouvez dès à présent finaliser le match en saisissant le score</p>
                            <label for="resultat">Score</label>
                            <select id="resultat" name="resultat" required>
                                <?php foreach (Resultat::cases() as $resultat) { ?>
                                    <option value="<?= $resultat->name ?>">
                                        <?= htmlspecialchars($resultat->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="fdm" value="0">
                        <input type="submit" name="submit" class="button saisie" value="Saisir le score" id="btnScore">
                    <?php } else { ?>
                        <input type="hidden" name="idMatch" value="<?=$match->getIdMatch()?>">
                        <input type="hidden" name="fdm" value="1">
                        <input type="submit" name="submit" class="button saisie" value="ajouter">
                        <input type="submit" name="submit" class="button modify" value="valider" id="buttonValider">
                        <?php
                    }
                }
                ?>
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