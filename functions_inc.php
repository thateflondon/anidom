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