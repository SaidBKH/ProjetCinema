<?php ob_start(); 
?>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form action="index.php?action=ajouterRealisateur" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <br>
    <label for="prenom">Prenom :</label>
    <input type="text" id="prenom" name="prenom" required>   
    <br>

    <button type="submit">Ajouter</button>
</form>

<?php
$titre = "AJOUTER UN REALISATEUR";
$titre_secondaire = "AJOUTER UN REALISATEUR";
$contenu = ob_get_clean();
$metaDescription = "ajouter un réalisateur, nom realisateur, prenom realisateur";

require "template.php";
?>

