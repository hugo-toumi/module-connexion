<?php

session_start();


$db = new PDO('mysql:host=localhost;dbname=hugo-toumi_moduleconnexion;charset=utf8', 'root','');

if(isset($_SESSION['connect'])){
  header('location: inscription.php');
}

require('connection.php');

if(!empty($_POST['login']) && !empty($_POST['password'])){

	// VARIABLES
	$login 		= $_POST['login'];
	$password 	= $_POST['password'];
	$error		= 1;

	
	

	$req = $db->prepare('SELECT * FROM utilisateurs WHERE login = ?');
	$req->execute(array($login));

	while($utilisateurs = $req->fetch()){

		if($password == $utilisateurs['password']){
			$error = 0;
			$_SESSION['connect'] = 1;
			$_SESSION['prenom']	 = $utilsateurs['prenom'];
			$_SESSION['id']	 = $utilsateurs['id'];
			
			
            $iduser = $utilisateurs['id'];
			header("location: profil.php?id=$iduser");

			if($_POST['login'] == 'admin'){
				header('Location: admin.php');
				}
			
		}


	}
	

	if($error == 1){
		header('location: connexion.php?error=1');
		
		
	}
    

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="default.css">
</head>
<body>
	<header>
		<h1>Connexion</h1>
	</header>

	<div class="container">
		<p id="info">Bienvenue sur mon site si vous n'êtes pas inscrit, <a href="inscription.php">inscrivez-vous.</a></p>
	 	
		<?php
			if(isset($_GET['error'])){
				echo'<p id="error">Nous ne pouvons pas vous authentifier.</p>';
			}
			else if(isset($_GET['success'])){
				echo'<p id="success">Vous êtes maintenant connecté.</p>';
			}
		?>

	 	<div id="form">
			<form method="POST" action="connexion.php">
				<table>
					<tr>
						<td>Login</td>
						<td><input type="texte" name="login" placeholder="Ex : Nom d'utilisateurs" required></td>
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="password" placeholder="Ex : ********" required ></td>
					</tr>
				</table>
				<p><label><input type="checkbox" name="connect" checked>Connexion automatique</label></p>
				<div id="button">
					<button type='submit'>Connexion</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>