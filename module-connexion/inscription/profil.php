<?php
session_start();

$db = new PDO('mysql:host=localhost;dbname=hugo-toumi_moduleconnexion;charset=utf8', 'root','');

if(isset($_GET ['id']) AND $_GET ['id'] > 0)
{
    $getid = intval($_GET ['id']);
    $req = $db->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $req->execute(array($_GET['id']));
    $req->execute(array($getid));
    $userinfo = $req->fetch();

    if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $userinfo['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertpseudo = $db->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
        $insertpseudo->execute(array($newprenom, $_GET['id']));
        header('Location: connexion.php?id=' .$_GET['id']);
    }

    if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $userinfo['nom'])
    {
        $newnom= htmlspecialchars($_POST['newnom']);
        $insertnom = $db->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $_GET['id']));
        header('Location: connexion.php?id=' .$_GET['id']);
    }

    if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $userinfo['login'])
    {
        $newlogin = htmlspecialchars($_POST['newlogin']);
        $insertlogin = $db->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        $insertlogin->execute(array($newlogin, $_GET['id']));
        header('Location: connexion.php?id=' .$_GET['id']);
    }

    if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND $_POST['newpassword'] != $userinfo['password'])
    {
        $newpassword = htmlspecialchars($_POST['newpassword']);
        $insertpassword = $db->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
        $insertpassword->execute(array($newpassword, $_GET['id']));
        header('Location: connexion.php?id=' .$_GET['id']);
    }




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="default.css">
    <title>Page Profil</title>
</head>
<body>
<header>
<h1>Page de Profil</h1>
</header>
<div align="center">
<h2>Profil de <?php echo $userinfo['prenom']; ?></h2>
<br /><br />
<form method="POST" action="">
<input type="texte" name="newprenom" value="<?php echo $userinfo['prenom']; ?>"
<br />
<input type="texte" name="newnom" value="<?php echo $userinfo['nom']; ?>"
<br />
<input type="texte" name="newlogin" value="<?php echo $userinfo['login']; ?>"
<br />
<input type="password" name="newpassword" value="<?php echo $userinfo['password']; ?>"
<br />
<input type="submit" value="Mettre à jour !" />
</form>

<?php

?>

<a href="deconnexion.php">Déconnexion</a>

<?php
}
?>    
</body>
</html>
<?php

?>