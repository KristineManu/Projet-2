<?php
session_start();
require_once('connexion.php');

//je  vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}

// Récupère les informations de l'utilisateur à partir de la base de données
$sql = "SELECT * FROM users WHERE id = :user_id";
$query = $db->prepare($sql);
$query->bindParam(':user_id', $_SESSION['user_id']);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

// Affiche les informations de l'utilisateur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Profil Utilisateur</h1>

        <p><strong>Nom:</strong> <?= $user['first_name'] ?></p>
        <p><strong>Prénom:</strong> <?= $user['last_name'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
       
        
        <?php if( isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null ) : ?>
    <a href="logout.php" class="Btn_add">Se déconnecter</a>
  <?php else : ?>
    <a href="login.php">Se connecter</a>
  <?php endif; ?>  
        <a href="ajouter.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>


<?php
$sql = "SELECT * FROM recherche WHERE user_id = :user_id";
$query = $db->prepare($sql);
$query->bindParam(':user_id', $_SESSION['user_id']);
$query->execute();
$recherches = $query->fetchAll(PDO::FETCH_ASSOC);

// Affiche les informations de l'utilisateur
?>
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
              foreach($recherches as $recherche)  {

              
                ?>
                <tr>
                    <td><?= $recherche['id'] ?></td>
                    <td><?= $recherche['entreprise'] ?></td>
                    <td><?= $recherche['etat'] ?></td>
                    <td><?= $recherche['date_envoi'] ?></td>
                    <td><?= $recherche['relancer'] ?></td>
                    <td><?= $recherche['type_candidature'] ?></td>
                    <td><?= $recherche['candidature'] ?></td>
                    <td><?= $recherche['poste'] ?></td>
                    <td><?= $recherche['contrat'] ?></td>
                    <td><?= $recherche['mail'] ?></td>
                    <td><?= $recherche['commentaire'] ?></td>
                    <td><a href="user.php?id=<?= $recherche['id'] ?>"><img src="images/edit.png" alt="Voir"></a></td>
                    <td><a href="modifier.php?id=<?= $recherche['id'] ?>"><img src="images/pen.png" alt="Modifier"></a></td>
                    <td><a href="suprimer.php?id=<?= $recherche['id'] ?>"><img src="images/trash.png" alt="Supprimer"></a></td>
                    
                
                </tr>



              <?php
              }
              ?>
            </tbody>
        </table>




        </div>

</body>
</html>
