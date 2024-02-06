<?php ob_start(); 
?>

<form action="index.php?action=ajouterGenre" method="post">
    <label for="genre">Genre :</label>
    <input type="text" id="genre" name="genre" required>
    <br>

    <button type="submit">Ajouter</button>
</form>

<?php
$titre = "AJOUTER UN GENRE";
$titre_secondaire = "AJOUTER UN GENRE";
$contenu = ob_get_clean();
require "template.php";
?>

