<?php

use Model\Connect;

 ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?>  genres</p>

<a href="index.php?action=ajouterGenre" class = ajouter>AJOUTER UN GENRE</a>
<br>


<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>GENRE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre) { ?>
            <tr>
            <td><a href="index.php?action=detailGenre&id=<?= $genre["IdGenre"]?>"><?=$genre["NomGenre"]  ?></a></td>
   

            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "LISTE DES GENRES :";
$titre_secondaire = "LISTE DES GENRES :";
$contenu = ob_get_clean() ;
require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments 
// provenant des vues



