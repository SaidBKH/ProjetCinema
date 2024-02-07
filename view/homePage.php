<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <header>
        <figure>
            <img class="logo" src="public/img/logo.png" alt="Le logo" height="100px"/>
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
    <div class="slider-container">
    <div class="slider">
        <div><a href="index.php?action=detailFilm&id=4"><img src="public/img/affiche1.jpg" class="slider-image" alt="Slide 1"></a></div>
        <div><a href="index.php?action=detailFilm&id=3"></a><img src="public/img/affiche2.jpg" class="slider-image" alt="Slide 2"></a></div>
        <div><a href="index.php?action=detailFilm&id=2"></a><img src="public/img/affiche3.jpg"  class="slider-image" alt="Slide 3"></a></div>
    </div>
    </div>

    <div class="films-sortie-semaine section-title">
        <div class="titre">
            <h2>SORTIE DE LA SEMAINE :</h2>
        </div>
        <div class="list-film">
        <?php
        $cinemaController = new \Controller\CinemaController();
        $films = $cinemaController->filmsSortieSemaine(); // Appel de la méthode pour récupérer les films
        foreach ($films as $film) {
            echo '<div class="film"><a href="index.php?action=detailFilm&id=' . $film['IdFilm'] . '"><img src=' . $film['Affiche'] . '" class="film-image" alt="' . $film['Titre'] . '"></a><p class="film-title">' . $film['Titre'] . '</p></div>';
        }
        ?>

        <div class="voirPlusSortie">
            <a href="index.php?action=listFilms">Voir plus</a>
        </div>
    </div>
</div>
<div class="top-films-semaine section-title">
   
<div class="titre">
        <h2>Top Films de la Semaine</h2>
    </div>

    <div class="list-film">
        <?php
        $cinemaController = new \Controller\CinemaController();
        $topFilms = $cinemaController->topFilmsSemaine(); 
        foreach ($topFilms as $film) {
            echo '<div class="film"><a href="index.php?action=detailFilm&id=' . $film['IdFilm'] . '"><img src=' . $film['Affiche'] . '" class="film-image" alt="' . $film['Titre'] . '"></a><p class="film-title">' . $film['Titre'] . '</p></div>';
        }
        ?>
    </div>

    <div class="voirPlusTop">
        <a href="index.php?action=listFilms">Voir plus</a>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


<script>
    $(document).ready(function(){
        $('.slider').slick({
            autoplay: true, 
            autoplaySpeed: 3000, 
            arrows: true, 
            dots: true 
        });
    });
</script>



</body>
</html>