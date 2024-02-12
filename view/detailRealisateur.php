<?php ob_start();
?>

<h3>Films réalisés : </h3>
<ul>
    <?php foreach ($filmsRealises as $film): ?>
        <li><a href="index.php?action=detailFilm&id=<?= $film["IdFilm"] ?>"><?= $film["Titre"]." (".$film["AnneeSortie"].")" ?></a></li>
    <?php endforeach; ?>
</ul>

<?php
$titre = "DETAILS DU REALISATEUR";
$titre_secondaire = $realisateur["Nom"]." ".$realisateur["Prenom"];
$contenu = ob_get_clean();
$metaDescription = "Les films du realisateur ".$realisateur["Nom"]." ".$realisateur["Prenom"]."";

require "view/template.php";
?>
