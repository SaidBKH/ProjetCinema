

<?php ob_start(); ?>


<?php foreach ($roleDetails as $roleDetail): ?>

    <p><strong>Nom du personnage : </strong><a href="index.php?action=detailRole&id=<?= $roleDetail["IdRole"] ?>"><?= $roleDetail["NomPersonnage"] ?> </a></p>
    <p><strong>Acteur : </strong> <a href="index.php?action=detailActeur&id=<?= $roleDetail["IdActeur"] ?>"> <?= $roleDetail["ActeurPrenom"]." ".$roleDetail["ActeurNom"] ?> </a></p>
    <p><strong>Film :</strong> <a href="index.php?action=detailFilm&id=<?= $roleDetail["IdFilm"] ?>"> <?= $roleDetail["NomFilm"] ?></a></p>
<br>
<?php endforeach; ?>

<?php

$titre = "DETAILS DU ROLE";
$titre_secondaire = "DETAILS DU ROLE";
$contenu = ob_get_clean();
$metaDescription = "Les details du role ".$roleDetail["NomPersonnage"]."".$roleDetail["ActeurPrenom"]." ".$roleDetail["ActeurNom"]."".$roleDetail["NomFilm"]."";

require "view/template.php";
