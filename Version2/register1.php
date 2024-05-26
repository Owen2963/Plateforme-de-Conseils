<?php
// Vérifie si la méthode de la requête HTTP est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère les données envoyées via le formulaire d'inscription
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    // Hache le mot de passe pour le stocker de manière sécurisée
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Ouvre le fichier users.csv en mode ajout (append)
    $file = fopen('users.csv', 'a');
    // Écrit les données de l'utilisateur (nom, email, mot de passe haché) dans le fichier CSV
    fputcsv($file, [$nom, $email, $password]);
    // Ferme le fichier
    fclose($file);

    // Redirige l'utilisateur vers la page de connexion après l'inscription
    header('Location: login.php');
    exit; // Assure que le script s'arrête après la redirection
}
?>
