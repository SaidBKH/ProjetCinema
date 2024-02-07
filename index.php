<?php

// On "use" le controller Cinema
use Controller\CinemaController;

// On autocharge les classes du projet
spl_autoload_register(function ($class_name){
    // Remplace les antislashs par des slashs pour obtenir le chemin du fichier
    require str_replace("\\","/", $class_name) . ".php";
});

// On instancie le controller Cinema
$ctrlCinema = new CinemaController();

// En fonction de l'action détectée dans l'URL via la propriété "action", on interagit 
// avec la bonne méthode du controller

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "listFilms" :
            $ctrlCinema->listFilms();
            break;

        case "detailFilm" :
            $ctrlCinema->detailFilm($id);
            break;

        case "listRealisateur" :
            $ctrlCinema->listRealisateur();
            break;

        case "detailRealisateur" :
            $ctrlCinema->detailRealisateur($id);
            break;

        case "listRole" :
            $ctrlCinema->listRole();
            break;

        case "detailRole" :
            $ctrlCinema->detailRole($id);
            break;

        case "listActeur" :
            $ctrlCinema->listActeur();
            break;

        case "detailActeur" :
            $ctrlCinema->detailActeur($id);
            break;

        case "listGenre" :
            $ctrlCinema->listGenre();
            break;

        case "detailGenre" :
            $ctrlCinema->detailGenre($id);
            break;

        case "ajouterFilm":
            $ctrlCinema->ajouterFilm($id); 
            break;

        case "ajouterGenre":
            $ctrlCinema->ajouterGenre($id); 
            break;
        
            case "ajouterRole":
                $ctrlCinema->ajouterRole($id); 
                break;
                
            case "ajouterActeur":
                $ctrlCinema->ajouterActeur($id); 
                break;
             
            case "ajouterRealisateur":
                $ctrlCinema->ajouterRealisateur($id); 
                break;
            
            case "ajouterCasting":
                $ctrlCinema->ajouterCasting($id); 
                break;
               
    }
}

if (!isset($_GET["action"]) || $_GET["action"] === "homePage") {
    require "view/homePage.php";
}
?>

