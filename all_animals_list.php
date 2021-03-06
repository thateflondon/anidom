<?php
include_once 'header_inc.php';
include_once 'db_connect_inc.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste Complète des Animaux</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all_animals_list.css">
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
            <div class="all_animals_list-title">
                <h1>LISTE COMPLETE DES ANIMAUX</h1>
            </div>
            <div class="all_animals_list container">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrum-item mr-3"><a href="index.php">Retour au Menu</a></li>
                        <li class="breadcrum-item active">Liste Complète des Animaux</a></li>
                    </ol>
                </nav>

                <?php

                try {
                    // Préparation et exécution requête
                    //$sql = 'SELECT * FROM animals WHERE types_id_type != 0 '; //Requete Ok (mais ne renvoie pas les nom des données proprio et generique)
                    $sql = 'SELECT id_a AS "Code", a.name AS "Nom", gender AS "Genre" , dob AS "Date de Naissance", t.type_name AS "Générique", photo AS "Photo", CONCAT(o.fname, \' \',o.name) AS "Propriétaire" FROM animals a JOIN types t ON a.types_id_type = t.id_t JOIN owners o ON a.owners_id_own = o.id_o WHERE types_id_type != 0 ';
                    $data = $pdo->prepare($sql);
                    $data->execute(); // Renvoie dataset avec colonnes et lignes

                    // Crée le tableau/en-tête
                    $html = '<table class="table table-striped table-hover">'; // ouverture et fermeture du tableau(table)
                    $html .= '<thead><tr>';
                    for ($i = 0; $i < $data->columnCount(); $i++) {
                        // Affiche le nom des colonnes extraits du dataset
                        // $html .= '<th>Colonne' . ($i + 1) . '</th>';
                        $meta = $data->getColumnMeta($i);
                        $html .= '<th>' . $meta['name'] . '</th>';
                        // Stocke dans un tableau le nom de la colonne associé
                        // à son tyoe de données
                        $types[$meta['name']] = $meta['native_type'];
                    }
                    $html .= '</tr></thead>';

                    // Crée le tableau/Corps
                    $html .= '<tbody>';
                    while ($row = $data->fetch()) { // Pour chaque ligne du dataset
                        $html .= '<tr>';
                        foreach ($row as $col => $val) { // Pour chaque colonne de la ligne
                            //Teste le type de la colonne
                            switch ($types[$col]) {
                                case 'FLOAT':
                                case 'INT':
                                case 'INTEGER':
                                case 'NEWDECIMAL':
                                    $align = 'align="right"';
                                    break;
                                case 'DATE':
                                case 'DATETIME':
                                    $align = 'align="center"';
                                    break;
                                default:
                                    $align = 'align="left"';
                            }
                            // Ajoute la donnée dans sa cellule ou dans une image
                            if ($types[$col] === 'BLOB' && $val !== null) {
                                $html .= '<td><img src="' . $val . '" style="width:8em;height:4.5em"></td>';
                            } else {
                                $html .= '<td ' . $align . '>' . $val . '</td>';
                            }
                        }
                        //var_dump($html);
                        // Ajoute les bouttons MAJ et SUPPR
                        $html .= '<td><a class="btn btn-warning" href="animals_edit.php?id_a=' . $row['Code'] . '">MAJ</a></td>';
                        $html .= '<td><a class="btn btn-danger" href="animals_delete.php?id_a=' . $row['Code'] . '">SUPPR</a></td>';
                        $html .= '</tr>';
                    }
                    $html .= '</tbody>';
                    $html .= '</table>';
                    echo $html;
                } catch (PDOException $err) {
                    echo '<p class="alert alert-danger">' . $err->getMessage() . '</p>';
                }
                ?>
                <a class="btn btn-success" href="animals_edit.php">AJOUTER UN ANIMAL</a>
                <script>
                    // Branche un écouteur sur l'événement WINDOWS.ONLOAD
                    window.addEventListener(
                        'load',
                        function () {
                            // Branche écouteur sur les A.BTN-DANGER->ONCLICK
                            let buttons = document.querySelectorAll('a.btn-danger');
                            for (let i = 0; i < buttons.length; i++) {
                                buttons[i].addEventListener(
                                    'click',
                                    function (evt) {
                                        evt.preventDefault();
                                        let answer = confirm('Voulez-vous vraiment supprimer cette ligne ? Cette opération est définitive.');
                                        if (answer) {
                                            location.href = evt.target.href;
                                        }
                                    },
                                    false
                                );
                            }
                        },
                        false
                    );
                </script>
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