<?php ob_start(); ?>


<h1><?= $nomGenre ?></h1>


<?php foreach ($films as $film): ?>
    <h2> <a href="index.php?action=detailFilm&id=<?= $film["IdFilm"] ?>"><?= $film["Titre"] ?> </a></h2>
    <p><strong>Année de sortie : </strong> <?= $film["AnneeSortie"] ?></p>
    <p><strong>Durée : </strong> <?= $film["Duree"] ?> minutes</p>
    <p><strong>Réalisateur : </strong> <a href="index.php?action=detailRealisateur&id=<?= $film["IdRealisateur"] ?>"> <?= $film["realisateur"] ?></a></p>
<?php endforeach; ?>

<?php
$titre = "DETAILS DES FILMS PAR GENRE";
$titre_secondaire = "DETAILS DES FILMS PAR GENRE";
$contenu = ob_get_clean();
require "view/template.php";
?>
