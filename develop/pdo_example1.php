<?
	$db = new PDO("mysql:host=localhost;dbname=kingwang09", "kingwang09", "wlsguddms88");
	$statement = $db->prepare("select * from tab");
	$statement->execute();

	while($row = $statement->fetch()){
		print_r($row);
	}
?>