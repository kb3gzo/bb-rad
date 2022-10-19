<?php

	include ("library/checklogin.php");
	$operator = $_SESSION['operator_user'];

	include('library/check_operator_perm.php');

	isset($_GET['daloradiusLineCount']) ? $daloradiusLineCount = $_GET['daloradiusLineCount'] : $daloradiusLineCount = 50;
	isset($_GET['daloradiusFilter']) ? $daloradiusFilter = $_GET['daloradiusFilter'] : $daloradiusFilter = ".";

	include_once('library/config_read.php');
	$log = "visited page: ";
	$logQuery = "performed query on page: ";
	include('include/config/logging.php');

?>

<?php

    include ("menu-reports-logs.php");
  	
?>	


	<div id="contentnorightbar">
		
		<h2 id="Intro"><a href="#"  onclick="javascript:toggleShowDiv('helpPage')"><?php echo t('Intro','replogsdaloradius.php'); ?>
		:: <?php if (isset($daloradiusLineCount)) { echo $daloradiusLineCount . " Lines Count "; } ?>
		   <?php if (isset($daloradiusFilter)) { echo " with filter set to " . $daloradiusFilter; } ?>
		<h144>&#x2754;</h144></a></h2>

		<div id="helpPage" style="display:none;visibility:visible" >
			<?php echo t('helpPage','replogsdaloradius') ?>
			<br/>
		</div>

<?php
	include 'library/exten-daloradius_log.php';
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
