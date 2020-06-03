<?php
include_once 'header_inc.php'; // Restauration et Test de la connexion
include_once 'constants_inc.php'; // Import des constantes de connexion à la BDD
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des animaux</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animals_list.css">
    <link rel="stylesheet" href="css/reset.css">
</head>

<body>
    <div class="">
        <!--container désactivé pour avoir le bckgr sur tout la largeur, adapter le footer-->
        <div class="menu container">
            <div class="main-nav">
                <ul>
                    <li><a href="a_propos.php">A PROPOS</a></li>
                    <li><a href="services.php">NOS SERVICES</a></li>
                    <li><a href="connexion_inscription.php">CONNEXION</a></li>
                </ul>
            </div>
            <div class="sub-nav">
                <ul>
                    <li><a href="animals_list.php">Liste des Animaux</a></li>
                    <li><a href="types.php">Génériques</a></li>
                    <li><a href="#">Propriétaires</a></li>
                    <li><a href="#">Ajouter un Animal</a></li>
                    <li><a href="#">Gestion des Animaux</a></li>
                    <li><a href="#">Liste Animaux</a></li>
                </ul>
            </div>
        </div>
        <div class="body-include container">
            <div class="animals_list-title">
                <h1>LISTE DES ANIMAUX</h1>
            </div>
            <div class="animals_list container">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrum-item mr-3"><a href="index.php">Retour au Menu</a></li>
                        <li class="breadcrum-item active">Liste des Animaux</li>
                    </ol>
                </nav>

                <?php
                try {
                    // Connexion à BDD
                    $dsn = 'mysql:host=' . HOST . ';dbname=' . BASE . ';charset=utf8';
                    $opt = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    );
                    $pdo = new PDO($dsn, USER, PASS, $opt);

                    // Exécution requête SQL
                    $sql = 'SELECT id_a, name, gender, dob, photo, type_name FROM animals JOIN types ON types_id_type = id_t';

                    // Si parametre TYPE_NAME est passé dans l'URL alors on filtre
                    if (isset($_GET['type_name']) && !empty($_GET['type_name'])) {
                    $sql .= " WHERE type_name='".$_GET['type_name']."'";
                    }
                    $data = $pdo->query($sql);
                ?>

                <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Genre</th>
                        <th>Date de Naissance</th>
                        <th>Photo</th>
                        <th>Générique</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <?php
                foreach ($data as $row) {
                echo '<tr>';
                foreach ($row as $col) {
                    echo '<td>' . $col . '</td>';
                }
                echo '</tr>';
                }
                } catch (PDOException $err) {
                echo '<div class="alert alert-danger">' . $err->getMessage() . '</div>';
                }    
                ?>
                </table>
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
                        <text id="f" transform="translate(30 72)" fill="#fff" font-size="75" font-family="HelveticaNeue-CondensedBold, Helvetica Neue" font-weight="700">
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
                        <g id="Ellipse_1" data-name="Ellipse 1" transform="translate(15 16)" fill="#fff" stroke="#707070" stroke-width="1">
                            <ellipse cx="21" cy="20" rx="21" ry="20" stroke="none" />
                            <ellipse cx="21" cy="20" rx="20.5" ry="19.5" fill="none" />
                        </g>
                        <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(23 24)" fill="#7e6347" stroke="#707070" stroke-width="1">
                            <ellipse cx="13" cy="12" rx="13" ry="12" stroke="none" />
                            <ellipse cx="13" cy="12" rx="12.5" ry="11.5" fill="none" />
                        </g>
                        <g id="Ellipse_3" data-name="Ellipse 3" transform="translate(53 9)" fill="#fff" stroke="#707070" stroke-width="1">
                            <circle cx="5" cy="5" r="5" stroke="none" />
                            <circle cx="5" cy="5" r="4.5" fill="none" />
                        </g>
                    </g>
                </svg>
            </a>
        </ul>
    </div>
    <div class="footer-contact">
        <a href="#">Contactez-Nous</a>
    </div>
</div>
</body>

</html>