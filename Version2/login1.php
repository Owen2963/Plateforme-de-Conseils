<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lire le fichier CSV pour trouver l'utilisateur
    $data = array_map('str_getcsv', file('users.csv'));
    $user = null;
    foreach ($data as $row) {
        if ($row[1] == $email && password_verify($password, $row[2])) {
            $user = $row;
            break;
        }
    }

    if ($user) {
        // Démarrer la session et enregistrer les informations de l'utilisateur
        session_start();
        $_SESSION['nom'] = $user[0];
        $_SESSION['email'] = $user[1];
        setcookie("user", $user[1], time() + (86400 * 30), "/");
        header('Location: profil.php');
    } else {
        // Rediriger vers la page de connexion avec un message d'erreur
        header('Location: login.php?error=1');
    }
    exit;
}
?>
