<?php
include_once 'functions_inc.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste Complète des Animaux</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="sitters.css">
    <link rel="stylesheet" href="css/reset.css">
</head>

<body>
    <div class="">
        <!--container désactivé pour avoir le bckgr sur tout la largeur, adapter le footer-->
        <div class="menu">
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
                    <li><a href="animals_edit.php">Ajouter un Animal</a></li>
                    <li><a href="#">Gestion des Animaux</a></li>
                    <li><a href="all_animals_list.php">Liste (complète des) Animaux</a></li>
                </ul>
            </div>
        </div>
        <div class="body-include container">
            <div class="sitters-title">
                <h1>SITTERS</h1>
            </div>
            <div class="sitters container">
                <div class="row">
                    <div class="card p-3 m-3" style="width:15rem;">
                        <h5 class="card-title">Lesly</h5>
                        <p class="card-text"><strong>Age : </strong>35 ans</p>
                        <p class="card-text"><strong>Manager : </strong>Oui</p>
                        <p class="card-text"><strong>Salaire : </strong>52 K€</p>
                    </div>

                    <?php
                    // 1. Reproduire le CARD ci-dessus pour tous les membres du tableau $TEAM
                    // 2. Afficher FNAME, DOB, OUI si manager = true sinon NON, (SALARY*12)/1000 arrondi à l'entier supérieur (CEIL)
                    // 3. Ecrire deux classes css: .manger (fond bleu clair) / .clerk(fond vert clair)
                    // 4. Trier les données par SALARY
                    usort($team, 'compare');


                    $html = '';
                    foreach ($team as $member) {
                        $html .= '<div class="card p-3 m-3 ' . ($member['manager'] ? 'manager' : 'clerk') . '"style="width:15rem;">';
                        $html .= '<h5 class="card-title">' . $member['fname'] . '</h5>';
                        $html .= '<p class="card-text"><strong>Age : </strong>' . age($member['dob'], date('Y-m-d')) . 'ans</p>'; //Age à venir
                        $html .= '<p class="card-text"><strong>Manager : </strong>' . (($member['manager']) ? 'Oui' : 'Non') . '</p>';
                        $html .= '<p class="card-text"><strong>Salaire : </strong>' . ceil(($member['salary'] * 12) / 1000) . ' K€</p>';
                        $html .= '</div>';
                    }
                    echo $html;

                    ?>
                </div>
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

</html>