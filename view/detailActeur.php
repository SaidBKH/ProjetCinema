
<?php ob_start(); ?>

<h2>Détail de l'acteur</h2>

<p><strong>Nom:</strong> <?= $acteur["Nom"] ?></p>
<p><strong>Prénom:</strong> <?= $acteur["Prenom"] ?></p>
<p><strong>Sexe:</strong> <?= $acteur["Sexe"] ?></p>
<p><strong>Date de naissance: </strong><?= date('d/m/Y', strtotime($acteur["DateNaissance"])) ?></td></p>


<h3>Films joués:</h3>
<ul>
    <?php foreach ($filmsJoues as $filmJoue): ?>
        <li>
        <a href="index.php?action=detailFilm&id=<?= $filmJoue["IdFilm"] ?>"> <?=  $filmJoue["Titre"]." ".$filmJoue["AnneeSortie"]." ".$filmJoue["NomPersonnage"] ?> </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php
$titre = "DETAILS DE L'ACTEUR";
$titre_secondaire = $acteur["Prenom"]." ".$acteur["Nom"];
$contenu = ob_get_clean();
require "view/template.php";
