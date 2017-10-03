<?php

$uploaddir = '../img/';
$uploadfile = $uploaddir . $_FILES['couverture']['name'];

if (move_uploaded_file($_FILES['couverture']['tmp_name'], $uploadfile)) {
    header("Location: ../index.php?choix=admin");
    die();
} else {
    echo 'Erreur upload impossible.';
    header("Location: ../index.php");
    die();
}

?>
