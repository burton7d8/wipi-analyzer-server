<?php
require_once("wipi_functions.php");
if($using_userspice != "yes")
{
	print "<head>";
	print "<link rel=\"stylesheet\" href=\"./includes/bootstrap.min.css\" />";
	print "</head>";
}



print "<center>";
print "<br><br>";
print "<i>The WiPi graphs below are free for <u>Personal Use</u> and are provided by <a href=http://www.highcharts.com/download target=_blank>HIGHCHARTS</a> under the <a href=https://creativecommons.org/licenses/by-nc/3.0/ target=_blank>Creative Commons (CC) Attribution-NonCommercial license</a><br>";
print "You <u>CAN NOT</u> use HIGHCHARTS for <a href=https://shop.highsoft.com/faq#Non-Commercial-0 target=_blank>commercial use</a>  You must purchase a <a href=https://shop.highsoft.com/highcharts target=_blank>license</a> from HIGHCHARTS to do so!<br></i>";
print "<br><br>";

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


for($x=2376;$x <= 2476; $x++)
{
	$wifi_freq_table_graph_clean[] = $x;
}

for($x=5145;$x <= 5840; $x = $x + 5)
{
	$wifi_freq_table_graph_clean[] = $x;
}



print "
<script src=\"https://code.jquery.com/jquery-3.1.1.min.js\"></script>
<script src=\"https://code.highcharts.com/stock/highstock.js\"></script>
<script src=\"https://code.highcharts.com/stock/modules/exporting.js\"></script>
<script src=\"https://code.highcharts.com/highcharts-more.js\"></script>
<script src=\"https://code.highcharts.com/modules/exporting.js\"></script>
<script src=\"https://code.highcharts.com/modules/export-data.js\"></script>";



print "<br><br><font size=6><b>WiFi Informational Reference Charts</b></font><br><br>";


/*
print "<pre>";
print_r($wifi_freq_table);
print_r($wifi_freq_table_graph_clean);
print "</pre>";
*/
//$ref_level = "-200";
//$ref_floor = "-400";
//$ref_level = "-200";
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

/*
	if($key < 100)
		print "'$freq_channel',";
	elseif($key == 100)
		print "'$freq_channel'";
	if($key > 100)
		break;
*/
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

/*
$last_key = end(array_keys($wifi_freq_table));
foreach($wifi_freq_table as $key => $freq_table_values)
{
	//$freq_channel = $values[1];
	$freq_channel = $freq_table_values[0];
	$freq_channel_width = $freq_table_values[4];

	if($key < 10)
		print "'CH: $freq_channel | $freq_channel_width',";
	else
	{
		print "'CH: $freq_channel | $freq_channel_width'";
		break;
	}
}
*/
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









/*
print "<pre>";
print_r($wifi_freq_table);
print_r($wifi_freq_table_graph_clean);
print "</pre>";
*/
//$ref_level = "-200";
//$ref_floor = "-400";
//$ref_level = "-200";
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

/*
print "
Highcharts.chart('freq_ref_table_four', {

    title: {
        text: '<b>5Ghz Channel Frequency Reference Chart 2</b>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'columnrange',
                inverted: 'true'
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

$ref_last_key = end(array_keys($wifi_freq_table));
foreach($wifi_freq_table as $ref_key => $ref_channel_values)
{
	if($ref_key < 11)
		continue;
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
	if($ref_key < 25 )
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
*/

print "</script>";























/*
print "<pre>";
print_r($wifi_freq_table);
print_r($wifi_freq_table_graph_clean);
print "</pre>";
*/
//$ref_level = "-200";
//$ref_floor = "-400";
//$ref_level = "-200";
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



/*
print "
Highcharts.chart('freq_ref_table_six', {

    title: {
        text: '<b>5Ghz Channel Frequency Reference Chart 4</b>'
    },

    subtitle: {
        text: ''
    },
    chart: {
                type: 'columnrange',
                inverted: 'true'
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

$ref_last_key = end(array_keys($wifi_freq_table));
foreach($wifi_freq_table as $ref_key => $ref_channel_values)
{
	if($ref_key < 26)
		continue;
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
	if($ref_key != $ref_last_key )
		print "},";
	else
	{
		print "}";
	}
}
print "
]
});

";
*/


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

if($using_userspice == "yes")
{
	print "</div></div>"; 
	print "i'm here"; ?>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html
}
?>
