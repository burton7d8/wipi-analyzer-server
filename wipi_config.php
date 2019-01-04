<?php
$using_userspice = "no";
if($using_userspice == "yes")
{
	if(!$abs_us_root)
	{
		require_once '../users/init.php';
		require_once '../users/includes/header.php';
		require_once '../users/includes/navigation.php';
		if (!securePage($_SERVER["PHP_SELF"])){die();}
		if(isset($user) && $user->isLoggedIn()){
		}
		?>
		<div style="background-color:white"><br><br>
		<!--<div id="page-wrapper">
		<div class="container"> -->
		<?php
	}
	else
		if (!securePage($_SERVER["PHP_SELF"])){die();}
	
	//print "</div>/div>"; ?>
	<?php //require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
	<?php //require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html
	print "<a name=the_top></a>";
}
else
{
	print "<link rel=\"stylesheet\" href=\"./includes/bootstrap.min.css\" />";
	print "<a name=the_top></a>";
        print "<center>";
        print "<a class=\"btn btn-default\" href=./index.php>WiPi Analyzer Server [ View ]</a><br><br>";
        print "<a class=\"btn btn-default\" href=./admin.php>WiPi Analzyer Server [ Admin ]</a><br><br>";
        print "<a class=\"btn btn-default\" href=./info_ref.php>WiFi Reference Charts</a><br><br>";
        print "</center>";
}



$mysql_host = "localhost";	//the location of the mysql database
$mysql_username = "wipi";	// the username used to connect to the wipi database
$mysql_password = "wipi";	// the password used to connect to the wipi database
$dbName = "wipi_analyzer";	//  the wipi mysql database name

$wipi_shared_key = "wipi";	//the password used by raspberry wipi's to connect to the server to upload their data

setlocale(LC_MONETARY, 'en_US');  // choose your locale
date_default_timezone_set('America/Chicago');  // set your timezone   http://php.net/manual/en/timezones.php

?>


