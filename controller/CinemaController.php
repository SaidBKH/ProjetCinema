<?php

//On se connecte

namespace Controller;
use Model\Connect;   //On remarquera ici l'utilisation du "use" pour accéder à la classe Connect située dans le namespace "Model"

// On exécute la requête de notre choix
class CinemaController {


    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
        SELECT film.IdRealisateur,IdFilm, Titre,Duree,AnneeSortie, CONCAT(realisateur.prenom, ' ', realisateur.Nom) AS realisateur 
        FROM film
        INNER JOIN realisateur ON film.idRealisateur = realisateur.IdRealisateur
        ORDER BY AnneeSortie DESC
        ");
    
        //On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/listfilms.php";

    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public  function detailFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
        SELECT *, CONCAT(realisateur.Prenom, ' ', realisateur.Nom) AS realisateur
        FROM film INNER JOIN realisateur ON film.IdRealisateur = realisateur.IdRealisateur
        WHERE IdFilm = :id"
        );
        $requete->execute(["id" => $id]);
        
        $requeteActeurs = $pdo->prepare("
        SELECT Acteur.IdActeur, Acteur.Nom, Acteur.Prenom, Acteur.Sexe, acteur.DateNaissance, Role.NomPersonnage
        FROM JoueDans
        INNER JOIN Acteur ON JoueDans.IdActeur = acteur.IdActeur
        INNER JOIN Role ON JoueDans.IdRole = Role.IdRole
        WHERE JoueDans.IdFilm = :id
        ");
        $requeteActeurs->execute(["id" => $id]);
        $acteurs = $requeteActeurs->fetchAll();

        $requeteGenres = $pdo->prepare("
        SELECT Genre.IdGenre,Genre.NomGenre
        FROM Appartient
        INNER JOIN Genre ON Appartient.IdGenre = Genre.IdGenre
        WHERE Appartient.IdFilm = :id
        ");
        $requeteGenres->execute(["id" => $id]);
    $genres = $requeteGenres->fetchAll();

        require "view/detailFilm.php";
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function ajouterFilm() {
    $pdo = Connect::seConnecter();

    // Récupérer la liste des réalisateurs depuis la base de données
    $reqRealisateur = $pdo->query("SELECT IdRealisateur, Nom, Prenom FROM realisateur");
    
    // Récupérer la liste des genres depuis la base de données
    $reqGenres = $pdo->query("SELECT IdGenre, NomGenre FROM genre");
   
    // Stocker la liste des genres dans un tableau
    $genres = $reqGenres->fetchAll();

    // Si un formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        
        // Récupérez les données du formulaire
        $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
        $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_SPECIAL_CHARS);
        $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_SPECIAL_CHARS);
        $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_SPECIAL_CHARS);
        $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_SPECIAL_CHARS);
        $anneeSortie = filter_input(INPUT_POST, "anneeSortie", FILTER_SANITIZE_SPECIAL_CHARS);
        $idRealisateur = filter_input(INPUT_POST, "idRealisateur", FILTER_SANITIZE_SPECIAL_CHARS);
        $idGenres = filter_input(INPUT_POST, "genres", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);


        if($titre && $duree && $synopsis && $note && $affiche && $anneeSortie && $idRealisateur && $idGenres ) {
            
        // Préparer la requête SQL pour insérer un nouveau film dans la base de données
                    
                 $requeteInsertfilm = $pdo->prepare(
                "INSERT INTO film (Titre, Duree, Synopsis, Note, Affiche, AnneeSortie, IdRealisateur)
                 VALUES (:Titre, :Duree, :Synopsis, :Note, :Affiche, :AnneeSortie, :IdRealisateur)"
                 );

        // Exécuter la requête en liant les valeurs des paramètres
                $requeteInsertfilm->execute(
                    [
                    "Titre" => $titre,
                    "Duree" => $duree,
                    "Synopsis" => $synopsis,
                    "Note" => $note,
                    "Affiche" => $affiche,
                    "AnneeSortie" => $anneeSortie,
                    "IdRealisateur" => $idRealisateur,
                
                
                ]);

        // Récupérer l'identifiant du dernier film ajouté
                $idFilm = $pdo->lastInsertId();


        // Boucler à travers les genres sélectionnés et les film dans la table de relation "Appartient"
                foreach ($idGenres as $idGenre) {
                    $pdo->prepare("INSERT INTO Appartient (IdFilm, IdGenre) VALUES (:idFilm, :idGenre)")
                        ->execute([
                        "idFilm" => $idFilm,
                        "idGenre" => $idGenre
                    ]);

                }

            header("Location: index.php?action=listFilms");die;
        }
    }

