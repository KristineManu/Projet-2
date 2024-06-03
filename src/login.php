<?php
session_start();
require_once('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];



    // Requête pour vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT id, email, password FROM users WHERE email = :email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($user && password_verify($password, $user['password'])) {
        // Authentification réussie, enregistrer l'ID de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        // Rediriger vers autre page
        header('Location: user.php');
        exit();
    } else {
        // Authentification échouée, afficher un message d'erreur
        $error_message = "Identifiants invalides. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" >
            <label >Email</label><br>
            <input type="mail"name="email" id=email required><br>
            <label >Mot de passe:</label><br>
            <input type="password" name="password" id="password" required><br>
            <button class="Btn_add" type="submit">Se connecter</button>
        </form>
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <p>Vous n'avez pas de compte? </p>
            
        <a href="inscription.php" class="Btn_add"> <img src="images/plus.png"> Inscrivez-vous</a>
    
    </div>
</body>
</html>