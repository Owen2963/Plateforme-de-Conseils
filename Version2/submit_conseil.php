<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit; // Termine le script
}

// Vérifie si le formulaire a été soumis en POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère les données du formulaire
    $titre = $_POST['titre']; // Titre du conseil
    $categorie = $_POST['categorie']; // Catégorie du conseil
    $description = $_POST['description']; // Description du conseil
    $email = $_SESSION['email']; // Email de l'utilisateur connecté

    // Génère un identifiant unique pour le conseil
    $id = uniqid(); // Utilise la fonction uniqid pour générer un identifiant unique

    // Enregistre les données dans un fichier CSV
    $file = fopen('data.csv', 'a'); // Ouvre le fichier en mode ajout
    fputcsv($file, [$id, $titre, $description, $categorie, $email]); // Écrit une ligne dans le fichier CSV
    fclose($file); // Ferme le fichier

    // Redirige l'utilisateur vers la page des conseils après avoir soumis le conseil
    header('Location: conseils.php'); // Redirige vers la page des conseils
    exit; // Termine le script
}
?>
