<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <header>
        <figure>
            <a href="index.php?action=homePage">
            <img class="logo" src="public/img/logo.png" alt="Le logo" height="100px"/>
            </a>
        </figure>
        
        <nav class = "uk-navbar-conteiner"> 

        <ul class= "navbar-list">
            <li><a href="index.php?action=listFilms">FILMS</a></li>
            <li><a href="index.php?action=listActeur">ACTEURS</a></li>
            <li><a href="index.php?action=listRealisateur">REALISATEURS</a></li>
            <li><a href="index.php?action=listGenre">GENRES</a></li>
            <li><a href="index.php?action=listRole">ROLES</a></li>
            <li><a href="index.php?action=ajouterCasting">CASTING</a></li>

        </ul>
    </nav>
    </header>

    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id ="contenu">
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?> </h2>
                <?= $contenu?>             
            </div>
        </main>
    </div>
    
       <footer class="footer">
    <ul class= "footer-bar">
                <li><a href="index.php?action=listFilms">FILMS</a></li>
                <li><a href="index.php?action=listActeur">ACTEURS</a></li>
                 <li><a href="index.php?action=listRealisateur">REALISATEURS</a></li>
                <li><a href="index.php?action=listGenre">GENRES</a></li>
                <li><a href="index.php?action=listRole">ROLES</a></li>
                <li><a href="index.php?action=ajouterCasting">CASTING</a></li>
            </ul>
    </footer>

 
</body>
</html>