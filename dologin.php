<?php

include('library/sessions.php');

// set's the session max lifetime to 3600 seconds
ini_set('session.gc_maxlifetime', 3600);

dalo_session_start();
dalo_session_regenerate_id();

include('library/opendb.php');

$errorMessage = '';

// we need to set location name session variable before opening the database
// since the whole point is to authenticate to a spefific pre-defined database server

// validate location
$location_name = (!empty($_POST['location'])) ? $_POST['location']: "default";

$_SESSION['location_name'] = (array_key_exists('CONFIG_LOCATIONS', $configValues)
    && is_array($configValues['CONFIG_LOCATIONS'])
    && count($configValues['CONFIG_LOCATIONS']) > 0
    && in_array($location_name, $configValues['CONFIG_LOCATIONS'])) ?
        $location_name : "default";
        
$operator_user = $dbSocket->escapeSimple($_POST['operator_user']);
$operator_pass = $dbSocket->escapeSimple($_POST['operator_pass']);

$sqlFormat = "select * from %s where username='%s' and password='%s'";
$sql = sprintf($sqlFormat, $configValues['CONFIG_DB_TBL_DALOOPERATORS'],
    $operator_user, $operator_pass);
$res = $dbSocket->query($sql);
$numRows = $res->numRows();

if ($numRows != 1) {
    $_SESSION['daloradius_logged_in'] = false;
    $_SESSION['operator_login_error'] = true;
    
    // ~ close connection to db before redirecting
    include('library/closedb.php');
    
    header('Location: login.php');
    exit;
}

$row = $res->fetchRow(DB_FETCHMODE_ASSOC);
$operator_id = $row['id'];

if (array_key_exists('operator_login_error', $_SESSION)) {
    unset($_SESSION['operator_login_error']);
}
$_SESSION['daloradius_logged_in'] = true;
$_SESSION['operator_user'] = $operator_user;
$_SESSION['operator_id'] = $operator_id;

// lets update the lastlogin time for this operator
$now = date("Y-m-d H:i:s");
$sqlFormat = "update %s set lastlogin='%s' where username='%s'";
$sql = sprintf($sqlFormat,
    $configValues['CONFIG_DB_TBL_DALOOPERATORS'], $now, $operator_user);
$res = $dbSocket->query($sql);

// ~ close connection to db before redirecting
include('library/closedb.php');

header('Location: index.php');

?>
