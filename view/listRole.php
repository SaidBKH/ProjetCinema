<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?>  personnages</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>NOM DU PERSONNAGE</th>
         
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $role) { ?>
            <tr>
                <td><?=$role["NomPersonnage"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des roles";
$titre_secondaire = "liste des rôles";
$contenu = ob_get_clean() ;
require "view/template.php";