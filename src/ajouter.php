<?php
//on demarre une session
session_start();
// Activer les rapports d'erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if($_POST) {
    if(

            isset($_POST["user_id"]) && !empty($_POST["user_id"])
        && isset($_POST["entreprise"]) && !empty($_POST["entreprise"])
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
            //On inclut la connexion à la base
            require_once("connexion.php");
            // Initialiser une variable pour stocker le message
            $message = '';
            //On nettoie les données envoyées

            $user_id = strip_tags($_POST["user_id"]);
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


            $sql = "INSERT INTO recherche (user_id, entreprise, etat, date_envoi, relancer, type_candidature, candidature, poste,contrat, mail, commentaire)
            VALUES (:user_id, :entreprise, :etat, :date_envoi, :relancer, :type_candidature, :candidature, :poste, :contrat, :mail, :commentaire)";    

    $query = $db->prepare($sql);

    // Lier les valeurs
    $query->bindValue(":user_id",$user_id);
    $query->bindValue(":entreprise",$entreprise);
    $query->bindValue(":etat",$etat);
    $query->bindValue(":date_envoi",$date_envoi);
    $query->bindValue(":relancer",$relancer );
    $query->bindValue(":type_candidature",$type_candidature);
    $query->bindValue(":candidature", $candidature);
    $query->bindValue(":poste",$poste);
    $query->bindValue(":contrat",$contrat);
    $query->bindValue(":mail",$mail);
    $query->bindValue(":commentaire",$commentaire);

    // Exécuter la requête et gérer les erreurs
    
        $query->execute();
        header('Location: user.php');
        exit(); // Assurez-vous d'appeler exit après header pour terminer l'exécution du script 
       
    
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="form">
     <h1>Ajouter une entreprise</h1>
     <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <form  method="POST">
                <label>Entreprise</label>
                <input type="text" name="entreprise">
                <label>ETAT</label>
            <select name="etat">
                <option value="J'ai postulé">J'ai postulé</option>
                <option value="Ne correspond pas">Ne correspond pas</option>
                <option value="A relancer">A relancer</option>
                <option value="J'ai relancé">J'ai relancé</option>
                <option value="Entretien programmé">Entretien programmé</option>
                <option value="Réponse négative">Réponse négative</option>
                <option value="Embauché">Embauché</option>
                <option value="Pas de réponse">Pas de réponse</option>
            </select>
                <label>DATE D'ENVOI</label>
                <input type="date" name="date_envoi">
                <label>A RELANCER J+7</label>
                <input type="text" name="relancer">
                <label>TYPE D'ENVOIDE LA CANDIDATURE</label>
            <select name="type_candidature">
                <option value="Dépôt de votre candidature sur Site">Dépôt de votre candidature sur Site</option>
                <option value="Envoi par courrier postal">Envoi par courrier postal</option>
                <option value="Envoi par mail">A relancer</option>
            </select>
                <label>CANDIDATURE</label>
                <select name="candidature">
                <option value="Candidature sur offre">Candidature sur offre</option>
                <option value="Candidature spontanée">Candidature spontanée</option>
           </select>
                <label>TITRE DU POSTE</label>
                <input type="text" name="poste">
                <label>CONTRAT</label>
                <select name="contrat">
                <option value="Stage">Stage</option>
                <option value="CDD">CDD</option>
                <option value="CDI">CDI</option>
                <option value="PMSMP">PMSMP</option>
            </select>
                <label>MAIL</label>
                <input type="text" name="mail">
                <label>Commentaires</label>
                <input type="text" name="commentaire">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']?>">
            <button class="button">Ajouter</button>
            
        </form>
    </div>
    
</body>

</html>