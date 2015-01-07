<?
	$db = new PDO("mysql:host=localhost;dbname=ojt", "ojt", "ojt");
	$statement = $db->prepare("select * from tab");
	$statement->execute();

	while($row = $statement->fetch()){
		print_r($row);
	}
?>