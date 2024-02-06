<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

<a href="index.php?action=ajouterFilm" class = ajouter>AJOUTER UN FILM</a>
<br>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>DUREE</th>
            <th> ANNEE DE SORTIE</th>
            <th>NOM DU REALISATEUR</th>       
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requete->fetchAll() as $film) { ?> 
            <tr>
                <td><a href="index.php?action=detailFilm&id=<?= $film["IdFilm"]?>"><?=$film["Titre"]  ?></a></td>
                <td><?= $film["Duree"] ?></td>
                <td><?= $film["AnneeSortie"] ?></td>
                <td> <a href="index.php?action=detailRealisateur&id=<?= $film["IdRealisateur"]?>"><?= $film["realisateur"] ?></td>                  
            </tr>
        <?php } 
        ?>


    </tbody>
</table>

<?php

$titre = "LISTE DES FILMS :";
$titre_secondaire = "LISTE DES FILMS :";
$contenu = ob_get_clean();
require "view/template.php";
