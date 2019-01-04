<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('error_reporting', 'E_ALL & ~E_NOTICE');
ini_set('display_startup_errors', TRUE);

include("wipi_config.php");
/*
$host = "localhost";
$username = "wipi";
$password = "wipi";
$dbName = "wipi";
*/
$mysql_link=mysqli_connect($mysql_host, $mysql_username, $mysql_password, $dbName) or die ("Error connecting to database");      

function pre_print($da_array)
{
	print "<pre>";
	print_r($da_array);
	print "</pre>";
}
function sqlerr($query,$query_results)
{
	global $mysql_link;
	print "<p><B>SQL Error!<br>";
	print mysqli_errno($mysql_link).": ".mysqli_error($mysql_link)."<BR>";
	print "query: $query<BR>";
	print "query results: $query_results";
	print "</b>";
}

function distinct_query_table($column,$table)
{
	global $mysql_link;
	$q="select DISTINCT $column from $table;";
    	$q_res=mysqli_query($mysql_link,$q) or sqlerr($q,$q_res);
	$stack=array();
	while ($row=mysqli_fetch_array($q_res))
		array_push ($stack,$row);
	return $stack;
}
function db_size($dbName)
{
	global $mysql_link;
	$q = "SELECT  SUM(ROUND(((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024 ), 2)) AS \"SIZE IN MB\" FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = \"$dbName\";";
    	$q_res=mysqli_query($mysql_link,$q) or sqlerr($q,$q_res);
	$stack=array();
	while ($row=mysqli_fetch_array($q_res))
		array_push ($stack,$row);
	return $stack;
}
function query_table($what,$table,$where)
{
	global $mysql_link;
	$q="select $what from $table where $where";
    	$q_res=mysqli_query($mysql_link,$q) or sqlerr($q,$q_res);
	$stack=array();
	while ($row=mysqli_fetch_array($q_res))
		array_push ($stack,$row);
	return $stack;
}

function update_table($table,$update,$where)
{
	global $mysql_link;
	$LOCKING_ACTIVE=1;
	$q="update $table set $update where $where";
	$q_lock="lock tables $table WRITE";
	$q_unlock="unlock tables";

	if ($UPDATE_DEBUG) print "<br><b>LOCKING TABLE $table for query [$q]</b>";
	if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_lock) or die ("couldn't lock table $table");
	if ((!$table)||(!$update)||(!$where))
	{
		system_log("Update Table Error: improperly formed update statement [$q]",1);
		die ("Fatal error: an update statement was improperly formed.  [$q]<br> SYSAD has been notified.");
	}

	$q_res=mysqli_query($mysql_link,$q) or sqlerr($q,$q_res);

	if ($UPDATE_DEBUG)
	{
		$affected_rows=mysqli_affected_rows($mysql_link);
		if ($affected_rows>1) print "<br><b><font color=red>[$affected_rows] rows were updated.</font></b><br>\n";
		else if ($affected_rows==1) print "<br><b><font color=red>[$affected_rows] row was updated.</font></b><br>\n";
		else if ($affected_rows==0) print "<br><b><font color=red>[$affected_rows] rows were updated.</font></b><br>\n";
	}
	if ($UPDATE_DEBUG) print "<br><b>UNLOCKING TABLE $table after query [$q]</b>";
	if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_unlock) or die ("couldn't unlock table $table");
}

function table_insert($table,$field_list,$values)
{
	global $mysql_link;
	$LOCKING_ACTIVE=1;
	$INSERT_DEBUG=0;

	$q="insert into $table ($field_list) values ($values)";
	$q_lock="lock tables $table WRITE";
	$q_unlock="unlock tables";

	if ($INSERT_DEBUG) print "<br><b>LOCKING TABLE $table for insert [$q]</b>";
	if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_lock);
	if ((!$table)||(!$field_list)||(!$values))
	{
		system_log("Table Insert Error: improperly formed insert statement [$q]",1);
		die ("Fatal error: an insert statement was improperly formed.  [$q].<br> SYSAD has been notified.");
		if ($INSERT_DEBUG) print "<br><b>UNLOCKING TABLE $table after insert [$q]</b>";
	}

	$q_res=mysqli_query($mysql_link,$q) or sqlerr($q,$q_res);

	if ($INSERT_DEBUG) print "<br><b>UNLOCKING TABLE $table after insert [$q]</b>";
	if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_unlock);
}

function row_delete($table,$where)
{
	global $mysql_link;
	$LOCKING_ACTIVE=1;
	$INSERT_DEBUG=0;

	$q="delete from $table where $where limit 1";
	$q_lock="lock tables $table WRITE";
	$q_unlock="unlock tables";

	if ($INSERT_DEBUG) print "<br><b>LOCKING TABLE $table for delete [$q]</b>";
	if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_lock);
	if ((!$table)||(!$where))
	{
		system_log("Row Delete Error: improperly formed delete statement [$q]",1);
		die ("Fatal error: a delete statement was improperly formed.  [$q]<br>SYSAD has been notifed.");
	}

	$q_res=mysqli_query($mysql_link,$q) or sqlerr($q,$q_res);
	if ($INSERT_DEBUG) print "<br><b>UNLOCKING TABLE $table after delete [$q]</b>";
	if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_unlock);
}

function row_delete_nolimit($table,$where)
{
	global $mysql_link;
        $LOCKING_ACTIVE=1;
        $INSERT_DEBUG=0;

        $q="delete from $table where $where";
        $q_lock="lock tables $table WRITE";
        $q_unlock="unlock tables";

        if ($INSERT_DEBUG) print "<br><b>LOCKING TABLE $table for delete [$q]</b>";
        if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_lock);
        if ((!$table)||(!$where))
        {
                system_log("Row Delete Error: improperly formed delete statement [$q]",1);
                die ("Fatal error: a delete statement was improperly formed.  [$q]<br>SYSAD has been notifed.");
        }

        $q_res=mysqli_query($mysql_link,$q) or sqlerr($q,$q_res);
        if ($INSERT_DEBUG) print "<br><b>UNLOCKING TABLE $table after delete [$q]</b>";
        if ($LOCKING_ACTIVE) mysqli_query($mysql_link,$q_unlock);
}
function getlink()
{
        //print "<pre>";
        //print_r($_SERVER);
        //print "</pre>";

        $https = $_SERVER['HTTPS'];
        if($https)
                $s = "s";
        else
                unset($s);

        $host = $_SERVER['HTTP_HOST'];
        //print "host = $host<br>";

        $self = $_SERVER['PHP_SELF'];
        //print "phpself = $self<br>";

        $reverseself = strrev($self);
        //print "reverse self = $reverseself<br>";
        $file = strtok($reverseself,"/");
        $path = strtok("\n");
        $path = strrev($path);
        //print "path = $path<br>";

        $link = "http".$s."://".$host.$path;
        //print "link = $link<br>";
        return($link);
}


?>
