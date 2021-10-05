<?php
include_once 'db_connect_inc.php'; //connexion à la BDD
include_once 'header_inc.php'; //Vérification de l'état de connexion

// //Get HEROKU ClearDB connection informations
// $cleardb_url = parse_url(getenv('CLEAR_DATABASE_URL'));
// $cleardb_server = $cleardb_url['host'];
// $cleardb_username = $cleardb_url['user'];
// $cleardb_password = $cleardb_url['password'];
// $cleardb_db = substr($cleardb_url['path'], 1);

// $active_group = 'default';
// $query_builder = TRUE;

// //Connect to the DB
// $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
// echo "Hello i'm connected to heroku";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petsitter</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="menu">
            <div class="menu-div">
                <div class="main-nav">
                    <ul id="hover">
                        <li><a href="a_propos.php">A PROPOS</a></li>
                        <li><a href="services.php">NOS SERVICES</a></li>
                    </ul>
                </div>
                <div class="main-nav2">
                    <ul id="hover">
                        <li><a href="connexion_inscription.php" style="display: <?php echo ($connected ? 'none' : '') ?>">CONNEXION</a></li>
                        <li><a href="logout.php" style="display: <?php echo ($connected ? '' : 'none') ?>">DECONNEXION</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sub-nav">
            <ul id="hover">
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
        <script>
            let hover = document.getElementById("hover");

            // Ce gestionnaire sera exécuté à chaque fois que le curseur
            // se déplacera sur un élément de la liste
            hover.addEventListener("mouseover", function(event) {
                // on met l'accent sur la cible de mouseover
                event.target.style.color = "orange";

                // on change la couleur après quelques instants
                setTimeout(function() {
                    event.target.style.color = "black";
                }, 300);
            }, false);
        </script>
        <div class="home-title">
            <h1>PETSITTER</h1>
            <h2>GARDE D’ANIMAUX</h2>
            <h3>Ici ils sont Rois !</h3>
        </div>
    </div>

    </div>

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
            <a href="http://localhost/wordpress/">Contactez-Nous</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>


</html>