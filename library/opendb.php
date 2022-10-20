<?php

	include (dirname(__FILE__).'/config_read.php');
	include (dirname(__FILE__).'/tableConventions.php');

	// setup database connectio information according to the session's location name which is held in $SESSION['location_name'].
	// this is introduced in order to provide BB-RAD to authenticate and manage several database backends without having to
	// install several web directories of daloradius

	if ((isset($_SESSION['location_name'])) && ($_SESSION['location_name'] == "default")) {

		$mydbEngine = $configValues['CONFIG_DB_ENGINE'];
		$mydbUser = $configValues['CONFIG_DB_USER'];
		$mydbPass = $configValues['CONFIG_DB_PASS'];
		$mydbHost = $configValues['CONFIG_DB_HOST'];
		$mydbPort = $configValues['CONFIG_DB_PORT'];
		$mydbName = $configValues['CONFIG_DB_NAME'];

		if (!$mydbPort)
			$mydbPort = '3306';

		$dbConnectString = $mydbEngine . "://".$mydbUser.":".$mydbPass."@".
					$mydbHost.":".$mydbPort."/".$mydbName;

	} elseif ((isset($_SESSION['location_name'])) && ($_SESSION['location_name'] != "default")) {

		$mydbEngine = $configValues['CONFIG_LOCATIONS'][$_SESSION['location_name']]['Engine'];
		$mydbUser = $configValues['CONFIG_LOCATIONS'][$_SESSION['location_name']]['Username'];
		$mydbPass = $configValues['CONFIG_LOCATIONS'][$_SESSION['location_name']]['Password'];
		$mydbHost = $configValues['CONFIG_LOCATIONS'][$_SESSION['location_name']]['Hostname'];
		$mydbPort = $configValues['CONFIG_LOCATIONS'][$_SESSION['location_name']]['Port'];
		$mydbName = $configValues['CONFIG_LOCATIONS'][$_SESSION['location_name']]['Database'];

		if (!$mydbPort)
			$mydbPort = '3306';

		$dbConnectString = $mydbEngine . "://".$mydbUser.":".$mydbPass."@".
					$mydbHost.":".$mydbPort."/".$mydbName;
	} else {
		// TODO
		// requires handling of un-initialized session variable incase opendb.php is called not inside
		// a session for some reason. requires further handling, possibly a log file entry
	    //exit;

		$mydbEngine = $configValues['CONFIG_DB_ENGINE'];
		$mydbUser = $configValues['CONFIG_DB_USER'];
		$mydbPass = $configValues['CONFIG_DB_PASS'];
		$mydbHost = $configValues['CONFIG_DB_HOST'];
		$mydbPort = $configValues['CONFIG_DB_PORT'];
		$mydbName = $configValues['CONFIG_DB_NAME'];

		if (!$mydbPort)
			$mydbPort = '3306';

		$dbConnectString = $mydbEngine . "://".$mydbUser.":".$mydbPass."@".
					$mydbHost.":".$mydbPort."/".$mydbName;
	}


	// we introduced support for php's database abstraction layer which simplifies database connections
	// to different technologies like mysql, oracle, postgresql, etc...
	// until everything is completely migrated we will leave these commented out

	include_once ('DB.php');

	$dbSocket = DB::connect($dbConnectString);

	if (DB::isError ($dbSocket))
		die ("<b>Database connection error</b><br/>
			<b>Error Message</b>: " . $dbSocket->getMessage () . "<br/>"
			);


	include_once (dirname(__FILE__).'/errorHandling.php');		// we declare the errorHandler() function in errorHandling.php

	$dbSocket->setErrorHandling(PEAR_ERROR_CALLBACK, 'errorHandler');	// setting errorHandler function for the dbSocket obj

  $dbSocket->query("SET SESSION sql_mode = '';");
