<?php

// On "use le controller Cinema
use Controller\CinemaController;

// on autocharge les classes du projet
spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

// On instancie le controller Cinema
$ctrlCinema = new CinemaController();

// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit 
// avec la bonne méthode du controller

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type"]))  ? $_GET["type"] : null;
 
if(isset($_GET["action"])){
    switch ($_GET["action"]){

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;

        case "listActeur" : $ctrlCinema->listActeur(); break;
       case "detailActeur" : $ctrlCinema->detailActeur($id); break;

       case "listRealisateur" : $ctrlCinema->listRealisateur(); break;
       case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;

       case "listGenre" : $ctrlCinema->listGenre(); break;
       case "detailGenre" : $ctrlCinema->detailGenre($id); break;

       case "listRole" : $ctrlCinema->listRole(); break;
       case "detailRole" : $ctrlCinema->detail($id); break;

    }
}
?>


