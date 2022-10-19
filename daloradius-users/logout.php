<?php
    include('library/sessions.php');
    dalo_session_start();
    dalo_session_destroy();
    header('Location: login.php');
?>
