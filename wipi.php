<?php
require_once("wipi_functions.php");
$remote_key = $_POST["shared_key"];
if ($remote_key == $wipi_shared_key)
{
	$hostname = $_POST["hostname"];
	$timestamp = $_POST["timestamp"];
	$wifi_stats = unserialize(base64_decode($_POST["wifi_stats"]));
	$devices = unserialize(base64_decode($_POST["devices"]));
	$ssid_scan = unserialize(base64_decode($_POST["ssid_scan"]));
	$ssid_scan_all = unserialize(base64_decode($_POST["ssid_scan_all"]));
	
	$ssid = strtok($wifi_stats,";");
	$ssid_mac = strtok(";");
	$freq = str_replace(".","",strtok(";"));
	$link_quality = strtok(";");
	$link_quality_percent = strtok(";");
	$sig_level = str_replace("-","",strtok(";"));
	$bitrate = strtok(";");
	$txpwr = strtok(";");
	$rx_invalid_nwid = strtok(";");
	$rx_invalid_crypt = strtok(";");
	$rx_invalid_frag = strtok(";");
	$tx_excessive_retries = strtok(";");
	$invalid_misc = strtok(";");
	$missed_beacon = strtok(";");
	$center_freq = strtok(";");
	$width = strtok("\n");

	$mon = strtok($timestamp,"-");
	$day = strtok("-");
	$year = strtok(" ");
	$hour = strtok(":");
	$min = strtok("\n");
	$time_stamp = mktime($hour,$min,0,$mon,$day,$year);

	$time_stamp = date("Y-m-d H:i",$time_stamp);
	
	table_insert("wifi_stats","timestamp,hostname,ssid,ssid_mac,freq,link_quality,link_quality_percent,sig_level,bit_rate,txpwr,rx_invalid_nwid,rx_invalid_crypt,rx_invalid_frag,tx_excessive_retries,invalid_misc,missed_beacon,center_freq,width","'$time_stamp','$hostname','$ssid','$ssid_mac','$freq','$link_quality','$link_quality_percent','$sig_level','$bitrate','$txpwr','$rx_invalid_nwid','$rx_invalid_crypt','$rx_invalid_frag','$tx_excessive_retries','$invalid_misc','$missed_beacon','$center_freq','$width'");



	$total_devices = count($devices);
	foreach($devices as $key => $device)
	{
		$sql_devices = $device."|".$sql_devices;
	}

	table_insert("devices","timestamp,hostname,total,devices","'$time_stamp','$hostname','$total_devices','$sql_devices'");


	foreach($ssid_scan as $key => $scan)
	{
		/*

		if($scan[0] == ";")
		{
			$ssid = " ";
			$channel = strtok($scan,";");
			$freq = strtok(";");
			$sig_level = str_replace("-","",strtok(";"));
			$ssid_mac = strtok("\n");
		}
		else
		{
			$ssid = strtok($scan,";");
			$channel = strtok(";");
			$freq = strtok(";");
			$sig_level = str_replace("-","",strtok(";"));
			$ssid_mac = strtok("\n");
		}
		*/
		$sql_ssid_scan = $scan."|".$sql_ssid_scan;
		

	}
	table_insert("ssid_scan","timestamp,hostname,ssid_scan","'$time_stamp','$hostname','$sql_ssid_scan'");
	

	foreach($ssid_scan_all as $key => $scan_all)
	{
		/*

		if($scan[0] == ";")
		{
			$ssid = " ";
			$channel = strtok($scan,";");
			$freq = strtok(";");
			$sig_level = str_replace("-","",strtok(";"));
			$ssid_mac = strtok("\n");
		}
		else
		{
			$ssid = strtok($scan,";");
			$channel = strtok(";");
			$freq = strtok(";");
			$sig_level = str_replace("-","",strtok(";"));
			$ssid_mac = strtok("\n");
		}
		*/
		$sql_ssid_scan_all = $scan_all."|".$sql_ssid_scan_all;
		

	}
	table_insert("ssid_scan_all","timestamp,hostname,ssid_scan","'$time_stamp','$hostname','$sql_ssid_scan_all'");


	mysqli_close($mysql_link);  

/*


	$log = fopen("/var/www/html/wifi/log.txt","a") or die("Unable to open file!");

	fwrite($log,$hostname);
	fwrite($log," | $time_stamp | ");
	fwrite($log,$wifi_stats);
	fwrite($log,"\n");

	foreach($devices as $key => $device)
	{
		$line = $hostname." | ".$device."\n";
		fwrite($log,$line);
	}

	foreach($ssid_scan as $key => $scan)
	{
		$line = $hostname." | ".$scan."\n";
		fwrite($log,$line);
	}
	
	fwrite($log,"\n\n\n");
	fclose($log);
*/
}
?>
