<?php
include_once 'db_connect_inc.php';
include_once 'functions_inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter Un Animal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animals_edit.css">
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
                    <li><a href="animals_edit.php">Ajouter un Animal</a></li>
                    <li><a href="#">Gestion des Animaux</a></li>
                    <li><a href="all_animals_list.php">Liste (complète des) Animaux</a></li>
                </ul>
            </div>
        </div>
        <div class="body-include container">
            <div class="animals_edit-title">
                <h1>AJOUTER UN ANIMAL</h1>
            </div>
            <div class="animals_edit container">
                <?php

                /*                 
                     1. Générer le formulaire qui permettra d'ajouter un nouvel hôtel à la table créee
                     creer un formulaire qui fait apparaitre les colonnes des tables Animals et Owners :
                    
                
                     2. Ecrire le script "animals_action.php" pour ajouter le continu du formulaire
                      dans la table "animals" et "owners" de la BDD
                     
                     3.Tester si on est en ajout ou en modification ANIMAL et PROPRIO (?id_a=xxx ou ?id_o=xxx)
                     - donner à chaque input sauf PHOTO les valeurs pour l'hotel correspondant à l'id
                     - gérer le bouton enregistrer (INSERT ou UPDATE) 
                     */

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
                        'photo' => '',
                    );
                    $update = false;
                }
                ?>

                <form action="animals_action.php?id_a=<?php echo ($update ? $_GET['id_a'] : ''); ?>" method="post" enctype="multipart/form-data">

                    <fieldset>
                        <legend>Informations sur l'animal :</legend>

                        <div class="group-control">
                            <label for="name">Nom de l'animal :</label>
                            <input type="text" class="form-control" pattern="[A-Za-zàâäéèëêîïôöùûü\-]{2,30}" value="<?php echo $row['name']; ?>" id="name" name="name" maxlength="50" required>
                            <?php // Ici on rajoute value pour afficher les lignes récupérées dans la BDD
                            ?>
                        </div>

                        <div class="group-control">
                            <label for="gender">Genre :</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">--- Faites votre choix ---</option>
                                <option value="F">Féminin</option>
                                <option value="M">Masculin</option>
                            </select>
                        </div>
                        <! -- gerer le enum en liste deroulante du genre -->

                            <div class="group-control">
                                <label for="dob">Date de Naissance :</label>
                                <input type="date" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" class="form-control" value="<?php echo $row['dob']; ?>" id="dob" name="dob" required>
                            </div>
                            
                            <div class="group-control">
                                <p>Générique :</p>
                                <?php
                                $sql = 'SELECT id_t, type_name FROM types';
                                $qry = $pdo->query($sql);
                                $data = $qry->fetchAll(PDO::FETCH_NUM);

                                echo createSelect('types', $data);
                                ?>
                            </div>
                            <! -- gerer le generique en liste deroulante -->

                                <div class="group-control">
                                    <label for="photo">Photo de l'animal :</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>

                    </fieldset>


                    <fieldset>
                        <legend>Informations sur le propriétaire :</legend>

                        <div class="group-control">
                            <! -- Dois-je faire appel ici à animals_edit_owners qui contient les variables de connexion à la table owners -->
                                <p>Titre</p>
                                <select name="title" id="title" class="form-control">
                                    <option value="">--- Faites votre choix ---</option>
                                    <option value="Mlle">Mlle</option>
                                    <option value="Mme">Mme</option>
                                    <option value="Mr">Mr</option>
                                </select>
                                <?php
                                //$sql = 'SELECT id_o, title FROM owners';
                                //$qry = $pdo->query($sql);
                                //$data = $qry->fetchAll(PDO::FETCH_NUM);

                                //echo createSelect('owners', $data);
                                ?>
                        </div>
                        <! -- gerer en liste deroulante Mme Mr Mlle (changer attribut et passer en enum ds BDD??) -->

                            <div class="group-control">
                                <label for="fname">Prénom :</label>
                                <input type="text" class="form-control" value="<?php echo $row['fname']; ?>" id="fname" name="fname" maxlength="50" required>
                                <?php
                                ?>
                            </div>

                            <div class="group-control">
                                <label for="name">Nom :</label>
                                <input type="text" class="form-control" value="<?php echo $row['name']; ?>" id="name" name="name">
                            </div>

                            <div class="group-control">
                                <label for="mail">Adresse E-Mail :</label>
                                <input type="email" class="form-control" value="<?php echo $row['mail']; ?>" id="mail" name="mail" required>
                            </div>

                            <div class="group-control">
                                <label for="city">Ville :</label>
                                <input type="text" class="form-control" value="<?php echo $row['city']; ?>" id="city" name="city">
                            </div>

                    </fieldset>

                    <div class="group-control mt-3">
                        <input type="submit" class="btn btn-info" value="<?php echo ($update ? 'Mettre à jour' : 'Ajouter'); ?>">
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