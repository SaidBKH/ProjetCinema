<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    
    <meta name="description" content="Page d'accueil de VUE, avec les sorties de la semaine, les tops films de la semaine,
     les acteurs populaires, les realisateurs populaires, les genres populaires...">



     
<title> cinema vue</title>
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
    <div class="slider-container">
    <div class="slider">
        <div class="slide-image">
            <img src="public/img/affiche1.jpeg" alt="affiche du film Parrain">
            <div class="film-title-overlay">
                <p>PARRAIN</p>
                <p> (2023)</p>
                <p>Réalisateur : John Doe</p>
            </div>
        </div>
        <div class="slide-image">
            <img src="public/img/affiche17.jpeg" alt="Affiche du film jetli">
            <div class="film-title-overlay">
                <p>JETLI</p>
                <p> (2023)</p>
                <p>Jane Doe</p>
            </div>
        </div>
        <div class="slide-image">
            <img src="public/img/affiche5.jpg" alt="affiche du film fast and furious">
            <div class="film-title-overlay">
                <p>FAST AND FURIOUS</p>
                <p>(2021)</p>
                <p>Réalisateur : Foo Bar</p>
            </div>
        </div>
    </div>
</div>



<div class="films-sortie-semaine section-title">
    <div class="titre">
        <h2>SORTIE DE LA SEMAINE :</h2>
    </div>
    <div class="voirPlusSortie">
        <a href="index.php?action=listFilms">Voir plus</a>
    </div>
    <div class="list-film">
        <?php
        $cinemaController = new \Controller\CinemaController();
        $films = $cinemaController->filmsSortieSemaine(); // Appel de la méthode pour récupérer les films
        foreach ($films as $film) {
            echo '<div class="film">
                    <a href="index.php?action=detailFilm&id=' . $film['IdFilm'] . '" title = "detail du film">
                        <div class="film-image-container">
                            <img src="' . $film['Affiche'] . '" class="film-image" alt="' . $film['Titre'] . '">
                            <div class="film-title-overlay-sortie">' . $film['Titre'] . '</div>
                        </div>
                    </a>
                </div>';
        }
        ?>
    </div>
</div>


    

    <div class="top-films-semaine section-title">
        <div class="titre">
            <h2>TOP FILMS DE LA SEMAINE :</h2>
        </div>
        <div class="voirPlusTop">
            <a href="index.php?action=listFilms">Voir plus</a>
        </div>
        
        <div class="list-film">
        <?php
        $cinemaController = new \Controller\CinemaController();
        $topFilms = $cinemaController->topFilmsSemaine(); 
        $rank = 1;
        foreach ($topFilms as $film) {
            echo '<div class="film" data-rank="' . $rank . '">
                    <span class="rank-badge">' . $rank . '</span> 
                    <a href="index.php?action=detailFilm&id=' . $film['IdFilm'] . '" title = "detail du film">
                        <div class="film-image-container">
                            <img src="' . $film['Affiche'] . '" class="film-image" alt="' . $film['Titre'] . '">
                            <div class="film-title-overlay-top">' . $film['Titre'] . '</div>
                            </a> </div>
                    
                    <div class="film-note">Note: ' . $film['Note'] . '/5</div>
                  </div>';
            $rank++;
        }
        
        ?>
       
        </div>
    </div>

    <div class="populaires-sections section-title">
        <div class="acteurs-populaires ">
            <div class="titre">
                <h2>ACTEURS LES PLUS POPULAIRES</h2>
            </div>
            
            <ul>
                <?php
                $cinemaController = new \Controller\CinemaController();
                $acteursPopulaires = $cinemaController->acteursPopulaires(); 
                foreach ($acteursPopulaires as $acteur) {
                    echo '<li><a href="index.php?action=detailActeur&id=' . $acteur['IdActeur'] . '">' . $acteur['Nom'] . ' ' . $acteur['Prenom'] . '</a></li>';
                }
                ?>
            </ul>
            <div class="voirPlusActeur">
                <a href="index.php?action=listActeur">Voir plus</a>
            </div>
        </div>

        <div class="realisateurs-populaires ">
            <div class="titre">
                <h2>REALISATEURS LES PLUS POPULAIRES</h2>
            </div>
            <ul>
                <?php
                $realisateursPopulaires = $cinemaController->realisateursPopulaires(); 
                foreach ($realisateursPopulaires as $realisateur) {
                    echo '<li><a href="index.php?action=detailRealisateur&id=' . $realisateur['IdRealisateur'] . '">' . $realisateur['Nom'] . ' ' . $realisateur['Prenom'] . '</a></li>';
                }
                ?>
            </ul>
            <div class="voirPlusRealisateur">
                <a href="index.php?action=listRealisateur">Voir plus</a>
            </div>
        </div>
    </div>

    <div class="genres-populaires section-title">
    <div class="titre">
        <h2>GENRES POPULAIRES</h2>
    </div>

    <ul>
        <?php
        $cinemaController = new \Controller\CinemaController();
        $genresPopulaires = $cinemaController->genresPopulaires(); 
        foreach ($genresPopulaires as $genre) {
            echo '<li><a href="index.php?action=detailGenre&id=' . $genre['IdGenre'] . '">' . $genre['NomGenre'].'</a></li>';
        }
        ?>
    </ul>
    <div class="voirPlusGenre ">
                <a href="index.php?action=listGenre">Voir plus</a>
            </div>
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

        <div class="social-icons">
         <a href="www.twitter.com" title = "reseau social twitter"><i class="fab fa-twitter"></i></a>
            <a href="www.facebook.com" title = "reseau social facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="www.instagram.com" title = "reseau social twitter"><i class="fab fa-instagram"></i></a>
        </div>

    </footer>


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