// Chargez la vue du formulaire d'ajout
    require "view/ajouterFilm.php";

 }


// /*La fonction PHP filter_input() permet d'effectuer une validation ou 
    // un nettoyage de chaque donnée transmise par le formulaire en employant divers filtres
    
    // FILTER_SANITIZE_STRING  : ce filtre supprime une chaîne de 
    // caractères de toute présence de caractères spéciaux et de toute balise HTML 
    // potentielle ou les encode. Pas d'injection de code HTML possible !
    
    // FILTER_VALIDATE_FLOAT:  validera le prix que s'il est un nombre à 
    // virgule (pas de texte ou autre…), le drapeau FILTER_FLAG_ALLOW_FRACTION est 
    // ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
    
    // FILTER_VALIDATE_INT : ne validera la quantité que si celle-ci est un 
    // nombre entier différent de zéro (qui est considéré comme nul).*/

        // $titre = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_STRING);
        // $duree = filter_input(INPUT_POST,"duree", FILTER_VALIDATE_INT);
        // $synopsis = filter_input(INPUT_POST,"synopsis", FILTER_SANITIZE_STRING);
        // $note = filter_input(INPUT_POST,"note",);
        // $affiche = filter_input(INPUT_POST,"affiche", FILTER_SANITIZE_STRING);
        // $anneeSortie = filter_input(INPUT_POST,"anneeSortie", FILTER_VALIDATE_INT);


        // // Récupérez l'ID du réalisateur à partir de son nom et prénom
        // $requeteRealisateur = $pdo->prepare("SELECT IdRealisateur FROM realisateur WHERE CONCAT(Nom, ' ', Prenom) = :realisateur");
        // $requeteRealisateur->execute(["realisateur" => $realisateurNomPrenom]);
        // $resultat = $requeteRealisateur->fetch();

        // // Si le réalisateur existe, récupérez son ID, sinon insérez dans la table realisateur et récupérez son nouvel ID
        // if ($resultat) {
        //     $idRealisateur = $resultat["IdRealisateur"];
        // } else {
        //     $requeteInsertRealisateur = $pdo->prepare("INSERT INTO realisateur (Nom, Prenom) VALUES (:nom, :prenom)");
        //     list($nom, $prenom) = explode(' ', $realisateurNomPrenom, 2);
        //     $requeteInsertRealisateur->execute(["nom" => $nom, "prenom" => $prenom]);

        //     // Récupérez l'ID du réalisateur nouvellement inséré
        //     $idRealisateur = $pdo->lastInsertId();
//         // }


//         // Ajout d'un nouveau film
//         $requete = $pdo->prepare("
//             INSERT INTO film (Titre, Duree, Synopsis, Note, Affiche, AnneeSortie, IdRealisateur)
//             VALUES (:titre, :duree, :synopsis, :Note, :affiche, :anneeSortie, :idRealisateur)
//         ");


//         $requete->execute([
//             "titre" => $titre,
//             "duree" => $duree,
//             "synopsis" => $synopsis,
//             "note" => $note,
//             "affiche" => $affiche,
//             "anneeSortie" => $anneeSortie,
//             "realisateur" => $realisateur
//         ]);
//     }

// $reqRealisateur = $pdo->query("SELECT IdRealisateur, Nom, Prenom FROM realisateur");




 ////////////////////////////////////////////////////////////////////////////////////////////////      
////////////////////////////////////////   GENRES   ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

    public  function listGenre() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT IdGenre, NomGenre
            FROM genre
            ORDER BY NomGenre
            ");
    
            require "view/listGenre.php";
    
            
    }
