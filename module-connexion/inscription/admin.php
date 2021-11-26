<?php

$db = new PDO('mysql:host=localhost;dbname=hugo-toumi_moduleconnexion;charset=utf8', 'root','');

$utilisateurs = $db->query('SELECT * FROM utilisateurs ORDER BY id DESC');

if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
    $supprime = (int) $_GET['supprime'];
    $req = $db->prepare('DELETE FROM utilisateurs WHERE id = ?');
    $req->execute(array($supprime));
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="default.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<header>
<h1>Admin</h1>
</header>
    <ul>
       <?php while($u = $utilisateurs->fetch()) { ?>
       <li><?= $u['id'] ?> : <?= $u['login'] ?> - <a href="admin.php?supprime=<?= $u['id'] ?>">Supprimer</a></li>
       <?php } ?>
    <ul>   
</body>
</html>