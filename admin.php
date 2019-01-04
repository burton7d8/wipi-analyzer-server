<?php
require_once("wipi_functions.php");
$monitor = $_POST["monitor"];
$use_start_date = $_POST["use_start_date"];
$all_records = $_POST["all_records"];
$op = $_POST["op"];
//error_reporting(E_ALL);
print "<center><font size=5><b>WiPi Analyzer Server Admin</b></font><br><br>";
$db_size = db_size($dbName);
print "<font size=2>Database Size: ".$db_size[0][0]." MB</font><br>";


if(!$op)
{
	$stack = distinct_query_table("hostname","wifi_stats");
	foreach($stack as $key => $values)
	{
		$wipi_monitors[] = $values[0];
	}
	asort($wipi_monitors);


	print "<b>CHOOSE THE MONITOR TO REMOVE RECORDS FOR:</b>";
	print "<form method=post>";
	print "<select name=monitor>";
	foreach($wipi_monitors as $key => $wipi_monitor)
	{
		if($monitor == $wipi_monitor)
			print "<option value=$wipi_monitor selected>$wipi_monitor</option>";
		else
			print "<option value=$wipi_monitor>$wipi_monitor</option>";

	}
	print "<option value=all>ALL</option>";
	print "</select>";
	print "<br>";

	print "<b>QUICK DELETE ALL RECORDS OLDER THAN</b><br>";
	print "<input type=radio name=use_start_date value=1>1 WEEK<br>";
	print "<input type=radio name=use_start_date value=2>2 WEEKS<br>";
	print "<input type=radio name=use_start_date value=3>3 WEEKS<br>";
	print "<input type=radio name=use_start_date value=4>4 WEEKS<br>";

	print "<input type=hidden name=op value=confirm>";
	print "<br><input type=submit value='DELETE SPECIFIC TIMEFRAME' class=\"btn btn-primary\">";
	print "</form>";


	print "<br><br>";
	print "<b>OR CHOOSE THE MONITOR TO REMOVE ALL RECORDS FOR:</b>";
	print "<form method=post>";
	print "<select name=monitor>";
	foreach($wipi_monitors as $key => $wipi_monitor)
	{
		if($monitor == $wipi_monitor)
			print "<option value=$wipi_monitor selected>$wipi_monitor</option>";
		else
			print "<option value=$wipi_monitor>$wipi_monitor</option>";

	}
	print "</select>";
	print "<input type=hidden name=all_records value=yes>";
	print "<input type=hidden name=op value=confirm>";
	print "<input type=submit value=\"DELETE ALL RECORDS FOR MONITOR\" class=\"btn btn-primary\">";
	print "</form>";
	print "<br><br>";
}
elseif($op == "confirm")
{
	if(!$use_start_date && !$all_records)
	{
		print "YOU MUST SELECT AN OLDER THAN RANGE TO CONTINUE!<br>";
		print "<form method=post><input type=submit value=BACK class=\"btn btn-primary\"></form>";
		die();
	}

	//print "start_date = $start_date<br>";
	$use_start_date = date('Y-m-d H:i', strtotime("-$use_start_date week"));
	$use_start_date = $use_start_date.":00";
	//print "use_start_date = $use_start_date<br>";
	//print "monitor = $monitor<br>";
	if($monitor == "all")
	{
		$devices_records = query_table("COUNT(*)","devices","timestamp <= '$use_start_date'");
		$wifi_stats_records = query_table("COUNT(*)","wifi_stats","timestamp <= '$use_start_date'");
		$ssid_scan_records = query_table("COUNT(*)","ssid_scan","timestamp <= '$use_start_date'");
		$ssid_scan_all_records = query_table("COUNT(*)","ssid_scan_all","timestamp <= '$use_start_date'");
	}
	elseif($all_records == "yes")
	{
		$devices_records = query_table("COUNT(*)","devices","hostname = '$monitor'");
		$wifi_stats_records = query_table("COUNT(*)","wifi_stats","hostname = '$monitor'");
		$ssid_scan_records = query_table("COUNT(*)","ssid_scan","hostname = '$monitor'");
		$ssid_scan_all_records = query_table("COUNT(*)","ssid_scan_all","hostname = '$monitor'");

	}
	else
	{
		$devices_records = query_table("COUNT(*)","devices","hostname = '$monitor' AND (timestamp <= '$use_start_date')");
		$wifi_stats_records = query_table("COUNT(*)","wifi_stats","hostname = '$monitor' AND (timestamp <= '$use_start_date')");
		$ssid_scan_records = query_table("COUNT(*)","ssid_scan","hostname = '$monitor' AND (timestamp <= '$use_start_date')");
		$ssid_scan_all_records = query_table("COUNT(*)","ssid_scan_all","hostname = '$monitor' AND (timestamp <= '$use_start_date')");
	}

	print "<font size=5><b>YOU CHOOSE TO DELETE RECORDS FOR THE FOLLOWING:</b></font><br>";
	print "<table border=0 padding=3>";
	print "<tr><td align=right><b>MONITOR: </b></td><td padding=5 align=right>$monitor</td></tr>";
	if(!$all_records)
		print "<tr><td align=right><b>RECORDS OLDER THAN: </b></td><td padding=5  align=right>$use_start_date</td></tr>";
	else
		print "<tr><td align=right><b>RECORDS OLDER THAN: </b></td><td padding=5  align=right>ALL RECORDS FOR $monitor</td></tr>";
	print "<tr><td align=right><b>DEVICES RECORDS: </b></td><td padding=5 align=right>".number_format($devices_records[0][0])."</td></tr>";
	print "<tr><td align=right><b>WIFI STATS RECORDS: </b></td><td padding=5 align=right>".number_format($wifi_stats_records[0][0])."</td></tr>";
	print "<tr><td align=right><b>SSID SCAN RECORDS: </b></td><td padding=5 align=right>".number_format($ssid_scan_records[0][0])."</td></tr>";
	print "<tr><td align=right><b>SSID SCAN ALL RECORDS: </b></td><td padding=5 align=right>".number_format($ssid_scan_all_records[0][0])."</td></tr>";
	print "</table>";


	print "<form method=post>";
	print "<input type=hidden name=op value=delete>";
	print "<input type=hidden name=monitor value=$monitor>";
	print "<input type=hidden name=all_records value=$all_records>";
	print "<input type=hidden name=use_start_date value=\"$use_start_date\">";
	print "<input type=submit value=\"Confirm Delete\" class=\"btn btn-primary\">";
	print "</form>";
	
	print "<br><form method=post><input type=submit value=CANCEL class=\"btn btn-info\"></form>";

}
elseif($op == "delete")
{
	if(!$all_records)
	{
		if($monitor ==  "all")
		{
			print "<font size=5><b>DELETING SPECIFIC RECORDS FOR ALL MONITORS OLDER THAN $use_start_date</b></font><br>";
			row_delete_nolimit("devices","timestamp <= '$use_start_date'");
			row_delete_nolimit("wifi_stats","timestamp <= '$use_start_date'");
			row_delete_nolimit("ssid_scan","timestamp <= '$use_start_date'");
			row_delete_nolimit("ssid_scan_all","timestamp <= '$use_start_date'");
		}
		else
		{
			print "<font size=5><b>DELETING SPECIFIC RECORDS FOR $monitor OLDER THAN $use_start_date</b></font><br>";
			row_delete_nolimit("devices","hostname = '$monitor' AND timestamp <= '$use_start_date'");
			row_delete_nolimit("wifi_stats","hostname = '$monitor' AND timestamp <= '$use_start_date'");
			row_delete_nolimit("ssid_scan","hostname = '$monitor' AND timestamp <= '$use_start_date'");
			row_delete_nolimit("ssid_scan_all","hostname = '$monitor' AND timestamp <= '$use_start_date'");
		}
	}
	else
	{
		print "<font size=5><b>DELETING ALL RECORDS FOR $monitor</b></font><br>";
		row_delete_nolimit("devices","hostname = '$monitor'");
		row_delete_nolimit("wifi_stats","hostname = '$monitor'");
		row_delete_nolimit("ssid_scan","hostname = '$monitor'");
		row_delete_nolimit("ssid_scan_all","hostname = '$monitor'");
	}

	print "<form method=post><input type=submit value=BACK></form>";
}

?>
