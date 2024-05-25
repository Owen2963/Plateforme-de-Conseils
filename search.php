<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupérer la requête de recherche
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Chemin vers le dossier des articles
$nom_dossier = "Articles/";

function search_in_content($content, $query) {
    return stripos($content, $query) !== false;
}

// Conseils statiques
$static_conseils = [
    [
        'titre' => '1. Prendre conscience du fait qu\'on va changer de vie',
        'conseil' => 'Ressentir le besoin d\'organiser sa vie est souvent le signe qu\'on s\'est laissé déborder par certaines tâches du quotidien. Vous souffrez sûrement comme beaucoup du syndrome de charge mentale, et le simple fait de consacrer un peu de temps à faire le tri et mettre en place une bonne organisation personnelle sera bien sûr indispensable. Mais ça reste loin d\'être suffisant. Avant de s\'interroger sur la manière dont on pourrait organiser sa vie et son temps, il faut d’abord se rendre compte que l’on va opérer de grands changements dans notre vie de tous les jours. C\'est un engagement que l’on prend envers soi-même afin d\'être certain que cette nouvelle organisation soit bénéfique. Vous allez devoir prendre de nouvelles habitudes pour repartir sur de bonnes bases, et tenir alors vos bonnes résolutions ne sera qu’une simple formalité !'
    ],
    [
        'titre' => '2. Apprendre à vaincre la procrastination',
        'conseil' => 'Certaines tâches quotidiennes sont tellement rébarbatives qu\'on peut très facilement être tenté de relâcher ses efforts et mettre ses bonnes intentions au placard, simplement parce qu\'on ne parvient pas à se motiver sur le long terme. Vaincre la procrastination est une problématique à laquelle nous sommes tous confrontés, et avoir la force de ne pas remettre au lendemain demande du courage ! Il va pourtant falloir sortir de votre zone de confort et faire l\'effort de prioriser un maximum pour ne pas vous laisser tenter par cette envie puissante de ne rien faire.'
    ],
    [
        'titre' => '3. Se lever, puis faire une liste des tâches tous les matins',
        'conseil' => 'Prôné par un grand nombre d’entrepreneurs à succès (dont on peut retrouver les témoignages dans le carnet du temps), l\'un de vos premiers réflexes dès le réveil est de faire le point sur les choses importantes que vous avez à faire dans la journée. Commencez toujours votre liste par les actions primordiales, celles que vous ne pouvez pas reporter. Soyez également cohérent avec vous-même. Ça n\'a aucun sens de rédiger une todo list interminable dont vous ne verrez jamais la fin... simplement car vous n’aurez pas le temps de tout faire. Nous vous conseillons d’ailleurs d’utiliser le carnet de to-do list pour prendre plaisir à vous organiser sans stresser.'
    ],
	[
        'titre' => '4. Apprendre à gérer son temps pour organiser sa vie',
        'conseil' => 'Une bonne gestion du temps est souvent la preuve d\'une organisation personnelle cohérente et précise. En parvenant à anticiper ce que vous faites chaque jour (par exemple : avec un emploi du temps), vous pourrez prendre du recul sur votre programme de la semaine ou encore du mois. De cette manière, organiser vos journées sera bien plus logique. Vous aurez donc une meilleure vision du temps libre dont vous disposez.'
    ],
    [
        'titre' => '5. Mettre en place un vrai plan d\'action pour vos projets',
        'conseil' => 'Votre vie personnelle a autant d\'importance que votre vie professionnelle mais, pour pouvoir marier harmonieusement ces deux univers, une bonne organisation devra être mise en place. Sachez qu\'il en va de même pour vos projets personnels. Si vous avez des objectifs en tête, transformez-les en plan d’actions précises. Non seulement, vous aurez le sentiment de vous rapprocher du but, mais en plus vous serez bien plus motivé pour les réaliser.'
    ],
    [
        'titre' => '6. Savoir se distraire et prendre du temps pour soi',
        'conseil' => 'Être productif est bon pour le moral et peut vite devenir addictif, quand on réalise à quel point on peut s\'épanouir simplement en faisant l\'effort d\'organiser sa vie... Enthousiaste et motivé, on en oublierait presque de prendre du temps pour soi. Ce manque de temps que l\’on s’accorde conduit à déprimer, à abandonner parfois ses efforts sur la longueur... ou pire : à vivre un burn-out. L\'intérêt final de la mise en place de votre nouvelle organisation est de pouvoir mieux gérer votre temps. Et donc, de profiter davantage de vos instants de détente. Apprenez à vous détendre, à profiter du moment présent. Et surtout, ne vous sentez pas coupable de vous être accordé une pause.'
    ],
    [
        'titre' => '7. Prendre le temps de faire le point',
        'conseil' => 'Dans l\'enthousiasme, vous risquez de ne pas consacrer une seule minute à faire le point sur votre situation. C\'est une erreur qui pourrait être préjudiciable pour la suite. Si par exemple, c’est une surcharge de travail qui nous pousse à se demander comment organiser sa vie, alors c\'est le signe qu\'un bilan est nécessaire. Il faut comprendre quelles sont les causes de ce stress et comment la situation a dégénéré en nous faisant perdre le contrôle. Identifiez la source de votre désorganisation et bannissez-la de votre nouvelle vie ! Sinon, le même schéma se reproduira éternellement et vous finirez par vous décourager à force de ne pas réussir à mettre de l\'ordre dans votre vie.'
    ],
    [
        'titre' => '8. Oser se simplifier la vie pour mieux organiser son temps',
        'conseil' => 'Par habitude, on a tendance à se surcharger de tâches qu\'on pourrait réduire ou déléguer. Si quelque chose vous fait gagner du temps, alors n\'hésitez pas à en profiter. Posez-vous les bonnes questions et repérez les améliorations éventuelles qui pourraient vous faciliter la vie et vous faire économiser un peu d\'énergie ou quelques minutes, pour consacrer ces moments à d\'autres projets plus urgents, par exemple en utilisant des to-do list originales et très efficaces.'
    ],
    [
        'titre' => '9. Rester dans le bon état d\'esprit en cas d\'imprévus',
        'conseil' => 'Les imprévus sont inévitables... et ils peuvent vraiment être très stressants ! Surtout quand on a planifié toute sa semaine au millimètre près. N\'oubliez pas que vous serez forcément dérangé par des événements inattendus surnommés « imprévus » que la vie sèmera sur votre chemin... Parfois, ils peuvent s\'avérer être de très belles surprises ! Ce n\'est pas une raison pour paniquer. Laissez-vous une marge d\'erreur et soyez bienveillant avec vous-même. Il est impossible d\'avoir un planning parfait et il n’est pas nécessaire qu’il le soit pour être très efficace.'
    ],
    [
        'titre' => '10. Utiliser un support papier pour désencombrer son esprit',
        'conseil' => 'Un agenda papier ou un carnet de bord sera bien plus efficace qu\'une application sur smartphone. En effet, vous prenez alors plaisir à noter, raturer, modifier, annoter ce que vous voulez et votre cerveau se concentrera davantage en associant l\'écriture manuelle à la tâche à accomplir. C\'est un excellent moyen de mieux mémoriser et d\'ancrer les informations pour vous rappeler plus facilement ce que vous avez à faire. En utilisant un support papier, vous vous épargnerez la procrastination en étant plus attentif à vos projets qu\'avec une simple application numérique.'
    ],
    [
        'titre' => '11. Mettre en place des rituels qui vous sont propres',
        'conseil' => 'Avec l’habitude, vous finirez par mettre en place des rituels dans vos journées, ces moments incontournables qui vous apporteront épanouissement et vous permettront de conserver la motivation nécessaire à une bonne organisation de votre vie. Apprenez à vous connaître et faites des tests pour identifier les activités qui vous font le plus de bien. Cela peut être du sport, de la méditation, de la lecture, peu importe, tant que vous y prenez du plaisir. Une fois votre rituel trouvé, essayez de le pratiquer régulièrement pour en faire une habitude positive dans votre quotidien.'
    ],
];
// Vérifier les conseils statiques
$resultats = [];
foreach ($static_conseils as $conseil) {
    if (search_in_content($conseil['titre'], $query) || search_in_content($conseil['conseil'], $query)) {
        $resultats[] = $conseil;
    }
}
// Vérifier les conseils dynamiques
if (file_exists($nom_dossier)) {
    $fichiers = array_diff(scandir($nom_dossier), array('.', '..'));
    foreach ($fichiers as $fichier) {
        $chemin_complet = $nom_dossier . $fichier;
        $contenu = file_get_contents($chemin_complet);
        $lignes = explode("\n", $contenu);
        $titre = basename($fichier, ".txt");
        $categorie = array_shift($lignes);
        $conseil = implode("\n", $lignes);

        if (search_in_content($titre, $query) || search_in_content($conseil, $query)) {
            $resultats[] = [
                'titre' => $titre,
                'categorie' => $categorie,
                'conseil' => $conseil,
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="SiteConseil.css">
    <title>Résultats de recherche</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1 class="titre">Résultats de recherche pour "<?php echo htmlspecialchars($query); ?>"</h1>
    <nav class="navbar">
        <ul>
            <li><b><a href="accueil.php">Accueil</a></b></li>
            <li><b><a href="nos_conseils.html">Nos Conseils</a></b></li>
            <li><b><a href="conseil_du_jour.html">Conseil du jour</a></b></li>
            <li><b><a href="creer_un_conseil_bis.php">Créer un conseil</a></b></li>
            <li><b><a href="profil.html">Profil</a></b></li>
        </ul>
    </nav>
    <main>
        <div id="resultats">
            <?php if (!empty($resultats)): ?>
                <?php foreach ($resultats as $resultat): ?>
                    <div class="conseil_texte">
                        <h1 class="conseil_titre"><?php echo htmlspecialchars($resultat['titre']); ?></h1>
                        <p><b><?php echo nl2br(htmlspecialchars($resultat['conseil'])); ?></b></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun résultat trouvé pour "<?php echo htmlspecialchars($query); ?>"</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
