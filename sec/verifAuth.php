<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    // HTTP_REFERER : adresse de la page qui a conduit à la page courante.
    header("location: ".$_SERVER['HTTP_REFERER']);
}
?>
