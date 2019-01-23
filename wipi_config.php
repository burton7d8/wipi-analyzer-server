<?php
$using_userspice = "no";

$mysql_host = "localhost";	//the location of the mysql database
$mysql_username = "wipi";	// the username used to connect to the wipi database
$mysql_password = "wipi";	// the password used to connect to the wipi database
$dbName = "wipi_analyzer";	//  the wipi mysql database name

$wipi_shared_key = "wipi";	//the password used by raspberry wipi's to connect to the server to upload their data

setlocale(LC_MONETARY, 'en_US');  // choose your locale
date_default_timezone_set('America/Chicago');  // set your timezone   http://php.net/manual/en/timezones.php


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
	print "
	<head>
	<link rel=\"stylesheet\" href=\"./includes/jquery-ui-timepicker-addon.css\" />
	<link rel=\"stylesheet\" href=\"./includes/jquery-ui-1.12.1/jquery-ui.css\" />
	<script type=\"text/javascript\" src=\"./includes/jquery-3.3.1.min.js\"></script>
	<script type=\"text/javascript\" src=\"./includes/jquery-ui-1.12.1/jquery-ui.js\"></script>
	<script type=\"text/javascript\" src=\"./includes/jquery-ui-timepicker-addon.js\"></script>
	</head>";
	print "<a name=the_top></a>";
}
else
{
	print "
	<head>
	<style>
		.navbar .navbar-brand {
		  padding-top: 5px;
		}
		.navbar .navbar-brand img {
		  height: 40px;
		}
	</style>

	<link rel=\"stylesheet\" href=\"./includes/bootstrap.min.css\" />
	<link rel=\"stylesheet\" href=\"./includes/jquery-ui-timepicker-addon.css\" />
	<link rel=\"stylesheet\" href=\"./includes/jquery-ui-1.12.1/jquery-ui.css\" />
	<script type=\"text/javascript\" src=\"./includes/jquery-3.3.1.min.js\"></script>
	<script type=\"text/javascript\" src=\"./includes/bootstrap.min.js\"></script>
	<script type=\"text/javascript\" src=\"./includes/jquery-ui-1.12.1/jquery-ui.js\"></script>
	<script type=\"text/javascript\" src=\"./includes/jquery-ui-timepicker-addon.js\"></script>
	</head>";

	//<nav class=\"navbar navbar-dark navbar-fixed-top bg-dark\">
	print "
        <nav class=\"navbar navbar-expand-lg navbar-inverse navbar-fixed-top\">
	  <div class=\"container-fluid\">
	    <div class=\"navbar-header\">
	      <a class=\"navbar-brand\" href=\"./index.php\"><img src=./userspice/logo.png></a>
	    </div>
	    <ul class=\"nav navbar-nav\">
	      <li><a href=\"./index.php\">HOME</a></li>
	      <li><a href=\"./admin.php\">ADMIN</a></li>
	      <li><a href=\"./info_ref.php\">WiFi Reference Charts</a></li>
	    </ul>
	  </div>
	</nav>
	<br><br><br><br>";
	print "<a name=the_top></a>";
}
?>


