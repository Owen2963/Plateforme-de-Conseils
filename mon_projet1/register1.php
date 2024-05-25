<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Enregistrer les données dans un fichier CSV
    $file = fopen('users.csv', 'a');
    fputcsv($file, [$nom, $email, $password]);
    fclose($file);

    // Rediriger l'utilisateur vers la page de connexion
    header('Location: login.html');
    exit;
}
?>
