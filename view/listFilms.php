<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>




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
        <?php
            foreach($requete->fetchAll() as $film) { ?> 
            <tr>
                <td><a href="index.php?action=detailFilm"><?=$film["Titre"]  ?></a></td>
                <td><?= $film["Duree"] ?></td>
                <td><?= $film["AnneeSortie"] ?></td>
                <td><?= $film["realisateur"] ?></td>
                

            </tr>
           
        <?php } ?>

    </tbody>
</table>

<?php


$titre = "Liste des films";
$titre_secondaire = "liste des films";
$contenu = ob_get_clean() ;
require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments 
// provenant des vues