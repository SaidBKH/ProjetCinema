<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title<?= $titre ?></title>
</head>
<body>
    <nav class = "uk-navbar-conteiner"> 
        <ul>
            <li><a href="index.php?action=listFilms">Films</a></li>
            <li><a href="index.php?action=listActeur">Acteurs</a></li>
            <li><a href="index.php?action=listRealisateur">Réalisateurs</a></li>
            <li><a href="index.php?action=listGenre">Genres</a></li>
            <li><a href="index.php?action=listRole">Rôles</a></li>
        </ul>
    </nav>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id ="contenu">
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?> </h2>
                <?= $contenu?>             
            </div>
        </main>
    </div>
        
 
</body>
</html>