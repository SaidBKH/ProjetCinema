<?php ob_start();

$film = $requete->fetch();
?>

<h2><?= $film["Titre"] ?></h2>
<p><strong>Année de sortie : </strong> <?= $film["AnneeSortie"] ?></p>
<p><strong>Durée : </strong> <?= $film["Duree"] ?> minutes</p>
<p><strong>Réalisateur : </strong> <a href="index.php?action=detailRealisateur&id=<?= $film["IdRealisateur"] ?>"><?= $film["realisateur"] ?></a></p>
<p><strong>Synopsis : </strong> <?= $film["Synopsis"] ?></p>
<p><strong>Affiche : </strong> <br>  <figure> <img src="<?= $film["Affiche"] ?>" alt=""></p></figure>

<h3>Acteurs :</h3>
<ul>
    <?php foreach ($acteurs as $acteur): ?>
        <li><a href="index.php?action=detailActeur&id=<?= $acteur["IdActeur"] ?>"><?= $acteur["Nom"]." ".$acteur["Prenom"]." ".$acteur["NomPersonnage"] ?></a></li>
    <?php endforeach; ?>
</ul>

<h3>Genres:</h3>
<ul>
    <?php foreach ($genres as $genre): ?>
        <li><a href="index.php?action=detailGenre&id=<?= $genre["IdGenre"] ?>"><?= $genre["NomGenre"] ?></a></li>
    <?php endforeach; ?>
</ul>

<?php
$titre = "DETAILS DU FILM";
$titre_secondaire = "DETAILS DU FILM";
$contenu = ob_get_clean();
require "view/template.php";
?>
