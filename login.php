<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/reset.css">
</head>

<body class="container">
    <div class="modal" style="background-color: #EFE3D6">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #D1A577;">
                    <h5 class="modal-title" style="color: #EFE3D6;
                    font-size: 60px;
                    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                    font-weight: 400;
                    text-align: center;
                    margin-bottom: 10px; margin: 0 auto;">CONNEXION</h5>
                    <button onclick="document.location.href='index.php'" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: #D1A577">
                    <form action="login_action.php" method="post">
                        <div class="form-group">
                            <label for="mail">Identifiant :</label>
                            <input type="email" name="mail" id="mail" placeholder="you@yourmail.com" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe :</label>
                            <input type="password" name="pass" id="pass" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="captcha">Captcha :</label>
                            <input type="text" name="captcha" id="captcha" class="form-control">
                            <div class="mt-3" style="text-align: center;"><img src="captcha.php" alt="captcha"></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Se connecter" class="btn btn-info mr-1">
                            <a href="index.php" class="btn btn-warning">Homepage</a>
                        </div>
                        <?php
                        if (isset($_GET['auth']) && !empty($_GET['auth']) && $_GET['auth'] === 'false') {
                            echo '<div class="alert alert-danger">Vitre login et/ou mot de passe incorrect</div>';
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

</html>