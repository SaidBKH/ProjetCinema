<?php

//On se connecte

namespace Controller;
use Model\Connect;   //On remarquera ici l'utilisation du "use" pour accéder à la classe Connect située dans le namespace "Model"

// On exécute la requête de notre choix
class CinemaController {

    /* Lister les films */

    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
        SELECT Titre,Duree,AnneeSortie, CONCAT(realisateur.prenom, ' ', realisateur.Nom) AS realisateur 
        FROM film
        INNER JOIN realisateur ON film.idRealisateur = realisateur.IdRealisateur
        ORDER BY AnneeSortie DESC
        ");

        
        //On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/listfilms.php";

    }

    public  function detailFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare(" SELECT * FROM film Where idFilm= :id");
        $requete->execute(["id" -> $id]);
        require "view/detailFilm.php";
    }

public  function listActeur() {

    $pdo = Connect::seConnecter();
    $requete = $pdo->query("
        SELECT Nom, Prenom, Sexe, DateNaissance
        FROM acteur
        ORDER BY Nom 
        ");

        require "view/listActeur.php";

}


public  function listRealisateur() {

    $pdo = Connect::seConnecter();
    $requete = $pdo->query("
        SELECT Nom, Prenom
        FROM realisateur
        ORDER BY Nom 
        ");

        require "view/listRealisateur.php";

}

public  function listGenre() {

    $pdo = Connect::seConnecter();
    $requete = $pdo->query("
        SELECT NomGenre
        FROM genre
        ORDER BY NomGenre
        ");

        require "view/listGenre.php";

}

public  function listRole() {

    $pdo = Connect::seConnecter();
    $requete = $pdo->query("
        SELECT NomPersonnage
        FROM role
        ORDER BY NomPersonnage
        ");

        require "view/listRole.php";

}

}