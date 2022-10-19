<?php

    include ("library/checklogin.php");
    $operator = $_SESSION['operator_user'];

	include('library/check_operator_perm.php');

        isset($_GET['systemLineCount']) ? $systemLineCount = $_GET['systemLineCount'] : $systemLineCount = 50;
        isset($_GET['systemFilter']) ? $systemFilter = $_GET['systemFilter'] : $systemFilter = ".";

	include_once('library/config_read.php');
    $log = "visited page: ";
    $logQuery = "performed query on page: ";
    include('include/config/logging.php');

?>

<?php

    include ("menu-reports-logs.php");
  	
?>	
		<div id="contentnorightbar">
		
		<h2 id="Intro"><a href="#"  onclick="javascript:toggleShowDiv('helpPage')"><?php echo t('Intro','replogssystem.php'); ?>
                :: <?php if (isset($systemLineCount)) { echo $systemLineCount . " Lines Count "; } ?>
                   <?php if (isset($systemFilter)) { echo " with filter set to " . $systemFilter; } ?>
		<h144>&#x2754;</h144></a></h2>

		<div id="helpPage" style="display:none;visibility:visible" >
			<?php echo t('helpPage','replogssystem') ?>
			<br/>
		</div>
		<br/>

<?php
	include 'library/exten-syslog_log.php';
?>

                <?php
                        include_once('include/management/actionMessages.php');
                ?>


		</div>
		
		<div id="footer">
		
								<?php
        include 'page-footer.php';
?>
		
		</div>
		
</div>
</div>


</body>
</html>
