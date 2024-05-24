<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nom_dossier = "Articles/";

// Créer le dossier si nécessaire
if (!file_exists($nom_dossier)) {
    if (mkdir($nom_dossier, 0777, true)) {
        echo "Dossier créé<br>";
    } else {
        echo "Erreur lors de la création du dossier<br>";
    }
}

if (isset($_POST['submit'])) {
    // Vérifier si le champ de texte n'est pas vide
    if (!empty($_POST['content']) && !empty($_POST['title']) && !empty($_POST['category'])) {
		// Nettoyage du titre pour éviter les problèmes avec les noms de fichiers
		$titre = preg_replace('/[^A-Za-z0-9_\-]/', '_', $_POST['title']); 
        $category = preg_replace('/[^A-Za-z0-9_\-]/', '_', $_POST['category']); // Nettoyage de la catégorie
		// Générer un nom de fichier unique basé sur le titre et la date et l'heure actuelles
		$filename = $nom_dossier . $titre . ".txt";
        // Récupérer le contenu du champ de texte
        $content = "Catégorie: " . $category . "\n\n" . $_POST['content'];
        // Écrire le contenu dans le fichier texte
        if (file_put_contents($filename, $content)) {
            echo "Le document texte a été créé avec succès !<br>";
            echo "<script>setTimeout(function(){window.location.href='accueil.php';}, 1000);</script>";
        } else {
            echo "Erreur lors de la création du document texte<br>";
        }
    } else {
        echo "Veuillez saisir toutes les informations pour créer le document.<br>";
    }
}
?>
