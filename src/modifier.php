<?php
session_start();
require_once('connexion.php');

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM recherche WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch();

    if (!$user) {
        header("Location: user.php");
        exit();
    }
} else {
    header("Location: user.php");
    exit();
}

if ($_POST) {
    if (
        isset($_POST["entreprise"]) && !empty($_POST["entreprise"])
        && isset($_POST["etat"]) && !empty($_POST["etat"])
        && isset($_POST["date_envoi"]) && !empty($_POST["date_envoi"])
        && isset($_POST["relancer"]) && !empty($_POST["relancer"])
        && isset($_POST["type_candidature"]) && !empty($_POST["type_candidature"])
        && isset($_POST["candidature"]) && !empty($_POST["candidature"])
        && isset($_POST["poste"]) && !empty($_POST["poste"])
        && isset($_POST["contrat"]) && !empty($_POST["contrat"])
        && isset($_POST["mail"]) && !empty($_POST["mail"])
        && isset($_POST["commentaire"]) && !empty($_POST["commentaire"])
    ) {
        $entreprise = strip_tags($_POST["entreprise"]);
        $etat = strip_tags($_POST["etat"]);
        $date_envoi = strip_tags($_POST["date_envoi"]);
        $relancer = strip_tags($_POST["relancer"]);
        $type_candidature = strip_tags($_POST["type_candidature"]);
        $candidature = strip_tags($_POST["candidature"]);
        $poste = strip_tags($_POST["poste"]);
        $contrat = strip_tags($_POST["contrat"]);
        $mail = strip_tags($_POST["mail"]);
        $commentaire = strip_tags($_POST["commentaire"]);
// Mettre à jour l'enregistrement
        $sql = "UPDATE recherche SET entreprise = :entreprise, etat = :etat, date_envoi = :date_envoi, relancer = :relancer, type_candidature = :type_candidature, candidature = :candidature, poste = :poste, contrat = :contrat, mail = :mail, commentaire = :commentaire WHERE id = :id";
        $query = $db->prepare($sql);

        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":entreprise", $entreprise, PDO::PARAM_STR);
        $query->bindValue(":etat", $etat, PDO::PARAM_STR);
        $query->bindValue(":date_envoi", $date_envoi, PDO::PARAM_STR);
        $query->bindValue(":relancer", $relancer, PDO::PARAM_STR);
        $query->bindValue(":type_candidature", $type_candidature, PDO::PARAM_STR);
        $query->bindValue(":candidature", $candidature, PDO::PARAM_STR);
        $query->bindValue(":poste", $poste, PDO::PARAM_STR);
        $query->bindValue(":contrat", $contrat, PDO::PARAM_STR);
        $query->bindValue(":mail", $mail, PDO::PARAM_STR);
        $query->bindValue(":commentaire", $commentaire, PDO::PARAM_STR);

        $query->execute();

        $_SESSION["message"] = "Entreprise modifiée avec succès";
        header("Location: user.php");
        exit();
    } else {
        $_SESSION["message"] = "Veuillez remplir tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une entreprise</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form">
    <h1>Modifier <?= $user["entreprise"] ?></h1>
    <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
    <form method="post">
        <label for="entreprise">Entreprise</label>
        <input type="text" name="entreprise" value="<?= $user["entreprise"] ?>" required>

        <label for="etat">État</label>
        
        <select name="etat" value="<?= $user["etat"] ?>" required>>
                <option value="J'ai postulé">J'ai postulé</option>
                <option value="Ne correspond pas">Ne correspond pas</option>
                <option value="A relancer">A relancer</option>
                <option value="J'ai relancé">J'ai relancé</option>
                <option value="Entretien programmé">Entretien programmé</option>
                <option value="Réponse négative">Réponse négative</option>
                <option value="Embauché">Embauché</option>
                <option value="Pas de réponse">Pas de réponse</option>
            </select>
        <label for="date_envoi">Date d'envoi</label>
        <input type="date" name="date_envoi" value="<?= $user["date_envoi"] ?>" required>

        <label for="relancer">Relancer</label>
        <input type="text" name="relancer" value="<?= $user["relancer"] ?>" required>

        <label for="type_candidature">Type de candidature</label>
        
        <select name="type_candidature" value="<?= $user["type_candidature"] ?>" required>>
                <option value="Dépôt de votre candidature sur Site">Dépôt de votre candidature sur Site</option>
                <option value="Envoi par courrier postal">Envoi par courrier postal</option>
                <option value="Envoi par mail">A relancer</option>
            </select>
        <label for="candidature">Candidature</label>
        
        <select name="candidature" value="<?= $result["candidature"] ?>" required>
                <option value="Candidature sur offre">Candidature sur offre</option>
                <option value="Candidature spontanée">Candidature spontanée</option>
           </select>
        <label for="poste">Poste</label>
        <input  name="poste" value="<?= $user["poste"] ?>" required>
        <label for="entreprise">Entreprise</label>
        <input type="text" name="entreprise" value="<?= $user["entreprise"] ?>" required>
        <label for="contrat">Contrat</label>
        
        <select name="contrat" value="<?= $user["contrat"] ?>" required>
                <option value="Stage">Stage</option>
                <option value="CDD">CDD</option>
                <option value="CDI">CDI</option>
                <option value="PMSMP">PMSMP</option>
            </select>
        <label for="mail">Email</label>
        <input  name="mail" value="<?= $user["mail"] ?>" required>

        <label for="commentaire">Commentaire</label>
        <input name="commentaire" value="<?= $user["commentaire"] ?>"required>

        <button class="button">Modifier</button>
        </form>
        <a href="index.php">Retour</a>
    </div>
</body>
</html>