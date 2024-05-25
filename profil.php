<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" type="text/css" href="SiteConseil.css">
	<title>Site de conseils - Sign In</title>
	<meta charset="UTF-8">
	<!-- viewport permet de contrôler la mise en page sur différents appareils-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<h1 class="titre">Site de conseils de la vie quotidienne</h1>
		<nav class="navbar">
			<ul>
				<li><b><a href="accueil.php">Accueil</a></b></li>
			        <li><b><a href="nos_conseils.html">Nos Conseils</a></b></li>
			        <li><b><a href="conseil_du_jour.html">Conseil du jour</a></b></li>
			        <li><b><a href="creer_un_conseil_bis.php">Créer un conseil</a></b></li>
			        <li class="page_actuel"><b><a href="profil.php">Profil</a></b></li>
			</ul>
		</nav>
		<main>
		</br></br></br></br></br></br></br></br></br></br></br>
			<form class="login" action="logged.php" method="post">
				<fieldset>
					<label for="username">Username</label>
					<input type="text" name="username" maxlength="22" required><br></br>
					<label for="password">Password</label> 
					<input type="password" name="password" required> <br></br>
					<input type="submit" value="Sign in" class="hover">
				</fieldset>
			</form>
		</main>
	</body>
</html>