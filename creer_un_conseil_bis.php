<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="SiteConseil.css">
    <title>Créer un conseil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1 class="titre">Site de conseils de la vie quotidienne</h1>
    <nav class="navbar">
        <ul>
            <li><b><a href="accueil.php">Accueil</a></b></li>
            <li><b><a href="nos_conseils.php">Nos Conseils</a></b></li>
            <li><b><a href="conseil_du_jour.php">Conseil du jour</a></b></li>
            <li class="page_actuel"><b><a href="creer_un_conseil_bis.php">Créer un conseil</a></b></li>
            <li><b><a href="profil.php">Profil</a></b></li>
        </ul>
    </nav>
    <h1 class="titre">Créer un conseil</h1>
    <form action="creer_un_conseil.php" method="post" class="creer_un_conseil">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" required>

        <label for="category">Catégorie :</label>
        <input type="text" id="category" name="category" required>

        <label for="content">Conseil :</label>
        <textarea id="content" name="content" required></textarea>

        <input type="submit" value="Soumettre" name="submit">
    </form>
</body>
</html>
