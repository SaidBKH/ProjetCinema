<?php ob_start(); 
?>

<form action="index.php?action=ajouterActeur" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <br>
    <label for="prenom">Prenom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <select name="sexe" id="sexe">
       <option value="M">Masculin</option>
       <option value="F">Féminin</option>

    </select>
    <br>

    <label for="dateNaissance"> Date de Naissance :</label>
    <input type="date" id="dateNaissance" name="dateNaissance" required>

    <button type="submit">Ajouter</button>
</form>

<?php
$titre = "AJOUTER UN ACTEUR";
$titre_secondaire = "AJOUTER UN ACTEUR";
$contenu = ob_get_clean();
require "template.php";
?>

