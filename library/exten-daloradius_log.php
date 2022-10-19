<?php


if (isset($configValues['CONFIG_LOG_FILE'])) {
	$logfile = $configValues['CONFIG_LOG_FILE'];

	if (!file_exists($logfile)) {

                $failureMsg = "error reading log file: <b>$logfile</b><br/>".
				"looked for log file in $logfile but couldn't find it.<br/>".
				"if you know where your daloradius log file is located, set it's location in your library/daloradius.conf file";
	} else {


		if (is_readable($logfile) == false) {

	                $failureMsg = "error reading log file: <b>$logfile</b><br/>".
				"possible cause is file premissions or file doesn't exist.<br/>";

		} else {
		    if (file_get_contents($logfile)) {
				$fileReversed = array_reverse(file($logfile));
				$counter = $daloradiusLineCount;

				// This doesn't take in any filter value
				// from the forms.
				// This takes in the log count though.
				foreach ($fileReversed as $line) {
					if ($counter == 0) {
						break;
					}
					echo $line . "<br>";
					$counter--;
				}
				// Old Code
				// $counter = $daloradiusLineCount;
				// foreach ($fileReversed as $line) {
				// 	if (preg_match("/$daloradiusFilter/i", $line)) {
				// 		if ($counter == 0)
				// 			break;
				// 		$ret = eregi_replace("\n", "<br>", $line);
				// 		echo $ret;
				// 		$counter--;
				// 	}
				// }
			}
		}
	}
}

?>
