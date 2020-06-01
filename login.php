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
    <link rel="stylesheet" href="css/login.css">
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
            <div class="connexion-title">
                <h1>CONNEXION</h1>
            </div>
            <div class="connexion container">
                <div class="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Connexion</h5>
                                <button class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="login_action.php" method="post">
                                    <div class="form-group">
                                        <label for="mail">Identifiant :</label>
                                        <input type="email" name="mail" id="mail" placeholder="you@yourmail.com"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Mot de passe :</label>
                                        <input type="password" name="pass" id="pass" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="captcha">Captcha :</label>
                                        <input type="text" name="captcha" id="captcha" class="form-control">
                                        <div class="mt-3"><img src="captcha.php" alt=""></div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Se connecter" class="btn btn-info mr-1">
                                        <a href="index.php" class="btn btn-warning">Homepage</a>
                                    </div>
                                    <?php
                                        if (isset($_GET['auth']) && !empty($_GET['auth']) && $_GET['auth'] === 'false') {
                                            echo '<div class="alert alert-danger">Login et/ou mot de passe incorrect</div>';
                                        }
                                        //var_dump($_GET);
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(
                            function () {
                                $('.modal').modal('show');
                            }
                        );
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Connexion</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="login_action.php" method="post">
                        <div class="form-group">
                            <label for="mail">Identifiant :</label>
                            <input type="email" name="mail" id="mail" placeholder="you@yourmail.com" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe :</label>
                            <input type="password" name="pass" id="pass" required>
                        </div>
                        <div class="form-group">
                            <label for="captcha">Captcha :</label>
                            <input type="text" name="captcha" id="captcha" class="form-control">
                            <div class="mt-3"><img src="captcha.php" alt=""></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Se connecter" class="btn btn-info mr-1">
                            <a href="index.php" class="btn btn-warning">Homepage</a>
                        </div>
                        <?php
                        if (isset($_GET['auth']) && !empty($_GET['auth']) && $_GET['auth'] === 'false') {
                            echo '<div class="alert alert-danger">Login et/ou mot de passe incorrect</div>';
                        }
                        //var_dump($_GET);
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(
                function() {
                    $('.modal').modal('show');
                }
            );
        </script>
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
        <a href="#">Contactez-Nous</a>
    </div>
</div>

</html>