<?php ob_start(); 
?>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<form action="index.php?action=ajouterRole" method="post">
    <label for="role">role :</label>
    
    <input type="text" id="role" name="role" required>
    <br>

    <button type="submit">Ajouter</button>
</form>

<?php
$titre = "AJOUTER UN ROLE";
$titre_secondaire = "AJOUTER UN ROLE";
$metaDescription = "ajouter un role, nom du personnage";

$contenu = ob_get_clean();
require "template.php";
?>

