<?php
function createSelect($id, $array, $val = '')
{
    $html = '<select class="form-control" id="' . $id . '" name="' . $id . '">';
    $html .= '<option value="">--- choisir une valeur ---</option>';
    foreach ($array as $row) {
        $html .= '<option value="' . $row[0] . '" ' . ($row[0] == $val ? 'selected' : '') . '>' . $row[1] . '</option>';
    }
    $html .= '</select>';
    return $html;
}
?>

<?php
/**
 * Génère un mot de passe aléatoire basé sur un dico de caractères
 * @param {int} $len - taille en caractères du mot de passe
 * @return {string} mot de passe généré
 */
function get_password($len=8) : string {
    $dico = 'abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789_&@$*';
    $pass = str_shuffle($dico);
    $pass = substr($pass, 0, $len);
    return $pass;
}

//echo get_password(11); pour afficher le résultat et tester la fonction
?>