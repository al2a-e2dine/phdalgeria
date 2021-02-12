<?php 
function getInfoById($type, $id)
{
    $dbc = mysqli_connect('localhost', 'root', '', 'phdalgeria');
    mysqli_set_charset($dbc, "utf8");
    $q = "SELECT * FROM $type WHERE id='$id'";
    $r = mysqli_query($dbc, $q);
    if ($r) {
        return mysqli_fetch_assoc($r);
    } else {
        return mysqli_error($dbc);
    }
}
 ?>