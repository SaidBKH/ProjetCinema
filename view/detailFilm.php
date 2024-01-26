<?php ob_start(); ?>


        <?php
echo $film ["Titre"];



$titre = "detail du film";
$titre_secondaire = "detail du film";
$contenu = ob_get_clean() ;
require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments 
// provenant des vues