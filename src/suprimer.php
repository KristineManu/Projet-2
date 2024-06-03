<?php
//ON VERIFIE QU'IL Y BIEN UN ID DANS URL ET QUE L'UTULISATEUR EXISTE
if(isset($_GET["id"])&& !empty($_GET["id"])){


require_once("connexion.php");
// echo $_GET["id"];
$id = strip_tags($_GET["id"]);
$sql = "SELECT * FROM recherche WHERE id = :id";
$query = $db->prepare($sql);
//On accroche la valeur id de la requête à celle de la variable $id
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();
$user = $query->fetch();
// print_r($user);

//On verifie si l'utilisateur existe


if(!$user){
    header("Location: index.php");
}else{
    //On gére la supression un utilisateur
    $sql = "DELETE FROM recherche WHERE id = :id";

    $query = $db->prepare($sql);

//On accroche la valeur id de la requête à celle de la variable $id

$query->bindValue(":id", $id, PDO::PARAM_INT);

$query->execute();
header("Location: index.php");
}


}
else{
    header("Location: index.php");
}
?>


