<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $email = $_SESSION['email'];

    // Générer un ID unique pour le conseil
    $id = uniqid();

    // Enregistrer les données dans un fichier CSV
    $file = fopen('data.csv', 'a');
    fputcsv($file, [$id, $titre, $description, $categorie, $email]);
    fclose($file);

    // Rediriger l'utilisateur vers la page des conseils
    header('Location: conseils.php');
    exit;
}
?>
