<?php
//On demare la session
session_start();
//On inclut la connexion à la base
require_once('connexion.php');

// Si un ID est passé dans l'URL et n'est pas vide
if(isset($_GET["id"]) && !empty($_GET["id"])) {
    // Supprimer l'entreprise avec cet ID de la base de données
    $id = strip_tags($_GET["id"]);
    $sql = "DELETE FROM recherche WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    // Rediriger vers la même page pour actualiser la liste après la suppression
    header("Location: index.php");
    exit(); // Assurez-vous de terminer l'exécution du script après une redirection
}

// Sélectionner toutes les entreprises


$sql = 'SELECT * FROM `recherche`';

//On prepare la reqête
$query = $db->prepare($sql);

//On exécute la reqête
$query->execute();

//On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Suivi de Recherche de Stage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
<div class="container">
<h1>Tableau de Suivi de Recherche de Stage</h1> 
    <?php
    if(!empty($_SESSION["message"])){
        echo "<p>" . $_SESSION["message"] . "</p>"; $_SESSION["message"];
        $_SESSION["message"]="";
        }
        ?> 

<a href="login.php" class="Btn_add"> <img src="images/plus.png"> Connectez-vous</a>
        <table>
            <thead id="items">

                <th>ID</th>
                <th>Entreprise</th>
                <th>Etat</th>
                <th>Date d'envoi</th>
                <th>A relancer J+7</th>
                <th>Type d'envoi de la candidature</th>
                <th>Candidature</th>
                <th>Titre du poste</th>
                <th>Contrat</th>
                <th>Mail</th>
                <th>Commentaires</th>
                <th>Voir</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
              <?php
              foreach($result as $info)  {

              
                ?>
                <tr>
                    <td><?= $info['id'] ?></td>
                    <td><?= $info['entreprise'] ?></td>
                    <td><?= $info['etat'] ?></td>
                    <td><?= $info['date_envoi'] ?></td>
                    <td><?= $info['relancer'] ?></td>
                    <td><?= $info['type_candidature'] ?></td>
                    <td><?= $info['candidature'] ?></td>
                    <td><?= $info['poste'] ?></td>
                    <td><?= $info['contrat'] ?></td>
                    <td><?= $info['mail'] ?></td>
                    <td><?= $info['commentaire'] ?></td>
                    <td><a href="user.php?id=<?= $info['id'] ?>"><img src="images/edit.png" alt="Voir"></a></td>
                    <td><a href="modifier.php?id=<?= $info['id'] ?>"><img src="images/pen.png" alt="Modifier"></a></td>
                    <td><a href="suprimer.php?id=<?= $info['id'] ?>"><img src="images/trash.png" alt="Supprimer"></a></td>
                    
                
                </tr>



              <?php
              }
              ?>
            </tbody>
        </table>
   
        
   
   
    </div>
</body>
</html>