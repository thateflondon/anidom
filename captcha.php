<?php
// 1. Taille du captcha : 6 caractères
define('LENGTH', 4);

// 2. Crée les tableaux de caractères pour générer le captcha
$num = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);  // archaïque
$lower = range('a', 'z'); // plage de valeurs (alphabet et nombres)
$upper = range('A', 'Z');
$symbol = array('*', '$', '+', '&', '!'); //on rajoute des caractères pour renforcer et améliorer les possibilités
$mix = array_merge($num, $lower, $upper, $symbol); // fusionne les 4 tableaux précédents
shuffle($mix);

// 3. Pioche 6 caractères au hasard dans le tableau MIX
$captcha = '';
for ($i = 0; $i < LENGTH; $i++){
    $captcha .= $mix[rand(0, count($mix) - 1)]; //on rajoute -1 car on part de la position zero(0)
}

// 4. Stocke la valeur du captcha dans une variable de session
session_start();
$_SESSION['captcha'] = $captcha;

// 5. Ecrit le captcha dans une image générée par GD
$zd = imagecreatetruecolor(160, 90);
$pen = imagecolorallocate($zd, 230, 230, 230); //couleur crayon
$back = imagecolorallocate($zd, 23, 23, 23); //fond
$font = 'fonts/MISTRAL.TTF'; // police de caractère
imagefilledrectangle($zd, 0, 0, 160, 90, $back);
imagettftext($zd, 30, 20, 30, 70, $pen, $font, $captcha);

// 6. Renvoie l'image au format PNG (donc binaire !!!)
header('content-type:image/png');
imagepng($zd);
imagedestroy($zd);
?>