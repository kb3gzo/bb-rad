<?php

// BB-RAD session start function support timestamp management
function dalo_session_start() {
    ini_set('session.use_strict_mode', 0);
    session_start();
    
    if (array_key_exists('deleted_time', $_SESSION)) {
        $t = $_SESSION['deleted_time'];
    
        // if too old, destroy and restart
        if (!empty($t) && $t < time()-900) {
            session_destroy();
            session_start();
        }
    }
}

// BB-RAD session regenerate id function
// should be used at least on login and logout
function dalo_session_regenerate_id() {
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    $session_id = (function_exists('session_create_id'))
        ? session_create_id('BB-RAD-') : uniqid('BB-RAD-');
    
    $_SESSION['deleted_time'] = time();
    session_commit();
    
    ini_set('session.use_strict_mode', 0);
    session_id($session_id);
    
    ini_set('session.use_strict_mode', 1);
    session_start();
}

// BB-RAD session destroy and clean all session variables
function dalo_session_destroy() {
    // unset all of the session variables.
    $_SESSION = array();

    // completely destory the session and all it's variables
    session_destroy();
}
