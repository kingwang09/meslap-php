<?
	$dsn = "mysql:host=localhost;dbname=kingwang09";
	$user = "kingwang09";
	$pass = "wlsguddms88";
?>
<?php
	$db_server = mysql_connect($dsn, $user, $pass);
	if(!$db_server){
		die("unable to connect to Mysql : ".mysql_error());
	}else{
		echo "Success Mysql DB Connection..<br/>";
	}

	$db_select = mysql_select_db($db_database);
	if($db_select){
		echo "Success Mysql DB Selected : ".$db_select."<br/>";
	}else{
		die("unable to select database.. : ".mysql_error());
	}
	$query = "select * from tab";
?>

<?
	mysql_close($db_server);
?>