///////////////////////////////////////////////////////////////////////////////////////////////////

    public function detailGenre($idGenre) {
        $pdo = Connect::seConnecter();

        $requeteNomGenre = $pdo->prepare("SELECT NomGenre FROM genre WHERE IdGenre = :idGenre");
        $requeteNomGenre->execute(["idGenre" => $idGenre]);
        $nomGenre = $requeteNomGenre->fetchColumn();
        $requete = $pdo->prepare("
            SELECT film.IdRealisateur, film.IdFilm, Appartient.IdGenre, Film.IdFilm, Film.Titre, Film.Duree, Film.AnneeSortie, CONCAT(Realisateur.Prenom, ' ', Realisateur.Nom) AS realisateur 
            FROM Film
            INNER JOIN Realisateur ON Film.IdRealisateur = Realisateur.IdRealisateur
            INNER JOIN Appartient ON Film.IdFilm = Appartient.IdFilm
            WHERE Appartient.IdGenre = :idGenre
            ORDER BY Film.AnneeSortie DESC
        ");
        $requete->execute(["idGenre" => $idGenre]);
        $films = $requete->fetchAll();
    
    
        require "view/detailGenre.php";
    }

////////////////////////////////////////////////////////////////////////////////////////////////    

    public function ajouterGenre() {
        $pdo = Connect::seConnecter();
        // Si un formulaire est soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
            
            // Récupérez les données du formulaire
            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_SPECIAL_CHARS);
            
            if($genre) {
                $requeteInsertGenre = $pdo->prepare("INSERT INTO genre (NomGenre) VALUES (:NomGenre)");
                $requeteInsertGenre->execute(["NomGenre" => $genre]);

                header("Location: index.php?action=listGenre");die;
            }

            // Récupérez l'ID du Genre nouvellement inséré
            //$idGenre = $pdo->lastInsertId();
          
        }

    // Chargez la vue du formulaire d'ajout
        require "view/ajouterGenre.php";
    
     }
 ////////////////////////////////////////////////////////////////////////////////////////////////      
/////////////////////////////////////       ACTEUR   ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

public  function listActeur() {

    $pdo = Connect::seConnecter();
    $requete = $pdo->query("
        SELECT IdActeur,Nom, Prenom, Sexe, DateNaissance
        FROM acteur
        ORDER BY Nom 
        ");

        require "view/listActeur.php";

}

public function detailActeur($id) {
    $pdo = Connect::seConnecter();

    $requeteActeur = $pdo->prepare("
        SELECT *, IdActeur
        FROM acteur
        WHERE IdActeur = :id
    ");
    $requeteActeur->execute(["id" => $id]);
    $acteur = $requeteActeur->fetch();

    $requeteFilmsJoues = $pdo->prepare("
        SELECT film.IdFilm, film.Titre, film.AnneeSortie, Role.NomPersonnage
        FROM JoueDans
        INNER JOIN Film ON JoueDans.IdFilm = Film.IdFilm
        INNER JOIN Role ON JoueDans.IdRole = Role.IdRole
        WHERE JoueDans.IdActeur = :id
    ");
    $requeteFilmsJoues->execute(["id" => $id]);
    $filmsJoues = $requeteFilmsJoues->fetchAll();

    require "view/detailActeur.php";
}


public function ajouterActeur() {
    $pdo = Connect::seConnecter();
    // Si un formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        
        // Récupérez les données du formulaire
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);
        $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_SPECIAL_CHARS);

        
        if($nom && $prenom && $sexe && $dateNaissance) {
            $requeteInsertActeur = $pdo->prepare("INSERT INTO acteur (Nom,Prenom,Sexe,DateNaissance) VALUES (:Nom, :Prenom, :Sexe, :DateNaissance)");
            $requeteInsertActeur->execute(
                [
                    "Nom" => $nom,
                    "Prenom" => $prenom,
                    "Sexe" => $sexe,
                    "DateNaissance" => $dateNaissance
                ]);

            header("Location: index.php?action=listActeur");die;
        }

        // Récupérez l'ID du Genre nouvellement inséré
        //$idGenre = $pdo->lastInsertId();
      
    }

// Chargez la vue du formulaire d'ajout
    require "view/ajouterActeur.php";

 }

 ////////////////////////////////////////////////////////////////////////////////////////////////      
///////////////////////////////////       REALISATEUR     ///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


