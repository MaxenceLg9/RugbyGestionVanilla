<?php

require_once "../modele/Session.php";
checkSession();

require_once "../modele/JouerUnMatch.php";

$csrf_token = $_SESSION['csrf_token'];
$type = $_POST['type'] ?? $_GET['type'] ?? null;
$iv = $_SESSION['iv'];
$idMatch = $_POST['idMatch'] ?? $_GET['idMatch'] ?? null;

if($_SESSION['iv'] == ""){
    header("Location: /matchs.php");
    die("ID Match invalide.");
}

if (!is_numeric($idMatch)) {
    header("Location: /matchs.php");
    die("ID Match invalide.");
}

if (!in_array($type, ['ajout', 'modification','validation', 'notes'])) {
    header("Location: /gerermatch.php?type=vue&idMatch=" . $idMatch . "&csrf_token=" . hash_hmac("sha256",$idMatch . $csrf_token . "vue", $_SESSION['csrf_token']));
    die("Type de requête non défini.");
}


/**
 * @param int $idMatch
 * @return void
 */
function editerFDM(int $idMatch, bool $archive): void
{
    $fdmExistante = JouerUnMatch::getJouerByMatch($idMatch);
    for ($i = 1; $i <= 23; $i++) {
        $key = "position-" . openssl_encrypt($i,'aes-256-cbc',$_SESSION["csrf_token"],0, $_SESSION['iv']);
        $idJoueur = openssl_decrypt($_POST[$key],'aes-256-cbc',$_SESSION["csrf_token"],0,$_SESSION["iv"]);
        $poste = $i;
        if(array_key_exists($i,$fdmExistante)){
            if($idJoueur == ""){
                echo "Suppression de la position ".$i."<br>";
                $fdmExistante[$i]->delete();
            }else{
                $joueur = Joueur::getById($idJoueur);
                $jouerUnMatch = new JouerUnMatch($idMatch, $joueur, $i < 16, $poste, -1.0, $archive);
                $jouerUnMatch->update();
            }
        }
        elseif ($idJoueur != ""){
            $joueur = Joueur::getById($idJoueur);
            $jouerUnMatch = new JouerUnMatch($idMatch, $joueur, $i < 16, $poste, -1.0, $archive);
            $jouerUnMatch->insert();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hash = hash_hmac("sha256", $idMatch . $csrf_token . $type, $csrf_token);
    if (!isset($_POST['csrf_token']) || !hash_equals($hash, $_POST['csrf_token'])) {
        header("Location: /matchs.php");
        die("CSRF validation failed.");
    }


    if ($_POST["fdm"] === "2") {
        if (!empty($_POST['notes'])) {
            $fdm = JouerUnMatch::getJouerByMatch($idMatch);
            foreach ($_POST['notes'] as $playerId => $data) {
                $idMatch = $data['idMatch'];
                $numero = openssl_decrypt($data['idJoueur'],'aes-256-cbc', $csrf_token, 0, $iv);
                echo is_string($numero) . " " . is_string($playerId);
                $note = $data['note'];
                $fdm[$numero]->setNote($note);
                $fdm[$numero]->update();
            }
        }
        header("Location: /gerermatch.php?type=vue&idMatch=" . $idMatch . "&csrf_token=" . hash_hmac("sha256",$idMatch . $csrf_token . "vue", $_SESSION['csrf_token']));
        die();
    } else {
        for ($i = 1; $i < 23; $i++) {
            echo "position-" . $i . " : " . openssl_decrypt($_POST["position-" . openssl_encrypt($i,'aes-256-cbc',$_SESSION["csrf_token"],0,$_SESSION["iv"])],'aes-256-cbc',$_SESSION["csrf_token"],0,$_SESSION["iv"]) . "<br>";
        }
        foreach ($_POST as $key => $value) {
            if ($key == "csrf_token" || str_contains($key, "position-"))
                continue;
            echo $key . " : " . $value . "<br>";
        }
        if($_POST["fdm"] === "0") {
            $match = MatchDeRugby::getFromId($idMatch);
            $match->setResultat(Resultat::from($_POST["resultat"]));
            $match->validerMatch();
        } elseif ($_POST["fdm"] === "1") {
            if ($_POST["submit"] === "ajouter") {
                editerFDM($idMatch, false);
            } elseif ($_POST["submit"] === "valider") {
                if (!regle()) {
                    header("Location: /gerermatch.php?type=vue&idMatch=" . $idMatch . "&csrf_token=" . hash_hmac("sha256",$idMatch . $csrf_token . "vue", $_SESSION['csrf_token']));
                    die();
                }
                editerFDM($idMatch, true);
            }
        }
        header("Location: /gerermatch.php?type=vue&idMatch=" . $idMatch . "&csrf_token=" . hash_hmac("sha256",$idMatch . $csrf_token . "vue", $_SESSION['csrf_token']));
    }
}
elseif($_SERVER['REQUEST_METHOD'] === 'GET'){
    $hash = hash_hmac("sha256", $idMatch . $csrf_token . $type, $csrf_token);
    if (!isset($_GET['csrf_token']) || !hash_equals($hash, $_GET['csrf_token'])){
        header("Location: /matchs.php");
        die("CSRF validation failed.");
    }
    if($type == "notes"){
        $css = ["style.css","feuille.css"];
        $joueurs = JouerUnMatch::getJouerByMatch($idMatch);
        $title = "Ajouter des notes";
        $page = '../vue/saisirnotes.php';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $_SESSION['iv'] = $iv;
        $csrf_token = $_SESSION["csrf_token"];
        include_once '../components/page.php';
        die();
    }
    header("Location: /gerermatch.php?type=vue&idMatch=" . $idMatch . "&csrf_token=" . hash_hmac("sha256",$idMatch . $csrf_token . "vue", $_SESSION['csrf_token']));
}

function regle():bool {
    $nbJoueurs = $_POST["nbJoueurs"];
    $nbPremieresLignes = $_POST["nbPremieresLignes"];
    if($nbJoueurs < 11)
        return false;
    if($nbPremieresLignes < 3)
        return false;
    switch ($nbPremieresLignes){
        case 4:
            if($nbJoueurs > 19)
                return false;
            break;
        case 5:
            if($nbJoueurs > 22)
                return false;
            break;
    }
    return true;
}