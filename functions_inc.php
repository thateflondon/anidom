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

<?php
/**
 * Renvoie l'âge en années entre deux dates passées en paramètre
 * RG1 : tenir copte du fait que la différence entre les 2 dates soit positive
 * RG2 : s'assurer que les deux arguments sont bien des dates
 * RG3 : arrondir le résultat à l'entier inférieur
 * EXEMPLE : age('11-11-1967', date('d/m/Y'))
 * @param {string} $date1 - une date  (dd-mm-yyyy ou dd/mm/yyyy)
 * @param {string} $date2 - une autre date (dd-mm-yyyy ou dd/mm/yyyy)
 * @return {int} âge en années
 */

 function age($date1, $date2) : int {
    // Règles de gestion
    $d1 = strtotime($date1);
    $d2 = strtotime($date2);

    if ($d1 > $d2) {
        $gap = $d1 - $d2;
    } elseif ($d1 < $d2) {
        $gap = $d2 - $d1;
    } else {
        $gap = 0;
    }

    // Renvoie le résultat
    $res = floor($gap / 365.25 / 24 / 60 / 60);
    return (int) $res;
 }

/**
 * Fonction à utiliser avec USORT pour trier les données dans un tableau
 * @param $a - Premier élément à comparer
 * @param $b - Second élément à comparer 
 * @return {int}
 */

 function compare($a, $b)
 {
     return strcmp($a['salary'], $b['salary']);
 }

 
  /**
   * Fonction qui convertit un montant HT en TTC via un TAUX précis
   * @param {float} $ht - Montant HT à convertir en TTC
   * @param {float} $taux - Taux de TVA au format : 0.055, 0.1 ou 0.2
   * @return {float} Montant TTC
   * RG1 : Le montant HT doit être un nombre positif
   * RG2 : Le taux doit être l'une des valeurs suivantes : 0.555, 0.1 ou 0.2
   * Si une RG n'est pas respectée alors lever une erreur TRIGGER_ERROR
   */

   function ttc ($ht, $taux=0.2) : float {
    //2. Tests vs RG
    if ($ht < 0) {
        // trigger_error('<p>Le montant HT doit être positif');
        throw new Exception ('Le montant HT doit être positif', 1234);
    } elseif ($taux !== 0.055 && $taux !== 0.1 && $taux !== 0.2) {
        // trigger_error('<p>Le taux doit être : 0.055, 0.1 ou 0.2');
        throw new Exception ('Le taux doit être : 0.055, 0.1 ou 0.2');
    } else {
    //1. Renvoie le resultat
       $result =$ht * (1 + $taux);
       return $result;
   }
}
?>