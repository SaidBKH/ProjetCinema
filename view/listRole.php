<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?>  personnages</p>

<a href="index.php?action=ajouterRole" class = ajouter>AJOUTER UN ROLE </a>


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
                <td><a href="index.php?action=detailRole&id=<?=$role["IdRole"]?>"><?=$role["NomPersonnage"] ?></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "LISTE DES ROLES";
$titre_secondaire = "LISTE DES ROLES";
$contenu = ob_get_clean() ;
require "view/template.php";