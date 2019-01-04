<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}
?>
<div id="page-wrapper">
<div class="container">
<?php
	if($user->isLoggedIn())
	{
		$uid = $user->data()->id;
		print "<center>";
		print "<font size=5><b>Welcome</b></bold><br><br>";
		//require_once $abs_us_root.$us_url_root.'wipi_server/wipi_server.php';
		print "<a class=\"btn btn-default\" href=".$us_url_root."wipi-analyzer-server/index.php>WiPi Analyzer Server [ View ]</a><br><br>";
		print "<a class=\"btn btn-default\" href=".$us_url_root."wipi-analyzer-server/admin.php>WiPi Analyzer Server [ Admin ]</a><br><br>";
		print "<a class=\"btn btn-default\" href=".$us_url_root."wipi-analyzer-server/info_ref.php>WiFi Reference Charts</a><br><br>";
	}
	else
	{
		?>
		<font size=5><b>Please Login to Access WiPi Analyzer Server</b></font><br><br>
		<a class="btn btn-warning" href="users/login.php" role="button">Log In &raquo;</a><br><br><br>
		<?php
	}	
?>
</div>
</div>
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