public  function listRealisateur() {

    $pdo = Connect::seConnecter();
    $requete = $pdo->query("
        SELECT IdRealisateur, Nom, Prenom
        FROM realisateur
        ORDER BY Nom 
        ");

        require "view/listRealisateur.php";

}
/////////////////////////////////////////////////////////////////////////////////////////////

public function detailRealisateur($id) {
    $pdo = Connect::seConnecter();

    $requeteRealisateur = $pdo->prepare("
        SELECT *
        FROM realisateur
        WHERE IdRealisateur = :id
    ");
    $requeteRealisateur->execute(["id" => $id]);
    $realisateur = $requeteRealisateur->fetch();

    
    $requeteFilmsRealises = $pdo->prepare("
        SELECT film.IdFilm,film.Titre, film.AnneeSortie
        FROM film
        WHERE film.IdRealisateur = :id
    ");
    $requeteFilmsRealises->execute(["id" => $id]);
    $filmsRealises = $requeteFilmsRealises->fetchAll();

    require "view/detailRealisateur.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////

public function ajouterRealisateur() {
    $pdo = Connect::seConnecter();
    // Si un formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        
        // Récupérez les données du formulaire
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
        

        
        if($nom && $prenom ) {
            $requeteInsertRealisateur = $pdo->prepare("INSERT INTO Realisateur (Nom,Prenom) VALUES (:Nom, :Prenom)");
            $requeteInsertRealisateur->execute(
                [
                    "Nom" => $nom,
                    "Prenom" => $prenom,
                    
                ]);

            header("Location: index.php?action=listRealisateur");die;
        }

        // Récupérez l'ID du Genre nouvellement inséré
        //$idGenre = $pdo->lastInsertId();
      
    }

// Chargez la vue du formulaire d'ajout
    require "view/ajouterRealisateur.php";

 }
 ////////////////////////////////////////////////////////////////////////////////////////////////      
/////////////////////////////////////       ROLES     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


public  function listRole() {

    $pdo = Connect::seConnecter();
    $requete = $pdo->query("
        SELECT IdRole,NomPersonnage
        FROM role
        ORDER BY NomPersonnage
        ");

        require "view/listRole.php";

}

////////////////////////////////////////////////////////////////////////////////////////

public function detailRole($id)
{
    $pdo = Connect::seConnecter();
    $requete = $pdo->prepare("
        SELECT Role.*, film.IdFilm, acteur.IdActeur, Acteur.Nom AS ActeurNom, Acteur.Prenom AS ActeurPrenom, Film.Titre AS NomFilm
        FROM Role
        INNER JOIN JoueDans ON Role.IdRole = JoueDans.IdRole
        INNER JOIN Acteur ON JoueDans.IdActeur = Acteur.IdActeur
        INNER JOIN Film ON JoueDans.IdFilm = Film.IdFilm
        WHERE Role.IdRole = :id
    ");
    $requete->execute(["id" => $id]);
    $roleDetails = $requete->fetchAll();

    $titre = "Détail du rôle";
    $titre_secondaire = "Détail du rôle";
    $contenu = require "view/detailRole.php";
}

////////////////////////////////////////////////////////////////////////////////////////

public function ajouterRole() {
    $pdo = Connect::seConnecter();
    // Si un formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        
        // Récupérez les données du formulaire
        $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if($role) {
            $requeteInsertRole = $pdo->prepare("INSERT INTO role (NomPersonnage) VALUES (:NomPersonnage)");
            $requeteInsertRole->execute(["NomPersonnage" => $role]);

            header("Location: index.php?action=listRole");die;
        }
      
    }

// Chargez la vue du formulaire d'ajout
    require "view/ajouterRole.php";

    }

public function ajouterCasting() {
    $pdo = Connect::seConnecter();

    // Récupérer la liste des films, acteurs et rôles
    $reqFilms = $pdo->query("SELECT IdFilm, Titre FROM film");
    $reqActeurs = $pdo->query("SELECT IdActeur, Nom, Prenom FROM acteur");
    $reqRoles = $pdo->query("SELECT IdRole, NomPersonnage FROM role");

    $films = $reqFilms->fetchAll();
    $acteurs = $reqActeurs->fetchAll();
    $roles = $reqRoles->fetchAll();

    // Si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $idFilm = filter_input(INPUT_POST, "idFilm", FILTER_SANITIZE_SPECIAL_CHARS);
        $idActeur = filter_input(INPUT_POST, "idActeur", FILTER_SANITIZE_SPECIAL_CHARS);
        $idRole = filter_input(INPUT_POST, "idRole", FILTER_SANITIZE_SPECIAL_CHARS);

        // Vérifier que les données sont présentes
        if ($idFilm && $idActeur && $idRole) {
            
            // Insérer dans la table JoueDans avec des paramètres nommés
        $requeteInsert = $pdo->prepare("INSERT INTO JoueDans (IdFilm, IdActeur, IdRole) VALUES (:idFilm, :idActeur, :idRole)");
        $requeteInsert->execute([
                        'idFilm' => $idFilm,
                        'idActeur' => $idActeur,
                        'idRole' => $idRole
]);


            
            header("Location: index.php?action=listRole"); 
            die;
        }
    }

    // Charger la vue du formulaire
    require "view/ajouterCasting.php";
}

}