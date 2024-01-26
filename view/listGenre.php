<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?>  genres</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre) { ?>
            <tr>
                <td><?=$genre["NomGenre"] ?></td>          
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des genres";
$titre_secondaire = "liste des genres";
$contenu = ob_get_clean() ;
require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments 
// provenant des vues