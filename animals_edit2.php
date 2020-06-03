<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="container">
    <h1>Formulaire d'inscription</h1>
    <!-- Modèles de patterns : http://html5pattern.com/ -->
    <form action="animal_formulaire_action.php" method="post">
        <div class="form-group">
            <label for="nom_propre">Nom propre :</label>
            <input type="text" id="nom_propre" name="nom_propre" class="form-control" maxlength="30" pattern="[A-Za-zàâäéèëêîïôöùûü\-]{2,30}" required>
        </div>
        <div class="group-control">
            <label for="photo">Photo de l'animal :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <div class="form-group">
            <label for="id_generique">Entrez le id de la table générique :</label>
            <input type="number" id="id_generique" name="id_generique" class="form-control"  required>
        </div>
        <div class="form-group">
            <label for="id_proprietaire">Entrez le id de la table propriétaire :</label>
            <input type="number" id="id_proprietaire" name="id_proprietaire" class="form-control"  required>
        </div>
        <div class="form-group">
            <label for="nom_generique">Nom générique :</label>
            <input type="text" id="nom_generique" name="nom_generique" class="form-control" maxlength="30" pattern="[A-Za-zàâäéèëêîïôöùûü\-]{2,30}" required>
        </div>
        <div class="form-group">
            <label for="titre">Titre :</label>
            <select name="titre" id="titre" class="form-control">
                <option value="M.">M.</option>
                <option value="Mlle">Mlle</option>
                <option value="Mme">Mme</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nom_proprietaire">Nom propriétaire :</label>
            <input type="text" id="nom_proprietaire" name="nom_proprietaire" class="form-control" maxlength="30" pattern="[A-Za-zàâäéèëêîïôöùûü\-]{2,30}" required>
        </div>
        <div class="form-group">
            <label for="prenom_proprietaire">Prénom propriétaire :</label>
            <input type="text" id="prenom_proprietaire" name="prenom_proprietaire" class="form-control" maxlength="30" pattern="[A-Za-zàâäéèëêîïôöùûü\-]{2,30}" required>
        </div>
        <input type="submit" value="Valider" class="btn btn-info">
    </form>
    <?php
    echo '<a href="bdd_animal_list.php">Administrer la base de données</a>';
    ?>
</body>

</html>