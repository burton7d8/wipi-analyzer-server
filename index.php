<?php
require_once("wipi_functions.php");

$monitor = $_POST["monitor"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$ssid_filter_enabled = $_POST["ssid_filter_enabled"];
$ssid_filter_size = $_POST["ssid_filter_size"];
$single_util_ssid = $_POST["single_util_ssid"];


        if(!$start_date)
        {
		$start_date = date('Y-m-d H:i', strtotime('-4 hour'));
		//$start_date = $start_date.":00";
                //print "start_date = $start_date<br>";
        }

        if(!$end_date)
        {
		$end_date = date('Y-m-d H:i', strtotime('now'));
		//$end_date = $end_date.":00";
		//print "end_date = $end_date<br>";
        }



$stack = distinct_query_table("hostname","devices");
foreach($stack as $key => $values)
{
	$wipi_monitors[] = $values[0];
}
asort($wipi_monitors);

	if(!$monitor)
		$monitor = $wipi_monitors[0];


print "
<script type=\"text/javascript\">
$( function() {
	$('#datetimepicker1').datetimepicker({
        	timeInput: true,
	        timeFormat: \"HH:mm\",
        	dateFormat: \"yy-mm-dd\"
	});

	$('#datetimepicker2').datetimepicker({
        	timeInput: true,
	        timeFormat: \"HH:mm\",
        	dateFormat: \"yy-mm-dd\"
	});
});
</script>
";


print "<br><br>";
print "<center><b><font size=5>WiPi Analyzer Server</font></b><br><br>";
//print "<br><br><br><br><br><br><br>";
$db_size = db_size($dbName);
print "<font size=2>Database Size: ".$db_size[0][0]." MB</font><br>";


        print "<form method=post action=index.php#>";

if($ssid_filter_enabled)
{
	if(!$ssid_filter_size)
		$ssid_filter_size = "80";
	print "<input type=checkbox name=ssid_filter_enabled value=yes checked style=\"display:inline;\">Filter out SSID's lower than -";
	print "<input type=text name=ssid_filter_size size=1 maxlength=3 value=\"$ssid_filter_size\" style=\"display;\">dbm<br>";
}
else
{
	if(!$ssid_filter_size)
		$ssid_filter_size = "80";
	print "<input type=checkbox name=ssid_filter_enabled value=yes style=\"display:inline;\">Filter SSID's lower than -";
	print "<input type=text name=ssid_filter_size size=1 maxlength=3 value=\"$ssid_filter_size\" style=\"display:inline;\">dbm<br>";
}


print "<br>";
print "<table border=0>
<tr><td align=center><b>START DATE</b><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align=center><b>END DATE</b></td></tr>
<tr><td>
<input type='text' name=start_date id=\"datetimepicker1\" value=\"$start_date\" style=\"width:160px;\"/>
</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
<input type='text' name=end_date id=\"datetimepicker2\" value=\"$end_date\" style=\"width:160px;\"/>
</td></tr>
</table><br>
";

print "<select name=monitor>";
foreach($wipi_monitors as $key => $wipi_monitor)
{
	if($monitor == $wipi_monitor)
		print "<option value=$wipi_monitor selected>$wipi_monitor</option>";
	else
		print "<option value=$wipi_monitor>$wipi_monitor</option>";

}
print "</select>";

print " <input type=submit class=\"btn btn-primary\">";
print "</form>";
print "<br><br>";


print "<font size=2><i>Quick Time Frames</i></font><br>";
print "<form method=post style=\"display:inline!important;\" action=index.php#>";
print "<input type=submit value='4 HOUR (DEFAULT)' class=\"btn btn-warning\">";
print "<input type=hidden name=monitor value=$monitor>";
if($ssid_filter_enabled)
{
	print "<input type=hidden name=ssid_filter_enabled value=yes>";
	print "<input type=hidden name=ssid_filter_size value=$ssid_filter_size>";
}
print "</form>";

print "<form method=post style=\"display:inline!important;\" action=index.php#>";
print "<input type=submit value='1 HOUR' class=\"btn btn-warning\">";
$one_hour_start_date = date('Y-m-d H:i', strtotime('-1 hour'));
//$one_hour_start_date = $one_hour_start_date.":00";
print "<input type=hidden name=start_date value='$one_hour_start_date'>";
print "<input type=hidden name=monitor value=$monitor>";
if($ssid_filter_enabled)
{
	print "<input type=hidden name=ssid_filter_enabled value=yes>";
	print "<input type=hidden name=ssid_filter_size value=$ssid_filter_size>";
}
print "</form>";

print "<form method=post style=\"display:inline!important;\" action=index.php#>";
print "<input type=submit value='8 HOUR' class=\"btn btn-warning\">";
$one_hour_start_date = date('Y-m-d H:i', strtotime('-8 hour'));
//$one_hour_start_date = $one_hour_start_date.":00";
print "<input type=hidden name=start_date value='$one_hour_start_date'>";
print "<input type=hidden name=monitor value=$monitor>";
if($ssid_filter_enabled)
{
	print "<input type=hidden name=ssid_filter_enabled value=yes>";
	print "<input type=hidden name=ssid_filter_size value=$ssid_filter_size>";
}
print "</form>";


print "<form method=post style=\"display:inline!important;\" action=index.php#>";
print "<input type=submit value='12 HOUR' class=\"btn btn-warning\">";
$one_hour_start_date = date('Y-m-d H:i', strtotime('-12 hour'));
//$one_hour_start_date = $one_hour_start_date.":00";
print "<input type=hidden name=start_date value='$one_hour_start_date'>";
print "<input type=hidden name=monitor value=$monitor>";
if($ssid_filter_enabled)
{
	print "<input type=hidden name=ssid_filter_enabled value=yes>";
	print "<input type=hidden name=ssid_filter_size value=$ssid_filter_size>";
}
print "</form>";


print "<form method=post style=\"display:inline!important;\" action=index.php#>";
print "<input type=submit value='24 HOUR' class=\"btn btn-warning\">";
$one_hour_start_date = date('Y-m-d H:i', strtotime('-24 hour'));
//$one_hour_start_date = $one_hour_start_date.":00";
print "<input type=hidden name=start_date value='$one_hour_start_date'>";
print "<input type=hidden name=monitor value=$monitor>";
if($ssid_filter_enabled)
{
	print "<input type=hidden name=ssid_filter_enabled value=yes>";
	print "<input type=hidden name=ssid_filter_size value=$ssid_filter_size>";
}
print "</form>";

print "<form method=post style=\"display:inline!important;\" action=index.php#>";
print "<input type=submit value='48 HOUR' class=\"btn btn-warning\">";
$one_hour_start_date = date('Y-m-d H:i', strtotime('-48 hour'));
//$one_hour_start_date = $one_hour_start_date.":00";
print "<input type=hidden name=start_date value='$one_hour_start_date'>";
print "<input type=hidden name=monitor value=$monitor>";
if($ssid_filter_enabled)
{
	print "<input type=hidden name=ssid_filter_enabled value=yes>";
	print "<input type=hidden name=ssid_filter_size value=$ssid_filter_size>";
}
print "</form>";

if($using_userspice == "yes")
{
	print "<br><br><a href=#the_middle class=\"btn btn-info\">GO TO MIDDLE</a>";
	print "<br><br><a href=#the_bottom class=\"btn btn-info\">GO TO BOTTOM</a>";
}

print "<br><br>";
print "<i>The WiPi graphs below are free for <u>Personal Use</u> and are provided by <a href=http://www.highcharts.com/download target=_blank>HIGHCHARTS</a> under the <a href=https://creativecommons.org/licenses/by-nc/3.0/ target=_blank>Creative Commons (CC) Attribution-NonCommercial license</a><br>";
print "You <u>CAN NOT</u> use HIGHCHARTS for <a href=https://shop.highsoft.com/faq#Non-Commercial-0 target=_blank>commercial use</a>  You must purchase a <a href=https://shop.highsoft.com/highcharts target=_blank>license</a> from HIGHCHARTS to do so!<br></i>";
print "<br><br>";

$stack = query_table("*","devices","hostname = '$monitor' AND (timestamp >= '$start_date' and timestamp <= '$end_date')");
//pre_print($stack);
foreach($stack as $key => $value)
{
	$timestamp = $value["timestamp"];
	$year = strtok($timestamp,"-");
        $mon = strtok("-");
        $day = strtok(" ");
        $hour = trim(strtok(":"));
        $min = strtok("\n");
        //$time_stamp = (mktime($hour,$min,0,$mon,$day,$year) - 21600) * 1000;
        $time_stamp = mktime($hour,$min,0,$mon,$day,$year);

	$total_devices = $value["total"];
	$device_list = $value["devices"];

	$devices = explode("|",$device_list);
	array_pop($devices);
	$all_devices[$time_stamp][] = $devices;
}
//pre_print($all_devices);

foreach($all_devices as $timestamp => $devices)
{
	foreach($devices[0] as $key => $device)
	{
		if($device[0] == ";")
		{
			$ip = strtok($device,";");
			$mac = strtok(";");
			$mfc = strtok("\n");
			$clean_device = $ip."|".$mac;
		}
		else
		{
			$hostname = strtok($device,";");
			$ip = strtok(";");
			$mac = strtok(";");
			$mfc = strtok("\n");
			$clean_device = $hostname."|".$mac;
		}

		if(!in_array($clean_device,$graph_devices["devices"]))
		{
			$graph_devices["devices"][] = $clean_device;
			$list_devices[] = $device;
		}
		if(!in_array($clean_device,$graph_devices[$timestamp]))
			$graph_devices["timestamp"][$timestamp][] = $clean_device;
	}
}
//pre_print($graph_devices);
//pre_print($all_devices);

//AND (date >= from_unixtime($start_date) and date <= from_unixtime($end_date)) order by date desc
$stack = query_table("*","wifi_stats","hostname = '$monitor' AND (timestamp >= '$start_date' and timestamp <= '$end_date')");
//pre_print($stack);
/*
$wifi_freq_table[] = array("1","2401","2412","2423");
$wifi_freq_table[] = array("2","2406","2417","2428");
$wifi_freq_table[] = array("3","2411","2422","2433");
$wifi_freq_table[] = array("4","2416","2427","2438");
$wifi_freq_table[] = array("5","2421","2432","2443");
$wifi_freq_table[] = array("6","2426","2437","2448");
$wifi_freq_table[] = array("7","2431","2442","2453");
$wifi_freq_table[] = array("8","2436","2447","2458");
$wifi_freq_table[] = array("9","2441","2452","2463");
$wifi_freq_table[] = array("10","2446","2457","2468");
$wifi_freq_table[] = array("11","2451","2462","2473"); 
*/
$wifi_freq_table[] = array("1","2401","2412","2423","20");
$wifi_freq_table[] = array("2","2406","2417","2428","20");
$wifi_freq_table[] = array("3","2411","2422","2433","20");
$wifi_freq_table[] = array("4","2416","2427","2438","20");
$wifi_freq_table[] = array("5","2421","2432","2443","20");
$wifi_freq_table[] = array("6","2426","2437","2448","20");
$wifi_freq_table[] = array("7","2431","2442","2453","20");
$wifi_freq_table[] = array("8","2436","2447","2458","20");
$wifi_freq_table[] = array("9","2441","2452","2463","20");
$wifi_freq_table[] = array("10","2446","2457","2468","20");
$wifi_freq_table[] = array("11","2451","2462","2473","20");


$wifi_freq_table[] = array("36","5170","5180","5190","20");
$wifi_freq_table[] = array("38","5170","5190","5210","40");
$wifi_freq_table[] = array("40","5190","5200","5210","20");
$wifi_freq_table[] = array("42","5170","5210","5250","80");
$wifi_freq_table[] = array("44","5210","5220","5230","20");
$wifi_freq_table[] = array("46","5210","5230","5250","40");
$wifi_freq_table[] = array("48","5230","5240","5250","20");
$wifi_freq_table[] = array("50","5170","5250","5330","160");
$wifi_freq_table[] = array("52","5250","5260","5270","20");
$wifi_freq_table[] = array("54","5250","5270","5290","40");
$wifi_freq_table[] = array("56","5270","5280","5290","20");
$wifi_freq_table[] = array("58","5250","5290","5330","80");
$wifi_freq_table[] = array("60","5290","5300","5310","20");
$wifi_freq_table[] = array("62","5290","5310","5330","40");
$wifi_freq_table[] = array("64","5310","5320","5330","20");
$wifi_freq_table[] = array("100","5490","5500","5510","20");
$wifi_freq_table[] = array("102","5490","5510","5530","40");
$wifi_freq_table[] = array("104","5510","5520","5530","20");
$wifi_freq_table[] = array("106","5490","5530","5570","80");
$wifi_freq_table[] = array("108","5530","5540","5550","20");
$wifi_freq_table[] = array("110","5530","5550","5570","40");
$wifi_freq_table[] = array("112","5550","5560","5570","20");
$wifi_freq_table[] = array("114","5490","5570","5650","160");
$wifi_freq_table[] = array("116","5570","5580","5590","20");
$wifi_freq_table[] = array("118","5570","5590","5610","40");
$wifi_freq_table[] = array("120","5590","5600","5610","20");
$wifi_freq_table[] = array("122","5570","5610","5650","80");
$wifi_freq_table[] = array("124","5610","5620","5630","20");
$wifi_freq_table[] = array("126","5610","5630","5650","40");
$wifi_freq_table[] = array("128","5630","5640","5650","20");
$wifi_freq_table[] = array("132","5650","5660","5670","20");
$wifi_freq_table[] = array("134","5650","5670","5690","40");
$wifi_freq_table[] = array("136","5670","5680","5690","20");
$wifi_freq_table[] = array("138","5650","5690","5730","80");
$wifi_freq_table[] = array("140","5690","5700","5710","20");
$wifi_freq_table[] = array("142","5690","5710","5730","40");
$wifi_freq_table[] = array("144","5710","5720","5730","20");
$wifi_freq_table[] = array("149","5735","5745","5755","20");
$wifi_freq_table[] = array("151","5735","5755","5775","40");
$wifi_freq_table[] = array("153","5755","5765","5775","20");
$wifi_freq_table[] = array("155","5735","5775","5815","80");
$wifi_freq_table[] = array("157","5775","5785","5795","20");
$wifi_freq_table[] = array("159","5775","5795","5815","40");
$wifi_freq_table[] = array("161","5795","5805","5815","20");
$wifi_freq_table[] = array("165","5815","5825","5835","20");

foreach($stack as $key => $value)
{
	$timestamp = $value["timestamp"];
	$year = strtok($timestamp,"-");
        $mon = strtok("-");
        $day = strtok(" ");
        $hour = trim(strtok(":"));
        $min = strtok("\n");

        $dst_stamp = mktime($hour,$min,0,$mon,$day,$year);
        $tz = new DateTimeZone(date_default_timezone_get());
        $transition = $tz->getTransitions($dst_stamp,$dst_stamp);
        //pre_print($transition);
        # only one array should be returned into $transition. Now get the data:
        $offset = ltrim($transition[0]['offset'],"-"); 

        //$time_stamp = (mktime($hour,$min,0,$mon,$day,$year) - 21600) * 1000; //Might need this for daylight savings time in the fall
        //$time_stamp = (mktime($hour,$min,0,$mon,$day,$year) - 18000) * 1000;
        $time_stamp = (mktime($hour,$min,0,$mon,$day,$year) - $offset) * 1000;

        $epoch_timestamp = mktime($hour,$min,0,$mon,$day,$year);

	$connected_ssid = $value["ssid"];
	$connected_ssid_mac = $value["ssid_mac"];
	$connected_ssid_freq = $value["freq"];
	$link_quality_percent = $value["link_quality_percent"];
	$sig_level = $value["sig_level"];
	$bit_rate = $value["bit_rate"];
	$tx_excessive_retries = $value["tx_excessive_retries"];
	$center_freq = $value["center_freq"];
	$width = $value["width"];

	foreach($wifi_freq_table as $key => $value)
	{
		$channel = $value[0];
		$lowfreq = $value[1];
		$centerfreq = $value[2];
		$highfreq = $value[3];

		if($connected_ssid_freq == $centerfreq)
		{
			$active_channel = $channel;
			break;
		}
	} 

	if(!in_array($connected_ssid_mac,$connected_ssid_mac_id))
	{
		$probable_ap_mac = substr($connected_ssid_mac, 0, 15);

		$connected_ssid_mac_id[] = $connected_ssid_mac;
		foreach($graph_devices["devices"] as $dkey => $gdevice)
		{
			//print "gdevice = $gdevice connected_ssid_mac: $connected_ssid_mac<bR>";
			if(preg_match("/$probable_ap_mac/i",$gdevice))
			{
				if(preg_match("/$connected_ssid_mac/i",$gdevice))
					$ap_hostname = strtok($gdevice,"|")."!";
				else
					$ap_hostname = strtok($gdevice,"|")."?";
			}
		}
		$connected_ssid_mac_hostname[] = $ap_hostname;
		//pre_print($connected_ssid_mac_hostname);
	}

	$connected_ap_id = array_search($connected_ssid_mac, $connected_ssid_mac_id);

	$clean_wifi_sig["timestamp"][] = $time_stamp;
	$clean_wifi_sig["epoch_timestamp"][] = $epoch_timestamp;
	$clean_wifi_sig["link_quality"][] = $link_quality_percent;
	$clean_wifi_sig["sig_level"][] = $sig_level;
	$clean_wifi_sig["bit_rate"][] = $bit_rate;
	$clean_wifi_sig["ssid_mac_id"][] = $connected_ap_id;
	$clean_wifi_sig["ssid_mac"][] = $connected_ssid_mac;
	$clean_wifi_sig["channel"][] = $active_channel;
	$clean_wifi_sig["tx_excessive_retries"][] = $tx_excessive_retries;
	$clean_wifi_sig["center_freq"][] = $center_freq;
	$clean_wifi_sig["width"][] = $width;

}

array_multisort($clean_wifi_sig["timestamp"], SORT_ASC, $clean_wifi_sig["link_quality"], SORT_ASC, $clean_wifi_sig["sig_level"], SORT_ASC, $clean_wifi_sig["bit_rate"], SORT_ASC, $clean_wifi_sig["ssid_mac_id"], SORT_ASC, $clean_wifi_sig["ssid_mac"], SORT_ASC, $clean_wifi_sig["channel"], SORT_ASC, $clean_wifi_sig["tx_excessive_retries"], SORT_ASC, $clean_wifi_sig["center_freq"], SORT_ASC, $clean_wifi_sig["width"], SORT_ASC);
//pre_print($clean_wifi_sig);
//pre_print($connected_ssid_mac_id);





$stack = query_table("*","ssid_scan","hostname = '$monitor' AND (timestamp >= '$start_date' and timestamp <= '$end_date')");
//pre_print($stack);
foreach($stack as $key => $value)
{
	$timestamp = $value["timestamp"];
	$year = strtok($timestamp,"-");
        $mon = strtok("-");
        $day = strtok(" ");
        $hour = trim(strtok(":"));
        $min = strtok("\n");
        //$time_stamp = (mktime($hour,$min,0,$mon,$day,$year) - 21600) * 1000;
        $time_stamp = mktime($hour,$min,0,$mon,$day,$year);

	$ssid_scan = $value["ssid_scan"];
	$ssid_scan_list = explode("|",$ssid_scan);
	array_pop($ssid_scan_list);
	$all_ssid_scan[$time_stamp][] = $ssid_scan_list;

	
}
foreach($all_ssid_scan as $time_stamp => $scan_list)
{
	foreach($scan_list[0] as $key => $scan)
	{
		$scan_details = explode(";",$scan);
		//pre_print($scan_details);
		$ssid = $scan_details[0];		
		$channel = $scan_details[1];		
		$scan_freq = $scan_details[2];		
		$sig_level = $scan_details[3];		
		$ssid_mac = $scan_details[4];		
		$center_freq = $scan_details[5];		
		$width = $scan_details[6];		
		$station_count = $scan_details[7];
		$ch_utilization = $scan_details[8];

		if(!$channel)
		{
			foreach($wifi_freq_table as $key => $values)
			{
				if($scan_freq ==  $values[2])
					$channel = $values[0];				
			}
		}

		/*
		if(strpos($scan, ';') === 0)
		{
			$ssid = "HIDDEN";
			$channel = strtok($scan,";");
		}
		else
		{
			$ssid = strtok($scan, ";");
			$channel = strtok(";");

		}

		if(preg_match("/x00x00x00x00/i",$ssid))
			$ssid = "x00x00x00";
		
		$scan_freq = strtok(";");
		$sig_level = strtok(";");
		$ssid_mac = strtok(";");
		$center_freq = strtok(";");
		$width = strtok("\n");
		*/
		
		if(preg_match("/x00x00x00x00/i",$ssid))
			$ssid = "x00x00x00";


		$clean_ssid_scan["timestamp"][] = $time_stamp;
		$clean_ssid_scan["ssid"][] = $ssid." | ".$ssid_mac."| CH:$channel | WIDTH:$width";
		$clean_ssid_scan["channel"][] = $channel;
		$clean_ssid_scan["sig_level"][] = str_replace("-","",$sig_level);
		$clean_ssid_scan["ssid_mac"][] = $ssid_mac;
		$clean_ssid_scan["center_freq"][] = $center_freq;
		$clean_ssid_scan["width"][] = $width;
		$clean_ssid_scan["station_count"][] = $station_count;
		$clean_ssid_scan["ch_utilization"][] = $ch_utilization;
	}
}
array_multisort($clean_ssid_scan["timestamp"], SORT_ASC, $clean_ssid_scan["ssid"], SORT_ASC, $clean_ssid_scan["channel"], SORT_ASC, $clean_ssid_scan["sig_level"], SORT_ASC, $clean_ssid_scan["ssid_mac"], SORT_ASC, $clean_ssid_scan["center_freq"], SORT_ASC, $clean_ssid_scan["width"], SORT_ASC, $clean_ssid_scan["station_count"], SORT_ASC, $clean_ssid_scan["ch_utilization"], SORT_ASC);

//pre_print($all_ssid_scan);
//pre_print($clean_ssid_scan);

//pre_print($clean_ssid_scan);
//pre_print($clean_wifi_sig);

$connected_aps = array_unique($clean_wifi_sig["ssid_mac"]);
//pre_print($connected_aps);
foreach($clean_ssid_scan["ssid_mac"] as $key => $ssid_mac)
{
	if(in_array(strtoupper($ssid_mac),$connected_aps))
	{
		//print "$ssid<br>";
		//print "utilization: ".$clean_ssid_scan["ch_utilization"][$key]."<br>";
		//print "station: ".$clean_ssid_scan["station_count"][$key]."<br>";
		//print "timestamp: ".$clean_ssid_scan["timestamp"][$key]."<br><br>";

		if(in_array($clean_ssid_scan["timestamp"][$key], $clean_wifi_sig["epoch_timestamp"]))
		{
			$found_key = array_search($clean_ssid_scan["timestamp"][$key], $clean_wifi_sig["epoch_timestamp"]);
			//print "i'm here found_key:$found_key<br>";
			if($ssid_mac == strtolower($clean_wifi_sig["ssid_mac"][$found_key]))
			{
		
				if(!in_array($ssid_mac,$connected_ssid_mac_id_util))
				{
					$connected_ssid_mac_id_util[] = $ssid_mac;
				}

				$connected_ap_id_util = array_search($ssid_mac, $connected_ssid_mac_id_util);
				
				$tz = new DateTimeZone(date_default_timezone_get());
				$transition = $tz->getTransitions($clean_ssid_scan["timestamp"][$key],$clean_ssid_scan["timestamp"][$key]);
				//pre_print($transition);
				$offset = ltrim($transition[0]['offset'],"-"); 
				$time_stamp = ($clean_ssid_scan["timestamp"][$key] - $offset) * 1000;

				$graph_utilization["timestamp"][] = $time_stamp;
				$graph_utilization["epoch_timestamp"][] = $clean_ssid_scan["timestamp"][$key];
				$graph_utilization["ssid_mac"][] = $ssid_mac;
				$graph_utilization["ssid_mac_id"][] = $connected_ap_id_util;
				$graph_utilization["channel"][] = $clean_ssid_scan["channel"][$key];
				if($clean_ssid_scan["station_count"][$key])
					$graph_utilization["clients"][] = $clean_ssid_scan["station_count"][$key];
				else
					$graph_utilization["clients"][] = -1;

				if($clean_ssid_scan["ch_utilization"][$key])
					$graph_utilization["utilization"][] = $clean_ssid_scan["ch_utilization"][$key];
				else
					$graph_utilization["utilization"][] = -1;
			}
		}
	}

}
//pre_print($graph_utilization);
//pre_print($graph_utilization_all);
//pre_print($clean_wifi_sig);
//pre_print($clean_ssid_scan);


foreach($clean_ssid_scan["timestamp"] as $key => $timestamp)
{
	if(!in_array($timestamp, $graph_ssid_scan["timestamp"]))
		$graph_ssid_scan["timestamp"][] = $timestamp;
	
	$ssid = $clean_ssid_scan["ssid"][$key];
	$graph_ssid_scan[$ssid][$timestamp] = $clean_ssid_scan["sig_level"][$key];
		

	$avg_ssid_scan_levels["$ssid"]["added_levels"] = $avg_ssid_scan_levels["$ssid"]["added_levels"] + $clean_ssid_scan["sig_level"][$key];
	if($clean_ssid_scan["ch_utilization"][$key])
	{
		$avg_ssid_scan_levels["$ssid"]["added_ch_utilization_levels"] = $avg_ssid_scan_levels["$ssid"]["added_ch_utilization_levels"] + $clean_ssid_scan["ch_utilization"][$key];
		$avg_ssid_scan_levels["$ssid"]["number_of_ch_utilization_levels"]++;
		
	}
	$avg_ssid_scan_levels["$ssid"]["width"] = $clean_ssid_scan["width"][$key];
	$avg_ssid_scan_levels["$ssid"]["channel"] = $clean_ssid_scan["channel"][$key];
	$avg_ssid_scan_levels["$ssid"]["center_freq"] = $clean_ssid_scan["center_freq"][$key];
	$avg_ssid_scan_levels["$ssid"]["number_of_signal_levels"]++;
	$avg_ssid_scan_levels["$ssid"]["avg_signal_level"] = round($avg_ssid_scan_levels["$ssid"]["added_levels"] / $avg_ssid_scan_levels["$ssid"]["number_of_signal_levels"]);
	$avg_ssid_scan_levels["$ssid"]["avg_ch_utilization"] = round($avg_ssid_scan_levels["$ssid"]["added_ch_utilization_levels"] / $avg_ssid_scan_levels["$ssid"]["number_of_ch_utilization_levels"]);
	
}

foreach($clean_ssid_scan["ssid"] as $key => $ssid)
{
	if(!in_array($ssid, $graph_ssid_scan["ssid"]))
		$graph_ssid_scan["ssid"][] = $ssid;
}

//pre_print($avg_ssid_scan_levels);

//pre_print($graph_ssid_scan);

/*
foreach($graph_ssid_scan["ssid"] as $key => $ssid)
{
	foreach($graph_ssid_scan["$ssid"] as $key2 => $da_sig_level)
	{
		$avg_ssid_scan_levels["$ssid"]["added_levels"] = $avg_ssid_scan_levels["$ssid"]["added_levels"] + $da_sig_level;
		$avg_ssid_scan_levels["$ssid"]["number_of_signal_levels"]++;
		$avg_ssid_scan_levels["$ssid"]["avg_signal_level"] = floor($avg_ssid_scan_levels["$ssid"]["added_levels"] / $avg_ssid_scan_levels["$ssid"]["number_of_signal_levels"]);
		
	}
}
*/

foreach($avg_ssid_scan_levels as $da_ssid => $value)
{
	//print "da_center_freq:".$value["center_freq"]."<br>";
	foreach($wifi_freq_table as $key => $wifi_table)
	{
		if(strlen($value["center_freq"]) <= 3)
		{
			if($wifi_table[0] == $value["center_freq"])
			{
				//pre_print($wifi_freq_table[$key]);
				$avg_ssid_scan_levels["$da_ssid"]["low_freq"] = $wifi_table[1];
				$avg_ssid_scan_levels["$da_ssid"]["high_freq"] = $wifi_table[3];
			}
		}
		else
		{
			if($wifi_table[2] == $value["center_freq"])
			{
				//pre_print($wifi_freq_table[$key]);
				$avg_ssid_scan_levels["$da_ssid"]["low_freq"] = $wifi_table[1];
				$avg_ssid_scan_levels["$da_ssid"]["high_freq"] = $wifi_table[3];
			}
		}
	}
	if(!is_nan($value["avg_ch_utilization"]))
	{
		$avg_ssid_scan_levels_clean_util[$da_ssid] = $avg_ssid_scan_levels["$da_ssid"];
	}
}
//pre_print($avg_ssid_scan_levels);
//pre_print($avg_ssid_scan_levels_clean_util);


//pre_print($graph_ssid_scan);
if($ssid_filter_enabled)
{
	foreach($avg_ssid_scan_levels as $ssid_key => $ssid_values)
	{
		if($ssid_values["avg_signal_level"] > $ssid_filter_size)
		{
			unset($avg_ssid_scan_levels[$ssid_key]);
			unset($graph_ssid_scan[$ssid_key]);
			unset($avg_ssid_scan_levels_clean_util[$ssid_key]);
			foreach($graph_ssid_scan["ssid"] as $ssid_sub_key => $ssid_sub_value)
			{
				if($ssid_sub_value == $ssid_key)
				{
					unset($graph_ssid_scan["ssid"][$ssid_sub_key]);
					break;
				}
			}
		}
	}
}
//pre_print($avg_ssid_scan_levels);
//pre_print($graph_ssid_scan);




// ------============= START OF THE AVG SSID ALL SCAN TABLE ==============------------
//print "========================================================================================================<br>";
$stack = query_table("*","ssid_scan_all","hostname = '$monitor' AND (timestamp >= '$start_date' and timestamp <= '$end_date')");
//pre_print($stack);
foreach($stack as $key => $value)
{
	$timestamp = $value["timestamp"];
	$year = strtok($timestamp,"-");
        $mon = strtok("-");
        $day = strtok(" ");
        $hour = trim(strtok(":"));
        $min = strtok("\n");
        //$time_stamp = (mktime($hour,$min,0,$mon,$day,$year) - 21600) * 1000;
        $time_stamp = mktime($hour,$min,0,$mon,$day,$year);

	$ssid_scan = $value["ssid_scan"];
	$ssid_scan_list = explode("|",$ssid_scan);
	array_pop($ssid_scan_list);
	$all_ssid_scan_all[$time_stamp][] = $ssid_scan_list;

	
}
foreach($all_ssid_scan_all as $time_stamp => $scan_list)
{
	foreach($scan_list[0] as $key => $scan)
	{
		$scan_details = explode(";",$scan);
		//pre_print($scan_details);
		$ssid = $scan_details[0];		
		$channel = $scan_details[1];		
		$scan_freq = $scan_details[2];		
		$sig_level = $scan_details[3];		
		$ssid_mac = $scan_details[4];		
		$center_freq = $scan_details[5];		
		$width = $scan_details[6];		
		$station_count = $scan_details[7];
		$ch_utilization = $scan_details[8];


		if(!$channel)
		{
			foreach($wifi_freq_table as $key => $values)
			{
				if($scan_freq ==  $values[2])
					$channel = $values[0];				
			}
		}

		/*
		if(strpos($scan, ';') === 0)
		{
			$ssid = "HIDDEN";
			$channel = strtok($scan,";");
		}
		else
		{
			$ssid = strtok($scan, ";");
			$channel = strtok(";");

		}

		if(preg_match("/x00x00x00x00/i",$ssid))
			$ssid = "x00x00x00";
		
		$scan_freq = strtok(";");
		$sig_level = strtok(";");
		$ssid_mac = strtok(";");
		$center_freq = strtok(";");
		$width = strtok("\n");
		*/
		
		if(preg_match("/x00x00x00x00/i",$ssid))
			$ssid = "x00x00x00";


		$clean_ssid_scan_all["timestamp"][] = $time_stamp;
		$clean_ssid_scan_all["ssid"][] = $ssid." | ".$ssid_mac."| CH:$channel | WIDTH:$width";
		$clean_ssid_scan_all["channel"][] = $channel;
		$clean_ssid_scan_all["sig_level"][] = str_replace("-","",$sig_level);
		$clean_ssid_scan_all["ssid_mac"][] = $ssid_mac;
		$clean_ssid_scan_all["center_freq"][] = $center_freq;
		$clean_ssid_scan_all["width"][] = $width;
		$clean_ssid_scan_all["station_count"][] = $station_count;
		$clean_ssid_scan_all["ch_utilization"][] = $ch_utilization;
	}
}
array_multisort($clean_ssid_scan_all["timestamp"], SORT_ASC, $clean_ssid_scan_all["ssid"], SORT_ASC, $clean_ssid_scan_all["channel"], SORT_ASC, $clean_ssid_scan_all["sig_level"], SORT_ASC, $clean_ssid_scan_all["ssid_mac"], SORT_ASC, $clean_ssid_scan_all["center_freq"], SORT_ASC, $clean_ssid_scan_all["width"], SORT_ASC, $clean_ssid_scan_all["station_count"], SORT_ASC, $clean_ssid_scan_all["ch_utilization"], SORT_ASC);
//pre_print($all_ssid_scan);

//pre_print($clean_ssid_scan_all);

foreach($clean_ssid_scan_all["timestamp"] as $key => $timestamp)
{
	if(!in_array($timestamp, $graph_ssid_scan_all["timestamp"]))
		$graph_ssid_scan_all["timestamp"][] = $timestamp;
	
	$ssid = $clean_ssid_scan_all["ssid"][$key];
	$graph_ssid_scan_all[$ssid][$timestamp] = $clean_ssid_scan_all["sig_level"][$key];
		

	$avg_ssid_scan_levels_all["$ssid"]["added_levels"] = $avg_ssid_scan_levels_all["$ssid"]["added_levels"] + $clean_ssid_scan_all["sig_level"][$key];
	if($clean_ssid_scan_all["ch_utilization"][$key])
	{
		$avg_ssid_scan_levels_all["$ssid"]["added_ch_utilization_levels"] = $avg_ssid_scan_levels_all["$ssid"]["added_ch_utilization_levels"] + $clean_ssid_scan_all["ch_utilization"][$key];
		$avg_ssid_scan_levels_all["$ssid"]["number_of_ch_utilization_levels"]++;
		
	}
	$avg_ssid_scan_levels_all["$ssid"]["width"] = $clean_ssid_scan_all["width"][$key];
	$avg_ssid_scan_levels_all["$ssid"]["channel"] = $clean_ssid_scan_all["channel"][$key];
	$avg_ssid_scan_levels_all["$ssid"]["center_freq"] = $clean_ssid_scan_all["center_freq"][$key];
	$avg_ssid_scan_levels_all["$ssid"]["number_of_signal_levels"]++;
	$avg_ssid_scan_levels_all["$ssid"]["avg_signal_level"] = round($avg_ssid_scan_levels_all["$ssid"]["added_levels"] / $avg_ssid_scan_levels_all["$ssid"]["number_of_signal_levels"]);
	$avg_ssid_scan_levels_all["$ssid"]["avg_ch_utilization"] = round($avg_ssid_scan_levels_all["$ssid"]["added_ch_utilization_levels"] / $avg_ssid_scan_levels_all["$ssid"]["number_of_ch_utilization_levels"]);
	


	$tz = new DateTimeZone(date_default_timezone_get());
	$transition = $tz->getTransitions($clean_ssid_scan_all["timestamp"][$key],$clean_ssid_scan_all["timestamp"][$key]);
	//pre_print($transition);
	$offset = ltrim($transition[0]['offset'],"-"); 
	$time_stamp = ($clean_ssid_scan_all["timestamp"][$key] - $offset) * 1000;

	$graph_utilization_all[$ssid]["timestamp"][] = $time_stamp;
	$graph_utilization_all[$ssid]["epoch_timestamp"][] = $clean_ssid_scan_all["timestamp"][$key];
	$graph_utilization_all[$ssid]["ssid_mac"][] = $clean_ssid_scan_all["ssid_mac"][$key];
	$graph_utilization_all[$ssid]["channel"][] = $clean_ssid_scan_all["channel"][$key];
	if($clean_ssid_scan_all["station_count"][$key])
		$graph_utilization_all[$ssid]["clients"][] = $clean_ssid_scan_all["station_count"][$key];
	else
		$graph_utilization_all[$ssid]["clients"][] = -1;

	if($clean_ssid_scan_all["ch_utilization"][$key])
		$graph_utilization_all[$ssid]["utilization"][] = $clean_ssid_scan_all["ch_utilization"][$key];
	else
		$graph_utilization_all[$ssid]["utilization"][] = -1;
	
}

foreach($clean_ssid_scan_all["ssid"] as $key => $ssid)
{
	if(!in_array($ssid, $graph_ssid_scan_all["ssid"]))
		$graph_ssid_scan_all["ssid"][] = $ssid;
}
//pre_print($avg_ssid_scan_levels_all);


//pre_print($graph_ssid_scan_all);

/*
foreach($graph_ssid_scan["ssid"] as $key => $ssid)
{
	foreach($graph_ssid_scan["$ssid"] as $key2 => $da_sig_level)
	{
		$avg_ssid_scan_levels["$ssid"]["added_levels"] = $avg_ssid_scan_levels["$ssid"]["added_levels"] + $da_sig_level;
		$avg_ssid_scan_levels["$ssid"]["number_of_signal_levels"]++;
		$avg_ssid_scan_levels["$ssid"]["avg_signal_level"] = floor($avg_ssid_scan_levels["$ssid"]["added_levels"] / $avg_ssid_scan_levels["$ssid"]["number_of_signal_levels"]);
		
	}
}
*/

foreach($avg_ssid_scan_levels_all as $da_ssid => $value)
{
	//print "da_center_freq:".$value["center_freq"]."<br>";
	foreach($wifi_freq_table as $key => $wifi_table)
	{
		if(strlen($value["center_freq"]) <= 3)
		{
			if($wifi_table[0] == $value["center_freq"])
			{
				//pre_print($wifi_freq_table[$key]);
				$avg_ssid_scan_levels_all["$da_ssid"]["low_freq"] = $wifi_table[1];
				$avg_ssid_scan_levels_all["$da_ssid"]["high_freq"] = $wifi_table[3];
			}
		}
		else
		{
			if($wifi_table[2] == $value["center_freq"])
			{
				//pre_print($wifi_freq_table[$key]);
				$avg_ssid_scan_levels_all["$da_ssid"]["low_freq"] = $wifi_table[1];
				$avg_ssid_scan_levels_all["$da_ssid"]["high_freq"] = $wifi_table[3];
			}
		}
	}
}
//pre_print($avg_ssid_scan_levels);


if($ssid_filter_enabled)
{
	foreach($avg_ssid_scan_levels_all as $ssid_key => $ssid_values)
	{
		if($ssid_values["avg_signal_level"] > $ssid_filter_size)
		{
			unset($avg_ssid_scan_levels_all[$ssid_key]);
			unset($graph_ssid_scan_all[$ssid_key]);
			unset($graph_utilization_all[$ssid_key]);
			foreach($graph_ssid_scan_all["ssid"] as $ssid_sub_key => $ssid_sub_value)
			{
				if($ssid_sub_value == $ssid_key)
				{
					unset($graph_ssid_scan_all["ssid"][$ssid_sub_key]);
					break;
				}
			}
		}
	}
}


//pre_print($avg_ssid_scan_levels_all);
//pre_print($graph_ssid_scan_all);

foreach($avg_ssid_scan_levels_all as $ssid_key => $ssid_values)
{
	if(!is_nan($ssid_values["avg_ch_utilization"]))
	{
		$avg_ssid_scan_levels_all_clean_util[$ssid_key] = $ssid_values;
	}

	if($ssid_values["channel"] > 11)
	{

		$avg_ssid_scan_levels_all_5g[$ssid_key] = $ssid_values;
		$graph_ssid_scan_all_5g["ssid"][] = $ssid_key;
		$graph_ssid_scan_all_5g[$ssid_key] = $graph_ssid_scan_all[$ssid_key];

		if(!is_nan($ssid_values["avg_ch_utilization"]))
		{
			$avg_ssid_scan_levels_all_clean_util_5g[$ssid_key] = $ssid_values;
		}

		unset($avg_ssid_scan_levels_all[$ssid_key]);
		unset($graph_ssid_scan_all[$ssid_key]);
		unset($avg_ssid_scan_levels_all_clean_util[$ssid_key]);
		foreach($graph_ssid_scan_all["ssid"] as $ssid_sub_key => $ssid_sub_value)
		{
			if($ssid_sub_value == $ssid_key)
			{
				unset($graph_ssid_scan_all["ssid"][$ssid_sub_key]);
				break;
			}
		}
	}
}
$graph_ssid_scan_all_5g["timestamp"] = $graph_ssid_scan_all["timestamp"];
//pre_print($avg_ssid_scan_levels_all_5g);
//pre_print($graph_ssid_scan_all_5g);


//pre_print($avg_ssid_scan_levels);
//pre_print($avg_ssid_scan_levels_all);
//pre_print($graph_ssid_scan_all);

//pre_print($avg_ssid_scan_levels_all_clean_util);



//<script src=\"https://code.jquery.com/jquery-3.1.1.min.js\"></script>
print "
<script src=\"https://code.highcharts.com/stock/highstock.js\"></script>
<script src=\"https://code.highcharts.com/stock/modules/exporting.js\"></script>
<script src=\"https://code.highcharts.com/highcharts-more.js\"></script>
<script src=\"https://code.highcharts.com/modules/exporting.js\"></script>
<script src=\"https://code.highcharts.com/modules/export-data.js\"></script>



<div id=\"wifi_stats\" style=\"height: 550px; min-width: 310px\"></div>
";


print "
<script type=\"text/javascript\">
  // Create the chart
    Highcharts.stockChart('wifi_stats', {


        rangeSelector: {
                       buttons: [{
                type: 'minute',
                count: 15,
                text: '15m'
            }, {
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'hour',
                count: 3,
                text: '3h'
            }, {
                type: 'day',
                count: 1,
                text: '1d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 6
        },

        title: {
            text: '$monitor <b>WiFi Link Quality</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | WIDTH: $width] <br>";

foreach($connected_ssid_mac_id as $key => $value)
{
	print "<u>AP ID: </u>$key --> $value [ ".$connected_ssid_mac_hostname[$key]." ]<br>";
}

print " '
        },

        series: [{
            name: 'Quality %',
            data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$link_quality_percent = $clean_wifi_sig["link_quality"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$link_quality_percent],";
	else
		print "[$time_stamp,$link_quality_percent]";
}
print "
	],
		tooltip: {
			valueDecimals: 0,
		}
}";

print "
	,{
	name: 'Signal Level',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$sig_level = $clean_wifi_sig["sig_level"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,-$sig_level],";
	else
		print "[$time_stamp,-$sig_level]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";

/*
print "
	,{
	name: 'Bit Rate',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$bit_rate = $clean_wifi_sig["bit_rate"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$bit_rate],";
	else
		print "[$time_stamp,$bit_rate]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";
*/



print "
	,{
	name: 'Active Channel',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$active_channel = $clean_wifi_sig["channel"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$active_channel],";
	else
		print "[$time_stamp,$active_channel]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";



print "
	,{
	name: 'Connected Access Point ID',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$ap_mac_id = $clean_wifi_sig["ssid_mac_id"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$ap_mac_id],";
	else
		print "[$time_stamp,$ap_mac_id]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";





print "]   
});
";
print "</script>";









print "<div id=\"wifi_stats_2\" style=\"height: 550px; min-width: 310px\"></div>";

print "
<script type=\"text/javascript\">
  // Create the chart
    Highcharts.stockChart('wifi_stats_2', {


        rangeSelector: {
                       buttons: [{
                type: 'minute',
                count: 15,
                text: '15m'
            }, {
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'hour',
                count: 3,
                text: '3h'
            }, {
                type: 'day',
                count: 1,
                text: '1d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 6
        },

        title: {
            text: '$monitor <b>Bitrate & Active Channel Width</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | WIDTH: $width] <br>";

foreach($connected_ssid_mac_id as $key => $value)
{
	print "<u>AP ID: </u>$key --> $value [ ".$connected_ssid_mac_hostname[$key]." ]<br>";
}

print " '
        },

        series: [{
            name: 'Active Channel Width',
            data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$active_channel_width = $clean_wifi_sig["width"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$active_channel_width],";
	else
		print "[$time_stamp,$active_channel_width]";
}
print "
	],
		tooltip: {
			valueDecimals: 0,
		}
}";

print "
	,{
	name: 'Bit Rate',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$bit_rate = $clean_wifi_sig["bit_rate"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$bit_rate],";
	else
		print "[$time_stamp,$bit_rate]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";


print "
	,{
	name: 'Connected Access Point ID',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$ap_mac_id = $clean_wifi_sig["ssid_mac_id"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$ap_mac_id],";
	else
		print "[$time_stamp,$ap_mac_id]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";


print "
	,{
	name: 'Active Channel',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$active_channel = $clean_wifi_sig["channel"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$active_channel],";
	else
		print "[$time_stamp,$active_channel]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";





print "]   
});
";
print "</script>";















print "
<div id=\"wifi_stats_retries\" style=\"height: 450px; min-width: 310px\"></div>
";


print "
<script type=\"text/javascript\">
  // Create the chart
    Highcharts.stockChart('wifi_stats_retries', {


        rangeSelector: {
                       buttons: [{
                type: 'minute',
                count: 15,
                text: '15m'
            }, {
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'hour',
                count: 3,
                text: '3h'
            }, {
                type: 'day',
                count: 1,
                text: '1d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 6
        },

        title: {
            text: '$monitor <b>WiFi TX EXCESSIVE RETRIES</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width:$width] <br>";

foreach($connected_ssid_mac_id as $key => $value)
{
	print "<u>AP ID: </u>$key --> $value [ ".$connected_ssid_mac_hostname[$key]." ]<br>";
}

print " '
        },

        series: [{
            name: 'TX EXCESSIVE RETRIES',
            data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$tx_retries = $clean_wifi_sig["tx_excessive_retries"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$tx_retries],";
	else
		print "[$time_stamp,$tx_retries]";
}
print "
	],
		tooltip: {
			valueDecimals: 0,
		}
}";



print "
	,{
	name: 'Active Channel',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$active_channel = $clean_wifi_sig["channel"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$active_channel],";
	else
		print "[$time_stamp,$active_channel]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";


print "
	,{
	name: 'Connected Access Point ID',
	data: [
";

$last_key = end(array_keys($clean_wifi_sig["timestamp"]));
foreach($clean_wifi_sig["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$ap_mac_id = $clean_wifi_sig["ssid_mac_id"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$ap_mac_id],";
	else
		print "[$time_stamp,$ap_mac_id]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";



print "]   
});
";
print "</script>";









//pre_print($graph_utilization);
print "
<div id=\"wifi_stats_util\" style=\"height: 450px; min-width: 310px\"></div>
";


print "
<script type=\"text/javascript\">
  // Create the chart
    Highcharts.stockChart('wifi_stats_util', {


        rangeSelector: {
                       buttons: [{
                type: 'minute',
                count: 15,
                text: '15m'
            }, {
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'hour',
                count: 3,
                text: '3h'
            }, {
                type: 'day',
                count: 1,
                text: '1d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 6
        },

        title: {
	    useHTML: 1,
            text: '<center>$monitor <b>WiFi UTILIZATION</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width:$width] <br>";

foreach($connected_ssid_mac_id_util as $key => $value)
{
	//print "<u>AP ID: </u>$key --> $value [ ".$connected_ssid_mac_hostname[$key]." ]<br>";
	print "AP ID: $key --> $value<br>";
}
print "<i><font size=1>NOTE: NOT ALL SSIDS REPORT UTILIZATION INFORMATION</font></i><br>";

print " '
        },

        series: [{
            name: 'CHANNEL UTILIZATION %',
            data: [
";

$last_key = end(array_keys($graph_utilization["timestamp"]));
foreach($graph_utilization["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$utilization = $graph_utilization["utilization"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$utilization],";
	else
		print "[$time_stamp,$utilization]";
}
print "
	],
		tooltip: {
			valueDecimals: 0,
		}
}";



print "
	,{
	name: 'Active Channel',
	data: [
";

$last_key = end(array_keys($graph_utilization["timestamp"]));
foreach($graph_utilization["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$active_channel = $graph_utilization["channel"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$active_channel],";
	else
		print "[$time_stamp,$active_channel]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";


print "
	,{
	name: 'Connected Access Point ID',
	data: [
";

$last_key = end(array_keys($graph_utilization["timestamp"]));
foreach($graph_utilization["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$ap_mac_id = $graph_utilization["ssid_mac_id"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$ap_mac_id],";
	else
		print "[$time_stamp,$ap_mac_id]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";




print "
	,{
	name: 'Connected Clients',
	data: [
";

$last_key = end(array_keys($graph_utilization["timestamp"]));
foreach($graph_utilization["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$connected_clients = $graph_utilization["clients"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$connected_clients],";
	else
		print "[$time_stamp,$connected_clients]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";



print "]   
});
";
print "</script>";






















print "
<div id=\"ssid_scan\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan', {

    title: {
        text: '$monitor <b>OVERLAPPING SSID SCAN ON CURRENTLY JOINED CHANNEL</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width:$width]'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'line',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($graph_ssid_scan["timestamp"]));
foreach($graph_ssid_scan["timestamp"] as $key => $time_stamp)
{
	$timestamp = date("m-d-Y H:i",$time_stamp);

	if($key != $last_key)
		print "'$timestamp',";
	else
		print "'$timestamp'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Signal Level'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            }
        }
    },

    series: [
";

$last_key = end(array_keys($graph_ssid_scan["ssid"]));
foreach($graph_ssid_scan["ssid"] as $key => $ssid)
{
	print "{
		";
	print "name: '$ssid',
	";
	print "data: [";

	$last_key2 = end(array_keys($graph_ssid_scan["timestamp"]));
	foreach($graph_ssid_scan["timestamp"] as $key2 => $timestamp)
	{

		if($key2 != $last_key2)
		{
			if($graph_ssid_scan[$ssid][$timestamp])
			{
				print "-".$graph_ssid_scan[$ssid][$timestamp].",";
			}
			else
				print "-125,";
		}
		else
		{
			if($graph_ssid_scan[$ssid][$timestamp])
			{
				print "-".$graph_ssid_scan[$ssid][$timestamp]."]";
			}
			else
				print "-125]";
			
		}

	}

	if($key != $last_key)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";

if(file_exists("./oui.txt"))
{
	print "<b>OVERLAPPING SSID AP DETAILS:</b>";
	print "<select>";
	foreach($graph_ssid_scan as $the_ssid => $the_values)
	{
	        if(preg_match("/\|/i",$the_ssid))
	        {
	                //print "$the_ssid<br>";
	                //i'm here
	                $ssid_info = explode("|",$the_ssid);
	                //pre_print($ssid_info);
	                $mac_oid = trim(strtoupper(str_replace(":","-",substr($ssid_info[1],0,-9))));
	                $command = "grep \"$mac_oid\" ./oui.txt | ".'sed -e \'s/  \+/\t/g\' | cut -f4';
	                //print "command: $command<br>";
	                $ap_mfg = exec($command);
			if(!$ap_mfg)
				$ap_mfg = "?";
        	        //print "MAC OID: $mac_oid AP MFG: $ap_mfg<br>";

	                print "<option value=none>".$ssid_info[0]."|".$ssid_info[1]."|".$ap_mfg."|".$ssid_info[2]."|".$ssid_info[3]."</option>";

        	}
	}	
	print "</select><br><br>";
}
else
	print "<font size=3><i>TO GET MAC OUI MFG INFO FOR AP's PLEASE RUN THE FOLLOWING COMMAND IN THE WIPI SERVER DIRECTORY<br>wget http://standards-oui.ieee.org/oui.txt<br><br><br>";











for($x=2376;$x <= 2476; $x++)
{
	$wifi_freq_table_graph_clean[] = $x;
}

for($x=5145;$x <= 5840; $x = $x + 5)
{
	$wifi_freq_table_graph_clean[] = $x;
}

print "
<div id=\"ssid_scan_table\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_table', {

    title: {
        text: '$monitor <b>OVERLAPPING SSID SCAN ON CURRENTLY JOINED CHANNEL [AVG FREQ TABLE]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width: $width]'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	if($key != $last_key)
		print "'$freq_channel',";
	else
		print "'$freq_channel'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Signal Level'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: -125
        }
    },

    series: [
";

$last_ssid = end(array_keys($avg_ssid_scan_levels));
foreach($avg_ssid_scan_levels as $ssid => $avg_values)
{
	$avg_low_freq = $avg_values["low_freq"];
	$avg_high_freq = $avg_values["high_freq"];
	$avg_signal_level = $avg_values["avg_signal_level"];
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: '$ssid',
	";
	print "data: [";

	$last_key = end(array_keys($wifi_freq_table_graph_clean));
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		//$freq_channel = $values[1];

		if($key != $last_key)
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "-125,";
			elseif($freq_channel == $avg_low_freq || $freq_channel == $avg_high_freq)
				print "-$avg_signal_level,";
			else
			{
				print "-$avg_signal_level,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		else
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "-125]";
			else
				print "-$avg_signal_level]";
		}
	


	}

	if($ssid != $last_ssid)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";















print "
<div id=\"ssid_scan_table_utilization\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_table_utilization', {

    title: {
	useHTML: 1,
        text: '<center>$monitor <b>OVERLAPPING SSID SCAN ON CURRENTLY JOINED CHANNEL [AVG CHANNEL UTILIZATION PERCENTAGE]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width: $width]<br><i><font size=1>NOTE: NOT ALL SSIDS REPORT UTILIZATION INFORMATION</font></i><br>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	if($key != $last_key)
		print "'$freq_channel',";
	else
		print "'$freq_channel'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Percent Channel Utilization'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: 0
        }
    },

    series: [
";
$last_ssid = end(array_keys($avg_ssid_scan_levels_clean_util));
foreach($avg_ssid_scan_levels_clean_util as $ssid => $avg_values)
{
	$avg_low_freq = $avg_values["low_freq"];
	$avg_high_freq = $avg_values["high_freq"];
	$avg_ch_utilization = $avg_values["avg_ch_utilization"];
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: '[$ssid] %',
	";
	print "data: [";

	$last_key = end(array_keys($wifi_freq_table_graph_clean));
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		//$freq_channel = $values[1];

		if($key != $last_key)
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "0,";
			elseif($freq_channel == $avg_low_freq || $freq_channel == $avg_high_freq)
				print "$avg_ch_utilization,";
			else
			{
				print "$avg_ch_utilization,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		else
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "0]";
			else
				print "$avg_ch_utilization]";
		}
	


	}

	if($ssid != $last_ssid)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";


















// ================= devices ====================


//pre_print($graph_devices);
//pre_print($all_devices);

print "

<div id=\"devices\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('devices', {

    title: {
        text: '$monitor <b>ACTIVE DEVICES ON NETWORK</b>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'line',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($all_devices));
foreach($all_devices as $time_stamp => $device_array)
{
	$timestamp = date("m-d-Y H:i",$time_stamp);

	if($time_stamp != $last_key)
		print "'$timestamp',";
	else
		print "'$timestamp'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Device ID'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            }
        }
    },

    series: [
";

$last_key = end(array_keys($graph_devices["devices"]));
foreach($graph_devices["devices"] as $key => $device)
{
	print "{
		";
	print "name: '$device|ID:$key',
		step: 'right',
	";
	print "data: [";

	$last_key2 = end(array_keys($graph_devices["timestamp"]));
	foreach($graph_devices["timestamp"] as $time_stamp => $devices_array)
	{

		if($time_stamp != $last_key2)
		{
			if(in_array($device, $devices_array))
			{
				print "$key,";
			}
			else
				print "null,";
		}
		else
		{
			if(in_array($device, $devices_array))
			{
				print "$key]";
			}
			else
				print "null]";
			
		}

	}

	if($key != $last_key)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";

//pre_print($list_devices);
print "<b>DEVICE DETAILS:</b>";
print "<select>";
foreach($list_devices as $device_key => $the_device)
{
	print "<option value=$key>$the_device</option>";
}
print "</select>";
print "<br><br>";












print "<a name=the_middle></a>";
if($using_userspice == "yes")
{
	print "<br><br><a href=#the_top class=\"btn btn-info\">GO TO TOP</a>";
	print "<a href=#the_bottom class=\"btn btn-info\">GO TO BOTTOM</a>";
}
// ====================================== start of 2.4 all ssid scan charts =================================
print "<br><br><br><font size=6><u><b>FULL SSID SCAN RESULTS</b></u></font><br><br>";

print "
<div id=\"ssid_scan_all_24\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_all_24', {

    title: {
        text: '$monitor <b>FULL SSID SCAN [ALL 2.4 CHANNELS]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width:$width]'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'line',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($graph_ssid_scan_all["timestamp"]));
foreach($graph_ssid_scan_all["timestamp"] as $key => $time_stamp)
{
	$timestamp = date("m-d-Y H:i",$time_stamp);

	if($key != $last_key)
		print "'$timestamp',";
	else
		print "'$timestamp'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Signal Level'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            }
        }
    },

    series: [
";

$last_key = end(array_keys($graph_ssid_scan_all["ssid"]));
foreach($graph_ssid_scan_all["ssid"] as $key => $ssid)
{
	print "{
		";
	print "name: '$ssid',
	";
	print "data: [";

	$last_key2 = end(array_keys($graph_ssid_scan_all["timestamp"]));
	foreach($graph_ssid_scan_all["timestamp"] as $key2 => $timestamp)
	{

		if($key2 != $last_key2)
		{
			if($graph_ssid_scan_all[$ssid][$timestamp])
			{
				print "-".$graph_ssid_scan_all[$ssid][$timestamp].",";
			}
			else
				print "-125,";
		}
		else
		{
			if($graph_ssid_scan_all[$ssid][$timestamp])
			{
				print "-".$graph_ssid_scan_all[$ssid][$timestamp]."]";
			}
			else
				print "-125]";
			
		}

	}

	if($key != $last_key)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";

if(file_exists("./oui.txt"))
{
	print "<b>FULL SSID AP DETAILS:</b>";
	print "<select>";
	foreach($graph_ssid_scan_all as $the_ssid => $the_values)
	{
		if(preg_match("/\|/i",$the_ssid))
		{
			//print "$the_ssid<br>";
			//i'm here	
			$ssid_info = explode("|",$the_ssid);
			//pre_print($ssid_info);
			$mac_oid = trim(strtoupper(str_replace(":","-",substr($ssid_info[1],0,-9))));
			$command = "grep \"$mac_oid\" ./oui.txt | ".'sed -e \'s/  \+/\t/g\' | cut -f4';
			//print "command: $command<br>";
			$ap_mfg = exec($command);
			if(!$ap_mfg)
				$ap_mfg = "?";
			//print "MAC OID: $mac_oid AP MFG: $ap_mfg<br>";
			
			print "<option value=none>".$ssid_info[0]."|".$ssid_info[1]."|".$ap_mfg."|".$ssid_info[2]."|".$ssid_info[3]."</option>";
				
		}
	}
	print "</select><br><br>";
}
else
	print "<font size=3><i>TO GET MAC OUI MFG INFO FOR AP's PLEASE RUN THE FOLLOWING COMMAND IN THE WIPI SERVER DIRECTORY<br>wget http://standards-oui.ieee.org/oui.txt<br><br><br>";






/*
for($x=2376;$x <= 2476; $x++)
{
	$wifi_freq_table_graph_clean[] = $x;
}

for($x=5145;$x <= 5840; $x = $x + 5)
{
	$wifi_freq_table_graph_clean[] = $x;
}
*/

print "
<div id=\"ssid_scan_table_all_24\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_table_all_24', {

    title: {
        text: '$monitor <b>FULL SSID SCAN AVG FREQ TABLE [ALL 2.4 CHANNELS]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width: $width]'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	if($key != $last_key)
		print "'$freq_channel',";
	else
		print "'$freq_channel'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Signal Level'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: -125
        }
    },

    series: [
";

$last_ssid = end(array_keys($avg_ssid_scan_levels_all));
foreach($avg_ssid_scan_levels_all as $ssid => $avg_values)
{
	$avg_low_freq = $avg_values["low_freq"];
	$avg_high_freq = $avg_values["high_freq"];
	$avg_signal_level = $avg_values["avg_signal_level"];
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: '$ssid',
	";
	print "data: [";

	$last_key = end(array_keys($wifi_freq_table_graph_clean));
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		//$freq_channel = $values[1];

		if($key != $last_key)
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "-125,";
			elseif($freq_channel == $avg_low_freq || $freq_channel == $avg_high_freq)
				print "-$avg_signal_level,";
			else
			{
				print "-$avg_signal_level,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		else
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "-125]";
			else
				print "-$avg_signal_level]";
		}
	


	}

	if($ssid != $last_ssid)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";








//pre_print($avg_ssid_scan_levels_all);
if(!$avg_ssid_scan_levels_all_clean_util)
        print "<br>NO 2.4ghz Utilization statistics collected to be displayed<br>";

print "
<div id=\"ssid_scan_table_utilization_all_24\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_table_utilization_all_24', {

    title: {
	useHTML: 1,
        text: '<center>$monitor <b>FULL SSID SCAN AVG CHANNEL UTILIZATION PERCENTAGE [ALL 2.4 CHANNELS]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width: $width]<br> <i><font size=1>NOTE: NOT ALL SSIDS REPORT UTILIZATION INFORMATION</font></i><br>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	if($key != $last_key)
		print "'$freq_channel',";
	else
		print "'$freq_channel'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Percent Channel Utilization'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: 0
        }
    },

    series: [
";
$last_ssid = end(array_keys($avg_ssid_scan_levels_all_clean_util));
foreach($avg_ssid_scan_levels_all_clean_util as $ssid => $avg_values)
{
	$avg_low_freq = $avg_values["low_freq"];
	$avg_high_freq = $avg_values["high_freq"];
	$avg_ch_utilization = $avg_values["avg_ch_utilization"];
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: '[$ssid] %',
	";
	print "data: [";

	$last_key = end(array_keys($wifi_freq_table_graph_clean));
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		//$freq_channel = $values[1];

		if($key != $last_key)
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "0,";
			elseif($freq_channel == $avg_low_freq || $freq_channel == $avg_high_freq)
				print "$avg_ch_utilization,";
			else
			{
				print "$avg_ch_utilization,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		else
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "0]";
			else
				print "$avg_ch_utilization]";
		}
	


	}

	if($ssid != $last_ssid)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";


























if(!$graph_ssid_scan_all_5g["ssid"])
        print "<br><br><br><font size=5><i>NO 5ghz statistics collected to be displayed</i></font>";


print "
<div id=\"ssid_scan_all_5g\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_all_5g', {

    title: {
        text: '$monitor <b>FULL SSID SCAN [ALL 5ghz CHANNELS]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width:$width]'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'line',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($graph_ssid_scan_all_5g["timestamp"]));
foreach($graph_ssid_scan_all_5g["timestamp"] as $key => $time_stamp)
{
	$timestamp = date("m-d-Y H:i",$time_stamp);

	if($key != $last_key)
		print "'$timestamp',";
	else
		print "'$timestamp'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Signal Level'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            }
        }
    },

    series: [
";

$last_key = end(array_keys($graph_ssid_scan_all_5g["ssid"]));
foreach($graph_ssid_scan_all_5g["ssid"] as $key => $ssid)
{
	print "{
		";
	print "name: '$ssid',
	";
	print "data: [";

	$last_key2 = end(array_keys($graph_ssid_scan_all_5g["timestamp"]));
	foreach($graph_ssid_scan_all_5g["timestamp"] as $key2 => $timestamp)
	{

		if($key2 != $last_key2)
		{
			if($graph_ssid_scan_all_5g[$ssid][$timestamp])
			{
				print "-".$graph_ssid_scan_all_5g[$ssid][$timestamp].",";
			}
			else
				print "-125,";
		}
		else
		{
			if($graph_ssid_scan_all_5g[$ssid][$timestamp])
			{
				print "-".$graph_ssid_scan_all_5g[$ssid][$timestamp]."]";
			}
			else
				print "-125]";
			
		}

	}

	if($key != $last_key)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";












/*
for($x=2376;$x <= 2476; $x++)
{
	$wifi_freq_table_graph_clean[] = $x;
}

for($x=5145;$x <= 5840; $x = $x + 5)
{
	$wifi_freq_table_graph_clean[] = $x;
}
*/

print "
<div id=\"ssid_scan_table_all\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_table_all', {

    title: {
        text: '$monitor <b>FULL SSID SCAN AVG FREQ TABLE [ALL 5ghz CHANNELS]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width: $width]'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	if($key != $last_key)
		print "'$freq_channel',";
	else
		print "'$freq_channel'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Signal Level'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: -125
        }
    },

    series: [
";

$last_ssid = end(array_keys($avg_ssid_scan_levels_all_5g));
foreach($avg_ssid_scan_levels_all_5g as $ssid => $avg_values)
{
	$avg_low_freq = $avg_values["low_freq"];
	$avg_high_freq = $avg_values["high_freq"];
	$avg_signal_level = $avg_values["avg_signal_level"];
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: '$ssid',
	";
	print "data: [";

	$last_key = end(array_keys($wifi_freq_table_graph_clean));
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		//$freq_channel = $values[1];

		if($key != $last_key)
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "-125,";
			elseif($freq_channel == $avg_low_freq || $freq_channel == $avg_high_freq)
				print "-$avg_signal_level,";
			else
			{
				print "-$avg_signal_level,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		else
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "-125]";
			else
				print "-$avg_signal_level]";
		}
	


	}

	if($ssid != $last_ssid)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";






//pre_print($avg_ssid_scan_levels_all);


print "
<div id=\"ssid_scan_table_utilization_all_5g\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('ssid_scan_table_utilization_all_5g', {

    title: {
	useHTML: 1,
        text: '<center>$monitor <b>FULL SSID SCAN AVG CHANNEL UTILIZATION PERCENTAGE [ALL 5ghz CHANNELS]</b><br> [$connected_ssid | $connected_ssid_mac | CH: $active_channel | width: $width]<br><i><font size=1>NOTE: NOT ALL SSIDS REPORT UTILIZATION INFORMATION</font></i><br>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	if($key != $last_key)
		print "'$freq_channel',";
	else
		print "'$freq_channel'";
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Percent Channel Utilization'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: 0
        }
    },

    series: [
";
$last_ssid = end(array_keys($avg_ssid_scan_levels_all_clean_util_5g));
foreach($avg_ssid_scan_levels_all_clean_util_5g as $ssid => $avg_values)
{
	$avg_low_freq = $avg_values["low_freq"];
	$avg_high_freq = $avg_values["high_freq"];
	$avg_ch_utilization = $avg_values["avg_ch_utilization"];
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: '[$ssid] %',
	";
	print "data: [";

	$last_key = end(array_keys($wifi_freq_table_graph_clean));
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		//$freq_channel = $values[1];

		if($key != $last_key)
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "0,";
			elseif($freq_channel == $avg_low_freq || $freq_channel == $avg_high_freq)
				print "$avg_ch_utilization,";
			else
			{
				print "$avg_ch_utilization,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		else
		{
			if($freq_channel < $avg_low_freq || $freq_channel > $avg_high_freq)
				print "0]";
			else
				print "$avg_ch_utilization]";
		}
	


	}

	if($ssid != $last_ssid)
		print "},";
	else
		print "}],";
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";
print "</script>";







//pre_print($graph_utilization_all);
foreach($graph_utilization_all as $ssid => $values)
{
	foreach($values["utilization"] as $key => $utilization)
	{
		if($utilization >= 1)
		{
			$utilization_selector[] = $ssid;
			break;
		}
	}
}
print "<a name=util_single_ssid></a>";
print "<form method=post id=util_single_ssid action=index.php#util_single_ssid>";
print "<input type=hidden name=monitor value=\"$monitor\">";
print "<input type=hidden name=start_date value=\"$start_date\">";
print "<input type=hidden name=end_date value=\"$end_date\">";
print "<input type=hidden name=ssid_filter_enabled value=\"$ssid_filter_enabled\">";
print "<input type=hidden name=ssid_filter_size value=\"$ssid_filter_size\">";
print "SSID: ";
//pre_print($graph_utilization);
$single_util_ssid = unserialize(base64_decode($single_util_ssid));
//pre_print($graph_utilization_all[$single_util_ssid]);
if(!$single_util_ssid)
	$single_util_ssid = $utilization_selector[0];
print "<select name=single_util_ssid onchange='util_single_ssid.submit();'>";
print "<option value=\"$single_util_ssid\" selected>$single_util_ssid</option>";
foreach($utilization_selector as $key => $ssid_name)
{
	print "<option value=\"".base64_encode(serialize($ssid_name))."\">$ssid_name</option>";
}
print "</select>";
print "</form>";

print "
<div id=\"wifi_stats_util_single_ssid\" style=\"height: 450px; min-width: 310px\"></div>
";


print "
<script type=\"text/javascript\">
  // Create the chart
    Highcharts.stockChart('wifi_stats_util_single_ssid', {


        rangeSelector: {
                       buttons: [{
                type: 'minute',
                count: 15,
                text: '15m'
            }, {
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'hour',
                count: 3,
                text: '3h'
            }, {
                type: 'day',
                count: 1,
                text: '1d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 6
        },

        title: {
	    useHTML: 1,
            text: '<center>$monitor <b>WiFi UTILIZATION</b><br> $single_util_ssid <br>";

print "<i><font size=1>NOTE: NOT ALL SSIDS REPORT UTILIZATION INFORMATION</font></i><br>";

print " '
        },

        series: [{
            name: 'CHANNEL UTILIZATION %',
            data: [
";

$last_key = end(array_keys($graph_utilization_all[$single_util_ssid]["timestamp"]));
foreach($graph_utilization_all[$single_util_ssid]["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$utilization = $graph_utilization_all[$single_util_ssid]["utilization"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$utilization],";
	else
		print "[$time_stamp,$utilization]";
}
print "
	],
		tooltip: {
			valueDecimals: 0,
		}
}";



print "
	,{
	name: 'Active Channel',
	data: [
";

$last_key = end(array_keys($graph_utilization_all[$single_util_ssid]["timestamp"]));
foreach($graph_utilization_all[$single_util_ssid]["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$active_channel = $graph_utilization_all[$single_util_ssid]["channel"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$active_channel],";
	else
		print "[$time_stamp,$active_channel]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";



print "
	,{
	name: 'Connected Clients',
	data: [
";

$last_key = end(array_keys($graph_utilization_all[$single_util_ssid]["timestamp"]));
foreach($graph_utilization_all[$single_util_ssid]["timestamp"] as $key => $value)
{
	$time_stamp = $value;
	$connected_clients = $graph_utilization_all[$single_util_ssid]["clients"][$key];
	
	if($key != $last_key)
		print "[$time_stamp,$connected_clients],";
	else
		print "[$time_stamp,$connected_clients]";
}


print "],
            tooltip: {
                valueDecimals: 0,
            }
        }
";



print "]   
});
";
print "</script>";


















//===================================== END DATEA GRAPHS ===============================













/*


print "<br><br><font size=6><b>WiFi Informational Reference Charts</b></font><br><br>";


$ref_floor = "0";
print "
<div id=\"freq_ref_table\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('freq_ref_table', {

    title: {
        text: '<b>2.4Ghz Channel Frequency Reference Chart A</b>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];
	//if($key != $last_key)
	if($key > 20 && $key < 100)
		print "'$freq_channel',";
	elseif($key == 100)
		print "'$freq_channel'";
	if($key > 100)
		break;

}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Channel Width'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    states: {
		hover: {
			enabled: true,
			lineWidth: 10
			}
		},
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: $ref_floor
        }
    },

    series: [
";

//$ref_last_key = end(array_keys($wifi_freq_table));
print "	{
	name: 'CH: 1 | CENTER FREQ: 2422 | WIDTH: 40',
	data: [0,0,0,0,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,40,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]},";
$ref_last_key = 10;
foreach($wifi_freq_table as $ref_key => $ref_channel_values)
{

	//$ref_level = $ref_level + 100;
	$ref_channel = $ref_channel_values[0];
	$ref_low_freq = $ref_channel_values[1];
	$ref_center_freq = $ref_channel_values[2];
	$ref_high_freq = $ref_channel_values[3];
	$ref_channel_width = $ref_channel_values[4];
	$ref_level = $ref_channel_width;
	
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: 'CH: $ref_channel | CENTER FREQ: $ref_center_freq | WIDTH: $ref_channel_width',
	";
	print "data: [";

	//$clean_last_key = end(array_keys($wifi_freq_table_graph_clean));
	$clean_last_key = 100;
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		if($key < 21)
			continue;
		//$freq_channel = $values[1];
		if($key != $clean_last_key)
		{
			if($freq_channel < $ref_low_freq || $freq_channel > $ref_high_freq)
				print "$ref_floor,";
			elseif($freq_channel == $ref_low_freq || $freq_channel == $ref_high_freq)
				print "$ref_level,";
			else
			{
				print "$ref_level,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		else
		{
			if($freq_channel < $ref_low_freq || $freq_channel > $ref_high_freq)
				print "$ref_floor]";
			else
				print "$ref_level]";
		}
		if($key == $clean_last_key)
			break;
	


	}

	if($ref_key != $ref_last_key)
		print "},";
	else
	{
		print "}],";
		break;
	}
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";


print "</script>";






print "
<div id=\"freq_ref_table_two\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('freq_ref_table_two', {

    title: {
        text: '<b>2.4Ghz Channel Frequency Reference Chart B</b>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'columnrange',
                inverted: 'true',
		zoomType: 'xy'
        }, 
    xAxis: {
	categories: ['CHANNELS'";

print "
	]
    },
    yAxis: {
        title: {
            text: 'Frequency'
        }
    },
    plotOptions: {
        columnrange: {
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [
";
print "{
	name: 'CH: 1 | CENTER FREQ: 2422 | WIDTH: 40',
	data: [[2401, 2441]]},";
$ref_last_key = end(array_keys($wifi_freq_table));
foreach($wifi_freq_table as $ref_key => $ref_channel_values)
{
	$ref_level = $ref_level + 100;
	$ref_channel = $ref_channel_values[0];
	$ref_low_freq = $ref_channel_values[1];
	$ref_center_freq = $ref_channel_values[2];
	$ref_high_freq = $ref_channel_values[3];
	$ref_channel_width = $ref_channel_values[4];
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: 'CH: $ref_channel | CENTER FREQ: $ref_center_freq | WIDTH: $ref_channel_width',
	";
	print "data: [";
	print "[$ref_low_freq, $ref_high_freq]";
	print "]";
	if($ref_key < 10 )
		print "},";
	else
	{
		print "}";
		break;
	}
}
print "
]
});

";


print "</script>";









$ref_floor = "0";
print "
<div id=\"freq_ref_table_three\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('freq_ref_table_three', {

    title: {
        text: '<b>5Ghz Channel Frequency Reference Chart 1 A</b>'
    },

    subtitle: {
        text: 'Frequency Range 5170 <--> 5330'
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	//if($key != $last_key)
	//if($key > 100 && $key != $last_key)
	if($key > 100 && $key != 144)
		print "'$freq_channel',";
	//elseif($key == $last_key)
	elseif($key == 144)
	{
		print "'$freq_channel'";
		break;
	}
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Channel Width'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    states: {
		hover: {
			enabled: true,
			lineWidth: 10
			}
		},
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: $ref_floor
        }
    },

    series: [
";

$ref_last_key = end(array_keys($wifi_freq_table));
//$ref_last_key = 10;
	print "	{
	name: 'DFS BAND RANGE',
	data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200]},";
foreach($wifi_freq_table as $ref_key => $ref_channel_values)
{
	if($ref_key < 11)
		continue;

	//$ref_level = $ref_level + 100;
	$ref_channel = $ref_channel_values[0];
	$ref_low_freq = $ref_channel_values[1];
	$ref_center_freq = $ref_channel_values[2];
	$ref_high_freq = $ref_channel_values[3];
	$ref_channel_width = $ref_channel_values[4];
	$ref_level = $ref_channel_width;
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
	";

	print "name: 'CH: $ref_channel | CENTER FREQ: $ref_center_freq | WIDTH: $ref_channel_width',
	";
	print "data: [";
	

	$clean_last_key = end(array_keys($wifi_freq_table_graph_clean));
	//$clean_last_key = 100;
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		if($key < 101)
			continue;
		//$freq_channel = $values[1];
		//if($key != $clean_last_key)
		if($key != 144)
		{
			if($freq_channel < $ref_low_freq || $freq_channel > $ref_high_freq)
			{
				print "$ref_floor,";
				//print "$countme freq_channel:$freq_channel ref_low_freq:$ref_low_freq ref_high_freq:$ref_high_freq|\n";
			}
			elseif($freq_channel == $ref_low_freq || $freq_channel == $ref_high_freq)
			{
				print "$ref_level,";
				//print "$countme freq_channel:$freq_channel ref_low_freq:$ref_low_freq ref_high_freq:$ref_high_freq|\n";
			}
			else
			{
				print "$ref_level,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq\n";
				//print "$countme freq_channel:$freq_channel ref_low_freq:$ref_low_freq ref_high_freq:$ref_high_freq|\n";
			}
		}
		//else
		elseif($key == 144)
		{
			if($freq_channel < $ref_low_freq || $freq_channel > $ref_high_freq)
				print "$ref_floor]";
			else
				print "$ref_level]";
				
			//print "$countme freq_channel:$freq_channel ref_low_freq:$ref_low_freq ref_high_freq:$ref_high_freq|\n";
		}
		//if($key == $clean_last_key)
		if($key == 144)
			break;
	


	}

	//if($ref_key != $ref_last_key)
	if($ref_key != 25)
		print "},";
	//else
	elseif($ref_key == 25)
	{
		print "}],";
		break;
	}
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";


print "</script>";




print "
<div id=\"freq_ref_table_four\" style=\"height: 500px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">
Highcharts.chart('freq_ref_table_four', {

    title: {
        text: '<b>5Ghz Channel Frequency Reference Chart 1 B</b>'
    },

    subtitle: {
        text: 'Frequency Range 5170 <--> 5330'
    },
    chart: {
                type: 'columnrange',
                inverted: 'true',
		zoomType: 'xy'
        }, 
    xAxis: {
	categories: ['CHANNELS'
	]
    },
    yAxis: {
        title: {
            text: 'Frequency'
        }
    },
    plotOptions: {
        columnrange: {
            dataLabels: {
                enabled: false
            }
        },
	series: {
            dataLabels: {
                enabled: true
            }
	}
    },
    series: [
{
name: 'CH: 36 | CENTER FREQ: 5180 | WIDTH: 20',
	data: [[5170, 5190]]},{
		name: 'CH: 40 | CENTER FREQ: 5200 | WIDTH: 20',
	data: [[5190, 5210]]},{
		name: 'CH: 44 | CENTER FREQ: 5220 | WIDTH: 20',
	data: [[5210, 5230]]},{
		name: 'CH: 48 | CENTER FREQ: 5240 | WIDTH: 20',
	data: [[5230, 5250]]},{
		name: 'CH: 52 | CENTER FREQ: 5260 | WIDTH: 20',
	data: [[5250, 5270]]},{
		name: 'CH: 56 | CENTER FREQ: 5280 | WIDTH: 20',
	data: [[5270, 5290]]},{
		name: 'CH: 60 | CENTER FREQ: 5300 | WIDTH: 20',
	data: [[5290, 5310]]},{
		name: 'CH: 64 | CENTER FREQ: 5320 | WIDTH: 20',
	data: [[5310, 5330]]},{
		name: 'CH: 38 | CENTER FREQ: 5190 | WIDTH: 40',
	data: [[5170, 5210]]},{
		name: 'CH: 46 | CENTER FREQ: 5230 | WIDTH: 40',
	data: [[5210, 5250]]},{
		name: 'CH: 54 | CENTER FREQ: 5270 | WIDTH: 40',
	data: [[5250, 5290]]},{
		name: 'CH: 62 | CENTER FREQ: 5310 | WIDTH: 40',
	data: [[5290, 5330]]},{
		name: 'CH: 42 | CENTER FREQ: 5210 | WIDTH: 80',
	data: [[5170, 5250]]},{
		name: 'CH: 58 | CENTER FREQ: 5290 | WIDTH: 80',
	data: [[5250, 5330]]},{
		name: 'CH: 50 | CENTER FREQ: 5250 | WIDTH: 160',
	data: [[5170, 5330]]}
]
});
";


print "</script>";

















$ref_floor = "0";
print "
<div id=\"freq_ref_table_five\" style=\"height: 400px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('freq_ref_table_five', {

    title: {
        text: '<b>5Ghz Channel Frequency Reference Chart 2 A</b>'
    },

    subtitle: {
        text: 'Frequency Range 5490 <--> 5835'
    },
    chart: {
                type: 'area',
                zoomType: 'xy'
        }, 
    xAxis: {
	categories: [";
$last_key = end(array_keys($wifi_freq_table_graph_clean));
foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
{
	//$freq_channel = $values[1];

	//if($key != $last_key)
	//if($key > 100 && $key != $last_key)
	if($key > 165 && $key != $last_key)
		print "'$freq_channel',";
	//elseif($key == $last_key)
	elseif($key == $last_key)
	{
		print "'$freq_channel'";
		break;
	}
}

print "
	]
    },
    yAxis: {
        title: {
            text: 'Channel Width'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false,
            },
	    states: {
		hover: {
			enabled: true,
			lineWidth: 10
			}
		},
	    marker: {
			enabled: false
		},
	    fillOpacity: 0.1,
	    threshold: $ref_floor
        }
    },

    series: [
";

$ref_last_key = end(array_keys($wifi_freq_table));
//$ref_last_key = 10;
print "	{
name: 'DFS BAND RANGE',
	data: [200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]},";
foreach($wifi_freq_table as $ref_key => $ref_channel_values)
{
	if($ref_key < 26)
		continue;

	//$ref_level = $ref_level + 100;
	$ref_channel = $ref_channel_values[0];
	$ref_low_freq = $ref_channel_values[1];
	$ref_center_freq = $ref_channel_values[2];
	$ref_high_freq = $ref_channel_values[3];
	$ref_channel_width = $ref_channel_values[4];
	$ref_level = $ref_channel_width;
	//print "avg_low_freq:$avg_low_freq | avg_high_freq:$avg_high_freq | avg_signal_level:$avg_signal_level<br>";
	print "{
		";
	print "name: 'CH: $ref_channel | CENTER FREQ: $ref_center_freq | WIDTH: $ref_channel_width',
	";
	print "data: [";

	$clean_last_key = end(array_keys($wifi_freq_table_graph_clean));
	//$clean_last_key = 100;
	foreach($wifi_freq_table_graph_clean as $key => $freq_channel)
	{
		if($key < 166)
			continue;
		if($key != $clean_last_key)
		{
			if($freq_channel < $ref_low_freq || $freq_channel > $ref_high_freq)
				print "$ref_floor,";
			elseif($freq_channel == $ref_low_freq || $freq_channel == $ref_high_freq)
				print "$ref_level,";
			else
			{
				print "$ref_level,";
				//print "freq_channel: $freq_channel < avg_low_freq: $avg_low_freq || freq_chanel: $freq_channel > avg_high_freq: $avg_high_freq";
			}
		}
		//else
		elseif($key == $clean_last_key)
		{
			if($freq_channel < $ref_low_freq || $freq_channel > $ref_high_freq)
				print "$ref_floor]";
			else
				print "$ref_level]";
		}
		if($key == $clean_last_key)
			break;
	}

	if($ref_key != $ref_last_key)
		print "},";
	else
	{
		print "}],";
		break;
	}
}
print "
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

";


print "</script>";






print "
<div id=\"freq_ref_table_six\" style=\"height: 800px; min-width: 310px\"></div>

";
print "
<script type=\"text/javascript\">

Highcharts.chart('freq_ref_table_six', {

    title: {
        text: '<b>5Ghz Channel Frequency Reference Chart 2 B</b>'
    },

    subtitle: {
        text: 'Frequency Range 5490 <--> 5835'
    },
    chart: {
                type: 'columnrange',
                inverted: 'true',
		zoomType: 'xy'
        }, 
    xAxis: {
	categories: ['CHANNELS'
	]
    },
    yAxis: {
        title: {
            text: 'Frequency'
        }
    },
    plotOptions: {
        columnrange: {
            dataLabels: {
                enabled: true
            }
        }

    },
 series: [
{
	name: 'CH: 100 | CENTER FREQ: 5500 | WIDTH: 20',
	data: [[5490, 5510]]},{
		name: 'CH: 104 | CENTER FREQ: 5520 | WIDTH: 20',
	data: [[5510, 5530]]},{
		name: 'CH: 108 | CENTER FREQ: 5540 | WIDTH: 20',
	data: [[5530, 5550]]},{
		name: 'CH: 112 | CENTER FREQ: 5560 | WIDTH: 20',
	data: [[5550, 5570]]},{
		name: 'CH: 116 | CENTER FREQ: 5580 | WIDTH: 20',
	data: [[5570, 5590]]},{
		name: 'CH: 120 | CENTER FREQ: 5600 | WIDTH: 20',
	data: [[5590, 5610]]},{
		name: 'CH: 124 | CENTER FREQ: 5620 | WIDTH: 20',
	data: [[5610, 5630]]},{
		name: 'CH: 128 | CENTER FREQ: 5640 | WIDTH: 20',
	data: [[5630, 5650]]},{
		name: 'CH: 132 | CENTER FREQ: 5660 | WIDTH: 20',
	data: [[5650, 5670]]},{
		name: 'CH: 136 | CENTER FREQ: 5680 | WIDTH: 20',
	data: [[5670, 5690]]},{
		name: 'CH: 140 | CENTER FREQ: 5700 | WIDTH: 20',
	data: [[5690, 5710]]},{
		name: 'CH: 144 | CENTER FREQ: 5720 | WIDTH: 20',
	data: [[5710, 5730]]},{
		name: 'CH: 149 | CENTER FREQ: 5745 | WIDTH: 20',
	data: [[5735, 5755]]},{
		name: 'CH: 153 | CENTER FREQ: 5765 | WIDTH: 20',
	data: [[5755, 5775]]},{
		name: 'CH: 157 | CENTER FREQ: 5785 | WIDTH: 20',
	data: [[5775, 5795]]},{
		name: 'CH: 161 | CENTER FREQ: 5805 | WIDTH: 20',
	data: [[5795, 5815]]},{
		name: 'CH: 165 | CENTER FREQ: 5825 | WIDTH: 20',
	data: [[5815, 5835]]},{
		name: 'CH: 102 | CENTER FREQ: 5510 | WIDTH: 40',
	data: [[5490, 5530]]},{
		name: 'CH: 110 | CENTER FREQ: 5550 | WIDTH: 40',
	data: [[5530, 5570]]},{
		name: 'CH: 118 | CENTER FREQ: 5590 | WIDTH: 40',
	data: [[5570, 5610]]},{
		name: 'CH: 126 | CENTER FREQ: 5630 | WIDTH: 40',
	data: [[5610, 5650]]},{
		name: 'CH: 134 | CENTER FREQ: 5670 | WIDTH: 40',
	data: [[5650, 5690]]},{
		name: 'CH: 142 | CENTER FREQ: 5710 | WIDTH: 40',
	data: [[5690, 5730]]},{
		name: 'CH: 151 | CENTER FREQ: 5755 | WIDTH: 40',
	data: [[5735, 5775]]},{
		name: 'CH: 159 | CENTER FREQ: 5795 | WIDTH: 40',
	data: [[5775, 5815]]},{
		name: 'CH: 106 | CENTER FREQ: 5530 | WIDTH: 80',
	data: [[5490, 5570]]},{
		name: 'CH: 122 | CENTER FREQ: 5610 | WIDTH: 80',
	data: [[5570, 5650]]},{
		name: 'CH: 138 | CENTER FREQ: 5690 | WIDTH: 80',
	data: [[5650, 5730]]},{
		name: 'CH: 155 | CENTER FREQ: 5775 | WIDTH: 80',
	data: [[5735, 5815]]},{
		name: 'CH: 114 | CENTER FREQ: 5570 | WIDTH: 160',
	data: [[5490, 5650]]}
]
});

";




print "</script>";











print "
<table border=0><tr><td>
<li>802.11ac Channel Mapping Examples</li>
<ul>
<li>Reference the center channel frequency for the entire 40/80/160 MHz wide channel</li>
<li>Designate one 20 MHz portion of the wide channel as the Primary 20 MHz</li>
<li>40 MHz Example: Channel 110 with Primary 20 MHz channel 108</li>
<li>80 MHz Example: Channel 106 with Primary 20 MHz channel 104</li>
<li>160 MHz Example: Channel 114 with Primary 20 MHz channel 124</li>
</ul>
</ul>
</tr>
</td>
</table>";

print "<br><br>When selecting an 80mhz channel, you are actually selecting the fallback 20mhz channel within the range of the 80mhz channel.  The AP can fallback to either the 20mhz channel or the 40mhz channel that contains the selected 20mhz channel";
print "<br><br>Note: 80MHz capable AP's are backwards compatible for 40MHz and 20MHz capable clients. If you use a 80MHz channel on your AP you are effectively using 4 20MHz channels bonded together. This should be ok in noise free environments but where you have lots of 5GHz AP's this could mean AP's using the same channel as one other. This is know as co-channel interference. If a client hears another client transmitting on the same channel as they are using they will wait until the channel is clear before trying to transmit. This causes congestion and delay and effectively slows the network down. ";

*/

print "<a name=the_bottom></a>";

print "<br>";

if($using_userspice == "yes")
{
	print "<a href=#the_middle class=\"btn btn-info\">GO TO MIDDLE</a>";
	print "<a href=#the_top class=\"btn btn-info\">GO TO TOP</a>";
}
print "<br><br><br>";

if($using_userspice == "yes")
{
	print "</div></div>";?>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html
}
?>
