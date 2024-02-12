
<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) 
pour stocker le contenu dans une variable $contenu -->

<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> acteurs</p>

<a href="index.php?action=ajouterActeur" class = ajouter>AJOUTER UN ACTEUR</a>


<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>NOM</th>
            <th> PRENOM</th>
            <th> SEXE</th>
            <th> DATE DE NAISSANCE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $acteur) { ?>
            <tr>
            <td><a href="index.php?action=detailActeur&id=<?=$acteur["IdActeur"]?>"><?=$acteur["Nom"] ?></a></td>
                <td><?= $acteur["Prenom"] ?></td>
                <td><?=$acteur["Sexe"] ?></td>
                <td><?= date('d/m/Y', strtotime($acteur["DateNaissance"])) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "LISTE DES ACTEURS :";
$titre_secondaire = "LISTE DES ACTEURS :";
$contenu = ob_get_clean() ;
$metaDescription = "La liste des acteurs, nom, prenom, sexe, date de naissance" ;
require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments 
// provenant des vues