<?php
include_once 'db_connect_inc.php';
include_once 'functions_inc.php';
include_once 'header_inc.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter Un Animal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animals_edit.css">
    <link rel="stylesheet" href="css/reset.css">
</head>

<body>
    <div class="container">
        <div class="menu">
            <div class="menu-div">
                <div class="main-nav">
                    <ul>
                        <li><a href="a_propos.php">A PROPOS</a></li>
                        <li><a href="services.php">NOS SERVICES</a></li>
                    </ul>
                </div>
                <div class="main-nav2">
                    <ul>
                        <li><a href="connexion_inscription.php"
                                style="display: <?php echo ($connected ? 'none' : '') ?>">CONNEXION</a></li>
                        <li><a href="logout.php"
                                style="display: <?php echo ($connected ? '' : 'none') ?>">DECONNEXION</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sub-nav">
            <ul>
                <li><a href="animals_list.php">Liste des Animaux</a></li>
                <li><a href="types.php">Génériques</a></li>
                <li><a href="sitters.php">Sitters</a></li>
                <li><a href="animals_edit.php" style="display: <?php echo ($connected ? '' : 'none') ?>">Ajouter un
                        Animal</a></li>
                <li><a href="owners.php" style="display: <?php echo ($connected ? '' : 'none') ?>">Propriétaires</a>
                </li>
                <li><a href="all_animals_list.php" style="display: <?php echo ($connected ? '' : 'none') ?>">Gestion des
                        Animaux</a></li>
            </ul>
        </div>
        <div class="body-include container">
            <div class="animals_edit-title">
                <h1>AJOUTER UN ANIMAL</h1>
            </div>
            <div class="animals_edit container">
                <?php
                // Si on est en mode MISE A JOUR (si id_a est dans l'URL)
                if (isset($_GET['id_a']) && !empty($_GET['id_a'])) {
                    $sql = 'SELECT * FROM animals WHERE id_a = ?';
                    $params = array($_GET['id_a']);
                    $data = $pdo->prepare($sql);
                    $data->execute($params);
                    $row = $data->fetch();
                    $update = true;
                } else {
                    $row = array(
                        'name' => '',
                        'gender' => '',
                        'dob' => '',
                        'types_id_type' => '',
                        'owners_id_own' => '',
                        'photo' => ''
                    );
                    $update = false;
                }
                ?>

                <form action="animals_action.php?id_a=<?php echo ($update ? $_GET['id_a'] : ''); ?>" method="post"
                    enctype="multipart/form-data">

                    <div class="group-control">
                        <label for="name">Nom de l'animal :</label>
                        <input type="text" class="form-control" pattern="[A-Za-zàâäéèëêîïôöùûü\-]{2,30}"
                            value="<?php echo $row['name']; ?>" id="name" name="name" maxlength="45" required>
                        <?php // Ici on rajoute value pour afficher les lignes récupérées dans la BDD
                        ?>
                    </div>

                    <div class="group-control">
                        <label for="gender">Genre :</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">--- Faites votre choix ---</option>
                            <option value="F">Femelle</option>
                            <option value="M">Mâle</option>
                        </select>
                    </div>
                    <! -- gerer le genre(enum) en liste deroulante -->

                        <div class="group-control">
                            <label for="dob">Date de Naissance :</label>
                            <input type="date" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
                                class="form-control" value="<?php echo $row['dob']; ?>" id="dob" name="dob" required>
                        </div>

                        <! -- gerer le generique en liste deroulante -->
                        <div class="group-control">
                            <p>Générique :</p>
                            <?php
                            $sql = 'SELECT id_t, type_name FROM types';
                            $qry = $pdo->query($sql);
                            $data = $qry->fetchAll(PDO::FETCH_NUM);

                            echo createSelect('types_id_type', $data); // je recupère uniquement le nom(type_name) dans la table types
                            ?>
                        </div>

                            <div class="group-control">
                                <label for="photo">Photo de l'animal :</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>

                            </fieldset>
                            <div class="group-control mt-3">
                                <input type="submit" class="btn btn-info"
                                    value="<?php echo ($update ? 'Mettre à jour' : 'Ajouter'); ?>">
                            </div>
                </form>

            </div>

        </div>

    </div>
</body>

<div class="footer">
    <div class="nav-footer">
        <ul>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 71 71">
                    <g id="facebook-icon" opacity="0.5">
                        <g id="Rectangle_6" data-name="Rectangle 6" fill="#7e6347" stroke="#707070" stroke-width="1">
                            <rect width="71" height="71" rx="23" stroke="none" />
                            <rect x="0.5" y="0.5" width="70" height="70" rx="22.5" fill="none" />
                        </g>
                        <text id="f" transform="translate(30 72)" fill="#fff" font-size="75"
                            font-family="HelveticaNeue-CondensedBold, Helvetica Neue" font-weight="700">
                            <tspan x="0" y="0">f</tspan>
                        </text>
                    </g>
                </svg>
            </a>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 71 71">
                    <g id="instagram-icon" opacity="0.497">
                        <g id="Rectangle_7" data-name="Rectangle 7" fill="#7e6347" stroke="#707070" stroke-width="1">
                            <rect width="71" height="71" rx="23" stroke="none" />
                            <rect x="0.5" y="0.5" width="70" height="70" rx="22.5" fill="none" />
                        </g>
                        <g id="Ellipse_1" data-name="Ellipse 1" transform="translate(15 16)" fill="#fff"
                            stroke="#707070" stroke-width="1">
                            <ellipse cx="21" cy="20" rx="21" ry="20" stroke="none" />
                            <ellipse cx="21" cy="20" rx="20.5" ry="19.5" fill="none" />
                        </g>
                        <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(23 24)" fill="#7e6347"
                            stroke="#707070" stroke-width="1">
                            <ellipse cx="13" cy="12" rx="13" ry="12" stroke="none" />
                            <ellipse cx="13" cy="12" rx="12.5" ry="11.5" fill="none" />
                        </g>
                        <g id="Ellipse_3" data-name="Ellipse 3" transform="translate(53 9)" fill="#fff" stroke="#707070"
                            stroke-width="1">
                            <circle cx="5" cy="5" r="5" stroke="none" />
                            <circle cx="5" cy="5" r="4.5" fill="none" />
                        </g>
                    </g>
                </svg>
            </a>
        </ul>
    </div>
    <div class="footer-contact">
        <a href="http://localhost/wordpress/">Contactez-Nous</a>
    </div>
</div>

</html>