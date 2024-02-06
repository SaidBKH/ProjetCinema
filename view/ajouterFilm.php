<?php ob_start(); 
?>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form action="index.php?action=ajouterFilm" method="post">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required>
    <br>

    <label for="duree">Durée en min:</label>
    <input type="number" id="duree" name="duree" required>
    <br>

    <label for="synopsis">Synopsis :</label>
     <textarea id="synopsis" name="synopsis" rows="10" cols="30" required></textarea>
    <br> 
   <!-- cols : La largeur visible du contrôle de saisie,
  rows :  Le nombre de lignes de texte visibles pour le contrôle.
  maxlength :Le nombre maximum de caractères,
minlength :Le nombre minimal de caractères, -->
   

<label for="note">Note du Film sur 5 :</label>
    <input type="number" id="note" name="note" min=0 max= 5 required>
    <br>



    <label for="affiche">Affiche :</label>
    <input type="img" id="affiche" name="affiche" required>
    <br>



    <label for="anneeSortie">Année de sortie :</label>
    <input type="number" id="anneeSortie" name="anneeSortie" min=1900 max=2024 pattern="[0-9]{4}" required>
    <br>

<!-- <select> fournit une liste déroulante  -->

    <label for="realisateur">Realisateur :</label>
    <select name="idRealisateur"  id="idRealisateur">
   
   <?php
    foreach ($reqRealisateur->fetchAll() as $realisateur) { ?>
        <option value="<?= $realisateur["IdRealisateur"] ?>"><?= $realisateur["Prenom"]." ".$realisateur["Nom"]?></option>        
    <?php }
    ?>
    </select>
    <br>
    
    <label for="genres">Genres :</label>
<?php foreach ($genres as $genre): ?>
    <input type="checkbox" id="idGenre<?= $genre['IdGenre'] ?>" name="genres[]" value="<?= $genre['IdGenre'] ?>">
    <label for="idGenre<?= $genre['IdGenre'] ?>"><?= $genre['NomGenre'] ?></label>
<?php endforeach; ?>
<br>

    <button type="submit">Ajouter</button>
</form>

<?php
$titre = "AJOUTER UN FILM";
$titre_secondaire = "AJOUTER UN FILM";
$contenu = ob_get_clean();
require "template.php";
?>

