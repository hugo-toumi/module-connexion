<?php



$db = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root','');

if (isset($_SESSION['id']))
header('location: editeur.php?id=2');
{

$req = $db->prepare('SELECT * FROM utilisateurs WHERE id = ?');
$req->execute(array($_SESSION['id']));
$user = $req->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="default.css">
    <title>Editeur de Profil</title>
</head>
<body>
<div align="center">
<h2>Edition de mon profil</h2>
<form method="POST" action="">
   <input type="texte" name="newprenom" placeholder="Nouveau Prenom" value="<?php echo $user['prenom'];?>"/><br /><br />
   <input type="texte" name="newnom" placeholder="Nouveau nom" /><br /><br />
   <input type="texte" name="newlogin" placeholder="Nouveau login" /><br /><br />
   <input type="texte" name="newpassword" placeholder="Nouveau password" /><br /><br />
   <input type="texte" name="confirmpassword" placeholder="confirmpassword" /><br /><br />
   <input type="submit" value="Mettre à jour mon profil" />
</form>
</div>
    
</body>
</html>
<?php
}
?>

