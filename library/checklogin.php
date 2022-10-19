<?php

include('sessions.php');
dalo_session_start();

if (!array_key_exists('daloradius_logged_in', $_SESSION)
    || $_SESSION['daloradius_logged_in'] !== true) {
    $_SESSION['daloradius_logged_in'] = false;
    header('Location: login.php');
    exit;
}

?>
