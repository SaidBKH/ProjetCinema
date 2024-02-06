
<?php ob_start(); ?>

<form action="index.php?action=ajouterCasting" method="post">

    <label for="idFilm">Film :</label>
    <select name="idFilm" id="idFilm" required>
       
        <?php foreach ($films as $film): ?>
            <option value="<?= $film['IdFilm'] ?>"><?= $film['Titre'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="idActeur">Acteur : </label>
    <select name="idActeur" id="idActeur" required>
        <?php foreach ($acteurs as $acteur): ?>
            <option value="<?= $acteur['IdActeur'] ?>"><?= $acteur['Prenom'] . ' ' . $acteur['Nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="idRole">Role :</label>
    <select name="idRole" id="idRole" required>
        <?php foreach ($roles as $role): ?>
            <option value="<?= $role['IdRole'] ?>"><?= $role['NomPersonnage'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <button type="submit">Ajouter</button>
</form>

<?php
$titre = "AJOUTER UN CASTING";
$titre_secondaire = "AJOUTER UN CASTING";
$contenu = ob_get_clean();
require "template.php";
?>
