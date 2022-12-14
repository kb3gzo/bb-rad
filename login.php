<?php

include_once("library/sessions.php");
dalo_session_start();

if (array_key_exists('daloradius_logged_in', $_SESSION)
    && $_SESSION['daloradius_logged_in'] !== false) {
    header('Location: index.php');
    exit;
}

include("lang/main.php");

// ~ used later for rendering location select element
$onlyDefaultLocation = !(array_key_exists('CONFIG_LOCATIONS', $configValues)
                        && is_array($configValues['CONFIG_LOCATIONS'])
                        && count($configValues['CONFIG_LOCATIONS']) > 0);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="<?= $langCode ?>" xml:lang="<?= $langCode ?>"
    xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script src="library/javascript/pages_common.js"
            type="text/javascript"></script>
        <title>BB-RAD</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/1.css" type="text/css"
            media="screen,projection" />
        <link rel="stylesheet" href="css/style.css" type="text/css"
            media="screen,projection" />
    </head>

    <body onLoad="document.login.operator_user.focus()">
        <div id="wrapper">
            <div id="innerwrapper">
                <div id="header">
                    <h1>
                        <a href="index.php">
                            <img src="images/bb_small.png" border="0" />
                        </a>
                    </h1>
                    <h2><?= t('all','ServerName') ?></h2>
                    <br/>
                </div><!-- #header -->
		
        
                <div id="main">
                    <h2 class="form-header"><?= t('text','LoginRequired') ?></h2>
                    
                     <form class="form-box" name="login" action="dologin.php" method="post">
                            
                        <label for="operator_user">Username</label>
                        <input class="form-input" id="operator_user"
                            name="operator_user" value="administrator"
                            type="text" tabindex="1" />
                        
                        <label for="operator_pass">Password</label>
                        <input class="form-input" id="operator_pass"
                            name="operator_pass" value=""
                            type="password" tabindex="2" />
                        
                        <input class="form-submit" type="submit"
                            value="<?= t('text','LoginPlease') ?>" tabindex="4" />
                    </form>
                    
                    <small class="form-caption"><?= t('all','BB-RAD') ?></small>
                    
                    <?php
                        if (array_key_exists('operator_login_error', $_SESSION)
                            && $_SESSION['operator_login_error'] !== false) {
                    ?>
                    
                    <div id="inner-box">
                        <h3 class="text-title error-title">Error!</h3>
                        <?= t('messages','loginerror') ?>
                    </div><!-- #inner-box -->
                    
                    <?php
                        }
                    ?>
                    
                </div><!-- #main -->
        
                <div id="footer">
                    <?php include('page-footer.php'); ?>
                </div><!-- #footer -->
                
            </div><!-- #innerwrapper -->
        </div><!-- #wrapper -->
    </body>
</html>
