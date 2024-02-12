<?php ob_start(); 
?>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
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
$metaDescription = "ajouter un genre, nom du genre";

require "template.php";
?>

