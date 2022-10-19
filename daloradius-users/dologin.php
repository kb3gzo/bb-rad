<?php

include('library/sessions.php');

dalo_session_start();
dalo_session_regenerate_id();

$errorMessage = '';
include('library/opendb.php');

$login_user = $_POST['login_user'];
$login_pass = $_POST['login_pass'];

$sqlFormat = "select * from %s where username='%s' "
    . "and portalloginpassword='%s' and enableportallogin=1";
$sql = sprintf($sqlFormat,
    $configValues['CONFIG_DB_TBL_DALOUSERINFO'], 
    $dbSocket->escapeSimple($login_user),
    $dbSocket->escapeSimple($login_pass));
$res = $dbSocket->query($sql);

$numRows = $res->numRows();
include('library/closedb.php');

if ($numRows != 1) {
    $_SESSION['logged_in'] = false;
    $_SESSION['login_error'] = true;
    header('Location: login.php');
    exit;
}

if (array_key_exists('login_error', $_SESSION)) {
    unset($_SESSION['login_error']);
}
$_SESSION['logged_in'] = true;
$_SESSION['login_user'] = $login_user;
header('Location: index.php');

?>
