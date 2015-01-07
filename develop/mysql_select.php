<?php include("./include/connection_conf.php");?>
<?php
	$db_server = mysql_connect($db_hostname, $db_username, $db_password);
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