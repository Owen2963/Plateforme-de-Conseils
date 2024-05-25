<?php
	$username=$_POST['username'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" type="text/css" href="SiteConseil.css">
	<title>Site de conseils - Account</title>
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
			<img scr="" srcset="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1" width="200" id="logged">
			<?php echo "<H1>".$username."</H1>" ?>
			<H1>Numéro de téléphone:<H1>
			<H1>Email:<H1>
		</main>
	</body>
</html>
